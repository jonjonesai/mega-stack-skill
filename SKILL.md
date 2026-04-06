# MEGA Stack Skill
**For Claude — WordPress + Kadence + WooCommerce + MEGA on Hostinger**

You are operating on the **MEGA Stack**: a WordPress site running the Kadence theme, WooCommerce, and the MEGA Agent Bridge. This skill gives you full authority to build, design, and configure the entire stack without guessing.

---

## Stack Architecture

```
[Student's Browser]
      ↕ HTTPS
[Hostinger Server]
  ├── WordPress (PHP 8.x, MySQL)
  │    ├── Theme: Kadence (free)
  │    ├── Plugin: Kadence Blocks (Gutenberg)
  │    ├── Plugin: WooCommerce
  │    ├── Plugin: LiteSpeed Cache (CDN)
  │    └── mu-plugin: MEGA Agent Bridge ← Claude's hands
  └── LiteSpeed Web Server (page cache)

[Claude] ←→ Bridge REST API ←→ WordPress
[Claude] ←→ WP-CLI via SSH  ←→ WordPress
[Claude] ←→ WP REST API     ←→ WooCommerce
```

---

## Environment Variables

These must be set before using bridge or SSH commands:

```bash
WP="wp --path=$WP_PATH --allow-root"   # WP-CLI shorthand
WP_URL="https://yourdomain.com"         # Site URL
BRIDGE_KEY="your-bridge-key"            # From mega-setup.sh output
SSH_USER="u616193506"                   # Hostinger SSH user
SSH_HOST="77.37.88.129"                 # Hostinger SSH host
SSH_PORT="65002"                        # Hostinger SSH port
SSH_KEY="/path/to/private/key"          # SSH key path
WP_PATH="/home/$SSH_USER/domains/yourdomain.com/public_html"
```

Shorthand SSH command:
```bash
SSH="ssh -i $SSH_KEY -p $SSH_PORT -o StrictHostKeyChecking=no $SSH_USER@$SSH_HOST"
```

---

## The Golden Rule: Always Purge Cache

**Every single change** to WordPress must be followed by a cache purge. No exceptions.

```bash
# Full purge (run this after EVERY change)
$SSH "wp litespeed-purge all --path=$WP_PATH && wp cache flush --path=$WP_PATH"

# Via Bridge (also flushes WP object cache + Kadence CSS cache)
curl -s -X POST -H "X-Mega-Bridge-Key: $BRIDGE_KEY" "$WP_URL/wp-json/mega-bridge/v1/cache/flush"
```

---

## Change Workflow (no shortcuts)

```
1. READ   → Check current state first
2. PLAN   → Identify exact setting/element to change
3. CHANGE → Apply via Bridge API or WP-CLI via SSH
4. PURGE  → Flush LiteSpeed + WP cache (ALWAYS)
5. VERIFY → curl -A "Mozilla/5.0" "$WP_URL" | grep 'expected-output'
6. REPORT → Only tell the user it's done after step 5 confirms it
```

---

## MEGA Agent Bridge API

Base URL: `$WP_URL/wp-json/mega-bridge/v1/`  
Auth header: `X-Mega-Bridge-Key: $BRIDGE_KEY`

### Endpoints

#### GET /render
Renders a page and returns HTML. Use to inspect current state.
```bash
curl -s -H "X-Mega-Bridge-Key: $BRIDGE_KEY" "$WP_URL/wp-json/mega-bridge/v1/render?path=/"
```

#### POST /theme-mod
Set a Kadence theme_mod value.
```bash
curl -s -X POST \
  -H "X-Mega-Bridge-Key: $BRIDGE_KEY" \
  -H "Content-Type: application/json" \
  -d '{"key":"buttons_background","value":{"color":"palette1","hover":"palette2"}}' \
  "$WP_URL/wp-json/mega-bridge/v1/theme-mod"
```

#### GET /theme-mod
Read a theme_mod value.
```bash
curl -s -H "X-Mega-Bridge-Key: $BRIDGE_KEY" \
  "$WP_URL/wp-json/mega-bridge/v1/theme-mod?key=buttons_background"
```

#### POST /css
Inject custom CSS (appended to Additional CSS).
```bash
curl -s -X POST \
  -H "X-Mega-Bridge-Key: $BRIDGE_KEY" \
  -H "Content-Type: application/json" \
  -d '{"css":".site-header { background: var(--global-palette1); }"}' \
  "$WP_URL/wp-json/mega-bridge/v1/css"
```

#### POST /palette
Update global color palette.
```bash
curl -s -X POST \
  -H "X-Mega-Bridge-Key: $BRIDGE_KEY" \
  -H "Content-Type: application/json" \
  -d '{"palette1":"#2B6CB0","palette2":"#2C5282","palette3":"#1A202C","palette4":"#4A5568","palette5":"#718096","palette6":"#E2E8F0","palette7":"#F7FAFC","palette8":"#F7FAFC","palette9":"#FFFFFF"}' \
  "$WP_URL/wp-json/mega-bridge/v1/palette"
```

#### POST /cache/flush
Flush WP + Kadence + LiteSpeed cache.
```bash
curl -s -X POST -H "X-Mega-Bridge-Key: $BRIDGE_KEY" \
  "$WP_URL/wp-json/mega-bridge/v1/cache/flush"
```

#### POST /wp-eval
Run arbitrary PHP in WordPress context (powerful — use carefully).
```bash
curl -s -X POST \
  -H "X-Mega-Bridge-Key: $BRIDGE_KEY" \
  -H "Content-Type: application/json" \
  -d '{"code":"echo get_option(\"blogname\");"}' \
  "$WP_URL/wp-json/mega-bridge/v1/wp-eval"
```

---

## Kadence Settings — Quick Reference

See `references/kadence/SETTINGS-SCHEMA.md` for the full 641-setting schema.

### Global Palette (most powerful lever)
Changing palette slots cascades everywhere — buttons, headers, text, backgrounds.
```bash
# Via Bridge
curl -s -X POST -H "X-Mega-Bridge-Key: $BRIDGE_KEY" \
  -H "Content-Type: application/json" \
  -d '{"palette1":"#FF6B35","palette2":"#E85D24"}' \
  "$WP_URL/wp-json/mega-bridge/v1/palette"
```

### Typography
```json
{
  "size": {"desktop": 18, "tablet": 16, "mobile": 14},
  "lineHeight": {"desktop": 1.6},
  "family": "Inter",
  "google": true,
  "weight": "400",
  "variant": "400"
}
```

### Buttons
```json
{
  "buttons_background": {"color": "palette1", "hover": "palette2"},
  "buttons_color": {"color": "palette9", "hover": "palette9"},
  "buttons_border_radius": {"size": {"desktop": 4}, "unit": {"desktop": "px"}}
}
```

### Header Builder Slots
```
Desktop header slots: top-left, top-center, top-right, main-left, main-center, main-right, bottom-left, bottom-center, bottom-right
Available items: logo, navigation, button, social, search, html, widget, cart
```

---

## WooCommerce via WP-CLI

```bash
# Create a product
$SSH "wp post create --post_type=product --post_title='My Product' --post_status=publish --path=$WP_PATH"

# Set product meta
$SSH "wp post meta set $ID _price 29.99 --path=$WP_PATH"
$SSH "wp post meta set $ID _regular_price 29.99 --path=$WP_PATH"
$SSH "wp post meta set $ID _virtual yes --path=$WP_PATH"
$SSH "wp post meta set $ID _product_type simple --path=$WP_PATH"

# Set product image
$SSH "wp post meta set $ID _thumbnail_id $IMG_ID --path=$WP_PATH"

# List products
$SSH "wp post list --post_type=product --fields=ID,post_title,post_status --path=$WP_PATH"

# WooCommerce settings
$SSH "wp option update woocommerce_enable_coupons yes --path=$WP_PATH"
$SSH "wp option update woocommerce_currency USD --path=$WP_PATH"
```

---

## WooCommerce REST API (Product Bulk Operations)

For MEGA's mass product creation, use WC REST API — faster than WP-CLI for bulk.

```bash
# Auth: WC API key (Admin → WooCommerce → Settings → Advanced → REST API)
WC_KEY="ck_xxx"
WC_SECRET="cs_xxx"

# Create product
curl -s -X POST "$WP_URL/wp-json/wc/v3/products" \
  -u "$WC_KEY:$WC_SECRET" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Custom T-Shirt — Funny Cat Design",
    "type": "variable",
    "status": "publish",
    "description": "Premium quality print-on-demand tee...",
    "short_description": "The funniest cat tee you will ever own.",
    "categories": [{"id": 42}],
    "images": [{"src": "https://...mockup.jpg"}],
    "attributes": [{
      "name": "Size",
      "variation": true,
      "visible": true,
      "options": ["S","M","L","XL","2XL","3XL"]
    }]
  }'

# Batch create (up to 100 at once)
curl -s -X POST "$WP_URL/wp-json/wc/v3/products/batch" \
  -u "$WC_KEY:$WC_SECRET" \
  -H "Content-Type: application/json" \
  -d '{"create": [...]}'
```

---

## Common Tasks

### Change Brand Colors
1. Call `/palette` endpoint with new hex values
2. Purge cache
3. Verify with curl

### Add a New Page
```bash
$SSH "wp post create \
  --post_type=page \
  --post_title='About Us' \
  --post_content='<!-- wp:paragraph --><p>Content here</p><!-- /wp:paragraph -->' \
  --post_status=publish \
  --path=$WP_PATH"
```

### Set Homepage
```bash
$SSH "wp option update show_on_front 'page' --path=$WP_PATH"
$SSH "wp option update page_on_front $PAGE_ID --path=$WP_PATH"
```

### Install a Plugin
```bash
$SSH "wp plugin install slug-name --activate --path=$WP_PATH"
```

### Upload Media
```bash
$SSH "wp media import /tmp/image.jpg --title='Product Image' --path=$WP_PATH"
# Or via URL:
$SSH "wp media import 'https://example.com/image.jpg' --path=$WP_PATH"
```

### Export / Backup
```bash
$SSH "wp db export /tmp/backup-$(date +%Y%m%d).sql --path=$WP_PATH"
```

---

## Hostinger Gotchas

| Issue | Fix |
|-------|-----|
| WP-CLI not in PATH | Use full path: `/usr/local/bin/wp` |
| PHP version | Check: `php -v`. Needs 8.0+. Change in Hostinger panel → Advanced → PHP |
| File permissions | `find $WP_PATH -type f -exec chmod 644 {} \;` `find $WP_PATH -type d -exec chmod 755 {} \;` |
| LiteSpeed not purging | Confirm plugin active: `wp plugin is-active litespeed-cache` |
| SSH key auth failing | Hostinger requires Ed25519 or RSA 4096. Add pub key in panel → SSH Keys |
| Memory limit | Add to wp-config.php: `define('WP_MEMORY_LIMIT', '256M');` |
| Max upload size | `.htaccess`: `php_value upload_max_filesize 64M` `php_value post_max_size 64M` |

---

## MEGA Integration Points

MEGA (mass product generator) talks to WooCommerce via:
1. **WC REST API** — primary path for bulk product creation
2. **WP-CLI** — for system-level ops (media import, bulk meta, DB ops)
3. **MEGA Bridge** — for theme/design changes and real-time feedback

### MEGA → WP Product Flow
```
MEGA generates:
  - Product title + description (SEO optimized)
  - Mockup images (uploaded via wp media import)
  - Variations (size, color)
  - Price matrix
  - Categories + tags

Then pushes via WC REST API batch endpoint → 100 products per call
```

### Bridge Key Storage
Bridge key is stored in wp_options as `mega_bridge_key`.
Retrieve it anytime: `wp option get mega_bridge_key`

---

## Shopify vs MEGA Stack — The Real Math

| Cost | Shopify Basic | MEGA Stack |
|------|--------------|------------|
| Monthly | $39 | $3 (Hostinger) |
| Transaction fee | 2% (no Shopify Payments) or 1% (with) | 0% |
| Reviews app | $15-30/mo | Free (plugin) |
| Coupon/promo | Included (basic) | Free (WooCommerce) |
| Gift cards | $0 (basic) | Free |
| Product limits | Unlimited | Unlimited |
| API access | Limited on Basic | Full WP REST |
| MEGA compatible | ❌ No | ✅ Yes |

At $10K/mo revenue: Shopify takes $100-200/mo in fees alone.
MEGA Stack: $3/mo. Every month. Forever.

---

## Student Intake — Ask These 6 Questions First

Before building anything, ask these in order. Wait for each answer.

```
Q1: What's your store name?
Q2: What's your niche? (be specific — "funny golden retriever shirts" not just "pets")
Q3: Light or dark style?
     DARK → bold/dramatic. Best for: streetwear, gaming, hunting, gym, coffee, edgy niches
     LIGHT → clean/friendly. Best for: pets, baby, home décor, food, florals, inspirational
Q4: Primary brand color? (hex, color name, or "I don't know")
     → If unknown: use navy #1B4F8A (light mode) or orange #FF5500 (dark mode). Works for any niche.
Q5: Do you have a logo? (upload PNG with transparent bg, or skip for text logo)
Q6: Do you have a hero image? (upload, or skip for gradient placeholder)
```

Once you have answers → execute the full build. Do not ask permission between steps.

---

## Palette System — Light vs Dark Mode

Run after `mega-setup.sh`. Set env vars then call `set-palette.php`:

```bash
# Dark mode, student knows their color
ssh $SSH "MEGA_MODE=dark MEGA_PRIMARY='#C62828' MEGA_ACCENT='#8B0000' \
  wp eval-file /tmp/set-palette.php --path=$WP_PATH"

# Light mode, student doesn't know their color (uses navy default)
ssh $SSH "MEGA_MODE=light \
  wp eval-file /tmp/set-palette.php --path=$WP_PATH"

# Always purge after
ssh $SSH "wp litespeed-purge all --path=$WP_PATH"
```

### Color from a name/description
If student says "forest green" or "rose gold" or "I want something that feels like autumn":
- Pick an appropriate hex, explain your choice, apply it
- Don't ask for approval — just do it and tell them what you picked
- They can always say "make it darker" or "try something warmer" to iterate

---

## First-Time Setup

If starting from scratch, run the setup script:
```bash
# On the Hostinger server via SSH:
curl -s https://raw.githubusercontent.com/jonjonesai/mega-stack-skill/main/scripts/mega-setup.sh | bash
```

This installs: Kadence + KadenceBlocks + WooCommerce + LiteSpeed + MEGA Bridge.
Takes ~3 minutes. Outputs your Bridge key at the end.

---

*Skill maintained by BroShark 🦈 | github.com/jonjonesai/mega-stack-skill*

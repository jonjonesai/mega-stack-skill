#!/bin/bash
# =============================================================================
# MEGA Stack Setup Script
# WordPress + Kadence + WooCommerce + MEGA Bridge on Hostinger
# Run this via SSH on a fresh WordPress install.
# =============================================================================
# Usage:
#   bash mega-setup.sh
#
# Prerequisites:
#   - WordPress installed (Hostinger one-click or manual)
#   - SSH access to the server
#   - WP-CLI available (Hostinger has it at /usr/local/bin/wp)
# =============================================================================

set -e

# ── CONFIG ────────────────────────────────────────────────────────────────────
WP_PATH="${WP_PATH:-/home/$(whoami)/domains/$(hostname -f 2>/dev/null || echo 'yourdomain.com')/public_html}"
WP="wp --path=$WP_PATH --allow-root"

MEGA_BRIDGE_URL="https://raw.githubusercontent.com/jonjonesai/mega-agent-bridge/main/mega-agent-bridge.php"
MEGA_BRIDGE_KEY="${MEGA_BRIDGE_KEY:-$(openssl rand -hex 32)}"

# Colors
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

log()    { echo -e "${BLUE}[MEGA]${NC} $1"; }
ok()     { echo -e "${GREEN}[✓]${NC} $1"; }
warn()   { echo -e "${YELLOW}[!]${NC} $1"; }
error()  { echo -e "${RED}[✗]${NC} $1"; exit 1; }

# ── PREFLIGHT ─────────────────────────────────────────────────────────────────
log "MEGA Stack Setup Starting..."
echo ""

# Detect WP path
if [ ! -f "$WP_PATH/wp-config.php" ]; then
  # Try common Hostinger paths
  for path in \
    "/home/$(whoami)/public_html" \
    "/home/$(whoami)/www" \
    "$(find /home/$(whoami)/domains -name 'wp-config.php' -maxdepth 4 2>/dev/null | head -1 | xargs dirname 2>/dev/null)"; do
    if [ -f "$path/wp-config.php" ]; then
      WP_PATH="$path"
      WP="wp --path=$WP_PATH --allow-root"
      break
    fi
  done
fi

[ -f "$WP_PATH/wp-config.php" ] || error "WordPress not found at $WP_PATH. Set WP_PATH=... and re-run."
ok "WordPress found at: $WP_PATH"

# Check WP-CLI
which wp > /dev/null 2>&1 || error "WP-CLI not found. Hostinger should have it at /usr/local/bin/wp"
WP_VERSION=$($WP core version 2>/dev/null)
ok "WP-CLI working. WordPress version: $WP_VERSION"

echo ""
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
log "STEP 1: Installing Kadence Theme"
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Install + activate Kadence theme
if $WP theme is-installed kadence 2>/dev/null; then
  $WP theme update kadence 2>/dev/null && ok "Kadence updated" || ok "Kadence already latest"
else
  $WP theme install kadence --activate
  ok "Kadence installed and activated"
fi

# Activate if not active
ACTIVE_THEME=$($WP theme list --status=active --field=name 2>/dev/null)
if [ "$ACTIVE_THEME" != "kadence" ]; then
  $WP theme activate kadence
  ok "Kadence activated"
fi

echo ""
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
log "STEP 2: Installing Plugins"
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

PLUGINS=(
  "kadence-blocks"              # Kadence Blocks (Gutenberg blocks)
  "woocommerce"                 # WooCommerce
  "litespeed-cache"             # LiteSpeed Cache (Hostinger CDN)
  "woo-variation-swatches"      # Product variation swatches
  "customer-reviews-woocommerce" # Reviews (free alternative to paid)
)

for plugin in "${PLUGINS[@]}"; do
  if $WP plugin is-installed "$plugin" 2>/dev/null; then
    $WP plugin update "$plugin" 2>/dev/null || true
    $WP plugin activate "$plugin" 2>/dev/null || true
    ok "$plugin: active"
  else
    $WP plugin install "$plugin" --activate
    ok "$plugin: installed & activated"
  fi
done

echo ""
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
log "STEP 3: Installing MEGA Agent Bridge + Styles"
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

MU_DIR="$WP_PATH/wp-content/mu-plugins"
mkdir -p "$MU_DIR"

# Download bridge
curl -s "$MEGA_BRIDGE_URL" -o "$MU_DIR/mega-agent-bridge.php"
ok "MEGA Bridge installed as mu-plugin"

# Store the API key as wp option (easy to retrieve later)
$WP option update mega_bridge_key "$MEGA_BRIDGE_KEY" 2>/dev/null || \
  $WP eval "update_option('mega_bridge_key', '$MEGA_BRIDGE_KEY');"
ok "MEGA Bridge API key stored"

# Install mega-styles.php mu-plugin (header branding, mobile trigger, fonts)
MEGA_STYLES_URL="https://raw.githubusercontent.com/jonjonesai/mega-stack-skill/main/scripts/mega-styles.php"
curl -s "$MEGA_STYLES_URL" -o "$MU_DIR/mega-styles.php"
ok "MEGA Styles mu-plugin installed"

# Upload set-palette.php to /tmp for use during setup
curl -s "https://raw.githubusercontent.com/jonjonesai/mega-stack-skill/main/scripts/set-palette.php" -o /tmp/set-palette.php
ok "Palette setter ready at /tmp/set-palette.php"

echo ""
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
log "STEP 4: WooCommerce Base Configuration"
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Set WC pages (creates Shop, Cart, Checkout, My Account if missing)
$WP wc tool run install_pages --user=1 2>/dev/null || true
ok "WooCommerce pages created"

# Sensible WC defaults for POD stores
$WP option update woocommerce_enable_reviews 'yes'
$WP option update woocommerce_enable_review_rating 'yes'
$WP option update woocommerce_review_rating_required 'no'
$WP option update woocommerce_enable_coupons 'yes'
$WP option update woocommerce_calc_taxes 'no'        # Enable manually when needed
$WP option update woocommerce_currency 'USD'
$WP option update woocommerce_price_num_decimals '2'
$WP option update woocommerce_weight_unit 'oz'
$WP option update woocommerce_dimension_unit 'in'

# Product defaults for POD (virtual, no shipping needed)
$WP option update woocommerce_product_type 'simple'

ok "WooCommerce defaults configured"

echo ""
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
log "STEP 5: Kadence Global Settings"
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Apply a clean, POD-store-ready Kadence base config
$WP eval '
$opts = [];

// Layout
$opts["content_width"] = ["size" => 1290, "unit" => "px"];
$opts["content_narrow_width"] = ["size" => 842, "unit" => "px"];

// Buttons — clean modern look
$opts["buttons_border_radius"] = [
  "size" => ["desktop" => 4, "tablet" => "", "mobile" => ""],
  "unit" => ["desktop" => "px", "tablet" => "px", "mobile" => "px"],
];

// Scroll to top
$opts["scroll_up"] = true;
$opts["scroll_up_side"] = "right";

// WooCommerce — product archive
$opts["product_archive_columns"] = 3;
$opts["product_archive_default_view"] = "grid";
$opts["product_archive_image_hover_switch"] = "fade";

// Encode and store
$mods = get_option("theme_mods_kadence", []);
$mods["kadence_theme_options"] = json_encode($opts);
update_option("theme_mods_kadence", $mods);
echo "Kadence settings applied\n";
'

ok "Kadence base settings configured"

echo ""
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
log "STEP 6: LiteSpeed Cache Configuration"
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Configure LiteSpeed for WooCommerce + Kadence
$WP litespeed-option set cache-browser true 2>/dev/null || true
$WP litespeed-option set cache-object true 2>/dev/null || true
$WP litespeed-option set optm-css_min true 2>/dev/null || true
$WP litespeed-option set optm-js_min true 2>/dev/null || true

# WC-aware exclusions (don't cache cart/checkout)
$WP litespeed-option set cache-exc_cookies 'woocommerce_cart_hash,woocommerce_items_in_cart,wp_woocommerce_session' 2>/dev/null || true

ok "LiteSpeed Cache configured for WooCommerce"

echo ""
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
log "STEP 7: Permalinks + Final Flush"
log "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Set pretty permalinks
$WP rewrite structure '/%postname%/' --hard
$WP rewrite flush --hard
ok "Permalinks: /%postname%/"

# Flush everything
$WP cache flush 2>/dev/null || true
$WP litespeed-purge all 2>/dev/null || true
ok "All caches cleared"

# ── SUMMARY ───────────────────────────────────────────────────────────────────
echo ""
echo -e "${GREEN}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${GREEN}  MEGA STACK SETUP COMPLETE  🦈${NC}"
echo -e "${GREEN}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo ""
SITE_URL=$($WP option get siteurl)
echo -e "  Site URL:        ${BLUE}$SITE_URL${NC}"
echo -e "  Bridge Key:      ${YELLOW}$MEGA_BRIDGE_KEY${NC}"
echo -e "  Bridge Endpoint: ${BLUE}$SITE_URL/wp-json/mega-bridge/v1/${NC}"
echo ""
echo -e "  ${YELLOW}⚠  Save your Bridge Key above — you'll need it for Claude.${NC}"
echo ""
echo -e "  Next steps:"
echo -e "  1. Add your bridge key to your Claude environment"
echo -e "  2. Load the mega-stack-skill in Claude"
echo -e "  3. Tell Claude: 'Set up my MEGA store' and let it rip"
echo ""

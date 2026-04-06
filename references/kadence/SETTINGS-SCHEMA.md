# Kadence Theme — Full Settings Schema Reference

Extracted from `inc/components/options/component.php` v3.x (641 total settings keys).
All settings are stored via `theme_mod` under the key `kadence_theme_options` (JSON encoded).

## How Settings Work

```php
// Read a setting
kadence_option( 'buttons_background' );       // returns value or default
kadence_get_option( 'header_sticky' );        // alias

// Write via WP-CLI (what mega-bridge + setup scripts use)
wp eval 'kadence_update_option("buttons_background", ["color"=>"palette1","hover"=>"palette2"]);'

// Or via theme_mods directly:
wp option update theme_mods_kadence '{"kadence_theme_options":"{...json...}"}' --format=json
```

## Global Palette

Kadence uses 9 palette slots (`palette1` – `palette9`) that cascade everywhere.
Instead of hardcoding hex values in settings, you reference `palette1`, `palette2`, etc.

Default palette (light theme):
- `palette1` → primary brand color (default: dark)
- `palette2` → secondary/accent
- `palette3` → heading text
- `palette4` → body text
- `palette5` → subtle text / muted
- `palette6` → borders
- `palette7` → light background elements
- `palette8` → section backgrounds
- `palette9` → white / inverse text

Palette stored as: `theme_mod` key `kadence_global_palette`
```json
{
  "active": "default",
  "palettes": [{
    "slug": "default",
    "palette": [
      {"slug":"palette1","color":"#2B6CB0"},
      {"slug":"palette2","color":"#2C5282"},
      ...
    ]
  }]
}
```

## Settings Groups

### Content Layout
| Key | Type | Default |
|-----|------|---------|
| `content_width` | `{size, unit}` | `{size:1290, unit:"px"}` |
| `content_narrow_width` | `{size, unit}` | `{size:842, unit:"px"}` |
| `content_edge_spacing` | responsive spacing | `1.5rem desktop` |
| `content_spacing` | responsive spacing | `2/3/5rem m/t/d` |
| `site_background` | background object | `palette8` |
| `content_background` | background object | `palette9` |

### Buttons (3 styles: primary, secondary, outline)
| Key | Example Value |
|-----|--------------|
| `buttons_color` | `{color:"palette9", hover:"palette9"}` |
| `buttons_background` | `{color:"palette1", hover:"palette2"}` |
| `buttons_border_radius` | `{size:{desktop:""}, unit:{desktop:"px"}}` |
| `buttons_typography` | `{size:{desktop:""}, family:"inherit", weight:""}` |
| `buttons_padding` | `{size:{desktop:["","","",""]}, unit:{desktop:"px"}}` |

### Typography
All typography settings follow this shape:
```json
{
  "size": {"desktop": 20, "tablet": "", "mobile": ""},
  "lineHeight": {"desktop": 1.5},
  "family": "inherit",        // or Google font name
  "google": false,            // true if Google font
  "weight": "700",
  "variant": "700",
  "color": "palette3"
}
```
Keys: `base_font`, `heading_font`, `h1_font`–`h6_font`, `brand_typography`

### Header (118 settings)
Key structure: `header_{row}_{property}`
- Rows: `top`, `main`, `bottom`, `sticky`
- Properties: `height`, `layout`, `background`, `padding`, `top_border`, `bottom_border`

Header builder items (what goes in each slot):
```
header_desktop_items → {top:{left:[],center:[],right:[]}, main:{...}, bottom:{...}}
header_mobile_items  → same structure
```
Available items: `logo`, `navigation`, `button`, `social`, `search`, `html`, `widget`, `cart`

### Navigation
| Key | Options |
|-----|---------|
| `primary_navigation_style` | `standard`, `underline`, `highlight`, `fullheight` |
| `primary_navigation_color` | `{color:"", hover:"", active:"", background:"", ...}` |
| `dropdown_navigation_reveal` | `hover`, `click` |

### WooCommerce (product settings)
| Key | Default |
|-----|---------|
| `product_archive_default_view` | `grid` |
| `product_archive_mobile_columns` | `default` |
| `product_archive_columns` | `3` |
| `product_archive_image_hover_switch` | `none`/`flip`/`fade`/`slider` |
| `product_title_layout` | `above`/`normal` |
| `product_content_style` | `boxed`/`unboxed` |

### Footer (95 settings)
Structure mirrors header: `footer_{row}_{property}`
Rows: `top`, `middle`, `bottom`

### Hooks — Extensible Points
Kadence fires 247 custom hooks. Most useful for MEGA integration:
```php
do_action( 'kadence_before_main_content' )
do_action( 'kadence_after_main_content' )
do_action( 'kadence_hero_header' )
do_action( 'kadence_woocommerce_before_shop_loop_top_row' )
do_action( 'kadence_woocommerce_after_shop_loop_top_row' )
apply_filters( 'kadence_post_layout', $layout )
apply_filters( 'kadence_dynamic_css', $css )
apply_filters( 'kadence_theme_options_defaults', $defaults )  // Override any default
```

## WP-CLI Cheat Sheet for Kadence Settings

```bash
# Read current palette
wp eval 'print_r(get_theme_mod("kadence_global_palette"));'

# Read a specific setting
wp eval 'print_r(kadence_option("buttons_background"));'

# Update palette color
wp eval '
$palette = get_theme_mod("kadence_global_palette", []);
$palette["palettes"][0]["palette"][0]["color"] = "#FF6B35";
set_theme_mod("kadence_global_palette", $palette);
'

# Bulk update settings via JSON
wp eval '
$mods = get_option("theme_mods_kadence", []);
$opts = json_decode($mods["kadence_theme_options"] ?? "{}", true);
$opts["buttons_border_radius"] = ["size"=>["desktop"=>8],"unit"=>["desktop"=>"px"]];
$mods["kadence_theme_options"] = json_encode($opts);
update_option("theme_mods_kadence", $mods);
'

# Then ALWAYS purge cache after any settings change:
wp litespeed-purge all
```

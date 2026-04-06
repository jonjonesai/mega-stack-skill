<?php
/**
 * MEGA Palette Setter
 * Usage: wp eval-file set-palette.php --path=$WP_PATH
 *
 * Set env vars before running:
 *   MEGA_MODE=dark|light
 *   MEGA_PRIMARY=#HEX    (optional, defaults by mode)
 *   MEGA_ACCENT=#HEX     (optional, defaults by mode)
 */

// ── INPUTS ────────────────────────────────────────────────────────────────────
$mode    = strtolower( getenv( 'MEGA_MODE' ) ?: 'dark' );   // dark | light
$primary = getenv( 'MEGA_PRIMARY' ) ?: null;                 // e.g. #FF5500
$accent  = getenv( 'MEGA_ACCENT' )  ?: null;                 // e.g. #E04A00

// ── DEFAULT COLORS BY MODE ────────────────────────────────────────────────────
// If student says "I don't know" → deep navy + orange. Works for any niche.
// Navy feels serious/premium. Orange CTA pops on both light and dark.
$defaults = [
    'dark' => [
        'primary' => '#FF5500',  // orange CTA — visible on dark
        'accent'  => '#E04A00',  // deep orange hover
    ],
    'light' => [
        'primary' => '#1B4F8A',  // deep navy CTA — visible on light
        'accent'  => '#163F6E',  // darker navy hover
    ],
];

$primary = $primary ?: $defaults[ $mode ]['primary'];
$accent  = $accent  ?: $defaults[ $mode ]['accent'];

// ── PALETTE DEFINITIONS ────────────────────────────────────────────────────────
// MEGA Palette System:
// palette1 = PRIMARY CTA      → buttons, stat numbers, accents
// palette2 = CTA HOVER        → hover states
// palette3 = HEADINGS         → h1-h6 color
// palette4 = BODY TEXT        → paragraph color
// palette5 = MUTED TEXT       → captions, meta, secondary text
// palette6 = BORDERS          → dividers, input borders
// palette7 = LIGHT SURFACE    → stats row bg, trust row bg
// palette8 = PAGE BACKGROUND  → overall page bg
// palette9 = PURE WHITE       → text on dark, button labels

$palettes = [
    'dark' => [
        // Dark mode: page is dark, content pops with light text + orange CTA
        [ 'slug' => 'palette1', 'color' => $primary,  'name' => 'Primary CTA'     ],
        [ 'slug' => 'palette2', 'color' => $accent,   'name' => 'CTA Hover'       ],
        [ 'slug' => 'palette3', 'color' => '#FFFFFF',  'name' => 'Headings'        ],
        [ 'slug' => 'palette4', 'color' => '#E0E0E0',  'name' => 'Body Text'       ],
        [ 'slug' => 'palette5', 'color' => '#999999',  'name' => 'Muted Text'      ],
        [ 'slug' => 'palette6', 'color' => '#333333',  'name' => 'Borders'         ],
        [ 'slug' => 'palette7', 'color' => '#1A1A1A',  'name' => 'Light Surface'   ],
        [ 'slug' => 'palette8', 'color' => '#0A0A0A',  'name' => 'Page Background' ],
        [ 'slug' => 'palette9', 'color' => '#FFFFFF',  'name' => 'Pure White'      ],
    ],
    'light' => [
        // Light mode: page is white/light, dark text, navy/color CTA
        [ 'slug' => 'palette1', 'color' => $primary,  'name' => 'Primary CTA'     ],
        [ 'slug' => 'palette2', 'color' => $accent,   'name' => 'CTA Hover'       ],
        [ 'slug' => 'palette3', 'color' => '#0A0A0A',  'name' => 'Headings'        ],
        [ 'slug' => 'palette4', 'color' => '#2D2D2D',  'name' => 'Body Text'       ],
        [ 'slug' => 'palette5', 'color' => '#6B6B6B',  'name' => 'Muted Text'      ],
        [ 'slug' => 'palette6', 'color' => '#E0E0E0',  'name' => 'Borders'         ],
        [ 'slug' => 'palette7', 'color' => '#F5F5F5',  'name' => 'Light Surface'   ],
        [ 'slug' => 'palette8', 'color' => '#FAFAFA',  'name' => 'Page Background' ],
        [ 'slug' => 'palette9', 'color' => '#FFFFFF',  'name' => 'Pure White'      ],
    ],
];

$palette_data = $palettes[ $mode ] ?? $palettes['dark'];

// ── APPLY TO KADENCE ──────────────────────────────────────────────────────────
update_option( 'kadence_global_palette', wp_json_encode( [
    'active'  => 'palette',
    'palette' => $palette_data,
] ) );

// Update button colors to match mode
$mods = get_option( 'theme_mods_kadence', [] );
$opts = json_decode( $mods['kadence_theme_options'] ?? '{}', true );

// Buttons: CTA color, white text
$opts['buttons_background']   = [ 'color' => 'palette1', 'hover' => 'palette2' ];
$opts['buttons_color']        = [ 'color' => 'palette9', 'hover' => 'palette9' ];

// Nav: appropriate text color for mode
$opts['primary_navigation_color'] = [
    'color'  => 'palette4',
    'hover'  => 'palette1',
    'active' => 'palette1',
];

// Header background: dark header in dark mode, white in light mode
$opts['header_main_background'] = [
    'desktop' => [ 'color' => $mode === 'dark' ? 'palette8' : 'palette9' ]
];

// Mobile trigger: always primary color so it's always visible
$opts['mobile_trigger_color']      = [ 'color' => 'palette9', 'background' => 'palette1' ];
$opts['mobile_trigger_background'] = [ 'color' => 'palette1', 'hover' => 'palette2' ];

$mods['kadence_theme_options'] = wp_json_encode( $opts );
update_option( 'theme_mods_kadence', $mods );

// ── FLUSH ─────────────────────────────────────────────────────────────────────
delete_option( 'kadence_gutenberg_block_css' );
delete_option( 'kadence_gutenberg_global_block_css' );
global $wpdb;
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '%kadence%css%'" );
wp_cache_flush();

// ── REPORT ────────────────────────────────────────────────────────────────────
echo "\nMEGA Palette Applied\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "  Mode:    " . strtoupper( $mode ) . "\n";
echo "  Primary: $primary\n";
echo "  Accent:  $accent\n";
echo "\n  Slots:\n";
foreach ( $palette_data as $s ) {
    echo "  " . $s['slug'] . " → " . $s['color'] . " (" . $s['name'] . ")\n";
}
echo "\n  Run: wp litespeed-purge all\n";

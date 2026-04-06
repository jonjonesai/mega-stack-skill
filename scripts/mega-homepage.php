<?php
/**
 * MEGA Stack Homepage — Built with Kadence Blocks
 * kadence/rowlayout, kadence/column, kadence/advancedheading,
 * kadence/advancedbtn, kadence/singlebtn, kadence/infobox
 *
 * Run via: wp eval-file mega-homepage.php --path=$WP_PATH
 */

$store_name = get_bloginfo( 'name' ) ?: 'My Store';
$shop_url   = get_permalink( wc_get_page_id( 'shop' ) ) ?: '/shop/';

function mega_uid() {
	return substr( md5( uniqid( mt_rand(), true ) ), 0, 6 );
}

// Pre-generate all UIDs
$h_row    = mega_uid(); // hero row
$h_col    = mega_uid(); // hero column
$h_head1  = mega_uid(); // hero eyebrow
$h_head2  = mega_uid(); // hero h1
$h_sub    = mega_uid(); // hero subheading
$h_btns   = mega_uid(); // hero button group
$h_btn1   = mega_uid(); // hero btn 1
$h_btn2   = mega_uid(); // hero btn 2

$s_row    = mega_uid(); // stats row
$s_c1     = mega_uid(); $s_c2 = mega_uid(); $s_c3 = mega_uid(); $s_c4 = mega_uid();
$s_h1     = mega_uid(); $s_h2 = mega_uid(); $s_h3 = mega_uid(); $s_h4 = mega_uid();
$s_l1     = mega_uid(); $s_l2 = mega_uid(); $s_l3 = mega_uid(); $s_l4 = mega_uid();

$n_row    = mega_uid(); // niche row
$n_head   = mega_uid(); $n_sub = mega_uid();
$n_c1     = mega_uid(); $n_c2 = mega_uid(); $n_c3 = mega_uid();
$n_h1     = mega_uid(); $n_h2 = mega_uid(); $n_h3 = mega_uid();
$n_p1     = mega_uid(); $n_p2 = mega_uid(); $n_p3 = mega_uid();

$t_row    = mega_uid(); // trust row
$t_c1     = mega_uid(); $t_c2 = mega_uid(); $t_c3 = mega_uid(); $t_c4 = mega_uid();
$t_ib1    = mega_uid(); $t_ib2 = mega_uid(); $t_ib3 = mega_uid(); $t_ib4 = mega_uid();

$cta_row  = mega_uid(); // CTA row
$cta_col  = mega_uid();
$cta_head = mega_uid();
$cta_sub  = mega_uid();
$cta_btns = mega_uid();
$cta_btn  = mega_uid();

// ─────────────────────────────────────────────────────────────────────────────
//  SECTION 1: HERO
//  kadence/rowlayout → kadence/column → advancedheading × 3 + advancedbtn
// ─────────────────────────────────────────────────────────────────────────────
$content = <<<BLOCKS
<!-- wp:kadence/rowlayout {"uniqueID":"{$h_row}","columns":1,"colLayout":"equal","align":"full","minHeight":100,"minHeightUnit":"vh","verticalAlignment":"middle","topPadding":50,"bottomPadding":50,"bgColor":"palette8","overlay":"#000000","overlayOpacity":65} -->
<div class="wp-block-kadence-rowlayout alignfull kb-row-layout-id{$h_row} kb-layout-columns-1" style="min-height:100vh">
<!-- wp:kadence/column {"id":1,"uniqueID":"{$h_col}","textAlign":["center","center","center"]} -->
<div class="wp-block-kadence-column kadence-column{$h_col} inner-column-1">
<div class="kt-inside-inner-col">

<!-- wp:kadence/advancedheading {"uniqueID":"{$h_head1}","level":6,"size":13,"sizeType":"px","color":"palette1","align":"center","textTransform":"uppercase","letterSpacing":4,"fontWeight":"600","markBorder":"","markBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"tabSize":13,"mobileSize":13} -->
<p class="wp-block-kadence-advancedheading kt-adv-heading{$h_head1} kt-adv-heading" style="color:var(--global-palette1);font-size:13px;letter-spacing:4px;font-weight:600;text-transform:uppercase;text-align:center">Print-On-Demand, Reimagined</p>
<!-- /wp:kadence/advancedheading -->

<!-- wp:kadence/advancedheading {"uniqueID":"{$h_head2}","level":1,"size":72,"tabSize":52,"mobileSize":40,"sizeType":"px","color":"#ffffff","align":"center","lineHeight":[1.05,1.05,1.05],"lineType":"em","letterSpacing":-1,"fontWeight":"900","textTransform":"none","topMargin":24,"bottomMargin":24} -->
<h1 class="wp-block-kadence-advancedheading kt-adv-heading{$h_head2} kt-adv-heading" style="color:#ffffff;font-size:72px;font-weight:900;line-height:1.05em;letter-spacing:-1px;text-align:center;margin-top:24px;margin-bottom:24px">Your Niche.<br>45 Products.<br>Done.</h1>
<!-- /wp:kadence/advancedheading -->

<!-- wp:kadence/advancedheading {"uniqueID":"{$h_sub}","level":6,"size":18,"tabSize":16,"mobileSize":15,"sizeType":"px","color":"#ffffffd4","align":"center","lineHeight":[1.7,1.7,1.7],"lineType":"em","fontWeight":"400","bottomMargin":40} -->
<p class="wp-block-kadence-advancedheading kt-adv-heading{$h_sub} kt-adv-heading" style="color:rgba(255,255,255,0.83);font-size:18px;font-weight:400;line-height:1.7em;text-align:center;margin-bottom:40px">One design. Hundreds of products, fully SEO-optimized<br>and live in minutes — not weeks.</p>
<!-- /wp:kadence/advancedheading -->

<!-- wp:kadence/advancedbtn {"uniqueID":"{$h_btns}","hAlign":"center","btnCount":2,"btns":[{"text":"Shop Now →","link":"{$shop_url}","target":"_self","size":"","paddingBT":16,"paddingLR":40,"color":"#ffffff","background":"palette1","border":"palette1","backgroundOpacity":1,"borderRadius":4,"colorHover":"#ffffff","backgroundHover":"palette2","borderHover":"palette2","borderStyle":"","btnStyle":"basic","fontWeight":"700","sizeType":"px","fontSize":"18"},{"text":"See What's Inside","link":"#niche-row","target":"_self","size":"","paddingBT":14,"paddingLR":32,"color":"rgba(255,255,255,0.88)","background":"transparent","border":"rgba(255,255,255,0.5)","backgroundOpacity":0,"borderRadius":4,"colorHover":"#ffffff","backgroundHover":"transparent","borderHover":"rgba(255,255,255,0.9)","borderStyle":"solid","borderWidth":"2","btnStyle":"basic","fontWeight":"600","sizeType":"px","fontSize":"16"}],"gap":16} -->
<div class="wp-block-kadence-advancedbtn kt-btn-align-center kt-btn-item-align-center">
<!-- wp:kadence/singlebtn {"uniqueID":"{$h_btn1}","text":"Shop Now →","link":"{$shop_url}","paddingBT":16,"paddingLR":40,"color":"#ffffff","background":"palette1","border":"palette1","borderRadius":4,"colorHover":"#ffffff","backgroundHover":"palette2","borderHover":"palette2","fontWeight":"700","fontSize":18,"sizeType":"px"} -->
<div class="wp-block-kadence-singlebtn kt-btn-wrap-{$h_btn1}"><a href="{$shop_url}" class="kt-button button-size-standard kt-btn-{$h_btn1}" style="border-radius:4px;font-weight:700;font-size:18px;padding:16px 40px;background:var(--global-palette1);color:#ffffff;border-color:var(--global-palette1)">Shop Now →</a></div>
<!-- /wp:kadence/singlebtn -->
<!-- wp:kadence/singlebtn {"uniqueID":"{$h_btn2}","text":"See What's Inside","link":"#niche-row","paddingBT":14,"paddingLR":32,"color":"rgba(255,255,255,0.88)","background":"transparent","border":"rgba(255,255,255,0.5)","borderRadius":4,"colorHover":"#ffffff","backgroundHover":"transparent","borderHover":"rgba(255,255,255,0.9)","fontWeight":"600","fontSize":16,"sizeType":"px"} -->
<div class="wp-block-kadence-singlebtn kt-btn-wrap-{$h_btn2}"><a href="#niche-row" class="kt-button button-size-standard kt-btn-{$h_btn2}" style="border-radius:4px;font-weight:600;font-size:16px;padding:14px 32px;background:transparent;color:rgba(255,255,255,0.88);border:2px solid rgba(255,255,255,0.5)">See What's Inside</a></div>
<!-- /wp:kadence/singlebtn -->
</div>
<!-- /wp:kadence/advancedbtn -->

</div>
</div>
<!-- /wp:kadence/column -->
</div>
<!-- /wp:kadence/rowlayout -->


BLOCKS;

// ─────────────────────────────────────────────────────────────────────────────
//  SECTION 2: STATS ROW — 4 columns
// ─────────────────────────────────────────────────────────────────────────────

$stats = [
	[ 'uid_col' => $s_c1, 'uid_num' => $s_h1, 'uid_lbl' => $s_l1, 'num' => '45+',  'label' => 'Product Types' ],
	[ 'uid_col' => $s_c2, 'uid_num' => $s_h2, 'uid_lbl' => $s_l2, 'num' => '7 Min', 'label' => 'Idea to Live'  ],
	[ 'uid_col' => $s_c3, 'uid_num' => $s_h3, 'uid_lbl' => $s_l3, 'num' => '100%',  'label' => 'SEO Ready'     ],
	[ 'uid_col' => $s_c4, 'uid_num' => $s_h4, 'uid_lbl' => $s_l4, 'num' => 'Zero',  'label' => 'Grind'         ],
];

$content .= <<<BLOCK
<!-- wp:kadence/rowlayout {"uniqueID":"{$s_row}","columns":4,"colLayout":"equal","align":"full","topPadding":60,"bottomPadding":60,"bgColor":"palette7","tabletColumns":2,"mobileColumns":2} -->
<div class="wp-block-kadence-rowlayout alignfull kb-row-layout-id{$s_row} kb-layout-columns-4" style="background-color:var(--global-palette7)">

BLOCK;

foreach ( $stats as $i => $s ) {
	$content .= <<<BLOCK
<!-- wp:kadence/column {"id":{$i},"uniqueID":"{$s['uid_col']}","textAlign":["center","center","center"]} -->
<div class="wp-block-kadence-column kadence-column{$s['uid_col']} inner-column-{$i}">
<div class="kt-inside-inner-col">
<!-- wp:kadence/advancedheading {"uniqueID":"{$s['uid_num']}","level":2,"size":56,"sizeType":"px","color":"palette1","align":"center","fontWeight":"900","lineHeight":[1,1,1],"lineType":"em","textTransform":"none"} -->
<h2 class="wp-block-kadence-advancedheading kt-adv-heading{$s['uid_num']}" style="color:var(--global-palette1);font-size:56px;font-weight:900;line-height:1em;text-align:center">{$s['num']}</h2>
<!-- /wp:kadence/advancedheading -->
<!-- wp:kadence/advancedheading {"uniqueID":"{$s['uid_lbl']}","level":6,"size":12,"sizeType":"px","color":"palette4","align":"center","fontWeight":"700","textTransform":"uppercase","letterSpacing":1,"topMargin":8} -->
<p class="wp-block-kadence-advancedheading kt-adv-heading{$s['uid_lbl']}" style="color:var(--global-palette4);font-size:12px;font-weight:700;letter-spacing:1px;text-transform:uppercase;text-align:center;margin-top:8px">{$s['label']}</p>
<!-- /wp:kadence/advancedheading -->
</div>
</div>
<!-- /wp:kadence/column -->

BLOCK;
}

$content .= <<<BLOCK
</div>
<!-- /wp:kadence/rowlayout -->


BLOCK;

// ─────────────────────────────────────────────────────────────────────────────
//  SECTION 3: NICHE IMAGERY — intro heading + 3 image columns
// ─────────────────────────────────────────────────────────────────────────────

$niche_images = [
	[ 'uid_col' => $n_c1, 'uid_h' => $n_h1, 'uid_p' => $n_p1, 'seed' => 'mega-apparel',   'title' => 'Apparel',   'sub' => 'Tees • Hoodies • Hats'          ],
	[ 'uid_col' => $n_c2, 'uid_h' => $n_h2, 'uid_p' => $n_p2, 'seed' => 'mega-drinkware',  'title' => 'Drinkware', 'sub' => 'Mugs • Tumblers • Water Bottles' ],
	[ 'uid_col' => $n_c3, 'uid_h' => $n_h3, 'uid_p' => $n_p3, 'seed' => 'mega-wallart',    'title' => 'Wall Art',  'sub' => 'Posters • Canvas • Framed Prints' ],
];

$content .= <<<BLOCK
<!-- wp:kadence/rowlayout {"uniqueID":"{$n_row}","columns":1,"colLayout":"equal","align":"full","topPadding":80,"bottomPadding":80,"bgColor":"palette8","anchor":"niche-row"} -->
<div class="wp-block-kadence-rowlayout alignfull kb-row-layout-id{$n_row} kb-layout-columns-1" id="niche-row" style="background-color:var(--global-palette8)">
<!-- wp:kadence/column {"id":1,"uniqueID":"{$n_head}"} -->
<div class="wp-block-kadence-column kadence-column{$n_head} inner-column-1">
<div class="kt-inside-inner-col">

<!-- wp:kadence/advancedheading {"uniqueID":"{$n_head}x","level":2,"size":40,"tabSize":32,"mobileSize":28,"sizeType":"px","color":"palette3","align":"center","fontWeight":"800","letterSpacing":-0.5,"bottomMargin":12} -->
<h2 class="wp-block-kadence-advancedheading kt-adv-heading{$n_head}x" style="color:var(--global-palette3);font-size:40px;font-weight:800;letter-spacing:-0.5px;text-align:center;margin-bottom:12px">Something for Every Niche</h2>
<!-- /wp:kadence/advancedheading -->

<!-- wp:kadence/advancedheading {"uniqueID":"{$n_sub}","level":6,"size":17,"sizeType":"px","color":"palette1","align":"center","fontWeight":"600","bottomMargin":48} -->
<p class="wp-block-kadence-advancedheading kt-adv-heading{$n_sub}" style="color:var(--global-palette1);font-size:17px;font-weight:600;text-align:center;margin-bottom:48px">T-shirts &bull; Hoodies &bull; Mugs &bull; Wall Art &bull; Hats &bull; Drinkware &bull; Mouse Pads &amp; more</p>
<!-- /wp:kadence/advancedheading -->

<!-- wp:kadence/rowlayout {"uniqueID":"{$n_row}i","columns":3,"colLayout":"equal","columnGutter":"md","tabletColumns":1,"mobileColumns":1} -->
<div class="wp-block-kadence-rowlayout kb-row-layout-id{$n_row}i kb-layout-columns-3">

BLOCK;

foreach ( $niche_images as $i => $img ) {
	$img_url = "https://picsum.photos/seed/{$img['seed']}/600/700";
	$content .= <<<BLOCK
<!-- wp:kadence/column {"id":{$i},"uniqueID":"{$img['uid_col']}","bgImg":"{$img_url}","bgImgSize":"cover","bgImgPosition":"center center","bgImgRepeat":"no-repeat","overlay":"#000000","overlayOpacity":35,"borderRadius":[8,8,8,8],"minHeight":380,"minHeightUnit":"px","verticalAlignment":"middle","textAlign":["center","center","center"]} -->
<div class="wp-block-kadence-column kadence-column{$img['uid_col']} inner-column-{$i}" style="min-height:380px;border-radius:8px;background-image:url('{$img_url}');background-size:cover;background-position:center center">
<div class="kt-inside-inner-col">
<!-- wp:kadence/advancedheading {"uniqueID":"{$img['uid_h']}","level":3,"size":32,"sizeType":"px","color":"#ffffff","align":"center","fontWeight":"800","textTransform":"uppercase","letterSpacing":1} -->
<h3 class="wp-block-kadence-advancedheading kt-adv-heading{$img['uid_h']}" style="color:#ffffff;font-size:32px;font-weight:800;letter-spacing:1px;text-transform:uppercase;text-align:center">{$img['title']}</h3>
<!-- /wp:kadence/advancedheading -->
<!-- wp:kadence/advancedheading {"uniqueID":"{$img['uid_p']}","level":6,"size":16,"sizeType":"px","color":"rgba(255,255,255,0.9)","align":"center","fontWeight":"500","topMargin":8} -->
<p class="wp-block-kadence-advancedheading kt-adv-heading{$img['uid_p']}" style="color:rgba(255,255,255,0.9);font-size:16px;font-weight:500;text-align:center;margin-top:8px">{$img['sub']}</p>
<!-- /wp:kadence/advancedheading -->
</div>
</div>
<!-- /wp:kadence/column -->

BLOCK;
}

$content .= <<<BLOCK
</div>
<!-- /wp:kadence/rowlayout -->

</div>
</div>
<!-- /wp:kadence/column -->
</div>
<!-- /wp:kadence/rowlayout -->


BLOCK;

// ─────────────────────────────────────────────────────────────────────────────
//  SECTION 4: TRUST ROW — 4 kadence/infobox blocks
// ─────────────────────────────────────────────────────────────────────────────

$trust = [
	[ 'uid_col' => $t_c1, 'uid_ib' => $t_ib1, 'icon' => 'fas_shipping-fast', 'title' => 'FREE SHIPPING',          'text' => 'On all orders over $50'          ],
	[ 'uid_col' => $t_c2, 'uid_ib' => $t_ib2, 'icon' => 'fas_star',           'title' => 'SATISFACTION GUARANTEED', 'text' => 'Love it or your money back'       ],
	[ 'uid_col' => $t_c3, 'uid_ib' => $t_ib3, 'icon' => 'fas_paint-brush',    'title' => 'UNIQUE DESIGNS',          'text' => 'You won\'t find these anywhere else' ],
	[ 'uid_col' => $t_c4, 'uid_ib' => $t_ib4, 'icon' => 'fas_bolt',           'title' => 'FAST PRODUCTION',         'text' => 'Ships within 3–5 business days'   ],
];

$content .= <<<BLOCK
<!-- wp:kadence/rowlayout {"uniqueID":"{$t_row}","columns":4,"colLayout":"equal","align":"full","topPadding":70,"bottomPadding":70,"bgColor":"palette7","tabletColumns":2,"mobileColumns":1} -->
<div class="wp-block-kadence-rowlayout alignfull kb-row-layout-id{$t_row} kb-layout-columns-4" style="background-color:var(--global-palette7)">

BLOCK;

foreach ( $trust as $i => $tr ) {
	$icon_json    = json_encode( [ [ 'icon' => $tr['icon'], 'size' => 52, 'color' => 'palette1' ] ] );
	$title_json   = json_encode( [ [ 'size' => [ 22, '', '' ], 'sizeType' => 'px', 'weight' => '800', 'textTransform' => 'uppercase', 'letterSpacing' => 1 ] ] );
	$content .= <<<BLOCK
<!-- wp:kadence/column {"id":{$i},"uniqueID":"{$tr['uid_col']}","textAlign":["center","center","center"]} -->
<div class="wp-block-kadence-column kadence-column{$tr['uid_col']} inner-column-{$i}">
<div class="kt-inside-inner-col">
<!-- wp:kadence/infobox {"uniqueID":"{$tr['uid_ib']}","hAlign":"center","mediaType":"icon","mediaIcon":{$icon_json},"title":"{$tr['title']}","titleFont":{$title_json},"titleColor":"palette3","contentText":"{$tr['text']}","textColor":"palette5","containerPadding":["lg","lg","lg","lg"]} -->
<div class="wp-block-kadence-infobox kt-blocks-info-box-link-wrap kt-blocks-info-box-media-align-top has-text-align-center">
<div class="kt-blocks-info-box-media-container"><div class="kt-blocks-info-box-media kt-info-icon-animate-none"><div class="kt-icon-style-default"><span class="kt-svg-icon-list-single"><svg aria-hidden="true"></svg></span></div></div></div>
<div class="kt-infobox-textcontent">
<h3 class="kt-blocks-info-box-title" style="color:var(--global-palette3);font-size:22px;font-weight:800;letter-spacing:1px;text-transform:uppercase">{$tr['title']}</h3>
<p class="kt-blocks-info-box-text" style="color:var(--global-palette5);font-size:17px">{$tr['text']}</p>
</div>
</div>
<!-- /wp:kadence/infobox -->
</div>
</div>
<!-- /wp:kadence/column -->

BLOCK;
}

$content .= <<<BLOCK
</div>
<!-- /wp:kadence/rowlayout -->


BLOCK;

// ─────────────────────────────────────────────────────────────────────────────
//  SECTION 5: FINAL CTA
// ─────────────────────────────────────────────────────────────────────────────

$content .= <<<BLOCK
<!-- wp:kadence/rowlayout {"uniqueID":"{$cta_row}","columns":1,"colLayout":"equal","align":"full","topPadding":100,"bottomPadding":100,"bgColor":"palette1"} -->
<div class="wp-block-kadence-rowlayout alignfull kb-row-layout-id{$cta_row} kb-layout-columns-1" style="background-color:var(--global-palette1)">
<!-- wp:kadence/column {"id":1,"uniqueID":"{$cta_col}","textAlign":["center","center","center"]} -->
<div class="wp-block-kadence-column kadence-column{$cta_col} inner-column-1">
<div class="kt-inside-inner-col">

<!-- wp:kadence/advancedheading {"uniqueID":"{$cta_head}","level":2,"size":42,"tabSize":34,"mobileSize":28,"sizeType":"px","color":"#ffffff","align":"center","fontWeight":"800","lineHeight":[1.2,1.2,1.2],"lineType":"em","bottomMargin":16} -->
<h2 class="wp-block-kadence-advancedheading kt-adv-heading{$cta_head}" style="color:#ffffff;font-size:42px;font-weight:800;line-height:1.2em;text-align:center;margin-bottom:16px">Ready to find something<br>you'll actually love?</h2>
<!-- /wp:kadence/advancedheading -->

<!-- wp:kadence/advancedheading {"uniqueID":"{$cta_sub}","level":6,"size":17,"sizeType":"px","color":"rgba(255,255,255,0.85)","align":"center","fontWeight":"400","bottomMargin":40} -->
<p class="wp-block-kadence-advancedheading kt-adv-heading{$cta_sub}" style="color:rgba(255,255,255,0.85);font-size:17px;font-weight:400;text-align:center;margin-bottom:40px">Browse our full collection — every product ships ready to gift.</p>
<!-- /wp:kadence/advancedheading -->

<!-- wp:kadence/advancedbtn {"uniqueID":"{$cta_btns}","hAlign":"center","btnCount":1,"btns":[{"text":"Browse All Products →","link":"{$shop_url}","target":"_self","paddingBT":18,"paddingLR":48,"color":"palette1","background":"#ffffff","border":"#ffffff","backgroundOpacity":1,"borderRadius":4,"colorHover":"#ffffff","backgroundHover":"transparent","borderHover":"#ffffff","borderStyle":"solid","borderWidth":"2","btnStyle":"basic","fontWeight":"700","sizeType":"px","fontSize":"18"}]} -->
<div class="wp-block-kadence-advancedbtn kt-btn-align-center kt-btn-item-align-center">
<!-- wp:kadence/singlebtn {"uniqueID":"{$cta_btn}","text":"Browse All Products →","link":"{$shop_url}","paddingBT":18,"paddingLR":48,"color":"palette1","background":"#ffffff","border":"#ffffff","borderRadius":4,"colorHover":"#ffffff","backgroundHover":"transparent","borderHover":"#ffffff","fontWeight":"700","fontSize":18,"sizeType":"px"} -->
<div class="wp-block-kadence-singlebtn kt-btn-wrap-{$cta_btn}"><a href="{$shop_url}" class="kt-button button-size-standard kt-btn-{$cta_btn}" style="border-radius:4px;font-weight:700;font-size:18px;padding:18px 48px;background:#ffffff;color:var(--global-palette1);border:2px solid #ffffff">Browse All Products →</a></div>
<!-- /wp:kadence/singlebtn -->
</div>
<!-- /wp:kadence/advancedbtn -->

</div>
</div>
<!-- /wp:kadence/column -->
</div>
<!-- /wp:kadence/rowlayout -->
BLOCK;

// ─────────────────────────────────────────────────────────────────────────────
//  MEGA STANDARD PALETTE (correct Kadence format)
// ─────────────────────────────────────────────────────────────────────────────
update_option( 'kadence_global_palette', wp_json_encode( [
	'active'  => 'palette',
	'palette' => [
		[ 'slug' => 'palette1', 'color' => '#FF5500', 'name' => 'Primary CTA'     ],
		[ 'slug' => 'palette2', 'color' => '#E04A00', 'name' => 'CTA Hover'       ],
		[ 'slug' => 'palette3', 'color' => '#0A0A0A', 'name' => 'Headings'        ],
		[ 'slug' => 'palette4', 'color' => '#2D2D2D', 'name' => 'Body Text'       ],
		[ 'slug' => 'palette5', 'color' => '#6B6B6B', 'name' => 'Muted Text'      ],
		[ 'slug' => 'palette6', 'color' => '#E0E0E0', 'name' => 'Borders'         ],
		[ 'slug' => 'palette7', 'color' => '#F5F5F5', 'name' => 'Light Surface'   ],
		[ 'slug' => 'palette8', 'color' => '#FAFAFA', 'name' => 'Page Background' ],
		[ 'slug' => 'palette9', 'color' => '#FFFFFF', 'name' => 'Pure White'      ],
	],
] ) );

// ─────────────────────────────────────────────────────────────────────────────
//  KADENCE THEME OPTIONS
// ─────────────────────────────────────────────────────────────────────────────
$mods = get_option( 'theme_mods_kadence', [] );
$opts = json_decode( $mods['kadence_theme_options'] ?? '{}', true );

$opts['header_main_height']     = [ 'size' => [ 'desktop' => 68, 'tablet' => 60, 'mobile' => 51 ], 'unit' => [ 'desktop' => 'px', 'tablet' => 'px', 'mobile' => 'px' ] ];
$opts['header_main_background'] = [ 'desktop' => [ 'color' => 'palette9' ] ];
$opts['header_main_bottom_border'] = [ [ 'width' => 1, 'unit' => 'px', 'color' => 'palette6', 'style' => 'solid' ] ];
$opts['header_sticky']          = true;
$opts['header_sticky_background'] = [ 'desktop' => [ 'color' => 'palette9' ] ];
$opts['header_desktop_items']   = [
	'top'    => [ 'left' => [], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [] ],
	'main'   => [ 'left' => [ 'logo' ], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [ 'navigation', 'cart' ] ],
	'bottom' => [ 'left' => [], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [] ],
];
$opts['header_mobile_items'] = [
	'top'    => [ 'left' => [], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [] ],
	'main'   => [ 'left' => [ 'logo' ], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [ 'mobile-trigger', 'cart' ] ],
	'bottom' => [ 'left' => [], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [] ],
	'popup'  => [ 'navigation' ],
];
$opts['primary_navigation_style'] = 'underline';
$opts['primary_navigation_color'] = [ 'color' => 'palette4', 'hover' => 'palette1', 'active' => 'palette1', 'background' => '', 'backgroundHover' => '' ];
$opts['buttons_background']       = [ 'color' => 'palette1', 'hover' => 'palette2' ];
$opts['buttons_color']            = [ 'color' => 'palette9', 'hover' => 'palette9' ];
$opts['buttons_border_radius']    = [ 'size' => [ 'desktop' => 4 ], 'unit' => [ 'desktop' => 'px' ] ];
$opts['mobile_trigger_color']      = [ 'color' => 'palette9', 'background' => 'palette1' ];
$opts['mobile_trigger_background'] = [ 'color' => 'palette1', 'hover' => 'palette2' ];
$opts['scroll_up']                 = true;
$opts['product_archive_columns']   = 3;
$opts['product_archive_default_view']       = 'grid';
$opts['product_archive_image_hover_switch'] = 'fade';

$mods['kadence_theme_options'] = wp_json_encode( $opts );
update_option( 'theme_mods_kadence', $mods );

// ─────────────────────────────────────────────────────────────────────────────
//  NAV MENU
// ─────────────────────────────────────────────────────────────────────────────
// Delete any old MEGA nav menus and start fresh
$old_menus = [ 'Main Navigation', 'MEGA Navigation' ];
foreach ( $old_menus as $mn ) {
	$m = get_term_by( 'name', $mn, 'nav_menu' );
	if ( $m ) wp_delete_nav_menu( $m->term_id );
}

$menu_id = wp_create_nav_menu( 'MEGA Navigation' );
wp_update_nav_menu_item( $menu_id, 0, [ 'menu-item-title' => 'Home',  'menu-item-url' => home_url('/'), 'menu-item-status' => 'publish', 'menu-item-type' => 'custom' ] );
wp_update_nav_menu_item( $menu_id, 0, [ 'menu-item-title' => 'Shop',  'menu-item-object-id' => wc_get_page_id('shop'), 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ] );

// About page
$about = get_page_by_path( 'about-us' ) ?: get_page_by_path( 'about' );
if ( ! $about ) {
	$about_id = wp_insert_post( [ 'post_title' => 'About Us', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '<!-- wp:kadence/rowlayout {"uniqueID":"about1","columns":1,"colLayout":"equal","align":"full","topPadding":80,"bottomPadding":80} --><div class="wp-block-kadence-rowlayout alignfull kb-row-layout-idabout1 kb-layout-columns-1"><!-- wp:kadence/column {"id":1,"uniqueID":"about1c"} --><div class="wp-block-kadence-column kadence-columnabout1c inner-column-1"><div class="kt-inside-inner-col"><!-- wp:kadence/advancedheading {"uniqueID":"about1h","level":1,"size":48,"color":"palette3","align":"center","fontWeight":"800"} --><h1 class="wp-block-kadence-advancedheading kt-adv-heading about1h" style="color:var(--global-palette3);font-size:48px;font-weight:800;text-align:center">About Us</h1><!-- /wp:kadence/advancedheading --><!-- wp:kadence/advancedheading {"uniqueID":"about1p","level":6,"size":18,"color":"palette4","align":"center","fontWeight":"400","topMargin":24} --><p class="wp-block-kadence-advancedheading kt-adv-heading about1p" style="color:var(--global-palette4);font-size:18px;font-weight:400;text-align:center;margin-top:24px">We create unique, high-quality print-on-demand products. One design, 45+ products, live in minutes.</p><!-- /wp:kadence/advancedheading --></div></div><!-- /wp:kadence/column --></div><!-- /wp:kadence/rowlayout -->' ] );
} else {
	$about_id = $about->ID;
}
wp_update_nav_menu_item( $menu_id, 0, [ 'menu-item-title' => 'About', 'menu-item-object-id' => $about_id, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ] );

$locs = get_theme_mod( 'nav_menu_locations', [] );
$locs['primary'] = $menu_id;
set_theme_mod( 'nav_menu_locations', $locs );

// ─────────────────────────────────────────────────────────────────────────────
//  HOMEPAGE
// ─────────────────────────────────────────────────────────────────────────────
// Remove old MEGA homepages
$old_pages = get_posts( [ 'post_type' => 'page', 'post_name__in' => [ 'mega-home', 'home' ], 'posts_per_page' => 10, 'post_status' => 'any' ] );
foreach ( $old_pages as $op ) {
	if ( in_array( $op->post_name, [ 'mega-home' ] ) ) {
		wp_delete_post( $op->ID, true );
	}
}

$page_id = wp_insert_post( [
	'post_title'   => get_bloginfo('name') ?: 'Home',
	'post_name'    => 'mega-home',
	'post_content' => $content,
	'post_status'  => 'publish',
	'post_type'    => 'page',
] );

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $page_id );

// ─────────────────────────────────────────────────────────────────────────────
//  FLUSH
// ─────────────────────────────────────────────────────────────────────────────
delete_option( 'kadence_gutenberg_block_css' );
delete_option( 'kadence_gutenberg_global_block_css' );
global $wpdb;
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '%kadence%css%'" );
if ( function_exists( 'wp_cache_flush' ) ) wp_cache_flush();

// ─────────────────────────────────────────────────────────────────────────────
//  DONE
// ─────────────────────────────────────────────────────────────────────────────
echo "\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "  MEGA HOMEPAGE DEPLOYED (Kadence Blocks) 🦈\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "  Page ID: $page_id\n";
echo "  URL:     " . get_permalink( $page_id ) . "\n";
echo "  Blocks:  kadence/rowlayout · kadence/advancedheading\n";
echo "           kadence/advancedbtn · kadence/infobox\n";
echo "  Next:    wp litespeed-purge all\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
echo "  Student todo:\n";
echo "  1. Logo       → WP Admin > Appearance > Customize > Site Identity\n";
echo "  2. Colors     → Tell Claude: 'Set palette: primary=#XX accent=#YY'\n";
echo "  3. Hero bg    → Upload image, tell Claude: 'Set hero bg to image ID X'\n";
echo "  4. Niche imgs → Replace 3 picsum images in Kadence editor\n";
echo "  5. Store name → WP Admin > Settings > General\n\n";

<?php
/**
 * MEGA Stack Homepage Template Deployer
 * Run via: wp eval-file mega-homepage.php --path=$WP_PATH
 *
 * Deploys a complete, brandable storefront homepage using Kadence + core blocks.
 * Students swap: logo, palette (1 Claude command), hero image, 3 niche photos.
 * Everything else is done.
 */

// ── CONFIG ────────────────────────────────────────────────────────────────────
$store_name  = get_bloginfo( 'name' ) ?: 'My Store';
$shop_url    = get_permalink( wc_get_page_id( 'shop' ) ) ?: '/shop';

// ── HELPER: unique Kadence block ID ──────────────────────────────────────────
function mega_uid() {
	return substr( md5( uniqid( mt_rand(), true ) ), 0, 8 );
}

// ── BLOCK CONTENT ────────────────────────────────────────────────────────────
// Written as vanilla Gutenberg + Kadence blocks.
// Uses var(--global-paletteN) so a palette swap updates everything instantly.
// Placeholder images via picsum.photos — student replaces with niche photos.

$u = [
	'hero'   => mega_uid(),
	'stats'  => mega_uid(),
	'img'    => mega_uid(),
	'trust'  => mega_uid(),
	'cta'    => mega_uid(),
];

$content = <<<BLOCKS

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 1: HERO                                       -->
<!-- ═══════════════════════════════════════════════════════ -->

<!-- wp:cover {"dimRatio":70,"overlayColor":"contrast","minHeight":100,"minHeightUnit":"vh","isDark":true,"align":"full","className":"mega-hero","style":{"color":{"duotone":"unset"}}} -->
<div class="wp-block-cover alignfull is-dark mega-hero" style="min-height:100vh">
<span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-70 has-background-dim" style="background-color:var(--global-palette3,#1a1a2e)"></span>
<div class="wp-block-cover__inner-container">

<!-- wp:spacer {"height":"50px"} --><div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div><!-- /wp:spacer -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"letterSpacing":"4px","textTransform":"uppercase","fontSize":"0.8rem","fontWeight":"600"},"color":{"text":"var(--global-palette1)"}}} -->
<p class="has-text-align-center" style="color:var(--global-palette1);font-size:0.8rem;font-weight:600;letter-spacing:4px;text-transform:uppercase">Print-On-Demand, Reimagined</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"clamp(2.8rem,7vw,5.5rem)","fontWeight":"900","lineHeight":"1.05","letterSpacing":"-1px"},"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"1.5rem","bottom":"1.5rem"}}}} -->
<h1 class="wp-block-heading has-text-align-center" style="color:#ffffff;font-size:clamp(2.8rem,7vw,5.5rem);font-weight:900;line-height:1.05;letter-spacing:-1px;margin-top:1.5rem;margin-bottom:1.5rem">Your Niche.<br>45 Products.<br>Done.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.2rem","lineHeight":"1.7"},"color":{"text":"rgba(255,255,255,0.82)"},"spacing":{"margin":{"bottom":"2.5rem"}}}} -->
<p class="has-text-align-center" style="color:rgba(255,255,255,0.82);font-size:1.2rem;line-height:1.7;margin-bottom:2.5rem">One design. Hundreds of products, fully SEO-optimized<br>and live in minutes — not weeks.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"1rem"}}} -->
<div class="wp-block-buttons">
<!-- wp:button {"style":{"border":{"radius":"4px"},"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"2.5rem","right":"2.5rem"}},"typography":{"fontWeight":"700","fontSize":"1.1rem"},"color":{"background":"var(--global-palette1)","text":"#ffffff"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="{$shop_url}" style="border-radius:4px;padding:1rem 2.5rem;font-weight:700;font-size:1.1rem;background-color:var(--global-palette1);color:#ffffff">Shop Now &rarr;</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"4px","width":"2px","color":"rgba(255,255,255,0.5)"},"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"2rem","right":"2rem"}},"typography":{"fontWeight":"600","fontSize":"1rem"},"color":{"text":"rgba(255,255,255,0.85)"}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#niche-row" style="border-radius:4px;border-width:2px;border-color:rgba(255,255,255,0.5);padding:1rem 2rem;font-weight:600;font-size:1rem;color:rgba(255,255,255,0.85)">See What's Inside</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:spacer {"height":"50px"} --><div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div><!-- /wp:spacer -->

</div>
</div>
<!-- /wp:cover -->


<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 2: STATS ROW                                  -->
<!-- ═══════════════════════════════════════════════════════ -->

<!-- wp:group {"align":"full","style":{"color":{"background":"var(--global-palette7)"},"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:var(--global-palette7);padding-top:4rem;padding-bottom:4rem">

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"2rem"}}} -->
<div class="wp-block-columns alignwide">

<!-- wp:column {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem"}}}} -->
<div class="wp-block-column" style="padding-top:1.5rem;padding-bottom:1.5rem">
<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"3.5rem","fontWeight":"900","lineHeight":"1"},"color":{"text":"var(--global-palette2)"}}} --><h2 class="wp-block-heading has-text-align-center" style="color:var(--global-palette2);font-size:3.5rem;font-weight:900;line-height:1">45+</h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700","letterSpacing":"1px","textTransform":"uppercase","fontSize":"0.85rem"},"color":{"text":"var(--global-palette4)"}}} --><p class="has-text-align-center" style="color:var(--global-palette4);font-weight:700;letter-spacing:1px;text-transform:uppercase;font-size:0.85rem">Product Types</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem"}}}} -->
<div class="wp-block-column" style="padding-top:1.5rem;padding-bottom:1.5rem">
<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"3.5rem","fontWeight":"900","lineHeight":"1"},"color":{"text":"var(--global-palette2)"}}} --><h2 class="wp-block-heading has-text-align-center" style="color:var(--global-palette2);font-size:3.5rem;font-weight:900;line-height:1">7 Min</h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700","letterSpacing":"1px","textTransform":"uppercase","fontSize":"0.85rem"},"color":{"text":"var(--global-palette4)"}}} --><p class="has-text-align-center" style="color:var(--global-palette4);font-weight:700;letter-spacing:1px;text-transform:uppercase;font-size:0.85rem">Idea to Live</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem"}}}} -->
<div class="wp-block-column" style="padding-top:1.5rem;padding-bottom:1.5rem">
<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"3.5rem","fontWeight":"900","lineHeight":"1"},"color":{"text":"var(--global-palette2)"}}} --><h2 class="wp-block-heading has-text-align-center" style="color:var(--global-palette2);font-size:3.5rem;font-weight:900;line-height:1">100%</h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700","letterSpacing":"1px","textTransform":"uppercase","fontSize":"0.85rem"},"color":{"text":"var(--global-palette4)"}}} --><p class="has-text-align-center" style="color:var(--global-palette4);font-weight:700;letter-spacing:1px;text-transform:uppercase;font-size:0.85rem">SEO Ready</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem"}}}} -->
<div class="wp-block-column" style="padding-top:1.5rem;padding-bottom:1.5rem">
<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"3.5rem","fontWeight":"900","lineHeight":"1"},"color":{"text":"var(--global-palette2)"}}} --><h2 class="wp-block-heading has-text-align-center" style="color:var(--global-palette2);font-size:3.5rem;font-weight:900;line-height:1">Zero</h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700","letterSpacing":"1px","textTransform":"uppercase","fontSize":"0.85rem"},"color":{"text":"var(--global-palette4)"}}} --><p class="has-text-align-center" style="color:var(--global-palette4);font-weight:700;letter-spacing:1px;text-transform:uppercase;font-size:0.85rem">Grind</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->


<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 3: NICHE IMAGERY ROW                          -->
<!-- ═══════════════════════════════════════════════════════ -->

<!-- wp:group {"align":"full","id":"niche-row","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}{},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" id="niche-row" style="padding-top:5rem;padding-bottom:5rem;"><

<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"2.5rem","fontWeight":"800","letterSpacing":"-0.5px"},"color":{"text":"var(--global-palette3)"},"spacing":{"margin":{"bottom":"0.75rem"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="color:var(--global-palette9);font-size:2.5rem;font-weight:800;letter-spacing:-0.5px;margin-bottom:0.75rem">Something for Every Niche</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"var(--global-palette2)"},"typography":{"fontSize":"1.1rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"3rem"}}}} -->
<p class="has-text-align-center" style="color:var(--global-palette2);font-size:1.1rem;font-weight:600;margin-bottom:3rem">T-shirts &bull; Hoodies &bull; Mugs &bull; Wall Art &bull; Hats &bull; Drinkware &bull; Mouse Pads &amp; more</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"1.5rem"}}} -->
<div class="wp-block-columns alignwide">

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:cover {"url":"https://picsum.photos/seed/mega1/600/700","dimRatio":30,"minHeight":380,"isDark":true,"style":{"border":{"radius":"8px"}}} -->
<div class="wp-block-cover" style="border-radius:8px;min-height:380px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><img class="wp-block-cover__image-background" src="https://picsum.photos/seed/mega1/600/700" alt="Apparel" style="object-position:50% 50%" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
<!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#ffffff"},"typography":{"fontWeight":"800","fontSize":"2rem","letterSpacing":"1px","textTransform":"uppercase"}}} --><h3 class="wp-block-heading has-text-align-center" style="color:#ffffff;font-weight:800;font-size:2rem;letter-spacing:1px;text-transform:uppercase">Apparel</h3><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"color":{"text":"rgba(255,255,255,0.9)"},"typography":{"fontSize":"1.1rem","fontWeight":"500"}}} --><p class="has-text-align-center" style="color:rgba(255,255,255,0.9);font-size:1.1rem;font-weight:500">Tees &bull; Hoodies &bull; Hats</p><!-- /wp:paragraph -->
</div></div>
<!-- /wp:cover -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:cover {"url":"https://picsum.photos/seed/mega2/600/700","dimRatio":30,"minHeight":380,"isDark":true,"style":{"border":{"radius":"8px"}}} -->
<div class="wp-block-cover" style="border-radius:8px;min-height:380px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><img class="wp-block-cover__image-background" src="https://picsum.photos/seed/mega2/600/700" alt="Drinkware" style="object-position:50% 50%" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
<!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#ffffff"},"typography":{"fontWeight":"800","fontSize":"2rem","letterSpacing":"1px","textTransform":"uppercase"}}} --><h3 class="wp-block-heading has-text-align-center" style="color:#ffffff;font-weight:800;font-size:2rem;letter-spacing:1px;text-transform:uppercase">Drinkware</h3><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"color":{"text":"rgba(255,255,255,0.9)"},"typography":{"fontSize":"1.1rem","fontWeight":"500"}}} --><p class="has-text-align-center" style="color:rgba(255,255,255,0.9);font-size:1.1rem;font-weight:500">Mugs &bull; Tumblers &bull; Water Bottles</p><!-- /wp:paragraph -->
</div></div>
<!-- /wp:cover -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:cover {"url":"https://picsum.photos/seed/mega3/600/700","dimRatio":30,"minHeight":380,"isDark":true,"style":{"border":{"radius":"8px"}}} -->
<div class="wp-block-cover" style="border-radius:8px;min-height:380px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><img class="wp-block-cover__image-background" src="https://picsum.photos/seed/mega3/600/700" alt="Wall Art" style="object-position:50% 50%" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
<!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#ffffff"},"typography":{"fontWeight":"800","fontSize":"2rem","letterSpacing":"1px","textTransform":"uppercase"}}} --><h3 class="wp-block-heading has-text-align-center" style="color:#ffffff;font-weight:800;font-size:2rem;letter-spacing:1px;text-transform:uppercase">Wall Art</h3><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"color":{"text":"rgba(255,255,255,0.9)"},"typography":{"fontSize":"1.1rem","fontWeight":"500"}}} --><p class="has-text-align-center" style="color:rgba(255,255,255,0.9);font-size:1.1rem;font-weight:500">Posters &bull; Canvas &bull; Framed Prints</p><!-- /wp:paragraph -->
</div></div>
<!-- /wp:cover -->
</div>
<!-- /wp:column -->

</div>
<!-- /wp:columns -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"3rem"}}}} -->
<div class="wp-block-buttons" style="margin-top:3rem">
<!-- wp:button {"style":{"border":{"radius":"4px"},"spacing":{"padding":{"top":"0.9rem","bottom":"0.9rem","left":"2.5rem","right":"2.5rem"}},"typography":{"fontWeight":"600"},"color":{"background":"var(--global-palette3)","text":"var(--global-palette9)"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="{$shop_url}" style="border-radius:4px;padding:0.9rem 2.5rem;font-weight:600;background-color:var(--global-palette3);color:var(--global-palette9)">Browse All Products &rarr;</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

</div>
<!-- /wp:group -->


<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 4: TRUST / VALUE ROW                          -->
<!-- ═══════════════════════════════════════════════════════ -->

<!-- wp:group {"align":"full","style":{"color":{"background":"var(--global-palette7)"},"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:var(--global-palette7);padding-top:4rem;padding-bottom:4rem">

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"2rem"}}} -->
<div class="wp-block-columns alignwide">

<!-- wp:column {"style":{"spacing":{"padding":{"all":"1.5rem"}}}} -->
<div class="wp-block-column" style="padding:1.5rem">
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} --><p class="has-text-align-center" style="font-size:4rem">🚚</p><!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"800","fontSize":"1.5rem","letterSpacing":"1px","textTransform":"uppercase"},"color":{"text":"var(--global-palette3)"},"spacing":{"margin":{"top":"1rem","bottom":"0.6rem"}}}} --><h3 class="wp-block-heading has-text-align-center" style="color:var(--global-palette3);font-weight:800;font-size:1.5rem;letter-spacing:1px;text-transform:uppercase;margin-top:1rem;margin-bottom:0.6rem">FREE SHIPPING</h3><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"color":{"text":"var(--global-palette5)"},"typography":{"fontSize":"1.1rem"}}} --><p class="has-text-align-center" style="color:var(--global-palette5);font-size:1.1rem">On all orders over $50</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"all":"1.5rem"}}}} -->
<div class="wp-block-column" style="padding:1.5rem">
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} --><p class="has-text-align-center" style="font-size:4rem">⭐</p><!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"800","fontSize":"1.5rem","letterSpacing":"1px","textTransform":"uppercase"},"color":{"text":"var(--global-palette3)"},"spacing":{"margin":{"top":"1rem","bottom":"0.6rem"}}}} --><h3 class="wp-block-heading has-text-align-center" style="color:var(--global-palette3);font-weight:800;font-size:1.5rem;letter-spacing:1px;text-transform:uppercase;margin-top:1rem;margin-bottom:0.6rem">SATISFACTION GUARANTEED</h3><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"color":{"text":"var(--global-palette5)"},"typography":{"fontSize":"1.1rem"}}} --><p class="has-text-align-center" style="color:var(--global-palette5);font-size:1.1rem">Love it or your money back</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"all":"1.5rem"}}}} -->
<div class="wp-block-column" style="padding:1.5rem">
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} --><p class="has-text-align-center" style="font-size:4rem">🎨</p><!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"800","fontSize":"1.5rem","letterSpacing":"1px","textTransform":"uppercase"},"color":{"text":"var(--global-palette3)"},"spacing":{"margin":{"top":"1rem","bottom":"0.6rem"}}}} --><h3 class="wp-block-heading has-text-align-center" style="color:var(--global-palette3);font-weight:800;font-size:1.5rem;letter-spacing:1px;text-transform:uppercase;margin-top:1rem;margin-bottom:0.6rem">UNIQUE DESIGNS</h3><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"color":{"text":"var(--global-palette5)"},"typography":{"fontSize":"1.1rem"}}} --><p class="has-text-align-center" style="color:var(--global-palette5);font-size:1.1rem">You won't find these anywhere else</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"all":"1.5rem"}}}} -->
<div class="wp-block-column" style="padding:1.5rem">
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} --><p class="has-text-align-center" style="font-size:4rem">⚡</p><!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"800","fontSize":"1.5rem","letterSpacing":"1px","textTransform":"uppercase"},"color":{"text":"var(--global-palette3)"},"spacing":{"margin":{"top":"1rem","bottom":"0.6rem"}}}} --><h3 class="wp-block-heading has-text-align-center" style="color:var(--global-palette3);font-weight:800;font-size:1.5rem;letter-spacing:1px;text-transform:uppercase;margin-top:1rem;margin-bottom:0.6rem">FAST PRODUCTION</h3><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"color":{"text":"var(--global-palette5)"},"typography":{"fontSize":"1.1rem"}}} --><p class="has-text-align-center" style="color:var(--global-palette5);font-size:1.1rem">Ships within 3–5 business days</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->


<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 5: FINAL CTA                                  -->
<!-- ═══════════════════════════════════════════════════════ -->

<!-- wp:group {"align":"full","style":{"color":{"background":"var(--global-palette1)"},"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:var(--global-palette1);padding-top:5rem;padding-bottom:5rem">

<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"2.5rem","fontWeight":"800","lineHeight":"1.2"},"color":{"text":"#ffffff"},"spacing":{"margin":{"bottom":"1rem"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="color:#ffffff;font-size:2.5rem;font-weight:800;line-height:1.2;margin-bottom:1rem">Ready to find something<br>you'll actually love?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"rgba(255,255,255,0.85)"},"typography":{"fontSize":"1.1rem"},"spacing":{"margin":{"bottom":"2.5rem"}}}} -->
<p class="has-text-align-center" style="color:rgba(255,255,255,0.85);font-size:1.1rem;margin-bottom:2.5rem">Browse our full collection — every product ships ready to gift.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">
<!-- wp:button {"style":{"border":{"radius":"4px","color":"#ffffff","width":"2px"},"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"3rem","right":"3rem"}},"typography":{"fontWeight":"700","fontSize":"1.1rem"},"color":{"background":"transparent","text":"#ffffff"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="{$shop_url}" style="border-radius:4px;border:2px solid #ffffff;padding:1rem 3rem;font-weight:700;font-size:1.1rem;background:transparent;color:#ffffff">Browse All Products &rarr;</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

</div>
<!-- /wp:group -->

BLOCKS;

// ── HEADER BUILDER CONFIG ─────────────────────────────────────────────────────
$kadence_opts = json_decode( get_theme_mod( 'kadence_theme_options', '{}' ), true ) ?: [];

// Header: Logo left, Nav center, Cart right
$kadence_opts['header_desktop_items'] = [
	'top'    => [ 'left' => [], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [] ],
	'main'   => [ 'left' => [ 'logo' ], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [ 'navigation', 'cart' ] ],
	'bottom' => [ 'left' => [], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [] ],
];
$kadence_opts['header_mobile_items'] = [
	'top'    => [ 'left' => [], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [] ],
	'main'   => [ 'left' => [ 'logo' ], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [ 'mobile-trigger', 'cart' ] ],
	'bottom' => [ 'left' => [], 'left_center' => [], 'center' => [], 'right_center' => [], 'right' => [] ],
	'popup'  => [ 'navigation' ],
];

// Header: clean white background with subtle bottom border
$kadence_opts['header_main_background'] = [ 'desktop' => [ 'color' => 'palette9' ] ];
$kadence_opts['header_main_bottom_border'] = [ [ 'width' => 1, 'unit' => 'px', 'color' => 'palette6', 'style' => 'solid' ] ];
$kadence_opts['header_main_height'] = [ 'size' => [ 'desktop' => 68, 'tablet' => 60, 'mobile' => 51 ], 'unit' => [ 'desktop' => 'px', 'tablet' => 'px', 'mobile' => 'px' ] ];

// Sticky header
$kadence_opts['header_sticky'] = true;
$kadence_opts['header_sticky_background'] = [ 'desktop' => [ 'color' => 'palette9' ] ];
$kadence_opts['header_sticky_bottom_border'] = [ [ 'width' => 1, 'unit' => 'px', 'color' => 'palette6', 'style' => 'solid' ] ];

// Navigation style: clean underline on hover
$kadence_opts['primary_navigation_style'] = 'underline';
$kadence_opts['primary_navigation_color'] = [
	'color'           => 'palette4',
	'hover'           => 'palette1',
	'active'          => 'palette1',
	'background'      => '',
	'backgroundHover' => '',
];

// Buttons: solid primary color, rounded
$kadence_opts['buttons_background']     = [ 'color' => 'palette1', 'hover' => 'palette2' ];
$kadence_opts['buttons_color']          = [ 'color' => 'palette9', 'hover' => 'palette9' ];
$kadence_opts['buttons_border_radius']  = [ 'size' => [ 'desktop' => 4, 'tablet' => 4, 'mobile' => 4 ], 'unit' => [ 'desktop' => 'px', 'tablet' => 'px', 'mobile' => 'px' ] ];

// Footer: simple two-column — logo left, copyright right
$kadence_opts['footer_bottom_columns'] = 2;
$kadence_opts['footer_bottom_layout']  = [ 'left' => [ 'logo' ], 'center' => [], 'right' => [ 'html' ] ];
$kadence_opts['footer_html_content']   = '&copy; ' . date( 'Y' ) . ' ' . esc_html( $store_name ) . '. All rights reserved.';
$kadence_opts['footer_bottom_background'] = [ 'desktop' => [ 'color' => 'palette3' ] ];

// WooCommerce: 3-column grid, fade on hover
$kadence_opts['product_archive_columns']           = 3;
$kadence_opts['product_archive_default_view']      = 'grid';
$kadence_opts['product_archive_image_hover_switch'] = 'fade';
$kadence_opts['product_content_style']             = 'unboxed';

// Mobile hamburger trigger → secondary color so it pops on white header
$kadence_opts['mobile_trigger_color']      = [ 'color' => 'palette9', 'background' => 'palette2' ];
$kadence_opts['mobile_trigger_background'] = [ 'color' => 'palette2', 'hover' => 'palette1' ];
$kadence_opts['mobile_trigger_border']     = [];
$kadence_opts['mobile_trigger_padding']    = [ 'size' => [ 'desktop' => [ 0.5, 0.7, 0.5, 0.7 ] ], 'unit' => [ 'desktop' => 'em' ], 'locked' => [ 'desktop' => false ] ];

// Scroll to top
$kadence_opts['scroll_up'] = true;

// Apply to theme
$mods = get_option( 'theme_mods_kadence', [] );
$mods['kadence_theme_options'] = wp_json_encode( $kadence_opts );
update_option( 'theme_mods_kadence', $mods );

// ── CREATE MAIN MENU ──────────────────────────────────────────────────────────
$menu_name = 'Main Navigation';
$menu_id   = wp_get_nav_menu_object( $menu_name );
if ( ! $menu_id ) {
	$menu_id = wp_create_nav_menu( $menu_name );
}

// Ensure Home page exists
$home = get_page_by_path( 'home' );
if ( ! $home ) {
	// The homepage will be set below — just add URL items
	wp_update_nav_menu_item( $menu_id, 0, [ 'menu-item-title' => 'Home', 'menu-item-url' => home_url('/'), 'menu-item-status' => 'publish', 'menu-item-type' => 'custom' ] );
} else {
	wp_update_nav_menu_item( $menu_id, 0, [ 'menu-item-title' => 'Home', 'menu-item-object-id' => $home->ID, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ] );
}

// Shop
$shop_page_id = wc_get_page_id( 'shop' );
if ( $shop_page_id ) {
	wp_update_nav_menu_item( $menu_id, 0, [ 'menu-item-title' => 'Shop', 'menu-item-object-id' => $shop_page_id, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ] );
}

// About (create if missing)
$about = get_page_by_path( 'about' );
if ( ! $about ) {
	$about_id = wp_insert_post( [
		'post_title'   => 'About Us',
		'post_content' => '<!-- wp:paragraph --><p>We create unique, high-quality print-on-demand products for every niche. Our mission: give everyone access to original, meaningful designs — without the big brand markup.</p><!-- /wp:paragraph -->',
		'post_status'  => 'publish',
		'post_type'    => 'page',
	] );
} else {
	$about_id = $about->ID;
}
wp_update_nav_menu_item( $menu_id, 0, [ 'menu-item-title' => 'About', 'menu-item-object-id' => $about_id, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ] );

// Assign menu to Primary Navigation location
$locations = get_theme_mod( 'nav_menu_locations', [] );
$locations['primary'] = is_object( $menu_id ) ? $menu_id->term_id : $menu_id;
set_theme_mod( 'nav_menu_locations', $locations );

// ── CREATE HOMEPAGE ───────────────────────────────────────────────────────────
// Delete existing MEGA homepage if it exists
$existing = get_page_by_path( 'mega-home' );
if ( $existing ) {
	wp_delete_post( $existing->ID, true );
}

$page_id = wp_insert_post( [
	'post_title'   => 'Home',
	'post_name'    => 'mega-home',
	'post_content' => $content,
	'post_status'  => 'publish',
	'post_type'    => 'page',
] );

if ( is_wp_error( $page_id ) ) {
	echo 'ERROR creating page: ' . $page_id->get_error_message() . "\n";
	exit(1);
}

// ── SET AS FRONT PAGE ─────────────────────────────────────────────────────────
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $page_id );

// ── MEGA STANDARD PALETTE ────────────────────────────────────────────────────
// Applied every time so palette is always correct.
// palette1 = PRIMARY CTA     → Orange #FF5500
// palette2 = CTA HOVER       → Deep orange #E04A00
// palette3 = HEADINGS        → Near black #0A0A0A
// palette4 = BODY TEXT       → Dark gray #2D2D2D
// palette5 = MUTED TEXT      → Mid gray #6B6B6B
// palette6 = BORDERS         → Light gray #E0E0E0
// palette7 = LIGHT SURFACE   → Off-white #F5F5F5 (stats/trust bg)
// palette8 = PAGE BG         → Near white #FAFAFA
// palette9 = PURE WHITE      → #FFFFFF (text on dark/orange)
// Students override palette1+2 to brand their store. Everything updates.
// NOTE: Kadence reads palette from wp_options key 'kadence_global_palette' (NOT theme_mods)
// Format: {"active":"palette","palette":[{color,slug,name},...]}
update_option( 'kadence_global_palette', wp_json_encode( [
	'palette' => [
		[ 'slug' => 'palette1', 'color' => '#FF5500' ],
		[ 'slug' => 'palette2', 'color' => '#E04A00' ],
		[ 'slug' => 'palette3', 'color' => '#0A0A0A' ],
		[ 'slug' => 'palette4', 'color' => '#2D2D2D' ],
		[ 'slug' => 'palette5', 'color' => '#6B6B6B' ],
		[ 'slug' => 'palette6', 'color' => '#E0E0E0' ],
		[ 'slug' => 'palette7', 'color' => '#F5F5F5' ],
		[ 'slug' => 'palette8', 'color' => '#FAFAFA' ],
		[ 'slug' => 'palette9', 'color' => '#FFFFFF' ],
	]
] );

// ── FLUSH CACHE ───────────────────────────────────────────────────────────────
if ( function_exists( 'wp_cache_flush' ) ) wp_cache_flush();
delete_option( 'kadence_gutenberg_block_css' );
delete_option( 'kadence_gutenberg_global_block_css' );
if ( class_exists( 'LiteSpeed_Cache_API' ) ) {
	LiteSpeed_Cache_API::purge_all();
}

// ── DONE ──────────────────────────────────────────────────────────────────────
echo "\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "  MEGA HOMEPAGE DEPLOYED 🦈\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "  Page ID:   $page_id\n";
echo "  URL:       " . get_permalink( $page_id ) . "\n";
echo "  Sections:  Hero · Stats · Niche Images · Trust · CTA\n";
echo "  Nav:       Home · Shop · About\n";
echo "  Next:      Run  wp litespeed-purge all  then visit the URL\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
echo "  Student customization:\n";
echo "  1. Swap logo  →  WP Admin > Appearance > Customize > Site Identity\n";
echo "  2. Brand colors →  Tell Claude: 'Set my palette: primary=#XX accent=#YY'\n";
echo "  3. Hero bg  →  Upload image, tell Claude: 'Set hero background to image ID X'\n";
echo "  4. Imagery row  →  Replace the 3 picsum images in Gutenberg editor\n";
echo "  5. Store name  →  WP Admin > Settings > General\n";
echo "\n";

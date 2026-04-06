<?php
/**
 * MEGA Styles — mega.management site branding
 * Scoped to header/footer/global UI only.
 * Content sections use their own inline block styles — do NOT override them.
 */
add_action( 'wp_head', function() { ?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;700;800&family=Inter:wght@400;500;600&display=swap');

/* ── GLOBAL FONTS ─────────────────────────────── */
body {
  font-family: 'Inter', sans-serif;
}
/* Headings — font only, NO color override (let palette handle it) */
h1, h2, h3, h4, h5, h6 {
  font-family: 'Barlow Condensed', sans-serif;
}
p { line-height: 1.7; }

/* ── HEADER — dark branded ───────────────────── */
#masthead,
.site-header,
.site-header-wrap,
.site-header-inner-wrap,
#main-header {
  background-color: #0A0A0A !important;
  border-bottom: 1px solid #222222 !important;
}
.site-header-wrap { padding: 0 20px !important; }

/* Logo */
.custom-logo { width: 220px !important; max-width: 220px !important; height: auto !important; }

/* Nav links — white on dark header */
#site-navigation a,
.main-navigation a {
  color: #F0F0F0 !important;
  font-family: 'Inter', sans-serif !important;
  font-size: 14px !important;
  letter-spacing: 0.04em !important;
}
#site-navigation a:hover,
.main-navigation a:hover {
  color: #FF5500 !important;
}

/* ── GAP FIX — header → content ─────────────── */
#primary.content-area,
.site-main {
  margin-top: 0 !important;
  padding-top: 0 !important;
}
.hentry, .entry-content-wrap {
  padding: 0 !important;
  margin: 0 !important;
}

/* Hide Kadence page title area on homepage */
.home .entry-hero,
.home .page-hero-section,
.home .kadence-page-header,
.home .entry-header.hero-section,
.home .page-title-area { display: none !important; }

/* ── FOOTER ──────────────────────────────────── */
.site-footer, #colophon {
  background: #111111 !important;
  border-top: 1px solid #222222 !important;
}
.site-footer,
.site-footer p,
.site-footer a {
  color: #888888 !important;
}
.site-footer a:hover { color: #FF5500 !important; }

/* ── GLOBAL BUTTON STYLE ────────────────────── */
.wp-block-button__link {
  transition: all 0.2s ease !important;
}

/* ── MOBILE HAMBURGER TRIGGER ────────────────── */
/* Orange bg + white icon — must be visible on dark header */
#mobile-toggle,
.menu-toggle-open,
.mobile-toggle {
  background-color: #FF5500 !important;
  border: none !important;
  border-radius: 4px !important;
  padding: 8px 10px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}
#mobile-toggle svg,
#mobile-toggle .kadence-svg-icon,
.menu-toggle-open svg,
.menu-toggle-open .kadence-svg-icon {
  fill: #ffffff !important;
  color: #ffffff !important;
  width: 22px !important;
  height: 22px !important;
}
#mobile-toggle:hover,
.menu-toggle-open:hover {
  background-color: #E04A00 !important;
}

/* ── MOBILE ──────────────────────────────────── */
@media (max-width: 767px) {
  h1 { font-size: clamp(2rem, 10vw, 3.5rem) !important; }
}
</style>
<?php }, 1 );

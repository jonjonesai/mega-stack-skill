# MEGA Stack Homepage Template — Success Benchmark

## What "Good" Looks Like

A student runs `mega-template.sh` and gets a homepage that:

1. **Looks like a real store** — not a demo, not a placeholder, not obviously a template
2. **Works immediately** — shop link works, mobile-responsive, fast load
3. **Is trivially customizable** — swap logo, one palette command, drop hero image = fully branded
4. **Is niche-agnostic** — works for cat art, hunting gear, motivational quotes, gym apparel, anything

## The Page Architecture (Non-Negotiable)

```
┌─────────────────────────────────────────────┐
│  HEADER                                     │
│  [Logo]        [Home] [Shop] [About]  [Cart]│
└─────────────────────────────────────────────┘
┌─────────────────────────────────────────────┐
│  HERO ROW (100vh)                           │
│  [Placeholder dark background]              │
│  ───────────────────────────────────────    │
│  YOUR NICHE. 45 PRODUCTS. DONE.             │
│  One design → hundreds of products,         │
│  SEO-ready and live in minutes.             │
│                                             │
│  [  Shop Now →  ]                           │
└─────────────────────────────────────────────┘
┌──────────┬──────────┬──────────┬────────────┐
│   45+    │  7 Min   │  100%    │    Zero    │
│ Products │Idea→Live │ SEO Ready│   Grind    │
└──────────┴──────────┴──────────┴────────────┘
┌─────────────────────────────────────────────┐
│  NICHE IMAGERY ROW                          │
│  [Image 1]      [Image 2]      [Image 3]    │
│  "Tees"         "Mugs"         "Wall Art"   │
└─────────────────────────────────────────────┘
┌──────────┬──────────┬──────────┬────────────┐
│  🚚      │  ⭐      │  🎨      │  ⚡        │
│  Free    │ Satis-   │ Unique   │  Fast      │
│Shipping  │ faction  │ Designs  │ Production │
│$50+      │Guaranteed│          │            │
└──────────┴──────────┴──────────┴────────────┘
┌─────────────────────────────────────────────┐
│  FINAL CTA ROW                              │
│  Ready to find something you'll love?       │
│  [  Browse All Products  ]                  │
└─────────────────────────────────────────────┘
┌─────────────────────────────────────────────┐
│  FOOTER                                     │
│  [Logo]   Shop | About | Contact | Privacy  │
│           © 2026 [Store Name]               │
└─────────────────────────────────────────────┘
```

## Student Customization Checklist (After Deploy)

| Task | Tool | Effort |
|------|------|--------|
| Swap logo | WP Admin → Appearance → Customize | 2 min |
| Set brand colors | Tell Claude: "set palette: primary=#XX..." | 30 sec |
| Set fonts (optional) | Tell Claude: "set heading font to Montserrat" | 30 sec |
| Replace hero background | Upload image → tell Claude: "set hero bg to image ID X" | 2 min |
| Replace imagery row photos | Upload 3 images → swap in editor | 5 min |
| Update store name/tagline | WP Admin → Settings → General | 1 min |
| **Total** | | **~10 min** |

## The Color Swap Promise

Student says: `"Claude, here is my palette: primary=#2B6CB0, accent=#E53E3E, text=#1A202C, bg=#F7FAFC"`

Claude runs one command. Every button, heading, hover state, and section background updates across the entire site. No clicking through customizer panels.

## Placeholder Strategy

Hero bg: solid dark gradient (no image dependency)  
Imagery row: picsum.photos placeholders sized correctly  
Logo: SVG text logo with store name  
Icons: Kadence built-in icon set (no external deps)

## What Disqualifies a Build as "Good"

- ❌ Looks like a WordPress demo/default
- ❌ Broken on mobile
- ❌ Images missing or broken
- ❌ /shop page 404s
- ❌ Requires any Kadence Pro / paid features
- ❌ Takes more than 10 min to brand
- ❌ Slow (failing Core Web Vitals basics)

## The One-Liner Test

Show the homepage to someone. Ask: "Is this a real store?"

If they say yes → ✅ success  
If they say "it looks like a template" → ❌ iterate

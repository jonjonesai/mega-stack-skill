# MEGA Store — Day 1 Student Intake Prompt

Students paste this entire block into Claude on Day 1.
Claude reads it, asks the 6 questions, then builds the store.

---

## The Paste (students copy this exactly)

```
I'm setting up my MEGA store. Please ask me the 6 setup questions
one at a time, then build everything when you have my answers.

Load the MEGA Stack Skill from:
https://raw.githubusercontent.com/jonjonesai/mega-stack-skill/main/SKILL.md

My server info:
- SSH user: [PASTE FROM HOSTINGER]
- SSH host: [PASTE FROM HOSTINGER]  
- SSH port: 65002
- SSH key: ~/.ssh/id_ed25519
- WP domain: https://[THEIR DOMAIN]
- WP path: /home/[USERNAME]/domains/[DOMAIN]/public_html
```

---

## Claude's 6-Question Flow

Claude asks these in order, waiting for each answer:

**Q1 — Store Name**
> "What's your store name? This will appear in the browser tab,
> footer, and SEO titles."

**Q2 — Niche**
> "What's your niche? Be specific — not just 'pets' but
> 'funny golden retriever shirts' or 'tactical hunting gear'.
> The more specific, the better your store copy."

**Q3 — Style: Light or Dark?**
> "Pick your vibe:
> 🌑 DARK — bold, dramatic, premium. Great for: streetwear,
>    gaming, hunting, coffee, gym, skulls, anything edgy.
> ☀️ LIGHT — clean, bright, friendly. Great for: pets, baby,
>    home décor, flowers, food, inspirational quotes, nature.
>
> Which fits your niche better? (or just say dark/light)"

**Q4 — Brand Color**
> "What's your primary brand color?
> You can say a hex code (#FF5500), a color name (deep red,
> forest green, hot pink), or just say 'I don't know' and
> I'll pick something great for your niche."

**Q5 — Logo**
> "Do you have a logo ready?
> - YES → upload it now (PNG with transparent bg is best)
> - NO → I'll use a clean text logo for now. You can swap
>   it any time by uploading one and telling me."

**Q6 — Hero Image**
> "Do you have a hero/banner image for your homepage?
> This is the big background image behind your main headline.
> - YES → upload it now
> - NO → I'll use a dark gradient placeholder. When you have
>   a mockup from MEGA, just say 'set my hero image' and
>   upload it."

---

## After All 6 Answers — Claude Executes

1. Runs `mega-setup.sh` via SSH → installs full stack (~3 min)
2. Sets palette based on style + color answers
3. Runs `mega-homepage.php` → deploys 5-section homepage
4. Uploads logo if provided
5. Sets hero image if provided
6. Updates all copy with their niche
7. Outputs bridge key + WC API setup instructions

**Student gets a live branded store. Total time: ~10 minutes.**

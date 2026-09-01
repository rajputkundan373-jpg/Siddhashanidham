# Siddh Sannidham — WordPress Migration Package

The current React reference site (https://shani-divine.emergent.host/) has been ported to a **native WordPress block theme + companion plugin**. Everything visible on the reference — hero, live darshan, today card, Shani Dev section, why-visit cards, seva, bhandara, events, journal, gallery, yatra, contact, about, transparency, devotee experiences, and every CTA — has a corresponding WordPress page and pattern.

The React app under `/app/frontend` is untouched and remains deployable.

```
/app/wordpress-theme/siddh-sannidham/       ← Block theme (install second)
/app/wordpress-plugin/siddh-sannidham-core/ ← Companion plugin (install FIRST)
/app/siddh-sannidham-theme.zip              ← Ready-to-upload theme
/app/siddh-sannidham-core.zip               ← Ready-to-upload plugin
```

## Requirements

- WordPress **6.4+** (block theme + Site Editor).
- PHP **7.4+**.
- Any normal WordPress host — **no Node.js, no React, no build process** needed.

---

## Installation (2 minutes)

### 1. Install the plugin — **first**

WP Admin → **Plugins → Add New → Upload Plugin** → upload `siddh-sannidham-core.zip` → **Activate**.

On activation the plugin **automatically**:

- Registers CPTs: `ss_aarti`, `ss_event`, `ss_bhandara`, `ss_seva`, `ss_gallery`, `ss_testimonial`, `ss_contact`.
- Seeds default Aartis (Mangala, Bhog, Sandhya, Shayan) and default Seva options.
- Seeds Hindi Journal categories (शनि देव, आध्यात्मिक ज्ञान, मंदिर परंपरा, भक्ति, सेवा, भंडारा, त्योहार, मंत्र, पूजन, मंदिर समाचार).
- Creates the 14 site pages (About, Shani Dev, Darshan, Seva, Donate, Bhandara, Live Aarti, Events, Journal, Gallery, Visit Us, Contact, Experiences, Transparency) — each pre-assigned to its matching template.
- Creates a **Home** page and sets it as the **static front page**.
- Adds top-level admin menu **"Siddh Sannidham → Settings / Setup Pages"**.

### 2. Install the theme

WP Admin → **Appearance → Themes → Add New → Upload Theme** → upload `siddh-sannidham-theme.zip` → **Activate**.

The ZIP has the correct structure — WordPress will find `style.css` at the theme root and activation will succeed without the "missing style.css" warning.

### 3. Verify

- Visit `/` → homepage with hero + all sections.
- Visit `/donate`, `/live-aarti`, `/events`, `/journal`, `/gallery`, `/visit-us`, `/contact`, `/seva`, `/bhandara`, `/darshan`, `/shani-dev`, `/about`, `/experiences`, `/transparency`.
- If any page is missing, go to **Siddh Sannidham → Setup Pages → Create / Verify Pages**.

### 4. Recommended plugins (optional)

- **Yoast SEO** or **RankMath** — titles, OG tags, XML sitemap, schema.
- **Razorpay for WordPress** — when going live with payments (theme has ready hook: keys live in Settings, never in code).

---

## What was recreated 1:1 from the reference

| React reference | WordPress equivalent |
|---|---|
| Hero with `॥ ॐ नीलांजनसमाभासं …`, SIDDH SANNIDHAM, Hindi tagline, Live/Yatra/Donate CTAs, live badge | `patterns/hero.php` |
| Sticky header (logo · nav · lang toggle · Live · Donate · hamburger) | `parts/header.html` |
| Language toggle (हिन्दी / EN) with cookie persistence, no reload | `assets/js/app.js` |
| Temple intro card with gold glow | `patterns/temple-intro.php` |
| Live Darshan panel (video + aarti list) | `patterns/live-darshan.php` |
| Today at Siddh Sannidham (6 cards) | `patterns/today-at-temple.php` |
| Shani Dev section with backdrop | `patterns/shani-dev.php` |
| Why Devotees Visit (6 cards) | `patterns/why-visit.php` |
| Seva cards (data-driven) | `patterns/seva.php` (home) + `patterns/seva-page.php` (full) |
| Events (data-driven) | `patterns/events.php` + `patterns/events-page.php` |
| Bhandara cards + sponsorship | `patterns/bhandara.php` + `patterns/bhandara-page.php` |
| Aarti schedule + lyrics | `patterns/aarti.php` + `patterns/aarti-page.php` |
| Darshan timings + guidelines | `patterns/darshan.php` + `patterns/darshan-page.php` |
| Journal (featured + grid) | `patterns/journal.php` + `patterns/journal-page.php` |
| Gallery masonry + video grid | `patterns/gallery.php` + `patterns/gallery-page.php` |
| Visit Us (info + map + WhatsApp) | `patterns/visit-temple.php` + `patterns/visit-us-page.php` |
| Contact form + address | `patterns/contact-page.php` |
| Devotee Experiences | `patterns/experiences-page.php` |
| Transparency | `patterns/transparency-page.php` |
| About + Timeline | `patterns/about-page.php` |
| Shani Dev Knowledge Center + FAQ | `patterns/shani-dev-page.php` |
| Donate: tiers · purposes · UPI · QR · bank · where-goes | `patterns/donate-page.php` |
| Footer (identity · quick links · reach · socials · newsletter · legal) | `parts/footer.html` |
| Mobile sticky action bar (Live · Donate · Seva · Directions · WhatsApp) | `parts/footer.html` |
| Palette #0B0C10 / #12141A / #D4AF37 / #E5C158 / #F6F4EE | `style.css` + `theme.json` |
| Cinzel · Rozha One · Noto Sans Devanagari · Tiro Devanagari · Outfit | Google Fonts `@import` in `style.css` |

---

## Editing content

### Add / edit Aarti
**WP Admin → Aartis → Add New**
- Hindi Name, English Name, **Time (HH:MM, 24h)**, Days (`daily` OR `monday,saturday`), Occasion, Video URL, Active.

The theme displays **today's aartis** automatically using **Asia/Kolkata** and computes the **next aarti**.

### Add / edit Event
**WP Admin → Events → Add New** — Featured image, Hindi/English titles, **Date** (date-picker), Time, Location, Category, Registration URL, Donation URL, Video URL, Hindi/English descriptions.
Dates render as **`j F Y`** (e.g. `26 May 2026`), never raw ISO.

### Add / edit Bhandara
**WP Admin → Bhandaras → Add New** — Featured image, Hindi/English titles, Date/Time, Location, Expected devotees, Sponsorship Amount (₹), Status (`upcoming` / `past`), descriptions.

### Add / edit Seva
**WP Admin → Seva Options → Add New** — Hindi/English name, Amount, Category, Active, descriptions. Order via "Order" attribute.

### Add / edit Gallery
**WP Admin → Gallery → Add New** — Set descriptive **Title** (used as alt text) and **Featured Image**.

### Publish Journal / Blog post
**WP Admin → Posts → Add New** — Choose one of the pre-created Hindi categories.

### Add Devotee Experience
**WP Admin → Devotee Experiences → Add New** — Name (post title), City, Verified (`1`/empty), Hindi + English experiences.
*Unverified miracle claims are never published as factual statements — a disclaimer is shown at the bottom of the page.*

### Update Live Darshan
**WP Admin → Siddh Sannidham → Settings → Live Darshan**
- **Live enabled** = `1` only when a real stream is running.
- **YouTube Channel URL** and **Current Live Video URL**.

Behaviour:
- With **Live enabled** *and* a Live Video URL → red 🔴 **LIVE** badge + embedded video.
- Otherwise → *"Live Darshan is currently offline."* + a **"Watch on YouTube"** button *only if* the channel URL is filled.
- **No fake LIVE badge is ever shown.**

### Configure Donations
**WP Admin → Siddh Sannidham → Settings → Donation**
- **UPI ID** (drives the QR code).
- Bank Holder / Bank Name / Account Number / IFSC Code.
- **Configurable donation tiers 1-5** (defaults 501 / 1001 / 2501 / 5001 / 11001).
- **Razorpay Key ID / Key Secret** (optional, stored in DB — never in code).

The donate page:
- Shows the configured tiers + custom amount + purpose radios (मंदिर सेवा / भंडारा सेवा / अन्नदान / विशेष पूजा / मंदिर विकास / अन्य सेवा).
- Generates the UPI QR live from your settings.
- Records a **donation intent** into "Contact / Donation Intents" — never claims payment success without a real gateway.

### Configure Temple Hours & Status
**WP Admin → Siddh Sannidham → Settings → Temple Hours**
- Opening Time / Closing Time (24h HH:MM).
- **Manual Status Override**: `open` / `closed` / empty (auto).

The hero shows "मंदिर खुला है" / "MANDIR OPEN" or "मंदिर बंद है" / "MANDIR CLOSED" automatically, or whatever you override manually.

### Update Today at Temple
**WP Admin → Siddh Sannidham → Settings → Today at Temple** — Today's Aarti, Puja, Bhandara, Special Event.

### Update Contact info / Social links / Visit info / Media
All in **WP Admin → Siddh Sannidham → Settings**.

---

## Bilingual (Hindi / English)

- Text nodes carry `data-hi="…"` and `data-en="…"`.
- `assets/js/app.js` reads `ss_lang` cookie (default `hi`) and swaps text in-place, no reload.
- `<body>` receives `lang-hi` / `lang-en` class for server-side SEO targeting.
- Hindi is the default visible text — so Hindi-only visitors and bots always see Hindi content.

---

## SEO

- Semantic `<header>`, `<main>`, `<article>`, `<footer>`.
- WordPress supports `title-tag`, `post-thumbnails`, `responsive-embeds`, editor styles.
- Human-readable dates.
- Works with Yoast/RankMath for meta descriptions, OG tags, XML sitemap, schema.
- Post titles + featured images render cleanly for Open Graph.

---

## Content honesty

- **No invented facts** — every temple detail (phone, hours, bank, address) is an editable Setting with an empty default.
- **No fake LIVE badge** — only shown when both `live_enabled = 1` **and** a Live URL is set.
- **No fake payment success** — form records intent; wire up Razorpay when ready.
- **No fake temple photography** — every image is either an editable Media Library upload or an obvious external placeholder that admins can replace.

---

## Optional: repackage the ZIPs

Both ZIPs are already built at `/app/*.zip`. To rebuild:

```bash
cd /app/wordpress-theme  && zip -r /app/siddh-sannidham-theme.zip siddh-sannidham
cd /app/wordpress-plugin && zip -r /app/siddh-sannidham-core.zip  siddh-sannidham-core
```

WordPress requires a ZIP with **exactly one top-level folder** and `style.css` **at the theme root inside that folder** — this is what both ZIPs deliver.

---

## Package contents

**Theme (`siddh-sannidham/`, 73 files):**
- `style.css`, `theme.json`, `functions.php`, `index.php`, `screenshot.png`
- `templates/` — 22 templates (front-page, index, page, single, archive, 404, page-donate, page-live-darshan, page-live-aarti, page-about, page-shani-dev, page-darshan, page-seva, page-bhandara, page-events, page-journal, page-gallery, page-visit-us, page-contact, page-experiences, page-transparency, single-ss_event, single-ss_bhandara)
- `parts/` — header, footer
- `patterns/` — 35 patterns (hero, temple-intro, live-darshan, live-darshan-full, today-at-temple, shani-dev, why-visit, seva, events, journal, gallery, donate-cta, donate-page, visit-temple, bhandara, aarti, darshan, footer, plus full-page patterns for about/shani-dev/darshan/seva/bhandara/events/journal/gallery/visit-us/contact/experiences/transparency/aarti + single-event/single-bhandara + page-hero)
- `assets/js/app.js`

**Plugin (`siddh-sannidham-core/`):**
- `siddh-sannidham-core.php` — CPTs, meta boxes, settings UI, page auto-creation, activation seeding, donation intent handler.

---

## FAQ

**Q. WordPress says "The theme is missing the style.css stylesheet."**  
Ensure you uploaded `siddh-sannidham-theme.zip` — not the parent directory zipped from a different level. The ZIP must contain the folder `siddh-sannidham/` with `style.css` directly inside.

**Q. Pages weren't created automatically.**  
Go to **Siddh Sannidham → Setup Pages → Create / Verify Pages**.

**Q. I want to change section order on the homepage.**  
**Appearance → Editor → Templates → Front Page** — reorder the pattern blocks in the Site Editor.

**Q. I want to add a new pattern.**  
Drop a new `.php` file into `patterns/` with the standard WordPress pattern header. It will appear under **Block Editor → Patterns → Siddh Sannidham**.

**Q. The React app at `shani-divine.emergent.host` is my reference — is it still working?**  
Yes. It's under `/app/frontend`, unchanged.

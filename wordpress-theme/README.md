# Siddh Sannidham — WordPress Migration

This directory contains a **native WordPress block theme** and a companion **plugin** that recreate the current React design of **Siddh Sannidham — Shani Dev Temple** as an installable WordPress package.

The existing React application at `/app/frontend` remains untouched.

```
wordpress-theme/
  siddh-sannidham/            ← Install as WordPress theme
wordpress-plugin/
  siddh-sannidham-core/       ← Install as WordPress plugin
```

The theme controls **presentation**. The plugin controls **content** (custom post types + settings), so temple content survives future theme changes.

---

## 1. Requirements

- WordPress **6.4 or higher** (block theme + Site Editor).
- PHP **7.4 or higher**.
- Any normal WordPress host — **no Node.js, no React, no build process** needed.

---

## 2. Installation

### 2.1 Install the plugin (**do this first**)

1. Compress the folder `wordpress-plugin/siddh-sannidham-core/` into a ZIP.
2. In WordPress admin → **Plugins → Add New → Upload Plugin** → upload the ZIP → **Activate**.

This creates the following custom post types:
- **Aartis** (`ss_aarti`)
- **Events** (`ss_event`)
- **Bhandaras** (`ss_bhandara`)
- **Seva Options** (`ss_seva`)
- **Gallery** (`ss_gallery`)
- **Contact Messages** (`ss_contact`, private)

It also adds a top-level admin menu **"Siddh Sannidham → Settings"** with all editable temple information (phone, hours, live darshan URLs, UPI, bank details, etc.).

### 2.2 Install the theme

1. Compress the folder `wordpress-theme/siddh-sannidham/` into a ZIP.
2. In WordPress admin → **Appearance → Themes → Add New → Upload Theme** → upload the ZIP → **Activate**.

### 2.3 Set the homepage

1. **Settings → Reading → Your homepage displays** → *Static page*.
2. Create a new page titled **"Home"** and set it as **Homepage**.
3. The theme's `front-page.html` template will automatically render the Siddh Sannidham hero, temple intro, live darshan, today, Shani Dev, seva, events, and donate CTA sections.

### 2.4 Create the main pages (URLs referenced by the design)

Create these WordPress pages (empty content is fine — templates render their patterns automatically):

| Slug | Page Title (Hindi / English) |
|---|---|
| `/about` | परिचय / About |
| `/shani-dev` | शनि देव / Shani Dev |
| `/darshan` | दर्शन / Darshan |
| `/seva` | सेवा / Seva |
| `/donate` | दान / Donate — assign template **"Donate"** |
| `/bhandara` | भंडारा / Bhandara |
| `/live-aarti` | लाइव आरती / Live Aarti — assign template **"Live Darshan"** |
| `/events` | आयोजन / Events |
| `/journal` | जर्नल / Journal (WordPress Posts) |
| `/gallery` | गैलरी / Gallery |
| `/visit-us` | यात्रा / Visit Us |
| `/contact` | संपर्क / Contact |

Inside any of these pages you can use the **Block Editor → Patterns → Siddh Sannidham** category and drop the ready-made sections in.

### 2.5 Recommended plugins (optional)

- **Yoast SEO** or **RankMath** — meta titles, OG tags, XML sitemap, schema.
- **Contact Form 7** or **WPForms** — if you want more advanced contact forms.
- **Razorpay for WooCommerce** or **WP Razorpay** — when you go live with payments.

---

## 3. Editing content

### 3.1 Add Aarti

**Admin → Aartis → Add New**
- Title: internal reference (e.g. `Mangala Aarti`).
- **Hindi Name**: e.g. `मंगला आरती`
- **English Name**: `Mangala Aarti`
- **Time (24h)**: `05:30`
- **Days**: `daily` OR comma list `monday,tuesday,saturday`
- **Video URL** (optional).

The homepage automatically shows **today's aartis** in time order, and calculates the **next aarti** using **Asia/Kolkata**.

### 3.2 Add Event

**Admin → Events → Add New**
- Title, Featured Image.
- Hindi Title / English Title.
- **Date** (uses date picker), **Time**, Location, Category.
- Optional Registration URL, Donation URL, Video URL.
- Hindi/English description.

Displayed dates are formatted in **`j F Y`** (Indian human-readable), never raw ISO.

### 3.3 Add Bhandara

**Admin → Bhandaras → Add New**
- Same idea as Events: date/time/location/description.
- **Sponsorship Amount (₹)** — powers the "Sponsor Bhandara" CTA which links to `/donate?purpose=Bhandara+Seva&amount=…`.

### 3.4 Add Seva

**Admin → Seva Options → Add New**
- Hindi/English name, amount, category, descriptions.
- Order via "Order" (menu_order) in the sidebar.

### 3.5 Add Gallery images

**Admin → Gallery → Add New**
- Title (descriptive alt text is used for accessibility).
- Set **Featured Image**.

### 3.6 Publish a Journal / Blog post

Standard **Admin → Posts → Add New** with these Hindi categories (pre-seeded on plugin activation):
`शनि देव, आध्यात्मिक ज्ञान, मंदिर परंपरा, भक्ति, सेवा, भंडारा, त्योहार, मंत्र, पूजन, मंदिर समाचार`.

### 3.7 Update Live Darshan

**Admin → Siddh Sannidham → Settings → Live Darshan**

- **Live enabled**: `1` when a real stream is going, empty otherwise.
- **YouTube Channel URL**: link to your channel.
- **Current Live Video URL**: the specific YouTube live URL.

Behavior:
- If **Live enabled** is truthy **and** a live video URL is set → shows the video with a red **🔴 LIVE** badge.
- Otherwise → shows: *"Live Darshan is currently offline."* and a *"Watch on YouTube"* button only if the channel URL is filled in. **No fake live badge is ever shown.**

### 3.8 Configure Donations

**Admin → Siddh Sannidham → Settings → Donation**
- UPI ID.
- Bank details (holder, name, account, IFSC).
- Razorpay Key ID / Secret (optional — for future integration; **keys live in the DB, never in code**).

The donate page always shows:
- ₹501 / ₹1,001 / ₹2,501 / ₹5,001 / ₹11,001 + Custom Amount.
- Purpose: मंदिर सेवा / भंडारा सेवा / अन्नदान / विशेष पूजा / मंदिर विकास / अन्य सेवा.
- Live UPI QR generated from the settings.

Submitting the form records a **Donation Intent** in the admin (Siddh Sannidham → Contact Messages). It **never claims payment success** without a real gateway integration.

### 3.9 Configure Temple Hours

**Admin → Siddh Sannidham → Settings → Temple Hours**
- Set opening/closing times in `HH:MM` (24h).
- The hero shows **"मंदिर खुला है" / "MANDIR OPEN"** or **"मंदिर बंद है" / "MANDIR CLOSED"** automatically based on **Asia/Kolkata** time.

---

## 4. Design Preservation Checklist

| Element | Preserved via |
|---|---|
| Deep charcoal + antique gold aesthetic | `style.css` CSS variables + `theme.json` palette |
| Sanskrit invocation `॥ ॐ नीलांजनसमाभासं …` | `patterns/hero.php` |
| Cinzel / Rozha One / Noto Devanagari fonts | `style.css` `@import` + `theme.json` fontFamilies |
| Sticky navbar with logo, gold underlines | `parts/header.html` |
| Hindi/English toggle | `assets/js/app.js` (sets `ss_lang` cookie; toggles `data-hi/data-en`) |
| Live Darshan CTA, Donate CTA, Yatra CTA | Hero pattern + header |
| Card-sacred styling & gold-glow | `.card-sacred` CSS class (also registered as a block style) |
| Mobile sticky action bar (Live/Donate/Seva/Directions/WhatsApp) | `parts/footer.html` |
| Newsletter form | `parts/footer.html` + REST endpoint `siddh/v1/newsletter` |
| Contact form | `siddh/v1/contact` REST endpoint |
| Devanagari mantra font | `.font-mantra` class |

---

## 5. Bilingual Behavior

Text nodes carry `data-hi="…"` and `data-en="…"`. JS in `assets/js/app.js`:
- Reads `ss_lang` cookie (default `hi`).
- On toggle click, updates all such nodes without reload.
- Sets `data-lang` on `<html>` (you can style `[data-lang="en"]` if needed).

Body classes `lang-hi` / `lang-en` are added server-side for SEO/CSS targeting. Individual Hindi paragraphs also carry the actual Devanagari as the default text, so **bots and Hindi-only visitors always see Hindi content**.

---

## 6. SEO

- Semantic tags: `<header>`, `<main>`, `<footer>`, `<article>`.
- `title-tag`, `post-thumbnails`, `responsive-embeds` supported.
- Human-readable dates (`j F Y`).
- Works with Yoast/RankMath for meta descriptions, OG tags, XML sitemap.

---

## 7. Do Not Fake — Content Rules

- **No invented history, no invented phone numbers, no invented statistics.** Fields default to `—` or the settings placeholder until the temple administrator fills them in.
- **No fake "LIVE" badge** — only shown when `live_enabled = 1` **and** a live URL is set.
- **No fake payment success** — the current architecture records intent only and is ready to be wired to Razorpay (keys already have slots in Settings).
- **No stock imagery presented as temple photography** — every image is easy to replace through **Media Library** and Gallery CPT.

---

## 8. Optional: ZIP the deliverables

From the repository root:

```bash
cd wordpress-theme && zip -r ../siddh-sannidham-theme.zip siddh-sannidham && cd ..
cd wordpress-plugin && zip -r ../siddh-sannidham-core.zip siddh-sannidham-core && cd ..
```

Upload both ZIPs through the WordPress admin. The plugin should be **installed and activated before the theme**.

---

## 9. Support Files

- `wordpress-theme/siddh-sannidham/style.css` — theme stylesheet + tokens.
- `wordpress-theme/siddh-sannidham/theme.json` — Site Editor palette/typography.
- `wordpress-theme/siddh-sannidham/functions.php` — theme wiring, REST endpoints, helper functions.
- `wordpress-theme/siddh-sannidham/templates/*.html` — front-page, index, page, single, archive, 404, page-donate, page-live-darshan.
- `wordpress-theme/siddh-sannidham/parts/{header,footer}.html`
- `wordpress-theme/siddh-sannidham/patterns/*.php` — 14 reusable block patterns.
- `wordpress-theme/siddh-sannidham/assets/js/app.js` — bilingual toggle + temple open status + form submits.
- `wordpress-plugin/siddh-sannidham-core/siddh-sannidham-core.php` — CPTs, meta boxes, settings, donation intent handler.

---

`Existing React app under /app/frontend is UNCHANGED and remains fully deployable at shani-divine.emergent.host.`

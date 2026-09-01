# Siddh Sannidham — PRD

## Deliverables
- **React app** at `/app/frontend` (existing, unchanged) — approved design reference.
- **WordPress block theme** at `/app/wordpress-theme/siddh-sannidham/` (v1.3.0).
- **WordPress companion plugin** at `/app/wordpress-plugin/siddh-sannidham-core/` (v1.3.0).
- ZIPs at `/app/siddh-sannidham-theme.zip` and `/app/siddh-sannidham-core.zip`.

## WordPress Migration
Recreated the approved React design as a native block theme with **complete Gutenberg editability**.

### Theme
- `style.css` (design tokens), `theme.json`, `functions.php`, `index.php`.
- Header/footer via reliable `[siddh_header]` / `[siddh_footer]` shortcodes (zero PHP-in-HTML leakage).
- Shortcodes: `[siddh_contact_form]`, `[siddh_donate_page]` — power the form UI while surrounding copy stays Gutenberg-editable.
- Templates: `front-page.html` + **all 15 page-*.html templates now use `wp:post-content`** — every visitor-facing element is a native block.
- Patterns retained only for CPT-driven dynamic sections (Seva grid, Events list, Bhandara list, Live Darshan iframe, Visit info).
- `assets/js/app.js`: bilingual toggle (cookie `ss_lang`), temple open/closed status (Asia/Kolkata), form submissions.

### Plugin
- CPTs: `ss_aarti`, `ss_event`, `ss_bhandara`, `ss_seva`, `ss_gallery`, `ss_testimonial`, `ss_contact`.
- Settings page: phone, hours, live darshan URLs, UPI, bank, socials, today info, darshan timings, visit info, media, Razorpay key placeholders.
- **`page-contents.php`** — seeder functions for every page (about, shani-dev, darshan, seva, bhandara, live-aarti, events, journal, gallery, visit-us, contact, donate, experiences, transparency).
- **Setup Pages screen** — Create/Verify Pages, Reseed Home, Reseed ALL Pages, plus a per-page reseed matrix with direct "Edit" links.

### Gutenberg editability (Feb 2026 update)
Admin can now edit natively for every page:
- Hero image (Media Library replace)
- Eyebrow, H1, subtitle, gold separator
- Section headings, paragraphs
- Buttons (label + URL, gold-primary / gold-outline block styles)
- Columns / grid layouts
- Full gallery (add/remove/reorder/replace/caption)
- Query Loop on Journal (categories, excerpts, pagination)
- Cover blocks (background image + overlay)

Dynamic sections (Seva grid, Events, Bhandara, Live Darshan, Today's Aartis) pull from CPTs/settings — also fully editable in WP Admin, no code required.

### Live Darshan
- YouTube live URL, channel URL and live-enabled flag are editable at **WP Admin → Siddh Sannidham → Settings → Live Darshan**.
- When no live URL is set, page shows a beautiful offline fallback with a "Watch on YouTube" CTA — no broken iframe.

### Razorpay
- Placeholder keys exist in settings. **No fake payment success**. Donation form captures intent (`ss_contact` post, admin-post handler with nonce). Ready for a secure Razorpay integration whenever keys are provided; secrets never leak to frontend.

## Content rules
- Fonts: Cinzel, Rozha One, Noto Sans Devanagari, Outfit, Tiro Devanagari.
- Palette: `#0B0C10` / `#12141A` / `#D4AF37` / `#E5C158` / `#F6F4EE`.
- Bilingual: `data-hi` / `data-en` attributes + cookie-driven toggle (`ss_lang`).
- Dates: `j F Y` (Indian human-readable).

## Verification
- All PHP files pass `php -l`.
- Seeder synthetic test: 14/14 non-home pages produce valid block markup with editable Cover heroes and headings.
- Theme ZIP validated: `style.css` at root, all 15 templates present.

## Backlog
- **P1**: Razorpay checkout integration via `integration_playbook_expert_v2` when keys provided (server-side order creation, signature verification, receipt).
- **P2**: Convert legacy `.php` patterns still referenced by seeders (seva, events, bhandara, live-darshan, visit-temple, darshan) into fully-editable Query Loop / block equivalents where practical.
- **P2**: SEO plugin schema (RankMath / Yoast) tuning per page.
- **P2**: Sponsor Gratitude Wall CPT + pattern.

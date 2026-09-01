# Siddh Sannidham — PRD

## Deliverables
- **React app** at `/app/frontend` (existing, unchanged) — approved design.
- **WordPress block theme** at `/app/wordpress-theme/siddh-sannidham/`.
- **WordPress companion plugin** at `/app/wordpress-plugin/siddh-sannidham-core/`.
- ZIPs at `/app/siddh-sannidham-theme.zip` and `/app/siddh-sannidham-core.zip`.

## WordPress Migration (Feb 2026)
Recreated the approved React design as a native block theme:
- style.css, theme.json, functions.php, index.php.
- templates: front-page, index, page, single, archive, 404, page-donate, page-live-darshan.
- parts: header, footer (with mobile sticky action bar).
- 14 patterns: hero, temple-intro, live-darshan, live-darshan-full, today-at-temple, shani-dev, why-visit, seva, events, journal, gallery, donate-cta, donate-page, visit-temple, bhandara, aarti, darshan, footer.
- assets/js/app.js: bilingual toggle, temple open/closed status (Asia/Kolkata), form submissions.
- Companion plugin registers CPTs: ss_aarti, ss_event, ss_bhandara, ss_seva, ss_gallery, ss_contact.
- Settings page under "Siddh Sannidham → Settings": phone, hours, live darshan URLs, UPI, bank, socials, today info, darshan timings, visit info, media.
- No fake LIVE badge, no invented facts, no fake payment success.
- All PHP files pass `php -l`.

## Content rules
- Fonts: Cinzel, Rozha One, Noto Sans Devanagari, Outfit, Tiro Devanagari.
- Palette: #0B0C10 / #12141A / #D4AF37 / #E5C158 / #F6F4EE.
- Bilingual: `data-hi` / `data-en` attributes + cookie-driven toggle.
- Dates: `j F Y` (Indian human-readable).

## Backlog
- P1: Razorpay integration (keys slot ready in Settings).
- P2: Elementor/Bricks compat, SEO plugin schema tuning.
- P2: Ajax donation confirmation once gateway is wired.

# The McLaughlin Group — WordPress Site

Real estate website for The McLaughlin Group, Agoura Hills CA. Being templated for resale to other realtor clients.

## What this repo is

This directory **is the `wp-content` folder**. It is not a full WordPress install. WordPress Studio (Automattic's local dev app) provides WordPress core and the local server separately, and this repo is symlinked as its `wp-content`.

## First-time setup

1. Download and install [WordPress Studio](https://developer.wordpress.com/studio/)
2. Create a new blank site in Studio (e.g., name it `tmg`)
3. Open the site folder via Studio's folder icon (Show in Finder)
4. Run: `./bin/setup.sh /path/to/studio-site-folder`
5. Restart WordPress Studio and open the site

The setup script backs up Studio's default wp-content and symlinks this repo in its place.

## Tech stack

- **WordPress** with **SQLite** (no MySQL — database file is `database/.ht.sqlite`, committed to repo)
- **Block editor** (Full Site Editing) — no classic PHP templates
- **No build step** — plain PHP, CSS, and vanilla JS
- **Splide carousel** v4.1.4 via CDN
- **Inter** typeface via Google Fonts

## Theme

`themes/dave-mclaughlin-group/` — child theme of TwentyTwentyfive.

Key files:
- `theme.json` — design tokens (brand red `#B20000`, fluid type, layout widths)
- `templates/` — full-page block templates (front-page, contact, team, areas, testimonials, etc.)
- `patterns/` — reusable block patterns; cache is flushed on every load (dev-only, see HANDOFF.md)
- `assets/js/carousels.js` — Splide init for listings + testimonials carousels
- `assets/js/header.js` — smart sticky header (hide on scroll-down, reveal on scroll-up)

## mu-plugins/

All files are must-use plugins, auto-loaded by WordPress.

**Custom post types:**

| File | CPT slug | Purpose |
|------|----------|---------|
| `dmg-listings.php` | `dmg_listing` | Property listings (price, beds, baths, sqft, HOA, garage, lot size, open house, featured flag); also auto-creates `/listings/` archive page |
| `dmg-reviews.php` | `dmg_review` | Client testimonials (rating, quote, source) |
| `dmg-contact.php` | `dmg_inquiry` | Contact form submissions; routes buyer vs. seller email; sends email on submit |

All CPTs have REST API support enabled.

**Self-healing page managers** (create standard `page` entries on init; idempotent):

| File | Pages created | Notes |
|------|---------------|-------|
| `dmg-team.php` | `/meet-the-team/` | |
| `dmg-areas.php` | `/areas/` + 8 community child pages | Also emits `<meta name="description">` on each area page |
| `dmg-give-back.php` | `/we-give-back/` + `/we-give-back/royal-family-kids/` | Also emits SEO meta description |

**Settings plugins:**

| File | Purpose |
|------|---------|
| `dmg-video.php` | YouTube channel feed — stores channel URL + auto-resolved channel ID; `dmg_get_youtube_videos(n)` fetches the public Atom RSS feed and caches results for 1 hour; optional featured video override |

## SQLite notes

The database is committed to git (`database/.ht.sqlite`). This is intentional for portability — no separate DB import needed. One developer should own content changes at a time to avoid merge conflicts on the binary file.

## Before launching to production

- Remove the pattern cache flush in `themes/dave-mclaughlin-group/functions.php` lines 72–74
- Decide on a MySQL migration path (SQLite is dev-only; production WordPress typically uses MySQL)
- See `HANDOFF.md` for the full launch checklist and outstanding items

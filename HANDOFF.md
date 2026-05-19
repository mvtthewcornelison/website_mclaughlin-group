# TMG.com — Handoff Notes

---

## Current Homepage Order

| # | Section | Background |
|---|---------|------------|
| 1 | Hero | Dark (video overlay) |
| 2 | Featured Listings | Light (gray-50) |
| 3 | Latest Videos | Dark (gray-900) |
| 4 | Neighborhoods / Areas | Light (gray-50) |
| 5 | Buyer CTA | Light (gray-50) |
| 6 | Testimonials | Dark (gray-900) |

Patterns preserved on disk but not on homepage: `home-mission.php`, `home-seller-cta.php`.

---

## Recent Changes (not yet in HANDOFF history)

### Video section — commit `55ebe63`
Replaced single manual video embed with a live YouTube channel feed:
- `mu-plugins/dmg-video.php`: adds `dmg_youtube_channel_id` option; `dmg_resolve_youtube_channel_id()` auto-extracts the `UCxxxxx` ID from the channel URL on save; `dmg_get_youtube_videos(4)` fetches YouTube's public Atom feed (no API key), caches results for 1 hour via transient
- `patterns/home-video.php`: redesigned to show 1 large hero video + 3 smaller recent videos; thumbnails load first, click swaps to inline iframe (no redirect to YouTube); brand-red play button overlays; responsive (stacks on mobile)
- Admin: Settings → Featured Video now has Channel URL, Channel ID (auto-resolved), and optional Featured Video Override fields

### Neighborhoods section — commit `e2e6a6b`
Re-added `dmg/home-areas` to `front-page.html` between video and buyer CTA sections.

---

## Known Issues / Snags (Don't Repeat These)

### 1. Featured-only filter broke homepage carousel
`dmg_get_featured_listings()` exists in `dmg-listings.php` but the homepage uses `dmg_get_listings()` (all listings). Don't swap to `dmg_get_featured_listings()` until Dave has checked the `dmg_featured` checkbox on his listings — existing listings don't have it set.

### 2. Pattern double-registration
In a WordPress 6.0+ block theme, patterns in `patterns/` with a `Slug:` header auto-register. Never also call `register_block_pattern()` with `file_get_contents()` on a `.php` pattern file — it reads source code, not rendered output, and corrupts the pattern in the block editor.

### 3. Auto-create pages must not be guarded by `is_admin()`
All self-healing page managers (`dmg-team.php`, `dmg-areas.php`, `dmg-listings.php`) must run on every `init` with no admin guard. A guard would cause the page to only exist after the admin has logged into wp-admin at least once.

### 4. Contact form: check server-side required fields when reusing the handler
`dmg_handle_contact_submit()` requires phone. Any new form using this handler must mark phone as `required` in the HTML or submissions will fail server-side with a generic error.

---

## Outstanding / Blocked

| Item | Status | Blocker |
|------|--------|---------|
| YouTube Channel ID resolved | Verify | Check Settings → Featured Video after saving channel URL |
| Dave high-res headshot | Pending | Waiting on Dave |
| Kelly headshot + bio | Pending | Waiting on Dave |
| Charity spotlight content | Pending | Waiting on Dave (Royal Family Kids) |
| Area descriptions | Pending | Canned text still in place on all 8 area pages |
| Nav "Open Listings" link | Pending | Admin step — WP Admin → Appearance → Editor → Navigation → change `/#listings` → `/listings/` |
| Domain selection | Open | Client decision |
| CRM (Keller) routing | Deferred | Not active yet |
| Hero video clipper tool | Deferred | Future feature (hook comment in `home-hero.php`) |
| IDX integration | Deferred | Waiting on CRMLS credentials |

---

## Before Launch Checklist

- [ ] Verify YouTube Channel ID resolved in Settings → Featured Video (should show `UC...`)
- [ ] Remove pattern cache flush — `themes/dave-mclaughlin-group/functions.php` lines 72–74
- [ ] Decide on MySQL migration path (SQLite is dev-only)
- [ ] Update nav "Open Listings" link to `/listings/` in WP Site Editor
- [ ] Add Dave high-res headshot + Kelly headshot/bio to team page
- [ ] Add charity spotlight content (Royal Family Kids)
- [ ] Replace canned area descriptions on all 8 neighborhood pages
- [ ] Populate actual listing data (description, garage, lot size, open house) on existing listings
- [ ] Test inquiry form on a listing detail page end-to-end
- [ ] Test buyer vs. seller email routing

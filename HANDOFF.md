# TMG.com — Handoff Prompt (Post Client Review Session)

## Where to Find the Plan

The full implementation plan lives at:
```
~/.claude/plans/claude-code-handoff-structured-clover.md
```

That file contains the complete section-by-section spec with complexity ratings, file paths, and verification steps. Read it before making further changes to understand the intended architecture.

---

## What Was Completed (commit `643fcec`)

### Hero
- CTA button label changed: "Open listings" → "My Featured Listings"
- Button now links to `/listings/` (the new archive page)
- Overlay opacity increased: 50% → 55% (visibly darker, video still visible)
- Future hook comment added near the video element for the video clipper tool

### Homepage Section Reorder
New order: **Hero → Featured Listings → Latest Video → Buyer CTA → Seller CTA → Testimonials**

Removed from homepage (patterns preserved, not deleted):
- `home-mission.php` — mission statement + stats bar + awards (has a top comment explaining why it was removed; available for a future `/about/` page)
- `home-areas.php` — still accessible at `/areas/`; just not on the homepage

### Native Listing Detail Pages (Primary Build Task)

**`mu-plugins/dmg-listings.php`** — Extended significantly:
- CPT is now `public: true` with `rewrite slug: listings` and `has_archive: false`
- New meta fields: `dmg_description`, `dmg_garage`, `dmg_lot_size`, `dmg_open_house`, `dmg_featured` (boolean)
- New helper: `dmg_get_featured_listings()` — queries only listings where `dmg_featured = 1`
- Auto-creates "Open Listings" page at `/listings/` with template `page-listings`
- Rewrite rules flush runs once on init when `/listings/` isn't in the rules yet

**`templates/single-dmg_listing.html`** — Template for individual listing pages at `/listings/{slug}/`

**`patterns/listing-detail.php`** — Full detail page:
- 60vh hero image from first gallery photo
- Splide photo gallery (initialized via `.dmg-listing-gallery` in `carousels.js`)
- Key details bar: price, beds, baths, sqft, garage, lot size, HOA, status badge
- Open house notice (conditional — only shown if field is set)
- Property description with nl2br
- Neighborhood link → `/areas/{slug}/`
- Inline inquiry form → existing `dmg_contact_submit` handler, source=`listing-inquiry`
- "← Back to listings" link uses `home_url('/listings/')` for portability

**`templates/page-listings.html`** — Template for the browse/archive page

**`patterns/listings-archive.php`** — Full browse page:
- Status filter buttons: All / Active / Pending / Sold (client-side, no reload)
- Neighborhood dropdown: all 8 areas
- Medium (3-col) / Large (2-col) view toggle, persisted in `localStorage`
- Filter state persisted in `sessionStorage`
- Empty state message when all cards are filtered out
- All cards pre-rendered in PHP; JS shows/hides via `hidden` attribute

### Latest Video Section

**`mu-plugins/dmg-video.php`** (new):
- Registers `dmg_featured_video_url` and `dmg_youtube_channel_url` options
- Settings > Featured Video admin page — two URL fields with nonce + capability check

**`patterns/home-video.php`** (new):
- Tries `wp_oembed_get()` first, falls back to direct iframe (handles both `youtube.com/watch?v=` and `youtu.be/` formats)
- If URL empty + logged in: shows yellow admin notice
- If URL empty + logged out: renders section heading + "See All Videos" link only (no broken embed)
- "See All Videos" falls back to `href="#"` with HTML comment if channel URL not set yet

### Buyer/Seller Form Routing

**`mu-plugins/dmg-contact.php`**:
- New `dmg_seller_email` option (defaults to `ddmclaugh@aol.com`)
- New helper `dmg_contact_seller_email()`
- Routing: if `$source` contains "sell" → seller email; otherwise → buyer/general email
- Settings > Contact Settings admin page for both email addresses
- New source labels added: `seller-inquiry`, `buyer-inquiry`, `listing-inquiry`

**`patterns/home-seller-cta.php`**: source param → `seller-inquiry`
**`patterns/home-buyer-cta.php`**: source param → `buyer-inquiry`

### Charity Spotlight Block

**`patterns/charity-spotlight.php`** (new):
- Available in block editor under Patterns → Featured as "Charity Spotlight"
- Static HTML with placeholder img tags and a prominent comment block explaining to Dave how to update it
- Optional CTA button is commented out with instructions to uncomment
- NOT placed on any page automatically — Dave inserts it where he wants

---

## Required Admin Step (Cannot Be Done in Code)

**Update the "Open Listings" nav link:**
The navigation still links to `/#listings` (the old homepage anchor). It needs to be updated to `/listings/`.

Path: WP Admin → Appearance → Editor → Navigation → click "Open Listings" → change URL to `/listings/`

This requires the WordPress Site Editor, which operates outside of code/git.

---

## Known Issues / Snags (Don't Repeat These)

### 1. Featured-only filter broke existing listings
**What happened:** The plan called for a `dmg_get_featured_listings()` function for the homepage carousel so Dave could curate what appears. The implementation swapped `dmg_get_listings()` → `dmg_get_featured_listings()` in `home-listings.php`. But the existing two listings didn't have `dmg_featured = 1`, so the carousel showed empty.

**Resolution:** Reverted `home-listings.php` to use `dmg_get_listings()` (all listings). The `dmg_featured` field and `dmg_get_featured_listings()` helper still exist in `dmg-listings.php` for future use if Dave wants to curate the carousel — but the homepage currently shows all published listings.

**Lesson:** Don't change which listings appear in the homepage carousel without first ensuring existing data has been migrated. The checkbox is there; Dave just hasn't had a chance to check it on his listings yet.

### 2. Charity spotlight double-registration
**What happened:** The `charity-spotlight.php` pattern has a `Slug:` header for auto-registration (WordPress 6.0+ behavior). The implementer also added an explicit `register_block_pattern()` call in `functions.php` using `file_get_contents()` on the `.php` file — which returns raw PHP source including `<?php` tags, corrupting the pattern content in the block editor.

**Resolution:** Removed the explicit `register_block_pattern()` call from `functions.php`. Auto-registration from the file header is sufficient for all patterns in this theme.

**Lesson:** In a WordPress 6.0+ block theme, patterns in `patterns/` with a `Slug:` header auto-register. Never also call `register_block_pattern()` with `file_get_contents()` on a `.php` pattern file — that reads source code, not rendered output.

### 3. Auto-create page guarded by is_admin()
**What happened:** The auto-create logic for the `/listings/` page was initially written with an `if ( ! is_admin() )` early return, meaning it only ran on wp-admin requests. On a fresh install, visiting `/listings/` from the front end before logging into wp-admin would return a 404.

**Resolution:** Removed the guard. The `get_page_by_path()` idempotency check inside still prevents duplicate creation. All other self-healing page managers in this codebase (team, areas, contact) run on every init with no admin guard.

### 4. Phone field required server-side but optional in client form
**What happened:** The listing detail inquiry form initially rendered the phone field without `required`. But `dmg_handle_contact_submit()` includes phone in its required-fields validation — so any submission without a phone number would fail server-side with a generic error message and no clear UX feedback.

**Resolution:** Added `required` attribute and `<span class="req">*</span>` to the phone label in `listing-detail.php`, matching the pattern used for name and email.

**Lesson:** When reusing the contact form handler in a new context, double-check which fields it actually requires. The main contact page form at `/contact-us/` already marks phone as required visually, but this wasn't obvious when building the separate listing inquiry form.

---

## Outstanding / Blocked

| Item | Status | Blocker |
|------|--------|---------|
| YouTube channel URL | Pending | Waiting on Dave |
| Featured video URL | Pending | Waiting on Dave |
| Dave high-res headshot | Pending | Waiting on Dave |
| Kelly headshot + bio | Pending | Waiting on Dave |
| Charity spotlight content | Pending | Waiting on Dave (Royal Family Kids) |
| Area descriptions | Pending | Canned text still in place |
| Nav "Open Listings" link | Pending | Admin step (WP Site Editor) |
| Domain selection | Open | Client decision |
| CRM (Keller) routing | Deferred | Not active yet |
| Hero video clipper tool | Deferred | Future feature |
| IDX integration | Deferred | Waiting on CRMLS credentials |

---

## Before Launch Checklist (from CLAUDE.md)

- [ ] Remove pattern cache flush in `themes/dave-mclaughlin-group/functions.php` lines 72–74
- [ ] Decide on MySQL migration path (SQLite is dev-only)
- [ ] Update nav "Open Listings" link to `/listings/` in WP Site Editor
- [ ] Set YouTube URL in Settings > Featured Video
- [ ] Set YouTube channel URL in Settings > Featured Video
- [ ] Populate actual listing data (description, garage, lot size, open house) on existing listings
- [ ] Test inquiry form on a listing detail page end-to-end
- [ ] Test buyer vs. seller email routing

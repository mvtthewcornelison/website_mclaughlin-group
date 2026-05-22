# Neighborhood Pages — Listings-First Redesign

**Date:** 2026-05-19  
**Status:** Approved for implementation

---

## Context

Currently only Agoura Hills has a fully built-out neighborhood page (`patterns/area-agoura-hills.php` + `templates/page-agoura-hills.html`). The other 7 community pages (Malibou Lake, Westlake Village, Thousand Oaks, Newbury Park, Oak Park, Malibu, Ventura) exist in the WordPress database via `dmg-areas.php` but have no pattern files or page templates — they render blank.

The existing Agoura Hills page buries the listings section in section 4 of 14. The goal is to surface active listings as the first thing a visitor sees on any neighborhood page, prioritizing Dave's featured listings, and laying the groundwork for IDX/MLS integration.

**Homepage structure is unchanged.**

---

## Section Order (all 8 pages)

```
1.  Listings Grid         ← new position, very top of page
2.  Hero                  ← community photo, title, intro, CTAs
3.  Community Snapshot    ← 8-card grid
4.  About the Community   ← long-form prose
5.  Neighborhoods Within  ← 4 sub-neighborhood cards
6.  Schools               ← public district + private options
7.  Lifestyle             ← outdoors, dining, shopping, community
8.  Commute               ← drive times to key LA destinations
9.  Why Locals Stay       ← narrative + [Dave to personalize] placeholder
10. Seller CTA            ← seller prioritized over buyer
11. Buyer CTA
12. FAQ                   ← 6 questions, Schema.org FAQPage markup
13. Nearby Communities    ← 3-tile grid
14. Final CTA
```

---

## Data Layer — `mu-plugins/dmg-listings.php`

### New function: `dmg_get_area_listings_prioritized( $area_slug )`
- Runs two `get_posts()` calls:
  1. Featured listings in this area (`dmg_featured = 1` + `dmg_neighborhood = $area_slug`), ordered by `menu_order ASC, date DESC`
  2. Non-featured listings in this area, same ordering
- Returns merged flat array: `[...featured, ...regular]`

### New function: `dmg_render_area_listing_card( $listing, $badge = null )`
- Accepts a `WP_Post` object and an optional badge label string
- Renders the full `<article>` card HTML (thumbnail, status badge, address, price, beds/baths/sqft, "View listing" button)
- If `$badge` is set, renders a pill above the status badge (e.g. "Featured" in brand red, "MLS Listing" in gray)
- Called with `$badge = 'Featured'` for Dave's featured listings; `null` for regular listings

### New function: `dmg_render_idx_listing_card( $idx_listing )`
- Accepts an associative array with keys: `title`, `price`, `beds`, `baths`, `sqft`, `status`, `detail_url`, `thumb`
- Renders same card HTML as `dmg_render_area_listing_card()`, always with "MLS Listing" badge

---

## IDX Integration Hook

In each area pattern, after rendering Dave's listings:

```php
$idx_listings = apply_filters( 'dmg_idx_listings_for_area', [], $area_slug );
foreach ( $idx_listings as $idx_listing ) {
    dmg_render_idx_listing_card( $idx_listing );
}
```

- Returns `[]` always until a future IDX plugin hooks in
- IDX plugin will `add_filter( 'dmg_idx_listings_for_area', $callback, 10, 2 )` and return an array of normalized listing arrays
- Same 3-column grid, same card design, "MLS Listing" badge distinguishes source

---

## Listings Section UI

- **Light background section**, full-width
- **Eyebrow:** "Homes for Sale"
- **H2:** "Active Listings in [Community Name]"
- **Anchor ID:** `#{slug}-homes` (e.g. `#agoura-hills-homes`) — kept for deep-linking but hero "View homes for sale" CTA is removed (listings are already above the hero, the scroll-up would be awkward)
- **Card order within grid:** Dave's Featured → Dave's Regular → IDX/MLS
- **Featured card:** adds "Featured" pill (brand red) alongside existing Active/Pending/Sold status badge
- **MLS card:** adds "MLS Listing" pill (neutral gray)
- **Empty state (no listings, no IDX):** dashed-border box — "No active listings right now — reach out to be notified" with contact link
- **Responsive:** 3 col → 2 col (tablet) → 1 col (mobile)

---

## Files Modified

| File | Change |
|------|--------|
| `mu-plugins/dmg-listings.php` | Add 3 new functions (prioritized query, Dave card renderer, IDX card renderer) |
| `patterns/area-agoura-hills.php` | Move listings to top (section 1); swap Seller/Buyer CTA order; use new shared functions |

## Files Created

### Pattern files (7 new)
| File | Area |
|------|------|
| `patterns/area-malibou-lake.php` | Malibou Lake |
| `patterns/area-westlake-village.php` | Westlake Village |
| `patterns/area-thousand-oaks.php` | Thousand Oaks |
| `patterns/area-newbury-park.php` | Newbury Park |
| `patterns/area-oak-park.php` | Oak Park |
| `patterns/area-malibu.php` | Malibu |
| `patterns/area-ventura.php` | Ventura |

Each contains full community-specific content: snapshot stats, long-form About prose, sub-neighborhood cards, schools (public + private), lifestyle activities, commute times, FAQs, nearby community tiles. "Why Locals Stay" section ends with a `[Dave to personalize]` placeholder.

### Page templates (7 new)
| File | Slug |
|------|------|
| `templates/page-malibou-lake.html` | malibou-lake |
| `templates/page-westlake-village.html` | westlake-village |
| `templates/page-thousand-oaks.html` | thousand-oaks |
| `templates/page-newbury-park.html` | newbury-park |
| `templates/page-oak-park.html` | oak-park |
| `templates/page-malibu.html` | malibu |
| `templates/page-ventura.html` | ventura |

Each is a 10-line block template (identical structure to `page-agoura-hills.html`) referencing the corresponding `dmg/area-{slug}` pattern.

---

## Existing Functions Reused

- `dmg_get_listings_by_area( $area_slug )` — `mu-plugins/dmg-listings.php:391` — not replaced, still used elsewhere
- `dmg_areas_definitions()` — `mu-plugins/dmg-areas.php:15` — source of truth for all 8 slugs/names
- Existing card CSS classes (`dmg-listing-card`, `dmg-listing-status--*`) — no new CSS needed for base cards
- Existing section CSS (`dmg-area-section`, `dmg-area-section--alt`, `dmg-area-section--dark`) — all 8 pages reuse these

---

## Verification

1. Visit `/areas/agoura-hills/` — listings grid is the first element on the page (above the hero photo)
2. Mark a listing `dmg_featured = 1` with `dmg_neighborhood = agoura-hills` — confirm it appears before non-featured listings with a "Featured" badge
3. Visit all 7 new area pages — confirm they render with full content and listings section at top
4. Confirm homepage (`/`) is unchanged
5. IDX hook test: temporarily add `add_filter( 'dmg_idx_listings_for_area', function( $l, $slug ) { return [ [ 'title' => 'Test MLS', 'price' => '$1,200,000', 'beds' => '3', 'baths' => '2', 'sqft' => '1800', 'status' => 'active', 'detail_url' => '#', 'thumb' => '' ] ]; }, 10, 2 );` to `functions.php` — confirm an "MLS Listing" badged card appears after Dave's listings, then remove the test code

# IDX/MLS Integration — The McLaughlin Group

## Status: Phase 1 complete. Blocked on FlexMLS API credentials.

---

## What Was Built (Session: 2026-05-31)

### Decisions made
- **Vendor confirmed:** FlexMLS IDX by FBS — already installed at `plugins/flexmls-idx/` v3.18.2
- **Primary listings page:** `/listings/` (existing page) — not a new `/my-listings/` page. Nav "My Listings" links here.
- **Open Houses:** Removed from nav. Filter lives inside Search Homes. `/open-houses/` page exists for SEO only.
- **Nav order:** My Listings → Search Homes → Communities ▾ → Who We Are → Contact Us → We Give Back ▾

### Files created
- `mu-plugins/dmg-idx-pages.php` — self-healing seeder for all IDX/city pages, SEO meta descriptions, IDX bridge stub
- `themes/dave-mclaughlin-group/templates/page-idx-content.html` — shell template for functional IDX pages
- `themes/dave-mclaughlin-group/templates/page-idx-city.html` — shell template for city SEO pages
- `themes/dave-mclaughlin-group/templates/page-communities.html` — references communities hub pattern
- `themes/dave-mclaughlin-group/patterns/communities-hub.php` — static grid, Browse Listings + Community Guide per city

### Files modified
- `themes/dave-mclaughlin-group/parts/header.html` — updated with new nav (note: nav is database-managed via Site Editor; file is the fallback)
- `themes/dave-mclaughlin-group/patterns/area-*.php` (all 8) — added "Browse all [City] listings on MLS" CTA after listings grid

### Pages seeded (auto-created by dmg-idx-pages.php on site start)
- `/search-homes/`, `/my-past-sales/`, `/open-houses/`, `/communities/`
- `/agoura-hills-homes-for-sale/`, `/malibou-lake-homes-for-sale/`, `/westlake-village-homes-for-sale/`
- `/thousand-oaks-homes-for-sale/`, `/newbury-park-homes-for-sale/`, `/oak-park-homes-for-sale/`
- `/malibu-homes-for-sale/`, `/ventura-homes-for-sale/`

### Still needs doing before next session
- [ ] Flush permalinks: WP Admin → Settings → Permalinks → Save (or restart site)
- [ ] Dave to contact FBS (866-320-9977) for API Key + Secret tied to MLS ID C159092398

---

## Context

Agent: Dave McLaughlin · DRE #01256235 · MLS ID: C159092398  
Brokerage: Keller Williams Westlake Village · Office DRE #01523573 · Office MLS ID: CG13890001  
MLS: CMAOR via CRMLS on FlexMLS

**IDX vendor selected: FlexMLS IDX by FBS** (`plugins/flexmls-idx/`, v3.18.2, installed)  
Credentials needed: API Key + Secret from FBS — call 866-320-9977 or fill out `https://fbsproducts.com/form/wordpress-plugin-secret-key-request/`  
Enter credentials at: **WP Admin → Flexmls IDX → Credentials**

---

## Pages

| Page | Slug | Template | IDX shortcode (post-vendor) | Status |
|------|------|----------|-----------------------------|--------|
| Listings | `/listings/` | `page-listings` → update to `page-idx-content` post-vendor | `[idx_listing_summary]` filtered to Agent ID C159092398, status=active | Page exists; template update pending |
| Search Homes | `/search-homes/` | `page-idx-content` | `[idx_search]` — full MLS search, all filters | ✅ Page seeded |
| My Past Sales | `/my-past-sales/` | `page-idx-content` | `[idx_listing_summary]` filtered to Agent ID C159092398, status=sold | ✅ Page seeded |
| Open Houses | `/open-houses/` | `page-idx-content` | `[idx_custom_links]` or open house filter via `[idx_search]` | ✅ Page seeded (SEO only, not in nav) |
| Communities | `/communities/` | `page-communities` | None — static hub | ✅ Live |
| Agoura Hills | `/agoura-hills-homes-for-sale/` | `page-idx-city` | `[idx_search location="Agoura Hills"]` | ✅ Page seeded |
| Malibou Lake | `/malibou-lake-homes-for-sale/` | `page-idx-city` | `[idx_search location="Malibou Lake"]` | ✅ Page seeded |
| Westlake Village | `/westlake-village-homes-for-sale/` | `page-idx-city` | `[idx_search location="Westlake Village"]` | ✅ Page seeded |
| Thousand Oaks | `/thousand-oaks-homes-for-sale/` | `page-idx-city` | `[idx_search location="Thousand Oaks"]` | ✅ Page seeded |
| Newbury Park | `/newbury-park-homes-for-sale/` | `page-idx-city` | `[idx_search location="Newbury Park"]` | ✅ Page seeded |
| Oak Park | `/oak-park-homes-for-sale/` | `page-idx-city` | `[idx_search location="Oak Park"]` | ✅ Page seeded |
| Malibu | `/malibu-homes-for-sale/` | `page-idx-city` | `[idx_search location="Malibu"]` | ✅ Page seeded |
| Ventura | `/ventura-homes-for-sale/` | `page-idx-city` | `[idx_search location="Ventura"]` | ✅ Page seeded |

**Note on `/listings/`:** Currently uses the `dmg/listings-archive` pattern (native CPT listings). Post-vendor, update `templates/page-listings.html` to use `<!-- wp:post-content /-->` instead of the pattern, then insert the `[idx_listing_summary]` shortcode into the page content via WP Admin.

---

## Navigation (current, set via Site Editor)

```
My Listings → /listings/
Search Homes → /search-homes/
Communities ▾ → /communities/ (dropdown: 8 city pages)
Who We Are → /who-we-are/
Contact Us → /contact-us/
We Give Back ▾ → Royal Family Kids
```

---

## Available FlexMLS Shortcodes

| Shortcode | Use |
|-----------|-----|
| `[idx_listing_summary]` | Grid of listings — use for `/listings/` (agent filter) and `/my-past-sales/` |
| `[idx_search]` | Full search form — use for `/search-homes/` and all 8 city pages |
| `[idx_location_links]` | Pre-built city search links — optional on Communities page |
| `[idx_custom_links]` | Saved searches — optional for open houses or featured searches |
| `[idx_slideshow]` | Listing photo slideshow — optional for homepage |
| `[market_stats]` | Market statistics — optional on city SEO pages |
| `[idx_portal_login]` | Buyer portal login — can add to nav or page |

**Note:** `[idx_agent_search]` is restricted to Office/MLS accounts only — not available on a Member account like Dave's.

---

## Phase 1 — Pre-Vendor Scaffolding ✅ Complete

- ✅ `mu-plugins/dmg-idx-pages.php` — page seeder, SEO meta, bridge stub
- ✅ `templates/page-idx-content.html` — shell for functional IDX pages
- ✅ `templates/page-idx-city.html` — shell for city SEO pages
- ✅ `templates/page-communities.html` — references communities hub pattern
- ✅ `patterns/communities-hub.php` — static grid with Browse Listings + Community Guide per city
- ✅ Nav updated via Site Editor (My Listings → `/listings/`, Search Homes, Communities dropdown, etc.)
- ✅ CTA links added to all 8 area patterns → `/[city]-homes-for-sale/`
- ✅ 12 new pages seeded and accessible
- [ ] Delete `/my-listings/` page from WP Admin → Pages (orphaned, no longer needed)
- [ ] Flush permalinks after next site restart

---

## Phase 2 — Get Credentials & Connect Plugin

- [ ] Dave contacts FBS (866-320-9977) and requests API Key + Secret for MLS ID C159092398
- [ ] Confirm CMAOR/CRMLS feed is included in the account
- [ ] Enter Key + Secret at WP Admin → Flexmls IDX → Credentials → green "Connected" badge confirms success
- [ ] Verify feed is live: go to WP Admin → Flexmls IDX → Settings, confirm MLS/association shows correctly

---

## Phase 3 — IDX Configuration (After Connected)

1. **`/listings/` page template** — update `templates/page-listings.html`: replace `<!-- wp:pattern {"slug":"dmg/listings-archive"} /-->` with `<!-- wp:post-content /-->`
2. **Insert shortcodes** via WP Admin → Pages editor for each page:
   - `/listings/` → `[idx_listing_summary]` with agent ID filter for C159092398, status=active
   - `/search-homes/` → `[idx_search]` with all filters enabled
   - `/my-past-sales/` → `[idx_listing_summary]` with agent ID filter, status=sold/closed
   - `/open-houses/` → `[idx_search]` or `[idx_custom_links]` filtered to open houses
   - Each city page → `[idx_search location="[City Name]"]`
3. **Bridge function** — replace stub in `dmg-idx-pages.php` with real `dmg_idx_listings_for_area` implementation using FlexMLS PHP API to return listings for area pattern grids
4. **CSS reconciliation** — FlexMLS injects its own styles; check against theme design tokens in `theme.json`

---

## Phase 4 — Compliance & QA

- [ ] MLS disclaimer renders on every IDX page
- [ ] Fair Housing logo renders
- [ ] Agent DRE #01256235 and Office DRE #01523573 appear on listing detail pages
- [ ] `/listings/` shows ONLY Dave's active listings (not all MLS)
- [ ] `/my-past-sales/` shows ONLY Dave's sold listings
- [ ] Open house filter works in Search Homes
- [ ] Rentals available as property type filter in Search Homes
- [ ] Confirm sold listing lookback window (CRMLS typically 365 days)
- [ ] Area pattern grids show IDX listings via bridge function
- [ ] Mobile QA on all IDX pages
- [ ] Core Web Vitals check (FlexMLS adds JS weight — test with Lighthouse)
- [ ] Submit updated sitemap to Google Search Console

---

## Outstanding Questions for FBS

1. Does Dave's CMAOR account include access to the full CRMLS feed or only CMAOR listings?
2. Does `[idx_listing_summary]` support filtering by agent MLS ID (C159092398) for both active and sold status?
3. If Dave is a co-listing agent (not primary), does he appear under the agent ID filter?
4. Does the feed include residential rentals, and is there a rental property type filter in `[idx_search]`?

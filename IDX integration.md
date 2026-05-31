# IDX/MLS Integration Plan — The McLaughlin Group

## Context

The site is a nearly finished WordPress block theme (FSE, no build step) for realtor Dave McLaughlin. The next major feature is an IDX/MLS feed integration via a third-party plugin (vendor not yet selected). The plan must scaffold everything that can be built now without the vendor plugin, then define exactly what changes once it is installed.

Agent: Dave McLaughlin · DRE #01256235 · MLS ID: C159092398  
Brokerage: Keller Williams Westlake Village · Office DRE #01523573 · Office MLS ID: CG13890001  
MLS association text provided: "CMAMOR" — likely CMAOR/CSMAR via CRMLS on FlexMLS. **Must be verified with vendor.**

---

## 1. Architecture

**Integration method: shortcode-in-page-content**

Each IDX page is a standard WordPress page whose `post_content` holds the vendor shortcode. A minimal block template renders `<!-- wp:post-content /-->`, which passes the content through `the_content` filter — the standard hook IDX plugins use to process shortcodes. This keeps shortcodes editable from WP admin without code deploys and avoids fragile widget/sidebar injection (no sidebars exist in this theme).

**Exception — area pages:** Each area pattern (`patterns/area-agoura-hills.php` etc.) already calls `apply_filters('dmg_idx_listings_for_area', [], $area_slug)` at line 13. Post-vendor, a bridge function in `dmg-idx-pages.php` hooks here to inject MLS listings. The render stub `dmg_render_idx_listing_card()` (`mu-plugins/dmg-listings.php:513`) already defines the expected data shape: `['status', 'thumb', 'title', 'price', 'beds', 'baths', 'sqft', 'detail_url']`.

**Template consolidation:** Rather than 13 identical template files, use two generic shells assigned via `_wp_page_template` meta in the seeder:
- `page-idx-content.html` — header + `<!-- wp:post-content /-->` + footer (5 functional IDX pages)
- `page-idx-city.html` — identical structure (8 city SEO pages)

Splitting into two templates preserves the ability to style them differently later.

**Slug conflict strategy:** The existing `dmg_listing` CPT auto-creates a page at `/listings/` (`dmg-listings.php:541`). Keep it there. Configure the IDX vendor's "My Listings" page to `/my-listings/`. If a vendor insists on `/listings/`, rename the CPT page to `/agent-listings/` at that time (one-line change in `dmg-listings.php` + 301 redirect). Do not rename preemptively.

---

## 2. Pages

| Page | Slug | Template | IDX content | Pre or Post vendor |
|------|------|----------|-------------|-------------------|
| My Listings | `/my-listings/` | `page-idx-content` | Agent ID C159092398, status=active | Post |
| Search Homes | `/search-homes/` | `page-idx-content` | Full MLS search widget, all filters | Post |
| My Past Sales | `/my-past-sales/` | `page-idx-content` | Agent ID C159092398, status=sold | Post |
| Open Houses | `/open-houses/` | `page-idx-content` | Open house filter, service area cities | Post |
| Communities | `/communities/` | `page-communities` (pattern-based) | None — static navigation hub | **Pre** |
| Agoura Hills Homes | `/agoura-hills-homes-for-sale/` | `page-idx-city` | City-filtered search widget | Post |
| Malibou Lake Homes | `/malibou-lake-homes-for-sale/` | `page-idx-city` | City-filtered search widget | Post |
| Westlake Village Homes | `/westlake-village-homes-for-sale/` | `page-idx-city` | City-filtered search widget | Post |
| Thousand Oaks Homes | `/thousand-oaks-homes-for-sale/` | `page-idx-city` | City-filtered search widget | Post |
| Newbury Park Homes | `/newbury-park-homes-for-sale/` | `page-idx-city` | City-filtered search widget | Post |
| Oak Park Homes | `/oak-park-homes-for-sale/` | `page-idx-city` | City-filtered search widget | Post |
| Malibu Homes | `/malibu-homes-for-sale/` | `page-idx-city` | City-filtered search widget | Post |
| Ventura Homes | `/ventura-homes-for-sale/` | `page-idx-city` | City-filtered search widget | Post |

City SEO pages seed static `post_content` at creation (H1 + 2-3 sentence intro) so they are functional before IDX is live.

---

## 3. Pre-Vendor Work (Build Now)

### New: `mu-plugins/dmg-idx-pages.php`

Self-healing seeder following the same pattern as `dmg-areas.php` and `dmg-listings.php`. On `init` (priority 20):
- Create all 13 pages listed above with correct `post_name`, `post_content` (static copy for city pages), and `_wp_page_template` meta
- Emit `<meta name="description">` via `wp_head` for all 13 pages (the existing `dmg-areas.php` SEO hook only covers `/areas/` children — these pages are top-level)
- Include stub: `add_filter('dmg_idx_listings_for_area', '__return_empty_array', 5, 2)` — placeholder until vendor bridge is written

### New: `templates/page-idx-content.html`
```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->
<!-- wp:group {"tagName":"main","layout":{"type":"default"}} -->
<main class="wp-block-group"><!-- wp:post-content /--></main>
<!-- /wp:group -->
<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

### New: `templates/page-idx-city.html`
Identical to `page-idx-content.html`. Separate file to allow independent styling later.

### New: `templates/page-communities.html`
References `<!-- wp:pattern {"slug":"dmg/communities-hub"} /-->` instead of post-content.

### New: `patterns/communities-hub.php`
Static grid linking to all 8 `/[city]-homes-for-sale/` pages and their corresponding `/areas/[slug]/` community guides. No IDX content.

### Modify: `parts/header.html`
Replace the existing 4-link nav with:
- **Search Homes** → `/search-homes/`
- **My Listings** → `/my-listings/`
- **Open Houses** → `/open-houses/`
- **Communities** → dropdown with 8 city links → `/[city]-homes-for-sale/`
- **Who We Are** → `/who-we-are/` (keep)
- **Contact Us** → `/contact-us/` (keep)
- **We Give Back** → submenu (keep, move to end)

Remove or repurpose the "Open Listings" hash-anchor link (`/#listings`) — it points to a homepage section that won't be the primary listings entry point once IDX is live.

### Modify: 8 area patterns (`patterns/area-*.php`)
In each area pattern, add a "Browse Active MLS Listings →" CTA button near the listings grid header linking to `/[city]-homes-for-sale/`. This provides navigation before IDX is live and deepens the link between community guides and IDX search pages.

---

## 4. Post-Vendor Work (After Plugin Install)

1. **Dashboard config:** Enter Agent MLS ID `C159092398` and Office MLS ID `CG13890001`. Configure each widget/shortcode per the page table above. Enable sold listing display (confirm CRMLS 365-day window applies).
2. **Shortcode insertion:** Insert vendor shortcodes into each page's `post_content` via WP admin.
3. **Bridge function:** Replace the stub in `dmg-idx-pages.php` with a real `dmg_idx_listings_for_area` implementation calling the vendor's PHP API. Return arrays matching `dmg_render_idx_listing_card()`'s expected keys.
4. **CSS overrides:** IDX plugins inject their own styles; budget time for reconciling with the theme's design tokens in `theme.json`.
5. **Slug audit:** Before activating the plugin, document every page it auto-creates. Delete or redirect any that conflict with existing slugs.

---

## 5. Files Summary

**Create:**
- `mu-plugins/dmg-idx-pages.php`
- `templates/page-idx-content.html`
- `templates/page-idx-city.html`
- `templates/page-communities.html`
- `patterns/communities-hub.php`

**Modify:**
- `parts/header.html` — nav update
- `patterns/area-agoura-hills.php`, `area-malibu.php`, `area-malibou-lake.php`, `area-westlake-village.php`, `area-thousand-oaks.php`, `area-newbury-park.php`, `area-oak-park.php`, `area-ventura.php` — add CTA link in each

**Possibly modify (post-vendor, if slug conflict):**
- `mu-plugins/dmg-listings.php:541` — change page `post_name` from `listings` to `agent-listings`

---

## 6. Vendor Questions (Must Resolve Before Plugin Install)

1. **MLS feed:** "Do you support a CRMLS feed for CMAOR (Conejo-Malibu Association of Realtors) in Ventura County and LA County West?" Confirm the feed name/source.
2. **Agent ID filter:** "Can I display only listings where the listing agent MLS ID equals C159092398 — in both active and sold/closed status?"
3. **Co-listing:** "If the agent is the co-listing agent (not primary), do they appear under the agent ID filter?"
4. **Sold listings:** "Do you support filtering sold/closed listings by agent ID, and what is the lookback window under CRMLS rules?"
5. **Rentals:** "Does the CRMLS/CMAOR feed include residential rentals, and can I expose a rental property type filter in the search widget?"
6. **Slug ownership:** "Which URL slugs does your plugin claim on activation, and can all of them be customized before install?"
7. **Block theme compatibility:** "Do your shortcodes/widgets work inside `<!-- wp:post-content /-->` blocks on a WordPress Full Site Editing theme? Any known issues with Twenty Twenty-Five child themes?"
8. **Compliance:** "Which MLS compliance elements (disclaimers, Fair Housing logo, DRE numbers on listings) does your plugin inject automatically, and which must I add manually?"

---

## 7. Implementation Checklist

### Phase 1 — Pre-Vendor Scaffolding
- [ ] Create `mu-plugins/dmg-idx-pages.php` (page seeder + SEO meta + bridge stub)
- [ ] Create `templates/page-idx-content.html`
- [ ] Create `templates/page-idx-city.html`
- [ ] Create `templates/page-communities.html`
- [ ] Create `patterns/communities-hub.php`
- [ ] Update `parts/header.html` navigation
- [ ] Add CTA links to all 8 area patterns
- [ ] Start site; verify all 13 new pages exist and render without errors
- [ ] Flush permalinks (`studio wp eval 'flush_rewrite_rules();'`)
- [ ] Confirm no slug collisions with existing CPT rewrites

### Phase 2 — Vendor Selection
- [ ] Ask all 8 vendor questions above before signing up
- [ ] Install plugin on a local staging copy first; document auto-created pages
- [ ] Verify no slug conflicts; resolve if needed
- [ ] Check IDX plugin CSS doesn't break existing layouts

### Phase 3 — IDX Configuration
- [ ] Set Agent and Office MLS IDs in vendor dashboard
- [ ] Configure and insert shortcodes for all 5 functional IDX pages
- [ ] Configure and insert city-filtered shortcodes for all 8 city SEO pages
- [ ] Implement `dmg_idx_listings_for_area` bridge function for area pattern grids

### Phase 4 — Compliance and QA
- [ ] MLS disclaimer renders on every IDX page
- [ ] Fair Housing logo renders
- [ ] Agent DRE #01256235 and Office DRE #01523573 appear on listing detail pages
- [ ] "My Listings" shows ONLY Dave's listings
- [ ] "My Past Sales" shows ONLY Dave's sold listings
- [ ] Rentals appear as a filter in Search Homes
- [ ] Open Houses page shows only service area open houses
- [ ] Area pattern grids show IDX listings via bridge function
- [ ] Mobile QA on all IDX pages
- [ ] Core Web Vitals check (IDX plugins add significant JS weight)
- [ ] Submit updated sitemap to Google Search Console

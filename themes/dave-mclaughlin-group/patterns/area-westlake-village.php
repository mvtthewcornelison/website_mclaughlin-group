<?php
/**
 * Title: Area - Westlake Village
 * Slug: dmg/area-westlake-village
 * Categories: featured
 * Inserter: false
 */

$hero_image   = get_theme_file_uri( 'assets/images/neighborhoods/westlake-village.jpeg' );
$area_slug    = 'westlake-village';
$area_name    = 'Westlake Village';
$listings     = function_exists( 'dmg_get_area_listings_prioritized' ) ? dmg_get_area_listings_prioritized( $area_slug ) : [];
$idx_listings = apply_filters( 'dmg_idx_listings_for_area', [], $area_slug );
$has_listings = ! empty( $listings ) || ! empty( $idx_listings );

$resolve_neighbor_image = function ( $slug ) {
	foreach ( [ 'jpg', 'jpeg', 'png', 'webp' ] as $ext ) {
		$rel = "assets/images/neighborhoods/{$slug}.{$ext}";
		if ( file_exists( get_theme_file_path( $rel ) ) ) {
			return get_theme_file_uri( $rel );
		}
	}
	return '';
};

$nearby = [
	[ 'name' => 'Agoura Hills',   'slug' => 'agoura-hills',   'desc' => 'Adjacent community with equestrian heritage, top-rated schools, and a strong neighborhood culture just minutes away.' ],
	[ 'name' => 'Thousand Oaks',  'slug' => 'thousand-oaks',  'desc' => 'The Conejo Valley\'s largest city with wide-ranging amenities, parks, and strong Conejo Valley USD schools.' ],
	[ 'name' => 'Oak Park',       'slug' => 'oak-park',       'desc' => 'Small, family-first community with one of the highest-rated school districts in California, just over the hill.' ],
];

$faqs = [
	[ 'q' => 'What makes Westlake Village unique?', 'a' => 'Westlake Village was built around a 160-acre private lake in 1968, and the lake remains the community\'s defining feature. Waterfront properties, a yacht club, and lakeside walking paths give it a resort quality unusual for an inland Southern California suburb. It also straddles the Los Angeles and Ventura county lines, which affects property taxes and school district assignment.' ],
	[ 'q' => 'Which school district serves Westlake Village?', 'a' => 'It depends on which side of the county line your home falls on. Properties on the Los Angeles County side are served by Las Virgenes Unified School District (LVUSD), with students attending Lindero Canyon Middle and Agoura High. Properties on the Ventura County side are served by Conejo Valley Unified (CVUSD), with students attending Colina Middle and Westlake High. Both districts are highly regarded.' ],
	[ 'q' => 'Are there lakefront homes in Westlake Village?', 'a' => 'Yes, but they are among the most tightly held properties in the Conejo Valley. The most exclusive lakefront area is The Island, a collection of estates accessible only by private bridge. Homes along the Bridgegate waterfront corridor offer lake proximity at a broader range of price points.' ],
	[ 'q' => 'How far is Westlake Village from Los Angeles?', 'a' => 'Westlake Village is approximately 35 miles from downtown Los Angeles. Beverly Hills is roughly 30–35 minutes via the 101 without traffic. Burbank and the San Fernando Valley are around 25–30 minutes.' ],
	[ 'q' => 'What is the price range for homes in Westlake Village?', 'a' => 'Entry-level condos and townhomes near the lake start around $700K–$900K. Single-family homes in established neighborhoods typically run from the low $1M range to $2M–$3M. Lakefront estates and properties in North Ranch can reach $4M–$8M or above depending on lot, view, and improvements.' ],
	[ 'q' => 'Is Westlake Village safe?', 'a' => 'Westlake Village is consistently among the lowest-crime communities in the greater Los Angeles area. Its combination of planned development, strong community association infrastructure, and engaged residents has maintained that quality for decades.' ],
];
?>

<!-- ====== 1. LISTINGS (top of page) ====== -->
<!-- wp:html -->
<section class="dmg-area-section" id="westlake-village-homes">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Homes for Sale</p>
		</div>
		<h2 class="dmg-area-section-title">Active Listings in Westlake Village</h2>

		<?php if ( $has_listings ) : ?>
			<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.75rem;margin:0 auto;max-width:1280px">
				<?php foreach ( $listings as $listing ) :
					$is_featured = get_post_meta( $listing->ID, 'dmg_featured', true ) === '1';
					dmg_render_area_listing_card( $listing, $is_featured ? 'Featured' : null );
				endforeach; ?>
				<?php foreach ( $idx_listings as $idx_listing ) :
					dmg_render_idx_listing_card( $idx_listing );
				endforeach; ?>
			</div>
		<?php else : ?>
			<div style="text-align:center;padding:3rem 2rem;background:var(--wp--preset--color--gray-50);border:1px dashed var(--wp--preset--color--gray-300)">
				<p style="font-size:1rem;color:var(--wp--preset--color--gray-700);margin:0 0 0.5rem">No active listings in Westlake Village at the moment.</p>
				<p style="font-size:0.9375rem;color:var(--wp--preset--color--gray-500);margin:0">Inventory in this market moves quickly, <a href="/contact-us/?subject=Questions%20about%20Westlake%20Village&amp;source=reach-out" style="color:var(--wp--preset--color--primary);font-weight:600;text-decoration:underline">reach out</a> to be notified when something becomes available.</p>
			</div>
		<?php endif; ?>
	</div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="dmg-area-hero" style="background-image:url('<?php echo esc_url( $hero_image ); ?>')" aria-label="Living in Westlake Village">
	<div class="dmg-area-hero-inner">
		<span class="dmg-area-hero-eyebrow">Conejo Valley Communities</span>
		<h1 class="dmg-area-hero-title">Living in Westlake Village</h1>
		<p class="dmg-area-hero-intro">A planned lakeside community built around a 160-acre private lake - one of the most refined and sought-after addresses in the Conejo Valley.</p>
		<div class="dmg-area-hero-ctas">
			<a class="dmg-btn-secondary" href="/contact-us/?subject=Speak%20with%20a%20local%20expert&amp;source=local-expert">Speak with a local expert</a>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 3. COMMUNITY SNAPSHOT ====== -->
<!-- wp:html -->
<section class="dmg-area-section">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">At a Glance</p>
		</div>
		<h2 class="dmg-area-section-title">Westlake Village, in Brief</h2>

		<div class="dmg-snapshot-grid">
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Lifestyle</p>
				<p class="dmg-snapshot-value">Upscale Lakeside Suburban</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Known For</p>
				<p class="dmg-snapshot-value">Private lake, golf courses, waterfront living</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">School District</p>
				<p class="dmg-snapshot-value">Las Virgenes USD / Conejo Valley USD (county-line split)</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Population</p>
				<p class="dmg-snapshot-value">~8,400</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Nearby Cities</p>
				<p class="dmg-snapshot-value">Agoura Hills, Thousand Oaks, Calabasas</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Commute to LA</p>
				<p class="dmg-snapshot-value">~30–35 min via US&#8209;101</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Walkability</p>
				<p class="dmg-snapshot-value">Moderate – walkable near the lake</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Best For</p>
				<p class="dmg-snapshot-value">Families, professionals, water enthusiasts</p>
			</div>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 4. ABOUT THE COMMUNITY ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--alt">
	<div class="dmg-area-section-inner">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4 8 4v14"/><path d="M9 9h.01"/><path d="M9 13h.01"/><path d="M15 9h.01"/><path d="M15 13h.01"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">About</p>
		</div>
		<h2 class="dmg-area-section-title">A Community Built Around a Lake</h2>

		<div class="dmg-area-prose">
			<p>Westlake Village was not discovered - it was designed. In 1968, the American-Hawaiian Steamship Company broke ground on a master-planned community centered on a 160-acre private lake, with every street, park, and commercial zone deliberately placed. What makes the result unusual is that it worked. More than fifty years on, the lake is still the community&rsquo;s organizing principle, the streets are walkable in ways most of the Conejo Valley is not, and the planning has held.</p>

			<p>The community straddles the Los Angeles and Ventura county lines, a quirk that shapes more than just mailing addresses. Property taxes differ between the two sides. School district assignment depends on which county your home falls in - Las Virgenes USD on the LA side, Conejo Valley USD on the Ventura side - and both districts are worth attention. Most buyers who move to Westlake Village know which side they&rsquo;re on before they close.</p>

			<p>The lake is active. The Westlake Yacht Club runs regattas, sailing instruction, and a full program of on-water events. The lakeside walking path circles the entire perimeter and is one of the more genuinely pleasant places to spend a morning in the Conejo Valley. The Island - a small collection of estate properties accessible only by private bridge - remains one of the most exclusive residential addresses in the region.</p>

			<p>Westlake Village has a pronounced corporate identity that its neighbors do not. Several significant company headquarters sit along the Thousand Oaks Boulevard corridor. That professional presence gives the community a working-day energy that coexists, somewhat unusually, with its resort-adjacent lake lifestyle.</p>

			<p>Real estate in Westlake Village covers a genuine range. Entry-level condos and townhomes near the water, hillside single-family homes in Westlake Hills, golf course properties in North Ranch, and the lakefront estates of The Island - the price spread is meaningful, and the community has room for buyers at multiple stages of life.</p>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 5. NEIGHBORHOODS WITHIN ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--alt">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Neighborhoods</p>
		</div>
		<h2 class="dmg-area-section-title">Where People Live in Westlake Village</h2>

		<div class="dmg-subhood-grid">
			<article class="dmg-subhood-card">
				<h3>The Island</h3>
				<p>A private enclave of ~30 lakefront estates accessible only by bridge. Among the most exclusive residential addresses in the Conejo Valley.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Lakefront</span>
					<span class="dmg-subhood-tag">Ultra-Luxury</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>North Ranch</h3>
				<p>Golf course community with the North Ranch Country Club at its center. Hillside homes, larger lots, and a more private, gated character.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Golf Course</span>
					<span class="dmg-subhood-tag">Estate</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Bridgegate / The Lakes</h3>
				<p>Waterfront condos, townhomes, and single-family homes along the lake&rsquo;s eastern edge. More accessible price point with genuine lake proximity.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Waterfront</span>
					<span class="dmg-subhood-tag">Mixed</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Westlake Hills</h3>
				<p>Established hillside neighborhood with valley views, tree-lined streets, and a mix of mid-size single-family homes popular with families.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Views</span>
					<span class="dmg-subhood-tag">Family</span>
				</div>
			</article>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 6. SCHOOLS ====== -->
<!-- wp:html -->
<section class="dmg-area-section">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Schools</p>
		</div>
		<h2 class="dmg-area-section-title">Two Highly Rated Districts</h2>

		<div class="dmg-area-prose" style="margin-bottom:3rem">
			<p>School district assignment in Westlake Village depends on which side of the LA/Ventura county line your home sits on. Both <strong>Las Virgenes USD</strong> (LA County side) and <strong>Conejo Valley USD</strong> (Ventura County side) are top-ranked districts. Most buyers determine their district assignment before closing.</p>
		</div>

		<div class="dmg-info-cols">
			<div>
				<h3>LA County Side (LVUSD)</h3>
				<ul>
					<li><strong>Lindero Canyon Middle School</strong><small>Middle &middot; Agoura Hills</small></li>
					<li><strong>Agoura High School</strong><small>High &middot; Agoura Hills</small></li>
				</ul>
				<h3 style="margin-top:1.5rem">Ventura County Side (CVUSD)</h3>
				<ul>
					<li><strong>Colina Middle School</strong><small>Middle &middot; Thousand Oaks</small></li>
					<li><strong>Westlake High School</strong><small>High &middot; Thousand Oaks</small></li>
				</ul>
			</div>
			<div>
				<h3>Nearby Private Options</h3>
				<ul>
					<li><strong>Oaks Christian School</strong><small>Grades 6&ndash;12 &middot; Westlake Village</small></li>
					<li><strong>Hillcrest Christian School</strong><small>K&ndash;12 &middot; Thousand Oaks</small></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 7. LIFESTYLE & THINGS TO DO ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--alt">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="m3 17 6-6 4 4 8-8"/><path d="M14 7h7v7"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Lifestyle</p>
		</div>
		<h2 class="dmg-area-section-title">Things To Do in Westlake Village</h2>

		<div class="dmg-info-cols">
			<div>
				<h3>Outdoors</h3>
				<ul>
					<li><strong>Westlake Lake</strong><small>Sailing, kayaking, paddleboarding</small></li>
					<li><strong>North Ranch Country Club</strong><small>Golf, tennis, private club amenities</small></li>
					<li><strong>The Stonehaus</strong><small>Outdoor winery + gathering space</small></li>
					<li><strong>Conejo Valley trail system</strong><small>Multi-use trails throughout the hills</small></li>
				</ul>
			</div>
			<div>
				<h3>Dining &amp; Coffee</h3>
				<ul>
					<li><strong>The Stonehaus</strong><small>Wine bar + outdoor patio landmark</small></li>
					<li><strong>Bru Burger</strong><small>Local casual dining favorite</small></li>
					<li><strong>The Promenade restaurants</strong><small>Full range of options at the outdoor mall</small></li>
				</ul>
			</div>
			<div>
				<h3>Shopping</h3>
				<ul>
					<li><strong>The Promenade at Westlake</strong><small>Upscale outdoor shopping mall</small></li>
					<li><strong>Westlake Village Town Center</strong><small>Boutique shops near the lake</small></li>
				</ul>
			</div>
			<div>
				<h3>Community</h3>
				<ul>
					<li><strong>Westlake Yacht Club</strong><small>Regattas, sailing instruction, events</small></li>
					<li><strong>Westlake Village Arts Foundation</strong><small>Arts events and programming</small></li>
					<li><strong>Lakeside farmers markets</strong><small>Seasonal community markets</small></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 8. COMMUTE & ACCESSIBILITY ====== -->
<!-- wp:html -->
<section class="dmg-area-section">
	<div class="dmg-area-section-inner">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Getting Around</p>
		</div>
		<h2 class="dmg-area-section-title">Commute &amp; Access</h2>

		<div class="dmg-area-prose">
			<p>Common reference points: <strong>Beverly Hills</strong> ~30&ndash;35 min via US&#8209;101 &middot; <strong>Burbank</strong> ~25 min &middot; <strong>Santa Monica</strong> ~30 min &middot; <strong>Downtown LA</strong> ~45 min &middot; <strong>LAX</strong> ~50 min. The 101 provides the primary corridor; Malibu Canyon Road offers a scenic route south to the coast in about 25 minutes.</p>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 9. WHY PEOPLE LOVE LIVING HERE ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--dark">
	<div class="dmg-area-section-inner">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M19.5 12.572 12 20l-7.5-7.428A5 5 0 1 1 12 6.006a5 5 0 1 1 7.5 6.566Z"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Why Locals Stay</p>
		</div>
		<h2 class="dmg-area-section-title">A Community That Keeps Its Promises</h2>

		<div class="dmg-area-prose">
			<p>Westlake Village earns its reputation for a reason. The lake is real, the schools are genuinely strong on both sides of the county line, and the community has a cared-for quality that comes from decades of intentional planning and resident investment. People arrive expecting a pleasant suburb and stay for something quieter: the walk to the lake on a weekday morning, the sense that the neighborhood keeps its promises.</p>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 10. SELLER CTA ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--dark">
	<div class="dmg-cta-block">
		<h2>Considering Selling in Westlake Village?</h2>
		<p style="color:var(--wp--preset--color--gray-100)">With deep local knowledge and a relationship-first approach, we help homeowners navigate the selling process with experience, integrity, and care. No high-pressure pitch, just an honest conversation about your home and the market.</p>
		<div class="dmg-cta-row">
			<a class="dmg-btn-primary" href="/contact-us/?subject=Speak%20with%20Dave&amp;source=speak-with-dave">Speak with Dave</a>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 11. BUYER CTA ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--alt">
	<div class="dmg-cta-block">
		<h2>Thinking About Moving to Westlake Village?</h2>
		<p>The McLaughlin Group has helped buyers navigate the Conejo Valley for generations. Whether you&rsquo;re relocating, purchasing your first home, or searching for your forever home, we&rsquo;d be honored to help guide you through the process.</p>
		<div class="dmg-cta-row">
			<a class="dmg-btn-primary" href="/contact-us/?subject=Schedule%20a%20consultation&amp;source=schedule-consultation">Schedule a consultation</a>
			<a class="dmg-btn-secondary" style="color:var(--wp--preset--color--gray-900);border-color:var(--wp--preset--color--gray-900)" href="#westlake-village-homes">Explore homes</a>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 12. FAQ ====== -->
<!-- wp:html -->
<section class="dmg-area-section">
	<div class="dmg-area-section-inner">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Frequently Asked</p>
		</div>
		<h2 class="dmg-area-section-title">Westlake Village FAQs</h2>

		<div class="dmg-faq-list">
			<?php foreach ( $faqs as $faq ) : ?>
				<details class="dmg-faq-item">
					<summary><?php echo esc_html( $faq['q'] ); ?></summary>
					<div class="dmg-faq-item-body"><?php echo esc_html( $faq['a'] ); ?></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 13. NEARBY COMMUNITIES ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--alt">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M3 12h18"/><path d="M3 18h18"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Explore Nearby</p>
		</div>
		<h2 class="dmg-area-section-title">Neighboring Communities</h2>

		<div class="dmg-areas-grid dmg-areas-grid--nearby">
			<?php foreach ( $nearby as $n ) :
				$image = $resolve_neighbor_image( $n['slug'] );
				$has   = (bool) $image;
			?>
				<a class="dmg-area-tile<?php echo $has ? '' : ' dmg-area-tile--placeholder'; ?>" href="<?php echo esc_url( '/areas/' . $n['slug'] . '/' ); ?>" aria-label="<?php echo esc_attr( $n['name'] ); ?>">
					<?php if ( $has ) : ?>
						<span class="dmg-area-image" style="background-image:url('<?php echo esc_url( $image ); ?>')" aria-hidden="true"></span>
					<?php endif; ?>
					<span class="dmg-area-name"><?php echo esc_html( $n['name'] ); ?></span>
					<span class="dmg-area-arrow" aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 14. FINAL CTA ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--dark" style="padding-top:7rem;padding-bottom:7rem">
	<div class="dmg-cta-block">
		<h2>Work With a Team That Truly Knows the Conejo Valley</h2>
		<p style="color:var(--wp--preset--color--gray-100)">For three generations, the McLaughlin family has lived, worked, and built relationships throughout the Conejo Valley. We don&rsquo;t just sell homes here - we proudly call this community home.</p>
		<div class="dmg-cta-row">
			<a class="dmg-btn-primary" href="/contact-us/?subject=Contact%20Dave&amp;source=contact-dave">Contact Dave</a>
		</div>
	</div>
</section>

<!-- Schema.org structured data - Place + FAQPage -->
<script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@graph": [
		{
			"@type": "Place",
			"name": "Westlake Village",
			"description": "A master-planned lakeside community in the Conejo Valley, known for its 160-acre private lake, golf courses, and upscale residential neighborhoods.",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "Westlake Village",
				"addressRegion": "CA",
				"addressCountry": "US"
			}
		},
		{
			"@type": "FAQPage",
			"mainEntity": [
				<?php
				$json_faqs = [];
				foreach ( $faqs as $faq ) {
					$json_faqs[] = sprintf(
						'{"@type":"Question","name":%s,"acceptedAnswer":{"@type":"Answer","text":%s}}',
						wp_json_encode( $faq['q'] ),
						wp_json_encode( $faq['a'] )
					);
				}
				echo implode( ',', $json_faqs );
				?>
			]
		}
	]
}
</script>
<!-- /wp:html -->

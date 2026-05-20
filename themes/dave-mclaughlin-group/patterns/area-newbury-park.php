<?php
/**
 * Title: Area - Newbury Park
 * Slug: dmg/area-newbury-park
 * Categories: featured
 * Inserter: false
 */

$hero_image   = get_theme_file_uri( 'assets/images/neighborhoods/newbury-park.png' );
$area_slug    = 'newbury-park';
$area_name    = 'Newbury Park';
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
	[ 'name' => 'Thousand Oaks', 'slug' => 'thousand-oaks', 'desc' => 'Newbury Park\'s city partner — shares government, schools, and amenities while offering a broader range of neighborhoods and price points.' ],
	[ 'name' => 'Oak Park',      'slug' => 'oak-park',      'desc' => 'Small family-focused community over the Ventura County line with one of California\'s highest-ranked school districts.' ],
	[ 'name' => 'Ventura',       'slug' => 'ventura',       'desc' => 'Coastal city to the northwest, reached via the 23 freeway in about 30 minutes — beach, harbor, and a lively downtown.' ],
];

$faqs = [
	[ 'q' => 'What is Newbury Park known for?', 'a' => 'Newbury Park is best known for its trail access, family-friendly neighborhoods, and as a gateway to some of the best hiking in Ventura County, including routes into Point Mugu State Park and the Boney Mountain Wilderness. It also offers some of the most accessible price points in the Conejo Valley, making it a popular choice for first-time buyers and young families.' ],
	[ 'q' => 'Is Newbury Park its own city?', 'a' => 'Technically, no. Newbury Park is an unincorporated community that became part of the City of Thousand Oaks when it incorporated in 1964. It functions with its own identity and zip code, but shares city government, public services, and the Conejo Valley USD school district with Thousand Oaks proper.' ],
	[ 'q' => 'What school district serves Newbury Park?', 'a' => 'Newbury Park is served by Conejo Valley Unified School District (CVUSD). The local high school is Newbury Park High School, which has strong athletics and arts programs and consistently solid academic ratings within the district.' ],
	[ 'q' => 'What is Dos Vientos Ranch?', 'a' => 'Dos Vientos Ranch is a master-planned residential community developed in Newbury Park in the late 1990s and early 2000s. It sits in a valley south of the 101 surrounded by Santa Monica Mountains National Recreation Area land. Homes are newer, larger, and more upscale than much of Newbury Park, with walking trails designed into the community from the start.' ],
	[ 'q' => 'How far is Newbury Park from Los Angeles?', 'a' => 'Newbury Park is approximately 40 miles from downtown Los Angeles, about 40–50 minutes via the 101 without traffic. The Westside and Beverly Hills are roughly 40–45 minutes. Point Mugu State Park is about 25 minutes south via the 23 freeway.' ],
	[ 'q' => 'Is Newbury Park more affordable than Westlake Village?', 'a' => 'Generally yes. While prices have risen throughout the Conejo Valley, Newbury Park tends to offer more square footage for the money than Westlake Village or the premium Thousand Oaks neighborhoods. It is a common entry point for buyers who want Conejo Valley school access and community without top-of-market price tags.' ],
];
?>

<!-- ====== 1. LISTINGS (top of page) ====== -->
<!-- wp:html -->
<section class="dmg-area-section" id="newbury-park-homes">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Homes for Sale</p>
		</div>
		<h2 class="dmg-area-section-title">Active Listings in Newbury Park</h2>

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
				<p style="font-size:1rem;color:var(--wp--preset--color--gray-700);margin:0 0 0.5rem">No active listings in Newbury Park at the moment.</p>
				<p style="font-size:0.9375rem;color:var(--wp--preset--color--gray-500);margin:0">Inventory in this market moves quickly, <a href="/contact-us/?subject=Questions%20about%20Newbury%20Park&amp;source=reach-out" style="color:var(--wp--preset--color--primary);font-weight:600;text-decoration:underline">reach out</a> to be notified when something becomes available.</p>
			</div>
		<?php endif; ?>
	</div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="dmg-area-hero" style="background-image:url('<?php echo esc_url( $hero_image ); ?>')" aria-label="Living in Newbury Park">
	<div class="dmg-area-hero-inner">
		<span class="dmg-area-hero-eyebrow">Conejo Valley Communities</span>
		<h1 class="dmg-area-hero-title">Living in Newbury Park</h1>
		<p class="dmg-area-hero-intro">Where the Conejo Valley meets the Santa Monica Mountains &mdash; a family-oriented community with some of the best trail access in Southern California and an accessible entry point to Conejo Valley living.</p>
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
		<h2 class="dmg-area-section-title">Newbury Park, in Brief</h2>

		<div class="dmg-snapshot-grid">
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Lifestyle</p>
				<p class="dmg-snapshot-value">Outdoor-Oriented Suburban</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Known For</p>
				<p class="dmg-snapshot-value">Trail access, Dos Vientos Ranch, family neighborhoods</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">School District</p>
				<p class="dmg-snapshot-value">Conejo Valley USD</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Population</p>
				<p class="dmg-snapshot-value">~28,000</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Nearby Cities</p>
				<p class="dmg-snapshot-value">Thousand Oaks, Camarillo, Oak Park</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Commute to LA</p>
				<p class="dmg-snapshot-value">~40–50 min via US&#8209;101 / CA&#8209;23</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Walkability</p>
				<p class="dmg-snapshot-value">Low – car oriented</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Best For</p>
				<p class="dmg-snapshot-value">Outdoor enthusiasts, families, value-seekers</p>
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
		<h2 class="dmg-area-section-title">Where the Valley Meets the Mountains</h2>

		<div class="dmg-area-prose">
			<p>Newbury Park occupies the western edge of the Conejo Valley, where the residential grid gives way to the Santa Monica Mountains National Recreation Area. It is technically part of Thousand Oaks &mdash; incorporated into the city in 1964 &mdash; but functions with its own identity, its own zip code, and a community culture that tilts more toward the trails and less toward the corporate campuses at the eastern end of the valley.</p>

			<p>The outdoor access is the headline. Newbury Park is the practical trailhead for Point Mugu State Park, the Boney Mountain Wilderness, and the Big Sycamore Canyon trail system &mdash; one of the largest expanses of undeveloped coastal mountain terrain on the continent. On a weekend morning, you can drive five minutes from any neighborhood, park, and be in genuine backcountry wilderness. That access is priced into the community&rsquo;s identity in a way that doesn&rsquo;t fully show up in the listing descriptions.</p>

			<p>Dos Vientos Ranch changed the character of Newbury Park&rsquo;s high end when it was developed in the late 1990s. The planned community was built into a valley south of the freeway, entirely surrounded by National Recreation Area land, with trails connecting the backyards directly to the open space. Homes are newer, larger, and more upscale than the rest of Newbury Park. For buyers who want a new-construction feel with wilderness at the back fence, Dos Vientos is the answer.</p>

			<p>The established neighborhoods north of the freeway offer a different proposition: more affordable price points, mid-century to 1980s construction, solid schools, and the same Conejo Valley community infrastructure. Buyers who find Westlake Village or the premium end of Thousand Oaks out of reach often discover that Newbury Park gives them most of what they were looking for at a more accessible number.</p>
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
		<h2 class="dmg-area-section-title">Where People Live in Newbury Park</h2>

		<div class="dmg-subhood-grid">
			<article class="dmg-subhood-card">
				<h3>Dos Vientos Ranch</h3>
				<p>Master-planned community (late 1990s) surrounded by National Recreation Area land. Newer, larger homes with direct trail access. HOA amenities, upscale finishes.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Newer Build</span>
					<span class="dmg-subhood-tag">Trail Access</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Borchard Road Corridor</h3>
				<p>Established single-family neighborhoods along one of Newbury Park&rsquo;s main arterials. 1970s&ndash;1980s construction, varied styles, solid schools nearby.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Established</span>
					<span class="dmg-subhood-tag">Family</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>La Quinta / Garden Grove</h3>
				<p>Older established neighborhoods with more affordable entry points. 1960s&ndash;1970s homes, good bones, popular with first-time buyers.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Affordable</span>
					<span class="dmg-subhood-tag">Established</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Conejo Heights</h3>
				<p>Hillside properties on the northern edge of Newbury Park with canyon views and larger lots. A mix of ages and styles.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Views</span>
					<span class="dmg-subhood-tag">Hillside</span>
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
		<h2 class="dmg-area-section-title">Conejo Valley USD</h2>

		<div class="dmg-area-prose" style="margin-bottom:3rem">
			<p>Newbury Park is served by <strong>Conejo Valley Unified School District (CVUSD)</strong>, one of the top-ranked public districts in California. Newbury Park High School is the local high school, with strong athletics, arts programs, and solid academic performance.</p>
		</div>

		<div class="dmg-info-cols">
			<div>
				<h3>Public Schools (CVUSD)</h3>
				<ul>
					<li><strong>Banyan / Sequoia / Sycamore Canyon Elementary</strong><small>Elementary &middot; Newbury Park</small></li>
					<li><strong>Sequoia Middle School</strong><small>Middle &middot; Newbury Park</small></li>
					<li><strong>Newbury Park High School</strong><small>High &middot; Newbury Park</small></li>
				</ul>
			</div>
			<div>
				<h3>Nearby Private Options</h3>
				<ul>
					<li><strong>Hillcrest Christian School</strong><small>K&ndash;12 &middot; Thousand Oaks</small></li>
					<li><strong>Oaks Christian School</strong><small>Grades 6&ndash;12 &middot; Westlake Village</small></li>
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
		<h2 class="dmg-area-section-title">Things To Do in Newbury Park</h2>

		<div class="dmg-info-cols">
			<div>
				<h3>Outdoors</h3>
				<ul>
					<li><strong>Point Mugu State Park</strong><small>Boney Mountain, La Jolla Valley, Big Sycamore Canyon</small></li>
					<li><strong>Rancho Sierra Vista / Satwiwa</strong><small>NPS trailhead into the Santa Monica Mountains</small></li>
					<li><strong>Conejo Valley Open Space</strong><small>Multi-use trails throughout the surrounding hills</small></li>
				</ul>
			</div>
			<div>
				<h3>Dining &amp; Coffee</h3>
				<ul>
					<li><strong>Janss Marketplace</strong><small>Restaurants and dining nearby in Thousand Oaks</small></li>
					<li><strong>Wendy Drive &amp; Lawrence Drive</strong><small>Local Newbury Park dining options</small></li>
				</ul>
			</div>
			<div>
				<h3>Shopping</h3>
				<ul>
					<li><strong>Janss Marketplace</strong><small>Outdoor shopping and dining hub in Thousand Oaks</small></li>
					<li><strong>Newbury Park Town Center</strong><small>Local retail and services</small></li>
				</ul>
			</div>
			<div>
				<h3>Community</h3>
				<ul>
					<li><strong>YMCA Conejo Valley</strong><small>Fitness, youth programs, and community events</small></li>
					<li><strong>Youth sports leagues</strong><small>Soccer, baseball, and recreational programs</small></li>
					<li><strong>Conejo Community Park</strong><small>Events, sports fields, and family programming</small></li>
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
			<p>Common reference points: <strong>Beverly Hills</strong> ~40&ndash;45 min via US&#8209;101 &middot; <strong>San Fernando Valley</strong> ~30 min via CA&#8209;118 &middot; <strong>Pacific Coast</strong> ~25 min via CA&#8209;23 &middot; <strong>Downtown LA</strong> ~50 min &middot; <strong>LAX</strong> ~55 min. The 23 freeway south is the fastest route toward the coast and Point Mugu State Park.</p>
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
		<h2 class="dmg-area-section-title">The Access Without the Premium</h2>

		<div class="dmg-area-prose">
			<p>The people who stay in Newbury Park tend to stay because of the trails. You can be in real wilderness in fifteen minutes &mdash; Boney Mountain, La Jolla Valley, canyon country that feels nothing like Los Angeles &mdash; and still have the school system, the community infrastructure, the Conejo Valley around you. It has the access without the premium, and for the right buyer, that is exactly right.</p>

			<p style="opacity:0.75;font-style:italic;font-size:0.95rem;margin-top:2rem">[Dave to personalize: a memory or experience that speaks to this community, anything in your own voice.]</p>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 10. SELLER CTA ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--dark">
	<div class="dmg-cta-block">
		<h2>Considering Selling in Newbury Park?</h2>
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
		<h2>Thinking About Moving to Newbury Park?</h2>
		<p>The McLaughlin Group has helped buyers navigate the Conejo Valley for generations. Whether you&rsquo;re relocating, purchasing your first home, or searching for your forever home, we&rsquo;d be honored to help guide you through the process.</p>
		<div class="dmg-cta-row">
			<a class="dmg-btn-primary" href="/contact-us/?subject=Schedule%20a%20consultation&amp;source=schedule-consultation">Schedule a consultation</a>
			<a class="dmg-btn-secondary" style="color:var(--wp--preset--color--gray-900);border-color:var(--wp--preset--color--gray-900)" href="#newbury-park-homes">Explore homes</a>
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
		<h2 class="dmg-area-section-title">Newbury Park FAQs</h2>

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
		<p style="color:var(--wp--preset--color--gray-100)">For three generations, the McLaughlin family has lived, worked, and built relationships throughout the Conejo Valley. We don&rsquo;t just sell homes here &mdash; we proudly call this community home.</p>
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
			"name": "Newbury Park",
			"description": "A family-oriented community on the western edge of the Conejo Valley, known for exceptional trail access into the Santa Monica Mountains and accessible price points.",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "Newbury Park",
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

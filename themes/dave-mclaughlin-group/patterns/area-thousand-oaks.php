<?php
/**
 * Title: Area - Thousand Oaks
 * Slug: dmg/area-thousand-oaks
 * Categories: featured
 * Inserter: false
 */

$hero_image   = get_theme_file_uri( 'assets/images/neighborhoods/thousand-oaks.jpeg' );
$area_slug    = 'thousand-oaks';
$area_name    = 'Thousand Oaks';
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
	[ 'name' => 'Westlake Village', 'slug' => 'westlake-village', 'desc' => 'Upscale lakeside community with private lake, golf courses, and refined amenities on Thousand Oaks\'s western edge.' ],
	[ 'name' => 'Newbury Park',     'slug' => 'newbury-park',     'desc' => 'The outdoor-access gateway to the Conejo Valley, with trail-rich neighborhoods and accessible price points.' ],
	[ 'name' => 'Oak Park',         'slug' => 'oak-park',         'desc' => 'Small, family-focused unincorporated community with one of California\'s highest-ranked school districts.' ],
];

$faqs = [
	[ 'q' => 'What is Thousand Oaks known for?', 'a' => 'Thousand Oaks is best known as one of the safest cities in the United States - it consistently ranks near the top of safety indices for cities its size - as well as for its park system, native oak canopy, and strong public schools. It is also home to Amgen, one of the world\'s largest biotechnology companies, and several other significant corporate headquarters.' ],
	[ 'q' => 'What school district serves Thousand Oaks?', 'a' => 'Thousand Oaks is served by Conejo Valley Unified School District (CVUSD), consistently ranked among the top public districts in California. Major high schools include Thousand Oaks High and Westlake High.' ],
	[ 'q' => 'How far is Thousand Oaks from Los Angeles?', 'a' => 'Thousand Oaks is approximately 35–40 miles from downtown Los Angeles and about 35 miles from Beverly Hills. Without significant traffic, the Westside is roughly 35–45 minutes via the 101. The San Fernando Valley is closer, about 25–30 minutes.' ],
	[ 'q' => 'What are the best neighborhoods in Thousand Oaks?', 'a' => 'It depends on priorities. Wildwood suits families who want immediate park access and strong school proximity. Lang Ranch appeals to buyers seeking newer construction and community amenities. Conejo Oaks offers established mid-century character. Newer developments near Dos Vientos offer upscale finishes and hillside views.' ],
	[ 'q' => 'Is Thousand Oaks good for families?', 'a' => 'Thousand Oaks is an excellent place for families. The combination of safety, park access, strong schools, youth sports leagues, community events, and open space makes it one of the most family-oriented cities in Southern California.' ],
	[ 'q' => 'Are there luxury homes in Thousand Oaks?', 'a' => 'Yes. While Thousand Oaks has a broader price range than Westlake Village or Malibu, the luxury tier is real. Estate properties in Lang Ranch, custom hillside homes in Conejo Oaks, and larger parcels with views regularly list in the $2M–$5M range.' ],
];
?>

<!-- ====== 1. LISTINGS (top of page) ====== -->
<!-- wp:html -->
<section class="dmg-area-section" id="thousand-oaks-homes">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Homes for Sale</p>
		</div>
		<h2 class="dmg-area-section-title">Active Listings in Thousand Oaks</h2>

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
				<p style="font-size:1rem;color:var(--wp--preset--color--gray-700);margin:0 0 0.5rem">No active listings in Thousand Oaks at the moment.</p>
				<p style="font-size:0.9375rem;color:var(--wp--preset--color--gray-500);margin:0">Inventory in this market moves quickly, <a href="/contact-us/?subject=Questions%20about%20Thousand%20Oaks&amp;source=reach-out" style="color:var(--wp--preset--color--primary);font-weight:600;text-decoration:underline">reach out</a> to be notified when something becomes available.</p>
			</div>
		<?php endif; ?>
		<div style="margin-top:2rem;text-align:center">
			<a class="dmg-btn-primary" href="/thousand-oaks-homes-for-sale/">Browse all Thousand Oaks listings on MLS</a>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="dmg-area-hero" style="background-image:url('<?php echo esc_url( $hero_image ); ?>')" aria-label="Living in Thousand Oaks">
	<div class="dmg-area-hero-inner">
		<span class="dmg-area-hero-eyebrow">Conejo Valley Communities</span>
		<h1 class="dmg-area-hero-title">Living in Thousand Oaks</h1>
		<p class="dmg-area-hero-intro">The Conejo Valley&rsquo;s largest city - built into rolling hills beneath a native oak canopy and consistently ranked among the safest, most livable cities in America.</p>
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
		<h2 class="dmg-area-section-title">Thousand Oaks, in Brief</h2>

		<div class="dmg-snapshot-grid">
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Lifestyle</p>
				<p class="dmg-snapshot-value">Family-Oriented Suburban</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Known For</p>
				<p class="dmg-snapshot-value">Safety, parks, oak canopy, corporate HQ hub</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">School District</p>
				<p class="dmg-snapshot-value">Conejo Valley USD</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Population</p>
				<p class="dmg-snapshot-value">~130,000</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Nearby Cities</p>
				<p class="dmg-snapshot-value">Westlake Village, Newbury Park, Simi Valley</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Commute to LA</p>
				<p class="dmg-snapshot-value">~35–45 min via US&#8209;101</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Walkability</p>
				<p class="dmg-snapshot-value">Suburban – car-oriented, walkable pockets</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Best For</p>
				<p class="dmg-snapshot-value">Families, nature lovers, corporate commuters</p>
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
		<h2 class="dmg-area-section-title">A City That Chose to Stay Itself</h2>

		<div class="dmg-area-prose">
			<p>Thousand Oaks incorporated in 1964 for a specific reason: to stop Los Angeles from becoming it. The city&rsquo;s founders wanted to preserve the rolling oak-studded hills and establish a community that would grow on its own terms. The name is literal - thousands of native valley oaks were already here, and the planning ordinances that followed were written to keep them. Six decades later, the oaks are still here, and so is the commitment to open space that made the place worth protecting.</p>

			<p>Safety is the city&rsquo;s most cited quality, and the numbers back it up. Thousand Oaks has consistently appeared among the top-ranked cities in America for low violent crime, often in the top ten for cities of its size. That reputation shapes the community&rsquo;s character - it is a city where the culture of safety is not just a statistic but something residents actively maintain and value.</p>

			<p>The park system is exceptional for a suburban city. Wildwood Regional Park covers more than 1,700 acres of native chaparral and oak woodland directly within the city limits, with trailhead access from dozens of neighborhoods. The Conejo Valley Botanic Garden, the Conejo Recreation and Park District&rsquo;s trail network, and a dozen smaller community parks make outdoor access a genuine daily option rather than a weekend expedition.</p>

			<p>Thousand Oaks also has a meaningful corporate presence. Amgen&rsquo;s world headquarters sits here, along with Baxter International and several other major employers. California Lutheran University adds an academic dimension. The result is a community with genuine economic depth - a working professional population alongside the family-oriented suburban core.</p>

			<p>Real estate ranges more widely here than in neighboring Westlake Village. Established single-family homes in Wildwood and Conejo Oaks start in the mid-$800Ks. Newer planned communities like Lang Ranch run $1.5M&ndash;$3M. The luxury hillside tier touches $4M and above. For buyers who want Conejo Valley school quality and community infrastructure without the top-of-market Westlake Village premium, Thousand Oaks is the natural answer.</p>
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
		<h2 class="dmg-area-section-title">Where People Live in Thousand Oaks</h2>

		<div class="dmg-subhood-grid">
			<article class="dmg-subhood-card">
				<h3>Wildwood</h3>
				<p>Beloved by families for direct trail access into Wildwood Regional Park and strong school proximity. Established streets, updated mid-century to contemporary homes.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Park Access</span>
					<span class="dmg-subhood-tag">Family</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Lang Ranch</h3>
				<p>Planned community developed in the 1990s on the city&rsquo;s eastern edge. Newer construction, community amenities, gated sections, upscale finishes.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Newer Build</span>
					<span class="dmg-subhood-tag">Upscale</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Conejo Oaks</h3>
				<p>Older, tree-lined neighborhood near the civic center and performing arts district. Mid-century character, generous lots, long-time residents.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Established</span>
					<span class="dmg-subhood-tag">Trees</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Downtown / Civic Arts</h3>
				<p>The most walkable part of Thousand Oaks, near The Oaks mall, Civic Arts Plaza performing arts center, and city hall. Mixed residential and retail character.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Walkable</span>
					<span class="dmg-subhood-tag">Culture</span>
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
			<p>Thousand Oaks is served by <strong>Conejo Valley Unified School District (CVUSD)</strong>, consistently ranked among the top public school districts in California. The district serves students across Thousand Oaks, Newbury Park, and Westlake Village (Ventura County side).</p>
		</div>

		<div class="dmg-info-cols">
			<div>
				<h3>Public Schools (CVUSD)</h3>
				<ul>
					<li><strong>Glenwood Elementary / Weathersfield Elementary</strong><small>Elementary &middot; Thousand Oaks</small></li>
					<li><strong>Colina Middle School</strong><small>Middle &middot; Thousand Oaks</small></li>
					<li><strong>Thousand Oaks High School</strong><small>High &middot; Thousand Oaks</small></li>
					<li><strong>Westlake High School</strong><small>High &middot; Thousand Oaks</small></li>
				</ul>
			</div>
			<div>
				<h3>Private &amp; Higher Education</h3>
				<ul>
					<li><strong>Hillcrest Christian School</strong><small>K&ndash;12 &middot; Thousand Oaks</small></li>
					<li><strong>Oaks Christian School</strong><small>Grades 6&ndash;12 &middot; Westlake Village</small></li>
					<li><strong>California Lutheran University</strong><small>Higher Education &middot; Thousand Oaks</small></li>
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
		<h2 class="dmg-area-section-title">Things To Do in Thousand Oaks</h2>

		<div class="dmg-info-cols">
			<div>
				<h3>Outdoors</h3>
				<ul>
					<li><strong>Wildwood Regional Park</strong><small>1,700+ acres of trails and native chaparral</small></li>
					<li><strong>Conejo Valley Botanic Garden</strong><small>Free public garden with native plants</small></li>
					<li><strong>Stagecoach Inn Museum</strong><small>Historic site and open-air museum</small></li>
					<li><strong>Rancho Sierra Vista trails</strong><small>NPS-managed trails into Point Mugu State Park</small></li>
				</ul>
			</div>
			<div>
				<h3>Dining &amp; Coffee</h3>
				<ul>
					<li><strong>The Oaks Mall restaurants</strong><small>Full range of dining at the regional mall</small></li>
					<li><strong>Downtown Thousand Oaks</strong><small>Local restaurants near the Civic Arts Plaza</small></li>
					<li><strong>Westlake Village dining nearby</strong><small>The Stonehaus, Bru Burger, and more minutes away</small></li>
				</ul>
			</div>
			<div>
				<h3>Shopping</h3>
				<ul>
					<li><strong>The Oaks Mall</strong><small>Regional indoor mall with major retailers</small></li>
					<li><strong>Janss Marketplace</strong><small>Outdoor shopping and dining hub</small></li>
				</ul>
			</div>
			<div>
				<h3>Community</h3>
				<ul>
					<li><strong>Civic Arts Plaza</strong><small>Professional theater and performing arts season</small></li>
					<li><strong>Conejo Valley Days</strong><small>Annual community fair and celebration</small></li>
					<li><strong>Youth sports leagues</strong><small>AYSO, Little League, and recreational programs throughout the city</small></li>
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
			<p>Common reference points: <strong>Beverly Hills</strong> ~35&ndash;40 min via US&#8209;101 &middot; <strong>San Fernando Valley</strong> ~25&ndash;30 min &middot; <strong>Downtown LA</strong> ~45&ndash;50 min &middot; <strong>LAX</strong> ~50&ndash;55 min &middot; <strong>Westlake Village</strong> ~15 min. The 101 is the primary corridor west toward Los Angeles and east toward Ventura.</p>
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
		<h2 class="dmg-area-section-title">The Oaks Are Still Here</h2>

		<div class="dmg-area-prose">
			<p>Thousand Oaks delivers what it promises. The crime statistics are real, the parks are genuinely accessible, and the school district backs up its reputation year after year. Families come for one reason and stay for ten. The city is large enough to have everything you need without ever feeling like a suburb that has lost itself to sprawl. The oaks are still here.</p>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 10. SELLER CTA ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--dark">
	<div class="dmg-cta-block">
		<h2>Considering Selling in Thousand Oaks?</h2>
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
		<h2>Thinking About Moving to Thousand Oaks?</h2>
		<p>The McLaughlin Group has helped buyers navigate the Conejo Valley for generations. Whether you&rsquo;re relocating, purchasing your first home, or searching for your forever home, we&rsquo;d be honored to help guide you through the process.</p>
		<div class="dmg-cta-row">
			<a class="dmg-btn-primary" href="/contact-us/?subject=Schedule%20a%20consultation&amp;source=schedule-consultation">Schedule a consultation</a>
			<a class="dmg-btn-secondary" style="color:var(--wp--preset--color--gray-900);border-color:var(--wp--preset--color--gray-900)" href="#thousand-oaks-homes">Explore homes</a>
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
		<h2 class="dmg-area-section-title">Thousand Oaks FAQs</h2>

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
			"name": "Thousand Oaks",
			"description": "The Conejo Valley's largest city, built into rolling hills beneath a native oak canopy and consistently ranked among the safest, most livable cities in America.",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "Thousand Oaks",
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

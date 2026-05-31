<?php
/**
 * Title: Area - Ventura
 * Slug: dmg/area-ventura
 * Categories: featured
 * Inserter: false
 */

$hero_image   = get_theme_file_uri( 'assets/images/neighborhoods/ventura.jpeg' );
$area_slug    = 'ventura';
$area_name    = 'Ventura';
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
	[ 'name' => 'Malibu',        'slug' => 'malibu',        'desc' => 'Pacific coastline luxury and canyon living, about 40 minutes south via PCH - a natural complement to Ventura\'s coastal lifestyle.' ],
	[ 'name' => 'Thousand Oaks', 'slug' => 'thousand-oaks', 'desc' => 'The Conejo Valley\'s largest inland city, about 25 minutes southeast via the 101 - strong schools and suburban amenities.' ],
	[ 'name' => 'Newbury Park',  'slug' => 'newbury-park',  'desc' => 'Outdoor-oriented Conejo Valley community with trail access, about 30 minutes south via CA-23.' ],
];

$faqs = [
	[ 'q' => 'Is Ventura a good place to live?', 'a' => 'Ventura offers a quality of life that surprises many people who discover it. It has a genuine historic downtown, direct access to the Pacific and Channel Islands, a surf culture that is taken seriously, and a community scale - about 110,000 people - that feels human without feeling small. It is significantly more affordable than Malibu or Santa Barbara while sharing much of the same coastal character.' ],
	[ 'q' => 'How does Ventura compare to Malibu or Santa Barbara?', 'a' => 'Ventura sits between the two in geography and, broadly, in character. It has Malibu\'s surf access and mountain backdrop but without the celebrity premium. It has Santa Barbara\'s historic downtown and harbor culture but without the full Santa Barbara price tag. It is the coastal city in the region that tends to reward buyers who look past the more famous names.' ],
	[ 'q' => 'What school district serves Ventura?', 'a' => 'Ventura is served by Ventura Unified School District (VUSD), which covers the city of Ventura. The district runs multiple elementary and middle schools and three comprehensive high schools: Buena, Foothill Tech, and Ventura High. Foothill Technology High School is a specialized magnet school with competitive admission and strong STEM and arts programming.' ],
	[ 'q' => 'What neighborhoods are best in Ventura?', 'a' => 'It depends on priorities. Pierpont Beach and Midtown offer direct coastal access with an established bungalow-and-craftsman character. The Keys provides marina-adjacent waterfront living near the harbor. East Ventura offers more suburban neighborhoods at more accessible price points. The Ventura Hillsides give buyers elevated views, newer custom homes, and larger lots.' ],
	[ 'q' => 'How far is Ventura from Los Angeles?', 'a' => 'Ventura is approximately 65 miles from downtown Los Angeles, roughly 55–75 minutes via the 101 depending on traffic. Beverly Hills is about 60 minutes. The drive is on the freeway the entire way, which makes it more predictable than the PCH commute from Malibu, though it is longer in miles.' ],
	[ 'q' => 'What is the real estate market like in Ventura?', 'a' => 'Ventura offers real value relative to its coastal peers. Median single-family home prices are meaningfully lower than Malibu, Santa Barbara, or even many Conejo Valley communities. Waterfront and ocean-view properties command premiums, but homes with character in Midtown and the historic neighborhoods represent some of the best value per square foot on the Ventura County coast.' ],
];
?>

<!-- ====== 1. LISTINGS (top of page) ====== -->
<!-- wp:html -->
<section class="dmg-area-section" id="ventura-homes">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Homes for Sale</p>
		</div>
		<h2 class="dmg-area-section-title">Active Listings in Ventura</h2>

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
				<p style="font-size:1rem;color:var(--wp--preset--color--gray-700);margin:0 0 0.5rem">No active listings in Ventura at the moment.</p>
				<p style="font-size:0.9375rem;color:var(--wp--preset--color--gray-500);margin:0">Inventory in this market moves quickly, <a href="/contact-us/?subject=Questions%20about%20Ventura&amp;source=reach-out" style="color:var(--wp--preset--color--primary);font-weight:600;text-decoration:underline">reach out</a> to be notified when something becomes available.</p>
			</div>
		<?php endif; ?>
		<div style="margin-top:2rem;text-align:center">
			<a class="dmg-btn-primary" href="/ventura-homes-for-sale/">Browse all Ventura listings on MLS</a>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="dmg-area-hero" style="background-image:url('<?php echo esc_url( $hero_image ); ?>')" aria-label="Living in Ventura">
	<div class="dmg-area-hero-inner">
		<span class="dmg-area-hero-eyebrow">Conejo Valley Communities</span>
		<h1 class="dmg-area-hero-title">Living in Ventura</h1>
		<p class="dmg-area-hero-intro">A historic coastal city with a working harbor, world-class surf, and a downtown that has been worth walking since 1782 - where California&rsquo;s character shows up without the markup.</p>
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
		<h2 class="dmg-area-section-title">Ventura, in Brief</h2>

		<div class="dmg-snapshot-grid">
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Lifestyle</p>
				<p class="dmg-snapshot-value">Coastal City</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Known For</p>
				<p class="dmg-snapshot-value">Historic downtown, Channel Islands, surf culture, harbor</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">School District</p>
				<p class="dmg-snapshot-value">Ventura Unified</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Population</p>
				<p class="dmg-snapshot-value">~110,000</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Nearby Cities</p>
				<p class="dmg-snapshot-value">Oxnard, Camarillo, Santa Barbara</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Commute to LA</p>
				<p class="dmg-snapshot-value">~55–75 min via US&#8209;101</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Walkability</p>
				<p class="dmg-snapshot-value">Moderate – walkable downtown and Midtown</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Best For</p>
				<p class="dmg-snapshot-value">Coastal lifestyle, value seekers, families, retirees</p>
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
		<h2 class="dmg-area-section-title">California&rsquo;s Most Underestimated Coast</h2>

		<div class="dmg-area-prose">
			<p>Ventura - officially San Buenaventura, though almost no one calls it that - is the Ventura County seat and the most underestimated city on the Southern California coast. It has a harbor, a working pier, a genuinely historic downtown anchored by a Spanish mission from 1782, and direct access to the Channel Islands, one of the most remarkable national parks in the country. It also has, relative to its coastal peers, prices that still reflect the fact that most people have not fully discovered it yet.</p>

			<p>The downtown is real in a way that many California downtowns are not. Main Street has independent restaurants, galleries, vintage shops, and coffee that residents actually use day to day, not a theme park version of a downtown built for tourists. The Sunday farmers market at the parking structure on Santa Clara is a Ventura institution. The Ventura Theater and the Museum of Ventura County give the city a cultural life that punches above its population.</p>

			<p>C Street - Surfers&rsquo; Point - is a world-class surf break. Serious surfers know this; the rest of California is slowly catching up. The point break at the intersection of Figueroa and the ocean produces long, rideable waves that draw regulars from across the region. The surf culture here is genuine and long-standing, not imported. It shapes the morning character of the neighborhoods closest to the coast.</p>

			<p>The Channel Islands sit visible from the harbor on a clear day, and they are accessible - Island Packers runs daily boat service from Ventura Harbor. The islands are some of the most pristine coastal wilderness in the continental United States: no cars, no development, camping, snorkeling, sea caves, and wildlife that exists nowhere else on earth. Having them as a day trip is one of those things Ventura residents mention quietly to friends and feel quietly superior about.</p>

			<p>Real estate in Ventura covers meaningful range. Coastal bungalows and craftsmans in Midtown and Pierpont offer character and proximity to the ocean. East Ventura and the newer suburban neighborhoods on the city&rsquo;s edges provide more square footage at more accessible price points. The Hillside neighborhoods on the eastern ridge offer views across the channel and larger lots. For buyers who have been priced out of Malibu or Santa Barbara, Ventura represents the honest version of the same coastal life.</p>
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
		<h2 class="dmg-area-section-title">Where People Live in Ventura</h2>

		<div class="dmg-subhood-grid">
			<article class="dmg-subhood-card">
				<h3>Midtown &amp; Pierpont Beach</h3>
				<p>The most established coastal neighborhood - bungalows, craftsmans, and beach cottages within walking distance of the ocean and downtown. Strong character, long-time residents.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Coastal</span>
					<span class="dmg-subhood-tag">Historic</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>The Keys</h3>
				<p>Waterfront community adjacent to the harbor with marina access and a boating lifestyle. Townhomes and single-family homes with channel views and dock access.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Waterfront</span>
					<span class="dmg-subhood-tag">Marina</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>East Ventura</h3>
				<p>Broader suburban neighborhoods with more affordable price points. 1970s&ndash;1990s construction, more land per dollar, popular with families and first-time buyers.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Suburban</span>
					<span class="dmg-subhood-tag">Value</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Ventura Hillsides</h3>
				<p>Elevated properties on the ridgeline east of downtown. Newer custom homes, channel views, larger lots. The most upscale residential tier within the city.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Views</span>
					<span class="dmg-subhood-tag">Custom</span>
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
		<h2 class="dmg-area-section-title">Ventura Unified School District</h2>

		<div class="dmg-area-prose" style="margin-bottom:3rem">
			<p><strong>Ventura Unified School District (VUSD)</strong> serves the city of Ventura with multiple elementaries, middle schools, and three comprehensive high schools. Foothill Technology High School is a standout - a competitive STEM and arts magnet that draws students from across the district.</p>
		</div>

		<div class="dmg-info-cols">
			<div>
				<h3>Public Schools (VUSD)</h3>
				<ul>
					<li><strong>Multiple K&ndash;5 Elementary Schools</strong><small>Throughout Ventura neighborhoods</small></li>
					<li><strong>De Anza &amp; Cabrillo Middle Schools</strong><small>Middle &middot; Ventura</small></li>
					<li><strong>Buena High School</strong><small>High &middot; Ventura</small></li>
					<li><strong>Foothill Technology High School</strong><small>STEM/Arts Magnet &middot; Ventura (competitive admission)</small></li>
					<li><strong>Ventura High School</strong><small>High &middot; Ventura</small></li>
				</ul>
			</div>
			<div>
				<h3>Private &amp; Higher Education</h3>
				<ul>
					<li><strong>Saint Bonaventure High School</strong><small>High &middot; Ventura</small></li>
					<li><strong>Grace Brethren Schools</strong><small>K&ndash;12 &middot; Simi Valley (~30 min)</small></li>
					<li><strong>California State University Channel Islands</strong><small>Higher Education &middot; Camarillo (~15 min)</small></li>
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
		<h2 class="dmg-area-section-title">Things To Do in Ventura</h2>

		<div class="dmg-info-cols">
			<div>
				<h3>Outdoors</h3>
				<ul>
					<li><strong>Channel Islands National Park</strong><small>Daily boat service from Ventura Harbor via Island Packers</small></li>
					<li><strong>C Street - Surfers&rsquo; Point</strong><small>World-class point break, long-standing surf culture</small></li>
					<li><strong>Ventura Pier &amp; Emma Wood State Beach</strong><small>Swimming, fishing, and beachside recreation</small></li>
					<li><strong>Los Padres National Forest</strong><small>Hiking and backcountry access to the northeast</small></li>
					<li><strong>Ojai day trips</strong><small>Arts enclave and hiking hub ~20 min away</small></li>
				</ul>
			</div>
			<div>
				<h3>Dining</h3>
				<ul>
					<li><strong>Brophy Bros.</strong><small>Harbor-side seafood institution</small></li>
					<li><strong>MadeWest Brewing</strong><small>Craft brewery with strong local following</small></li>
					<li><strong>Rumfish y Vino</strong><small>Creative coastal cuisine on Main Street</small></li>
					<li><strong>Lure Fish House</strong><small>Seafood-focused neighborhood restaurant</small></li>
					<li><strong>Café Fiore</strong><small>Long-time Italian favorite</small></li>
					<li><strong>Ventura Shellfish Enterprise</strong><small>Working shellfish farm at the harbor</small></li>
				</ul>
			</div>
			<div>
				<h3>Shopping</h3>
				<ul>
					<li><strong>Downtown Main Street</strong><small>Independent boutiques, vintage, and galleries</small></li>
					<li><strong>Pacific View Mall</strong><small>Regional indoor mall</small></li>
					<li><strong>Ventura Harbor Village</strong><small>Waterfront shops and restaurants</small></li>
				</ul>
			</div>
			<div>
				<h3>Community</h3>
				<ul>
					<li><strong>Downtown Farmers Market</strong><small>Sundays on Santa Clara - a Ventura institution</small></li>
					<li><strong>Ventura Music Festival</strong><small>Annual performing arts festival</small></li>
					<li><strong>Concerts in the Park</strong><small>Summer outdoor concert series</small></li>
					<li><strong>Island Packers excursions</strong><small>Channel Islands day trips and wildlife cruises</small></li>
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
			<p>Common reference points: <strong>Beverly Hills</strong> ~55&ndash;65 min via US&#8209;101 &middot; <strong>San Fernando Valley</strong> ~45 min &middot; <strong>Oxnard / Camarillo</strong> ~30 min &middot; <strong>Downtown LA</strong> ~75+ min &middot; <strong>LAX</strong> ~60 min. Metrolink&rsquo;s Ventura County Line runs to Union Station, making Ventura one of the few coastal communities with a viable train option for downtown LA commuters.</p>
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
		<h2 class="dmg-area-section-title">The Ones Who Noticed</h2>

		<div class="dmg-area-prose">
			<p>Ventura has a way of not needing to convince anyone once they&rsquo;ve actually lived there. The Channel Islands on the horizon, C Street at first light, the farmers market on Sunday, the kind of downtown that gets better the more you know it - it is a coastal city that rewards people who pay attention to it. The ones who stay are the ones who noticed.</p>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 10. SELLER CTA ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--dark">
	<div class="dmg-cta-block">
		<h2>Considering Selling in Ventura?</h2>
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
		<h2>Thinking About Moving to Ventura?</h2>
		<p>The McLaughlin Group has helped buyers navigate the Conejo Valley for generations. Whether you&rsquo;re relocating, purchasing your first home, or searching for your forever home, we&rsquo;d be honored to help guide you through the process.</p>
		<div class="dmg-cta-row">
			<a class="dmg-btn-primary" href="/contact-us/?subject=Schedule%20a%20consultation&amp;source=schedule-consultation">Schedule a consultation</a>
			<a class="dmg-btn-secondary" style="color:var(--wp--preset--color--gray-900);border-color:var(--wp--preset--color--gray-900)" href="#ventura-homes">Explore homes</a>
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
		<h2 class="dmg-area-section-title">Ventura FAQs</h2>

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
			"name": "Ventura",
			"description": "A historic coastal city with a working harbor, world-class surf, and a downtown anchored by a Spanish mission from 1782 - one of Southern California's most underestimated coastal communities.",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "Ventura",
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

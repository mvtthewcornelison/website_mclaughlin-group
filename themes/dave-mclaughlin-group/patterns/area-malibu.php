<?php
/**
 * Title: Area - Malibu
 * Slug: dmg/area-malibu
 * Categories: featured
 * Inserter: false
 */

$hero_image   = get_theme_file_uri( 'assets/images/neighborhoods/malibu.png' );
$area_slug    = 'malibu';
$area_name    = 'Malibu';
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
	[ 'name' => 'Malibou Lake',     'slug' => 'malibou-lake',     'desc' => 'Private mountain lake community in the Santa Monica Mountains, reached via Malibu Canyon Road in about 20 minutes.' ],
	[ 'name' => 'Agoura Hills',     'slug' => 'agoura-hills',     'desc' => 'The nearest inland Conejo Valley community, reached via Kanan-Dume Road in about 30 minutes.' ],
	[ 'name' => 'Westlake Village', 'slug' => 'westlake-village', 'desc' => 'Upscale planned community with private lake and Conejo Valley amenities, roughly 35 minutes via PCH and the 101.' ],
];

$faqs = [
	[ 'q' => 'Is Malibu worth the price premium?', 'a' => 'That depends on what you value. Malibu offers something genuinely rare in greater Los Angeles: Pacific coastline, canyon privacy, and mountain open space in combination, within 35 miles of the city\'s core. For buyers who prioritize that setting above other considerations, the premium reflects real scarcity. The 27-mile coastal strip cannot be replicated or expanded.' ],
	[ 'q' => 'What are the best neighborhoods in Malibu?', 'a' => 'It depends on what kind of Malibu you want. Point Dume offers an elevated headland with both beach access and canyon quiet, considered by many to be the best balance of privacy and setting. Carbon and Broad Beach are the definitive luxury beachfront addresses. Malibu Colony is the historic gated enclave. Malibu Park and the canyon areas offer more land, more privacy, and a more rural feel at a comparatively accessible price point.' ],
	[ 'q' => 'How far is Malibu from Los Angeles?', 'a' => 'Malibu stretches 27 miles along the coast. The eastern end (near Pacific Palisades) is roughly 20–30 minutes from Beverly Hills on a clear day. The western end (near Point Mugu) is 45–60 minutes from Beverly Hills. Pacific Coast Highway is the only through-route, and traffic on it is highly variable. Most residents accept the commute as the trade-off for the setting.' ],
	[ 'q' => 'Are there non-beachfront homes in Malibu?', 'a' => 'Yes, and they represent the majority of Malibu real estate. Canyon properties - in Malibu Park, Las Virgenes Canyon, Latigo Canyon, and Kanan-Dume Road - offer large lots, mountain privacy, and the Malibu address without PCH frontage or beachfront pricing. They are often the most interesting properties in the market for buyers who want land and seclusion over sand.' ],
	[ 'q' => 'What school district serves Malibu?', 'a' => 'Malibu is served by Santa Monica-Malibu Unified School District (SMMUSD). Malibu High School serves local students. Some families in western Malibu are closer to Las Virgenes USD schools, and private school options in Calabasas and Westlake Village are within reasonable driving distance.' ],
	[ 'q' => 'What is the real estate market like in Malibu?', 'a' => 'Malibu\'s market is defined by scarcity and extreme variance. Entry-level is roughly $2M–$3M for a canyon home or non-waterfront property. Mid-range beachfront runs $5M–$15M. Trophy properties on Carbon Beach or with significant acreage regularly exceed $20M–$50M. The market is thin at the top and moves on its own timeline - sometimes quickly, often not. Working with someone who has deep market relationships matters more here than almost anywhere else.' ],
];
?>

<!-- ====== 1. LISTINGS (top of page) ====== -->
<!-- wp:html -->
<section class="dmg-area-section" id="malibu-homes">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Homes for Sale</p>
		</div>
		<h2 class="dmg-area-section-title">Active Listings in Malibu</h2>

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
				<p style="font-size:1rem;color:var(--wp--preset--color--gray-700);margin:0 0 0.5rem">No active listings in Malibu at the moment.</p>
				<p style="font-size:0.9375rem;color:var(--wp--preset--color--gray-500);margin:0">Inventory in this market moves quickly, <a href="/contact-us/?subject=Questions%20about%20Malibu&amp;source=reach-out" style="color:var(--wp--preset--color--primary);font-weight:600;text-decoration:underline">reach out</a> to be notified when something becomes available.</p>
			</div>
		<?php endif; ?>
	</div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="dmg-area-hero" style="background-image:url('<?php echo esc_url( $hero_image ); ?>')" aria-label="Living in Malibu">
	<div class="dmg-area-hero-inner">
		<span class="dmg-area-hero-eyebrow">Conejo Valley Communities</span>
		<h1 class="dmg-area-hero-title">Living in Malibu</h1>
		<p class="dmg-area-hero-intro">Twenty-seven miles of Pacific coastline, canyon privacy, and mountain open space - one of the most iconic and irreplaceable addresses in California.</p>
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
		<h2 class="dmg-area-section-title">Malibu, in Brief</h2>

		<div class="dmg-snapshot-grid">
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Lifestyle</p>
				<p class="dmg-snapshot-value">Coastal / Luxury</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Known For</p>
				<p class="dmg-snapshot-value">Pacific beaches, celebrity residents, Pepperdine University</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">School District</p>
				<p class="dmg-snapshot-value">Santa Monica-Malibu USD</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Population</p>
				<p class="dmg-snapshot-value">~13,500</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Nearby Cities</p>
				<p class="dmg-snapshot-value">Pacific Palisades, Calabasas, Agoura Hills (via Kanan-Dume)</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Commute to LA</p>
				<p class="dmg-snapshot-value">~35–55 min via PCH (traffic-dependent)</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Walkability</p>
				<p class="dmg-snapshot-value">Very low – car essential</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Best For</p>
				<p class="dmg-snapshot-value">Beach lifestyle buyers, luxury seekers, second-home buyers</p>
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
		<h2 class="dmg-area-section-title">Where the Mountains Meet the Sea</h2>

		<div class="dmg-area-prose">
			<p>Malibu is 27 miles of Pacific coastline between the Santa Monica Mountains and the sea, and that description contains almost everything important about the place. The setting is the selling point, the lifestyle, the constraint, and the identity all at once. There is nowhere else in the Los Angeles basin where the mountains fall so directly into the ocean, and the combination produces a landscape that tends to hold people once they find it.</p>

			<p>The city incorporated in 1991, largely to fend off development pressure from Los Angeles County. The result is a community that has held its low-density, rural-adjacent character more successfully than most coastal California cities of comparable value. Lot coverage limits are real here, the canyon roads stay canyon roads, and the open space that makes Malibu what it is has been protected with genuine intention. Zuma Beach, El Matador, and Point Dume are public. The rest of the mountains - most of the Santa Monica Mountains National Recreation Area - is public land managed for hiking, biking, and equestrian use.</p>

			<p>The residential story in Malibu is more varied than the beachfront stereotype suggests. Yes, Carbon Beach - locally known as Billionaire&rsquo;s Beach - is exactly what it sounds like, a strip of ultra-luxury oceanfront estates where prices regularly exceed $30M. And yes, Malibu Colony is the historic gated enclave where the celebrity concentration is highest. But the canyon areas - Malibu Park, Las Virgenes Canyon, Latigo, Kanan-Dume - represent the majority of the city&rsquo;s land area and offer something different: large lots, equestrian properties, mountain views, and genuine rural quiet at a price point that, while still significant, is a different order of magnitude from beachfront.</p>

			<p>Pepperdine University sits on a hillside above the Pacific in the heart of Malibu, its campus one of the most dramatically sited in the country. The university brings an academic and cultural presence - events, facilities, a concert hall - that broadens what Malibu offers beyond the beach. The local school, Malibu High, is small and community-oriented in the way schools in small towns tend to be.</p>

			<p>The commute is real and should not be minimized. Pacific Coast Highway is the only through-route, and it can be genuinely frustrating. Most Malibu residents make their peace with it the same way mountain residents make their peace with narrow roads: the trade is worth it. Those for whom it is not, typically leave. Those who stay tend to stop thinking about it.</p>
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
		<h2 class="dmg-area-section-title">Where People Live in Malibu</h2>

		<div class="dmg-subhood-grid">
			<article class="dmg-subhood-card">
				<h3>Point Dume</h3>
				<p>Elevated coastal headland considered by many to be Malibu&rsquo;s best-balanced neighborhood. Beach access, ocean views, relative privacy, and a strong community identity.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Coastal</span>
					<span class="dmg-subhood-tag">Views</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Malibu Colony</h3>
				<p>Historic gated beachfront enclave, the most recognizable celebrity address in Malibu. Tightly held, rarely available, ultra-luxury PCH frontage.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Gated</span>
					<span class="dmg-subhood-tag">Beachfront</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Carbon &amp; Broad Beach</h3>
				<p>PCH beachfront strip between Point Dume and Las Virgenes. Among the most expensive residential real estate in California.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Ultra-Luxury</span>
					<span class="dmg-subhood-tag">Beachfront</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Malibu Park &amp; Las Virgenes Canyon</h3>
				<p>Canyon and hillside properties south of Mulholland Highway. Large lots, equestrian-compatible, rural feel. More accessible than beachfront while still carrying the Malibu address.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Canyon</span>
					<span class="dmg-subhood-tag">Equestrian</span>
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
		<h2 class="dmg-area-section-title">Santa Monica-Malibu USD</h2>

		<div class="dmg-area-prose" style="margin-bottom:3rem">
			<p>Malibu is served by <strong>Santa Monica-Malibu Unified School District (SMMUSD)</strong>. Malibu High School is a small, community-oriented campus. Families seeking additional options have private schools in Calabasas and Westlake Village within a reasonable drive via Kanan-Dume Road.</p>
		</div>

		<div class="dmg-info-cols">
			<div>
				<h3>Public Schools (SMMUSD)</h3>
				<ul>
					<li><strong>Webster Elementary</strong><small>Elementary &middot; Malibu</small></li>
					<li><strong>Malibu Middle School</strong><small>Middle &middot; Malibu</small></li>
					<li><strong>Malibu High School</strong><small>High &middot; Malibu</small></li>
				</ul>
			</div>
			<div>
				<h3>Private &amp; Higher Education</h3>
				<ul>
					<li><strong>Oaks Christian School</strong><small>Grades 6&ndash;12 &middot; Westlake Village (~30 min via Kanan-Dume)</small></li>
					<li><strong>Viewpoint School</strong><small>K&ndash;12 &middot; Calabasas (~20 min)</small></li>
					<li><strong>Pepperdine University</strong><small>Higher Education &middot; Malibu campus</small></li>
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
		<h2 class="dmg-area-section-title">Things To Do in Malibu</h2>

		<div class="dmg-info-cols">
			<div>
				<h3>Outdoors</h3>
				<ul>
					<li><strong>Zuma Beach</strong><small>Malibu&rsquo;s largest public beach - swimming, volleyball, lifeguards</small></li>
					<li><strong>El Matador State Beach</strong><small>Sea caves and rock formations, one of the most scenic coves on the coast</small></li>
					<li><strong>Point Dume State Beach &amp; Reserve</strong><small>Whale watching lookout, tide pools, trail to the bluffs</small></li>
					<li><strong>Santa Monica Mountains NRA</strong><small>Hundreds of miles of trails from Malibu trailheads</small></li>
					<li><strong>Malibu Creek State Park</strong><small>Hiking, swimming hole, historic film locations</small></li>
					<li><strong>Leo Carrillo State Park</strong><small>Camping, sea caves, and surf on western Malibu</small></li>
				</ul>
			</div>
			<div>
				<h3>Dining</h3>
				<ul>
					<li><strong>Nobu Malibu</strong><small>The Malibu dining institution - oceanfront Japanese cuisine</small></li>
					<li><strong>Taverna Tony</strong><small>Greek taverna at Malibu Country Mart, long-time local favorite</small></li>
					<li><strong>The Sunset Restaurant</strong><small>Oceanfront dining at Point Dume</small></li>
					<li><strong>Malibu Farm Pier Café</strong><small>Farm-to-table at the end of the Malibu Pier</small></li>
					<li><strong>Paradise Cove Beach Café</strong><small>Iconic beach shack dining on private cove</small></li>
				</ul>
			</div>
			<div>
				<h3>Shopping</h3>
				<ul>
					<li><strong>Malibu Country Mart</strong><small>Open-air boutique shopping and dining courtyard</small></li>
					<li><strong>Malibu Lumber Yard</strong><small>Curated boutique retail - Whole Foods, surf, fashion</small></li>
				</ul>
			</div>
			<div>
				<h3>Community</h3>
				<ul>
					<li><strong>Malibu Film Society</strong><small>Independent film screenings and cultural events</small></li>
					<li><strong>Pepperdine arts events</strong><small>Concerts, lectures, and theater open to the community</small></li>
					<li><strong>Surfrider Beach</strong><small>The original surf culture landmark - a world-famous point break</small></li>
					<li><strong>Equestrian community</strong><small>Canyon riding, stables, and trail networks throughout the hills</small></li>
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
			<p>Common reference points: <strong>Beverly Hills</strong> ~35 min from eastern Malibu via PCH (no traffic) &middot; <strong>Beverly Hills</strong> ~55+ min with typical afternoon PCH delays &middot; <strong>Agoura Hills</strong> ~30 min via Kanan-Dume Road &middot; <strong>Santa Monica</strong> ~45 min &middot; <strong>Downtown LA</strong> ~60+ min &middot; No practical public transit - car essential.</p>
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
		<h2 class="dmg-area-section-title">The Setting Wins Every Time</h2>

		<div class="dmg-area-prose">
			<p>Malibu has a way of making the commute feel irrelevant after a while. You spend enough mornings watching the light on the water or enough evenings watching it leave the mountains, and the 101 starts to feel like someone else&rsquo;s problem. The people who stay are the ones for whom the setting won out - and who found, over time, that it keeps winning.</p>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 10. SELLER CTA ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--dark">
	<div class="dmg-cta-block">
		<h2>Considering Selling in Malibu?</h2>
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
		<h2>Thinking About Moving to Malibu?</h2>
		<p>The McLaughlin Group has helped buyers navigate the Conejo Valley for generations. Whether you&rsquo;re relocating, purchasing your first home, or searching for your forever home, we&rsquo;d be honored to help guide you through the process.</p>
		<div class="dmg-cta-row">
			<a class="dmg-btn-primary" href="/contact-us/?subject=Schedule%20a%20consultation&amp;source=schedule-consultation">Schedule a consultation</a>
			<a class="dmg-btn-secondary" style="color:var(--wp--preset--color--gray-900);border-color:var(--wp--preset--color--gray-900)" href="#malibu-homes">Explore homes</a>
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
		<h2 class="dmg-area-section-title">Malibu FAQs</h2>

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
			"name": "Malibu",
			"description": "Twenty-seven miles of Pacific coastline between the Santa Monica Mountains and the sea - one of the most iconic and irreplaceable addresses in California.",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "Malibu",
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

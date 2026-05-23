<?php
/**
 * Title: Area - Agoura Hills
 * Slug: dmg/area-agoura-hills
 * Categories: featured
 * Inserter: false
 */

$hero_image   = get_theme_file_uri( 'assets/images/neighborhoods/agoura-hills.png' );
$area_slug    = 'agoura-hills';
$area_name    = 'Agoura Hills';
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
	[ 'name' => 'Westlake Village', 'slug' => 'westlake-village', 'desc' => 'A planned community built around a private lake and one of the most established neighborhoods in the Conejo Valley.' ],
	[ 'name' => 'Oak Park',         'slug' => 'oak-park',         'desc' => 'Tight-knit, family-first community with one of the highest-rated school districts in California.' ],
	[ 'name' => 'Thousand Oaks',    'slug' => 'thousand-oaks',    'desc' => 'The largest city in the Conejo Valley, known for parks, low crime rates, and a wide range of neighborhoods.' ],
];

$faqs = [
	[ 'q' => 'Is Agoura Hills a good place to live?', 'a' => 'Agoura Hills consistently ranks among the most livable cities in Los Angeles County. Residents tend to highlight the open space, the school district, the strong sense of community, and the rare combination of being close to the city while feeling genuinely tucked away.' ],
	[ 'q' => 'What school district serves Agoura Hills?', 'a' => 'Most of Agoura Hills falls within Las Virgenes Unified School District (LVUSD), which is regularly ranked among the top public school districts in California. The high school is Agoura High; elementary and middle schools include Yerba Buena, Sumac, Lindero Canyon, and A.E. Wright.' ],
	[ 'q' => 'How far is Agoura Hills from Los Angeles?', 'a' => 'Agoura Hills sits about 35 miles from downtown Los Angeles. Without traffic, you can reach Beverly Hills or the Westside in roughly 30–40 minutes via the 101. Burbank is around 30 minutes, and the beach in Malibu is about 30 minutes through the Santa Monica Mountains via Kanan-Dume Road.' ],
	[ 'q' => 'Is Agoura Hills family-friendly?', 'a' => 'Yes. Agoura Hills is one of the most family-oriented communities in the region, with a deep network of parks, youth sports leagues, community events, and well-established neighborhoods designed around families. The school district is a major draw for relocating parents.' ],
	[ 'q' => 'Are there luxury homes in Agoura Hills?', 'a' => 'Yes. Agoura Hills includes a range of price points, from updated single-family homes to large custom estates and equestrian properties in Old Agoura. The luxury tier is typically privately listed and benefits from working with a local agent who knows what is available off-market.' ],
	[ 'q' => 'What is the real estate market like in Agoura Hills?', 'a' => 'Inventory in Agoura Hills tends to be tight, many homes turn over within long-term family circles, and well-prepared listings move quickly. The market favors sellers who price thoughtfully and buyers who are pre-positioned and ready to act when the right home appears.' ],
];
?>

<!-- ====== 1. LISTINGS (top of page) ====== -->
<!-- wp:html -->
<section class="dmg-area-section" id="agoura-hills-homes">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Homes for Sale</p>
		</div>
		<h2 class="dmg-area-section-title">Active Listings in Agoura Hills</h2>

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
				<p style="font-size:1rem;color:var(--wp--preset--color--gray-700);margin:0 0 0.5rem">No active listings in Agoura Hills at the moment.</p>
				<p style="font-size:0.9375rem;color:var(--wp--preset--color--gray-500);margin:0">Inventory in this market moves quickly, <a href="/contact-us/?subject=Questions%20about%20Agoura%20Hills&amp;source=reach-out" style="color:var(--wp--preset--color--primary);font-weight:600;text-decoration:underline">reach out</a> to be notified when something becomes available.</p>
			</div>
		<?php endif; ?>
	</div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="dmg-area-hero" style="background-image:url('<?php echo esc_url( $hero_image ); ?>')" aria-label="Living in Agoura Hills">
	<div class="dmg-area-hero-inner">
		<span class="dmg-area-hero-eyebrow">Conejo Valley Communities</span>
		<h1 class="dmg-area-hero-title">Living in Agoura Hills</h1>
		<p class="dmg-area-hero-intro">A community shaped by oak canyons, generational families, and a quiet preference for the way things ought to be done, close to Los Angeles, but a world unto itself.</p>
		<div class="dmg-area-hero-ctas">
			<a class="dmg-btn-secondary" href="/contact-us/?subject=Speak%20with%20a%20local%20expert&amp;source=local-expert">Speak with a local expert</a>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 2. COMMUNITY SNAPSHOT ====== -->
<!-- wp:html -->
<section class="dmg-area-section">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">At a Glance</p>
		</div>
		<h2 class="dmg-area-section-title">Agoura Hills, in Brief</h2>

		<div class="dmg-snapshot-grid">
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Lifestyle</p>
				<p class="dmg-snapshot-value">Suburban &amp; Outdoor</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Known For</p>
				<p class="dmg-snapshot-value">Family Neighborhoods, Equestrian Heritage</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">School District</p>
				<p class="dmg-snapshot-value">Las Virgenes USD</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Population</p>
				<p class="dmg-snapshot-value">~20,000</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Nearby Cities</p>
				<p class="dmg-snapshot-value">Westlake Village, Calabasas, Oak Park</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Commute to LA</p>
				<p class="dmg-snapshot-value">~30–40 min via US&#8209;101</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Walkability</p>
				<p class="dmg-snapshot-value">Suburban - car-oriented, walkable pockets</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Best For</p>
				<p class="dmg-snapshot-value">Families, outdoor lifestyles, long-term roots</p>
			</div>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 3. ABOUT THE COMMUNITY ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--alt">
	<div class="dmg-area-section-inner">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4 8 4v14"/><path d="M9 9h.01"/><path d="M9 13h.01"/><path d="M15 9h.01"/><path d="M15 13h.01"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">About</p>
		</div>
		<h2 class="dmg-area-section-title">A Quiet Corner of the Conejo Valley</h2>

		<div class="dmg-area-prose">
			<p>Tucked into the northern slope of the Santa Monica Mountains where the Conejo Valley meets Los Angeles County, Agoura Hills feels like one of those places people stumble onto and quietly never want to leave. It is a community shaped by its setting, open hillsides, oak-shaded canyons, the smell of sage after rain, and by the kind of generational families who&rsquo;ve built lives around the rhythms of small-town life with the city just over the ridge.</p>

			<p>The land itself has been a meeting place for centuries. The Chumash people lived here long before Spanish ranchos divided the canyons into cattle country, and traces of that ranching past still echo through the area today, particularly in Old Agoura, where horse properties and dirt roads have been preserved with remarkable intention. By the mid-20th century, the open space and dramatic terrain caught the attention of Hollywood. Paramount Ranch, just outside the city limits, became a working Western film set used in everything from <em>The Cisco Kid</em> to HBO&rsquo;s <em>Westworld</em>, and after the 2018 Woolsey Fire damaged much of the property, the community rallied to rebuild it. The way locals showed up for that effort says a lot about the place.</p>

			<p>Modern Agoura Hills was incorporated as its own city in 1982, largely as a response to growth pressure from greater Los Angeles. The result is a community with strong, consistent planning, generous open space, low building density, a clear preference for landscape over sprawl. You feel that the moment you exit the 101: oak trees instead of strip malls, bike lanes instead of billboards.</p>

			<p>What makes Agoura Hills feel different from neighboring Conejo Valley cities is its layered character. There&rsquo;s the equestrian Old Agoura side, where you&rsquo;ll see horses on the road and feed stores still in operation. There&rsquo;s the family-oriented hillside side, Morrison Ranch, Forest Cove, Liberty Canyon, quiet streets and well-kept yards and kids walking home from elementary school. And there&rsquo;s the outdoor side, where weekends mean Cheeseboro Canyon trails, mountain bikes, or a hike up to a viewpoint that takes in the whole valley.</p>

			<p>The architectural feel reflects all of this. You&rsquo;ll see ranch homes from the 1960s and 70s on generous lots, contemporary remodels, custom Mediterranean estates tucked behind gates, and a fair number of equestrian properties with stables and arenas. Newer construction tends to respect the original scale. There&rsquo;s not much glass-box modernism here, homes lean warm, considered, and rooted in place.</p>

			<p>Schools are a major reason families move in and stay. Agoura Hills is served by Las Virgenes Unified School District, consistently ranked among the strongest in California, and the proximity to private options across Calabasas and Westlake Village widens the range further.</p>

			<p>People here tend to know their neighbors. The Reyes Adobe Days community festival has run for more than twenty years. Old Agoura&rsquo;s annual horse parade is exactly what it sounds like, and it&rsquo;s not a tourist attraction, it&rsquo;s a thing the community does for itself. There&rsquo;s a coffee-shop layer to daily life, a hiking-trail layer, a school-pickup layer, and they all overlap.</p>

			<p>For us, Agoura Hills isn&rsquo;t a market, it&rsquo;s a place we&rsquo;ve lived alongside for three generations. We&rsquo;ve watched neighborhoods evolve, fires reshape the hills, families grow up and come back to raise their own kids two streets over. When we list a home here or help a buyer find one, we&rsquo;re talking about somewhere we already know.</p>
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
		<h2 class="dmg-area-section-title">Where People Live in Agoura Hills</h2>

		<div class="dmg-subhood-grid">
			<article class="dmg-subhood-card">
				<h3>Old Agoura</h3>
				<p>The equestrian heart of the city. Larger lots, dirt roads, horse trails, and a deliberately rural feel that locals have worked hard to preserve. Many properties include stables, arenas, or pasture.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Equestrian</span>
					<span class="dmg-subhood-tag">Estate Lots</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Morrison Ranch</h3>
				<p>One of the most family-oriented hillside neighborhoods. Tree-lined streets, a strong school zone, and a tight neighborhood culture. Homes range from updated 1970s ranches to remodeled traditionals.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Family</span>
					<span class="dmg-subhood-tag">Schools</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Liberty Canyon</h3>
				<p>Newer construction on the southern side of the freeway, closer to open space and the Liberty Canyon wildlife corridor. Mediterranean and contemporary styles, often with views.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Newer Build</span>
					<span class="dmg-subhood-tag">Views</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Forest Cove &amp; Westridge</h3>
				<p>Quiet residential pockets with a mix of single-story ranch homes and two-story traditionals. Popular with longtime residents and families looking for a settled, low-turnover street.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Established</span>
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
		<h2 class="dmg-area-section-title">Las Virgenes Unified &amp; Beyond</h2>

		<div class="dmg-area-prose" style="margin-bottom:3rem">
			<p>Agoura Hills is served by <strong>Las Virgenes Unified School District (LVUSD)</strong>, regularly ranked among the top public school districts in California. Schools are a primary reason families relocate to and stay in the area, and the district&rsquo;s combination of academic strength and community involvement is one of the things you hear about most often from longtime residents.</p>
		</div>

		<div class="dmg-info-cols">
			<div>
				<h3>Public Schools (LVUSD)</h3>
				<ul>
					<li><strong>Yerba Buena Elementary</strong><small>Elementary · Agoura Hills</small></li>
					<li><strong>Sumac Elementary</strong><small>Elementary · Agoura Hills</small></li>
					<li><strong>Willow Elementary</strong><small>Elementary · Agoura Hills</small></li>
					<li><strong>Mariposa School of Global Education</strong><small>K&ndash;5 magnet · Agoura Hills</small></li>
					<li><strong>Lindero Canyon Middle School</strong><small>Middle · Agoura Hills</small></li>
					<li><strong>A.E. Wright Middle School</strong><small>Middle · Calabasas (LVUSD)</small></li>
					<li><strong>Agoura High School</strong><small>High · Agoura Hills</small></li>
				</ul>
			</div>
			<div>
				<h3>Nearby Private Options</h3>
				<ul>
					<li><strong>Hillcrest Christian School</strong><small>Preschool&ndash;12 · Thousand Oaks</small></li>
					<li><strong>Oaks Christian School</strong><small>5&ndash;12 · Westlake Village</small></li>
					<li><strong>Bridges Academy</strong><small>4&ndash;12 · Studio City</small></li>
					<li><strong>Viewpoint School</strong><small>K&ndash;12 · Calabasas</small></li>
					<li><strong>Cornerstone Christian School</strong><small>K&ndash;8 · Agoura Hills</small></li>
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
		<h2 class="dmg-area-section-title">Things To Do in Agoura Hills</h2>
		<div class="dmg-info-cols">
			<div>
				<h3>Outdoors</h3>
				<ul>
					<li><strong>Cheeseboro &amp; Palo Comado Canyons</strong><small>Hiking, mountain biking, oak savannas</small></li>
					<li><strong>Paramount Ranch</strong><small>Historic film set + trails (recently rebuilt)</small></li>
					<li><strong>Old Agoura Park</strong><small>Equestrian rings + picnic areas</small></li>
					<li><strong>Reyes Adobe Park</strong><small>Family-friendly park with adobe historical site</small></li>
					<li><strong>Las Virgenes View Park</strong><small>Sweeping valley views, easy hike</small></li>
				</ul>
			</div>
			<div>
				<h3>Dining &amp; Coffee</h3>
				<ul>
					<li><strong>Adobe Cantina</strong><small>Mexican, longtime local institution</small></li>
					<li><strong>Stonefire Grill</strong><small>Casual family go-to</small></li>
					<li><strong>Vintage Grocers (Whizin&rsquo;s Plaza)</strong><small>Upscale market + cafe</small></li>
					<li><strong>The Canyon Club</strong><small>Live music venue with dinner</small></li>
					<li><strong>Local cafes</strong><small>Several independent coffee shops along Kanan and Agoura Rd.</small></li>
				</ul>
			</div>
			<div>
				<h3>Shopping</h3>
				<ul>
					<li><strong>Whizin&rsquo;s Plaza</strong><small>Boutique + dining hub on Agoura Rd.</small></li>
					<li><strong>The Promenade at Westlake</strong><small>Open-air mall, just over the city line</small></li>
					<li><strong>Vintage Grocers</strong><small>High-end grocery, prepared foods</small></li>
				</ul>
			</div>
			<div>
				<h3>Family &amp; Community</h3>
				<ul>
					<li><strong>Reyes Adobe Days</strong><small>Annual community festival</small></li>
					<li><strong>Old Agoura Holiday Parade</strong><small>Equestrian-themed local tradition</small></li>
					<li><strong>Youth sports leagues</strong><small>Soccer, baseball, lacrosse, equestrian</small></li>
					<li><strong>Agoura Hills Recreation Center</strong><small>Community classes + city programs</small></li>
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
			<p>Agoura Hills sits directly on US&#8209;101, which makes the rest of greater Los Angeles unusually accessible for a community that feels this tucked away. Without traffic, the Westside, Beverly Hills, and Burbank are each roughly 30&ndash;40 minutes by car. Kanan-Dume Road cuts south through the Santa Monica Mountains and reaches the beach in Malibu in about 30 minutes, a route many residents quietly consider one of the city&rsquo;s best-kept perks.</p>

			<p>Common reference points: <strong>Beverly Hills</strong> ~30&ndash;40 minutes · <strong>Burbank</strong> ~30 minutes · <strong>Downtown LA</strong> ~45&ndash;60 minutes · <strong>LAX</strong> ~45&ndash;60 minutes · <strong>Hollywood Burbank Airport</strong> ~30 minutes · <strong>Malibu</strong> ~30 minutes via Kanan-Dume.</p>

			<p>Public transportation is limited, this is a car-oriented community, though Metrolink&rsquo;s Ventura County Line stops in nearby Chatsworth and Simi Valley for commuters heading to Union Station and points east.</p>
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
		<h2 class="dmg-area-section-title">A Place You Don&rsquo;t Outgrow</h2>

		<div class="dmg-area-prose">
			<p>Most of the families we&rsquo;ve helped in Agoura Hills didn&rsquo;t end up here by accident. They came for the schools or the open space or because a friend told them to take the Reyes Adobe exit instead of staying on the 101, and then they stayed because the place quietly delivers on what it promises. Kids grow up walking to friends&rsquo; houses, parents trade horse trail recommendations at the coffee shop, and the same neighbors show up at the same community events year after year.</p>

			<p>For our family, this stretch of the Conejo Valley has been home across three generations. We&rsquo;ve watched the open space stay open, the school district stay strong, and the equestrian streets in Old Agoura keep their character even as the rest of the region has changed. That continuity is rare, and it&rsquo;s the thing residents tend to value most without always knowing how to name it.</p>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 10. SELLER CTA ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--dark">
	<div class="dmg-cta-block">
		<h2>Considering Selling in Agoura Hills?</h2>
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
		<h2>Thinking About Moving to Agoura Hills?</h2>
		<p>The McLaughlin Group has helped buyers navigate the Conejo Valley for generations. Whether you&rsquo;re relocating, purchasing your first home, or searching for your forever home, we&rsquo;d be honored to help guide you through the process.</p>
		<div class="dmg-cta-row">
			<a class="dmg-btn-primary" href="/contact-us/?subject=Schedule%20a%20consultation&amp;source=schedule-consultation">Schedule a consultation</a>
			<a class="dmg-btn-secondary" style="color:var(--wp--preset--color--gray-900);border-color:var(--wp--preset--color--gray-900)" href="#agoura-hills-homes">Explore homes</a>
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
		<h2 class="dmg-area-section-title">Agoura Hills FAQs</h2>

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
		<p style="color:var(--wp--preset--color--gray-100)">For three generations, the McLaughlin family has lived, worked, and built relationships throughout the Conejo Valley. We don&rsquo;t just sell homes here, we proudly call this community home.</p>
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
			"name": "Agoura Hills",
			"description": "A community in the Conejo Valley known for top-rated schools, outdoor lifestyle, and equestrian heritage.",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "Agoura Hills",
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

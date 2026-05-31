<?php
/**
 * Title: Area - Oak Park
 * Slug: dmg/area-oak-park
 * Categories: featured
 * Inserter: false
 */

$hero_image   = get_theme_file_uri( 'assets/images/neighborhoods/oak-park.png' );
$area_slug    = 'oak-park';
$area_name    = 'Oak Park';
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
	[ 'name' => 'Agoura Hills',     'slug' => 'agoura-hills',     'desc' => 'The closest city to Oak Park, with shopping, dining, equestrian heritage, and top-rated Las Virgenes USD schools.' ],
	[ 'name' => 'Westlake Village', 'slug' => 'westlake-village', 'desc' => 'Upscale lakeside community with private lake, golf courses, and refined Conejo Valley amenities just minutes away.' ],
	[ 'name' => 'Thousand Oaks',    'slug' => 'thousand-oaks',    'desc' => 'The Conejo Valley\'s largest city - parks, safety, and broad amenities about 10 minutes east.' ],
];

$faqs = [
	[ 'q' => 'What makes Oak Park Unified School District so highly rated?', 'a' => 'Oak Park Unified is a small, independent district serving only the Oak Park community. Its small size allows for close attention to individual students, strong parental involvement, and consistent academic programming. The district regularly posts some of the highest test scores and graduation rates in California, and Oak Park High School is consistently ranked among the top public high schools in the state.' ],
	[ 'q' => 'Is Oak Park its own city?', 'a' => 'No. Oak Park is an unincorporated community in Ventura County, meaning it has no incorporated city government of its own. It is governed at the county level, with its own zip code, community identity, and - critically - its own independent school district, which is separate from neighboring Thousand Oaks and Agoura Hills.' ],
	[ 'q' => 'How does Oak Park compare to neighboring Agoura Hills?', 'a' => 'Oak Park and Agoura Hills are adjacent and share some retail along the Kanan Road corridor, but they have meaningfully different characters. Oak Park tends to be newer construction, more planned in its layout, with a tighter community feel and its own highly regarded school district. Agoura Hills has more urban character, more dining and retail options, equestrian heritage, and is served by LVUSD. Many families specifically choose Oak Park for the school district.' ],
	[ 'q' => 'What kind of homes are in Oak Park?', 'a' => 'Oak Park is primarily a single-family residential community developed between the 1970s and 1990s, with a mix of ranch homes, two-story traditionals, and some newer custom construction. Lots tend to be moderate in size. There are some hillside properties with views, and the community has maintained its residential character without significant commercial sprawl.' ],
	[ 'q' => 'Is Oak Park safe?', 'a' => 'Oak Park is consistently one of the safest communities in Ventura County. Its planned layout, engaged residents, and strong community association culture contribute to very low crime rates. It is one of the primary reasons families with children are drawn to the area.' ],
	[ 'q' => 'What is the real estate market like in Oak Park?', 'a' => 'Oak Park has appreciated steadily alongside the broader Conejo Valley. The school district premium is real - homes in Oak Park command a meaningful price bump compared to equivalent homes in neighboring areas served by different districts. Inventory is consistently tight, and well-priced homes move quickly when they come available.' ],
];
?>

<!-- ====== 1. LISTINGS (top of page) ====== -->
<!-- wp:html -->
<section class="dmg-area-section" id="oak-park-homes">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Homes for Sale</p>
		</div>
		<h2 class="dmg-area-section-title">Active Listings in Oak Park</h2>

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
				<p style="font-size:1rem;color:var(--wp--preset--color--gray-700);margin:0 0 0.5rem">No active listings in Oak Park at the moment.</p>
				<p style="font-size:0.9375rem;color:var(--wp--preset--color--gray-500);margin:0">Inventory in this market moves quickly, <a href="/contact-us/?subject=Questions%20about%20Oak%20Park&amp;source=reach-out" style="color:var(--wp--preset--color--primary);font-weight:600;text-decoration:underline">reach out</a> to be notified when something becomes available.</p>
			</div>
		<?php endif; ?>
		<div style="margin-top:2rem;text-align:center">
			<a class="dmg-btn-primary" href="/oak-park-homes-for-sale/">Browse all Oak Park listings on MLS</a>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="dmg-area-hero" style="background-image:url('<?php echo esc_url( $hero_image ); ?>')" aria-label="Living in Oak Park">
	<div class="dmg-area-hero-inner">
		<span class="dmg-area-hero-eyebrow">Conejo Valley Communities</span>
		<h1 class="dmg-area-hero-title">Living in Oak Park</h1>
		<p class="dmg-area-hero-intro">A quiet, family-focused community in the hills between Agoura Hills and Thousand Oaks - anchored by one of the highest-rated public school districts in California.</p>
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
		<h2 class="dmg-area-section-title">Oak Park, in Brief</h2>

		<div class="dmg-snapshot-grid">
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Lifestyle</p>
				<p class="dmg-snapshot-value">Quiet Suburban, Family-Focused</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Known For</p>
				<p class="dmg-snapshot-value">Top-rated schools, safety, planned community character</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">School District</p>
				<p class="dmg-snapshot-value">Oak Park Unified</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Population</p>
				<p class="dmg-snapshot-value">~14,000</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Nearby Cities</p>
				<p class="dmg-snapshot-value">Agoura Hills, Westlake Village, Thousand Oaks</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Commute to LA</p>
				<p class="dmg-snapshot-value">~30–40 min via US&#8209;101</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Walkability</p>
				<p class="dmg-snapshot-value">Low – car oriented</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Best For</p>
				<p class="dmg-snapshot-value">Families prioritizing school district, quiet suburban living</p>
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
		<h2 class="dmg-area-section-title">One School District Changes Everything</h2>

		<div class="dmg-area-prose">
			<p>Oak Park sits in a small valley between Agoura Hills to the south and Thousand Oaks to the east, technically within Ventura County and technically unincorporated - it has no city hall, no mayor, and no city government of its own. What it does have is its own school district, and that single fact shapes nearly everything else about the community and why families choose it.</p>

			<p>Oak Park Unified School District is small by design, serving only the Oak Park community. That scale produces something that larger districts struggle to replicate: consistent academic outcomes, genuine administrator accountability, and a school culture where faculty and families actually know each other. Oak Park High School posts some of the highest academic achievement numbers of any public high school in California, and has done so with enough consistency that the reputation precedes it. For families who move to the area specifically for schools, Oak Park is frequently the answer.</p>

			<p>The community itself was developed primarily between the 1970s and early 1990s in a planned residential style - single-family homes on measured lots, consistent streetscapes, parks integrated into the neighborhood design. It lacks the equestrian character of old Agoura Hills and the lakeside amenity of Westlake Village, but it compensates with a tightness and calm that attracts a specific kind of buyer: families who want a place that stays out of the way and lets them live well inside it.</p>

			<p>For day-to-day needs, residents rely mostly on Agoura Hills. The Kanan Road corridor bridges the two communities, and the practical overlap in shopping, dining, and services means Oak Park functions more like a residential annex of Agoura Hills than a standalone community - which suits most residents just fine.</p>
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
		<h2 class="dmg-area-section-title">Where People Live in Oak Park</h2>

		<div class="dmg-subhood-grid">
			<article class="dmg-subhood-card">
				<h3>Oak Park Highlands</h3>
				<p>Hillside properties on the northern edge with valley views. Mix of 1980s&ndash;1990s construction and some newer custom homes on larger lots.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Views</span>
					<span class="dmg-subhood-tag">Hillside</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Medea Valley</h3>
				<p>Quiet interior neighborhood adjacent to Medea Creek and its natural greenway. Family-oriented streets, strong school proximity.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Greenway</span>
					<span class="dmg-subhood-tag">Family</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Kanan Road Corridor</h3>
				<p>Central Oak Park along the main arterial connecting to Agoura Hills. Most accessible location for commuters and daily errands.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Central</span>
					<span class="dmg-subhood-tag">Commuter</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Shadow Ridge</h3>
				<p>Elevated properties on the community&rsquo;s southwestern edge. Larger lots, views into the canyon, more private feel.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Views</span>
					<span class="dmg-subhood-tag">Privacy</span>
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
		<h2 class="dmg-area-section-title">Oak Park Unified School District</h2>

		<div class="dmg-area-prose" style="margin-bottom:3rem">
			<p><strong>Oak Park Unified School District</strong> is a small, independent district serving only the Oak Park community - one of the highest-ranked public school districts in California. Its scale creates accountability and consistency that larger districts rarely match.</p>
		</div>

		<div class="dmg-info-cols">
			<div>
				<h3>Public Schools (Oak Park USD)</h3>
				<ul>
					<li><strong>Red Oak Elementary / Oak Hills Elementary</strong><small>Elementary &middot; Oak Park</small></li>
					<li><strong>Medea Creek Middle School</strong><small>Middle &middot; Oak Park</small></li>
					<li><strong>Oak Park High School</strong><small>High &middot; Oak Park</small></li>
				</ul>
			</div>
			<div>
				<h3>Nearby Private Options</h3>
				<ul>
					<li><strong>Oaks Christian School</strong><small>Grades 6&ndash;12 &middot; Westlake Village (~10 min)</small></li>
					<li><strong>Hillcrest Christian School</strong><small>K&ndash;12 &middot; Thousand Oaks (~10 min)</small></li>
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
		<h2 class="dmg-area-section-title">Things To Do in Oak Park</h2>

		<div class="dmg-info-cols">
			<div>
				<h3>Outdoors</h3>
				<ul>
					<li><strong>Medea Creek Nature Area</strong><small>Natural greenway through the community</small></li>
					<li><strong>Albertson Motorway trail</strong><small>Connects to Simi Valley and open space to the north</small></li>
					<li><strong>King James Court Park</strong><small>Community sports fields and recreation</small></li>
					<li><strong>Conejo Valley Open Space</strong><small>Multi-use trails nearby</small></li>
				</ul>
			</div>
			<div>
				<h3>Dining &amp; Shopping</h3>
				<ul>
					<li><strong>Agoura Hills - Whizin&rsquo;s Plaza</strong><small>Dining and retail hub just minutes away</small></li>
					<li><strong>Kanan Road restaurants</strong><small>Local options along the Oak Park corridor</small></li>
					<li><strong>The Promenade at Westlake</strong><small>Upscale shopping ~10 min away</small></li>
				</ul>
			</div>
			<div>
				<h3>Community</h3>
				<ul>
					<li><strong>Oak Park Little League</strong><small>Active youth baseball program</small></li>
					<li><strong>Youth soccer</strong><small>AYSO and recreational leagues</small></li>
					<li><strong>Oak Park Arts League</strong><small>Community arts programming and events</small></li>
					<li><strong>School parent community</strong><small>One of the most engaged school communities in the region</small></li>
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
			<p>Common reference points: <strong>Beverly Hills</strong> ~30&ndash;35 min via US&#8209;101 &middot; <strong>San Fernando Valley</strong> ~25 min &middot; <strong>Agoura Hills</strong> ~10 min &middot; <strong>Westlake Village</strong> ~15 min &middot; <strong>Downtown LA</strong> ~45 min &middot; <strong>LAX</strong> ~50 min. Kanan Road is the primary connector south to the 101.</p>
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
		<h2 class="dmg-area-section-title">A Place That Keeps Its Promises</h2>

		<div class="dmg-area-prose">
			<p>Oak Park is a place where the selling point is also the lived reality. The school district backs up its numbers year after year. The streets are quiet in the way people mean it when they say they want quiet streets. Families move in, the kids grow up, and a surprising number of them come back. That kind of continuity is not accidental.</p>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 10. SELLER CTA ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--dark">
	<div class="dmg-cta-block">
		<h2>Considering Selling in Oak Park?</h2>
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
		<h2>Thinking About Moving to Oak Park?</h2>
		<p>The McLaughlin Group has helped buyers navigate the Conejo Valley for generations. Whether you&rsquo;re relocating, purchasing your first home, or searching for your forever home, we&rsquo;d be honored to help guide you through the process.</p>
		<div class="dmg-cta-row">
			<a class="dmg-btn-primary" href="/contact-us/?subject=Schedule%20a%20consultation&amp;source=schedule-consultation">Schedule a consultation</a>
			<a class="dmg-btn-secondary" style="color:var(--wp--preset--color--gray-900);border-color:var(--wp--preset--color--gray-900)" href="#oak-park-homes">Explore homes</a>
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
		<h2 class="dmg-area-section-title">Oak Park FAQs</h2>

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
			"name": "Oak Park",
			"description": "A quiet, family-focused unincorporated community in Ventura County, anchored by Oak Park Unified School District - one of the highest-rated public school districts in California.",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "Oak Park",
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

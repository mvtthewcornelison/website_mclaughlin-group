<?php
/**
 * Title: Area - Malibou Lake
 * Slug: dmg/area-malibou-lake
 * Categories: featured
 * Inserter: false
 */

$hero_image   = get_theme_file_uri( 'assets/images/neighborhoods/malibou-lake.jpeg' );
$area_slug    = 'malibou-lake';
$area_name    = 'Malibou Lake';
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
	[ 'name' => 'Agoura Hills',     'slug' => 'agoura-hills',     'desc' => 'The closest full-service city to Malibou Lake, with top-rated schools, equestrian heritage, and a strong community culture.' ],
	[ 'name' => 'Malibu',           'slug' => 'malibu',           'desc' => 'Pacific coastline and canyon living, reached via Malibu Canyon Road in about 20 minutes from the lake.' ],
	[ 'name' => 'Westlake Village', 'slug' => 'westlake-village', 'desc' => 'A planned lakeside community with upscale amenities, golf courses, and strong schools about 15 minutes away.' ],
];

$faqs = [
	[ 'q' => 'Is Malibou Lake a gated community?', 'a' => 'Malibou Lake is a private, deed-restricted community managed by a homeowners association. Access to the lake and community amenities is limited to residents and their guests. The community has a long-standing culture of privacy and self-governance that residents actively work to preserve.' ],
	[ 'q' => 'Can you swim or boat on Malibou Lake?', 'a' => 'Lake access - swimming, kayaking, paddleboarding, and non-motorized boating - is a private amenity reserved for Malibou Lake Mountain Club members and residents. It is one of the primary draws of living in the community.' ],
	[ 'q' => 'What school district serves Malibou Lake?', 'a' => 'Most Malibou Lake residents are served by Las Virgenes Unified School District (LVUSD), the same top-ranked district that serves Agoura Hills and Calabasas. Students typically attend Agoura High School.' ],
	[ 'q' => 'How many homes are in Malibou Lake?', 'a' => 'The Malibou Lake community has approximately 200–250 residences surrounding the lake and along the adjoining canyon roads. Development is intentionally tightly restricted, which helps preserve the rural character residents value.' ],
	[ 'q' => 'How did the 2018 Woolsey Fire affect Malibou Lake?', 'a' => 'The Woolsey Fire of November 2018 burned through much of the Santa Monica Mountains and impacted the Malibou Lake area significantly, destroying a number of homes. The community has rebuilt substantially since then, with many properties updated or newly constructed.' ],
	[ 'q' => 'What is the real estate market like in Malibou Lake?', 'a' => 'Malibou Lake is one of the most tightly held real estate markets in the region. Turnover is low, lakefront homes are rarely available, and when they come to market they attract significant interest. Canyon road properties offer a more accessible price point while still delivering the mountain seclusion the area is known for.' ],
];
?>

<!-- ====== 1. LISTINGS (top of page) ====== -->
<!-- wp:html -->
<section class="dmg-area-section" id="malibou-lake-homes">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">
		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Homes for Sale</p>
		</div>
		<h2 class="dmg-area-section-title">Active Listings in Malibou Lake</h2>

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
				<p style="font-size:1rem;color:var(--wp--preset--color--gray-700);margin:0 0 0.5rem">No active listings in Malibou Lake at the moment.</p>
				<p style="font-size:0.9375rem;color:var(--wp--preset--color--gray-500);margin:0">Inventory in this market moves quickly, <a href="/contact-us/?subject=Questions%20about%20Malibou%20Lake&amp;source=reach-out" style="color:var(--wp--preset--color--primary);font-weight:600;text-decoration:underline">reach out</a> to be notified when something becomes available.</p>
			</div>
		<?php endif; ?>
	</div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="dmg-area-hero" style="background-image:url('<?php echo esc_url( $hero_image ); ?>')" aria-label="Living in Malibou Lake">
	<div class="dmg-area-hero-inner">
		<span class="dmg-area-hero-eyebrow">Conejo Valley Communities</span>
		<h1 class="dmg-area-hero-title">Living in Malibou Lake</h1>
		<p class="dmg-area-hero-intro">A private mountain lake community tucked into the Santa Monica Mountains - one of the most secluded and sought-after addresses within reach of Los Angeles.</p>
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
		<h2 class="dmg-area-section-title">Malibou Lake, in Brief</h2>

		<div class="dmg-snapshot-grid">
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Lifestyle</p>
				<p class="dmg-snapshot-value">Rural / Private Lake Community</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Known For</p>
				<p class="dmg-snapshot-value">Private lake, mountain seclusion, equestrian properties</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">School District</p>
				<p class="dmg-snapshot-value">Las Virgenes USD</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Population</p>
				<p class="dmg-snapshot-value">~600</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Nearby Cities</p>
				<p class="dmg-snapshot-value">Agoura Hills, Calabasas, Malibu</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Commute to LA</p>
				<p class="dmg-snapshot-value">~45–55 min via US&#8209;101</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Walkability</p>
				<p class="dmg-snapshot-value">Very low – car essential</p>
			</div>
			<div class="dmg-snapshot-card">
				<p class="dmg-snapshot-label">Best For</p>
				<p class="dmg-snapshot-value">Privacy seekers, equestrian lifestyles, nature lovers</p>
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
		<h2 class="dmg-area-section-title">A Private Lake in the Santa Monica Mountains</h2>

		<div class="dmg-area-prose">
			<p>Malibou Lake sits in a natural bowl in the Santa Monica Mountains, roughly five miles from the Agoura Hills exit on the 101. It is a private lake community of approximately 200&ndash;250 homes arranged around a 40-acre lake - small enough that most residents know their neighbors, remote enough that the city genuinely disappears. For those who find it, it tends to become non-negotiable.</p>

			<p>The community traces its origins to the 1920s, when it was developed as a mountain resort destination, and traces of that history are still present in the original bungalow architecture scattered among newer construction. The Malibou Lake Mountain Club has been the center of community life for nearly a century, organizing events, managing lake access, and maintaining the sense of place that makes the area worth protecting.</p>

			<p>The 2018 Woolsey Fire was a defining moment for Malibou Lake. The fire burned through much of the surrounding mountain terrain and destroyed a meaningful number of homes in the community. The response from residents was, by nearly all accounts, characteristic of the place: people showed up for each other, rebuilt with intention, and in many cases used the opportunity to construct homes that were more fire-resilient than what came before. The community that emerged is, if anything, more cohesive.</p>

			<p>Daily life here is unhurried. Lake mornings, Malibu Creek State Park trails in the afternoon, dinner in Agoura Hills because Malibou Lake has no commercial center of its own. The narrow canyon roads are a known trade-off. So is the fire risk. Residents absorb both and stay anyway, because what they get in return - genuine seclusion, a working lake, mountain air - is genuinely difficult to replicate.</p>
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
		<h2 class="dmg-area-section-title">Where People Live in Malibou Lake</h2>

		<div class="dmg-subhood-grid">
			<article class="dmg-subhood-card">
				<h3>Lakefront Estates</h3>
				<p>Properties directly on the lake perimeter - the most sought-after addresses in the community. Many have private docks and direct water access. Rarely available.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Lakefront</span>
					<span class="dmg-subhood-tag">Private</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Mountain Road Properties</h3>
				<p>Wooded lots along the canyon roads above the lake, offering more privacy and larger parcels. A mix of original bungalows and newer construction rebuilt after Woolsey.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Wooded Lots</span>
					<span class="dmg-subhood-tag">Privacy</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Rim of the Lake</h3>
				<p>The elevated outer ring of the community with partial lake views and somewhat larger lots. More accessible price point than direct lakefront.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Views</span>
					<span class="dmg-subhood-tag">Elevated</span>
				</div>
			</article>

			<article class="dmg-subhood-card">
				<h3>Canyon Road Area</h3>
				<p>Properties along Malibu Canyon Road and its tributaries, outside the core HOA area. Larger parcels, more rural in character, equestrian-compatible.</p>
				<div class="dmg-subhood-tags">
					<span class="dmg-subhood-tag">Large Lots</span>
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
		<h2 class="dmg-area-section-title">Las Virgenes Unified &amp; Beyond</h2>

		<div class="dmg-area-prose" style="margin-bottom:3rem">
			<p>Malibou Lake residents are served by <strong>Las Virgenes Unified School District (LVUSD)</strong>, the same top-ranked district serving Agoura Hills and Calabasas. Students typically attend Agoura High School, with elementary and middle school options in Agoura Hills.</p>
		</div>

		<div class="dmg-info-cols">
			<div>
				<h3>Public Schools (LVUSD)</h3>
				<ul>
					<li><strong>Sumac Elementary / Yerba Buena Elementary</strong><small>Elementary &middot; Agoura Hills</small></li>
					<li><strong>Lindero Canyon Middle School</strong><small>Middle &middot; Agoura Hills</small></li>
					<li><strong>Agoura High School</strong><small>High &middot; Agoura Hills</small></li>
				</ul>
			</div>
			<div>
				<h3>Nearby Private Options</h3>
				<ul>
					<li><strong>Viewpoint School</strong><small>K&ndash;12 &middot; Calabasas</small></li>
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
		<h2 class="dmg-area-section-title">Things To Do in Malibou Lake</h2>

		<div class="dmg-info-cols">
			<div>
				<h3>Outdoors</h3>
				<ul>
					<li><strong>Malibu Creek State Park</strong><small>Adjacent - Rock Pool, Cage Trail, Crags Road</small></li>
					<li><strong>Paramount Ranch</strong><small>Historic film set + trails (recently rebuilt)</small></li>
					<li><strong>Malibou Lake community paths</strong><small>Lakeside and hillside hiking</small></li>
					<li><strong>Las Virgenes trail network</strong><small>Multi-use trails through the mountains</small></li>
				</ul>
			</div>
			<div>
				<h3>Dining &amp; Coffee</h3>
				<ul>
					<li><strong>Whizin&rsquo;s Plaza</strong><small>5&ndash;10 min drive &middot; boutique dining hub</small></li>
					<li><strong>Adobe Cantina</strong><small>Agoura Hills &middot; longtime local institution</small></li>
					<li><strong>Vintage Grocers</strong><small>Upscale market + caf&eacute;</small></li>
					<li><strong>The Canyon Club</strong><small>Live music venue with dinner</small></li>
				</ul>
			</div>
			<div>
				<h3>Shopping</h3>
				<ul>
					<li><strong>Whizin&rsquo;s Plaza</strong><small>Boutique + dining &middot; Agoura Hills</small></li>
					<li><strong>Agoura Hills retail corridor</strong><small>5&ndash;10 min drive via Kanan Road</small></li>
				</ul>
			</div>
			<div>
				<h3>Community</h3>
				<ul>
					<li><strong>Malibou Lake Mountain Club</strong><small>Seasonal events + lake recreation</small></li>
					<li><strong>Annual community gatherings</strong><small>Longstanding neighborhood traditions</small></li>
					<li><strong>Lake recreation</strong><small>Kayak, paddleboard, non-motorized boating</small></li>
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
			<p>Malibou Lake&rsquo;s position in the mountains means the 101 is a 5&ndash;10 minute drive away, and once you&rsquo;re on it, the rest of greater Los Angeles becomes accessible. Beverly Hills and the Westside are roughly 45&ndash;55 minutes. Burbank and the Valley are about 40 minutes. The beach in Malibu is a 20-minute drive south via Malibu Canyon Road - one of the genuinely scenic routes in the region. Public transit is not a realistic option. This is a car-dependent community by nature, and residents plan accordingly.</p>
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
		<h2 class="dmg-area-section-title">Nothing Quite Replaces It</h2>

		<div class="dmg-area-prose">
			<p>The people who live in Malibou Lake stay because nothing quite replaces it. The lake in the morning, the mountain quiet after the 101 is behind you, the feeling of arriving somewhere genuinely private at the end of the day - it is not for everyone, given the narrow roads, the fire risk, the absence of a coffee shop around the corner. But for those it fits, it fits completely.</p>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- ====== 10. SELLER CTA ====== -->
<!-- wp:html -->
<section class="dmg-area-section dmg-area-section--dark">
	<div class="dmg-cta-block">
		<h2>Considering Selling in Malibou Lake?</h2>
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
		<h2>Thinking About Moving to Malibou Lake?</h2>
		<p>The McLaughlin Group has helped buyers navigate the Conejo Valley for generations. Whether you&rsquo;re relocating, purchasing your first home, or searching for your forever home, we&rsquo;d be honored to help guide you through the process.</p>
		<div class="dmg-cta-row">
			<a class="dmg-btn-primary" href="/contact-us/?subject=Schedule%20a%20consultation&amp;source=schedule-consultation">Schedule a consultation</a>
			<a class="dmg-btn-secondary" style="color:var(--wp--preset--color--gray-900);border-color:var(--wp--preset--color--gray-900)" href="#malibou-lake-homes">Explore homes</a>
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
		<h2 class="dmg-area-section-title">Malibou Lake FAQs</h2>

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
			"name": "Malibou Lake",
			"description": "A private mountain lake community in the Santa Monica Mountains, known for seclusion, lake access, and equestrian properties.",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "Malibou Lake",
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

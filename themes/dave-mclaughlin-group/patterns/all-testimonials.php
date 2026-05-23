<?php
/**
 * Title: All Testimonials
 * Slug: dmg/all-testimonials
 * Categories: featured
 * Inserter: false
 */

$reviews = function_exists( 'dmg_get_reviews' ) ? dmg_get_reviews() : [];
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"3rem","left":"2rem","right":"2rem"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<section class="wp-block-group alignfull" style="padding-top:5rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem">

	<!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center","flexWrap":"nowrap"},"style":{"spacing":{"blockGap":"0.625rem","margin":{"top":"0","bottom":"0"}}}} -->
	<div class="wp-block-group">
		<!-- wp:html -->
		<span aria-hidden="true" style="display:inline-flex;align-items:center;color:var(--wp--preset--color--primary)"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21c0-3 1.5-5 4-6"/><path d="M3 15V9a3 3 0 0 1 3-3h2a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z"/><path d="M14 21c0-3 1.5-5 4-6"/><path d="M14 15V9a3 3 0 0 1 3-3h2a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1z"/></svg></span>
		<!-- /wp:html -->

		<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.25em","fontSize":"0.8125rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"gray-500"} -->
		<p class="has-gray-500-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.8125rem;font-weight:600;letter-spacing:0.25em;text-transform:uppercase">Testimonials</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:spacer {"height":"1rem"} -->
	<div style="height:1rem" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:heading {"textAlign":"center","level":1,"textColor":"gray-900","style":{"typography":{"fontWeight":"700","lineHeight":"1.1","letterSpacing":"-0.015em","fontSize":"clamp(2rem, 4vw, 2.75rem)"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
	<h1 class="wp-block-heading has-text-align-center has-gray-900-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:clamp(2rem, 4vw, 2.75rem);font-weight:700;letter-spacing:-0.015em;line-height:1.1">What Clients Are Saying</h1>
	<!-- /wp:heading -->

	<!-- wp:spacer {"height":"1.25rem"} -->
	<div style="height:1.25rem" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.0625rem","lineHeight":"1.65"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"gray-700"} -->
	<p class="has-text-align-center has-gray-700-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.0625rem;line-height:1.65">Real words from real clients across the Conejo Valley. Every review below is publicly verified on the platform it came from.</p>
	<!-- /wp:paragraph -->

</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"3rem","bottom":"5rem","left":"2rem","right":"2rem"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<section class="wp-block-group alignfull" style="padding-top:3rem;padding-right:2rem;padding-bottom:5rem;padding-left:2rem">

	<!-- wp:html -->
	<style>
		.dmg-all-reviews { display: flex; flex-direction: column; gap: 2rem; }
		.dmg-all-review {
			background: #fff;
			border: 1px solid var(--wp--preset--color--gray-100);
			padding: 2.25rem 2rem;
			display: flex;
			flex-direction: column;
			gap: 1rem;
		}
		.dmg-all-review-head { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem; }
		.dmg-all-review-stars { display: inline-flex; gap: 0.2rem; color: #006AFF; }
		.dmg-all-review-stars--google { color: #FBBC05; }
		.dmg-all-review-source {
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			font-size: 0.8125rem;
			color: var(--wp--preset--color--gray-600);
			letter-spacing: 0.02em;
		}
		.dmg-all-review-quote {
			font-size: 1.0625rem;
			line-height: 1.7;
			color: var(--wp--preset--color--gray-800);
			margin: 0;
			font-style: italic;
			position: relative;
			padding-left: 1.25rem;
			border-left: 3px solid var(--wp--preset--color--gray-100);
		}
		.dmg-zillow-logo, .dmg-google-logo {
			display: inline-flex; align-items: center; gap: 0.375rem;
			font-weight: 700; font-size: 0.9375rem; letter-spacing: -0.01em;
		}
		.dmg-zillow-logo { color: #006AFF; }
		.dmg-google-logo { color: var(--wp--preset--color--gray-900); }
		@media (max-width: 600px) {
			.dmg-all-review { padding: 1.75rem 1.5rem; }
			.dmg-all-review-quote { font-size: 1rem; }
		}
	</style>

	<?php if ( empty( $reviews ) ) : ?>
		<p style="text-align:center;color:#737373;font-style:italic">No reviews yet, add one from the <strong>Reviews</strong> menu in the WordPress admin.</p>
	<?php else : ?>
		<div class="dmg-all-reviews">
			<?php foreach ( $reviews as $review ) :
				$rating = (int) get_post_meta( $review->ID, 'dmg_rating', true ) ?: 5;
				$quote  = get_post_meta( $review->ID, 'dmg_quote', true );
				$source = get_post_meta( $review->ID, 'dmg_source', true ) ?: 'zillow';
				if ( ! $quote ) { continue; }
			?>
				<article class="dmg-all-review">
					<div class="dmg-all-review-head">
						<div class="dmg-all-review-stars dmg-all-review-stars--<?php echo esc_attr( $source ); ?>" aria-label="<?php echo esc_attr( $rating . ' out of 5 stars' ); ?>">
							<?php for ( $i = 0; $i < $rating; $i++ ) : ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.95 6.99 7.55.66-5.74 4.97 1.74 7.38L12 18.27l-6.5 3.73 1.74-7.38L1.5 9.65l7.55-.66z"/></svg>
							<?php endfor; ?>
						</div>
						<div class="dmg-all-review-source">
							Reviewed on
							<?php dmg_review_source_logo( $source ); ?>
						</div>
					</div>
					<blockquote class="dmg-all-review-quote"><?php echo esc_html( $quote ); ?></blockquote>
				</article>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<!-- /wp:html -->

</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"7rem","left":"2rem","right":"2rem"}}},"backgroundColor":"gray-50","layout":{"type":"constrained","contentSize":"760px"}} -->
<section class="wp-block-group alignfull has-gray-50-background-color has-background" style="padding-top:5rem;padding-right:2rem;padding-bottom:7rem;padding-left:2rem">

	<!-- wp:heading {"textAlign":"center","level":2,"textColor":"gray-900","style":{"typography":{"fontWeight":"700","lineHeight":"1.15","letterSpacing":"-0.01em","fontSize":"1.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
	<h2 class="wp-block-heading has-text-align-center has-gray-900-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.75rem;font-weight:700;letter-spacing:-0.01em;line-height:1.15">See more reviews on the platforms where they live</h2>
	<!-- /wp:heading -->

	<!-- wp:spacer {"height":"1.25rem"} -->
	<div style="height:1.25rem" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1rem","lineHeight":"1.65"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"gray-700"} -->
	<p class="has-text-align-center has-gray-700-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1rem;line-height:1.65">Verify any of these reviews directly, or read the full set, on Dave&rsquo;s public profiles.</p>
	<!-- /wp:paragraph -->

	<!-- wp:spacer {"height":"2.5rem"} -->
	<div style="height:2.5rem" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:html -->
	<style>
		.dmg-profile-ctas {
			display: flex;
			gap: 1rem;
			justify-content: center;
			flex-wrap: wrap;
		}
		.dmg-profile-cta {
			display: inline-flex;
			align-items: center;
			gap: 0.6rem;
			padding: 0.95rem 1.5rem;
			background: #fff;
			border: 1px solid var(--wp--preset--color--gray-200);
			color: var(--wp--preset--color--gray-900);
			font-size: 0.9375rem;
			font-weight: 600;
			letter-spacing: 0.005em;
			text-decoration: none;
			transition: border-color 0.15s ease, background 0.15s ease, color 0.15s ease;
		}
		.dmg-profile-cta:hover { border-color: var(--wp--preset--color--gray-900); }
		.dmg-profile-cta--zillow:hover { border-color: #006AFF; color: #006AFF; }
		.dmg-profile-cta--google:hover { border-color: #4285F4; }
		.dmg-profile-cta svg.dmg-cta-arrow { width: 14px; height: 14px; }
	</style>
	<div class="dmg-profile-ctas">
		<a class="dmg-profile-cta dmg-profile-cta--zillow" href="https://www.zillow.com/profile/agentmclaugh" target="_blank" rel="noopener" aria-label="View Zillow profile">
			<span class="dmg-zillow-logo">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true"><path d="M16 2 3 12.4v3.4l4.3-1.7v9.5h6.2v-7.3h5v7.3h6.2v-9.5l4.3 1.7v-3.4z"/></svg>
				Zillow profile
			</span>
			<svg class="dmg-cta-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7"/><path d="M7 7h10v10"/></svg>
		</a>
		<a class="dmg-profile-cta dmg-profile-cta--google" href="https://maps.app.goo.gl/vxCPDTRYyK7b3pZ4A?g_st=ig" target="_blank" rel="noopener" aria-label="View Google Business Profile">
			<span class="dmg-google-logo">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48" aria-hidden="true">
					<path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3c-1.6 4.7-6.1 8-11.3 8-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.8 1.2 7.9 3l5.7-5.7C34 6.1 29.3 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.4-.4-3.5z"/>
					<path fill="#FF3D00" d="m6.3 14.7 6.6 4.8C14.7 16.2 19 13 24 13c3.1 0 5.8 1.2 7.9 3l5.7-5.7C34 6.1 29.3 4 24 4 16.3 4 9.7 8.3 6.3 14.7z"/>
					<path fill="#4CAF50" d="M24 44c5.2 0 9.9-2 13.4-5.2l-6.2-5.2C29.2 34.8 26.7 36 24 36c-5.2 0-9.6-3.3-11.3-7.9l-6.5 5C9.6 39.6 16.2 44 24 44z"/>
					<path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.3 4.3-4.1 5.7l6.2 5.2C40.9 35.6 44 30.2 44 24c0-1.3-.1-2.4-.4-3.5z"/>
				</svg>
				Google profile
			</span>
			<svg class="dmg-cta-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7"/><path d="M7 7h10v10"/></svg>
		</a>
	</div>
	<!-- /wp:html -->

</section>
<!-- /wp:group -->

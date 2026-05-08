<?php
/**
 * Title: Home Testimonials
 * Slug: dmg/home-testimonials
 * Categories: featured
 * Inserter: false
 */

$reviews = function_exists( 'dmg_get_reviews' ) ? dmg_get_reviews() : [];
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"7rem","bottom":"7rem","left":"2rem","right":"2rem"}}},"backgroundColor":"gray-900","textColor":"white","layout":{"type":"constrained","contentSize":"840px"}} -->
<section class="wp-block-group alignfull has-white-color has-gray-900-background-color has-text-color has-background" style="padding-top:7rem;padding-right:2rem;padding-bottom:7rem;padding-left:2rem">

	<!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center","flexWrap":"nowrap"},"style":{"spacing":{"blockGap":"0.625rem","margin":{"top":"0","bottom":"0"}}}} -->
	<div class="wp-block-group">
		<!-- wp:html -->
		<span aria-hidden="true" style="display:inline-flex;align-items:center;color:var(--wp--preset--color--primary)"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21c0-3 1.5-5 4-6"/><path d="M3 15V9a3 3 0 0 1 3-3h2a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z"/><path d="M14 21c0-3 1.5-5 4-6"/><path d="M14 15V9a3 3 0 0 1 3-3h2a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1z"/></svg></span>
		<!-- /wp:html -->

		<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.25em","fontSize":"0.8125rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"gray-300"} -->
		<p class="has-gray-300-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.8125rem;font-weight:600;letter-spacing:0.25em;text-transform:uppercase">Testimonials</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:spacer {"height":"1rem"} -->
	<div style="height:1rem" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:heading {"textAlign":"center","level":2,"textColor":"white","style":{"typography":{"fontWeight":"700","lineHeight":"1.1","letterSpacing":"-0.015em"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
	<h2 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:0;font-weight:700;letter-spacing:-0.015em;line-height:1.1">What Clients Are Saying</h2>
	<!-- /wp:heading -->

	<!-- wp:spacer {"height":"3.5rem"} -->
	<div style="height:3.5rem" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:html -->
	<style>
		.dmg-testimonials-wrap { max-width: 760px; margin: 0 auto; }
		.dmg-testimonial {
			padding: 0 1rem;
			text-align: center;
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 1.25rem;
		}
		.dmg-testimonial-stars { display: inline-flex; gap: 0.25rem; color: #5BA0FF; }
		.dmg-testimonial-stars--google { color: #FBBC05; }
		.dmg-testimonial-quote {
			font-size: 1.1875rem;
			line-height: 1.7;
			color: var(--wp--preset--color--gray-100);
			letter-spacing: 0.005em;
			margin: 0;
			max-width: 680px;
			font-style: italic;
		}
		.dmg-testimonial-quote::before {
			content: "\201C";
			display: block;
			font-family: Georgia, "Times New Roman", serif;
			font-size: 4rem;
			line-height: 0.5;
			color: #fff;
			margin-bottom: 1.25rem;
			font-style: normal;
		}
		.dmg-testimonial-source {
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			font-size: 0.8125rem;
			color: var(--wp--preset--color--gray-300);
			letter-spacing: 0.02em;
		}
		.dmg-zillow-logo { display: inline-flex; align-items: center; gap: 0.375rem; color: #5BA0FF; font-weight: 700; font-size: 0.9375rem; letter-spacing: -0.01em; }
		.dmg-google-logo { display: inline-flex; align-items: center; gap: 0.375rem; color: #fff; font-weight: 700; font-size: 0.9375rem; letter-spacing: -0.01em; }
		.dmg-testimonials-carousel { padding: 0 3rem; }
		.dmg-testimonials-carousel .splide__arrow { background: #fff; opacity: 1; width: 2.25rem; height: 2.25rem; }
		.dmg-testimonials-carousel .splide__arrow svg { fill: var(--wp--preset--color--gray-900); }
		.dmg-testimonials-carousel .splide__arrow:hover:not(:disabled) { background: var(--wp--preset--color--primary); }
		.dmg-testimonials-carousel .splide__arrow:hover:not(:disabled) svg { fill: #fff; }
		.dmg-testimonials-carousel .splide__pagination { bottom: -2.25rem; }
		.dmg-testimonials-carousel .splide__pagination__page { background: rgba(255,255,255,0.35); }
		.dmg-testimonials-carousel .splide__pagination__page.is-active { background: #fff; transform: scale(1.2); }
		.dmg-testimonials-viewall {
			display: inline-flex;
			align-items: center;
			gap: 0.4rem;
			margin-top: 4rem;
			font-size: 0.9375rem;
			font-weight: 600;
			letter-spacing: 0.005em;
			color: #fff;
			text-decoration: none;
			border-bottom: 1px solid #fff;
			padding-bottom: 0.25rem;
			transition: color 0.15s ease, border-color 0.15s ease;
		}
		.dmg-testimonials-viewall:hover { color: var(--wp--preset--color--primary); border-color: var(--wp--preset--color--primary); }
		@media (max-width: 600px) {
			.dmg-testimonials-carousel { padding: 0; }
			.dmg-testimonials-carousel .splide__arrow { display: none; }
			.dmg-testimonial-quote { font-size: 1.0625rem; }
		}
	</style>

	<?php if ( empty( $reviews ) ) : ?>
		<p style="text-align:center;color:var(--wp--preset--color--gray-300);font-style:italic;max-width:560px;margin:0 auto">No reviews yet, add one from the <strong>Reviews</strong> menu in the WordPress admin.</p>
	<?php else : ?>
		<div class="dmg-testimonials-wrap">
			<div class="splide dmg-testimonials-carousel" aria-label="Client Testimonials">
				<div class="splide__track">
					<ul class="splide__list">
						<?php foreach ( $reviews as $review ) :
							$rating = (int) get_post_meta( $review->ID, 'dmg_rating', true ) ?: 5;
							$quote  = get_post_meta( $review->ID, 'dmg_quote', true );
							$source = get_post_meta( $review->ID, 'dmg_source', true ) ?: 'zillow';
							if ( ! $quote ) { continue; }
						?>
						<li class="splide__slide">
							<figure class="dmg-testimonial">
								<div class="dmg-testimonial-stars dmg-testimonial-stars--<?php echo esc_attr( $source ); ?>" aria-label="<?php echo esc_attr( $rating . ' out of 5 stars' ); ?>">
									<?php for ( $i = 0; $i < $rating; $i++ ) : ?>
										<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.95 6.99 7.55.66-5.74 4.97 1.74 7.38L12 18.27l-6.5 3.73 1.74-7.38L1.5 9.65l7.55-.66z"/></svg>
									<?php endfor; ?>
								</div>
								<blockquote class="dmg-testimonial-quote"><?php echo esc_html( $quote ); ?></blockquote>
								<figcaption class="dmg-testimonial-source">
									Reviewed on
									<?php dmg_review_source_logo( $source ); ?>
								</figcaption>
							</figure>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>

			<div style="text-align:center">
				<a class="dmg-testimonials-viewall" href="/testimonials/" aria-label="View all reviews">
					View all reviews
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
				</a>
			</div>
		</div>
	<?php endif; ?>
	<!-- /wp:html -->

</section>
<!-- /wp:group -->

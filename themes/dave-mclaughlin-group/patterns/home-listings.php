<?php
/**
 * Title: Home Listings
 * Slug: dmg/home-listings
 * Categories: featured
 * Inserter: false
 */

$listings = function_exists( 'dmg_get_listings' ) ? dmg_get_listings() : [];
$count    = count( $listings );
$per_page = max( 1, min( 3, $count ) );

$status_label = [
	'active'  => 'Active',
	'pending' => 'Pending',
	'sold'    => 'Sold',
];
?>
<!-- wp:group {"tagName":"section","anchor":"listings","align":"full","style":{"spacing":{"padding":{"top":"7rem","bottom":"7rem","left":"2rem","right":"2rem"}}},"backgroundColor":"gray-50","layout":{"type":"constrained","contentSize":"720px"}} -->
<section id="listings" class="wp-block-group alignfull has-gray-50-background-color has-background" style="padding-top:7rem;padding-right:2rem;padding-bottom:7rem;padding-left:2rem">

	<!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center","flexWrap":"nowrap"},"style":{"spacing":{"blockGap":"0.625rem","margin":{"top":"0","bottom":"0"}}}} -->
	<div class="wp-block-group">
		<!-- wp:html -->
		<span aria-hidden="true" style="display:inline-flex;align-items:center;color:var(--wp--preset--color--primary)"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></span>
		<!-- /wp:html -->

		<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.25em","fontSize":"0.8125rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"gray-500"} -->
		<p class="has-gray-500-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.8125rem;font-weight:600;letter-spacing:0.25em;text-transform:uppercase">Dave's Listings</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:spacer {"height":"1rem"} -->
	<div style="height:1rem" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontWeight":"700"}}} -->
	<h2 class="wp-block-heading has-text-align-center" style="font-weight:700">My properties on the market</h2>
	<!-- /wp:heading -->

	<!-- wp:spacer {"height":"3rem"} -->
	<div style="height:3rem" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:html -->
	<style>
		.dmg-listings-wrap { max-width: 1280px; margin: 0 auto; }
		.dmg-listing-card {
			background: #fff;
			border: 1px solid var(--wp--preset--color--gray-100);
			display: flex;
			flex-direction: column;
			height: 100%;
			overflow: hidden;
		}
		.dmg-listing-photos { aspect-ratio: 3 / 2; background: var(--wp--preset--color--gray-100); }
		.dmg-listing-photos .splide__slide img { width: 100%; height: 100%; object-fit: cover; display: block; }
		.dmg-listing-photo-placeholder {
			aspect-ratio: 3 / 2;
			background: var(--wp--preset--color--gray-100);
			display: flex; flex-direction: column; align-items: center; justify-content: center;
			color: var(--wp--preset--color--gray-500);
			gap: 0.5rem;
		}
		.dmg-listing-photo-placeholder span { font-size: 0.8125rem; letter-spacing: 0.1em; text-transform: uppercase; }
		.dmg-listing-body { padding: 1.5rem 1.5rem 1.75rem; display: flex; flex-direction: column; gap: 0.5rem; }
		.dmg-listing-status {
			align-self: flex-start;
			font-size: 0.6875rem;
			font-weight: 700;
			letter-spacing: 0.18em;
			text-transform: uppercase;
			padding: 0.3rem 0.6rem;
			background: var(--wp--preset--color--gray-100);
			color: var(--wp--preset--color--gray-700);
		}
		.dmg-listing-status--active  { background: var(--wp--preset--color--primary); color: #fff; }
		.dmg-listing-status--pending { background: #f3e3a8; color: #6b4f00; }
		.dmg-listing-status--sold    { background: var(--wp--preset--color--gray-900); color: #fff; }
		.dmg-listing-address { font-size: 1.125rem; font-weight: 700; line-height: 1.3; margin: 0.25rem 0 0; letter-spacing: -0.005em; }
		.dmg-listing-price { font-size: 1.5rem; font-weight: 700; color: var(--wp--preset--color--primary); margin: 0; letter-spacing: -0.01em; }
		.dmg-listing-specs { list-style: none; padding: 0; margin: 0.5rem 0 0; display: grid; grid-template-columns: 1fr 1fr; gap: 0.35rem 1rem; font-size: 0.875rem; color: var(--wp--preset--color--gray-700); }
		.dmg-listing-specs li strong { color: var(--wp--preset--color--gray-900); margin-right: 0.25rem; font-weight: 700; }
		.dmg-listing-cta {
			display: inline-block;
			margin-top: 1.25rem;
			align-self: flex-start;
			font-size: 0.875rem;
			font-weight: 600;
			letter-spacing: 0.01em;
			padding: 0.75rem 1.25rem;
			background: var(--wp--preset--color--black);
			color: #fff;
			text-decoration: none;
			transition: background-color 0.15s ease;
		}
		.dmg-listing-cta:hover { background: var(--wp--preset--color--primary); color: #fff; }
		.dmg-listings-carousel .splide__arrow {
			background: var(--wp--preset--color--black);
			opacity: 1;
		}
		.dmg-listings-carousel .splide__arrow svg { fill: #fff; }
		.dmg-listings-carousel .splide__arrow:hover:not(:disabled) { background: var(--wp--preset--color--primary); }
		.dmg-listing-photos .splide__pagination__page.is-active { background: var(--wp--preset--color--primary); }
	</style>

	<?php if ( empty( $listings ) ) : ?>
		<p style="text-align:center;color:#737373;font-style:italic;max-width:560px;margin:0 auto">No listings yet - check back soon!</p>
	<?php else : ?>
		<div class="dmg-listings-wrap">
			<div class="splide dmg-listings-carousel" role="region" aria-label="Dave's Listings" data-per-page="<?php echo (int) $per_page; ?>">
				<div class="splide__track">
					<ul class="splide__list">
						<?php foreach ( $listings as $listing ) :
							$title       = get_the_title( $listing );
							$status      = get_post_meta( $listing->ID, 'dmg_status', true ) ?: 'active';
							$price       = get_post_meta( $listing->ID, 'dmg_price', true );
							$beds        = get_post_meta( $listing->ID, 'dmg_beds', true );
							$baths       = get_post_meta( $listing->ID, 'dmg_baths', true );
							$sqft        = get_post_meta( $listing->ID, 'dmg_sqft', true );
							$hoa         = get_post_meta( $listing->ID, 'dmg_hoa', true );
							$detail_url  = get_permalink( $listing->ID );
							$gallery_csv = get_post_meta( $listing->ID, 'dmg_gallery', true );
							$gallery_ids = $gallery_csv ? array_filter( array_map( 'absint', explode( ',', $gallery_csv ) ) ) : [];
							$thumb_id    = (int) get_post_thumbnail_id( $listing );
							if ( $thumb_id ) {
								array_unshift( $gallery_ids, $thumb_id );
								$gallery_ids = array_values( array_unique( $gallery_ids ) );
							}
						?>
						<li class="splide__slide">
							<article class="dmg-listing-card">
								<?php if ( $gallery_ids ) : ?>
									<div class="splide dmg-listing-photos" role="region" aria-label="Photos of <?php echo esc_attr( $title ); ?>">
										<div class="splide__track">
											<ul class="splide__list">
												<?php foreach ( $gallery_ids as $index => $id ) : ?>
													<li class="splide__slide">
														<?php echo wp_get_attachment_image( $id, 'large', false, [
															'class'   => 'dmg-listing-photo',
															'loading' => 'lazy',
															'alt'     => dmg_listing_photo_alt( $id, $listing->ID, $index + 1, 'home-card' ),
														] ); ?>
													</li>
												<?php endforeach; ?>
											</ul>
										</div>
									</div>
								<?php else : ?>
									<div class="dmg-listing-photo-placeholder">
										<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
										<span>Photo coming soon</span>
									</div>
								<?php endif; ?>

								<div class="dmg-listing-body">
									<span class="dmg-listing-status dmg-listing-status--<?php echo esc_attr( $status ); ?>"><?php echo esc_html( $status_label[ $status ] ?? 'Active' ); ?></span>
									<h3 class="dmg-listing-address"><?php echo esc_html( $title ); ?></h3>
									<p class="dmg-listing-price"><?php echo $price ? esc_html( $price ) : '-'; ?></p>
									<ul class="dmg-listing-specs">
										<li><strong><?php echo $beds ? esc_html( $beds ) : '-'; ?></strong> Beds</li>
										<li><strong><?php echo $baths ? esc_html( $baths ) : '-'; ?></strong> Baths</li>
										<li><strong><?php echo $sqft ? esc_html( $sqft ) : '-'; ?></strong> Sq Ft</li>
										<li><strong><?php echo $hoa ? esc_html( $hoa ) : '-'; ?></strong> HOA</li>
									</ul>
									<a class="dmg-listing-cta" href="<?php echo esc_url( $detail_url ); ?>">View Listing</a>
								</div>
							</article>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<!-- /wp:html -->

</section>
<!-- /wp:group -->

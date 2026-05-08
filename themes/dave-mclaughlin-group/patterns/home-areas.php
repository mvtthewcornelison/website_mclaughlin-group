<?php
/**
 * Title: Home Areas
 * Slug: dmg/home-areas
 * Categories: featured
 * Inserter: false
 */

$areas = [
	[ 'name' => 'Agoura Hills',     'slug' => 'agoura-hills' ],
	[ 'name' => 'Malibou Lake',     'slug' => 'malibou-lake' ],
	[ 'name' => 'Westlake Village', 'slug' => 'westlake-village' ],
	[ 'name' => 'Thousand Oaks',    'slug' => 'thousand-oaks' ],
	[ 'name' => 'Newbury Park',     'slug' => 'newbury-park' ],
	[ 'name' => 'Oak Park',         'slug' => 'oak-park' ],
	[ 'name' => 'Malibu',           'slug' => 'malibu' ],
	[ 'name' => 'Ventura',          'slug' => 'ventura' ],
];

$dmg_resolve_area_image = function ( $slug ) {
	foreach ( [ 'jpg', 'jpeg', 'png', 'webp' ] as $ext ) {
		$rel = "assets/images/neighborhoods/{$slug}.{$ext}";
		if ( file_exists( get_theme_file_path( $rel ) ) ) {
			return get_theme_file_uri( $rel );
		}
	}
	return '';
};
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"7rem","bottom":"7rem","left":"2rem","right":"2rem"}}},"backgroundColor":"gray-50","layout":{"type":"constrained","contentSize":"1280px"}} -->
<section class="wp-block-group alignfull has-gray-50-background-color has-background" style="padding-top:7rem;padding-right:2rem;padding-bottom:7rem;padding-left:2rem">

	<!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center","flexWrap":"nowrap"},"style":{"spacing":{"blockGap":"0.625rem","margin":{"top":"0","bottom":"0"}}}} -->
	<div class="wp-block-group">
		<!-- wp:html -->
		<span aria-hidden="true" style="display:inline-flex;align-items:center;color:var(--wp--preset--color--primary)"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg></span>
		<!-- /wp:html -->

		<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.25em","fontSize":"0.8125rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"gray-500"} -->
		<p class="has-gray-500-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.8125rem;font-weight:600;letter-spacing:0.25em;text-transform:uppercase">Service Areas</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:spacer {"height":"1rem"} -->
	<div style="height:1rem" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:heading {"textAlign":"center","level":2,"textColor":"gray-900","style":{"typography":{"fontWeight":"700","lineHeight":"1.1","letterSpacing":"-0.015em"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
	<h2 class="wp-block-heading has-text-align-center has-gray-900-color has-text-color" style="margin-top:0;margin-bottom:0;font-weight:700;letter-spacing:-0.015em;line-height:1.1">Where We Specialize</h2>
	<!-- /wp:heading -->

	<!-- wp:spacer {"height":"3.5rem"} -->
	<div style="height:3.5rem" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:html -->
	<div class="dmg-areas-grid">
		<?php foreach ( $areas as $area ) :
			$image_url = $dmg_resolve_area_image( $area['slug'] );
			$has_image = (bool) $image_url;
		?>
			<a class="dmg-area-tile<?php echo $has_image ? '' : ' dmg-area-tile--placeholder'; ?>" href="<?php echo esc_url( '/areas/' . $area['slug'] . '/' ); ?>" aria-label="<?php echo esc_attr( $area['name'] ); ?>">
				<?php if ( $has_image ) : ?>
					<span class="dmg-area-image" style="background-image:url('<?php echo esc_url( $image_url ); ?>')" aria-hidden="true"></span>
				<?php endif; ?>
				<span class="dmg-area-name"><?php echo esc_html( $area['name'] ); ?></span>
				<span class="dmg-area-arrow" aria-hidden="true">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
				</span>
			</a>
		<?php endforeach; ?>
	</div>
	<!-- /wp:html -->

</section>
<!-- /wp:group -->

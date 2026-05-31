<?php
/**
 * Title: Communities Hub
 * Slug: dmg/communities-hub
 * Categories: featured
 * Inserter: false
 */

$communities = [
	[ 'name' => 'Agoura Hills',     'slug' => 'agoura-hills',     'area_slug' => 'agoura-hills' ],
	[ 'name' => 'Malibou Lake',     'slug' => 'malibou-lake',     'area_slug' => 'malibou-lake' ],
	[ 'name' => 'Westlake Village', 'slug' => 'westlake-village', 'area_slug' => 'westlake-village' ],
	[ 'name' => 'Thousand Oaks',    'slug' => 'thousand-oaks',    'area_slug' => 'thousand-oaks' ],
	[ 'name' => 'Newbury Park',     'slug' => 'newbury-park',     'area_slug' => 'newbury-park' ],
	[ 'name' => 'Oak Park',         'slug' => 'oak-park',         'area_slug' => 'oak-park' ],
	[ 'name' => 'Malibu',           'slug' => 'malibu',           'area_slug' => 'malibu' ],
	[ 'name' => 'Ventura',          'slug' => 'ventura',          'area_slug' => 'ventura' ],
];

$resolve_image = function ( $slug ) {
	foreach ( [ 'jpg', 'jpeg', 'png', 'webp' ] as $ext ) {
		$rel = "assets/images/neighborhoods/{$slug}.{$ext}";
		if ( file_exists( get_theme_file_path( $rel ) ) ) {
			return get_theme_file_uri( $rel );
		}
	}
	return '';
};
?>

<!-- wp:html -->
<section class="dmg-area-section" style="padding-top:5rem;padding-bottom:5rem">
	<div class="dmg-area-section-inner dmg-area-section-inner--wide">

		<div class="dmg-area-eyebrow-row">
			<span class="dmg-area-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
			</span>
			<p class="dmg-area-eyebrow-label">Service Areas</p>
		</div>

		<h1 class="dmg-area-section-title" style="margin-bottom:0.75rem">Communities We Serve</h1>
		<p style="font-size:1.0625rem;color:var(--wp--preset--color--gray-700);max-width:640px;margin:0 0 3.5rem">The McLaughlin Group specializes in the Conejo Valley and surrounding communities. Select a city to browse active MLS listings or read our neighborhood guide.</p>

		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:2rem">
			<?php foreach ( $communities as $c ) :
				$img = $resolve_image( $c['slug'] );
			?>
			<div style="border:1px solid var(--wp--preset--color--gray-100);background:#fff;overflow:hidden">
				<?php if ( $img ) : ?>
					<div style="aspect-ratio:16/9;background-image:url('<?php echo esc_url( $img ); ?>');background-size:cover;background-position:center" aria-hidden="true"></div>
				<?php else : ?>
					<div class="dmg-area-image-placeholder" style="aspect-ratio:16/9" aria-hidden="true"></div>
				<?php endif; ?>

				<div style="padding:1.5rem">
					<h2 style="font-size:1.25rem;font-weight:700;margin:0 0 1rem;letter-spacing:-0.01em"><?php echo esc_html( $c['name'] ); ?></h2>
					<div style="display:flex;gap:0.75rem;flex-wrap:wrap">
						<a class="dmg-btn-primary" href="<?php echo esc_url( '/' . $c['slug'] . '-homes-for-sale/' ); ?>" style="font-size:0.875rem">
							Browse Listings
						</a>
						<a class="dmg-btn-secondary" href="<?php echo esc_url( '/areas/' . $c['area_slug'] . '/' ); ?>" style="font-size:0.875rem">
							Community Guide
						</a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
<!-- /wp:html -->

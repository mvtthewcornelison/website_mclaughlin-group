<?php
/**
 * Title: Listing Detail
 * Slug: dmg/listing-detail
 * Categories: featured
 * Inserter: false
 */

$post         = get_queried_object();
$post_id      = $post ? $post->ID : 0;

$price        = get_post_meta( $post_id, 'dmg_price', true );
$beds         = get_post_meta( $post_id, 'dmg_beds', true );
$baths        = get_post_meta( $post_id, 'dmg_baths', true );
$sqft         = get_post_meta( $post_id, 'dmg_sqft', true );
$hoa          = get_post_meta( $post_id, 'dmg_hoa', true );
$status       = get_post_meta( $post_id, 'dmg_status', true ) ?: 'active';
$garage       = get_post_meta( $post_id, 'dmg_garage', true );
$lot_size     = get_post_meta( $post_id, 'dmg_lot_size', true );
$open_house   = get_post_meta( $post_id, 'dmg_open_house', true );
$description  = get_post_meta( $post_id, 'dmg_description', true );
$neighborhood = get_post_meta( $post_id, 'dmg_neighborhood', true );
$gallery_raw  = get_post_meta( $post_id, 'dmg_gallery', true );
$gallery_ids  = $gallery_raw ? array_filter( array_map( 'absint', explode( ',', $gallery_raw ) ) ) : [];

// Hero: first gallery image, fall back to featured image.
$hero_id = ! empty( $gallery_ids ) ? reset( $gallery_ids ) : get_post_thumbnail_id( $post_id );
$hero_url = $hero_id ? wp_get_attachment_image_url( $hero_id, 'full' ) : '';

// Gallery carousel: all gallery images (skip first only if it's already used as hero and there's more than one).
$carousel_ids = $gallery_ids;

// Neighborhood name map (matches dmg-areas.php).
$area_names = [
	'agoura-hills'     => 'Agoura Hills',
	'malibou-lake'     => 'Malibou Lake',
	'westlake-village' => 'Westlake Village',
	'thousand-oaks'    => 'Thousand Oaks',
	'newbury-park'     => 'Newbury Park',
	'oak-park'         => 'Oak Park',
	'malibu'           => 'Malibu',
	'ventura'          => 'Ventura',
];

// Form state.
$name_value    = dmg_contact_field_value( 'dmg_name' );
$email_value   = dmg_contact_field_value( 'dmg_email' );
$phone_value   = dmg_contact_field_value( 'dmg_phone' );
$message_value = dmg_contact_field_value( 'dmg_message' );
$success       = isset( $_GET['dmg_contact_success'] );
$error         = isset( $_GET['dmg_contact_error'] );

// Status badge colors.
$status_colors = [
	'active'  => [ 'bg' => '#e6f4ec', 'color' => '#1f6b3a', 'label' => 'Active' ],
	'pending' => [ 'bg' => '#fff4e5', 'color' => '#8a5c00', 'label' => 'Pending' ],
	'sold'    => [ 'bg' => '#f0f0f0', 'color' => '#555555', 'label' => 'Sold' ],
];
$badge = $status_colors[ $status ] ?? $status_colors['active'];
?>

<!-- wp:html -->
<style>
	/* ── Listing Detail ────────────────────────────────────────────────────── */
	.dmg-listing-detail { font-family: inherit; color: #1A1A1A; }

	/* Hero */
	.dmg-listing-hero {
		position: relative;
		width: 100%;
		height: 60vh;
		min-height: 320px;
		background: #e0e0e0;
		overflow: hidden;
	}
	.dmg-listing-hero img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		display: block;
	}
	.dmg-listing-hero-overlay {
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		padding: 2rem 2.5rem;
		background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, transparent 100%);
	}
	.dmg-listing-hero-address {
		margin: 0;
		font-size: clamp(1.25rem, 3vw, 2rem);
		font-weight: 700;
		color: #fff;
		line-height: 1.2;
		letter-spacing: -0.01em;
	}

	/* Main content wrapper */
	.dmg-listing-content {
		max-width: 1280px;
		margin: 0 auto;
		padding: 2rem 2rem 5rem;
	}

	/* Back link */
	.dmg-listing-back {
		display: inline-block;
		font-size: 0.875rem;
		color: #666;
		text-decoration: none;
		margin-bottom: 2rem;
		transition: color 0.15s ease;
	}
	.dmg-listing-back:hover { color: #B20000; }

	/* Gallery carousel */
	.dmg-listing-gallery {
		margin-bottom: 2.5rem;
	}
	.dmg-listing-gallery .splide__slide img {
		width: 100%;
		height: 480px;
		object-fit: cover;
		display: block;
	}
	@media (max-width: 768px) {
		.dmg-listing-gallery .splide__slide img { height: 280px; }
	}

	/* Details bar */
	.dmg-listing-details-bar {
		display: flex;
		flex-wrap: wrap;
		gap: 1rem;
		align-items: flex-start;
		margin-bottom: 2rem;
		padding: 1.5rem;
		background: #FAFAFA;
		border: 1px solid #e8e8e8;
	}
	.dmg-listing-detail-cell {
		display: flex;
		flex-direction: column;
		align-items: center;
		text-align: center;
		min-width: 80px;
		padding: 0.5rem 0.75rem;
	}
	.dmg-listing-detail-label {
		font-size: 0.6875rem;
		font-weight: 700;
		letter-spacing: 0.15em;
		text-transform: uppercase;
		color: #888;
		margin-bottom: 0.35rem;
	}
	.dmg-listing-detail-value {
		font-size: 1.0625rem;
		font-weight: 600;
		color: #1A1A1A;
	}
	.dmg-listing-status-badge {
		display: inline-block;
		padding: 0.2em 0.75em;
		font-size: 0.75rem;
		font-weight: 700;
		letter-spacing: 0.08em;
		text-transform: uppercase;
		border-radius: 999px;
		margin-left: auto;
		align-self: center;
	}

	/* Open house notice */
	.dmg-listing-open-house {
		border-left: 4px solid #B20000;
		background: #fdf6f6;
		padding: 1rem 1.25rem;
		margin-bottom: 2rem;
		font-size: 0.9375rem;
		color: #1A1A1A;
	}
	.dmg-listing-open-house strong { color: #B20000; }

	/* Description */
	.dmg-listing-description {
		margin-bottom: 2.5rem;
	}
	.dmg-listing-description h2 {
		font-size: 1.125rem;
		font-weight: 700;
		margin: 0 0 0.75rem;
	}
	.dmg-listing-description p {
		line-height: 1.75;
		color: #444;
		margin: 0;
	}

	/* Neighborhood link */
	.dmg-listing-neighborhood {
		margin-bottom: 2.5rem;
		font-size: 0.9375rem;
		color: #555;
	}
	.dmg-listing-neighborhood a {
		color: #B20000;
		text-decoration: none;
		border-bottom: 1px solid rgba(178,0,0,0.3);
		transition: border-color 0.15s ease;
	}
	.dmg-listing-neighborhood a:hover { border-color: #B20000; }

	/* Inquiry form */
	.dmg-listing-inquiry {
		max-width: 600px;
		margin-bottom: 3rem;
	}
	.dmg-listing-inquiry h2 {
		font-size: 1.375rem;
		font-weight: 700;
		margin: 0 0 1.5rem;
	}
	.dmg-listing-form { display: grid; gap: 1.25rem; }
	.dmg-listing-form-row {
		display: grid;
		grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: 1.25rem;
	}
	.dmg-listing-field { display: flex; flex-direction: column; gap: 0.45rem; }
	.dmg-listing-field label {
		font-size: 0.875rem;
		font-weight: 500;
		color: #555;
	}
	.dmg-listing-field label .req { color: #B20000; margin-left: 0.15rem; }
	.dmg-listing-field input,
	.dmg-listing-field textarea {
		width: 100%;
		border: 1px solid transparent;
		background: #FAFAFA;
		padding: 0.95rem 1.1rem;
		font: inherit;
		font-size: 1rem;
		color: #1A1A1A;
		transition: background 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
		box-sizing: border-box;
	}
	.dmg-listing-field input::placeholder,
	.dmg-listing-field textarea::placeholder { color: #aaa; }
	.dmg-listing-field input:hover,
	.dmg-listing-field textarea:hover { background: #f0f0f0; }
	.dmg-listing-field input:focus,
	.dmg-listing-field textarea:focus {
		outline: none;
		background: #fff;
		border-color: #B20000;
		box-shadow: 0 0 0 3px rgba(178,0,0,0.12);
	}
	.dmg-listing-field textarea { min-height: 140px; resize: vertical; }
	.dmg-listing-submit {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		border: 0;
		cursor: pointer;
		padding: 1rem 2rem;
		background: #B20000;
		color: #fff;
		font-weight: 600;
		font-size: 0.9375rem;
		letter-spacing: 0.01em;
		text-decoration: none;
		transition: background 0.15s ease, transform 0.15s ease, box-shadow 0.15s ease;
	}
	.dmg-listing-submit:hover {
		background: #8c0000;
		transform: translateY(-1px);
		box-shadow: 0 6px 18px -8px rgba(178,0,0,0.5);
	}
	.dmg-listing-alert {
		padding: 1rem 1.25rem;
		margin: 0 0 1.5rem;
		border-left: 3px solid;
		font-size: 0.9375rem;
	}
	.dmg-listing-alert--success { background: #f4faf6; border-color: #3b8a5a; color: #1f5c38; }
	.dmg-listing-alert--error   { background: #fdf6f6; border-color: #B20000; color: #8c1f1f; }

	@media (max-width: 600px) {
		.dmg-listing-content { padding: 1.5rem 1.25rem 4rem; }
		.dmg-listing-form-row { grid-template-columns: 1fr; }
		.dmg-listing-submit { width: 100%; }
		.dmg-listing-hero-overlay { padding: 1.25rem; }
		.dmg-listing-details-bar { padding: 1rem; }
	}
</style>
<!-- /wp:html -->

<!-- wp:html -->
<div class="dmg-listing-detail">

	<?php /* ── 1. HERO IMAGE ── */ ?>
	<div class="dmg-listing-hero">
		<?php if ( $hero_url ) : ?>
			<img src="<?php echo esc_url( $hero_url ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>" loading="eager" />
		<?php endif; ?>
		<div class="dmg-listing-hero-overlay">
			<p class="dmg-listing-hero-address"><?php echo esc_html( get_the_title( $post_id ) ); ?></p>
		</div>
	</div>

	<?php /* ── 2. MAIN CONTENT ── */ ?>
	<div class="dmg-listing-content">

		<?php /* 2g. Back link (top of content area) */ ?>
		<a href="<?php echo esc_url( home_url( '/listings/' ) ); ?>" class="dmg-listing-back">&larr; Back to listings</a>

		<?php /* 2a. PHOTO GALLERY CAROUSEL - only if 2+ gallery images */ ?>
		<?php if ( count( $carousel_ids ) >= 2 ) : ?>
			<div class="dmg-listing-gallery splide" aria-label="<?php echo esc_attr( get_the_title( $post_id ) ); ?> photos">
				<div class="splide__track">
					<ul class="splide__list">
						<?php foreach ( $carousel_ids as $img_id ) : ?>
							<li class="splide__slide">
								<?php echo wp_get_attachment_image( $img_id, 'large', false, [ 'loading' => 'lazy' ] ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		<?php endif; ?>

		<?php /* 2b. KEY DETAILS BAR */ ?>
		<div class="dmg-listing-details-bar">
			<?php if ( $price ) : ?>
				<div class="dmg-listing-detail-cell">
					<span class="dmg-listing-detail-label">Price</span>
					<span class="dmg-listing-detail-value"><?php echo esc_html( $price ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( $beds ) : ?>
				<div class="dmg-listing-detail-cell">
					<span class="dmg-listing-detail-label">Beds</span>
					<span class="dmg-listing-detail-value"><?php echo esc_html( $beds ); ?> bd</span>
				</div>
			<?php endif; ?>

			<?php if ( $baths ) : ?>
				<div class="dmg-listing-detail-cell">
					<span class="dmg-listing-detail-label">Baths</span>
					<span class="dmg-listing-detail-value"><?php echo esc_html( $baths ); ?> ba</span>
				</div>
			<?php endif; ?>

			<?php if ( $sqft ) : ?>
				<div class="dmg-listing-detail-cell">
					<span class="dmg-listing-detail-label">Sq Ft</span>
					<span class="dmg-listing-detail-value"><?php echo esc_html( $sqft ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( $garage ) : ?>
				<div class="dmg-listing-detail-cell">
					<span class="dmg-listing-detail-label">Garage</span>
					<span class="dmg-listing-detail-value"><?php echo esc_html( $garage ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( $lot_size ) : ?>
				<div class="dmg-listing-detail-cell">
					<span class="dmg-listing-detail-label">Lot</span>
					<span class="dmg-listing-detail-value"><?php echo esc_html( $lot_size ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( $hoa && $hoa !== '0' ) : ?>
				<div class="dmg-listing-detail-cell">
					<span class="dmg-listing-detail-label">HOA</span>
					<span class="dmg-listing-detail-value"><?php echo esc_html( $hoa ); ?>/mo</span>
				</div>
			<?php endif; ?>

			<span
				class="dmg-listing-status-badge"
				style="background:<?php echo esc_attr( $badge['bg'] ); ?>;color:<?php echo esc_attr( $badge['color'] ); ?>;"
			><?php echo esc_html( $badge['label'] ); ?></span>
		</div>

		<?php /* 2c. OPEN HOUSE NOTICE */ ?>
		<?php if ( $open_house ) : ?>
			<div class="dmg-listing-open-house">
				<strong>Open House:</strong> <?php echo esc_html( $open_house ); ?>
			</div>
		<?php endif; ?>

		<?php /* 2d. PROPERTY DESCRIPTION */ ?>
		<?php if ( $description ) : ?>
			<div class="dmg-listing-description">
				<h2>About this property</h2>
				<p><?php echo nl2br( esc_html( $description ) ); ?></p>
			</div>
		<?php endif; ?>

		<?php /* 2e. NEIGHBORHOOD LINK */ ?>
		<?php if ( $neighborhood && isset( $area_names[ $neighborhood ] ) ) : ?>
			<p class="dmg-listing-neighborhood">
				Located in <a href="/areas/<?php echo esc_attr( $neighborhood ); ?>/"><?php echo esc_html( $area_names[ $neighborhood ] ); ?></a>
			</p>
		<?php endif; ?>

		<?php /* 2f. INQUIRY FORM */ ?>
		<div class="dmg-listing-inquiry">
			<h2>Interested in this property?</h2>

			<?php if ( $success ) : ?>
				<div class="dmg-listing-alert dmg-listing-alert--success">Thanks - your message has been sent. We&rsquo;ll be in touch soon.</div>
			<?php endif; ?>
			<?php if ( $error ) : ?>
				<div class="dmg-listing-alert dmg-listing-alert--error">Please fill out all required fields before sending your message.</div>
			<?php endif; ?>

			<form class="dmg-listing-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="dmg_contact_submit" />
				<input type="hidden" name="dmg_source" value="listing-inquiry" />
				<input type="hidden" name="dmg_source_page" value="<?php echo esc_attr( get_permalink( $post_id ) ); ?>" />
				<input type="hidden" name="dmg_subject" value="<?php echo esc_attr( 'Inquiry: ' . get_the_title( $post_id ) ); ?>" />
				<?php wp_nonce_field( 'dmg_contact_submit', 'dmg_contact_nonce' ); ?>

				<div class="dmg-listing-form-row">
					<div class="dmg-listing-field">
						<label for="dmg_ld_name">Name<span class="req" aria-hidden="true">*</span></label>
						<input id="dmg_ld_name" name="dmg_name" type="text" required placeholder="Your name" value="<?php echo esc_attr( $name_value ); ?>" />
					</div>
					<div class="dmg-listing-field">
						<label for="dmg_ld_email">Email<span class="req" aria-hidden="true">*</span></label>
						<input id="dmg_ld_email" name="dmg_email" type="email" required placeholder="you@example.com" value="<?php echo esc_attr( $email_value ); ?>" />
					</div>
				</div>

				<div class="dmg-listing-field">
					<label for="dmg_ld_phone">Phone<span class="req" aria-hidden="true">*</span></label>
					<input id="dmg_ld_phone" name="dmg_phone" type="tel" required placeholder="(555) 555-5555" value="<?php echo esc_attr( $phone_value ); ?>" />
				</div>

				<div class="dmg-listing-field">
					<label for="dmg_ld_message">Message<span class="req" aria-hidden="true">*</span></label>
					<textarea id="dmg_ld_message" name="dmg_message" required placeholder="I&rsquo;d love to learn more about this property&hellip;"><?php echo esc_textarea( $message_value ); ?></textarea>
				</div>

				<div>
					<button class="dmg-listing-submit" type="submit">Send Inquiry</button>
				</div>
			</form>
		</div>

	</div><!-- .dmg-listing-content -->
</div><!-- .dmg-listing-detail -->
<!-- /wp:html -->

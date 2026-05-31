<?php
/**
 * Plugin Name: The McLaughlin Group - Listings
 * Description: Custom post type and admin UI for real-estate listings (Featured Listings carousel).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ---------------------------------------------------------------------------
// CPT
// ---------------------------------------------------------------------------
add_action( 'init', function () {
	register_post_type( 'dmg_listing', [
		'labels' => [
			'name'          => 'Listings',
			'singular_name' => 'Listing',
			'add_new'       => 'Add Listing',
			'add_new_item'  => 'Add New Listing',
			'edit_item'     => 'Edit Listing',
			'new_item'      => 'New Listing',
			'view_item'     => 'View Listing',
			'search_items'  => 'Search Listings',
			'not_found'     => 'No listings found',
			'menu_name'     => 'Listings',
			'all_items'     => 'All Listings',
		],
		'public'       => true,
		'show_ui'      => true,
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon'    => 'dashicons-admin-home',
		'show_in_rest' => true,
		'has_archive'  => false,
		'rewrite'      => [ 'slug' => 'listings', 'with_front' => false ],
		'supports'     => [ 'title', 'thumbnail', 'page-attributes' ],
	] );
} );

// ---------------------------------------------------------------------------
// Meta registration (so REST + block editor can read/write these)
// ---------------------------------------------------------------------------
add_action( 'init', function () {
	$meta = [
		'dmg_price'      => 'sanitize_text_field',
		'dmg_beds'       => 'sanitize_text_field',
		'dmg_baths'      => 'sanitize_text_field',
		'dmg_sqft'       => 'sanitize_text_field',
		'dmg_hoa'        => 'sanitize_text_field',
		'dmg_status'     => 'sanitize_text_field',
		'dmg_zillow_url'   => 'esc_url_raw',
		'dmg_kw_url'       => 'esc_url_raw',
		'dmg_gallery'      => 'sanitize_text_field',
		'dmg_neighborhood' => 'sanitize_text_field',
		'dmg_description'  => 'sanitize_textarea_field',
		'dmg_garage'       => 'sanitize_text_field',
		'dmg_lot_size'     => 'sanitize_text_field',
		'dmg_open_house'   => 'sanitize_text_field',
	];
	foreach ( $meta as $key => $sanitize ) {
		register_post_meta( 'dmg_listing', $key, [
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => $sanitize,
			'auth_callback'     => function () { return current_user_can( 'edit_posts' ); },
		] );
	}

	register_post_meta( 'dmg_listing', 'dmg_featured', [
		'type'              => 'boolean',
		'single'            => true,
		'show_in_rest'      => true,
		'sanitize_callback' => 'rest_sanitize_boolean',
		'auth_callback'     => function () { return current_user_can( 'edit_posts' ); },
	] );
} );

// ---------------------------------------------------------------------------
// Admin meta box
// ---------------------------------------------------------------------------
add_action( 'add_meta_boxes', function () {
	add_meta_box(
		'dmg_listing_details',
		'Listing Details',
		'dmg_listing_render_meta_box',
		'dmg_listing',
		'normal',
		'high'
	);
} );

function dmg_listing_render_meta_box( $post ) {
	wp_nonce_field( 'dmg_listing_save', 'dmg_listing_nonce' );

	$price      = get_post_meta( $post->ID, 'dmg_price', true );
	$beds       = get_post_meta( $post->ID, 'dmg_beds', true );
	$baths      = get_post_meta( $post->ID, 'dmg_baths', true );
	$sqft       = get_post_meta( $post->ID, 'dmg_sqft', true );
	$hoa        = get_post_meta( $post->ID, 'dmg_hoa', true );
	$status     = get_post_meta( $post->ID, 'dmg_status', true ) ?: 'active';
	$zillow_url   = get_post_meta( $post->ID, 'dmg_zillow_url', true );
	$kw_url       = get_post_meta( $post->ID, 'dmg_kw_url', true );
	$gallery      = get_post_meta( $post->ID, 'dmg_gallery', true );
	$neighborhood = get_post_meta( $post->ID, 'dmg_neighborhood', true );
	$description  = get_post_meta( $post->ID, 'dmg_description', true );
	$garage       = get_post_meta( $post->ID, 'dmg_garage', true );
	$lot_size     = get_post_meta( $post->ID, 'dmg_lot_size', true );
	$open_house   = get_post_meta( $post->ID, 'dmg_open_house', true );
	$featured     = (bool) get_post_meta( $post->ID, 'dmg_featured', true );

	$dmg_areas = [
		''                 => 'Not assigned',
		'agoura-hills'     => 'Agoura Hills',
		'malibou-lake'     => 'Malibou Lake',
		'westlake-village' => 'Westlake Village',
		'thousand-oaks'    => 'Thousand Oaks',
		'newbury-park'     => 'Newbury Park',
		'oak-park'         => 'Oak Park',
		'malibu'           => 'Malibu',
		'ventura'          => 'Ventura',
	];
	?>
	<style>
		.dmg-listing-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem 1.5rem; max-width: 760px; }
		.dmg-listing-grid p { margin: 0 0 0.4rem 0; }
		.dmg-listing-grid input[type="text"], .dmg-listing-grid select, .dmg-listing-grid textarea { width: 100%; }
		.dmg-listing-grid textarea { min-height: 100px; resize: vertical; }
		.dmg-listing-row { grid-column: 1 / -1; }
		.dmg-gallery-list { padding: 0.75rem; background: #f6f7f7; border: 1px solid #dcdcde; min-height: 96px; }
		.dmg-gallery-list img { display: inline-block; vertical-align: top; margin: 0 6px 6px 0; height: 80px; width: 80px; object-fit: cover; border: 1px solid #dcdcde; }
		.dmg-gallery-list:empty::before { content: "No gallery images selected."; color: #757575; font-style: italic; }
	</style>
	<div class="dmg-listing-grid">

		<div>
			<p><label for="dmg_price"><strong>Price</strong></label></p>
			<input type="text" id="dmg_price" name="dmg_price" value="<?php echo esc_attr( $price ); ?>" placeholder="$1,250,000" />
		</div>

		<div>
			<p><label for="dmg_status"><strong>Status</strong></label></p>
			<select id="dmg_status" name="dmg_status">
				<option value="active"  <?php selected( $status, 'active' ); ?>>Active</option>
				<option value="pending" <?php selected( $status, 'pending' ); ?>>Pending</option>
				<option value="sold"    <?php selected( $status, 'sold' ); ?>>Sold</option>
			</select>
		</div>

		<div>
			<p><label for="dmg_beds"><strong>Beds</strong></label></p>
			<input type="text" id="dmg_beds" name="dmg_beds" value="<?php echo esc_attr( $beds ); ?>" placeholder="3" />
		</div>

		<div>
			<p><label for="dmg_baths"><strong>Baths</strong></label></p>
			<input type="text" id="dmg_baths" name="dmg_baths" value="<?php echo esc_attr( $baths ); ?>" placeholder="2.5" />
		</div>

		<div>
			<p><label for="dmg_sqft"><strong>Square Feet</strong></label></p>
			<input type="text" id="dmg_sqft" name="dmg_sqft" value="<?php echo esc_attr( $sqft ); ?>" placeholder="1,800" />
		</div>

		<div>
			<p><label for="dmg_hoa"><strong>HOA</strong></label></p>
			<input type="text" id="dmg_hoa" name="dmg_hoa" value="<?php echo esc_attr( $hoa ); ?>" placeholder="$250/mo or None" />
		</div>

		<div class="dmg-listing-row">
			<p><label for="dmg_neighborhood"><strong>Neighborhood</strong> <em>- assigns this listing to the matching community page</em></label></p>
			<select id="dmg_neighborhood" name="dmg_neighborhood">
				<?php foreach ( $dmg_areas as $slug => $label ) : ?>
					<option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $neighborhood, $slug ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="dmg-listing-row">
			<p><label for="dmg_kw_url"><strong>Keller Williams URL</strong> <em>- saved for reference; site listing cards link to the native listing page</em></label></p>
			<input type="text" id="dmg_kw_url" name="dmg_kw_url" value="<?php echo esc_attr( $kw_url ); ?>" placeholder="https://www.kw.com/property/..." />
		</div>

		<div class="dmg-listing-row">
			<p><label for="dmg_zillow_url"><strong>Zillow URL</strong></label></p>
			<input type="text" id="dmg_zillow_url" name="dmg_zillow_url" value="<?php echo esc_attr( $zillow_url ); ?>" placeholder="https://www.zillow.com/homedetails/..." />
		</div>

		<div class="dmg-listing-row">
			<p><strong>Photo Gallery</strong> <em>- in addition to the Featured Image; reorder by re-selecting in your preferred order</em></p>
			<input type="hidden" id="dmg_gallery" name="dmg_gallery" value="<?php echo esc_attr( $gallery ); ?>" />
			<p>
				<button type="button" class="button" id="dmg_gallery_choose">Choose / Edit Gallery</button>
				<button type="button" class="button-link" id="dmg_gallery_clear">Clear gallery</button>
			</p>
			<div id="dmg_gallery_preview" class="dmg-gallery-list">
				<?php
				if ( $gallery ) {
					$ids = array_filter( array_map( 'absint', explode( ',', $gallery ) ) );
					foreach ( $ids as $id ) {
						echo wp_get_attachment_image( $id, [ 80, 80 ] );
					}
				}
				?>
			</div>
		</div>

		<div class="dmg-listing-row">
			<p><label for="dmg_description"><strong>Description</strong></label></p>
			<textarea id="dmg_description" name="dmg_description"><?php echo esc_textarea( $description ); ?></textarea>
		</div>

		<div>
			<p><label for="dmg_garage"><strong>Garage</strong></label></p>
			<input type="text" id="dmg_garage" name="dmg_garage" value="<?php echo esc_attr( $garage ); ?>" placeholder="2-car attached" />
		</div>

		<div>
			<p><label for="dmg_lot_size"><strong>Lot Size</strong></label></p>
			<input type="text" id="dmg_lot_size" name="dmg_lot_size" value="<?php echo esc_attr( $lot_size ); ?>" placeholder="7,500 sq ft" />
		</div>

		<div class="dmg-listing-row">
			<p><label for="dmg_open_house"><strong>Open House</strong></label></p>
			<input type="text" id="dmg_open_house" name="dmg_open_house" value="<?php echo esc_attr( $open_house ); ?>" placeholder="e.g. Sun June 1, 1–4pm" />
		</div>

		<div class="dmg-listing-row">
			<label>
				<input type="checkbox" name="dmg_featured" value="1" <?php checked( $featured ); ?> />
				<strong>Featured on Homepage</strong> - Show in homepage Featured Listings carousel
			</label>
		</div>

	</div>

	<script>
	(function($){
		var frame;
		$('#dmg_gallery_choose').on('click', function(e){
			e.preventDefault();
			var current = $('#dmg_gallery').val();
			var ids = current ? current.split(',').map(function(x){return parseInt(x,10);}).filter(Boolean) : [];

			frame = wp.media({
				title: 'Select listing photos (selection order = display order)',
				multiple: 'add',
				library: { type: 'image' },
				button: { text: 'Use selected photos' }
			});

			frame.on('open', function(){
				var selection = frame.state().get('selection');
				ids.forEach(function(id){
					var attachment = wp.media.attachment(id);
					attachment.fetch();
					selection.add(attachment ? [attachment] : []);
				});
			});

			frame.on('select', function(){
				var selection = frame.state().get('selection').toJSON();
				var newIds = selection.map(function(a){ return a.id; });
				$('#dmg_gallery').val(newIds.join(','));
				var $preview = $('#dmg_gallery_preview').empty();
				selection.forEach(function(a){
					var url = (a.sizes && a.sizes.thumbnail) ? a.sizes.thumbnail.url : a.url;
					$preview.append($('<img>').attr({src: url, width: 80, height: 80}));
				});
			});

			frame.open();
		});

		$('#dmg_gallery_clear').on('click', function(e){
			e.preventDefault();
			$('#dmg_gallery').val('');
			$('#dmg_gallery_preview').empty();
		});
	})(jQuery);
	</script>
	<?php
}

// ---------------------------------------------------------------------------
// Save meta
// ---------------------------------------------------------------------------
add_action( 'save_post_dmg_listing', function ( $post_id ) {
	if ( ! isset( $_POST['dmg_listing_nonce'] ) || ! wp_verify_nonce( $_POST['dmg_listing_nonce'], 'dmg_listing_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = [
		'dmg_price'        => 'sanitize_text_field',
		'dmg_beds'         => 'sanitize_text_field',
		'dmg_baths'        => 'sanitize_text_field',
		'dmg_sqft'         => 'sanitize_text_field',
		'dmg_hoa'          => 'sanitize_text_field',
		'dmg_status'       => 'sanitize_text_field',
		'dmg_zillow_url'   => 'esc_url_raw',
		'dmg_kw_url'       => 'esc_url_raw',
		'dmg_neighborhood' => 'sanitize_text_field',
		'dmg_description'  => 'sanitize_textarea_field',
		'dmg_garage'       => 'sanitize_text_field',
		'dmg_lot_size'     => 'sanitize_text_field',
		'dmg_open_house'   => 'sanitize_text_field',
	];

	foreach ( $fields as $key => $sanitize ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, call_user_func( $sanitize, wp_unslash( $_POST[ $key ] ) ) );
		}
	}

	if ( isset( $_POST['dmg_gallery'] ) ) {
		$ids = array_filter( array_map( 'absint', explode( ',', wp_unslash( $_POST['dmg_gallery'] ) ) ) );
		update_post_meta( $post_id, 'dmg_gallery', implode( ',', $ids ) );
	}

	// dmg_featured is a checkbox - only present in POST when checked.
	update_post_meta( $post_id, 'dmg_featured', rest_sanitize_boolean( isset( $_POST['dmg_featured'] ) ) );
} );

// ---------------------------------------------------------------------------
// Make sure media library JS is on the listing edit screen
// ---------------------------------------------------------------------------
add_action( 'admin_enqueue_scripts', function ( $hook ) {
	global $post;
	if ( in_array( $hook, [ 'post.php', 'post-new.php' ], true ) && $post && $post->post_type === 'dmg_listing' ) {
		wp_enqueue_media();
	}
} );

// ---------------------------------------------------------------------------
// Admin list table columns
// ---------------------------------------------------------------------------
add_filter( 'manage_dmg_listing_posts_columns', function ( $columns ) {
	$new = [];
	foreach ( $columns as $key => $label ) {
		$new[ $key ] = $label;
		if ( $key === 'title' ) {
			$new['dmg_status'] = 'Status';
			$new['dmg_price']  = 'Price';
			$new['dmg_bb']     = 'Beds / Baths';
		}
	}
	$new['menu_order'] = 'Order';
	return $new;
} );

add_action( 'manage_dmg_listing_posts_custom_column', function ( $column, $post_id ) {
	switch ( $column ) {
		case 'dmg_status':
			$s = get_post_meta( $post_id, 'dmg_status', true );
			echo $s ? esc_html( ucfirst( $s ) ) : '-';
			break;
		case 'dmg_price':
			echo esc_html( get_post_meta( $post_id, 'dmg_price', true ) ?: '-' );
			break;
		case 'dmg_bb':
			$b  = get_post_meta( $post_id, 'dmg_beds', true );
			$ba = get_post_meta( $post_id, 'dmg_baths', true );
			echo esc_html( ( $b ?: '-' ) . ' / ' . ( $ba ?: '-' ) );
			break;
		case 'menu_order':
			$p = get_post( $post_id );
			echo (int) $p->menu_order;
			break;
	}
}, 10, 2 );

// ---------------------------------------------------------------------------
// Front-end helper
// ---------------------------------------------------------------------------
function dmg_get_listings() {
	return get_posts( [
		'post_type'      => 'dmg_listing',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => [ 'menu_order' => 'ASC', 'date' => 'DESC' ],
	] );
}

function dmg_get_listings_by_area( $area_slug ) {
	if ( ! $area_slug ) {
		return [];
	}
	return get_posts( [
		'post_type'      => 'dmg_listing',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => [ 'menu_order' => 'ASC', 'date' => 'DESC' ],
		'meta_query'     => [
			[
				'key'   => 'dmg_neighborhood',
				'value' => $area_slug,
			],
		],
	] );
}

function dmg_get_featured_listings() {
	return get_posts( [
		'post_type'      => 'dmg_listing',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => [ 'menu_order' => 'ASC' ],
		'meta_query'     => [
			[
				'key'   => 'dmg_featured',
				'value' => '1',
			],
		],
	] );
}

function dmg_listing_photo_alt( $attachment_id, $listing_id, $index = 1, $context = '' ) {
	$attachment_id = absint( $attachment_id );
	$listing_id    = absint( $listing_id );
	$index         = max( 1, absint( $index ) );

	if ( $attachment_id ) {
		$alt = trim( (string) get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) );
		if ( $alt ) {
			return $alt;
		}
	}

	$title = $listing_id ? get_the_title( $listing_id ) : '';
	$title = $title ?: 'listing';

	if ( 'hero' === $context ) {
		return $title;
	}

	return sprintf( 'Photo %1$d of %2$s', $index, $title );
}

function dmg_get_area_listings_prioritized( $area_slug ) {
	if ( ! $area_slug ) {
		return [];
	}
	$base = [
		'post_type'      => 'dmg_listing',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => [ 'menu_order' => 'ASC', 'date' => 'DESC' ],
	];

	$featured = get_posts( array_merge( $base, [
		'meta_query' => [
			'relation' => 'AND',
			[ 'key' => 'dmg_neighborhood', 'value' => $area_slug ],
			[ 'key' => 'dmg_featured',     'value' => '1' ],
		],
	] ) );

	$regular = get_posts( array_merge( $base, [
		'meta_query' => [
			'relation' => 'AND',
			[ 'key' => 'dmg_neighborhood', 'value' => $area_slug ],
			[
				'relation' => 'OR',
				[ 'key' => 'dmg_featured', 'compare' => 'NOT EXISTS' ],
				[ 'key' => 'dmg_featured', 'value' => '1', 'compare' => '!=' ],
			],
		],
	] ) );

	return array_merge( $featured, $regular );
}

function dmg_render_area_listing_card( $listing, $badge = null ) {
	static $status_label = [ 'active' => 'Active', 'pending' => 'Pending', 'sold' => 'Sold' ];
	$title      = get_the_title( $listing );
	$status     = get_post_meta( $listing->ID, 'dmg_status', true ) ?: 'active';
	$price      = get_post_meta( $listing->ID, 'dmg_price', true );
	$beds       = get_post_meta( $listing->ID, 'dmg_beds', true );
	$baths      = get_post_meta( $listing->ID, 'dmg_baths', true );
	$sqft       = get_post_meta( $listing->ID, 'dmg_sqft', true );
	$detail_url = get_permalink( $listing->ID );
	$thumb      = get_the_post_thumbnail_url( $listing, 'large' );
	?>
	<article class="dmg-listing-card" style="border:1px solid var(--wp--preset--color--gray-100);background:#fff;display:flex;flex-direction:column;overflow:hidden">
		<?php if ( $thumb ) : ?>
			<div style="aspect-ratio:3 / 2;background-image:url('<?php echo esc_url( $thumb ); ?>');background-size:cover;background-position:center"></div>
		<?php else : ?>
			<div class="dmg-area-image-placeholder" style="aspect-ratio:3 / 2">Listing photo</div>
		<?php endif; ?>
		<div style="padding:1.5rem 1.5rem 1.75rem;display:flex;flex-direction:column;gap:0.5rem">
			<?php if ( $badge ) : ?>
				<span style="align-self:flex-start;font-size:0.6875rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;padding:0.3rem 0.6rem;background:var(--wp--preset--color--primary);color:#fff;margin-bottom:0.25rem"><?php echo esc_html( $badge ); ?></span>
			<?php endif; ?>
			<span class="dmg-listing-status dmg-listing-status--<?php echo esc_attr( $status ); ?>" style="align-self:flex-start;font-size:0.6875rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;padding:0.3rem 0.6rem"><?php echo esc_html( $status_label[ $status ] ?? 'Active' ); ?></span>
			<h4 style="font-size:1.125rem;font-weight:700;line-height:1.3;margin:0.25rem 0 0;letter-spacing:-0.005em"><?php echo esc_html( $title ); ?></h4>
			<p style="font-size:1.5rem;font-weight:700;color:var(--wp--preset--color--primary);margin:0;letter-spacing:-0.01em"><?php echo $price ? esc_html( $price ) : '-'; ?></p>
			<p style="font-size:0.875rem;color:var(--wp--preset--color--gray-700);margin:0.25rem 0 0"><?php echo esc_html( ( $beds ?: '-' ) . ' bed · ' . ( $baths ?: '-' ) . ' bath · ' . ( $sqft ?: '-' ) . ' sqft' ); ?></p>
			<?php if ( $detail_url ) : ?>
				<a class="dmg-btn-primary" style="margin-top:1rem;align-self:flex-start" href="<?php echo esc_url( $detail_url ); ?>">View listing</a>
			<?php endif; ?>
		</div>
	</article>
	<?php
}

function dmg_render_idx_listing_card( $idx ) {
	static $status_label = [ 'active' => 'Active', 'pending' => 'Pending', 'sold' => 'Sold' ];
	$status = $idx['status'] ?? 'active';
	?>
	<article class="dmg-listing-card" style="border:1px solid var(--wp--preset--color--gray-100);background:#fff;display:flex;flex-direction:column;overflow:hidden">
		<?php if ( ! empty( $idx['thumb'] ) ) : ?>
			<div style="aspect-ratio:3 / 2;background-image:url('<?php echo esc_url( $idx['thumb'] ); ?>');background-size:cover;background-position:center"></div>
		<?php else : ?>
			<div class="dmg-area-image-placeholder" style="aspect-ratio:3 / 2">Listing photo</div>
		<?php endif; ?>
		<div style="padding:1.5rem 1.5rem 1.75rem;display:flex;flex-direction:column;gap:0.5rem">
			<span style="align-self:flex-start;font-size:0.6875rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;padding:0.3rem 0.6rem;background:var(--wp--preset--color--gray-500);color:#fff;margin-bottom:0.25rem">MLS Listing</span>
			<span class="dmg-listing-status dmg-listing-status--<?php echo esc_attr( $status ); ?>" style="align-self:flex-start;font-size:0.6875rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;padding:0.3rem 0.6rem"><?php echo esc_html( $status_label[ $status ] ?? 'Active' ); ?></span>
			<h4 style="font-size:1.125rem;font-weight:700;line-height:1.3;margin:0.25rem 0 0;letter-spacing:-0.005em"><?php echo esc_html( $idx['title'] ?? '' ); ?></h4>
			<p style="font-size:1.5rem;font-weight:700;color:var(--wp--preset--color--primary);margin:0;letter-spacing:-0.01em"><?php echo ! empty( $idx['price'] ) ? esc_html( $idx['price'] ) : '-'; ?></p>
			<p style="font-size:0.875rem;color:var(--wp--preset--color--gray-700);margin:0.25rem 0 0"><?php echo esc_html( ( $idx['beds'] ?? '-' ) . ' bed · ' . ( $idx['baths'] ?? '-' ) . ' bath · ' . ( $idx['sqft'] ?? '-' ) . ' sqft' ); ?></p>
			<?php if ( ! empty( $idx['detail_url'] ) ) : ?>
				<a class="dmg-btn-primary" style="margin-top:1rem;align-self:flex-start" href="<?php echo esc_url( $idx['detail_url'] ); ?>" target="_blank" rel="noopener">View listing</a>
			<?php endif; ?>
		</div>
	</article>
	<?php
}

// ---------------------------------------------------------------------------
// Auto-create "My Listings" page (self-healing, runs on init)
// ---------------------------------------------------------------------------
add_action( 'init', function () {
	if ( get_page_by_path( 'listings', OBJECT, 'page' ) ) {
		return;
	}

	$page_id = wp_insert_post( [
		'post_title'  => 'My Listings',
		'post_name'   => 'listings',
		'post_status' => 'publish',
		'post_type'   => 'page',
	] );

	if ( $page_id && ! is_wp_error( $page_id ) ) {
		update_post_meta( $page_id, '_wp_page_template', 'page-listings' );
	}
} );

// ---------------------------------------------------------------------------
// Flush rewrite rules once after CPT was made public (checks current rules)
// ---------------------------------------------------------------------------
add_action( 'init', function () {
	$rules = get_option( 'rewrite_rules' );
	if ( is_array( $rules ) ) {
		foreach ( array_keys( $rules ) as $pattern ) {
			if ( strpos( $pattern, 'listings' ) !== false ) {
				return; // Already registered - no flush needed.
			}
		}
	}
	flush_rewrite_rules( false );
}, 999 );

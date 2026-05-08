<?php
/**
 * Plugin Name: The McLaughlin Group - Reviews
 * Description: Custom post type and admin UI for client testimonials (home carousel + /testimonials page).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ---------------------------------------------------------------------------
// CPT
// ---------------------------------------------------------------------------
add_action( 'init', function () {
	register_post_type( 'dmg_review', [
		'labels' => [
			'name'          => 'Reviews',
			'singular_name' => 'Review',
			'add_new'       => 'Add Review',
			'add_new_item'  => 'Add New Review',
			'edit_item'     => 'Edit Review',
			'new_item'      => 'New Review',
			'view_item'     => 'View Review',
			'search_items'  => 'Search Reviews',
			'not_found'     => 'No reviews found',
			'menu_name'     => 'Reviews',
			'all_items'     => 'All Reviews',
		],
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_position' => 21,
		'menu_icon'     => 'dashicons-format-quote',
		'show_in_rest'  => true,
		'has_archive'   => false,
		'rewrite'       => false,
		'supports'      => [ 'title', 'page-attributes' ],
	] );
} );

// ---------------------------------------------------------------------------
// Meta registration
// ---------------------------------------------------------------------------
add_action( 'init', function () {
	$meta = [
		'dmg_rating' => 'absint',
		'dmg_quote'  => 'wp_kses_post',
		'dmg_source' => 'sanitize_text_field',
	];
	foreach ( $meta as $key => $sanitize ) {
		register_post_meta( 'dmg_review', $key, [
			'type'              => $key === 'dmg_rating' ? 'integer' : 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => $sanitize,
			'auth_callback'     => function () { return current_user_can( 'edit_posts' ); },
		] );
	}
} );

// ---------------------------------------------------------------------------
// Admin meta box
// ---------------------------------------------------------------------------
add_action( 'add_meta_boxes', function () {
	add_meta_box(
		'dmg_review_details',
		'Review Details',
		'dmg_review_render_meta_box',
		'dmg_review',
		'normal',
		'high'
	);
} );

function dmg_review_render_meta_box( $post ) {
	wp_nonce_field( 'dmg_review_save', 'dmg_review_nonce' );

	$rating = (int) get_post_meta( $post->ID, 'dmg_rating', true ) ?: 5;
	$quote  = get_post_meta( $post->ID, 'dmg_quote', true );
	$source = get_post_meta( $post->ID, 'dmg_source', true ) ?: 'zillow';
	?>
	<style>
		.dmg-review-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem 1.5rem; max-width: 760px; }
		.dmg-review-grid p { margin: 0 0 0.4rem 0; }
		.dmg-review-grid input[type="text"], .dmg-review-grid select, .dmg-review-grid textarea { width: 100%; }
		.dmg-review-row { grid-column: 1 / -1; }
		.dmg-review-grid textarea { min-height: 160px; font-size: 14px; line-height: 1.5; }
		.dmg-review-help { color: #757575; font-style: italic; margin-top: 0.25rem; font-size: 12px; }
	</style>
	<div class="dmg-review-grid">

		<div>
			<p><label for="dmg_rating"><strong>Rating</strong></label></p>
			<select id="dmg_rating" name="dmg_rating">
				<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
					<option value="<?php echo $i; ?>" <?php selected( $rating, $i ); ?>><?php echo $i; ?> Star<?php echo $i === 1 ? '' : 's'; ?></option>
				<?php endfor; ?>
			</select>
		</div>

		<div>
			<p><label for="dmg_source"><strong>Source</strong></label></p>
			<select id="dmg_source" name="dmg_source">
				<option value="zillow" <?php selected( $source, 'zillow' ); ?>>Zillow</option>
				<option value="google" <?php selected( $source, 'google' ); ?>>Google</option>
			</select>
			<p class="dmg-review-help">Determines which logo appears next to the review.</p>
		</div>

		<div class="dmg-review-row">
			<p><label for="dmg_quote"><strong>Review Quote</strong></label></p>
			<textarea id="dmg_quote" name="dmg_quote" rows="8"><?php echo esc_textarea( $quote ); ?></textarea>
			<p class="dmg-review-help">Paste the review text exactly as it appeared. No need to include quotation marks, the design adds them.</p>
		</div>

		<div class="dmg-review-row">
			<p class="dmg-review-help"><strong>Tip:</strong> Use the <em>Title</em> field above as a short internal label (e.g. &ldquo;Smith family - Westlake sale&rdquo;). It is not shown on the front end. Drag-sort reviews on the All Reviews list using the <em>Order</em> column.</p>
		</div>

	</div>
	<?php
}

// ---------------------------------------------------------------------------
// Save meta
// ---------------------------------------------------------------------------
add_action( 'save_post_dmg_review', function ( $post_id ) {
	if ( ! isset( $_POST['dmg_review_nonce'] ) || ! wp_verify_nonce( $_POST['dmg_review_nonce'], 'dmg_review_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['dmg_rating'] ) ) {
		$rating = max( 1, min( 5, (int) $_POST['dmg_rating'] ) );
		update_post_meta( $post_id, 'dmg_rating', $rating );
	}

	if ( isset( $_POST['dmg_quote'] ) ) {
		update_post_meta( $post_id, 'dmg_quote', wp_kses_post( wp_unslash( $_POST['dmg_quote'] ) ) );
	}

	if ( isset( $_POST['dmg_source'] ) ) {
		$source = in_array( $_POST['dmg_source'], [ 'zillow', 'google' ], true ) ? $_POST['dmg_source'] : 'zillow';
		update_post_meta( $post_id, 'dmg_source', $source );
	}
} );

// ---------------------------------------------------------------------------
// Admin list table columns
// ---------------------------------------------------------------------------
add_filter( 'manage_dmg_review_posts_columns', function ( $columns ) {
	$new = [];
	foreach ( $columns as $key => $label ) {
		$new[ $key ] = $label;
		if ( $key === 'title' ) {
			$new['dmg_rating'] = 'Rating';
			$new['dmg_source'] = 'Source';
			$new['dmg_quote']  = 'Quote';
		}
	}
	$new['menu_order'] = 'Order';
	return $new;
} );

add_action( 'manage_dmg_review_posts_custom_column', function ( $column, $post_id ) {
	switch ( $column ) {
		case 'dmg_rating':
			$r = (int) get_post_meta( $post_id, 'dmg_rating', true );
			echo $r ? esc_html( str_repeat( '★', $r ) . str_repeat( '☆', 5 - $r ) ) : '-';
			break;
		case 'dmg_source':
			$s = get_post_meta( $post_id, 'dmg_source', true );
			echo $s ? esc_html( ucfirst( $s ) ) : '-';
			break;
		case 'dmg_quote':
			$q = get_post_meta( $post_id, 'dmg_quote', true );
			echo $q ? esc_html( wp_trim_words( $q, 14, '…' ) ) : '-';
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
function dmg_get_reviews() {
	return get_posts( [
		'post_type'      => 'dmg_review',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => [ 'menu_order' => 'ASC', 'date' => 'ASC' ],
	] );
}

function dmg_review_source_link( $source ) {
	switch ( $source ) {
		case 'google':
			// Placeholder until Dave provides the GBP URL.
			return '#google-business-profile';
		case 'zillow':
		default:
			return 'https://www.zillow.com/profile/agentmclaugh';
	}
}

/**
 * Render an inline SVG logo for a review source.
 * Echoes directly. Already escaped (static SVG markup).
 */
function dmg_review_source_logo( $source ) {
	if ( $source === 'google' ) {
		?>
		<span class="dmg-google-logo" aria-label="Google">
			<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48" aria-hidden="true">
				<path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3c-1.6 4.7-6.1 8-11.3 8-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.8 1.2 7.9 3l5.7-5.7C34 6.1 29.3 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.4-.4-3.5z"/>
				<path fill="#FF3D00" d="m6.3 14.7 6.6 4.8C14.7 16.2 19 13 24 13c3.1 0 5.8 1.2 7.9 3l5.7-5.7C34 6.1 29.3 4 24 4 16.3 4 9.7 8.3 6.3 14.7z"/>
				<path fill="#4CAF50" d="M24 44c5.2 0 9.9-2 13.4-5.2l-6.2-5.2C29.2 34.8 26.7 36 24 36c-5.2 0-9.6-3.3-11.3-7.9l-6.5 5C9.6 39.6 16.2 44 24 44z"/>
				<path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.3 4.3-4.1 5.7l6.2 5.2C40.9 35.6 44 30.2 44 24c0-1.3-.1-2.4-.4-3.5z"/>
			</svg>
			Google
		</span>
		<?php
	} else {
		?>
		<span class="dmg-zillow-logo" aria-label="Zillow">
			<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true"><path d="M16 2 3 12.4v3.4l4.3-1.7v9.5h6.2v-7.3h5v7.3h6.2v-9.5l4.3 1.7v-3.4z"/></svg>
			Zillow
		</span>
		<?php
	}
}

// ---------------------------------------------------------------------------
// First-run seeding: create the Testimonials Page + 5 starter reviews.
// Self-healing - checks actual state each load, no option flag.
// Runs after CPT is registered (priority 20).
// ---------------------------------------------------------------------------
add_action( 'init', function () {

	// Create the Testimonials page if it does not exist.
	$existing = get_page_by_path( 'testimonials', OBJECT, 'page' );
	if ( ! $existing ) {
		wp_insert_post( [
			'post_title'   => 'Testimonials',
			'post_name'    => 'testimonials',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		] );
	}

	// Seed 5 starter reviews - only if the CPT is empty so re-runs don't duplicate.
	$existing_reviews = get_posts( [
		'post_type'      => 'dmg_review',
		'post_status'    => 'any',
		'posts_per_page' => 1,
		'fields'         => 'ids',
	] );
	if ( empty( $existing_reviews ) ) {
		$reviews = [
			[ 'title' => 'Outstanding home buying & selling', 'rating' => 5, 'quote' => 'David did an outstanding job helping us with buying a home last summer and, more recently, selling our old home this year. His knowledge, experience and overall market instincts were instrumental in helping us to sell our home quickly and at a price that was over our asking price. He was also very easy to work with, responsive to our many questions, and had a great sense of humor. He is an all around great real estate agent and we highly recommend him!' ],
			[ 'title' => 'Agoura Hills land sale',          'rating' => 5, 'quote' => 'We really appreciated working with Dave on a 1/2 acre land sale in Agoura Hills. It was a challenging property but he was extremely helpful in navigating the sale process with the Owner. He was super patient and did a great job of describing the market and the neighborhood. The sale would not have happened were it not for his guidance and expertise!' ],
			[ 'title' => 'Multi-transaction client',         'rating' => 5, 'quote' => 'I have known Dave for several years and have worked together on multiple transactions. Dave is the most knowledgeable real estate professional that I have ever dealt with. Would recommend Dave to anyone considering buying or selling a home.' ],
			[ 'title' => 'Fountainwood home sale',           'rating' => 5, 'quote' => 'Dave did an excellent job with assisting us in selling our Fountainwood home. His knowledge of the area real estate market is unparalleled, which allowed us to accurately determine the best selling price for our home. Dave was there every step of the way, providing guidance and answering any questions as they came up. He handled the entire transaction expeditiously and professionally, which provided much needed peace of mind from start to finish. I wholeheartedly recommend David McLaughlin and his team of experienced professionals!' ],
			[ 'title' => 'Above-and-beyond after escrow fell through', 'rating' => 5, 'quote' => 'Dave did such a great job selling our house. Our first escrow fell through but Dave went above and beyond to make the sale happen with another buyer that had walked through our property. We are really grateful to Dave and recommend his services wholeheartedly.' ],
		];
		foreach ( $reviews as $i => $r ) {
			$id = wp_insert_post( [
				'post_title'  => $r['title'],
				'post_status' => 'publish',
				'post_type'   => 'dmg_review',
				'menu_order'  => $i + 1,
			] );
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, 'dmg_rating', $r['rating'] );
				update_post_meta( $id, 'dmg_quote', $r['quote'] );
				update_post_meta( $id, 'dmg_source', 'zillow' );
			}
		}
	}
}, 20 );

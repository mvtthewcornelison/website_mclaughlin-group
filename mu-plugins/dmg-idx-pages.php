<?php
/**
 * Plugin Name: The McLaughlin Group - IDX Pages
 * Description: Seeds all IDX and city SEO pages on init. Provides SEO meta descriptions and the bridge stub for dmg_idx_listings_for_area.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ---------------------------------------------------------------------------
// IDX functional pages — no post_content needed; shortcodes inserted via admin.
// ---------------------------------------------------------------------------
function dmg_idx_functional_pages() {
	return [
		'search-homes'  => [ 'title' => 'Search Homes',  'template' => 'page-idx-content' ],
		'my-past-sales' => [ 'title' => 'My Past Sales', 'template' => 'page-idx-content' ],
		'open-houses'   => [ 'title' => 'Open Houses',   'template' => 'page-idx-content' ],
		'communities'   => [ 'title' => 'Communities',   'template' => 'page-communities' ],
	];
}

// ---------------------------------------------------------------------------
// City SEO pages — static intro copy seeded at creation time.
// ---------------------------------------------------------------------------
function dmg_idx_city_pages() {
	return [
		'agoura-hills-homes-for-sale' => [
			'title'    => 'Agoura Hills Homes for Sale',
			'template' => 'page-idx-city',
			'h1'       => 'Homes for Sale in Agoura Hills, CA',
			'intro'    => 'Browse active MLS listings in Agoura Hills — from updated single-family homes to large custom estates in Old Agoura. The McLaughlin Group has deep roots in this community and knows what moves and what stays.',
			'meta'     => 'Search homes for sale in Agoura Hills, CA. Active MLS listings with local guidance from The McLaughlin Group, Conejo Valley real estate experts.',
		],
		'malibou-lake-homes-for-sale' => [
			'title'    => 'Malibou Lake Homes for Sale',
			'template' => 'page-idx-city',
			'h1'       => 'Homes for Sale at Malibou Lake, CA',
			'intro'    => 'Explore homes for sale at Malibou Lake — a private mountain community tucked into the Santa Monica Mountains. Rarely available and unlike anything else in the region.',
			'meta'     => 'Search homes for sale at Malibou Lake, CA. A private mountain community in the Santa Monica Mountains. Local guidance from The McLaughlin Group.',
		],
		'westlake-village-homes-for-sale' => [
			'title'    => 'Westlake Village Homes for Sale',
			'template' => 'page-idx-city',
			'h1'       => 'Homes for Sale in Westlake Village, CA',
			'intro'    => 'Find homes for sale in Westlake Village — a master-planned community built around a private lake and one of the most sought-after addresses in the Conejo Valley.',
			'meta'     => 'Search homes for sale in Westlake Village, CA. Active MLS listings and local market guidance from The McLaughlin Group.',
		],
		'thousand-oaks-homes-for-sale' => [
			'title'    => 'Thousand Oaks Homes for Sale',
			'template' => 'page-idx-city',
			'h1'       => 'Homes for Sale in Thousand Oaks, CA',
			'intro'    => 'Search homes for sale in Thousand Oaks — the largest city in the Conejo Valley, known for its parks, low crime rates, and a wide range of neighborhoods at every price point.',
			'meta'     => 'Search homes for sale in Thousand Oaks, CA. Active MLS listings in the Conejo Valley from The McLaughlin Group.',
		],
		'newbury-park-homes-for-sale' => [
			'title'    => 'Newbury Park Homes for Sale',
			'template' => 'page-idx-city',
			'h1'       => 'Homes for Sale in Newbury Park, CA',
			'intro'    => 'Discover homes for sale in Newbury Park — a family-first community with top-rated schools, access to open space, and a quiet residential feel that draws buyers from across Ventura County.',
			'meta'     => 'Search homes for sale in Newbury Park, CA. Active MLS listings with local guidance from The McLaughlin Group.',
		],
		'oak-park-homes-for-sale' => [
			'title'    => 'Oak Park Homes for Sale',
			'template' => 'page-idx-city',
			'h1'       => 'Homes for Sale in Oak Park, CA',
			'intro'    => 'Browse homes for sale in Oak Park — a tight-knit community with one of the highest-rated school districts in California and quiet streets that attract families looking to put down roots.',
			'meta'     => 'Search homes for sale in Oak Park, CA. Active MLS listings and community insight from The McLaughlin Group.',
		],
		'malibu-homes-for-sale' => [
			'title'    => 'Malibu Homes for Sale',
			'template' => 'page-idx-city',
			'h1'       => 'Homes for Sale in Malibu, CA',
			'intro'    => 'Search homes for sale in Malibu — from beachfront estates on the Pacific Coast Highway to hillside retreats in the Santa Monica Mountains. The McLaughlin Group brings local knowledge to one of the most iconic markets in Southern California.',
			'meta'     => 'Search homes for sale in Malibu, CA. Beachfront estates to hillside retreats. Local guidance from The McLaughlin Group.',
		],
		'ventura-homes-for-sale' => [
			'title'    => 'Ventura Homes for Sale',
			'template' => 'page-idx-city',
			'h1'       => 'Homes for Sale in Ventura, CA',
			'intro'    => 'Explore homes for sale in Ventura — a coastal city with a walkable downtown, beaches, and a diverse range of neighborhoods offering outstanding value along the Southern California coast.',
			'meta'     => 'Search homes for sale in Ventura, CA. Active MLS listings and local guidance from The McLaughlin Group.',
		],
	];
}

// ---------------------------------------------------------------------------
// First-run seeding: create all IDX pages. Self-healing — safe to re-run.
// Runs at priority 30 (after CPTs at default 10, after areas at 20).
// ---------------------------------------------------------------------------
add_action( 'init', function () {

	// Functional IDX pages.
	foreach ( dmg_idx_functional_pages() as $slug => $def ) {
		$existing = get_page_by_path( $slug, OBJECT, 'page' );
		if ( $existing ) {
			continue;
		}
		$page_id = wp_insert_post( [
			'post_title'  => $def['title'],
			'post_name'   => $slug,
			'post_status' => 'publish',
			'post_type'   => 'page',
		] );
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			update_post_meta( $page_id, '_wp_page_template', $def['template'] );
		}
	}

	// City SEO pages.
	foreach ( dmg_idx_city_pages() as $slug => $def ) {
		$existing = get_page_by_path( $slug, OBJECT, 'page' );
		if ( $existing ) {
			continue;
		}
		$content = '<h1>' . $def['h1'] . '</h1>' . "\n\n" . '<p>' . $def['intro'] . '</p>';
		$page_id = wp_insert_post( [
			'post_title'   => $def['title'],
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => $content,
		] );
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			update_post_meta( $page_id, '_wp_page_template', $def['template'] );
		}
	}

}, 30 );

// ---------------------------------------------------------------------------
// SEO: emit meta descriptions for all IDX and city pages.
// ---------------------------------------------------------------------------
add_action( 'wp_head', function () {
	if ( ! is_page() ) {
		return;
	}
	$post = get_post();
	if ( ! $post ) {
		return;
	}

	$functional_meta = [
		'search-homes'  => 'Search all active MLS listings in Agoura Hills, Westlake Village, Thousand Oaks, Newbury Park, Malibu, and Ventura. Local guidance from The McLaughlin Group.',
		'my-past-sales' => 'Browse past sales and sold listings by Dave McLaughlin. A track record of results across the Conejo Valley and surrounding communities.',
		'open-houses'   => 'Find open houses in Agoura Hills, Westlake Village, Thousand Oaks, and surrounding Conejo Valley communities. Updated from the MLS daily.',
		'communities'   => 'Explore communities served by The McLaughlin Group — Agoura Hills, Westlake Village, Thousand Oaks, Newbury Park, Oak Park, Malibu, and Ventura.',
	];

	if ( isset( $functional_meta[ $post->post_name ] ) ) {
		echo "\n" . '<meta name="description" content="' . esc_attr( $functional_meta[ $post->post_name ] ) . '">' . "\n";
		return;
	}

	$city_pages = dmg_idx_city_pages();
	if ( isset( $city_pages[ $post->post_name ] ) ) {
		echo "\n" . '<meta name="description" content="' . esc_attr( $city_pages[ $post->post_name ]['meta'] ) . '">' . "\n";
	}
}, 5 );

// ---------------------------------------------------------------------------
// IDX bridge stub: returns [] until the FlexMLS plugin API is wired up.
// Replace this with a real implementation after the IDX plugin is connected.
// ---------------------------------------------------------------------------
add_filter( 'dmg_idx_listings_for_area', '__return_empty_array', 5, 2 );

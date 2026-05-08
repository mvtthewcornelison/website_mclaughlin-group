<?php
/**
 * Plugin Name: The McLaughlin Group - Areas
 * Description: Programmatic creation of community pages (/areas/ index + per-community child pages) and SEO meta tags for them.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ---------------------------------------------------------------------------
// Source of truth for the 8 communities. Add an entry to introduce a new area.
// 'meta_description' is rendered into <head> when that area page is loaded.
// ---------------------------------------------------------------------------
function dmg_areas_definitions() {
	return [
		'agoura-hills' => [
			'name'             => 'Agoura Hills',
			'meta_description' => 'Discover Agoura Hills real estate, schools, neighborhoods, and lifestyle. Local market guidance from The McLaughlin Group, three generations in the Conejo Valley.',
		],
		'malibou-lake' => [
			'name'             => 'Malibou Lake',
			'meta_description' => 'Explore Malibou Lake real estate and lifestyle. Local insight from The McLaughlin Group, Conejo Valley realtors with deep community roots.',
		],
		'westlake-village' => [
			'name'             => 'Westlake Village',
			'meta_description' => 'Westlake Village neighborhood guide, schools, and homes for sale. Trusted local guidance from The McLaughlin Group.',
		],
		'thousand-oaks' => [
			'name'             => 'Thousand Oaks',
			'meta_description' => 'Thousand Oaks real estate, schools, and community guide. Three-generation Conejo Valley realtors.',
		],
		'newbury-park' => [
			'name'             => 'Newbury Park',
			'meta_description' => 'Newbury Park homes for sale, schools, and lifestyle. Trusted local insight from The McLaughlin Group.',
		],
		'oak-park' => [
			'name'             => 'Oak Park',
			'meta_description' => 'Oak Park real estate, top-rated schools, and neighborhood guide. From The McLaughlin Group, Conejo Valley realtors.',
		],
		'malibu' => [
			'name'             => 'Malibu',
			'meta_description' => 'Malibu real estate and coastal lifestyle. Honest local guidance from The McLaughlin Group.',
		],
		'ventura' => [
			'name'             => 'Ventura',
			'meta_description' => 'Ventura real estate, neighborhoods, and lifestyle. Coastal and inland community guide from The McLaughlin Group.',
		],
	];
}

// ---------------------------------------------------------------------------
// First-run seeding: create parent /areas/ page + each child community page.
// Self-healing - re-checks state each load. Runs after CPTs (priority 20).
// ---------------------------------------------------------------------------
add_action( 'init', function () {

	// Parent /areas/ page.
	$parent = get_page_by_path( 'areas', OBJECT, 'page' );
	if ( ! $parent ) {
		$parent_id = wp_insert_post( [
			'post_title'   => 'Areas',
			'post_name'    => 'areas',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		] );
	} else {
		$parent_id = $parent->ID;
	}

	if ( ! $parent_id || is_wp_error( $parent_id ) ) {
		return;
	}

	// One child page per community.
	foreach ( dmg_areas_definitions() as $slug => $def ) {
		$existing = get_page_by_path( 'areas/' . $slug, OBJECT, 'page' );
		if ( ! $existing ) {
			wp_insert_post( [
				'post_title'   => $def['name'],
				'post_name'    => $slug,
				'post_parent'  => $parent_id,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			] );
		}
	}
}, 20 );

// ---------------------------------------------------------------------------
// SEO: emit a meta description on community pages so search engines (and
// social previews) get a clean summary instead of a stripped-content fallback.
// ---------------------------------------------------------------------------
add_action( 'wp_head', function () {
	if ( ! is_page() ) {
		return;
	}
	$post = get_post();
	if ( ! $post || $post->post_type !== 'page' ) {
		return;
	}
	$parent = $post->post_parent ? get_post( $post->post_parent ) : null;
	if ( ! $parent || $parent->post_name !== 'areas' ) {
		return;
	}
	$defs = dmg_areas_definitions();
	if ( ! isset( $defs[ $post->post_name ] ) ) {
		return;
	}
	$desc = $defs[ $post->post_name ]['meta_description'];
	echo "\n" . '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
}, 5 );

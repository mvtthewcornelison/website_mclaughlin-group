<?php
/**
 * Plugin Name: The McLaughlin Group - Give Back
 * Description: Pages for the "We Give Back" organizations Dave supports.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ---------------------------------------------------------------------------
// Source of truth for the supported organizations. Add an entry here when a
// new "We Give Back" page is introduced.
// ---------------------------------------------------------------------------
function dmg_give_back_definitions() {
	return [
		'royal-family-kids' => [
			'name'             => 'Royal Family Kids',
			'meta_description' => 'Royal Family Kids Camp is an overnight summer camp for foster children in Ventura and Los Angeles County, supported by The McLaughlin Group.',
		],
	];
}

// ---------------------------------------------------------------------------
// First-run seeding: parent /we-give-back/ + child page per organization.
// Self-healing on every load. Runs at priority 20 so any other CPT/auth setup
// from sibling mu-plugins finishes first.
// ---------------------------------------------------------------------------
add_action( 'init', function () {

	$parent = get_page_by_path( 'we-give-back', OBJECT, 'page' );
	if ( ! $parent ) {
		$parent_id = wp_insert_post( [
			'post_title'   => 'We Give Back',
			'post_name'    => 'we-give-back',
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

	foreach ( dmg_give_back_definitions() as $slug => $def ) {
		$existing = get_page_by_path( 'we-give-back/' . $slug, OBJECT, 'page' );
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
// SEO: emit a meta description for each child organization page so search
// engines and social previews pick up a clean summary.
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
	if ( ! $parent || $parent->post_name !== 'we-give-back' ) {
		return;
	}
	$defs = dmg_give_back_definitions();
	if ( ! isset( $defs[ $post->post_name ] ) ) {
		return;
	}
	$desc = $defs[ $post->post_name ]['meta_description'];
	echo "\n" . '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
}, 5 );

<?php
/**
 * Plugin Name: The McLaughlin Group - Team
 * Description: Self-healing Who We Are page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function () {
	$existing = get_page_by_path( 'who-we-are', OBJECT, 'page' );
	if ( ! $existing ) {
		wp_insert_post( [
			'post_title'   => 'Who We Are',
			'post_name'    => 'who-we-are',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		] );
	}
}, 20 );


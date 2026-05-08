<?php
/**
 * Plugin Name: The McLaughlin Group - Team
 * Description: Self-healing Meet the Team page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function () {
	$existing = get_page_by_path( 'meet-the-team', OBJECT, 'page' );
	if ( ! $existing ) {
		wp_insert_post( [
			'post_title'   => 'Meet the Team',
			'post_name'    => 'meet-the-team',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		] );
	}
}, 20 );


<?php
/**
 * The McLaughlin Group theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'dmg-inter',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		[],
		null
	);

	// Splide carousel (used by Featured Listings + future Testimonials).
	wp_enqueue_style(
		'splide',
		'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css',
		[],
		'4.1.4'
	);
	wp_enqueue_script(
		'splide',
		'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js',
		[],
		'4.1.4',
		true
	);
	wp_enqueue_script(
		'dmg-carousels',
		get_theme_file_uri( 'assets/js/carousels.js' ),
		[ 'splide' ],
		'0.3.0',
		true
	);

	// Service Areas - tile grid (home + /areas/) and community page styles.
	wp_enqueue_style(
		'dmg-areas',
		get_theme_file_uri( 'assets/css/areas.css' ),
		[],
		'0.1.0'
	);

	// Smart sticky header (auto-hide on scroll-down, reveal on scroll-up).
	wp_enqueue_style(
		'dmg-header',
		get_theme_file_uri( 'assets/css/header.css' ),
		[],
		'0.1.0'
	);
	wp_enqueue_style(
		'dmg-contact',
		get_theme_file_uri( 'assets/css/contact.css' ),
		[],
		'0.1.0'
	);
	wp_enqueue_script(
		'dmg-header',
		get_theme_file_uri( 'assets/js/header.js' ),
		[],
		'0.1.0',
		true
	);
} );

// Dev-only: flush the theme pattern cache on every load so new/edited patterns
// in patterns/ are picked up without manual clears. Remove before launch.
add_action( 'after_setup_theme', function () {
	wp_get_theme()->delete_pattern_cache();
} );

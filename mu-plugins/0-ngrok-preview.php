<?php
/**
 * Plugin Name: ngrok Preview URL Override
 * Description: When the site is accessed via an ngrok tunnel, rewrite home/siteurl to the
 *              public ngrok URL. Local Studio access (localhost) is unaffected.
 *              Delete this file once the preview hand-off is finished.
 *
 * Why this exists: WordPress Studio runs PHP via PHP-WASM and defines WP_HOME / WP_SITEURL
 * as immutable PHP constants before wp-config.php executes. That means we can't override
 * them from wp-config.php — we have to intercept the option lookup via filters instead.
 */

if ( empty( $_SERVER['HTTP_HOST'] ) || strpos( $_SERVER['HTTP_HOST'], 'ngrok' ) === false ) {
	return;
}

$dmg_ngrok_url = 'https://' . preg_replace( '/:\d+$/', '', $_SERVER['HTTP_HOST'] );

add_filter( 'pre_option_home',    static function () use ( $dmg_ngrok_url ) { return $dmg_ngrok_url; }, 99 );
add_filter( 'pre_option_siteurl', static function () use ( $dmg_ngrok_url ) { return $dmg_ngrok_url; }, 99 );

// Rewrite absolute localhost:8881 URLs baked into post/block content on the way out. These
// were saved when images were inserted via the block editor and aren't reachable from the
// realtor's browser. Also coerces http:// → https:// to avoid mixed-content blocking.
ob_start( static function ( $buffer ) use ( $dmg_ngrok_url ) {
	$escaped_host = parse_url( $dmg_ngrok_url, PHP_URL_HOST );
	return strtr( $buffer, [
		'http://localhost:8881'   => $dmg_ngrok_url,
		'https://localhost:8881'  => $dmg_ngrok_url,
		'//localhost:8881'        => '//' . $escaped_host,
		'http:\/\/localhost:8881' => str_replace( '/', '\/', $dmg_ngrok_url ),
	] );
} );

// Rewrite any absolute localhost:8881 URLs baked into post content / block markup / theme
// patterns. These are stored in the DB as absolute URLs and won't be reachable from the
// realtor's browser. We also coerce http:// to https:// to avoid mixed-content blocking.
ob_start( static function ( $buffer ) use ( $dmg_ngrok_url ) {
	return strtr( $buffer, [
		'http://localhost:8881'   => $dmg_ngrok_url,
		'https://localhost:8881'  => $dmg_ngrok_url,
		'//localhost:8881'        => '//' . parse_url( $dmg_ngrok_url, PHP_URL_HOST ),
		'http:\/\/localhost:8881' => str_replace( '/', '\/', $dmg_ngrok_url ),
	] );
} );

<?php
/**
 * Plugin Name: The McLaughlin Group - Featured Video
 * Description: Manages the YouTube channel feed and featured video displayed on the homepage.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function () {
	register_setting( 'dmg_video_settings', 'dmg_featured_video_url', [
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_url',
		'default'           => '',
	] );
	register_setting( 'dmg_video_settings', 'dmg_youtube_channel_url', [
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_url',
		'default'           => '',
	] );
	register_setting( 'dmg_video_settings', 'dmg_youtube_channel_id', [
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '',
	] );
} );

add_action( 'admin_menu', function () {
	add_options_page(
		'Featured Video',
		'Featured Video',
		'manage_options',
		'dmg-video-settings',
		'dmg_video_settings_page'
	);
} );

/**
 * Fetches the YouTube channel page and extracts the UCxxxxx channel ID.
 * Tries the canonical link first, then falls back to inline JSON.
 */
function dmg_resolve_youtube_channel_id( string $url ): string {
	$response = wp_remote_get( $url, [
		'timeout'    => 10,
		'user-agent' => 'Mozilla/5.0 (compatible; WordPress/' . get_bloginfo( 'version' ) . '; +https://wordpress.org)',
	] );
	if ( is_wp_error( $response ) ) {
		return '';
	}
	$body = wp_remote_retrieve_body( $response );
	if ( preg_match( '~youtube\.com/channel/(UC[\w-]+)~', $body, $m ) ) {
		return $m[1];
	}
	if ( preg_match( '~"channelId"\s*:\s*"(UC[\w-]+)"~', $body, $m ) ) {
		return $m[1];
	}
	return '';
}

/**
 * Returns up to $count recent videos from the channel RSS feed.
 * Each item: ['id' => string, 'title' => string].
 * Results are cached in a transient for 1 hour.
 */
function dmg_get_youtube_videos( int $count = 4 ): array {
	$channel_id = get_option( 'dmg_youtube_channel_id', '' );
	if ( ! $channel_id ) {
		return [];
	}

	$cached = get_transient( 'dmg_youtube_feed_cache' );
	if ( false !== $cached ) {
		return array_slice( $cached, 0, $count );
	}

	$feed_url = 'https://www.youtube.com/feeds/videos.xml?channel_id=' . urlencode( $channel_id );
	$response = wp_remote_get( $feed_url, [ 'timeout' => 10 ] );

	if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
		set_transient( 'dmg_youtube_feed_cache', [], 5 * MINUTE_IN_SECONDS );
		return [];
	}

	$body = wp_remote_retrieve_body( $response );
	libxml_use_internal_errors( true );
	$xml = simplexml_load_string( $body, 'SimpleXMLElement', LIBXML_NOCDATA );

	if ( ! $xml ) {
		set_transient( 'dmg_youtube_feed_cache', [], 5 * MINUTE_IN_SECONDS );
		return [];
	}

	$videos = [];
	foreach ( $xml->entry as $entry ) {
		$yt       = $entry->children( 'http://www.youtube.com/xml/schemas/2015' );
		$video_id = (string) $yt->videoId;
		if ( ! $video_id ) {
			continue;
		}
		$videos[] = [
			'id'    => $video_id,
			'title' => (string) $entry->title,
		];
	}

	set_transient( 'dmg_youtube_feed_cache', $videos, HOUR_IN_SECONDS );
	return array_slice( $videos, 0, $count );
}

function dmg_video_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$resolve_result = null;

	if ( isset( $_POST['dmg_video_settings_nonce'] ) && wp_verify_nonce( $_POST['dmg_video_settings_nonce'], 'dmg_video_settings_save' ) ) {
		if ( isset( $_POST['dmg_featured_video_url'] ) ) {
			update_option( 'dmg_featured_video_url', sanitize_url( wp_unslash( $_POST['dmg_featured_video_url'] ) ) );
		}

		$new_url = isset( $_POST['dmg_youtube_channel_url'] ) ? sanitize_url( wp_unslash( $_POST['dmg_youtube_channel_url'] ) ) : '';
		$old_url = get_option( 'dmg_youtube_channel_url', '' );
		update_option( 'dmg_youtube_channel_url', $new_url );

		// Always persist the channel ID field; auto-resolve only when field is blank and URL changed.
		$manual_id = isset( $_POST['dmg_youtube_channel_id'] ) ? sanitize_text_field( wp_unslash( $_POST['dmg_youtube_channel_id'] ) ) : '';
		update_option( 'dmg_youtube_channel_id', $manual_id );
		if ( ! $manual_id && $new_url && $new_url !== $old_url ) {
			$resolved = dmg_resolve_youtube_channel_id( $new_url );
			if ( $resolved ) {
				update_option( 'dmg_youtube_channel_id', $resolved );
				$resolve_result = $resolved;
			} else {
				$resolve_result = 'failed';
			}
		}

		delete_transient( 'dmg_youtube_feed_cache' );
		echo '<div class="notice notice-success is-dismissible"><p>Settings saved.</p></div>';

		if ( 'failed' === $resolve_result ) {
			echo '<div class="notice notice-warning is-dismissible"><p>Could not auto-resolve the Channel ID from that URL. Enter it manually below (YouTube Studio &rsaquo; Settings &rsaquo; Advanced Settings &rsaquo; Channel ID).</p></div>';
		} elseif ( $resolve_result ) {
			echo '<div class="notice notice-info is-dismissible"><p>Channel ID auto-resolved: <strong>' . esc_html( $resolve_result ) . '</strong></p></div>';
		}
	}
	?>
	<div class="wrap">
		<h1>Featured Video</h1>
		<form method="post" action="">
			<?php wp_nonce_field( 'dmg_video_settings_save', 'dmg_video_settings_nonce' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="dmg_youtube_channel_url">YouTube Channel URL</label></th>
					<td>
						<input type="url" id="dmg_youtube_channel_url" name="dmg_youtube_channel_url"
							value="<?php echo esc_attr( get_option( 'dmg_youtube_channel_url', '' ) ); ?>"
							class="regular-text"
							placeholder="https://www.youtube.com/@YourChannel" />
						<p class="description">Used for the "See All Videos" link. Saving a new URL will attempt to auto-resolve the Channel ID below.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dmg_youtube_channel_id">YouTube Channel ID</label></th>
					<td>
						<input type="text" id="dmg_youtube_channel_id" name="dmg_youtube_channel_id"
							value="<?php echo esc_attr( get_option( 'dmg_youtube_channel_id', '' ) ); ?>"
							class="regular-text"
							placeholder="UCxxxxxxxxxxxxxxxxxxxxxxxx" />
						<p class="description">Auto-populated when a valid channel URL is saved. If auto-resolution fails, find it in <strong>YouTube Studio &rsaquo; Settings &rsaquo; Advanced Settings &rsaquo; Channel ID</strong>.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dmg_featured_video_url">Featured Video Override <span style="font-weight:400">(optional)</span></label></th>
					<td>
						<input type="url" id="dmg_featured_video_url" name="dmg_featured_video_url"
							value="<?php echo esc_attr( get_option( 'dmg_featured_video_url', '' ) ); ?>"
							class="regular-text"
							placeholder="https://www.youtube.com/watch?v=..." />
						<p class="description">If set, this video is pinned as the hero video instead of the latest from the channel feed.</p>
					</td>
				</tr>
			</table>
			<?php submit_button( 'Save Settings' ); ?>
		</form>
	</div>
	<?php
}

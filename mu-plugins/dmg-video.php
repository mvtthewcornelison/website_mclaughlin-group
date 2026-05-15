<?php
/**
 * Plugin Name: The McLaughlin Group - Featured Video
 * Description: Manages the featured YouTube video URL and channel URL displayed on the homepage.
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

function dmg_video_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( isset( $_POST['dmg_video_settings_nonce'] ) && wp_verify_nonce( $_POST['dmg_video_settings_nonce'], 'dmg_video_settings_save' ) ) {
		if ( isset( $_POST['dmg_featured_video_url'] ) ) {
			update_option( 'dmg_featured_video_url', sanitize_url( wp_unslash( $_POST['dmg_featured_video_url'] ) ) );
		}
		if ( isset( $_POST['dmg_youtube_channel_url'] ) ) {
			update_option( 'dmg_youtube_channel_url', sanitize_url( wp_unslash( $_POST['dmg_youtube_channel_url'] ) ) );
		}
		echo '<div class="notice notice-success is-dismissible"><p>Settings saved.</p></div>';
	}
	?>
	<div class="wrap">
		<h1>Featured Video</h1>
		<form method="post" action="">
			<?php wp_nonce_field( 'dmg_video_settings_save', 'dmg_video_settings_nonce' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="dmg_featured_video_url">Featured Video URL</label></th>
					<td>
						<input type="url" id="dmg_featured_video_url" name="dmg_featured_video_url"
							value="<?php echo esc_attr( get_option( 'dmg_featured_video_url', '' ) ); ?>"
							class="regular-text"
							placeholder="https://www.youtube.com/watch?v=..." />
						<p class="description">The YouTube video URL to feature on the homepage &ldquo;Latest from Dave&rdquo; section. Paste the full watch URL (e.g. <code>https://www.youtube.com/watch?v=dQw4w9WgXcQ</code>).</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dmg_youtube_channel_url">YouTube Channel URL</label></th>
					<td>
						<input type="url" id="dmg_youtube_channel_url" name="dmg_youtube_channel_url"
							value="<?php echo esc_attr( get_option( 'dmg_youtube_channel_url', '' ) ); ?>"
							class="regular-text"
							placeholder="https://www.youtube.com/@channel" />
						<p class="description">Dave&rsquo;s YouTube channel URL. Used for the &ldquo;See All Videos&rdquo; link on the homepage (e.g. <code>https://www.youtube.com/@DaveMcLaughlin</code>).</p>
					</td>
				</tr>
			</table>
			<?php submit_button( 'Save Settings' ); ?>
		</form>
	</div>
	<?php
}

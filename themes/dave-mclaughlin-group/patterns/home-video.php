<?php
/**
 * Title: Latest Video
 * Slug: dmg/home-video
 * Categories: featured
 * Inserter: false
 */

$video_url   = get_option( 'dmg_featured_video_url', '' );
$channel_url = get_option( 'dmg_youtube_channel_url', '' );

// Build embed HTML if a video URL is set.
$embed_html = '';
if ( $video_url ) {
	$embed_html = wp_oembed_get( $video_url, [ 'width' => 1000 ] );

	// Fallback: build a direct <iframe> if oembed returns nothing.
	if ( ! $embed_html ) {
		// Convert watch URL to embed URL.
		// Handles: https://www.youtube.com/watch?v=VIDEO_ID
		//          https://youtu.be/VIDEO_ID
		$embed_src = '';
		if ( preg_match( '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_\-]+)/', $video_url, $matches ) ) {
			$embed_src = 'https://www.youtube.com/embed/' . $matches[1];
		} else {
			// Best-effort: replace watch?v= with embed/
			$embed_src = str_replace( 'watch?v=', 'embed/', $video_url );
		}
		$embed_html = '<div class="dmg-video-ratio"><iframe src="' . esc_url( $embed_src ) . '" title="Latest video from Dave" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>';
	} else {
		// Wrap oembed output in ratio container so it is also responsive.
		$embed_html = '<div class="dmg-video-ratio dmg-video-ratio--oembed">' . $embed_html . '</div>';
	}
}
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem","left":"2rem","right":"2rem"}}},"backgroundColor":"gray-900","textColor":"white","layout":{"type":"constrained","contentSize":"960px"}} -->
<section class="wp-block-group alignfull has-white-color has-gray-900-background-color has-text-color has-background" style="padding-top:5rem;padding-right:2rem;padding-bottom:5rem;padding-left:2rem;text-align:center">

	<!-- wp:html -->
	<style>
		.dmg-video-section-heading {
			font-size: var(--wp--preset--font-size--xx-large);
			font-weight: 700;
			color: #fff;
			letter-spacing: -0.015em;
			line-height: 1.1;
			margin: 0 0 2.5rem;
		}
		.dmg-video-embed-wrap {
			max-width: 900px;
			margin: 0 auto 2rem;
		}
		/* 16:9 aspect-ratio wrapper */
		.dmg-video-ratio {
			position: relative;
			width: 100%;
			padding-bottom: 56.25%;
			height: 0;
			overflow: hidden;
			background: #000;
		}
		.dmg-video-ratio iframe,
		.dmg-video-ratio--oembed iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			border: 0;
		}
		/* oembed wraps an extra div — flatten it */
		.dmg-video-ratio--oembed > * {
			position: absolute;
			top: 0;
			left: 0;
			width: 100% !important;
			height: 100% !important;
		}
		.dmg-video-admin-notice {
			background: #fffbe6;
			border-left: 4px solid #f0c000;
			color: #3c3c00;
			padding: 1rem 1.25rem;
			max-width: 600px;
			margin: 0 auto 2rem;
			text-align: left;
			font-size: 0.9375rem;
			border-radius: 2px;
		}
		.dmg-video-viewall {
			display: inline-flex;
			align-items: center;
			gap: 0.4rem;
			font-size: 0.9375rem;
			font-weight: 600;
			letter-spacing: 0.005em;
			color: #fff;
			text-decoration: none;
			border: 1px solid #fff;
			padding: 0.875rem 1.75rem;
			transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease;
		}
		.dmg-video-viewall:hover {
			background: #fff;
			color: #1A1A1A;
		}
	</style>

	<h2 class="dmg-video-section-heading">Latest from Dave</h2>

	<?php if ( $video_url ) : ?>
		<div class="dmg-video-embed-wrap">
			<?php echo $embed_html; // Already constructed with esc_url above. ?>
		</div>
	<?php elseif ( is_user_logged_in() ) : ?>
		<div class="dmg-video-admin-notice">
			<strong>No featured video set.</strong> Visit <a href="<?php echo esc_url( admin_url( 'options-general.php?page=dmg-video-settings' ) ); ?>">Settings &rsaquo; Featured Video</a> to add one.
		</div>
	<?php endif; ?>

	<div>
		<?php if ( $channel_url ) : ?>
			<a class="dmg-video-viewall" href="<?php echo esc_url( $channel_url ); ?>" target="_blank" rel="noopener noreferrer">
				See All Videos
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
			</a>
		<?php else : ?>
			<!-- TODO: Set YouTube channel URL in Settings > Featured Video -->
			<a class="dmg-video-viewall" href="#">
				See All Videos
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
			</a>
		<?php endif; ?>
	</div>
	<!-- /wp:html -->

</section>
<!-- /wp:group -->

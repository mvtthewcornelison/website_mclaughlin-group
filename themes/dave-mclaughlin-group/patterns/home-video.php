<?php
/**
 * Title: Latest Videos
 * Slug: dmg/home-video
 * Categories: featured
 * Inserter: false
 */

$channel_url  = get_option( 'dmg_youtube_channel_url', '' );
$override_url = get_option( 'dmg_featured_video_url', '' );
$videos       = function_exists( 'dmg_get_youtube_videos' ) ? dmg_get_youtube_videos( 4 ) : [];

// Determine hero and secondary videos.
$hero      = null;
$secondary = [];

if ( $override_url && preg_match( '~(?:youtube\.com/watch\?v=|youtu\.be/)([a-zA-Z0-9_\-]+)~', $override_url, $m ) ) {
	$hero      = [ 'id' => $m[1], 'title' => '' ];
	$secondary = array_slice( $videos, 0, 3 );
} elseif ( $videos ) {
	$hero      = $videos[0];
	$secondary = array_slice( $videos, 1, 3 );
}
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem","left":"2rem","right":"2rem"}}},"backgroundColor":"gray-900","textColor":"white","layout":{"type":"constrained","contentSize":"960px"}} -->
<section class="wp-block-group alignfull has-white-color has-gray-900-background-color has-text-color has-background" style="padding-top:5rem;padding-right:2rem;padding-bottom:5rem;padding-left:2rem">

<!-- wp:html -->
<style>
.dmg-video-heading {
	font-size: var(--wp--preset--font-size--xx-large);
	font-weight: 700;
	color: #fff;
	letter-spacing: -0.015em;
	line-height: 1.1;
	margin: 0 0 2.5rem;
	text-align: center;
}
.dmg-video-hero {
	max-width: 860px;
	margin: 0 auto 1rem;
}
.dmg-video-card {
	position: relative;
	aspect-ratio: 16 / 9;
	overflow: hidden;
	background: #000;
	cursor: pointer;
	display: block;
	width: 100%;
	border: 0;
	padding: 0;
	color: inherit;
	font: inherit;
	text-align: inherit;
}
.dmg-video-card:focus-visible {
	outline: 3px solid #fff;
	outline-offset: 3px;
}
.dmg-video-card img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.3s ease;
}
.dmg-video-card:hover img {
	transform: scale(1.03);
}
.dmg-video-play {
	position: absolute;
	inset: 0;
	display: flex;
	align-items: center;
	justify-content: center;
	background: rgba(0, 0, 0, 0.15);
	transition: background 0.2s ease;
}
.dmg-video-card:hover .dmg-video-play {
	background: rgba(0, 0, 0, 0.28);
}
.dmg-video-play svg {
	filter: drop-shadow(0 2px 12px rgba(0, 0, 0, 0.5));
	transition: transform 0.2s ease;
}
.dmg-video-card:hover .dmg-video-play svg {
	transform: scale(1.1);
}
.dmg-video-hero-title {
	margin: 0.625rem 0 1.25rem;
	font-size: 1rem;
	color: rgba(255, 255, 255, 0.65);
	text-align: left;
}
.dmg-video-row {
	max-width: 860px;
	margin: 0 auto 2.5rem;
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 1rem;
}
.dmg-video-card-title {
	margin: 0.5rem 0 0;
	font-size: 0.875rem;
	color: rgba(255, 255, 255, 0.7);
	text-align: left;
	overflow: hidden;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
	line-height: 1.4;
}
.dmg-video-actions {
	text-align: center;
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
	transition: background 0.2s ease, color 0.2s ease;
}
.dmg-video-viewall:hover {
	background: #fff;
	color: #1a1a1a;
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
@media (max-width: 640px) {
	.dmg-video-row {
		grid-template-columns: 1fr;
	}
}
</style>

<h2 class="dmg-video-heading">Our Latest Videos</h2>

<?php if ( $hero ) : ?>

	<?php
	$hero_id       = esc_attr( $hero['id'] );
	$hero_title    = $hero['title'] ? esc_attr( $hero['title'] ) : 'Latest video';
	$hero_src_max  = esc_url( 'https://i.ytimg.com/vi/' . $hero['id'] . '/maxresdefault.jpg' );
	$hero_src_hq   = esc_url( 'https://i.ytimg.com/vi/' . $hero['id'] . '/hqdefault.jpg' );
	?>

	<div class="dmg-video-hero">
		<button
			type="button"
			class="dmg-video-card"
			data-video-id="<?php echo $hero_id; ?>"
			data-video-title="<?php echo $hero_title; ?>"
			aria-label="<?php echo $hero['title'] ? 'Play: ' . $hero_title : 'Play video'; ?>"
		>
			<img
				src="<?php echo $hero_src_max; ?>"
				onerror="this.src='<?php echo $hero_src_hq; ?>'"
				alt="<?php echo $hero_title; ?>"
				loading="eager"
			/>
			<div class="dmg-video-play" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 72 72">
					<circle cx="36" cy="36" r="36" fill="rgba(178,0,0,0.9)"/>
					<polygon points="29,22 55,36 29,50" fill="#fff"/>
				</svg>
			</div>
		</button>
		<?php if ( $hero['title'] ) : ?>
			<p class="dmg-video-hero-title"><?php echo esc_html( $hero['title'] ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( $secondary ) : ?>
	<div class="dmg-video-row">
		<?php foreach ( $secondary as $video ) :
			$vid_id    = esc_attr( $video['id'] );
			$vid_title = esc_attr( $video['title'] );
			$thumb     = esc_url( 'https://i.ytimg.com/vi/' . $video['id'] . '/hqdefault.jpg' );
		?>
			<div>
				<button
					type="button"
					class="dmg-video-card"
					data-video-id="<?php echo $vid_id; ?>"
					data-video-title="<?php echo $vid_title; ?>"
					aria-label="Play: <?php echo $vid_title; ?>"
				>
					<img
						src="<?php echo $thumb; ?>"
						alt="<?php echo $vid_title; ?>"
						loading="lazy"
					/>
					<div class="dmg-video-play" aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44">
							<circle cx="22" cy="22" r="22" fill="rgba(178,0,0,0.9)"/>
							<polygon points="17,12 34,22 17,32" fill="#fff"/>
						</svg>
					</div>
				</button>
				<?php if ( $video['title'] ) : ?>
					<p class="dmg-video-card-title"><?php echo esc_html( $video['title'] ); ?></p>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

<?php elseif ( is_user_logged_in() ) : ?>
	<div class="dmg-video-admin-notice">
		<strong>No videos found.</strong> Visit <a href="<?php echo esc_url( admin_url( 'options-general.php?page=dmg-video-settings' ) ); ?>">Settings &rsaquo; Featured Video</a> to enter your YouTube Channel URL and Channel ID.
	</div>
<?php endif; ?>

<?php if ( $channel_url ) : ?>
<div class="dmg-video-actions">
	<a class="dmg-video-viewall" href="<?php echo esc_url( $channel_url ); ?>" target="_blank" rel="noopener noreferrer">
		See All Videos
		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
	</a>
</div>
<?php endif; ?>

<script>
(function () {
	document.querySelectorAll('.dmg-video-card').forEach(function (button) {
		function playVideo() {
			var id = button.dataset.videoId;
			var title = button.dataset.videoTitle || 'Video';
			var wrapper = document.createElement('div');
			var iframe = document.createElement('iframe');
			iframe.src = 'https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0';
			iframe.title = 'YouTube video player: ' + title;
			iframe.setAttribute('allowfullscreen', '');
			iframe.setAttribute('allow', 'autoplay; encrypted-media; gyroscope; picture-in-picture');
			iframe.setAttribute('tabindex', '-1');
			wrapper.className = 'dmg-video-card dmg-video-player';
			iframe.style.cssText = 'position:absolute;top:0;left:0;width:100%;height:100%;border:0';
			wrapper.style.cursor = 'default';
			wrapper.appendChild(iframe);
			button.replaceWith(wrapper);
			iframe.focus();
		}
		button.addEventListener('click', playVideo);
	});
}());
</script>
<!-- /wp:html -->

</section>
<!-- /wp:group -->

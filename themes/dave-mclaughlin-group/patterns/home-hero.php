<?php
/**
 * Title: Home Hero
 * Slug: dmg/home-hero
 * Categories: featured
 * Inserter: false
 */

$video_url  = esc_url( get_theme_file_uri( 'assets/video/hero-loop.mp4' ) );
$poster_url = esc_url( get_theme_file_uri( 'assets/video/hero-poster.jpg' ) );
?>
<!-- wp:cover {"url":"<?php echo $video_url; ?>","useFeaturedImage":false,"dimRatio":55,"overlayColor":"black","backgroundType":"video","minHeight":90,"minHeightUnit":"vh","contentPosition":"center center","align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:90vh">
	<span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-55 has-background-dim"></span>
	<video class="wp-block-cover__video-background intrinsic-ignore" autoplay muted loop playsinline poster="<?php echo $poster_url; ?>" src="<?php echo $video_url; ?>" data-object-fit="cover"></video>
	<div class="wp-block-cover__inner-container">

		<!-- wp:heading {"textAlign":"center","level":1,"textColor":"white","style":{"typography":{"fontWeight":"700","letterSpacing":"-0.02em","lineHeight":"1.05"}}} -->
		<h1 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-style:normal;font-weight:700;letter-spacing:-0.02em;line-height:1.05">The McLaughlin Group</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","textColor":"white","style":{"typography":{"fontSize":"1.125rem","letterSpacing":"0.02em","lineHeight":"1.5"},"spacing":{"margin":{"top":"1rem","bottom":"3rem"}}}} -->
		<p class="has-text-align-center has-white-color has-text-color" style="margin-top:1rem;margin-bottom:3rem;font-size:1.125rem;letter-spacing:0.02em;line-height:1.5">Agoura Hills realtor with 30 years of experience and over $600M in home sales.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"},"style":{"spacing":{"blockGap":{"top":"1rem","left":"1rem"}}}} -->
		<div class="wp-block-buttons">

			<!-- wp:button {"backgroundColor":"white","textColor":"black","style":{"border":{"radius":"0px"},"typography":{"fontWeight":"500","letterSpacing":"0.02em"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"1.75rem","right":"1.75rem"}}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:0px;padding-top:0.875rem;padding-right:1.75rem;padding-bottom:0.875rem;padding-left:1.75rem;font-weight:500;letter-spacing:0.02em" href="/listings/">Open Listings</a></div>
			<!-- /wp:button -->

			<!-- wp:button {"backgroundColor":"white","textColor":"black","style":{"border":{"radius":"0px"},"typography":{"fontWeight":"500","letterSpacing":"0.02em"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"1.75rem","right":"1.75rem"}}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:0px;padding-top:0.875rem;padding-right:1.75rem;padding-bottom:0.875rem;padding-left:1.75rem;font-weight:500;letter-spacing:0.02em" href="/contact-us/?subject=Sell%20my%20home&amp;source=sell-my-home">Sell my home</a></div>
			<!-- /wp:button -->

		</div>
		<!-- /wp:buttons -->

	</div>
</div>
<!-- /wp:cover -->

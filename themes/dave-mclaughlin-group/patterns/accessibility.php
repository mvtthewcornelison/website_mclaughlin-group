<?php
/**
 * Title: Accessibility Statement
 * Slug: dmg/accessibility
 * Categories: featured
 * Inserter: false
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"6rem","left":"2rem","right":"2rem"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<section class="wp-block-group alignfull" style="padding-top:5rem;padding-right:2rem;padding-bottom:6rem;padding-left:2rem">

	<!-- wp:heading {"level":1,"style":{"typography":{"fontWeight":"700","lineHeight":"1.1","fontSize":"clamp(2rem, 4vw, 3rem)"},"spacing":{"margin":{"top":"0","bottom":"1.5rem"}}},"textColor":"gray-900"} -->
	<h1 class="wp-block-heading has-gray-900-color has-text-color" style="margin-top:0;margin-bottom:1.5rem;font-size:clamp(2rem, 4vw, 3rem);font-weight:700;line-height:1.1">Accessibility</h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.0625rem","lineHeight":"1.75"},"spacing":{"margin":{"top":"0","bottom":"1.25rem"}}},"textColor":"gray-800"} -->
	<p class="has-gray-800-color has-text-color" style="margin-top:0;margin-bottom:1.25rem;font-size:1.0625rem;line-height:1.75">The McLaughlin Group is working to make this website usable for all visitors. Our current accessibility work is guided by the Web Content Accessibility Guidelines (WCAG) 2.2 Level AA.</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.0625rem","lineHeight":"1.75"},"spacing":{"margin":{"top":"0","bottom":"1.25rem"}}},"textColor":"gray-800"} -->
	<p class="has-gray-800-color has-text-color" style="margin-top:0;margin-bottom:1.25rem;font-size:1.0625rem;line-height:1.75">We review the site as content and features change, including forms, listing photos, navigation, videos, and third-party embeds. Some content, such as video captions or externally hosted tools, may depend on providers outside of this site.</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"1.35rem","fontWeight":"700"},"spacing":{"margin":{"top":"2rem","bottom":"0.75rem"}}},"textColor":"gray-900"} -->
	<h2 class="wp-block-heading has-gray-900-color has-text-color" style="margin-top:2rem;margin-bottom:0.75rem;font-size:1.35rem;font-weight:700">Need Help?</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.0625rem","lineHeight":"1.75"},"spacing":{"margin":{"top":"0","bottom":"1.25rem"}}},"textColor":"gray-800"} -->
	<p class="has-gray-800-color has-text-color" style="margin-top:0;margin-bottom:1.25rem;font-size:1.0625rem;line-height:1.75">If you have trouble using any part of this website, please contact us and include the page address, the issue you encountered, and the assistive technology or browser you were using if applicable.</p>
	<!-- /wp:paragraph -->

	<!-- wp:list {"style":{"typography":{"fontSize":"1rem","lineHeight":"1.7"}},"textColor":"gray-800"} -->
	<ul class="has-gray-800-color has-text-color" style="font-size:1rem;line-height:1.7">
		<!-- wp:list-item -->
		<li>Phone: <a href="tel:+18182597775">(818) 259-7775</a></li>
		<!-- /wp:list-item -->
		<!-- wp:list-item -->
		<li>Email: <a href="mailto:<?php echo esc_attr( dmg_contact_recipient_email() ); ?>"><?php echo esc_html( dmg_contact_recipient_email() ); ?></a></li>
		<!-- /wp:list-item -->
		<!-- wp:list-item -->
		<li>Contact form: <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">Contact Us</a></li>
		<!-- /wp:list-item -->
	</ul>
	<!-- /wp:list -->

</section>
<!-- /wp:group -->

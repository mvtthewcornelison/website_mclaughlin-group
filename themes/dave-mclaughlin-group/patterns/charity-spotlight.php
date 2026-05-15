<?php
/**
 * Title: Charity Spotlight
 * Slug: dmg/charity-spotlight
 * Categories: featured
 * Inserter: true
 * Description: Reusable block for highlighting a charity or giving-back initiative.
 */
?>
<!--
================================================================================
CHARITY SPOTLIGHT PATTERN - HOW TO UPDATE IN THE BLOCK EDITOR
================================================================================

This pattern displays a featured charity with logo, name, description, and QR code.

FINDING THIS PATTERN:
  • Open the page/post where you want to add this pattern
  • Click the + icon in the Block Editor toolbar
  • Click "Patterns" tab
  • Search for "Charity Spotlight" or browse the "Featured" category
  • Click to insert

UPDATING THE CONTENT IN THE BLOCK EDITOR:

1. CHARITY LOGO:
   • Find the logo image (top-left)
   • Double-click the logo image to select it
   • In the image block, use the "Replace" button or pencil icon
   • Upload or select the charity logo from Media > Library
   • The image will fill to ~120px width automatically

2. CHARITY NAME:
   • Find the heading "Royal Family Kids Camp"
   • Click to edit the text
   • Replace with your charity name

3. DESCRIPTION:
   • Find the paragraph below the charity name
   • Click to edit the text
   • Replace with 2–3 sentences about the charity and mission

4. QR CODE IMAGE:
   • Find the QR code image (bottom-right)
   • Double-click to select it
   • Use the "Replace" button to upload a new QR code
   • Upload or select the QR code from Media > Library

5. OPTIONAL CTA BUTTON (currently hidden):
   • See the PHP comment below in the HTML code
   • To enable the button, ask a developer to uncomment the button HTML section
   • Or in a future version, the button will be editable in the UI

================================================================================
 -->

<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem","left":"2rem","right":"2rem"}}},"backgroundColor":"gray-50","layout":{"type":"constrained","contentSize":"880px"}} -->
<section class="wp-block-group alignfull has-gray-50-background-color has-background" style="padding-top:5rem;padding-right:2rem;padding-bottom:5rem;padding-left:2rem;background-color:var(--wp--preset--color--gray-50)">

	<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"2.5rem","margin":{"top":"0","bottom":"0"}}}} -->
	<div class="wp-block-group">

		<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","orientation":"vertical","verticalAlignment":"top"},"style":{"spacing":{"blockGap":"1.25rem"}}} -->
		<div class="wp-block-group">

			<!-- wp:image {"sizeSlug":"full","style":{"max-width":"120px"}} -->
			<figure class="wp-block-image size-full" style="max-width:120px">
				<!-- PLACEHOLDER: Upload charity logo via Media > Library, then paste the URL here -->
				<img src="" alt="Charity logo" />
			</figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"700","fontSize":"1.5rem","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
			<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:0;font-size:1.5rem;font-weight:700;letter-spacing:-0.01em">Royal Family Kids Camp</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.0625rem","lineHeight":"1.7"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"gray-700"} -->
			<p class="has-gray-700-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.0625rem;line-height:1.7">Royal Family Kids Camp serves children from low-income families across Southern California, providing a week of summer camp experiences, mentorship, and community connection. For three generations, the McLaughlin Group has been proud to support their mission of empowering the next generation.</p>
			<!-- /wp:paragraph -->

			<?php /* OPTIONAL CTA: Uncomment the HTML button below to enable the "Learn More" link. Update the href="#" with your desired URL. */ ?>
			<!-- <div style="margin-top:1.5rem">
				<a href="#" class="dmg-btn-primary" style="display:inline-flex">Learn More</a>
			</div> -->

		</div>
		<!-- /wp:group -->

		<!-- wp:image {"sizeSlug":"full","style":{"max-width":"160px"}} -->
		<figure class="wp-block-image size-full" style="max-width:160px">
			<!-- PLACEHOLDER: Upload QR code via Media > Library, then paste URL here -->
			<img src="" alt="QR code" />
		</figure>
		<!-- /wp:image -->

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->

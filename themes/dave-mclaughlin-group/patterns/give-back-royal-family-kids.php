<?php
/**
 * Title: Give Back - Royal Family Kids
 * Slug: dmg/give-back-royal-family-kids
 * Categories: featured
 * Inserter: false
 */

$image_url = get_theme_file_uri( 'assets/images/give-back/royal-family-kids.webp' );
$qr_url    = content_url( '/uploads/2026/05/royal-family-kids-qr.png' );
?>

<!-- wp:html -->
<style>
	.dmg-rfk-wrap { padding-bottom: 6rem; }

	/* Title section */
	.dmg-rfk-title-section {
		max-width: 880px;
		margin: 0 auto;
		padding: 5rem 2rem 3rem;
		text-align: center;
	}
	.dmg-rfk-eyebrow-row {
		display: inline-flex;
		align-items: center;
		gap: 0.625rem;
		margin: 0 0 1.25rem;
	}
	.dmg-rfk-eyebrow-icon {
		display: inline-flex;
		color: var(--wp--preset--color--primary);
	}
	.dmg-rfk-eyebrow {
		margin: 0;
		font-size: 0.8125rem;
		font-weight: 600;
		letter-spacing: 0.25em;
		text-transform: uppercase;
		color: var(--wp--preset--color--gray-500);
	}
	.dmg-rfk-title {
		font-size: clamp(2.25rem, 5vw, 3.5rem);
		line-height: 1.05;
		letter-spacing: -0.02em;
		font-weight: 700;
		color: var(--wp--preset--color--gray-900);
		margin: 0;
	}

	/* Image */
	.dmg-rfk-image-wrap {
		max-width: 1180px;
		margin: 0 auto;
		padding: 0 2rem;
	}
	.dmg-rfk-image {
		display: block;
		width: 100%;
		max-width: 100%;
		height: auto;
		border: 1px solid var(--wp--preset--color--gray-100);
	}

	/* About section */
	.dmg-rfk-about {
		max-width: 760px;
		margin: 4rem auto 0;
		padding: 0 2rem;
	}
	.dmg-rfk-about-eyebrow {
		text-align: center;
		font-size: 0.6875rem;
		font-weight: 700;
		letter-spacing: 0.22em;
		text-transform: uppercase;
		color: var(--wp--preset--color--primary);
		margin: 0 0 0.75rem;
	}
	.dmg-rfk-about-heading {
		text-align: center;
		font-size: clamp(1.5rem, 3vw, 2rem);
		font-weight: 700;
		line-height: 1.2;
		letter-spacing: -0.01em;
		color: var(--wp--preset--color--gray-900);
		margin: 0 0 2rem;
	}
	.dmg-rfk-about-body p {
		font-size: 1.0625rem;
		line-height: 1.8;
		color: var(--wp--preset--color--gray-800);
		margin: 0 0 1.25rem;
	}
	.dmg-rfk-about-body p:last-child { margin-bottom: 0; }

	/* Donate callout */
	.dmg-rfk-donate {
		max-width: 1080px;
		margin: 4.5rem auto 0;
		padding: 3rem 2.5rem;
		background: #fff;
		border: 1px solid var(--wp--preset--color--gray-100);
		display: grid;
		grid-template-columns: 1.1fr 1fr;
		gap: 3rem;
		align-items: center;
	}
	.dmg-rfk-donate-text { text-align: left; }
	.dmg-rfk-donate-eyebrow {
		font-size: 0.6875rem;
		font-weight: 700;
		letter-spacing: 0.22em;
		text-transform: uppercase;
		color: var(--wp--preset--color--primary);
		margin: 0 0 1rem;
	}
	.dmg-rfk-donate-heading {
		font-size: clamp(1.25rem, 2.5vw, 1.625rem);
		font-weight: 700;
		line-height: 1.25;
		letter-spacing: -0.005em;
		color: var(--wp--preset--color--gray-900);
		margin: 0 0 1rem;
	}
	.dmg-rfk-donate-note {
		font-size: 1rem;
		line-height: 1.65;
		color: var(--wp--preset--color--gray-700);
		margin: 0 0 1.25rem;
	}
	.dmg-rfk-memo {
		display: inline-block;
		padding: 0.85rem 1.1rem;
		background: var(--wp--preset--color--gray-50);
		border-left: 3px solid var(--wp--preset--color--primary);
		font-size: 1rem;
		font-weight: 700;
		color: var(--wp--preset--color--gray-900);
		line-height: 1.45;
	}

	/* QR placeholder */
	.dmg-rfk-qr-wrap {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		gap: 0.85rem;
	}
	.dmg-rfk-qr {
		width: 180px;
		height: 180px;
		display: block;
	}
	.dmg-rfk-qr-label {
		font-size: 0.75rem;
		font-weight: 700;
		letter-spacing: 0.18em;
		text-transform: uppercase;
		color: var(--wp--preset--color--gray-700);
		margin: 0;
	}

	@media (max-width: 800px) {
		.dmg-rfk-donate {
			grid-template-columns: 1fr;
			gap: 2.5rem;
			padding: 2.25rem 1.75rem;
		}
		.dmg-rfk-donate-text { text-align: center; }
		.dmg-rfk-memo { display: block; }
	}
	@media (max-width: 600px) {
		.dmg-rfk-title-section { padding: 3.5rem 1.25rem 2.5rem; }
		.dmg-rfk-image-wrap { padding: 0 1.25rem; }
		.dmg-rfk-about { padding: 0 1.25rem; margin-top: 3rem; }
		.dmg-rfk-donate { margin: 3rem 1.25rem 0; padding: 2rem 1.5rem; }
	}
</style>
<!-- /wp:html -->

<!-- wp:html -->
<div class="dmg-rfk-wrap">

	<!-- Title section -->
	<section class="dmg-rfk-title-section">
		<div class="dmg-rfk-eyebrow-row">
			<span class="dmg-rfk-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16"/><path d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"/><path d="m2 15 6 6"/><path d="M19.5 8.5c.7-.7 1.5-1.6 1.5-2.7A2.73 2.73 0 0 0 16 4a2.78 2.78 0 0 0-5 1.8c0 1.2.8 2 1.5 2.8L16 12Z"/></svg>
			</span>
			<p class="dmg-rfk-eyebrow">We give back</p>
		</div>
		<h1 class="dmg-rfk-title">A chance to give back to the community</h1>
	</section>

	<!-- Image -->
	<div class="dmg-rfk-image-wrap">
		<img class="dmg-rfk-image" src="<?php echo esc_url( $image_url ); ?>" alt="Royal Family Kids Camp" loading="lazy" />
	</div>

	<!-- About -->
	<section class="dmg-rfk-about">
		<p class="dmg-rfk-about-eyebrow">About the camp</p>
		<h2 class="dmg-rfk-about-heading">Royal Family Kids Camp</h2>
		<div class="dmg-rfk-about-body">
			<p>Royal Family Kids Camp is an overnight summer camp for children ages 7 to 11 who have experienced foster care in Ventura and Los Angeles County. Our mission is to create a safe, fun, and life-giving week where each child is seen, valued, and celebrated. Many of the children who come to camp have experienced instability and hardship at a young age.</p>
		</div>
	</section>

	<!-- Donate callout + QR -->
	<section class="dmg-rfk-donate" aria-label="How to donate">
		<div class="dmg-rfk-donate-text">
			<p class="dmg-rfk-donate-eyebrow">How to donate</p>
			<h3 class="dmg-rfk-donate-heading">Support a child's week at camp</h3>
			<p class="dmg-rfk-donate-note">Every gift helps a child experience a week of safety, fun, and being celebrated. When you donate, please include a short note in the memo so the team can credit the contribution.</p>
			<span class="dmg-rfk-memo">Please write &ldquo;Dave McLaughlin KW&rdquo; in the memo when donating.</span>
		</div>

		<div class="dmg-rfk-qr-wrap">
			<img class="dmg-rfk-qr" src="<?php echo esc_url( $qr_url ); ?>" alt="QR code to donate to Royal Family Kids Camp" width="180" height="180" loading="lazy" />
			<p class="dmg-rfk-qr-label">Scan to donate</p>
		</div>
	</section>

</div>
<!-- /wp:html -->

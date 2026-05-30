<?php
/**
 * Title: Site Footer
 * Slug: dmg/footer
 * Categories: featured
 * Inserter: false
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"2rem","right":"2rem"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"gray-50","layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group alignfull has-gray-50-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:2rem;padding-bottom:0;padding-left:2rem">
	<!-- wp:html -->
	<style>
		.dmg-footer {
			padding: 4rem 0 3rem;
			color: var(--wp--preset--color--gray-900);
			font-family: var(--wp--preset--font-family--sans);
		}
		.dmg-footer-grid {
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 2rem;
		}
		.dmg-footer-card {
			display: flex;
			flex-direction: column;
			align-items: flex-start;
			gap: 1.25rem;
			width: fit-content;
			max-width: 100%;
			justify-self: center;
		}
		.dmg-footer-logo {
			padding: 0 0.25rem;
			height: 72px;
		}
		.dmg-footer-logo img {
			display: block;
			max-height: 100%;
			max-width: 280px;
			width: auto;
			height: auto;
		}
		.dmg-footer-copy {
			padding: 0 0.25rem;
			font-size: 0.95rem;
			line-height: 1.75;
			color: var(--wp--preset--color--gray-700);
		}
		.dmg-footer-copy p { margin: 0; }
		.dmg-footer-copy strong {
			display: block;
			font-size: 1rem;
			line-height: 1.5;
			color: var(--wp--preset--color--gray-900);
			margin-bottom: 0.35rem;
		}
		.dmg-footer-copy a {
			color: var(--wp--preset--color--gray-900);
			text-decoration: none;
		}
		.dmg-footer-copy a:hover {
			color: var(--wp--preset--color--primary);
		}
		.dmg-footer-note {
			margin-top: 2.75rem;
			padding-top: 1.25rem;
			border-top: 1px solid var(--wp--preset--color--gray-100);
			font-size: 0.8125rem;
			letter-spacing: 0.08em;
			text-transform: uppercase;
			color: var(--wp--preset--color--gray-500);
			text-align: center;
		}
		.dmg-footer-note a {
			color: inherit;
			text-decoration: none;
			border-bottom: 1px solid currentColor;
		}
		.dmg-footer-note a:hover {
			color: var(--wp--preset--color--primary);
		}
		@media (max-width: 800px) {
			.dmg-footer { padding: 3rem 0 2.5rem; }
			.dmg-footer-grid { grid-template-columns: 1fr; }
		}
	</style>

	<div class="dmg-footer">
		<div class="dmg-footer-grid">
			<div class="dmg-footer-card">
				<div class="dmg-footer-logo">
					<img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/footer/logo-full-tmg.png' ) ); ?>" alt="The McLaughlin Group logo" loading="lazy" />
				</div>
				<div class="dmg-footer-copy">
					<p>
						<strong>Specializing in Custom Homes<br />Throughout Los Angeles and Ventura Counties</strong>
						Dave McLaughlin | DRE# 01523573<br />
						<a href="tel:+18182597775">(818) 259-7775</a>
					</p>
				</div>
			</div>

			<div class="dmg-footer-card">
				<div class="dmg-footer-logo">
					<img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/footer/logo-kw-westlake-village.png' ) ); ?>" alt="Keller Williams Westlake Village logo" loading="lazy" />
				</div>
				<div class="dmg-footer-copy">
					<p>
						<strong>2475 Townsgate Road, Suite 160<br />Westlake Village, CA 91361</strong>
						Office <a href="tel:+18057777777">(805) 777-7777</a><br />
						<a href="mailto:klrw207@kw.com">klrw207@kw.com</a>
					</p>
				</div>
			</div>
		</div>

		<div class="dmg-footer-note">The McLaughlin Group · <a href="<?php echo esc_url( home_url( '/accessibility/' ) ); ?>">Accessibility</a></div>
	</div>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->

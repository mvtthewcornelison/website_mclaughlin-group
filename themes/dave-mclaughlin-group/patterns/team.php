<?php
/**
 * Title: Team
 * Slug: dmg/team
 * Categories: featured
 * Inserter: false
 */

$team = [
	[
		'name'   => 'Dave McLaughlin',
		'title'  => 'Realtor / Team Lead',
		'image'  => get_theme_file_uri( 'assets/images/team/dave-mclaughlin.jpg' ),
		'phone'  => '818-290-7775',
		'email'  => 'ddmclaugh@aol.com',
		'dre'    => '01523573',
		'rating' => '5/5 average on Google & Zillow',
	],
	[
		'name'   => 'Emily Berdon',
		'title'  => 'Lead Administrator',
		'image'  => get_theme_file_uri( 'assets/images/team/emily-berdon.jpg' ),
		'phone'  => '805-870-2121',
		'email'  => 'emily@emilyberdon.com',
		'dre'    => '02166248',
		'rating' => '5/5 average on Google & Zillow',
	],
];
?>

<!-- wp:html -->
<style>
	.dmg-team-wrap { max-width: 1180px; margin: 0 auto; padding: 4.5rem 2rem 6rem; }
	.dmg-team-hero { max-width: 760px; margin: 0 auto 3rem; text-align: center; }
	.dmg-team-eyebrow-row {
		display:flex;
		align-items:center;
		justify-content:center;
		gap:0.625rem;
		margin:0 0 1rem;
	}
	.dmg-team-eyebrow-icon { display:inline-flex; color:var(--wp--preset--color--primary); }
	.dmg-team-eyebrow {
		margin:0;
		font-size:0.8125rem;
		font-weight:600;
		letter-spacing:0.25em;
		text-transform:uppercase;
		color:var(--wp--preset--color--gray-500);
	}
	.dmg-team-title { font-size: clamp(2.25rem, 5vw, 3.75rem); line-height:1.05; letter-spacing:-0.02em; font-weight:700; margin:1rem 0 1rem; }
	.dmg-team-intro { font-size:1.125rem; line-height:1.7; color:var(--wp--preset--color--gray-700); margin:0; }
	.dmg-team-grid {
		display:flex;
		flex-wrap:wrap;
		justify-content:center;
		gap:1.5rem;
		align-items:stretch;
	}
	.dmg-team-card {
		flex: 0 1 360px;
		background:#fff;
		border:1px solid var(--wp--preset--color--gray-100);
		box-shadow:0 12px 30px rgba(0,0,0,0.04);
		overflow:hidden;
		display:flex;
		flex-direction:column;
	}
	.dmg-team-media {
		aspect-ratio: 4 / 5;
		background: linear-gradient(135deg, var(--wp--preset--color--gray-100), var(--wp--preset--color--gray-50));
		position:relative;
		overflow:hidden;
	}
	.dmg-team-media img {
		width:100%;
		height:100%;
		object-fit:cover;
		display:block;
	}
	.dmg-team-placeholder {
		position:absolute;
		inset:0;
		display:flex;
		align-items:center;
		justify-content:center;
		flex-direction:column;
		gap:0.5rem;
		color:var(--wp--preset--color--gray-500);
	}
	.dmg-team-placeholder .initials {
		width:88px;
		height:88px;
		border-radius:999px;
		display:grid;
		place-items:center;
		background:rgba(178,0,0,0.08);
		color:var(--wp--preset--color--primary);
		font-size:1.6rem;
		font-weight:700;
		letter-spacing:0.06em;
	}
	.dmg-team-body { padding:1.5rem 1.5rem 1.75rem; display:flex; flex-direction:column; gap:0.5rem; }
	.dmg-team-name { margin:0; font-size:1.35rem; font-weight:700; line-height:1.15; letter-spacing:-0.01em; color:var(--wp--preset--color--gray-900); }
	.dmg-team-title-label {
		margin:0;
		font-size:0.8125rem;
		font-weight:600;
		letter-spacing:0.16em;
		text-transform:uppercase;
		color:var(--wp--preset--color--primary);
	}
	.dmg-team-info {
		list-style:none;
		margin:0.9rem 0 0;
		padding:0.9rem 0 0;
		border-top:1px solid var(--wp--preset--color--gray-100);
		display:flex;
		flex-direction:column;
		gap:0.55rem;
	}
	.dmg-team-info li {
		display:flex;
		align-items:center;
		gap:0.7rem;
		font-size:0.9375rem;
		line-height:1.4;
		color:var(--wp--preset--color--gray-800);
	}
	.dmg-team-info .dmg-team-icon {
		display:inline-flex;
		align-items:center;
		justify-content:center;
		width:32px;
		height:32px;
		flex-shrink:0;
		border-radius:8px;
		background:rgba(178,0,0,0.07);
		color:var(--wp--preset--color--primary);
	}
	.dmg-team-info .dmg-team-icon--star {
		background:rgba(251,188,5,0.14);
		color:#F4B400;
	}
	.dmg-team-info a {
		color:inherit;
		text-decoration:none;
		border-bottom:1px solid transparent;
		transition:border-color 0.15s ease, color 0.15s ease;
	}
	.dmg-team-info a:hover {
		color:var(--wp--preset--color--primary);
		border-bottom-color:var(--wp--preset--color--primary);
	}
	.dmg-team-info .dmg-team-info-label {
		font-size:0.6875rem;
		font-weight:700;
		letter-spacing:0.14em;
		text-transform:uppercase;
		color:var(--wp--preset--color--gray-500);
		margin-right:0.4rem;
	}
	.dmg-team-pitch {
		max-width: 1180px;
		margin: 1rem auto 0;
		padding: 0 2rem 6rem;
	}
	.dmg-team-pitch-inner {
		display: grid;
		grid-template-columns: 5fr 7fr;
		gap: 3.5rem;
		align-items: center;
		background: var(--wp--preset--color--gray-50);
		padding: 3.5rem;
	}
	.dmg-team-pitch-image-wrap {
		aspect-ratio: 4 / 5;
		overflow: hidden;
	}
	.dmg-team-pitch-image {
		width: 100%;
		height: 100%;
		object-fit: cover;
		display: block;
	}
	.dmg-team-pitch-eyebrow-row {
		display: flex;
		align-items: center;
		gap: 0.625rem;
		margin: 0 0 1.25rem;
	}
	.dmg-team-pitch-eyebrow-icon { display: inline-flex; color: var(--wp--preset--color--primary); }
	.dmg-team-pitch-eyebrow {
		margin: 0;
		font-size: 0.8125rem;
		font-weight: 600;
		letter-spacing: 0.25em;
		text-transform: uppercase;
		color: var(--wp--preset--color--gray-500);
	}
	.dmg-team-pitch-heading {
		font-size: clamp(1.75rem, 3.5vw, 2.5rem);
		line-height: 1.15;
		letter-spacing: -0.015em;
		font-weight: 700;
		margin: 0 0 1.25rem;
		color: var(--wp--preset--color--gray-900);
	}
	.dmg-team-pitch-body {
		font-size: 1.0625rem;
		line-height: 1.75;
		color: var(--wp--preset--color--gray-700);
		margin: 0;
	}
	@media (max-width: 900px) {
		.dmg-team-pitch-inner {
			grid-template-columns: 1fr;
			gap: 2.25rem;
			padding: 2.25rem;
		}
		.dmg-team-pitch-image-wrap { aspect-ratio: 3 / 2; }
	}
	@media (max-width: 600px) {
		.dmg-team-wrap { padding: 3.5rem 1.25rem 5rem; }
		.dmg-team-card { flex: 0 1 100%; }
		.dmg-team-pitch { padding: 0 1.25rem 4rem; }
		.dmg-team-pitch-inner { padding: 1.75rem 1.5rem; }
	}
</style>
<!-- /wp:html -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"3rem","bottom":"1rem","left":"2rem","right":"2rem"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<section class="wp-block-group alignfull" style="padding-top:3rem;padding-right:2rem;padding-bottom:1rem;padding-left:2rem">
	<div class="dmg-team-hero">
		<div class="dmg-team-eyebrow-row">
			<span class="dmg-team-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M16 20v-1a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v1"/><circle cx="10" cy="7" r="4"/><path d="M20 8v6"/><path d="M23 11h-6"/></svg>
			</span>
			<p class="dmg-team-eyebrow">Who we are</p>
		</div>
		<h1 class="dmg-team-title">The people behind The McLaughlin Group</h1>
		<p class="dmg-team-intro">A small team with deep local roots, a relationship-first approach, and a lot of practical experience in the Conejo Valley.</p>
	</div>
</section>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"1rem","bottom":"6rem","left":"2rem","right":"2rem"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<section class="wp-block-group alignfull" style="padding-top:1rem;padding-right:2rem;padding-bottom:6rem;padding-left:2rem">
	<div class="dmg-team-wrap">
		<div class="dmg-team-grid">
			<?php foreach ( $team as $member ) : ?>
				<article class="dmg-team-card">
					<div class="dmg-team-media">
						<?php if ( $member['image'] ) : ?>
							<img src="<?php echo esc_url( $member['image'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" loading="lazy" />
						<?php else : ?>
							<?php
								$parts    = preg_split( '/\s+/', trim( $member['name'] ) );
								$initials = strtoupper( substr( $parts[0] ?? '', 0, 1 ) . substr( $parts[ count( $parts ) - 1 ] ?? '', 0, 1 ) );
							?>
							<div class="dmg-team-placeholder">
								<div class="initials" aria-hidden="true"><?php echo esc_html( $initials ); ?></div>
								<span style="font-size:0.8125rem;letter-spacing:0.12em;text-transform:uppercase">Photo coming soon</span>
							</div>
						<?php endif; ?>
					</div>
					<div class="dmg-team-body">
						<h2 class="dmg-team-name"><?php echo esc_html( $member['name'] ); ?></h2>
						<p class="dmg-team-title-label"><?php echo esc_html( $member['title'] ); ?></p>
						<ul class="dmg-team-info">
							<?php if ( ! empty( $member['phone'] ) ) : ?>
								<li>
									<span class="dmg-team-icon" aria-hidden="true">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
									</span>
									<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $member['phone'] ) ); ?>"><?php echo esc_html( $member['phone'] ); ?></a>
								</li>
							<?php endif; ?>
							<?php if ( ! empty( $member['email'] ) ) : ?>
								<li>
									<span class="dmg-team-icon" aria-hidden="true">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/></svg>
									</span>
									<a href="mailto:<?php echo esc_attr( $member['email'] ); ?>"><?php echo esc_html( $member['email'] ); ?></a>
								</li>
							<?php endif; ?>
							<?php if ( ! empty( $member['dre'] ) ) : ?>
								<li>
									<span class="dmg-team-icon" aria-hidden="true">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
									</span>
									<span><span class="dmg-team-info-label">DRE</span><?php echo esc_html( $member['dre'] ); ?></span>
								</li>
							<?php endif; ?>
							<?php if ( ! empty( $member['rating'] ) ) : ?>
								<li>
									<span class="dmg-team-icon dmg-team-icon--star" aria-hidden="true">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.95 6.99 7.55.66-5.74 4.97 1.74 7.38L12 18.27l-6.5 3.73 1.74-7.38L1.5 9.65l7.55-.66z"/></svg>
									</span>
									<span><?php echo esc_html( $member['rating'] ); ?></span>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- /wp:group -->

<!-- wp:html -->
<section class="dmg-team-pitch" aria-label="Why work with our team">
	<div class="dmg-team-pitch-inner">
		<div class="dmg-team-pitch-image-wrap">
			<img class="dmg-team-pitch-image" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/team/dave-emily-together.jpg' ) ); ?>" alt="Dave McLaughlin and Emily Berdon" loading="lazy" />
		</div>
		<div class="dmg-team-pitch-text">
			<div class="dmg-team-pitch-eyebrow-row">
				<span class="dmg-team-pitch-eyebrow-icon" aria-hidden="true">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l1.9 4.8L19 9.6l-3.7 3.4 1 5L12 15.6 7.7 18l1-5L5 9.6l5.1-1.8z"/><path d="M19 17l.7 1.7L21 19l-1.3.7L19 21l-.7-1.3L17 19l1.3-.7z"/><path d="M5 4l.5 1.2L7 5.5l-1.5.3L5 7l-.5-1.2L3 5.5l1.5-.3z"/></svg>
				</span>
				<p class="dmg-team-pitch-eyebrow">Why work with our team</p>
			</div>
			<h2 class="dmg-team-pitch-heading">Local expertise meets modern marketing.</h2>
			<p class="dmg-team-pitch-body">Working with our team means getting the best of both worlds: trusted local expertise paired with modern marketing strategies designed for today&rsquo;s buyers. From cinematic video tours and social media exposure to personalized service and deep market knowledge, we use a fresh, high-visibility approach to help your home stand out, attract more attention, and sell with confidence.</p>
		</div>
	</div>
</section>
<!-- /wp:html -->


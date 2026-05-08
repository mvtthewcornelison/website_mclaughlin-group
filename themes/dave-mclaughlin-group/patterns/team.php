<?php
/**
 * Title: Team
 * Slug: dmg/team
 * Categories: featured
 * Inserter: false
 */

$team = [
	[
		'name'  => 'Dave McLaughlin',
		'title' => 'Lead Realtor',
		'image' => get_theme_file_uri( 'assets/images/team/dave-mclaughlin.jpg' ),
		'desc'  => '[Matt to check with Dave]',
	],
	[
		'name'  => 'Kelly Ammerman',
		'title' => 'Lead Administrator',
		'image' => '',
		'desc'  => '[Matt to check with Dave]',
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
	.dmg-team-desc { margin:0.4rem 0 0; color:var(--wp--preset--color--gray-700); line-height:1.7; }
	@media (max-width: 600px) {
		.dmg-team-wrap { padding: 3.5rem 1.25rem 5rem; }
		.dmg-team-card { flex: 0 1 100%; }
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
			<p class="dmg-team-eyebrow">Meet the team</p>
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
							<div class="dmg-team-placeholder">
								<div class="initials" aria-hidden="true">KA</div>
								<span style="font-size:0.8125rem;letter-spacing:0.12em;text-transform:uppercase">Photo coming soon</span>
							</div>
						<?php endif; ?>
					</div>
					<div class="dmg-team-body">
						<h2 class="dmg-team-name"><?php echo esc_html( $member['name'] ); ?></h2>
						<p class="dmg-team-title-label"><?php echo esc_html( $member['title'] ); ?></p>
						<p class="dmg-team-desc"><?php echo esc_html( $member['desc'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- /wp:group -->


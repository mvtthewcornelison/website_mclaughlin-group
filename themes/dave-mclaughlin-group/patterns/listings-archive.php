<?php
/**
 * Title: Listings Archive
 * Slug: dmg/listings-archive
 * Inserter: false
 */

$listings = function_exists( 'dmg_get_listings' ) ? dmg_get_listings() : [];

$status_labels = [
	'active'  => 'Active',
	'pending' => 'Pending',
	'sold'    => 'Sold',
];

$neighborhoods = [
	'agoura-hills'     => 'Agoura Hills',
	'malibou-lake'     => 'Malibou Lake',
	'westlake-village' => 'Westlake Village',
	'thousand-oaks'    => 'Thousand Oaks',
	'newbury-park'     => 'Newbury Park',
	'oak-park'         => 'Oak Park',
	'malibu'           => 'Malibu',
	'ventura'          => 'Ventura',
];
?>
<!-- wp:html -->
<style>
	/* ── Page header ── */
	.dmg-archive-header {
		background:
			linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
			url('<?php echo esc_url( get_theme_file_uri( 'assets/images/listings/hero.jpg' ) ); ?>') center/cover no-repeat;
		padding: 7rem 2rem 6rem;
		text-align: center;
		border-bottom: 1px solid var(--wp--preset--color--gray-100);
		color: #fff;
	}
	.dmg-archive-header h1 {
		font-size: clamp(2rem, 5vw, 3rem);
		font-weight: 700;
		margin: 0 0 0.75rem;
		letter-spacing: -0.02em;
		color: #fff;
	}
	.dmg-archive-header p {
		font-size: 1.0625rem;
		color: rgba(255, 255, 255, 0.85);
		margin: 0;
		max-width: 520px;
		margin-inline: auto;
	}

	/* ── Filter bar ── */
	.dmg-filter-bar {
		position: sticky;
		top: 0;
		z-index: 50;
		background: #fff;
		border-bottom: 1px solid var(--wp--preset--color--gray-100);
		padding: 0.875rem 2rem;
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		gap: 0.75rem 1.5rem;
	}
	.dmg-filter-group {
		display: flex;
		align-items: center;
		gap: 0.375rem;
	}
	.dmg-filter-label {
		font-size: 0.75rem;
		font-weight: 600;
		letter-spacing: 0.1em;
		text-transform: uppercase;
		color: var(--wp--preset--color--gray-500);
		margin-right: 0.25rem;
		white-space: nowrap;
	}
	.dmg-filter-btn {
		font-family: inherit;
		font-size: 0.8125rem;
		font-weight: 600;
		padding: 0.4rem 0.875rem;
		border: 1.5px solid var(--wp--preset--color--gray-100);
		background: #fff;
		color: var(--wp--preset--color--gray-700);
		cursor: pointer;
		border-radius: 0;
		transition: background-color 0.12s ease, color 0.12s ease, border-color 0.12s ease;
		line-height: 1.4;
	}
	.dmg-filter-btn:hover:not(.is-active) {
		border-color: #1A1A1A;
		color: #1A1A1A;
	}
	.dmg-filter-btn.is-active {
		background: #B20000;
		border-color: #B20000;
		color: #fff;
	}
	.dmg-filter-select {
		font-family: inherit;
		font-size: 0.8125rem;
		font-weight: 500;
		padding: 0.4rem 2rem 0.4rem 0.75rem;
		border: 1.5px solid var(--wp--preset--color--gray-100);
		background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%231A1A1A' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") no-repeat right 0.625rem center;
		background-size: 10px 7px;
		color: var(--wp--preset--color--gray-700);
		cursor: pointer;
		border-radius: 0;
		appearance: none;
		-webkit-appearance: none;
	}
	.dmg-filter-select:focus {
		outline: 2px solid #B20000;
		outline-offset: 1px;
	}
	.dmg-view-group {
		margin-left: auto;
		display: flex;
		align-items: center;
		gap: 0.375rem;
	}

	/* ── Results count ── */
	.dmg-results-bar {
		max-width: 1280px;
		margin-inline: auto;
		padding: 1.25rem 2rem 0;
	}
	.dmg-results-count {
		font-size: 0.875rem;
		color: var(--wp--preset--color--gray-500);
		margin: 0;
	}

	/* ── Grid ── */
	.dmg-archive-wrap {
		max-width: 1280px;
		margin-inline: auto;
		padding: 1.25rem 2rem 5rem;
	}
	.dmg-listings-grid {
		display: grid;
		gap: 1.5rem;
	}
	.dmg-listings-grid--medium { grid-template-columns: repeat(3, 1fr); }
	.dmg-listings-grid--large  { grid-template-columns: repeat(2, 1fr); }

	@media (max-width: 900px) {
		.dmg-listings-grid--medium,
		.dmg-listings-grid--large { grid-template-columns: repeat(2, 1fr); }
	}
	@media (max-width: 600px) {
		.dmg-filter-bar { padding: 0.75rem 1rem; gap: 0.5rem 1rem; }
		.dmg-archive-wrap,
		.dmg-results-bar { padding-left: 1rem; padding-right: 1rem; }
		.dmg-listings-grid--medium,
		.dmg-listings-grid--large { grid-template-columns: 1fr; }
		.dmg-view-group { margin-left: 0; }
	}

	/* ── Card ── */
	.dmg-listing-card {
		background: #fff;
		border: 1px solid var(--wp--preset--color--gray-100);
		display: flex;
		flex-direction: column;
		height: 100%;
		overflow: hidden;
	}
	.dmg-listing-card[hidden] { display: none; }

	.dmg-listing-card__photo {
		position: relative;
		aspect-ratio: 3 / 2;
		overflow: hidden;
		background: var(--wp--preset--color--gray-100);
	}
	.dmg-listing-card__photo img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		display: block;
	}
	.dmg-listing-card__photo-placeholder {
		aspect-ratio: 3 / 2;
		background: var(--wp--preset--color--gray-100);
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		color: var(--wp--preset--color--gray-500);
		gap: 0.5rem;
	}
	.dmg-listing-card__photo-placeholder span {
		font-size: 0.8125rem;
		letter-spacing: 0.1em;
		text-transform: uppercase;
	}

	/* Status badge */
	.dmg-listing-card__badge {
		position: absolute;
		top: 0.75rem;
		right: 0.75rem;
		font-size: 0.6875rem;
		font-weight: 700;
		letter-spacing: 0.18em;
		text-transform: uppercase;
		padding: 0.3rem 0.6rem;
		background: var(--wp--preset--color--gray-100);
		color: var(--wp--preset--color--gray-700);
	}
	.dmg-listing-card__badge--active  { background: var(--wp--preset--color--primary); color: #fff; }
	.dmg-listing-card__badge--pending { background: #f3e3a8; color: #6b4f00; }
	.dmg-listing-card__badge--sold    { background: var(--wp--preset--color--gray-900); color: #fff; }

	/* Card body */
	.dmg-listing-card__body {
		padding: 1.25rem 1.5rem 1.5rem;
		display: flex;
		flex-direction: column;
		gap: 0.35rem;
		flex: 1;
	}
	.dmg-listing-card__neighborhood {
		font-size: 0.75rem;
		font-weight: 600;
		letter-spacing: 0.1em;
		text-transform: uppercase;
		color: var(--wp--preset--color--gray-500);
		margin: 0;
	}
	.dmg-listing-card__address {
		font-size: 1.0625rem;
		font-weight: 700;
		line-height: 1.3;
		margin: 0.1rem 0 0;
		letter-spacing: -0.005em;
		color: var(--wp--preset--color--gray-900);
	}
	.dmg-listing-card__price {
		font-size: 1.375rem;
		font-weight: 700;
		color: #B20000;
		margin: 0.35rem 0 0;
		letter-spacing: -0.01em;
	}
	.dmg-listing-card__specs {
		list-style: none;
		padding: 0;
		margin: 0.35rem 0 0;
		display: flex;
		gap: 0.25rem 1.125rem;
		flex-wrap: wrap;
		font-size: 0.875rem;
		color: var(--wp--preset--color--gray-700);
	}
	.dmg-listing-card__specs li strong {
		color: var(--wp--preset--color--gray-900);
		margin-right: 0.2rem;
		font-weight: 700;
	}
	.dmg-listing-card__cta {
		display: inline-block;
		margin-top: 1rem;
		align-self: flex-start;
		font-size: 0.875rem;
		font-weight: 600;
		letter-spacing: 0.01em;
		padding: 0.7rem 1.25rem;
		background: var(--wp--preset--color--black);
		color: #fff;
		text-decoration: none;
		border-radius: 0;
		transition: background-color 0.15s ease;
	}
	.dmg-listing-card__cta:hover { background: #B20000; color: #fff; }

	/* ── Empty state ── */
	.dmg-listings-empty {
		display: none;
		text-align: center;
		padding: 4rem 2rem;
		color: var(--wp--preset--color--gray-500);
		font-style: italic;
		grid-column: 1 / -1;
	}
</style>

<!-- ── Page header ── -->
<section class="dmg-archive-header">
	<h1>Open Listings</h1>
	<p>Browse available properties in the Conejo Valley and surrounding communities.</p>
</section>

<!-- ── Filter bar ── -->
<div class="dmg-filter-bar" id="dmg-filter-bar">

	<div class="dmg-filter-group">
		<span class="dmg-filter-label">Status</span>
		<button class="dmg-filter-btn is-active" data-status="all" type="button">All</button>
		<button class="dmg-filter-btn" data-status="active" type="button">Active</button>
		<button class="dmg-filter-btn" data-status="pending" type="button">Pending</button>
		<button class="dmg-filter-btn" data-status="sold" type="button">Sold</button>
	</div>

	<div class="dmg-filter-group">
		<label class="dmg-filter-label" for="dmg-neighborhood-filter">Neighborhood</label>
		<select class="dmg-filter-select" id="dmg-neighborhood-filter">
			<option value="all">All Neighborhoods</option>
			<option value="agoura-hills">Agoura Hills</option>
			<option value="malibou-lake">Malibou Lake</option>
			<option value="westlake-village">Westlake Village</option>
			<option value="thousand-oaks">Thousand Oaks</option>
			<option value="newbury-park">Newbury Park</option>
			<option value="oak-park">Oak Park</option>
			<option value="malibu">Malibu</option>
			<option value="ventura">Ventura</option>
		</select>
	</div>

	<div class="dmg-filter-group dmg-view-group">
		<span class="dmg-filter-label">View</span>
		<button class="dmg-filter-btn is-active" data-view="medium" type="button" id="dmg-view-medium">Medium</button>
		<button class="dmg-filter-btn" data-view="large" type="button" id="dmg-view-large">Large</button>
	</div>

</div>

<!-- ── Results count ── -->
<div class="dmg-results-bar">
	<p class="dmg-results-count" id="dmg-results-count">Showing <?php echo count( $listings ); ?> listings</p>
</div>

<!-- ── Listings grid ── -->
<div class="dmg-archive-wrap">
	<div class="dmg-listings-grid dmg-listings-grid--medium" id="dmg-listings-grid">

		<?php if ( empty( $listings ) ) : ?>
			<p class="dmg-listings-empty" style="display:block;">No listings available - check back soon!</p>
		<?php else : ?>

			<?php foreach ( $listings as $listing ) :
				$title        = get_the_title( $listing );
				$status       = get_post_meta( $listing->ID, 'dmg_status', true ) ?: 'active';
				$price        = get_post_meta( $listing->ID, 'dmg_price', true );
				$beds         = get_post_meta( $listing->ID, 'dmg_beds', true );
				$baths        = get_post_meta( $listing->ID, 'dmg_baths', true );
				$sqft         = get_post_meta( $listing->ID, 'dmg_sqft', true );
				$neighborhood = get_post_meta( $listing->ID, 'dmg_neighborhood', true );
				$detail_url   = get_permalink( $listing->ID );
				$gallery_csv  = get_post_meta( $listing->ID, 'dmg_gallery', true );
				$gallery_ids  = $gallery_csv ? array_filter( array_map( 'absint', explode( ',', $gallery_csv ) ) ) : [];
				$thumb_id     = (int) get_post_thumbnail_id( $listing );
				if ( $thumb_id ) {
					array_unshift( $gallery_ids, $thumb_id );
					$gallery_ids = array_values( array_unique( $gallery_ids ) );
				}
				$first_image_id    = $gallery_ids ? $gallery_ids[0] : 0;
				$neighborhood_name = isset( $neighborhoods[ $neighborhood ] ) ? $neighborhoods[ $neighborhood ] : '';
				$badge_class       = 'dmg-listing-card__badge dmg-listing-card__badge--' . esc_attr( $status );
			?>
			<article class="dmg-listing-card"
			         data-status="<?php echo esc_attr( $status ); ?>"
			         data-neighborhood="<?php echo esc_attr( $neighborhood ?: '' ); ?>">

				<!-- Photo -->
				<?php if ( $first_image_id ) : ?>
					<div class="dmg-listing-card__photo">
						<?php echo wp_get_attachment_image( $first_image_id, 'large', false, [
							'class'   => 'dmg-listing-card__img',
							'loading' => 'lazy',
							'alt'     => esc_attr( $title ),
						] ); ?>
						<span class="<?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $status_labels[ $status ] ?? 'Active' ); ?></span>
					</div>
				<?php else : ?>
					<div class="dmg-listing-card__photo dmg-listing-card__photo-placeholder">
						<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
						<span>Photo coming soon</span>
						<span class="<?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $status_labels[ $status ] ?? 'Active' ); ?></span>
					</div>
				<?php endif; ?>

				<!-- Body -->
				<div class="dmg-listing-card__body">
					<?php if ( $neighborhood_name ) : ?>
						<p class="dmg-listing-card__neighborhood"><?php echo esc_html( $neighborhood_name ); ?></p>
					<?php endif; ?>
					<h2 class="dmg-listing-card__address"><?php echo esc_html( $title ); ?></h2>
					<p class="dmg-listing-card__price"><?php echo $price ? esc_html( $price ) : '-'; ?></p>
					<ul class="dmg-listing-card__specs">
						<?php if ( $beds ) : ?><li><strong><?php echo esc_html( $beds ); ?></strong> Beds</li><?php endif; ?>
						<?php if ( $baths ) : ?><li><strong><?php echo esc_html( $baths ); ?></strong> Baths</li><?php endif; ?>
						<?php if ( $sqft ) : ?><li><strong><?php echo esc_html( $sqft ); ?></strong> Sq Ft</li><?php endif; ?>
					</ul>
					<a class="dmg-listing-card__cta" href="<?php echo esc_url( $detail_url ); ?>">View Listing</a>
				</div>

			</article>
			<?php endforeach; ?>

			<p class="dmg-listings-empty" id="dmg-empty-state">No listings match your filters.</p>

		<?php endif; ?>

	</div><!-- .dmg-listings-grid -->
</div><!-- .dmg-archive-wrap -->

<script>
(function () {
	'use strict';

	var grid        = document.getElementById('dmg-listings-grid');
	var countEl     = document.getElementById('dmg-results-count');
	var emptyState  = document.getElementById('dmg-empty-state');
	var statusBtns  = document.querySelectorAll('.dmg-filter-btn[data-status]');
	var neighborSel = document.getElementById('dmg-neighborhood-filter');
	var viewBtns    = document.querySelectorAll('.dmg-filter-btn[data-view]');
	var cards       = grid ? Array.prototype.slice.call(grid.querySelectorAll('.dmg-listing-card[data-status]')) : [];

	var activeStatus = 'all';
	var activeNeighborhood = 'all';

	// ── Filter logic ──────────────────────────────────────────────────────────
	function applyFilters() {
		var visible = 0;

		cards.forEach(function (card) {
			var statusMatch = activeStatus === 'all' || card.dataset.status === activeStatus;
			var neighborMatch = activeNeighborhood === 'all' || card.dataset.neighborhood === activeNeighborhood;

			if (statusMatch && neighborMatch) {
				card.removeAttribute('hidden');
				visible++;
			} else {
				card.setAttribute('hidden', '');
			}
		});

		if (countEl) {
			countEl.textContent = 'Showing ' + visible + ' listing' + (visible === 1 ? '' : 's');
		}

		if (emptyState) {
			emptyState.style.display = visible === 0 ? 'block' : 'none';
		}

		// Persist filter state across navigations on the same page session
		try {
			sessionStorage.setItem('dmg_filter_status', activeStatus);
			sessionStorage.setItem('dmg_filter_neighborhood', activeNeighborhood);
		} catch (e) {}
	}

	// ── Status button clicks ──────────────────────────────────────────────────
	statusBtns.forEach(function (btn) {
		btn.addEventListener('click', function () {
			activeStatus = btn.dataset.status;
			statusBtns.forEach(function (b) { b.classList.remove('is-active'); });
			btn.classList.add('is-active');
			applyFilters();
		});
	});

	// ── Neighborhood select ───────────────────────────────────────────────────
	if (neighborSel) {
		neighborSel.addEventListener('change', function () {
			activeNeighborhood = neighborSel.value;
			applyFilters();
		});
	}

	// ── View toggle ───────────────────────────────────────────────────────────
	function applyView(view) {
		if (!grid) return;
		grid.classList.remove('dmg-listings-grid--medium', 'dmg-listings-grid--large');
		grid.classList.add('dmg-listings-grid--' + view);
		viewBtns.forEach(function (b) {
			b.classList.toggle('is-active', b.dataset.view === view);
		});
		try {
			localStorage.setItem('dmg_listing_view', view);
		} catch (e) {}
	}

	viewBtns.forEach(function (btn) {
		btn.addEventListener('click', function () {
			applyView(btn.dataset.view);
		});
	});

	// ── Init: restore persisted state ─────────────────────────────────────────
	(function init() {
		// View preference
		var savedView = 'medium';
		try { savedView = localStorage.getItem('dmg_listing_view') || 'medium'; } catch (e) {}
		if (savedView !== 'medium' && savedView !== 'large') { savedView = 'medium'; }
		applyView(savedView);

		// Filter state
		var savedStatus = 'all';
		var savedNeighborhood = 'all';
		try {
			savedStatus = sessionStorage.getItem('dmg_filter_status') || 'all';
			savedNeighborhood = sessionStorage.getItem('dmg_filter_neighborhood') || 'all';
		} catch (e) {}

		if (savedStatus !== 'all') {
			activeStatus = savedStatus;
			statusBtns.forEach(function (b) {
				b.classList.toggle('is-active', b.dataset.status === savedStatus);
			});
		}

		if (savedNeighborhood !== 'all' && neighborSel) {
			activeNeighborhood = savedNeighborhood;
			neighborSel.value = savedNeighborhood;
		}

		applyFilters();
	})();
})();
</script>
<!-- /wp:html -->

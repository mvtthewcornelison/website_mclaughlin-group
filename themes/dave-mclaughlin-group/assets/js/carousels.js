(function () {
	function initSplides() {
		if (typeof Splide === 'undefined') return;

		var listings = document.querySelector('.dmg-listings-carousel');
		if (listings) {
			var perPage = parseInt(listings.getAttribute('data-per-page'), 10) || 3;
			new Splide(listings, {
				type: perPage > 1 ? 'loop' : 'slide',
				perPage: perPage,
				perMove: 1,
				gap: '1.75rem',
				pagination: false,
				arrows: perPage > 1,
				focus: 'center',
				breakpoints: {
					1024: { perPage: Math.min(2, perPage), arrows: perPage > 1 },
					640:  { perPage: 1, arrows: false }
				}
			}).mount();
		}

		document.querySelectorAll('.dmg-listing-photos').forEach(function (el) {
			new Splide(el, {
				type: 'loop',
				perPage: 1,
				arrows: true,
				pagination: true,
				cover: true,
				heightRatio: 0.66
			}).mount();
		});

		var testimonials = document.querySelector('.dmg-testimonials-carousel');
		if (testimonials) {
			new Splide(testimonials, {
				type: 'loop',
				perPage: 1,
				arrows: true,
				pagination: true,
				autoplay: true,
				interval: 5000,
				pauseOnHover: true,
				pauseOnFocus: true
			}).mount();
		}

		document.querySelectorAll('.dmg-listing-gallery').forEach(function (el) {
			el.dmgSplide = new Splide(el, {
				type: 'loop',
				perPage: 1,
				arrows: true,
				pagination: true,
				gap: '0'
			}).mount();
		});
	}

	function animateCounter(el) {
		var target = parseFloat(el.getAttribute('data-target'));
		if (isNaN(target)) return;
		var duration = parseInt(el.getAttribute('data-duration'), 10) || 1800;
		var prefix = el.getAttribute('data-prefix') || '';
		var suffix = el.getAttribute('data-suffix') || '';
		var startTime = null;

		function tick(now) {
			if (startTime === null) startTime = now;
			var t = Math.min(1, (now - startTime) / duration);
			var eased = 1 - Math.pow(1 - t, 3); // ease-out cubic
			var value = Math.round(target * eased);
			el.textContent = prefix + value.toLocaleString('en-US') + suffix;
			if (t < 1) requestAnimationFrame(tick);
		}
		requestAnimationFrame(tick);
	}

	function initCounters() {
		var counters = document.querySelectorAll('.dmg-counter');
		if (!counters.length) return;

		var reducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		if (reducedMotion) return; // leave the final values in place

		if (typeof IntersectionObserver === 'undefined') {
			counters.forEach(animateCounter);
			return;
		}

		// Reset to starting state so the animation actually has somewhere to go.
		// Done before observation so any in-viewport element animates from 0.
		counters.forEach(function (el) {
			var prefix = el.getAttribute('data-prefix') || '';
			var suffix = el.getAttribute('data-suffix') || '';
			el.textContent = prefix + '0' + suffix;
		});

		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					animateCounter(entry.target);
					observer.unobserve(entry.target);
				}
			});
		}, { threshold: 0.35, rootMargin: '0px 0px -10% 0px' });

		counters.forEach(function (el) { observer.observe(el); });
	}

	function init() {
		initSplides();
		initCounters();
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();

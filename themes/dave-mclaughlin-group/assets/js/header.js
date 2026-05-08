(function () {
	function init() {
		var header = document.querySelector('header.wp-block-template-part');
		if (!header) return;

		header.classList.add('dmg-header');

		var lastY = window.pageYOffset || 0;
		var ticking = false;
		var threshold = 6;          // ignore tiny scrolls (jitter)
		var revealAtTop = 80;       // always show within this distance from top
		var hideAfter = 120;        // don't hide unless we've scrolled past this

		function update() {
			ticking = false;
			var y = window.pageYOffset || 0;
			var dy = y - lastY;

			if (y <= revealAtTop) {
				header.classList.remove('dmg-header--hidden');
				lastY = y;
				return;
			}

			if (Math.abs(dy) < threshold) return;

			if (dy > 0 && y > hideAfter) {
				header.classList.add('dmg-header--hidden');
			} else if (dy < 0) {
				header.classList.remove('dmg-header--hidden');
			}

			lastY = y;
		}

		window.addEventListener('scroll', function () {
			if (!ticking) {
				window.requestAnimationFrame(update);
				ticking = true;
			}
		}, { passive: true });
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();

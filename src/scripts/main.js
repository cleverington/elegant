(() => {
	if ('production' !== process.env.NODE_ENV) {
		console.log('Build that theme! Your JS goes here!', 'padding:0.5em 1em;');
	}

})();

(function ($) {

	// Primary Navigation
	const navToggle = document.getElementById("js-nav-toggle");
	const navWrapper = document.getElementById("ut-main_menu-wrapper");

	navToggle.addEventListener("click", function() {
		navWrapper.classList.toggle("active");
	})

	// Primary Navigation - mobile
	const subNavIcon = document.querySelectorAll('.subnav-trigger');

	subNavIcon.forEach(function(icon) {
		icon.addEventListener("click", function() {
			icon.classList.toggle("icon--open");
			icon.nextElementSibling.classList.toggle("open");
		})
	})

	// Alert Banner
	const AlertBanner = document.getElementById("alert-banner");

	if( ! AlertBanner ) { return; } else { announcementBar(); }

	function announcementBar() {
		const closeBanner = document.getElementById("alert-banner__close-btn");
		const bannerText = document.getElementById("alert-banner__text").textContent;

		if (localStorage.getItem("ut-banner-data") != bannerText) {
			// If different, reset hide bar value for local storage.
			localStorage.setItem("ut-banner", "false");
		}

		if(localStorage.getItem("ut-banner") == "true") {
			// If false, remove the bar container.
			AlertBanner.remove();
		} else {
			// If true, remove hide class.
			AlertBanner.classList.remove("d-none");
		}

		closeBanner.addEventListener("click", function() {
			AlertBanner.remove();
			localStorage.setItem("ut-banner-data", bannerText);
			localStorage.setItem("ut-banner", "true");
		});
	}

	// Accordions
	const panels = document.querySelectorAll(".panel");

	panels.forEach(function(panel) {
		const heading = panel.querySelector(".panel-heading");

		heading.addEventListener("click", function() {
			heading.classList.toggle("panel-heading--open");
		});

	});

	// Google Custom Search
	document.addEventListener('DOMContentLoaded', function() {
		const cx = '006470498568929423894:etsxpcor8wm';
		const gcse = document.createElement('script');
		gcse.type = 'text/javascript';
		gcse.async = true;
		gcse.src = (document.location.protocol === 'https:' ? 'https:' : 'http:') +
				'//cse.google.com/cse.js?cx=' + cx;
		const s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(gcse, s);
	});

})(jQuery);


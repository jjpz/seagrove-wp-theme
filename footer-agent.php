
</div><!-- #content -->

<footer id="colophon" class="clone-footer">
	<div class="copyright">
		<p>
			<span>Sea Grove Realty, LLC is a licensed real estate company in the state of Florida</span>
			<a href="http://solidmiami.com" target="_blank">Site by Solid</a>
		</p>
	</div>
</footer>

</div><!-- #page -->

<script>
function lazy(){
//document.addEventListener("DOMContentLoaded", function() {
	var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
	let active = false;

	if ("IntersectionObserver" in window) {

		let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
			entries.forEach(function(entry) {
				if (entry.isIntersecting) {
					//setTimeout(function() {
					
						let lazyImage = entry.target;
						//lazyImage.src = lazyImage.currentSrc;
						//lazyImage.src = lazyImage.dataset.src;
						//lazyImage.currentSrc = lazyImage.dataset.src;
						//lazyImage.srcset = lazyImage.dataset.srcset;
						//lazyImage.classList.remove("lazy");
						
						lazyImage.srcset = lazyImage.dataset.srcset;
						setTimeout(function(){
							lazyImage.src = lazyImage.currentSrc;
						}, 500);
						
						lazyImage.nextElementSibling.classList.remove("on");
						lazyImageObserver.unobserve(lazyImage);
						
					//}, 100);
				}
			});
		}, { rootMargin: '500px 0px', threshold: 0 } );

		lazyImages.forEach(function(lazyImage) {
			lazyImageObserver.observe(lazyImage);
		});

	} else {

	const lazyLoad = function() {
		if (active === false) {
			active = true;

			setTimeout(function() {
				lazyImages.forEach(function(lazyImage) {
					if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
						lazyImage.src = lazyImage.dataset.src;
						lazyImage.currentSrc = lazyImage.dataset.src;
						lazyImage.srcset = lazyImage.dataset.srcset;
						lazyImage.classList.remove("lazy");
						lazyImage.nextElementSibling.classList.remove("on");

						lazyImages = lazyImages.filter(function(image) {
							return image !== lazyImage;
						});

						if (lazyImages.length === 0) {
							document.removeEventListener("scroll", lazyLoad);
							window.removeEventListener("resize", lazyLoad);
							window.removeEventListener("orientationchange", lazyLoad);
						}
					}
				});

				active = false;
			}, 100);
		}
	};
	document.addEventListener("scroll", lazyLoad);
	window.addEventListener("resize", lazyLoad);
	window.addEventListener("orientationchange", lazyLoad);
	}
//});
}
document.addEventListener("DOMContentLoaded", lazy);
</script>

<?php wp_footer(); ?>

<script>
jQuery(document).ready(function($){
	$(document).ajaxComplete(function(){
		lazy();
	});
});
</script>

<script>
window.onload = function(){
	let loader = document.getElementById('loader');
	let logo = document.querySelector('.loader-logo');
	let spinner = document.querySelector('.spinner');

	setTimeout(function () {
		logo.style.opacity = 0;
		spinner.style.opacity = 0;
	}, 250);

	setTimeout(function () {
		loader.style.opacity = 0;
	}, 500);

	setTimeout(function () {
		loader.style.display = 'none';
	}, 1500);
};
</script>

</body>
</html>


</div><!-- #content -->

<?php $phone = carbon_get_theme_option('crb_theme_phone'); ?>

<?php if ( !is_page_template( array( 'page-map.php', 'page-listings.php', 'page-sold.php', 'page-commercial.php' ) ) ) { ?>

<?php
$address = carbon_get_theme_option('crb_theme_address');
$city = carbon_get_theme_option('crb_theme_city');
$state = carbon_get_theme_option('crb_theme_state');
$zipcode = carbon_get_theme_option('crb_theme_zipcode');
$lat = carbon_get_theme_option('crb_theme_lat');
$lng = carbon_get_theme_option('crb_theme_lng');
$email = carbon_get_theme_option('crb_theme_email');
$facebook = carbon_get_theme_option('crb_theme_facebook_link');
$instagram = carbon_get_theme_option('crb_theme_instagram_link');
$youtube = carbon_get_theme_option('crb_theme_youtube_link');
$accessToken = carbon_get_theme_option('crb_theme_igfeed_accesstoken_link');
$sharefile_url = carbon_get_theme_option('crb_theme_sharefile_link_url');
$sharefile_text = carbon_get_theme_option('crb_theme_sharefile_link_text');
?>

<?php
$footer_nav = wp_nav_menu( array(
	'theme_location' => 'footer_nav',
	'items_wrap' => '%3$s',
	'container' => '',
	'echo' => 0
) );
?>

<footer id="colophon" class="site-footer">
	<div class="bg-spiral" style="background-image: url('<?php echo get_stylesheet_directory_uri() . '/images/footer-bg.svg' ?>')"></div>
	
	<div class="footer-container">
		<div class="footer-row">
			<div class="footer-column footer-menu-column">
				<div class="footer-logo">
					<a href="<?php echo site_url(); ?>" title="<?php echo get_bloginfo( 'name' ) ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/images/footer-logo.svg' ?>" alt=""></a>
				</div>
				<ul class="footer-menu">
					<?php echo $footer_nav; ?>
				</ul>
			</div>
			<div class="footer-column footer-contact-column">
				<div class="contact-links">
					<h4>Contact</h4>
					<ul class="contact-menu">
						<?php if ( !empty($phone) ) { ?>
						<li>
							<p>
							<a href="#" class="" data-toggle="class" data-target="#footer-modal" data-classes="open">
								<span class="icon">
									<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
								</span>
								<span class="details"><?php echo $phone; ?></span>
							</a>
							</p>
						</li>
						<?php } ?>
						<?php if ( !empty($email) ) { ?>
						<li>
							<p>
							<a href="mailto:<?php echo $email; ?>" target="_blank">
								<span class="icon">
									<svg version="1.1" id="Layer_1" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
									<path fill="#FFFFFF" d="M464,64H48C21.5,64,0,85.5,0,112v288c0,26.5,21.5,48,48,48h416c26.5,0,48-21.5,48-48V112C512,85.5,490.5,64,464,64zM464,112v40.8c-22.4,18.3-58.2,46.7-134.6,106.5c-16.8,13.2-50.2,45.1-73.4,44.7c-23.2,0.4-56.6-31.5-73.4-44.7C106.2,199.5,70.4,171.1,48,152.8V112H464zM48,400V214.4c22.9,18.3,55.4,43.9,104.9,82.6c21.9,17.2,60.1,55.2,103.1,55c42.7,0.2,80.5-37.2,103.1-54.9c49.5-38.8,82-64.4,104.9-82.7V400H48z"/>
									</svg>
								</span>
								<span class="details"><?php echo $email; ?></span>
							</a>
							</p>
						</li>
						<?php } ?>
						<?php if ( !empty($address) && !empty($city) && !empty($state) && !empty($zipcode) ) { ?>
						<li>
							<p>
							<a href="https://www.google.com/maps/dir//<?php echo $address .','. $city .','. $state .','. $zipcode ?>" target="_blank">
								<span class="icon">
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384 512" style="enable-background:new 0 0 384 512;" xml:space="preserve">
									<path fill="#FFFFFF" d="M172.3,501.7C27,291,0,269.4,0,192C0,86,86,0,192,0s192,86,192,192c0,77.4-27,99-172.3,309.7C202.2,515.4,181.8,515.4,172.3,501.7L172.3,501.7zM192,272c44.2,0,80-35.8,80-80s-35.8-80-80-80s-80,35.8-80,80S147.8,272,192,272z"/>
									</svg>
								</span>
								<span class="details">
									<?php echo $address; ?>
									<br>
									<?php echo $city . ', ' . $state . ' ' . $zipcode; ?>
								</span>
							</a>
							</p>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="footer-column footer-social-column">
				<div class="social-links">
					<h4>Follow Us</h4>
					<?php if ( !empty($facebook) ) { ?>
					<a href="<?php echo $facebook; ?>" target="_blank" class="btn-social">
						<span class="icon">
							<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
							</svg>
						</span>
					</a>
					<?php } ?>
					<?php if ( !empty($instagram) ) { ?>
					<a href="<?php echo $instagram; ?>" target="_blank" class="btn-social">
						<span class="icon">
							<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
							</svg>
						</span>
					</a>
					<?php } ?>
					<?php if ( !empty($youtube) ) { ?>
					<a href="<?php echo $youtube; ?>" target="_blank" class="btn-social">
						<span class="icon">
							<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" class="svg-inline--fa fa-youtube fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>
						</span>
					</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="copyright">
		<p>
			<?php if ( !empty($sharefile_url) ) { ?>
			<a href="<?php echo $sharefile_url; ?>" target="_blank"><?php if ( !empty($sharefile_text) ) { echo $sharefile_text; } else { echo 'Sharefile Login'; } ?></a>
			<?php } ?>
			<span>Sea Grove Realty, LLC is a licensed real estate company in the state of Florida</span>
			<a href="http://solidmiami.com" target="_blank">Site by Solid</a>
		</p>
	</div>
	
	<div class="site-info">
		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'solid' ) ); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			//printf( esc_html__( 'Proudly powered by %s', 'solid' ), 'WordPress' );
			?>
		</a>
		<!--<span class="sep"> | </span>-->
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			//printf( esc_html__( 'Theme: %1$s by %2$s.', 'solid' ), 'solid', '<a href="http://underscores.me/">Underscores.me</a>' );
			?>
	</div>
</footer>

<?php } else { ?>

<footer id="colophon" class="site-footer" style="margin:0;padding:0;"></footer>

<?php } ?>

<?php if ( !empty($phone) ) { ?>
<div id="footer-modal" class="modal">
	<a class="modal-overlay" data-toggle="class" data-target="#footer-modal" data-classes="open"></a>
	<div class="modal-container">
		<div class="modal-content">
			<h6>Contact</h6>
			<h3 class="h3-new">Sea Grove Realty</h3>
			<h3><?php echo $phone; ?></h3>
			<div class="modal-buttons">
				<div class="modal-button"><a href="sms://<?php echo $phone; ?>" class="btn-modal">Text</a></div>
				<div class="modal-button"><a href="tel://<?php echo $phone; ?>" class="btn-modal">Call</a></div>
			</div>
		</div>
	</div>
</div>
<?php } ?>

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

<?php if ( is_front_page() ) { ?>
<script>
// instafeed
/*/var feed = new Instafeed({
get: 'user',
userId: '1418076643',
clientId: '618a8653c0c34b8b88b9d2c7992dd974',
target: 'ig-feed',
accessToken: '1418076643.618a865.2f3c3693c4f5401f8eda23fa5d021728',
template: '<div class="ig-item"><a href="{{link}}" class="ig-link" target="_blank"><div class="ig-image"><img src="{{image}}" title="{{caption}}" alt="{{caption}}" /></div></a></div>',
sortBy: 'most-recent',
limit: 3,
resolution: 'standard_resolution'
});
feed.run();*/

<?php if (isset($accessToken) && !empty($accessToken)) { ?>
var feed = new Instafeed({
	accessToken: '<?php echo $accessToken; ?>',
	target: 'ig-feed',
	limit: 3,
	template: '<div class="ig-item"><a href="{{link}}" class="ig-link" target="_blank"><div class="ig-image"><img src="{{image}}" title="{{caption}}" alt="{{caption}}" /></div></a></div>',
});
feed.run();
<?php } ?>
</script>
<?php } ?>

<script>
window.onload = function(){
var loader = document.getElementById('loader');
loader.style.opacity = 0;
setTimeout(function(){ loader.style.display = 'none'; }, 500);
};
</script>

</body>
</html>

<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php
			$ID = get_the_ID();
			$loader_image = carbon_get_theme_option('crb_theme_loader_image');

			get_template_part('components/home/slider');
			get_template_part('components/home/intro', '', ['ID' => $ID]);
			get_template_part('components/home/about', '', [
				'ID' => $ID,
				'loader_image' => $loader_image
			]);
			get_template_part('components/home/bio', '', [
				'ID' => $ID,
				'loader_image' => $loader_image
			]);
			get_template_part('components/home/instagram');
		?>
	</main>
</div>

<?php get_footer(); ?>

<div class="contact-float contact-float-main off">
	<div class="contact-float-container">
		<a href="#" class="contact-float-btn" data-toggle="class" data-target="#footer-modal" data-classes="open">
			<span class="contact-bar-icon">
				<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
					<path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path>
				</svg>
			</span>
			<span>Talk to an Agent</span>
		</a>
	</div>
</div>

<script>
	jQuery(document).ready(function($) {

		var nav = $('#main-navigation');
		var content = $('#content');
		var button = $('#toggle-button');
		var top = $(window).scrollTop();
		var navHeight = nav.outerHeight();
		var height = top + navHeight;
		var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

		function on() {
			if (width <= 1280) {
				nav.addClass('on');
				nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-color.svg' ?>');
			} else {
				nav.removeClass('on');
				nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-white.svg' ?>');
			}
		}
		on();
		$(window).resize(function() {
			width = $(window).width() + 17;
			on();
		});

		/*button.click(function(){
			if ( !nav.hasClass('on') ) {
				nav.addClass('on');
				nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-color.svg' ?>');
			} else {
				nav.removeClass('on');
				nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-white.svg' ?>');
			}
		});*/

		nav.mouseover(function() {
			if (!nav.hasClass('on') && !nav.hasClass('sticky')) {
				nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-color.svg' ?>');
			}
		});

		nav.mouseout(function() {
			if (!nav.hasClass('on') && !nav.hasClass('sticky')) {
				nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-white.svg' ?>');
			}
		});

		function sticky() {
			var top = $(window).scrollTop();
			var navHeight = $('#main-navigation').outerHeight();
			var sliderHeight = $('#slider').outerHeight();

			if (top > sliderHeight) {
				nav.addClass('sticky');
				content.addClass('sticky');
				nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-color.svg' ?>');
			} else {
				nav.removeClass('sticky');
				content.removeClass('sticky');
				if (!nav.hasClass('on')) {
					nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-white.svg' ?>');
				}
			}
		}
		sticky();
		$(window).scroll(sticky);

		$('#slider').on('init', function(slick) {
			$('#slider .slide a').focus();
		});

		$('#slider').slick({
			lazyLoad: 'ondemand',
			infinite: true,
			//slidesToShow: 1,
			//slidesToScroll: 1,
			fade: true,
			speed: 500,
			//cssEase: 'linear',
			autoplay: true,
			autoplaySpeed: 5000,
			prevArrow: '<a class="slick-arrow slick-prev"><img src="<?php echo get_stylesheet_directory_uri() . '/icons/icon-arrow-left.svg' ?>"></a>',
			nextArrow: '<a class="slick-arrow slick-next"><img src="<?php echo get_stylesheet_directory_uri() . '/icons/icon-arrow-right.svg' ?>"></a>',
			dots: true,
			responsive: [{
				breakpoint: 769,
				settings: {
					fade: false,
					swipe: true,
					speed: 300,
					arrows: false
				}
			}]
		});

		function sliderContent() {
			var width = $(window).width();
			var slide = $('.slick-slide');
			var slideHeight = slide.outerHeight();
			var arrow = $('.slick-arrow');
			var dots = $('.slick-dots');

			slide.each(function(index) {
				if (width < 768) {
					var content = $(this).find('.slide-content').outerHeight() - 15;
					//console.log(content);
					$(this).css('margin-bottom', content);
					$(this).find('.slide-content').css('margin-bottom', content * -1);
					dots.css('bottom', content + (15 + 36));
				} else if (width < 992) {
					var content = $(this).find('.slide-content').outerHeight();
					$(this).css('margin-bottom', 15);
					$(this).find('.slide-content').css('bottom', -15);
					dots.css('bottom', content + (15 + 24));
				} else {
					$(this).css('margin-bottom', '');
					$(this).find('.slide-content').css('margin-bottom', '');
					dots.css('bottom', '');
				}
			});

			arrow.each(function(index) {
				//if ( width < 768 ) {
				$(this).css('top', slideHeight / 2);
				//} else {
				//$(this).css('top', '');
				//}
			});
		}
		$(window).load(sliderContent);
		$(window).resize(sliderContent);

	});
</script>
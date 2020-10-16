<?php get_header(); ?>

<?php
$loader_image = carbon_get_theme_option('crb_theme_loader_image');

$slides = get_posts( array(
	'post_type' => 'property',
	'post_status' => 'publish',
	'tax_query' => array(
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => 'homepage'
		)
	)
) );
?>

<div id="primary" class="content-area">
<main id="main" class="site-main">

<?php if ( !empty($slides) ) { ?>
<section class="home-slider">
	<div id="slider" class="slider">
		<?php foreach ( $slides as $slide ) { ?>
		<?php
		$ID = $slide->ID;
		$link = get_the_permalink($ID);
		$title = $slide->post_title;
		if ( wp_is_mobile() ) {
			$src = get_the_post_thumbnail_url($ID, 'medium_large');
			$img = get_the_post_thumbnail($ID, 'medium_large', array('src' => '', 'data-lazy' => $src));
		} else {
			$src = get_the_post_thumbnail_url($ID, 'full');
			$img = get_the_post_thumbnail($ID, 'full', array('src' => '', 'data-lazy' => $src));
		}
		$number = rtrim(get_post_meta($ID, 'street_number', true));
		$street = get_post_meta($ID, 'route', true);
		$route = get_post_meta($ID, 'route', true);
		$unit = get_post_meta($ID, 'unit', true);
		$city = get_post_meta($ID, 'locality', true);
		$state = get_post_meta($ID, 'administrative_area_level_1', true);
		$availability = get_field( 'property_availability', $ID );
		$status = get_field( 'property_status', $ID );
		$bed = get_field('property_beds', $ID);
		$bath = get_field('property_bath', $ID);
		$size = number_format( (float) get_field( 'property_size', $ID ) );
		$lot = number_format( (float) get_field( 'property_size_lot', $ID ) );
		$price = number_format( (float) get_field( 'property_price', $ID ) );
		if ( $availability == 'Yes' ) {
			if ( $status == 'Sale' ) {
				$slide_title = 'Exclusive Offering';
			} else {
				$slide_title = 'Available for Rent';
			}
		} else {
			if ( $status == 'Sale' ) {
				$slide_title = 'Successfully Sold';
			} else {
				$slide_title = 'Leased';
			}
		}
		?>
		<div class="slide home-slide" data-nav-title="<?php?>">
			<div class="slide-image property-slide-image">
				<?php echo $img; ?>
			</div>
			<div class="slide-content">
				<a href="<?php echo $link; ?>">
					<div class="slide-info">
						<div class="slide-title"><h5><?php echo $slide_title; ?></h5></div>
						<div class="slide-address">
							<p><?php echo $title; ?> </p>
						</div>
						<div class="slide-details">
							<?php if ( !empty($bed) && $bed != 0 ) { ?>
							<span class="meta">&bull; <?php echo $bed; ?> bed</span>
							<?php } ?>
							<?php if ( !empty($bath) && $bath != 0 ) { ?>
							<span class="meta">&bull; <?php echo $bath; ?> bath</span>
							<?php } ?>
							<?php if ( !empty($size) && $size != 0 ) { ?>
							<span class="meta">&bull; <?php echo $size; ?> sqft</span>
							<?php } ?>
							<?php if ( !empty($lot) && $lot != 0 ) { ?>
							<span class="meta">&bull; <?php echo $lot; ?> sqft lot</span>
							<?php } ?>
							<?php if ( !empty($price) && $price != 0 ) { ?>
							<span class="meta">&bull; $<?php echo $price; ?></span>
							<?php } ?>
						</div>
					</div>
					<div class="slide-button">
						<span>View Details</span>
						<span class="icon icon-caret-right">
							<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
						</span>
					</div>
				</a>
			</div>
		</div>
		<?php } ?>
	</div>
</section>
<?php } ?>

<?php
$ID = get_the_ID();
$intro_title = get_field('home_intro_title', $ID);
$intro_subtitle = get_field('home_intro_subtitle', $ID);
$intro_text = get_field('home_intro_text', $ID);
$intro_btn_url = get_field('home_intro_button_url', $ID);
$intro_btn_text = get_field('home_intro_button_text', $ID);
?>

<section class="home-intro">
<div class="container">
<div class="row">

<div class="col-sm-6">
<div class="home-intro-title">
<h1><?php echo $intro_title; ?></h1>
</div>
</div>

<div class="col-sm-6">
<div class="home-intro-content">
<div class="home-intro-content-title">
<h3 class="h3-new"><?php echo $intro_subtitle; ?></h3>
</div>
<p><?php echo $intro_text; ?></p>
<?php if ( !empty($intro_btn_url) ) { ?>
<a href="<?php echo $intro_btn_url; ?>" class="btn-cta btn-wide">
<span><?php echo $intro_btn_text; ?></span>
<span class="icon-caret-right">
<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
</span>
</a>
<?php } ?>
</div>
</div>

</div>
</div>
</section>

<?php
$about_title = carbon_get_post_meta($ID, 'crb_home_about_title');
$about_images = carbon_get_post_meta($ID, 'crb_home_about_images');
$about_items = carbon_get_post_meta($ID, 'crb_home_about_items');
?>

<section id="about" class="home-about">
<div class="container">
<div class="row">

<?php if ( !empty($about_title) ) { ?>
<div class="col-12">
<div class="home-about-title">
<h2 class="h2-new"><?php echo $about_title; ?></h2>
</div>
</div>
<?php } ?>

<div class="col-sm-8">
<div class="home-about-images">
<?php if( isset( $about_images ) && is_array( $about_images ) && !empty( $about_images ) ) { $count = 0 ?>

<?php foreach ( $about_images as $image ) { $count++ ?>
<?php if ( $count <= 5 ) { ?>
<?php
$src = wp_get_attachment_image_url($image, 'large');
$srcset = wp_get_attachment_image_srcset($image, 'large');
$img = wp_get_attachment_image($loader_image, 'full', false, array('data-src' => $src, 'data-srcset' => $srcset, 'class' => 'lazy'));
?>

<div class="image">
<div class="post-thumbnail">
<?php //echo $img; ?>
<img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 992px) 1024px" class="lazy" />
<div class="lazy-overlay on"></div>
<div class="flag no-avail">SOLD</div>
</div>
</div>

<?php } ?>
<?php } ?>

<?php } ?>
</div>
</div>

<div class="col-sm-4">
<?php if ( !empty($about_items) ) { ?>
<?php foreach ( $about_items as $item ) { ?>
<?php
$title = $item['crb_home_about_item_title'];
$text = $item['crb_home_about_item_text'];
$link_url = $item['crb_home_about_item_link_url'];
$link_text = $item['crb_home_about_item_link_text'];
?>
<div class="home-about-item">
<h3 class="h3-new"><?php echo $title; ?></h3>
<p>
<span><?php echo $text; ?></span>
<?php if ( !empty($link_url) ) { ?>
<a href="<?php echo $link_url; ?>">
<span><?php echo $link_text; ?></span>
<span class="icon-caret-right">
<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
</span>
</a>
<?php } ?>
</p>
</div>
<?php } ?>
<?php } ?>
</div>

</div>
</div>
</section>

<?php
$banner_image = get_field('home_banner_image', $ID);
$src = wp_get_attachment_image_url($banner_image, 'large');
$srcset = wp_get_attachment_image_srcset($banner_image, 'large');
$img = wp_get_attachment_image($loader_image, 'full', false, array('data-src' => $src, 'class' => 'lazy'));
$banner_subtitle = get_field('home_banner_subtitle', $ID);
$banner_text = get_field('home_banner_text', $ID);
?>

<section class="home-banner">
<div class="container">

<div class="home-banner-image">
<div class="post-thumbnail">
<?php //echo $img; ?>
<img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 992px) 1024px" class="lazy" />
<div class="lazy-overlay on"></div>
</div>
<div class="home-banner-content">
<h3 class="h3-new"><?php echo $banner_subtitle; ?></h3>
<p><?php echo $banner_text; ?></p>
</div>
</div>

</div>
</section>

<?php $instagram = carbon_get_theme_option('crb_theme_instagram_link'); ?>
<section class="instagram">
<div class="container">
<div class="ig-feed-title"><h2>Instagram</h2></div>
<div id="ig-feed" class="ig-feed"></div>
<div class="ig-feed-follow">
<?php if ( !empty($instagram) ) { ?>
<a href="<?php echo $instagram; ?>" target="_blank">
<span>Follow us</span>
<span class="icon-caret-right">
<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
</span>
</a>
<?php } ?>
</div>
</div>
</section>

<?php
if ( is_front_page() ) {
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			//get_template_part( 'template-parts/content', get_post_type() );
		}
	}
}
?>

</main>
</div>

<?php get_footer(); ?>

<div class="contact-float contact-float-main off">
<a href="#" class="contact-float-btn" data-toggle="class" data-target="#footer-modal" data-classes="open">
<span class="contact-bar-icon">
<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
</span>
<span>Talk to an Agent</span>
</a>
</div>

<script>
jQuery(document).ready(function($){

var nav = $('#main-navigation');
var content = $('#content');
var button = $('#toggle-button');
var top = $(window).scrollTop();
var navHeight = nav.outerHeight();
var height = top + navHeight;
var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

function on(){
if ( width <= 1280 ) {
	nav.addClass('on');
	nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-color.svg' ?>');
} else {
	nav.removeClass('on');
	nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-white.svg' ?>');
}
} on();
$(window).resize(function(){
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

nav.mouseover(function(){
	if ( !nav.hasClass('on') && !nav.hasClass('sticky') ) {
		nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-color.svg' ?>');
	}
});

nav.mouseout(function(){
	if ( !nav.hasClass('on') && !nav.hasClass('sticky') ) {
		nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-white.svg' ?>');
	}
});

function sticky(){
	var top = $(window).scrollTop();
	var navHeight = $('#main-navigation').outerHeight();
	var sliderHeight = $('#slider').outerHeight();

	if ( top > sliderHeight ) {
		nav.addClass('sticky');
		content.addClass('sticky');
		nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-color.svg' ?>');
	} else {
		nav.removeClass('sticky');
		content.removeClass('sticky');
		if ( !nav.hasClass('on') ) {
			nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-white.svg' ?>');
		}
	}
} sticky();
$(window).scroll(sticky);

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
	responsive: [
		{
			breakpoint: 769,
			settings: {
				fade: false,
				swipe: true,
				speed: 300,
				arrows: false
			}
		}
	]
});

function sliderContent(){
	var width = $(window).width();
	var slide = $('.slick-slide');
	var slideHeight = slide.outerHeight();
	var arrow = $('.slick-arrow');
	var dots = $('.slick-dots');
	
	slide.each(function(index){
		if ( width < 768 ) {
			var content = $(this).find('.slide-content').outerHeight() - 15;
			//console.log(content);
			$(this).css('margin-bottom', content);
			$(this).find('.slide-content').css('margin-bottom', content * -1);
			dots.css('bottom', content + (15 + 36));
		} else if ( width < 992 ) {
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
	
	arrow.each(function(index){
		//if ( width < 768 ) {
			$(this).css('top', slideHeight/2);
		//} else {
			//$(this).css('top', '');
		//}
	});
}
$(window).load(sliderContent);
$(window).resize(sliderContent);

});
</script>

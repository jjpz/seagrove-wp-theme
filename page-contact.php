<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>

<?php
$data = array(
	'current_page' => 1,
	'max_page' => 1
);
wp_localize_script( 'listings-js', 'helper', $data );
?>

<?php
$ID = get_the_ID();
$title = get_the_title();
$alt_title = get_field('contact_alt_title', $ID);
$subtitle = get_field('contact_subtitle', $ID);
$form_title = get_field('contact_form_title', $ID);
$shortcode = get_field('contact_form_shortcode', $ID);
$lat = carbon_get_theme_option('crb_theme_lat');
$lng = carbon_get_theme_option('crb_theme_lng');
$address = carbon_get_theme_option('crb_theme_address');
$city = carbon_get_theme_option('crb_theme_city');
$state = carbon_get_theme_option('crb_theme_state');
$zipcode = carbon_get_theme_option('crb_theme_zipcode');
$phone = carbon_get_theme_option('crb_theme_phone');
$email = carbon_get_theme_option('crb_theme_email');
$marker = get_stylesheet_directory_uri() . '/icons/map-marker-logo.svg';

$locations[] = array(
	'lat' => $lat,
	'lng' => $lng,
	'marker' => $marker,
	'marker_type' => 'logo'
);
?>

<div id="primary" class="content-area">
<main id="main" class="site-main">

<div class="contact-page">
<div class="container">
<div class="row no-gutters">

<div class="col-lg-6 property-col">
<div class="contact-content">

<h1><?php if ( !empty($alt_title) ) { echo $alt_title; } else { echo $title; } ?></h1>
<?php if ( !empty($subtitle) ) { ?>
<h2 class="h2"><?php echo $subtitle; ?></h2>
<?php } ?>

<hr class="separator">

<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		echo '<div class="contact-entry">';
		the_content();
		echo '</div>';
	}
}
?>

<div class="contact-info">
<?php if ( !empty($address) && !empty($city) && !empty($state) && !empty($zipcode) ) { ?>
<p>
	<a href="https://www.google.com/maps/dir//<?php echo $address .','. $city .','. $state .','. $zipcode ?>" target="_blank">
		<span class="icon">
			<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384 512" style="enable-background:new 0 0 384 512;" xml:space="preserve">
			<path fill="#002C3F" d="M172.3,501.7C27,291,0,269.4,0,192C0,86,86,0,192,0s192,86,192,192c0,77.4-27,99-172.3,309.7C202.2,515.4,181.8,515.4,172.3,501.7L172.3,501.7zM192,272c44.2,0,80-35.8,80-80s-35.8-80-80-80s-80,35.8-80,80S147.8,272,192,272z"/>
			</svg>
		</span>
		<span class="text">
			<?php echo $address ?>, <?php echo $city ?>, <?php echo $state ?>, <?php echo $zipcode ?>
		</span>
	</a>
</p>
<?php } ?>
<?php if ( !empty($email) ) { ?>
<p>
	<a href="mailto:<?php echo $email; ?>" target="_blank">
		<span class="icon">
			<svg version="1.1" id="Layer_1" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
			<path fill="currentColor" d="M464,64H48C21.5,64,0,85.5,0,112v288c0,26.5,21.5,48,48,48h416c26.5,0,48-21.5,48-48V112C512,85.5,490.5,64,464,64zM464,112v40.8c-22.4,18.3-58.2,46.7-134.6,106.5c-16.8,13.2-50.2,45.1-73.4,44.7c-23.2,0.4-56.6-31.5-73.4-44.7C106.2,199.5,70.4,171.1,48,152.8V112H464zM48,400V214.4c22.9,18.3,55.4,43.9,104.9,82.6c21.9,17.2,60.1,55.2,103.1,55c42.7,0.2,80.5-37.2,103.1-54.9c49.5-38.8,82-64.4,104.9-82.7V400H48z"/>
			</svg>
		</span>
		<span class="text"><?php echo $email; ?></span>
	</a>
</p>
<?php } ?>
<?php if ( !empty($phone) ) { ?>
<p>
	<a href="#" class="" data-toggle="class" data-target="#footer-modal" data-classes="open">
		<span class="icon">
			<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
		</span>
		<span class="text"><?php echo $phone; ?></span>
	</a>
</p>
<?php } ?>
</div>

<?php if ( !empty($shortcode) ) { ?>
<div class="contact-form">

<?php if ( !empty($form_title) ) { ?>
<h3><?php echo $form_title; ?></h3>
<?php } ?>

<?php echo do_shortcode($shortcode); ?>

</div>
<?php } ?>

</div>
</div>

<div class="col-lg-6 property-col">
<div id="map" class="single-map contact-map"></div>
<a href="https://www.google.com/maps/dir//<?php echo $address .','. $city .','. $state .','. $zipcode ?>" target="_blank" class="map-dir-btn">
	<span>Directions</span>
	<span class="icon-caret-right">
		<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
	</span>
</a>
</div>

</div>
</div>
</div>

</main>
</div>

<?php get_footer(); ?>

<?php if ( $locations ) { ?>
<script>
var locations = <?php echo json_encode($locations); ?>;
console.log(locations);
</script>
<?php } ?>

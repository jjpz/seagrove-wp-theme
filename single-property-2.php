<?php get_header('agent'); ?>

<div id="primary" class="content-area">
<main id="main" class="site-main">

<?php
$data = array(
	'current_page' => 1,
	'max_page' => 1
);
wp_localize_script( 'listings-js', 'helper', $data );
?>

<?php
if ( have_posts() ) { $count = 0;
while ( have_posts() ) {
the_post();
$count++;
global $post;
$ID = $post->ID;
$title = $post->post_title;
$lat = get_post_meta($ID, 'lat', true);
$lng = get_post_meta($ID, 'lng', true);
$number = rtrim(get_post_meta($ID, 'street_number', true));
$street = get_post_meta($ID, 'route', true);
$route = get_post_meta($ID, 'route', true);
$unit = get_post_meta($ID, 'unit', true);
$city = get_post_meta($ID, 'locality', true);
$state = get_post_meta($ID, 'administrative_area_level_1', true);
$zipcode = get_post_meta($ID, 'postal_code', true);
$country = get_post_meta($ID, 'country', true);
$availability = get_field('property_availability', $ID);
$status = get_field('property_status', $ID);
$type = get_field('property_type', $ID);
$bed = get_field('property_beds', $ID);
$bath = get_field('property_bath', $ID);
$size = number_format( (float) get_field( 'property_size', $ID ) );
$lot = number_format( (float) get_field( 'property_size_lot', $ID ) );
$price = number_format( (float) get_field( 'property_price', $ID ) );
$price_note_above = get_field('property_price_note_above', $ID);
$price_note_below = get_field('property_price_note_below', $ID);
$video_url = get_field('video_tour_url', $ID);
$tour_url = get_field('3d_tour_url', $ID);
//$agents = get_field('property_agents', $ID);
$gallery = carbon_get_post_meta($ID, 'crb_property_media_gallery');

if ( $availability == 'Yes' ) {
	$marker = get_stylesheet_directory_uri() . '/icons/map-marker-aqua.svg';
} else {
	$marker = get_stylesheet_directory_uri() . '/icons/map-marker-red.svg';
}

$locations[] = array(
	'title' => $title,
	'lat' => $lat,
	'lng' => $lng,
	'street_number' => $street,
	'route' => $route,
	'unit' => $unit,
	'locality' => $city,
	'administrative_area_level_1' => $state,
	'postal_code' => $zipcode,
	'country' => $country,
	'marker' => $marker
);

if ( $availability == 'Yes' ) {
	$avail = 'avail';
	if ( $status == 'Sale' ) {
		$text = 'Available For Sale';
		$price_top = 'offered for';
		$price_bottom = '';
	} else {
		$text = 'Available For Rent';
		$price_top = 'offered for';
		$price_bottom = 'per month';
	}
} else {
	$avail = 'no-avail';
	if ( $status == 'Sale' ) {
		$text = 'Sold';
		$price_top = 'sold for';
		$price_bottom = '';
	} else {
		$text = 'Leased';
		$price_top = 'leased for';
		$price_bottom = 'per month';
	}
}
?>

<header class="property-header <?php echo $avail; ?>">
	<div class="container-fluid">
		<h2 class="property-title"><?php echo $title; ?></h2>
		<h4 class="property-subtitle"><?php echo $text; ?></h4>
	</div>
</header>

<div class="super">

<?php if( isset( $gallery ) && is_array( $gallery ) && !empty( $gallery ) ) { ?>

<section class="slider-section property-slider super-sticky">
	<div id="slider" class="slider">
		<?php foreach ( $gallery as $image ) { ?>
		<?php
		if ( wp_is_mobile() ) {
			$src = wp_get_attachment_image_url($image, 'medium_large');
			$srcset = wp_get_attachment_image_srcset($image, 'medium_large');
			$img = wp_get_attachment_image($image, 'thumbnail', false, array('src' => '', 'data-lazy' => $src));
		} else {
			$src = wp_get_attachment_image_url($image, 'full');
			$srcset = wp_get_attachment_image_srcset($image, 'full');
			$img = wp_get_attachment_image($image, 'thumbnail', false, array('src' => '', 'data-lazy' => $src));
		}
		?>
		<div class="slide property-slide" data-nav-title="<?php?>">
			<div class="slide-image property-slide-image">
				<?php echo $img; ?>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<?php } ?>

<div class="super-scroll">

<section class="property-content">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-lg-6 property-col">
				<div class="property-info">
					<div class="property-address">
						<h1><?php echo $number; ?></h1>
						<?php if ( !empty($unit) ) { ?>
						<h3><?php echo $unit; ?></h3>
						<?php } ?>
						<h2 class="h2"><?php echo $city; ?>, <?php echo $state; ?></h2>
					</div>
					<div class="property-meta">
						<?php if( isset($bed) && !empty($bed) && $bed != 0 ) { ?><h3><b><?php echo $bed; ?></b> bed</h3> <?php } ?>
						<?php if( isset($bath) && !empty($bath) && $bath != 0 ) { ?><h3><b><?php echo $bath; ?></b> bath</h3> <?php } ?>
						<?php if( isset($size) && !empty($size) && $size != 0 ) { ?><h3><b><?php echo $size; ?></b> sqft</h3> <?php } ?>
						<?php if( isset($lot) && !empty($lot) && $lot != 0 ) { ?><h3><b><?php echo $lot; ?></b> sqft lot</h3> <?php } ?>
					</div>
					<div class="property-desc">
						<?php the_content() ?>
					</div>
					<?php if ( !empty($video_url) || !empty($tour_url) ) { ?>
					<div class="property-links">
						<?php if ( !empty($tour_url) ) { ?>
						<a href="<?php echo $tour_url; ?>" target="_blank">
							<span class="icon">
							<svg version="1.1" id="Layer_1" class="icon-3d" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="200px" height="210px" viewBox="0 0 200 210" enable-background="new 0 0 200 210" xml:space="preserve">
							<g>
								<polygon fill="currentColor" opacity="1" enable-background="new    " points="100.001,5 6.395,56.059 100.043,106.479 193.56,56.587 	"/>
								<path fill="currentColor" opacity="1" enable-background="new    " d="M6.359,75.342v84.01L91.486,205v-83.6L6.359,75.342z M55.647,172.391
									c-2.003-0.348-4.189-1.094-6.506-2.242c-15.975-7.924-19.4-23.172-19.582-23.963l10.911-0.551
									c0.044,0.454,0.747,9.205,8.549,13.094c0.963,0.471,1.874,0.787,2.7,0.93c2.882,0.507,4.773-1.045,4.748-4.883
									c-0.028-4.987-3.389-10.17-7.54-12.239c-0.852-0.405-1.585-0.583-1.972-0.651c-0.188-0.023-0.286-0.046-0.289-0.046l-0.052-8.649
									l2.574,1.283c0.523,0.258,1.039,0.435,1.542,0.514c2.536,0.449,4.669-1.219,4.653-4.723c-0.023-3.738-3.126-7.951-6.454-9.611
									c-0.869-0.434-1.65-0.69-2.342-0.795c-4.486-0.801-5.316,3.892-5.363,4.142l-9.326-9.698c0.092-0.394,1.798-7.978,10.879-6.382
									c1.779,0.317,3.84,1.005,6.222,2.19c9.876,4.896,17.088,15.498,17.147,25.355c0.026,4.773-1.712,7.555-4.532,8.596
									c4.042,4.746,6.645,10.457,6.678,16.59C68.335,169.453,63.286,173.732,55.647,172.391z"/>
								<g>
									<path fill="currentColor" opacity="1" enable-background="new    " d="M148.505,124.364c-1.404,0.259-2.934,0.766-4.543,1.56l-1.902,0.952
										l-0.172,35.935l1.92-0.939c9.137-4.553,15.408-15.438,15.504-25.602C159.354,127.91,155.135,123.191,148.505,124.364z"/>
									<path fill="currentColor" opacity="1" enable-background="new    " d="M108.515,121.4V205l85.127-45.648V75.757L108.515,121.4z M145.202,173.48
										l-15.696,7.811l0.25-60.62l15.696-7.812c2.718-1.344,5.359-2.237,7.857-2.674c11.137-1.963,19.402,4.971,19.34,19.364
										C172.571,147.268,160.099,166.079,145.202,173.48z"/>
								</g>
							</g>
							</svg>
							</span>
							<h3>3D tour</h3>
						</a>
						<?php } ?>
						<?php if ( !empty($video_url) ) { ?>
						<a href="#" data-toggle="class" data-target="#youtube-modal" data-classes="open">
							<span class="icon">
							<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" class="svg-inline--fa fa-youtube fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>
							</span>
							<h3>video tour</h3>
						</a>
						<?php } ?>
					</div>
					<?php } ?>
					<?php if ( isset( $price ) && !empty($price) && $price != 0 ) { ?>
					<div class="property-price <?php echo $avail; ?>">
						<?php if ( !empty($price_note_above) ) { ?>
						<h6 class="price-title"><?php echo $price_note_above; ?></h6>
						<?php } else { ?>
						<h6 class="price-title"><?php echo $price_top; ?></h6>
						<?php } ?>
						<h3 class="price-number">$<?php echo $price; ?></h3>
						<?php if ( !empty($price_note_below) ) { ?>
						<h6 class="price-subtitle"><?php echo $price_note_below; ?></h6>
						<?php } else { ?>
						<?php if ( $price_bottom != '' ) { ?>
						<h6 class="price-subtitle"><?php echo $price_bottom; ?></h6>
						<?php } ?>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-6 property-col">
				<div id="map" class="single-map property-map"></div>
				<a href="https://www.google.com/maps/dir//<?php echo $number . $street .','. $city .','. $state .','. $zipcode ?>/@<?php echo $lat ?>,<?php echo $lng ?>,17z/" target="_blank" class="map-dir-btn">
					<span>Directions</span>
					<span class="icon-caret-right">
						<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
					</span>
				</a>
			</div>
		</div>
	</div>
</section>

</div>

</div>

<section class="property-specialists">
<div class="container">
<div class="property-agents">
<div class="row no-gutters">
<div class="col-12">
<h2 class="h2">Your Sea Grove Agent</h2>
</div>

<?php
$agent;
$var = get_query_var('_agent');
$agents = get_posts(array(
'post_type' => 'agent',
'post_status' => 'publish',
'posts_per_page' => -1
));

foreach ( $agents as $value) {
$name = $value->post_name;
if ( $var == $name ) {
$agent = $value;
}
}

$agent_id = $agent->ID;
$image = get_the_post_thumbnail_url($agent_id, 'full');
$name = $agent->post_title;
$link = get_the_permalink($agent_id);
$phone = get_field('agent_phone', $agent_id);
$email = get_field('agent_email', $agent_id);
?>

<div class="col-lg-6 property-agent">
	<div class="property-agent-info">
		<div class="property-agent-image">
			<div class="agent-avatar">
				<a href="<?php echo $link; ?>">
					<div class="post-thumbnail">
						<!--<img src="<?php echo $image; ?>" class="agent-img" alt="<?php echo $name; ?>" />-->
						<?php echo get_the_post_thumbnail($agent_id, 'full'); ?>
					</div>
				</a>
			</div>
		</div>
		<div class="property-agent-contact">
			<div class="agent-name"><h3 class="h3-new"><a href="<?php echo $link; ?>"><?php echo $name; ?></a></h3></div>
			<?php if ( !empty($phone) ) { ?>
			<div class="agent-phone">
				<a href="#" class="" data-toggle="class" data-target="#agent-modal-<?php echo $agent_id ?>" data-classes="open">
					<span class="icon">
						<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
					</span>
					<span class=""><?php echo $phone; ?></span>
				</a>
			</div>
			<?php } ?>
			<?php if ( !empty($email) ) { ?>
			<div class="agent-email">
				<a href="mailto:<?php echo $email; ?>" target="_blank">
					<span class="icon">
						<svg version="1.1" id="Layer_1" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
						<path fill="currentColor" d="M464,64H48C21.5,64,0,85.5,0,112v288c0,26.5,21.5,48,48,48h416c26.5,0,48-21.5,48-48V112C512,85.5,490.5,64,464,64zM464,112v40.8c-22.4,18.3-58.2,46.7-134.6,106.5c-16.8,13.2-50.2,45.1-73.4,44.7c-23.2,0.4-56.6-31.5-73.4-44.7C106.2,199.5,70.4,171.1,48,152.8V112H464zM48,400V214.4c22.9,18.3,55.4,43.9,104.9,82.6c21.9,17.2,60.1,55.2,103.1,55c42.7,0.2,80.5-37.2,103.1-54.9c49.5-38.8,82-64.4,104.9-82.7V400H48z"/>
						</svg>
					</span>
					<span class=""><?php echo $email; ?></span>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

<div id="agent-modal-<?php echo $agent_id ?>" class="modal contact-modal">
	<a class="modal-overlay" data-toggle="class" data-target="#agent-modal-<?php echo $agent_id ?>" data-classes="open"></a>
	<div class="modal-container">
		<div class="modal-content">
			<h6>Contact</h6>
			<h3 class="h3-new"><?php echo $name; ?></h3>
			<h3><?php echo $phone; ?></h3>
			<div class="modal-buttons">
				<div class="modal-button"><a href="sms://<?php echo $phone; ?>" class="btn-modal">Text</a></div>
				<div class="modal-button"><a href="tel://<?php echo $phone; ?>" class="btn-modal">Call</a></div>
			</div>
		</div>
	</div>
</div>

</div>
</div>
</div>
</section>

<footer class="property-footer">
	<div class="container">
		<div class="contact-bar property-contact-bar">
			<div class="contact-bar-container">
				<div class="row no-gutters justify-content-between contact-bar-row">
					<div class="col-md-6 col-sm-12 contact-col">
						<div class="contact-property-address">
							<a>
								<span class="contact-bar-icon">
									<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="door-open" class="svg-inline--fa fa-door-open fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M624 448h-80V113.45C544 86.19 522.47 64 496 64H384v64h96v384h144c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM312.24 1.01l-192 49.74C105.99 54.44 96 67.7 96 82.92V448H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h336V33.18c0-21.58-19.56-37.41-39.76-32.17zM264 288c-13.25 0-24-14.33-24-32s10.75-32 24-32 24 14.33 24 32-10.75 32-24 32z"></path></svg>
								</span>
								<span class="">
									<span><?php echo (isset( $number ) && $number != '') ? $number . ', ' : ''; ?></span>
									<span><?php //echo (isset( $street ) && $street != '') ? $street : ''; ?></span>
									<span><?php echo (isset( $city ) && $city != '') ? $city . ', ' : ''; ?></span>
									<span><?php echo (isset( $state ) && $state != '') ? $state : ''; ?></span>
								</span>
							</a>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 contact-col">
						<div class="contact-property-contact">
							<?php if ( !empty($agents) ) { ?>
							<a href="#" class="" data-toggle="class" data-target="#agent-modal-<?php echo $agent_id; ?>" data-classes="open">
							<?php } else { ?>
							<a href="#" class="" data-toggle="class" data-target="#contact-modal" data-classes="open">
							<?php } ?>
								<span class="contact-bar-icon">
									<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
								</span>
								<span>Request more info</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php if ( !empty($video_url) ) { ?>
<?php $video_url = str_replace( 'youtu.be', 'youtube.com/embed', $video_url ); ?>
<div id="youtube-modal" class="modal youtube-modal">
	<a class="modal-overlay" data-toggle="class" data-target="#youtube-modal" data-classes="open"></a>
	<div class="modal-container">
		<div id="yt-player" class="modal-content">
			<iframe width="800" height="450" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
</div>
<?php } ?>

<?php
}
}
?>

</main>
</div>

<?php get_footer('agent'); ?>

<?php if ( $locations ) { ?>
<script>
var locations = <?php echo json_encode($locations); ?>;
console.log(locations);
</script>
<?php } ?>

<script>
jQuery(document).ready(function($){
$('#slider').slick({
	lazyLoad: 'ondemand',
	infinite: true,
	slidesToShow: 1,
	slidesToScroll: 1,
	fade: true,
	speed: 500,
	cssEase: 'linear',
	prevArrow: '<a class="slick-arrow slick-prev"><img src="<?php echo get_stylesheet_directory_uri() . '/icons/icon-arrow-left.svg' ?>"></a>',
	nextArrow: '<a class="slick-arrow slick-next"><img src="<?php echo get_stylesheet_directory_uri() . '/icons/icon-arrow-right.svg' ?>"></a>',
	dots: true,
	responsive: [
		{
			breakpoint: 769,
			settings: {
				fade: false,
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
	arrow.each(function(index){
		$(this).css('top', slideHeight/2);
	});
}
$(window).load(sliderContent);
$(window).resize(sliderContent);

$('.modal-overlay').click(function(){
	$("#yt-player iframe").attr("src", $("#yt-player iframe").attr("src"));
});
});
</script>

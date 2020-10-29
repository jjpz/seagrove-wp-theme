<?php get_header(); ?>

<?php //if ( get_query_var('home') ) { ?>

<?php //} else { ?>

<?php $agent_id = get_queried_object_id(); ?>

<?php
$load_search = get_query_var('search');
$load_price_min = get_query_var('price_min');
$load_price_max = get_query_var('price_max');
$load_availability = get_query_var('availability');
$load_type = get_query_var('type');
$load_status = get_query_var('status');
$load_bed = get_query_var('bed');
$load_bath = get_query_var('bath');
$load_hood = get_query_var('hood');
$load_sort_by = get_query_var('sort_by');
$load_sort_order = get_query_var('sort_order');

if ($load_search) {
	$load_search = rawurldecode($load_search);
}

$meta_query = array('relation' => 'AND');

$meta_query[] = array(
	'key' => 'property_agents',
	'value' => $agent_id,
	'compare' => 'LIKE'
);

if ($load_availability) {
	$meta_query[] = array(
		'key' => 'property_availability',
		'value' => $load_availability,
		'compare' => '='
	);
}
if ($load_type) {
	$meta_query[] = array(
		'key' => 'property_type',
		'value' => $load_type,
		'compare' => '='
	);
}
if ($load_status) {
	$meta_query[] = array(
		'key' => 'property_status',
		'value' => $load_status,
		'compare' => '='
	);
}
if ($load_bed) {
	$meta_query[] = array(
		'key' => 'property_beds',
		'value' => $load_bed,
		'compare' => '>='
	);
}
if ($load_bath) {
	$meta_query[] = array(
		'key' => 'property_bath',
		'value' => $load_bath,
		'compare' => '>='
	);
}

if ( $load_price_min && $load_price_max ) {
	$meta_query[] = array(
		'key' => 'property_price',
		'value' => array( $load_price_min, $load_price_max ),
		'type' => 'numeric',
		'compare' => 'between'
	);
} else {
	if ( $load_price_min ) {
		$meta_query[] = array(
			'key' => 'property_price',
			'value' => $load_price_min,
			'type' => 'numeric',
			'compare' => '>'
		);
	}
	if ( $load_price_max ) {
		$meta_query[] = array(
			'key' => 'property_price',
			'value' => $load_price_max,
			'type' => 'numeric',
			'compare' => '<'
		);
	}
}

$tax_query = array();
if ($load_hood) {
	$tax_query[] = array(
		'taxonomy' => 'neighborhood',
		'field' => 'slug',
		'terms' => $load_hood
	);
}

$args = array(
	'post_type' => 'property',
	'post_status' => 'publish',
	'posts_per_page' => 30,
	's' => $load_search,
	'meta_query' => $meta_query,
	'tax_query' => $tax_query,
	'orderby' => 'date',
	'order' => 'desc'
);

if ( $load_sort_by && $load_sort_order ) {
	if ( $load_sort_by === 'property_availability' ) {
		$args['meta_key'] = $load_sort_by;
		$args['orderby'] = array('meta_value' => 'DESC', 'date' => 'DESC');
		$args['order'] = $load_sort_order;
	} else {
		$args['meta_key'] = $load_sort_by;
		$args['orderby'] = 'meta_value_num';
		$args['order'] = $load_sort_order;
	}
}

$listings = new WP_Query( $args );

$data = array(
	'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
	'current_page' => get_query_var( 'page' ) ? get_query_var('page') : 1,
	'max_page' => $listings->max_num_pages,
	'security_filter' => wp_create_nonce('seagrove_filter_properties'),
	'security_load' => wp_create_nonce('seagrove_loadmore_properties')
);
wp_localize_script( 'listings-js', 'helper', $data );

$terms = get_terms( array(
	'taxonomy' => 'neighborhood'
) );
if ( ! empty ( $terms ) ) {
	foreach ( $terms as $term ) {
		$term_name = $term->name;
		$term_slug = $term->slug;
		$hoods[] = $term_slug;
	}
}
?>

<div id="primary" class="content-area">
<main id="main" class="site-main">

<?php
if ( have_posts() ) { $count = 0;
while ( have_posts() ) {
the_post();
$count ++;
global $post;
$thumbnail = get_the_post_thumbnail($post->ID);
$image = get_the_post_thumbnail_url($post->ID, 'full');
$src = get_the_post_thumbnail_url($ID, 'large');
$srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'large');
$name = $post->post_title;
$position = get_field('agent_position', $post->ID);
$phone = get_field('agent_phone', $post->ID);
$email = get_field('agent_email', $post->ID);
$zillow = get_field('agent_zillow', $post->ID);
$facebook = get_field('agent_facebook', $post->ID);
$instagram = get_field('agent_instagram', $post->ID);
$linkedin = get_field('agent_linkedin', $post->ID);
$education = carbon_get_post_meta($post->ID, 'crb_agent_education');
$languages = carbon_get_post_meta($post->ID, 'crb_agent_languages');
$community = carbon_get_post_meta($post->ID, 'crb_agent_community');
?>

<header class="agent-header">
	<div class="agent-header-bg" style="background-image: url('<?php echo get_stylesheet_directory_uri() . '/images/agent-header-bg.svg' ?>')"></div>
	<div class="row agent-info">
		<?php if ( !empty($thumbnail) ) { ?>
		<div class="col-sm-6 agent-image">
			<div class="agent-avatar">
				<!--<img src="<?php //echo $image; ?>" class="agent-img" alt="<?php //echo $name; ?>" />-->
				<?php //seagrove_post_thumbnail(); ?>
				<div class="post-thumbnail">
					<img src="" srcset="" data-src="<?php echo $src; ?>" data-srcset="<?php echo $srcset; ?>" class="lazy" />
					<div class="lazy-overlay team-overlay on"></div>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="col-sm-6 agent-contact">
			<div class="agent-contact-info agent-name"><h1><?php echo $name; ?></h1></div>
			<?php if ( !empty($position) ) { ?>
			<div class="agent-contact-info agent-position"><h3><?php echo $position; ?></h3></div>
			<?php } ?>
			<?php if ( !empty($phone) ) { ?>
			<div class="agent-contact-info agent-phone">
				<a href="#" class="" data-toggle="class" data-target="#agent-modal" data-classes="open">
					<span class="icon">
						<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
					</span>
					<span class=""><?php echo $phone; ?></span>
				</a>
			</div>
			<?php } ?>
			<?php if ( !empty($email) ) { ?>
			<div class="agent-contact-info agent-email">
				<a href="mailto:<?php echo $email; ?>" target="_blank">
					<span class="icon">
						<svg version="1.1" id="Layer_1" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
						<path fill="#002C3F" d="M464,64H48C21.5,64,0,85.5,0,112v288c0,26.5,21.5,48,48,48h416c26.5,0,48-21.5,48-48V112C512,85.5,490.5,64,464,64zM464,112v40.8c-22.4,18.3-58.2,46.7-134.6,106.5c-16.8,13.2-50.2,45.1-73.4,44.7c-23.2,0.4-56.6-31.5-73.4-44.7C106.2,199.5,70.4,171.1,48,152.8V112H464zM48,400V214.4c22.9,18.3,55.4,43.9,104.9,82.6c21.9,17.2,60.1,55.2,103.1,55c42.7,0.2,80.5-37.2,103.1-54.9c49.5-38.8,82-64.4,104.9-82.7V400H48z"/>
						</svg>
					</span>
					<span class=""><?php echo $email; ?></span>
				</a>
			</div>
			<?php } ?>
			<?php if ( !empty($zillow) ) { ?>
			<div class="agent-contact-info agent-zillow">
				<a href="<?php echo $zillow; ?>" target="_blank">
					<span class="icon">
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="23px" height="19px" viewBox="0 0 23 19" enable-background="new 0 0 23 19" xml:space="preserve">
						<g>
						<path fill-rule="evenodd" clip-rule="evenodd" fill="#002C3F" d="M12.536,0.333c-1.278,0.592-4.951,3.435-6.936,4.924c2.414-0.806,8.205-2.088,11.172-2.156C15.841,2.447,13.237,0.676,12.536,0.333"/>
						<path fill-rule="evenodd" clip-rule="evenodd" fill="#002C3F" d="M0.974,18.667c0.82-0.36,8.564-2.938,15.686-3.365c0.148-0.597,0.931-2.611,1.076-3.156c-7.387,0.524-13.396,2.729-15.808,3.848L0.974,18.667z"/>
						<path fill-rule="evenodd" clip-rule="evenodd" fill="#002C3F" d="M17.322,3.484c0,0-7.188,7.224-8.313,8.259c2.186-0.788,6.666-1.729,9.506-1.901c0.331-1.008,0.685-1.735,0.685-1.735L23,7.727C23,7.727,20.107,5.39,17.322,3.484"/>
						<path fill-rule="evenodd" clip-rule="evenodd" fill="#002C3F" d="M2.207,15.214c2.266-2.325,10.411-9.845,10.411-9.845c-4.239,0.99-8.662,2.334-10.24,3.054L0,10.867c1.984-0.424,2.627-0.509,4.082-0.719L2.207,15.214z"/>
						</g>
						</svg>
					</span>
					<span class="">Zillow Profile</span>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
</header>

<section class="agent-content">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="agent-resume">
					<?php if ( !empty($education) ) { ?>
						<div class="agent-education">
							<h2>Education</h2>
							<ul>
								<?php foreach( $education as $key => $value ) { ?>
									<li><?php echo $value['agent_education']; ?></li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
					<?php if ( !empty($languages) ) { ?>
						<div class="agent-languages">
							<h2>Languages</h2>
							<ul>
								<?php foreach( $languages as $key => $value ) { ?>
									<li><?php echo $value['agent_language']; ?></li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
					<?php if ( !empty($community) ) { ?>
						<div class="agent-community">
							<h2>Community</h2>
							<ul>
								<?php foreach( $community as $key => $value ) { ?>
									<li><?php echo $value['agent_community']; ?></li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
				</div>
				<?php if ( !empty($facebook) || !empty($instagram) || !empty($linkedin) ) { ?>
				<div class="agent-social">
					<?php if ( !empty($facebook) ) { ?>
					<a href="<?php echo $facebook; ?>" class="btn-social" target="_blank">
						<span class="icon">
							<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
							</svg>
						</span>
					</a>
					<?php } ?>
					<?php if ( !empty($instagram) ) { ?>
					<a href="<?php echo $instagram; ?>" class="btn-social" target="_blank">
						<span class="icon">
							<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
							</svg>
						</span>
					</a>
					<?php } ?>
					<?php if ( !empty($linkedin) ) { ?>
					<a href="<?php echo $linkedin; ?>" class="btn-social" target="_blank">
						<span class="icon">
							<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" class="svg-inline--fa fa-linkedin-in fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path>
							</svg>
						</span>
					</a>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<div class="col-sm-6">
				<div class="agent-about">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!--<div class="container"><hr class="agent-sep"></div>-->

<?php if ( $listings->have_posts() ) { ?>

<section class="agent-listings">
<div class="container-fluid">

<!--<div class="agent-map-header">
	<div class="agent-map-title">
		<h2><?php //echo the_title(); ?>'s Recent Activity</h2>
	</div>
	<div class="agent-map-key">
		<a>
			<span class="dot"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"><g><circle fill="#519DBB" cx="15" cy="15" r="15"></circle><circle fill="#FFFFFF" cx="15" cy="15" r="5"></circle></g></svg></span>
			<span class="dot-title">LISTINGS</span>
		</a>
		<a>
			<span class="dot"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"><g><circle fill="#EE2E4F" cx="15" cy="15" r="15"></circle><circle fill="#FFFFFF" cx="15" cy="15" r="5"></circle></g></svg></span>
			<span class="dot-title">SOLD</span>
		</a>
	</div>
</div>-->

<hr class="separator">

<header class="map-header agent-map-header">
	
		<div class="map-header-container">
			<div class="map-header-col map-header-title">
				<h2 class="h2"><span><?php echo the_title(); ?>'s</span><span>Recent Activity</span></h2>
			</div>
			<div class="map-header-col">
				<div class="map-key agent-map-key">
					<a>
						<span class="dot">
							<svg version="1.1" id="Layer_1" class="map-key-aqua" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 405 533" style="enable-background:new 0 0 405 533;" xml:space="preserve">
							<path fill="#FFFFFF" d="M388.6,123.9c-10.2-24.1-24.7-45.7-43.3-64.2c-18.6-18.6-40.2-33.1-64.2-43.3C256.2,5.9,229.8,0.5,202.5,0.5s-53.7,5.3-78.6,15.9C99.8,26.6,78.2,41.1,59.7,59.7s-33.1,40.2-43.3,64.2C5.8,148.8,0.5,175.3,0.5,202.5c0,34.8,5.7,58.8,21.1,88.6c15.7,30.5,42.1,68.1,85.9,130.5c19.3,27.5,41.1,58.6,67.1,96.3c6.3,9.1,16.8,14.6,27.9,14.6c11.2,0,21.6-5.4,27.9-14.6c26-37.7,47.8-68.8,67.1-96.3c43.7-62.3,70.1-99.9,85.9-130.5c15.4-29.8,21.1-53.8,21.1-88.6C404.5,175.3,399.2,148.8,388.6,123.9z"/>
							<path fill="#519DBB" d="M182.8,512.2C37.5,301.5,10.5,279.9,10.5,202.5c0-106,86-192,192-192s192,86,192,192c0,77.4-27,99-172.3,309.7C212.7,525.9,192.3,525.9,182.8,512.2L182.8,512.2z M202.5,282.5c44.2,0,80-35.8,80-80s-35.8-80-80-80s-80,35.8-80,80S158.3,282.5,202.5,282.5z"/>
							</svg>
						</span>
						<span class="dot-title">LISTINGS</span>
					</a>
					<a>
						<span class="dot">
							<svg version="1.1" id="Layer_1" class="map-key-red" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 405 533" style="enable-background:new 0 0 405 533;" xml:space="preserve">
							<path fill="#FFFFFF" d="M388.6,123.9c-10.2-24.1-24.7-45.7-43.3-64.2c-18.6-18.6-40.2-33.1-64.2-43.3C256.2,5.9,229.8,0.5,202.5,0.5s-53.7,5.3-78.6,15.9C99.8,26.6,78.2,41.1,59.7,59.7s-33.1,40.2-43.3,64.2C5.8,148.8,0.5,175.3,0.5,202.5c0,34.8,5.7,58.8,21.1,88.6c15.7,30.5,42.1,68.1,85.9,130.5c19.3,27.5,41.1,58.6,67.1,96.3c6.3,9.1,16.8,14.6,27.9,14.6c11.2,0,21.6-5.4,27.9-14.6c26-37.7,47.8-68.8,67.1-96.3c43.7-62.3,70.1-99.9,85.9-130.5c15.4-29.8,21.1-53.8,21.1-88.6C404.5,175.3,399.2,148.8,388.6,123.9z"/>
							<path fill="#EE2E4F" d="M182.8,512.2C37.5,301.5,10.5,279.9,10.5,202.5c0-106,86-192,192-192s192,86,192,192c0,77.4-27,99-172.3,309.7C212.7,525.9,192.3,525.9,182.8,512.2L182.8,512.2z M202.5,282.5c44.2,0,80-35.8,80-80s-35.8-80-80-80s-80,35.8-80,80S158.3,282.5,202.5,282.5z"/>
							</svg>
						</span>
						<span class="dot-title">SOLD</span>
					</a>
				</div>
				<div class="map-list-controls">
				<a href="#" class="show-map active">
						<span class="icon">
							<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marked-alt" class="svg-inline--fa fa-map-marked-alt fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M288 0c-69.59 0-126 56.41-126 126 0 56.26 82.35 158.8 113.9 196.02 6.39 7.54 17.82 7.54 24.2 0C331.65 284.8 414 182.26 414 126 414 56.41 357.59 0 288 0zm0 168c-23.2 0-42-18.8-42-42s18.8-42 42-42 42 18.8 42 42-18.8 42-42 42zM20.12 215.95A32.006 32.006 0 0 0 0 245.66v250.32c0 11.32 11.43 19.06 21.94 14.86L160 448V214.92c-8.84-15.98-16.07-31.54-21.25-46.42L20.12 215.95zM288 359.67c-14.07 0-27.38-6.18-36.51-16.96-19.66-23.2-40.57-49.62-59.49-76.72v182l192 64V266c-18.92 27.09-39.82 53.52-59.49 76.72-9.13 10.77-22.44 16.95-36.51 16.95zm266.06-198.51L416 224v288l139.88-55.95A31.996 31.996 0 0 0 576 426.34V176.02c0-11.32-11.43-19.06-21.94-14.86z"></path></svg>
						</span>
					</a>
					<a href="#" class="show-list">
						<span class="icon">
							<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="list" class="svg-inline--fa fa-list fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M80 368H16a16 16 0 0 0-16 16v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-64a16 16 0 0 0-16-16zm0-320H16A16 16 0 0 0 0 64v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16V64a16 16 0 0 0-16-16zm0 160H16a16 16 0 0 0-16 16v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-64a16 16 0 0 0-16-16zm416 176H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"></path></svg>
						</span>
					</a>
			</div>
			</div>
		</div>
	
</header>

<div id="agent-map" class="agent-map">

<?php if ( $listings->have_posts() ) { ?>

<div id="map" class="map"></div>

<div id="load-more" class="map-load-more">
	<?php if ( $listings->max_num_pages > 1 ) { echo '<a id="loadmore" class="map-load-more-btn">Load More</a>'; } ?>
</div>

<div class="map-list">

<div class="map-list-content">

<div id="listings" class="listings">

<?php while ( $listings->have_posts() ) { ?>

<?php
$listings->the_post();
$ID = $listings->post->ID;
$index = $listings->current_post;
$src = get_the_post_thumbnail_url($ID, 'large');
$src_medium = get_the_post_thumbnail_url($ID, 'medium');
$srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'large');
$image = get_the_post_thumbnail($ID, 'thumbnail', array('data-src' => $src, 'data-srcset' => $srcset, 'class' => 'lazy'));
$title = get_the_title($ID);
$url = get_the_permalink($ID);
$content = get_the_content($ID);
$lat = get_post_meta($ID, 'lat', true);
$lng = get_post_meta($ID, 'lng', true);
$street_number = rtrim(get_post_meta($ID, 'street_number', true));
$route = rtrim(get_post_meta($ID, 'route', true));
$unit = rtrim(get_post_meta($ID, 'unit', true));
$locality = rtrim(get_post_meta($ID, 'locality', true));
$administrative_area_level_1 = rtrim(get_post_meta($ID, 'administrative_area_level_1', true));
$postal_code = rtrim(get_post_meta($ID, 'postal_code', true));
$country = get_post_meta($ID, 'country', true);
$availability = get_field( 'property_availability', $ID );
$status = get_field( 'property_status', $ID );
$type = get_field( 'property_type', $ID );
$bed = get_field( 'property_beds', $ID );
$bath = get_field( 'property_bath', $ID );
$size = number_format( (float) get_field( 'property_size', $ID ) );
$lot = number_format( (float) get_field( 'property_size_lot', $ID ) );
$price = number_format( (float) get_field( 'property_price', $ID ) );
$hood = get_field( 'property_neighborhood', $ID );
if ( $hood ) {
	$hood_name = $hood->name;
}
if ( $availability == 'Yes' ) {
	$marker = get_stylesheet_directory_uri() . '/icons/map-marker-aqua.svg';
} else {
	$marker = get_stylesheet_directory_uri() . '/icons/map-marker-red.svg';
}
$locations[] = array(
	'ID' => $ID,
	'index' => $index,
	'url' => $url,
	'image' => $src_medium,
	'title' => $title,
	'lat' => $lat,
	'lng' => $lng,
	'street_number' => $street_number,
	'route' => $route,
	'unit' => $unit,
	'locality' => $locality,
	'administrative_area_level_1' => $administrative_area_level_1,
	'postal_code' => $postal_code,
	'country' => $country,
	'bed' => $bed,
	'bath' => $bath,
	'size' => $size,
	'lot' => $lot,
	'price' => $price,
	'marker' => $marker
);
?>

<article id="property-<?php echo $ID; ?>" class="list-item list-item-<?php echo $index; ?> property listing" data-index="<?php echo $index; ?>" data-id="<?php echo $ID; ?>">
	<div class="property-card">
		<div class="content">
			<div class="image">
				<div class="thumbnail">
					<?php //echo $image; ?>
					<?php if ( !empty($srcset) ) { ?>
					<img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 992px) 1024px" class="lazy" />
					<?php } ?>
					<div class="lazy-overlay on"></div>
					<?php
					if ( $availability == 'Yes' ) {
						$avail = 'avail';
						if ( $status == 'Sale' ) {
							$stat = 'sale';
							$text = 'For Sale';
						} else {
							$stat = 'rent';
							$text = 'For Rent';
						}
					} else {
						$avail = 'no-avail';
						if ( $status == 'Sale' ) {
							$stat = 'sale';
							$text = 'Sold';
						} else {
							$stat = 'rent';
							$text = 'Leased';
						}
					}
					?>
					<div class="flag <?php echo $avail . ' ' . $stat; ?>"><?php echo $text; ?></div>
				</div>
			</div>
			<div class="info">
				<div class="title">
					<h6><?php echo $title; ?></h6>
				</div>
				<div class="address">
					<span><?php echo $street_number; ?></span>
				</div>
				<div class="details">
					<?php if ( isset($bed) && !empty($bed) && $bed != 0 ) { ?>
					<span class="meta bed">&bull; <?php echo $bed; ?> bed</span>
					<?php } ?>
					<?php if ( isset($bath) && !empty($bath) && $bath != 0 ) { ?>
					<span class="meta bath">&bull; <?php echo $bath; ?> bath</span>
					<?php } ?>
					<?php if ( isset($size) && !empty($size) && $size != 0 ) { ?>
					<span class="meta size">&bull; <?php echo $size; ?> sqft</span>
					<?php } ?>
					<?php if ( isset($lot) && !empty($lot) && $lot != 0 ) { ?>
					<span class="meta lot">&bull; <?php echo $lot; ?> sqft lot</span>
					<?php } ?>
					<?php if ( isset($price) && !empty($price) && $price != 0 ) { ?>
					<span class="meta price">&bull; $<?php echo $price; ?></span>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="buttons">
			<a href="#" id="marker-link" class="marker-link" data-marker-id="<?php echo $index; ?>">Locate</a>
			<a href="<?php echo $url; ?>">View Details</a>
		</div>
	</div>
</article>

<?php } ?>
<?php wp_reset_postdata(); ?>

</div>

<div id="load-more" class="list-row">
	<?php if ( $listings->max_num_pages > 1 ) { echo '<a id="loadmore" class="load-more-btn">Load More</a>'; } ?>
</div>

</div>

<div class="map-filter-control-main"><a href="#" class="map-filter-btn">Filter & Sort</a></div>

</div>

<div class="map-filter-control-mobile"><a href="#" class="map-filter-btn">Filter & Sort</a></div>

<?php } else { ?>

<div class="filter-no-results"><p>No results found.</p></div>

<?php } ?>

<div class="map-filters-container">
	<form id="map-filters" action="" method="" name="map-filters" class="map-filters">
		<div class="form-content">
			<div id="filters" class="form-col filters">
				<div class="form-header">Filter By</div>
				
				<input type="hidden" name="agent" value="<?php echo $agent_id; ?>">
				
				<div class="form-section">
					<div class="form-section-title">Availability</div>
					<div class="buttons filter-availability" data-filter-group="availability">
						<div class="button checked">
							<input type="radio" name="availability" value="" id="avail-both" class="" data-filter="" checked>
							<label for="avail-both">Both</label>
						</div>
						<div class="button">
							<input type="radio" name="availability" value="Yes" id="avail-yes" class="" data-filter="Yes" <?php if ( $load_availability == 'Yes' ) { echo 'checked'; } ?>>
							<label for="avail-yes">Yes</label>
						</div>
						<div class="button">
							<input type="radio" name="availability" value="No" id="avail-no" class="" data-filter="No" <?php if ( $load_availability == 'No' ) { echo 'checked'; } ?>>
							<label for="avail-no">No</label>
						</div>
					</div>
				</div>
				
				<div class="form-section">
					<div class="form-section-title">Sale Type</div>
					<div class="buttons filter-status" data-filter-group="status">
						<div class="button checked">
							<input type="radio" name="status" value="" id="status-both" class="" data-filter="" checked>
							<label for="status-both">Both</label>
						</div>
						<div class="button">
							<input type="radio" name="status" value="Sale" id="status-sale" class="" data-filter="Sale" <?php if ( $load_status == 'Sale' ) { echo 'checked'; } ?>>
							<label for="status-sale">Sale</label>
						</div>
						<div class="button">
							<input type="radio" name="status" value="Lease" id="status-lease" class="" data-filter="Lease" <?php if ( $load_status == 'Lease' ) { echo 'checked'; } ?>>
							<label for="status-lease">Lease</label>
						</div>
					</div>
				</div>
				
				<div class="form-section">
					<div class="form-section-title">Property Type</div>
					<div class="buttons filter-type" data-filter-group="type">
						<div class="button checked">
							<input type="radio" name="type" value="" id="type-both" class="" data-filter="" checked>
							<label for="type-both">Both</span>
						</div>
						<div class="button">
							<input type="radio" name="type" value="Residential" id="type-residential" class="" data-filter="Residential" <?php if ( $load_type == 'Residential' ) { echo 'checked'; } ?>>
							<label for="type-residential">Residential</label>
						</div>
						<div class="button">
							<input type="radio" name="type" value="Commercial" id="type-commercial" class="" data-filter="Commercial" <?php if ( $load_type == 'Commercial' ) { echo 'checked'; } ?>>
							<label for="type-commercial">Commercial</label>
						</div>
					</div>
				</div>
				
				<div class="form-section">
					<div class="form-section-title">Bed</div>
					<div class="buttons filter-beds">
						<div class="button checked">
							<input type="radio" name="bed" id="bed-any" value="" checked>
							<label for="bed-any">Any</label>
						</div>
						<div class="button">
							<input type="radio" name="bed" id="bed-1" value="1" <?php if ( $load_bed == '1' ) { echo 'checked'; } ?>>
							<label for="bed-1">1+</label>
						</div>
						<div class="button">
							<input type="radio" name="bed" id="bed-2" value="2" <?php if ( $load_bed == '2' ) { echo 'checked'; } ?>>
							<label for="bed-2">2+</label>
						</div>
						<div class="button">
							<input type="radio" name="bed" id="bed-3" value="3" <?php if ( $load_bed == '3' ) { echo 'checked'; } ?>>
							<label for="bed-3">3+</label>
						</div>
						<div class="button">
							<input type="radio" name="bed" id="bed-4" value="4" <?php if ( $load_bed == '4' ) { echo 'checked'; } ?>>
							<label for="bed-4">4+</label>
						</div>
						<div class="button">
							<input type="radio" name="bed" id="bed-5" value="5" <?php if ( $load_bed == '5' ) { echo 'checked'; } ?>>
							<label for="bed-5">5+</label>
						</div>
					</div>
				</div>
				
				<div class="form-section">
					<div class="form-section-title">Bath</div>
					<div class="buttons filter-bath">
						<div class="button checked">
							<input type="radio" name="bath" id="bath-any" value="" checked>
							<label for="bath-any">Any</label>
						</div>
						<div class="button">
							<input type="radio" name="bath" id="bath-1" value="1" <?php if ( $load_bath == '1' ) { echo 'checked'; } ?>>
							<label for="bath-1">1+</label>
						</div>
						<div class="button">
							<input type="radio" name="bath" id="bath-2" value="2" <?php if ( $load_bath == '2' ) { echo 'checked'; } ?>>
							<label for="bath-2">2+</label>
						</div>
						<div class="button">
							<input type="radio" name="bath" id="bath-3" value="3" <?php if ( $load_bath == '3' ) { echo 'checked'; } ?>>
							<label for="bath-3">3+</label>
						</div>
						<div class="button">
							<input type="radio" name="bath" id="bath-4" value="4" <?php if ( $load_bath == '4' ) { echo 'checked'; } ?>>
							<label for="bath-4">4+</label>
						</div>
						<div class="button">
							<input type="radio" name="bath" id="bath-5" value="5" <?php if ( $load_bath == '5' ) { echo 'checked'; } ?>>
							<label for="bath-5">5+</label>
						</div>
					</div>
				</div>
				
				<?php if ( ! empty ( $terms ) ) { ?>
				<div class="form-section">
					<div class="form-section-title">Neighborhood</div>
					<div class="form-section-content filter-hood">
						<select name="hood" data-filter-group="hood">
							<option value="" class="" data-filter="">All</option>
							<?php foreach ( $terms as $term ) { ?>
							<?php
							$term_name = $term->name;
							$term_slug = $term->slug;
							?>
							<option value="<?php echo $term_slug; ?>" class="" <?php if ( $load_hood == $term_slug ) { echo 'selected'; } ?>><?php echo $term_name; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php } ?>
				
				<div class="form-section">
					<div class="form-section-title">Price</div>
					<div class="form-section-content filter-price">
						<input type="text" name="price_min" id="price_min" placeholder="Min price" <?php if ( $load_price_min ) { echo 'value="' . $load_price_min . '"'; } ?> />
						<input type="text" name="price_max" id="price_max" placeholder="Max price" <?php if ( $load_price_max ) { echo 'value="' . $load_price_max . '"'; } ?> />
					</div>
				</div>
				
				<div class="form-section">
					<div class="form-section-title">Keyword</div>
					<div class="form-section-content filter-keyword">
						<input type="text" name="search" id="search" placeholder="gables, condo, renovation, pool, etc." <?php if ($load_search) { echo 'value="' . $load_search . '"'; } ?> />
						<button id="search-reset" class="search-reset"></button>
					</div>
				</div>
				
			</div>
			
			<div class="form-sep"></div>
			
			<div id="sorts" class="form-col sorts">
				<div class="form-header">Sort By</div>
				<div class="form-section sort-section">
					
						<ul class="sort-col">
							<li class="">
								<label for="order-date">
									<input type="radio" name="sort" value="" id="order-date" class="" data-sort-by="" data-sort-order="" checked>
									<div class="radio-check"></div>
									<div class="radio-text"><span>DATE (newest)</span></div>
								</label>
							</li>
							
							<li class="">
								<label for="order-avail">
									<input type="radio" name="sort" value="property_availability" id="order-avail" class="" data-sort-by="property_availability" data-sort-order="DESC" <?php if ( $load_sort_by == 'property_availability' && $load_sort_order == 'DESC' ) { echo 'checked'; } ?>>
									<div class="radio-check"></div>
									<div class="radio-text"><span>Availability</span></div>
								</label>
							</li>
							
							<li class="">
								<label for="order-price-low-high">
									<input type="radio" name="sort" value="property_price-ASC" id="order-price-low-high" class="" data-sort-by="property_price" data-sort-order="ASC" <?php if ( $load_sort_by == 'property_price' && $load_sort_order == 'ASC' ) { echo 'checked'; } ?>>
									<div class="radio-check"></div>
									<div class="radio-text"><span>PRICE (low to high)</span></div>
								</label>
							</li>
							<li class="">
								<label for="order-price-high-low">
									<input type="radio" name="sort" value="property_price-DESC" id="order-price-high-low" class="" data-sort-by="property_price" data-sort-order="DESC" <?php if ( $load_sort_by == 'property_price' && $load_sort_order == 'DESC' ) { echo 'checked'; } ?>>
									<div class="radio-check"></div>
									<div class="radio-text"><span>PRICE (high to low)</span></div>
								</label>
							</li>
						</ul>
						<ul class="sort-col">
							<!--<li class="">
								<label for="order-beds">
									<input type="radio" name="sort" value="property_beds-DESC" id="order-beds" class="" data-sort-by="property_beds" data-sort-order="DESC" <?php if ( $load_sort_by == 'property_beds' && $load_sort_order == 'DESC' ) { echo 'checked'; } ?>>
									<div class="radio-check"></div>
									<div class="radio-text"><span>BEDS</span></div>
								</label>
							</li>
							<li class="">
								<label for="order-bath">
									<input type="radio" name="sort" value="property_bath-DESC" id="order-bath" class="" data-sort-by="property_bath" data-sort-order="DESC" <?php if ( $load_sort_by == 'property_bath' && $load_sort_order == 'DESC' ) { echo 'checked'; } ?>>
									<div class="radio-check"></div>
									<div class="radio-text"><span>BATHS</span></div>
								</label>
							</li>-->
							<li class="">
								<label for="order-size-low-high">
									<input type="radio" name="sort" value="property_size-ASC" id="order-size-low-high" class="" data-sort-by="property_size" data-sort-order="ASC" <?php if ( $load_sort_by == 'property_size' && $load_sort_order == 'ASC' ) { echo 'checked'; } ?>>
									<div class="radio-check"></div>
									<div class="radio-text"><span>LIVING SQFT (low to high)</span></div>
								</label>
							</li>
							<li class="">
								<label for="order-size-high-low">
									<input type="radio" name="sort" value="property_size-DESC" id="order-size-high-low" class="" data-sort-by="property_size" data-sort-order="DESC" <?php if ( $load_sort_by == 'property_size' && $load_sort_order == 'DESC' ) { echo 'checked'; } ?>>
									<div class="radio-check"></div>
									<div class="radio-text"><span>LIVING SQFT (high to low)</span></div>
								</label>
							</li>
							<li class="">
								<label for="order-lot-low-high">
									<input type="radio" name="sort" value="property_size_lot-ASC" id="order-lot-low-high" class="" data-sort-by="property_size_lot" data-sort-order="ASC" <?php if ( $load_sort_by == 'property_size_lot' && $load_sort_order == 'ASC' ) { echo 'checked'; } ?>>
									<div class="radio-check"></div>
									<div class="radio-text"><span>LOT SQFT (low to high)</span></div>
								</label>
							</li>
							<li class="">
								<label for="order-lot-high-low">
									<input type="radio" name="sort" value="property_size_lot-DESC" id="order-lot-high-low" class="" data-sort-by="property_size_lot" data-sort-order="DESC" <?php if ( $load_sort_by == 'property_size_lot' && $load_sort_order == 'DESC' ) { echo 'checked'; } ?>>
									<div class="radio-check"></div>
									<div class="radio-text"><span>LOT SQFT (high to low)</span></div>
								</label>
							</li>
						</ul>
					
				</div>
			</div>
		</div>
	</form>
	<div class="form-buttons">
		<div class="form-buttons-content">
			<div class="form-buttons-inner">
				<button id="apply" class="apply btn-cta">Apply</button>
				<a href="#" id="reset" class="reset-btn">Reset all</a>
			</div>
		</div>
	</div>
	<div class="close-filters"><a href="#" class="close-button close-filter-btn"></a></div>
</div>

<div class="map-loader">
<div class="map-loader-icon">
<div class="spinner-border" role="status"></div>
</div>
</div>

</div>

</div>
</section>

<?php } ?>

<?php if ( !empty($phone) ) { ?>

<footer>
	<div class="container">
		<div class="contact-bar agent-contact-bar">
			<div class="contact-bar-container">
				<div class="row no-gutters contact-bar-row">
					<div class="contact-col">
						<div class="contact-info">
							<a href="#" class="" data-toggle="class" data-target="#agent-modal" data-classes="open">
								<span class="contact-bar-icon">
									<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
								</span>
								<span class="">Contact <?php echo $name; ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<div id="agent-modal" class="modal contact-modal">
	<a class="modal-overlay" data-toggle="class" data-target="#agent-modal" data-classes="open"></a>
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

<div class="contact-float off">
<div class="contact-float-container">
	<a href="#" class="contact-float-btn" data-toggle="class" data-target="#agent-modal" data-classes="open">
		<span class="contact-bar-icon">
		<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
		</span>
		<span class="">Contact <?php echo $name; ?></span>
	</a>
</div>
</div>

<?php } ?>

<?php
}
}
?> 

</main>
</div>

<?php //} ?>

<?php if ( $listings->have_posts() ) { ?>
<script>
<?php if ( $locations ) { ?>
var locations = <?php echo json_encode($locations); ?>;
console.log(locations);
<?php } ?>
</script>
<?php } ?>

<?php get_footer(); ?>
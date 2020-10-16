<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri() . '/favicons/apple-touch-icon.png' ?>">
<link rel="android-chrome-192x192" sizes="192x192" href="<?php echo get_stylesheet_directory_uri() . '/favicons/android-chrome-192x192.png' ?>">
<link rel="android-chrome-512x512" sizes="512x512" href="<?php echo get_stylesheet_directory_uri() . '/favicons/android-chrome-512x512.png' ?>">
<link rel="manifest" href="<?php echo get_stylesheet_directory_uri() . '/favicons/site.webmanifest' ?>">
<meta name="msapplication-TileColor" content="#FFFFFF">
<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri() . '/favicons/mstile-150x150.png' ?>">
<meta name="msapplication-config" content="<?php echo get_stylesheet_directory_uri() . '/favicons/browserconfig.xml' ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri() . '/favicons/favicon-16x16.png' ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri() . '/favicons/favicon-32x32.png' ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() . '/favicons/favicon.ico' ?>">
<?php if( is_singular('property') || is_singular('agent') ) { ?>
<?php
global $post;
$availability = get_field( 'property_availability', $post->ID );
$status = get_field( 'property_status', $post->ID );
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
<meta property="og:url"         content="<?php echo get_the_permalink($post->ID); ?>" />
<meta property="og:type"        content="website" />
<meta property="og:title"       content="<?php echo get_the_title($post->ID); ?>" />
<meta property="og:description" content="" />
<meta property="og:image"       content="<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" />
<?php } else { ?>
<meta property="og:url"         content="<?php echo home_url(); ?>" />
<meta property="og:type"        content="website" />
<meta property="og:title"       content="<?php bloginfo('name'); ?>" />
<meta property="og:description" content="" />
<meta property="og:image"       content="<?php echo get_stylesheet_directory_uri() . '/images/SeaGrove_meta-image.png'; ?>" />
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="loader" class="loader">
<div class="loader-logo">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 800 800" style="enable-background:new 0 0 800 800;" xml:space="preserve">
<g>
	<defs>
		<path id="SVGID_1_" d="M399.593,386.891c59.586,0,122.192,29.861,122.192,95.414c0,65.491-53.741,102.108-122.192,102.108
			c-60.017,0-119.59-31.118-133.275-80.384l-79.892,33.88C211.959,618.81,292.554,670,397.251,670
			c131.574,0,216.606-74.688,216.606-190.285c0-64.529-24.448-104.894-81.851-134.989l-16.04-8.421L399.593,386.891z"/>
	</defs>
	<clipPath id="SVGID_2_">
		<use xlink:href="#SVGID_1_"  style="overflow:visible;"/>
	</clipPath>
	
		<linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="209.6075" y1="796.975" x2="222.2323" y2="796.975" gradientTransform="matrix(0 -26.4316 -26.4316 0 21465.4648 6209.7729)">
		<stop  offset="0" style="stop-color:#50A8C6"/>
		<stop  offset="1" style="stop-color:#54C3BE"/>
	</linearGradient>
	<rect x="186.426" y="336.306" style="clip-path:url(#SVGID_2_);fill:url(#SVGID_3_);" width="427.432" height="333.694"/>
</g>
<g>
	<defs>
		<path id="SVGID_4_" d="M186.143,320.26c0,63.894,24.005,103.976,80.076,133.996l15.744,8.47l12.415,5.622l110.652-48.206
			c-59.586,0-122.118-29.867-122.118-95.352c0-65.547,53.779-102.213,122.118-102.213c28.406,0,56.614,7.071,79.879,19.609
			l47.22-19.566c0,0,8.532,3.113,16.792,14.468c8.494,11.749,12.452,21.976,12.452,21.976l-36.556,16.54
			c4.427,6.06,8.039,12.551,10.715,19.406l77.277-35.501c-0.443-1.399-0.912-2.817-1.406-4.229
			C583.59,177.99,503.624,130,402.774,130C271.175,130,186.143,204.689,186.143,320.26"/>
	</defs>
	<clipPath id="SVGID_5_">
		<use xlink:href="#SVGID_4_"  style="overflow:visible;"/>
	</clipPath>
	
		<linearGradient id="SVGID_6_" gradientUnits="userSpaceOnUse" x1="216.5264" y1="797.0288" x2="229.1512" y2="797.0288" gradientTransform="matrix(0 -26.7998 -26.7998 0 21759.6875 6271.2114)">
		<stop  offset="0" style="stop-color:#50A8C6"/>
		<stop  offset="1" style="stop-color:#54C3BE"/>
	</linearGradient>
	<rect x="186.143" y="130.006" style="clip-path:url(#SVGID_5_);fill:url(#SVGID_6_);" width="426.667" height="338.342"/>
</g>
<g>
	<defs>
		<path id="SVGID_7_" d="M356.763,504.275c0,0,16.939,38.935,70.596,19.406c50.117-18.222,7.742-51.362,7.742-51.362
			L356.763,504.275z"/>
	</defs>
	<clipPath id="SVGID_8_">
		<use xlink:href="#SVGID_7_"  style="overflow:visible;"/>
	</clipPath>
	
		<linearGradient id="SVGID_9_" gradientUnits="userSpaceOnUse" x1="231.4985" y1="778.522" x2="244.1228" y2="778.522" gradientTransform="matrix(0 -4.5029 -4.5029 0 3922.7261 1571.579)">
		<stop  offset="0" style="stop-color:#50A8C6"/>
		<stop  offset="1" style="stop-color:#54C3BE"/>
	</linearGradient>
	<rect x="356.763" y="472.318" style="clip-path:url(#SVGID_8_);fill:url(#SVGID_9_);" width="120.713" height="70.891"/>
</g>
<g>
	<defs>
		<path id="SVGID_10_" d="M377.71,289.388c-49.119,17.84-7.657,50.222-7.657,50.222l76.735-31.285c0,0-10.603-24.312-41.646-24.312
			C397.35,284.013,388.251,285.542,377.71,289.388"/>
	</defs>
	<clipPath id="SVGID_11_">
		<use xlink:href="#SVGID_10_"  style="overflow:visible;"/>
	</clipPath>
	
		<linearGradient id="SVGID_12_" gradientUnits="userSpaceOnUse" x1="271.5838" y1="784.6287" x2="284.21" y2="784.6287" gradientTransform="matrix(0 -4.4033 -4.4033 0 3842.6453 1535.4747)">
		<stop  offset="0" style="stop-color:#50A8C6"/>
		<stop  offset="1" style="stop-color:#54C3BE"/>
	</linearGradient>
	<rect x="328.591" y="284.013" style="clip-path:url(#SVGID_11_);fill:url(#SVGID_12_);" width="118.197" height="55.597"/>
</g>
</svg>
</div>
<div class="spinner" role="status"></div>
</div>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'solid' ); ?></a>

<?php
$left_nav = wp_nav_menu( array(
	'theme_location' => 'main_nav_left',
	'container' => '',
	'items_wrap' => '%3$s',
	'echo' => 0
) );
$right_nav = wp_nav_menu( array(
	'theme_location' => 'main_nav_right',
	'container' => '',
	'items_wrap' => '%3$s',
	'echo' => 0
) );
?>

<?php
$phone = carbon_get_theme_option('crb_theme_phone');
$email = carbon_get_theme_option('crb_theme_email');
?>

<header id="masthead" class="site-header">

	<div id="main-navigation" class="main-navigation">
		<div class="main-nav-gradient"></div>
		<div class="main-nav-container">
			<div class="main-nav-row">
				<div class="main-nav-col main-nav-left">
					<div class="main-nav-col-item">
						<div class="site-branding">
							<?php if ( has_custom_logo() ) { ?>
							<?php the_custom_logo(); ?>
							<?php } else { ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php //$solid_description = get_bloginfo( 'description', 'display' ); ?>
							<?php //if ( $solid_description || is_customize_preview() ) { ?>
							<!--<p class="site-description"><?php //echo $solid_description; /* WPCS: xss ok. */ ?></p>-->
							<?php //} ?>
							<?php } ?>
						</div>
					</div>
					<div class="main-nav-col-item">
						<nav id="nav-left" class="nav-left">
							<ul class="nav-menu nav-menu-left">
								<?php echo $left_nav; ?>
							</ul>
						</nav>
					</div>
				</div>
				<div class="main-nav-col main-nav-right">
					<div class="main-nav-col-item">
						<nav id="nav-right" class="nav-right">
							<ul class="nav-menu nav-menu-right">
								<?php echo $right_nav; ?>
								<?php //if ( !empty($phone) ) { ?>
								<!--<li class="menu-item-icon menu-item-icon-chat">
									<a href="#" data-toggle="class" data-target="#footer-modal" data-classes="open">
										<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
									</a>
								</li>-->
								<?php //} ?>
								<?php //if ( !empty($email) ) { ?>
								<!--<li class="menu-item-icon menu-item-icon-email">
									<a href="mailto:<?php //echo $email; ?>" target="_blank">
										<svg version="1.1" id="Layer_1" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
										<path fill="currentColor" d="M464,64H48C21.5,64,0,85.5,0,112v288c0,26.5,21.5,48,48,48h416c26.5,0,48-21.5,48-48V112C512,85.5,490.5,64,464,64zM464,112v40.8c-22.4,18.3-58.2,46.7-134.6,106.5c-16.8,13.2-50.2,45.1-73.4,44.7c-23.2,0.4-56.6-31.5-73.4-44.7C106.2,199.5,70.4,171.1,48,152.8V112H464zM48,400V214.4c22.9,18.3,55.4,43.9,104.9,82.6c21.9,17.2,60.1,55.2,103.1,55c42.7,0.2,80.5-37.2,103.1-54.9c49.5-38.8,82-64.4,104.9-82.7V400H48z"/>
										</svg>
									</a>
								</li>-->
								<?php //} ?>
							</ul>
						</nav>
					</div>
				</div>
				<div class="nav-toggle">
					<button id="toggle-button" class="toggle-button" aria-controls="mobile-navigation" aria-expanded="false">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</button>
				</div>
			</div>
		</div>
	</div>

	<div id="mobile-navigation" class="mobile-navigation">
		<ul class="mobile-menu" aria-expanded="false">
			<?php
			echo $left_nav;
			echo $right_nav;
			?>
			<?php if ( !empty($phone) ) { ?>
			<li class="menu-item-icon menu-item-icon-chat">
				<a href="#" data-toggle="class" data-target="#footer-modal" data-classes="open">
					<svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>

</header>

<div id="content" class="site-content">

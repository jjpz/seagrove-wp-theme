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
<?php global $post; ?>
<meta property="og:url"         content="<?php echo get_the_permalink($post->ID); ?>" />
<meta property="og:type"        content="website" />
<meta property="og:title"       content="<?php echo get_the_title($post->ID); ?>" />
<meta property="og:description" content="" />
<meta property="og:image"       content="<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" />
<?php wp_head(); ?>
</head>

<?php
$class = '';
if( is_singular('agent') && get_query_var('home') ) {
$class = 'single-agent-clone single-agent-home';
}
if( is_singular('agent') && get_query_var('buying') ) {
$class = 'single-agent-clone single-agent-buy';
}
if( is_singular('agent') && get_query_var('selling') ) {
$class = 'single-agent-clone single-agent-sell';
}
if( is_singular('property') && get_query_var('_agent') ) {
$class = 'single-agent-clone';
}
if ( is_singular('property') && get_query_var('marketing-assets') ) {
	$class = 'single-property-marketing';
}
?>

<body <?php body_class($class); ?>>
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
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<div id="content" class="site-content">

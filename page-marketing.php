<?php /* Template Name: Marketing */ ?>
<?php get_header(); ?>

<div id="primary" class="content-area">
<main id="main" class="site-main">

<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

<header class="marketing-header">
	<div class="container text-center"><h2 class="h2-new"><?php the_title(); ?></h2></div>
	<div class="container-sm text-center">
		<?php the_content(); ?>
	</div>
</header>

<?php } } ?>

<?php
$args = array(
	'post_type' => 'marketing',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'asc'
);
$marketing = get_posts($args);
?>

<?php if ( !empty($marketing) ) { $count = 1; ?>
<?php foreach ( $marketing as $item ) { $count++; ?>

<?php
$ID = $item->ID;
$title = $item->post_title;
$content = $item->post_content;
$src = get_the_post_thumbnail_url($ID, 'full');
$srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'full');
$image = get_the_post_thumbnail($ID, array(50, 50), array('data-src' => $src, 'data-srcset' => $srcset, 'class' => 'lazy', 'loading' => 'lazy'));

if ( $count % 2 === 0 ) {
	$class_image = 'order-sm-2';
	$class_content = 'order-sm-1';
} else {
	$class_image = '';
	$class_content = '';
}
?>

<section class="marketing-item">
	<div class="container">
		<div class="row no-gutters align-items-center">
			<div class="col-sm-6 <?php echo $class_image; ?>">
				<div class="post-thumbnail">
					<!--<img width="" height="" src="" class="wp-post-image lazy" alt="" data-src="<?php echo $src; ?>" data-srcset="<?php echo $srcset; ?>" loading="lazy">-->
					<?php //echo $image; ?>
					<img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 300px) 768px, (min-width: 769px) 1000px" class="lazy" />
					<div class="lazy-overlay on"></div>
				</div>
			</div>
			<div class="col-sm-6 <?php echo $class_content; ?>">
				<div class="marketing-item-info">
					<h3 class="h3-new"><?php echo $title; ?></h3>
					<?php echo $content; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php } ?>
<?php } ?>

<?php
$partner_title = get_field('partnerships_title');
$partner_desc = get_field('partnerships_description');
$args = array(
	'post_type' => 'partnership',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'asc'
);
$partnerships = get_posts($args);
?>

<?php if ( !empty($partnerships) ) { ?>

<section class="partnerships">

<header class="partnerships-header">
<div class="container">
<h2 class="h2-new"><?php echo $partner_title; ?></h2>
</div>
<div class="container-sm">
<?php echo $partner_desc; ?>
</div>
</header>

<div class="container">
<div class="row">

<?php foreach ( $partnerships as $partner ) { ?>
<?php
$ID = $partner->ID;
$title = get_the_title($ID);
$image = get_the_post_thumbnail($ID, 'full');
?>

<div class="col-sm-4 partner">
<div class="thumbnail">
<?php echo $image; ?>
</div>
<h3 class="h3-new"><?php echo $title; ?></h3>
</div>

<?php } ?>

</div>
</div>

</section>

<?php } ?>

<?php
$team = get_posts( array(
	'post_type' => 'page',
	'meta_key' => '_wp_page_template',
	'meta_value' => 'page-team.php'
) );
?>

<!--<section class="info-panel">
<div class="container">
<div class="panel-with-sep">
<div class="row no-gutters">

<div class="col-lg-6">
<div class="info-panel-content info-panel-left">
<div class="info-panel-title"><h2>The Sea Grove Advantage</h2></div>
<div class="info-panel-text"><p>Sea Grove Realty delivers the technical and analytical services of a national commercial real estate company while providing the exceptional client service people expect from a boutique residential real estate brokerage.</p></div>
<a href="<?php //echo home_url(); ?>#about" class="btn-cta">
<span>The Sea Grove Advantage</span>
<span class="icon-caret-right">
<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
</span>
</a>
</div>
</div>

<?php //foreach ( $team as $page ) { ?>

<div class="col-lg-6">
<div class="info-panel-content info-panel-right">
<h2>True Team Approach</h2>
<div class="info-panel-text"><?php //echo $page->post_content; ?></div>
<a href="<?php //echo get_the_permalink($page->ID); ?>" class="btn-cta">
<span>Meet the Team</span>
<span class="icon-caret-right">
<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
</span>
</a>
</div>
</div>

<?php //} ?>

</div>
</div>
</div>
</section>-->

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
	$('.partner').each(function(){
		var  partner = $(this);
		var img = partner.find('img').first();
		var w = img.prop('naturalWidth');
		var h = img.prop('naturalHeight');
		var w2 = w/2;
		if ( w == h ) {
			$(img).css({
				'width': '100%',
				'max-width': '100px'
			});
		} else {
			$(img).css({
				'width': '100%',
				'max-width': w2 + 'px'
			});
		}
	});
});
</script>

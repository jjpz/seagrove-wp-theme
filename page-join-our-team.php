<?php /* Template Name: Join Our Team */ ?>
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
$ID = get_the_ID();
$join_top_items = carbon_get_post_meta($ID, 'crb_join_our_team_top_items');
$join_top_title = carbon_get_post_meta($ID, 'crb_join_our_team_top_title');
$join_top_content = carbon_get_post_meta($ID, 'crb_join_our_team_top_text');
$join_bottom_items = carbon_get_post_meta($ID, 'crb_join_our_team_bottom_items');
$join_bottom_title = carbon_get_post_meta($ID, 'crb_join_our_team_bottom_title');
$join_bottom_content = carbon_get_post_meta($ID, 'crb_join_our_team_bottom_text');
$contact_title = carbon_get_post_meta($ID, 'crb_join_our_team_contact_title');
$contact_subtitle = carbon_get_post_meta($ID, 'crb_join_our_team_contact_subtitle');
$shortcode = carbon_get_post_meta($ID, 'crb_join_our_team_contact_shortcode');
?>

<?php if ( !empty($join_top_title) || !empty($join_top_content) ) { ?>

<div class="marketing-grid-header">
<div class="container">
<?php if ( !empty($join_top_title) ) { ?>
<div class="marketing-grid-title">
<h3 class="h3-new"><?php echo $join_top_title; ?></h3>
</div>
<?php } ?>
<?php if ( !empty($join_top_content) ) { ?>
<div class="marketing-grid-desc">
<p><?php echo $join_top_content; ?></p>
</div>
<?php } ?>
</div>
</div>

<?php } ?>

<?php if ( !empty($join_top_items) ) { ?>

<div class="marketing-grid">
<div class="container">
<div class="row">

<?php foreach ( $join_top_items as $item ) { ?>
<div class="col-sm-6">
<?php
$image = wp_get_attachment_url($item['crb_join_our_team_top_item_image']);
$title = $item['crb_join_our_team_top_item_title'];
$text = $item['crb_join_our_team_top_item_text'];
$link_url = $item['crb_join_our_team_top_item_link_url'];
$link_text = $item['crb_join_our_team_top_item_link_text'];
?>
<div class="marketing-grid-item">
<div class="top">
<div class="image"><img src="<?php echo $image; ?>" /></div>
<div class="title"><h3 class="h3-new"><?php echo $title; ?></h3></div>
</div>
<?php if ( !empty($text) ) { ?>
<div class="bottom">
<div class="left"></div>
<div class="content">
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
</div>
<?php } ?>
</div>
</div>
<?php } ?>

</div>
</div>
</div>

<?php } ?>

<?php if ( !empty($join_bottom_title) || !empty($join_bottom_content) ) { ?>

<div class="marketing-grid-header">
<div class="container">
<?php if ( !empty($join_bottom_title) ) { ?>
<div class="marketing-grid-title">
<h3 class="h3-new"><?php echo $join_bottom_title; ?></h3>
</div>
<?php } ?>
<?php if ( !empty($join_bottom_content) ) { ?>
<div class="marketing-grid-desc">
<p><?php echo $join_bottom_content; ?></p>
</div>
<?php } ?>
</div>
</div>

<?php } ?>

<?php if ( !empty($join_bottom_items) ) { ?>

<div class="marketing-grid">
<div class="container">
<div class="row">

<?php foreach ( $join_bottom_items as $item ) { ?>
<div class="col-sm-6">
<?php
$image = wp_get_attachment_url($item['crb_join_our_team_bottom_item_image']);
$title = $item['crb_join_our_team_bottom_item_title'];
$text = $item['crb_join_our_team_bottom_item_text'];
$link_url = $item['crb_join_our_team_bottom_item_link_url'];
$link_text = $item['crb_join_our_team_bottom_item_link_text'];
?>
<div class="marketing-grid-item">
<div class="top">
<div class="image"><img src="<?php echo $image; ?>" /></div>
<div class="title"><h3 class="h3-new"><?php echo $title; ?></h3></div>
</div>
<?php if ( !empty($text) ) { ?>
<div class="bottom">
<div class="left"></div>
<div class="content">
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
</div>
<?php } ?>
</div>
</div>
<?php } ?>

</div>
</div>
</div>

<?php } ?>

<?php if ( !empty($shortcode) ) { ?>
<div class="marketing-contact">
<div class="contact-content text-center">

<?php if ( !empty($contact_title) ) { ?>
<div class="container text-center">
<h2 class="h2-new"><?php echo $contact_title; ?></h2>
</div>
<?php } ?>

<div class="container-sm">

<?php if ( !empty($contact_subtitle) ) { ?>
<h3><?php echo $contact_subtitle; ?></h3>
<?php } ?>

<div class="contact-form">
<?php echo do_shortcode($shortcode); ?>
</div>

</div>

</div>
</div>
<?php } ?>

</main>
</div>

<?php get_footer(); ?>

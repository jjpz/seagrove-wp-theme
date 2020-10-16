<?php get_header('agent'); ?>

<?php
$agent_id = get_the_ID();
$home_image = get_field('agent_home_image', $agent_id);
$image = get_the_post_thumbnail_url($agent_id, 'full');
$name = get_the_title($agent_id);
$link = get_the_permalink($agent_id);
$phone = get_field('agent_phone', $agent_id);
$email = get_field('agent_email', $agent_id);
$fname = explode(' ', $name);
$fname = $fname[0];
?>

<?php
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

<section class="home-slider">
	<div id="slider" class="slider">
		<?php if ( !empty($home_image) ) { ?>
		<?php
		$link = get_the_permalink($home_image);
		$src = wp_get_attachment_image_url($home_image, 'large');
		$srcset = wp_get_attachment_image_srcset($home_image, 'large');
		$img = wp_get_attachment_image($home_image, 'thumbnail', false, array('data-src' => $src, 'data-srcset' => $srcset, 'class' => 'lazy'));
		?>
		<div class="slide home-slide">
			<div class="slide-image property-slide-image">
				<?php echo $img; ?>
				<div class="lazy-overlay on"></div>
			</div>
		</div>
		<?php } else { ?>
		<div class="slide home-slide">
			<div class="slide-image property-slide-image empty"></div>
		</div>
		<?php } ?>
	</div>
	<div class="single-agent-home-image">
		<div class="agent-avatar">
			<div class="post-thumbnail">
				<?php echo get_the_post_thumbnail($agent_id, 'full'); ?>
			</div>
		</div>
	</div>
</section>

<?php
$ID = get_option( 'page_on_front' );
$intro_title = get_field('agent_home_intro_title', $ID);
$intro_subtitle = get_field('agent_home_intro_subtitle', $ID);
$intro_text = get_field('agent_home_intro_text', $ID);
$intro_btn_text = get_field('agent_home_intro_button_text', $ID);
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
<h3 class="h3-new"><?php echo $intro_subtitle; ?> <?php echo $fname; ?></h3>
</div>
<p><?php echo $intro_text; ?></p>
<a href="#" class="btn-cta btn-wide" data-toggle="class" data-target="#agent-modal-<?php echo $agent_id; ?>" data-classes="open">
<span><?php echo $intro_btn_text; ?></span>
<span class="icon-caret-right">
<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
</span>
</a>
</div>
</div>

</div>
</div>
</section>

<div id="agent-modal-<?php echo $agent_id; ?>" class="modal contact-modal">
	<a class="modal-overlay" data-toggle="class" data-target="#agent-modal-<?php echo $agent_id; ?>" data-classes="open"></a>
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

</main>
</div>

<?php get_footer('agent'); ?>

<script>
jQuery(document).ready(function($){
var nav = $('#main-navigation');
nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-white.svg' ?>');
});
</script>

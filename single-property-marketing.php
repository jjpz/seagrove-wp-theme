<?php get_header('agent'); ?>

<div id="primary" class="content-area">
<main id="main" class="site-main">

<h1>Marketing Assets</h1>

<?php if (have_posts()) {
    while (have_posts()) {
        the_post();
        $ID = get_the_ID();
        $title = get_the_title();
        $number = rtrim(get_post_meta($ID, 'street_number', true));
        $street = get_post_meta($ID, 'route', true);
        $route = get_post_meta($ID, 'route', true);
        $unit = get_post_meta($ID, 'unit', true);
        $city = get_post_meta($ID, 'locality', true);
        $state = get_post_meta($ID, 'administrative_area_level_1', true);
        $src = get_the_post_thumbnail_url($ID, 'full');
        ?>

<section class="property-content">
	<div class="container">
		<div class="row no-gutters">
            <div class="col-lg-6 property-col">
                <div class="property-image">
                    <img src="<?php echo $src; ?>" alt="">
                </div>
            </div>
			<div class="col-lg-6 property-col">
				<div class="property-info">
					<div class="property-address">
						<h1><?php echo $number; ?></h1>
						<?php if ( !empty($unit) ) { ?>
						<h3><?php echo $unit; ?></h3>
						<?php } ?>
						<h2 class="h2"><?php echo $city; ?>, <?php echo $state; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
    <?php }
} ?>

</main>
</div>

<?php get_footer('agent'); ?>
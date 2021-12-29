<?php get_header('agent'); ?>

<?php
$agent_id = get_the_ID();
$name = get_the_title($agent_id);
$position = get_field('agent_position', $agent_id);
$phone = get_field('agent_phone', $agent_id);
$email = get_field('agent_email', $agent_id);

while (have_posts()) {
	the_post();
	$page_title = get_the_title();
	$page_content = get_the_content();
}

$selling = get_posts(array(
	'post_type' => 'page',
	'meta_key' => '_wp_page_template',
	'meta_value' => 'page-sell.php'
));

foreach ($selling as $page) {
	$page_title = get_field('agent_selling_title', $page->ID);
	$page_content = get_field('agent_selling_subtitle', $page->ID);
	// $sell_btn_text = get_field('sell_button_text', $page->ID);
}
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<section class="sell-intro">
			<div class="container">
				<div class="row">

					<div class="col-lg-4">
						<div class="single-agent-sell-image">

							<div class="agent-avatar">
								<div class="post-thumbnail">
									<?php echo get_the_post_thumbnail($agent_id, 'full'); ?>
								</div>
							</div>

							<div>
								<div><i>Presented by</i></div>
								<div><?php echo $name; ?></div>
								<!-- <div><?php // echo $position;
											?></div> -->
							</div>

						</div>
					</div>

					<div class="col-lg-8">
						<div class="home-intro-title">
							<h1 class="h1-big"><?php echo $page_title; ?></h1>
						</div>
						<div class="home-intro-content-title">
							<h3 class="h3-new"><?php echo $page_content; ?></h3>
						</div>
					</div>

				</div>
			</div>
		</section>

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

		<?php if (!empty($marketing)) {
			$count = 1; ?>
			<?php foreach ($marketing as $item) {
				$count++; ?>

				<?php
				$ID = $item->ID;
				$title = $item->post_title;
				$content = $item->post_content;
				$src = get_the_post_thumbnail_url($ID, 'full');
				$srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'full');
				$image = get_the_post_thumbnail($ID, array(50, 50), array('data-src' => $src, 'data-srcset' => $srcset, 'class' => 'lazy', 'loading' => 'lazy'));

				if ($count % 2 === 0) {
					$class_image = '';
					$class_content = '';
					$class_right = '';
				} else {
					$class_image = 'order-sm-2';
					$class_content = 'order-sm-1';
					$class_right = 'image-right';
				}
				?>

				<section class="marketing-item">
					<div class="container">
						<div class="row no-gutters">
							<div class="col-sm-6 <?php echo $class_image; ?>">
								<div class="post-thumbnail <?php echo $class_right; ?>">
									<!--<img width="" height="" src="" class="wp-post-image lazy" alt="" data-src="<?php echo $src; ?>" data-srcset="<?php echo $srcset; ?>" loading="lazy">-->
									<?php //echo $image; 
									?>
									<img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 300px) 768px, (min-width: 769px) 1000px" class="lazy" />
									<div class="lazy-overlay on"></div>
								</div>
							</div>
							<div class="col-sm-6 <?php echo $class_content; ?>">
								<div class="marketing-item-content">
									<div class="marketing-item-info">
										<h3 class="h3-new"><?php echo $title; ?></h3>
										<?php echo $content; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

			<?php } ?>
		<?php } ?>

		<?php
		$partnership = get_posts(array(
			'post_type' => 'page',
			'meta_key' => '_wp_page_template',
			'meta_value' => 'page-sell.php'
		));

		foreach ($partnership as $page) {
			$partner_title = get_field('partnerships_title', $page->ID);
			$partner_desc = get_field('partnerships_description', $page->ID);
		}

		$args = array(
			'post_type' => 'partnership',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'menu_order',
			'order' => 'asc'
		);
		$partnerships = get_posts($args);
		?>

		<?php if (!empty($partnerships)) { ?>

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

						<?php foreach ($partnerships as $partner) { ?>
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

		<section class="sell-buttons">
			<div class="container-sm">
				<a href="#" class="btn-wide btn-cta" data-toggle="class" data-target="#agent-modal-<?php echo $agent_id; ?>" data-classes="open">
					<span>LET'S TALK</span>
					<!-- <span class="icon-caret-right">
						<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
							<path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
						</svg>
					</span> -->
				</a>
			</div>
		</section>

	</main>
</div>

<?php get_footer('agent'); ?>

<script>
	jQuery(document).ready(function($) {
		jQuery(document).ready(function($) {
			var nav = $('#main-navigation');
			nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-white.svg' ?>');
		});
	});
</script>

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

<script>
	jQuery(document).ready(function($) {
		$('.partner').each(function() {
			var partner = $(this);
			var img = partner.find('img').first();
			var w = img.prop('naturalWidth');
			var h = img.prop('naturalHeight');
			var w2 = w / 2;
			if (w == h) {
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
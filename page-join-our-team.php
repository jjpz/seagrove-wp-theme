<?php /* Template Name: Join Our Team */ ?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php if (have_posts()) {
			while (have_posts()) {
				the_post(); ?>

				<header class="marketing-header">
					<div class="container text-center">
						<h2 class="h2-new"><?php the_title(); ?></h2>
					</div>
					<div class="container-sm text-center">
						<?php the_content(); ?>
					</div>
				</header>

		<?php }
		} ?>

		<?php
		$ID = get_the_ID();
		$join_title_sm = carbon_get_post_meta($ID, 'crb_join-our-team_title_small');
		$join_title_lg = carbon_get_post_meta($ID, 'crb_join-our-team_title_large');
		$join_text = apply_filters('the_content', carbon_get_post_meta($ID, 'crb_join-our-team_text'));
		$join_cal_url = carbon_get_post_meta($ID, 'crb_join-our-team_calendly-url');
		$join_cal_text = carbon_get_post_meta($ID, 'crb_join-our-team_calendly-text');
		$join_items = carbon_get_post_meta($ID, 'crb_join-our-team_items');
		?>

		<section class="sell-intro" style="margin-bottom: 60px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="home-intro-title">
							<p class="font-size-21px" style="margin-bottom: 0;"><?php echo $join_title_sm; ?></p>
							<h1 class="h1-big"><?php echo $join_title_lg; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="sell-intro join-our-team-list">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="sell-intro-content">
							<?php echo $join_text; ?>
						</div>
					</div>
					<div class="col-lg-6">
						<?php if (!empty($join_items)) { ?>
							<ul>
								<?php foreach ($join_items as $item) { ?>
									<?php
									$title = $item['crb_join-our-team_item_title'];
									$id = str_replace(' ', '-', strtolower($title));
									?>
									<li>
										<a class="font-fam-gotham-bold font-size-21px" onclick="scrollToElement('<?php echo $id ?>')">
											<?php echo $title; ?>
										</a>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>

		<?php if (!empty($join_items)) {
			$count = 1; ?>
			<?php foreach ($join_items as $item) { ?>
				<?php
				$image = wp_get_attachment_url($item['crb_join-our-team_item_image']);
				$title = $item['crb_join-our-team_item_title'];
				$subtitle = $item['crb_join-our-team_item_subtitle'];
				$text = apply_filters('the_content', $item['crb_join-our-team_item_text']);
				$id = str_replace(' ', '-', strtolower($title));
				if ($count % 2 === 0) {
					$class_image = '';
					$class_content = '';
					$class_right = '';
				} else {
					$class_image = 'order-md-2';
					$class_content = 'order-md-1';
					$class_right = 'image-right';
				}
				?>
				<section id="<?php echo $id; ?>" class="marketing-item">
					<div class="container">
						<div class="row no-gutters">
							<div class="col-md-6 <?php echo $class_image; ?>">
								<div class="post-thumbnail <?php echo $class_right; ?>">
									<img src="<?php echo $image; ?>" />
								</div>
							</div>
							<div class="col-md-6 <?php echo $class_content; ?>">
								<div class="marketing-item-content">
									<div class="marketing-item-info">
										<h3 class="h3-new"><?php echo $title; ?></h3>
										<p class="marketing-item-subtitle font-fam-palatino-italic font-size-18px" style="margin-bottom: 8px;"><?php echo $subtitle; ?></p>
										<?php echo $text; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			<?php $count++;
			} ?>
		<?php } ?>

	</main>
</div>

<?php if (!empty($join_cal_url)) { ?>
	<div class="contact-float contact-float-main">
		<div class="contact-float-container">
			<a href="<?php echo $join_cal_url; ?>" class="contact-float-btn" target="_blank" style="width: auto;">
				<span class="contact-bar-icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						<path d="M144,128h32a16.047,16.047,0,0,0,16-16V16A16.047,16.047,0,0,0,176,0H144a16.047,16.047,0,0,0-16,16v96A16.047,16.047,0,0,0,144,128Z" fill="#ffffff" />
						<path d="M336,128h32a16.047,16.047,0,0,0,16-16V16A16.047,16.047,0,0,0,368,0H336a16.047,16.047,0,0,0-16,16v96A16.047,16.047,0,0,0,336,128Z" fill="#ffffff" />
						<path d="M32,464a48.012,48.012,0,0,0,48,48H432a48.012,48.012,0,0,0,48-48V200H32ZM352,268a12.035,12.035,0,0,1,12-12h40a12.035,12.035,0,0,1,12,12v40a12.035,12.035,0,0,1-12,12H364a12.035,12.035,0,0,1-12-12Zm0,128a12.035,12.035,0,0,1,12-12h40a12.035,12.035,0,0,1,12,12v40a12.035,12.035,0,0,1-12,12H364a12.035,12.035,0,0,1-12-12ZM224,268a12.035,12.035,0,0,1,12-12h40a12.035,12.035,0,0,1,12,12v40a12.035,12.035,0,0,1-12,12H236a12.035,12.035,0,0,1-12-12Zm0,128a12.035,12.035,0,0,1,12-12h40a12.035,12.035,0,0,1,12,12v40a12.035,12.035,0,0,1-12,12H236a12.035,12.035,0,0,1-12-12ZM96,268a12.035,12.035,0,0,1,12-12h40a12.035,12.035,0,0,1,12,12v40a12.035,12.035,0,0,1-12,12H108a12.035,12.035,0,0,1-12-12Zm0,128a12.035,12.035,0,0,1,12-12h40a12.035,12.035,0,0,1,12,12v40a12.035,12.035,0,0,1-12,12H108a12.035,12.035,0,0,1-12-12Z" fill="#ffffff" />
						<path d="M432,64H400v48a32.036,32.036,0,0,1-32,32H336a32.036,32.036,0,0,1-32-32V64H208v48a32.036,32.036,0,0,1-32,32H144a32.036,32.036,0,0,1-32-32V64H80a48.012,48.012,0,0,0-48,48v72H480V112A48.012,48.012,0,0,0,432,64Z" fill="#ffffff" />
					</svg>
				</span>
				<span>
					<?php if (!empty($join_cal_text)) {
						echo $join_cal_text;
					} else {
						echo 'Schedule a Meeting';
					} ?>
				</span>
			</a>
		</div>
	</div>
<?php } ?>

<?php get_footer(); ?>

<script>
	let scrollToElement = (element) => {
		element = document.getElementById(element).offsetTop;
		if (element) {
			window.scrollTo({
				top: element - 75,
				behavior: 'smooth',
			});
		}
	}
</script>
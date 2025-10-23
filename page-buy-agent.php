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

$buying = get_posts(array(
	'post_type' => 'page',
	'meta_key' => '_wp_page_template',
	'meta_value' => 'page-buy.php'
));

foreach ($buying as $page) {
	$page_title = get_field('agent_buying_title', $page->ID);
	$page_content = get_field('agent_buying_subtitle', $page->ID);
	$about_items = carbon_get_post_meta($page->ID, 'crb_buy_about_items');
	// $about_btn_text = carbon_get_post_meta($page->ID, 'crb_buy_about_btn_text');
}
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<section class="buy-intro">
			<div class="container">
				<div class="row">

					<div class="col-lg-4">
						<div class="single-agent-buy-image">

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
							<h3 class="font-fam-gotham-book"><?php echo $page_content; ?></h3>
						</div>

						<div class="buy-items">
							<?php if (!empty($about_items)) { ?>
								<?php foreach ($about_items as $item) { ?>
									<?php
									$title = $item['crb_buy_about_item_title'];
									$text = $item['crb_buy_about_item_text'];
									$link_url = $item['crb_buy_about_item_link_url'];
									$link_text = $item['crb_buy_about_item_link_text'];
									?>
									<div class="home-about-item">
										<h3 class="h3-new">
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 10 10" style="enable-background:new 0 0 10 10;" xml:space="preserve">
												<g>
													<circle style="fill:#509DBB;" cx="5" cy="5" r="4" />
													<path style="fill:#FFFFFF;" d="M5,0C2.243,0,0,2.243,0,5s2.243,5,5,5s5-2.243,5-5S7.757,0,5,0z M5,9C2.791,9,1,7.209,1,5c0-2.209,1.791-4,4-4s4,1.791,4,4C9,7.209,7.209,9,5,9z" />
												</g>
											</svg>
											<?php echo $title; ?>
										</h3>
										<p>
											<span><?php echo $text; ?></span>
											<?php if (!empty($link_url)) { ?>
												<a href="<?php echo $link_url; ?>">
													<span><?php echo $link_text; ?></span>
													<span class="icon-caret-right">
														<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
															<path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
														</svg>
													</span>
												</a>
											<?php } ?>
										</p>
									</div>
								<?php } ?>
							<?php } ?>
						</div>

						<div class="buy-intro-btn">
							<a href="#" class="btn-cta btn-wide" data-toggle="class" data-target="#agent-modal-<?php echo $agent_id; ?>" data-classes="open">
								<span>LET'S TALK</span>
								<!-- <span class="icon-caret-right">
									<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
										<path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
									</svg> -->
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
	jQuery(document).ready(function($) {
		jQuery(document).ready(function($) {
			var nav = $('#main-navigation');
			nav.find('.site-branding img').attr('src', '<?php echo get_stylesheet_directory_uri() . '/images/logo-white.svg' ?>');
		});
	});
</script>
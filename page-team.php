<?php /* Template Name: Team */ ?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<header class="team-header">
			<div class="team-header-logo">
				<img src="<?php echo get_stylesheet_directory_uri() . '/images/sea-grove-logo-team.svg' ?>" />
			</div>
			<?php if (have_posts()) {
				while (have_posts()) {
					the_post(); ?>
					<div class="container-sm">
						<?php the_content(); ?>
					</div>
			<?php }
			} ?>
		</header>

		<?php
		$args = array(
			'post_type' => 'agent',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC'
		);
		?>

		<?php $groups = get_field('team_groups'); ?>
		<?php if ($groups) { ?>

			<?php
			$top = get_field('team_group_top');
			$bottom = get_field('team_group_bottom');
			?>

			<?php
			$terms = get_terms(array(
				'taxonomy' => 'group'
			));

			if (!empty($terms)) {
				foreach ($terms as $term) {
					if ($term->count > 0) {
						if ($term->term_id === $top) {
							$top_title = $term->name;
							$top_desc = $term->description;
						}
						if ($term->term_id === $bottom) {
							$bottom_title = $term->name;
							$bottom_desc = $term->description;
						}
					}
				}
			}
			?>

			<?php
			if (!empty($top)) {
				$tax_query = array(
					array(
						'taxonomy' => 'group',
						'field' => 'id',
						'terms' => $top
					)
				);
				$args['tax_query'] = $tax_query;
				$team_top = get_posts($args);
			}
			?>

			<?php if (!empty($team_top)) { ?>
				<section class="team-group team-group-top">
					<header class="team-group-header text-center">
						<div class="container-sm">
							<h2 class="h2-new"><?php echo $top_title; ?></h2>
							<?php if (!empty($top_desc)) { ?>
								<p><?php echo $top_desc; ?></p>
							<?php } ?>
						</div>
					</header>
					<div class="team-group-content">
						<div class="container">
							<div class="row justify-content-center">
								<?php foreach ($team_top as $agent) { ?>
									<?php
									$ID = $agent->ID;
									$title = get_the_title($ID);
									$url = get_the_permalink($ID);
									$src = get_the_post_thumbnail_url($ID, 'medium');
									$srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'thumbnail');
									$image = get_the_post_thumbnail($ID, 'medium', array('class' => 'lazy', 'title' => $title, 'alt' => $title));
									$position = get_field('agent_position', $ID);
									$groups = get_the_terms($ID, 'group');
									?>
									<div class="col-6 col-sm-4">
										<div class="team-member">
											<a href="<?php echo $url; ?>">
												<div class="agent-avatar">
													<div class="post-thumbnail">
														<img src="" srcset="" data-src="<?php echo $src; ?>" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 768px) 300px, 150px" class="lazy" />
														<div class="lazy-overlay team-overlay on"></div>
													</div>
												</div>
												<h3 class="h3-new"><?php echo $title; ?></h3>
												<?php if (!empty($position)) { ?>
													<h4><?php echo $position; ?></h4>
												<?php } ?>
											</a>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</section>
			<?php } ?>

			<?php
			if (!empty($bottom)) {
				$tax_query = array(
					array(
						'taxonomy' => 'group',
						'field' => 'id',
						'terms' => $bottom
					)
				);
				$args['tax_query'] = $tax_query;
				$team_bottom = get_posts($args);
			}
			?>

			<?php if (!empty($team_bottom)) { ?>

				<div class="container">
					<hr class="separator">
				</div>

				<section class="team-group team-group-bottom">
					<header class="team-group-header text-center">
						<div class="container-sm">
							<h2 class="h2-new"><?php echo $bottom_title; ?></h2>
							<?php if (!empty($bottom_desc)) { ?>
								<p><?php echo $bottom_desc; ?></p>
							<?php } ?>
						</div>
					</header>
					<div class="team-group-content">
						<div class="container">
							<div class="row justify-content-center">
								<?php foreach ($team_bottom as $agent) { ?>
									<?php
									$ID = $agent->ID;
									$title = get_the_title($ID);
									$url = get_the_permalink($ID);
									$src = get_the_post_thumbnail_url($ID, 'medium');
									$srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'thumbnail');
									$image = get_the_post_thumbnail($ID, 'medium', array('class' => 'lazy', 'title' => $title, 'alt' => $title));
									$position = get_field('agent_position', $ID);
									$groups = get_the_terms($ID, 'group');
									?>
									<div class="col-6 col-sm-4">
										<div class="team-member">
											<a href="<?php echo $url; ?>">
												<div class="agent-avatar">
													<div class="post-thumbnail">
														<img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(max-width: 767px) 150px, (min-width: 768px) 300px" class="lazy" />
														<div class="lazy-overlay team-overlay on"></div>
													</div>
												</div>
												<h3 class="h3-new"><?php echo $title; ?></h3>
												<?php if (!empty($position)) { ?>
													<h4><?php echo $position; ?></h4>
												<?php } ?>
											</a>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</section>
			<?php } ?>

		<?php } else { ?>

			<?php $team = get_posts($args); ?>

			<?php if (!empty($team)) { ?>
				<section class="team-group">
					<div class="">
						<div class="container">
							<div class="row justify-content-center">
								<?php foreach ($team as $agent) { ?>
									<?php
									$ID = $agent->ID;
									$title = get_the_title($ID);
									$url = get_the_permalink($ID);
									$src = get_the_post_thumbnail_url($ID, 'medium');
									$srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'thumbnail');
									$image = get_the_post_thumbnail($ID, 'full', array('class' => 'lazy', 'title' => $title, 'alt' => $title));
									$position = get_field('agent_position', $ID);
									$groups = get_the_terms($ID, 'group');
									?>
									<div class="col-6 col-sm-4">
										<div class="team-member">
											<a href="<?php echo $url; ?>">
												<div class="agent-avatar">
													<div class="post-thumbnail">
														<img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(max-width: 767px) 150px, (min-width: 768px) 300px" class="lazy" />
														<div class="lazy-overlay team-overlay on"></div>
													</div>
												</div>
												<h3 class="h3-new"><?php echo $title; ?></h3>
												<h4><?php echo $position; ?></h4>
											</a>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</section>
			<?php } ?>

		<?php } ?>

		<?php
		$marketing = get_posts(array(
			'post_type' => 'page',
			'meta_key' => '_wp_page_template',
			'meta_value' => 'page-marketing.php'
		));
		?>

		<!--<section class="info-panel">
<div class="container">
<div class="panel-with-sep">
<div class="row no-gutters">

<div class="col-lg-6">
<div class="info-panel-content info-panel-left">
<div class="info-panel-title"><h2>The Sea Grove Advantage</h2></div>
<div class="info-panel-text"><p>Sea Grove Realty delivers the technical and analytical services of a national commercial real estate company while providing the exceptional client service people expect from a boutique residential real estate brokerage.</p></div>
<a href="<?php //echo home_url(); 
			?>#about" class="btn-cta">
<span>The Sea Grove Advantage</span>
<span class="icon-caret-right">
<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
</span>
</a>
</div>
</div>

<?php //foreach ( $marketing as $page ) { 
?>

<div class="col-lg-6">
<div class="info-panel-content info-panel-right">
<h2>Strategic Marketing</h2>
<div class="info-panel-text"><?php //echo $page->post_content; 
								?></div>
<a href="<?php //echo get_the_permalink($page->ID); 
			?>" class="btn-cta">
<span>Marketing Your Property</span>
<span class="icon-caret-right">
<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path></svg>
</span>
</a>
</div>
</div>

<?php //} 
?>

</div>
</div>
</div>
</section>-->

	</main>
</div>

<?php get_footer(); ?>
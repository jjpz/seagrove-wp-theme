<?php /* Template Name: Map - All */ ?>
<?php get_header(); ?>

<?php
	$loader_image = carbon_get_theme_option('crb_theme_loader_image');
	$load_search = get_query_var('search');
	$load_price_min = get_query_var('price_min');
	$load_price_max = get_query_var('price_max');
	$load_availability = get_query_var('availability');
	$load_type = get_query_var('type');
	$load_status = get_query_var('status');
	$load_bed = get_query_var('bed');
	$load_bath = get_query_var('bath');
	$load_hood = get_query_var('hood');
	$load_sort_by = get_query_var('sort_by');
	$load_sort_order = get_query_var('sort_order');

	if ($load_search) {
		$load_search = rawurldecode($load_search);
	}

	$meta_query = array('relation' => 'AND');
	if ($load_availability) {
		$meta_query[] = array(
			'key' => 'property_availability',
			'value' => $load_availability,
			'compare' => '='
		);
	}
	if ($load_type) {
		$meta_query[] = array(
			'key' => 'property_type',
			'value' => $load_type,
			'compare' => '='
		);
	}
	if ($load_status) {
		$meta_query[] = array(
			'key' => 'property_status',
			'value' => $load_status,
			'compare' => '='
		);
	}
	if ($load_bed) {
		//if ($load_bed == 5) {
		$meta_query[] = array(
			'key' => 'property_beds',
			'value' => $load_bed,
			'compare' => '>='
		);
		//} else {
		/*$meta_query[] = array(
				'key' => 'property_beds',
				'value' => $load_bed,
				'compare' => '='
			);*/
		//}
	}
	if ($load_bath) {
		$meta_query[] = array(
			'key' => 'property_bath',
			'value' => $load_bath,
			'compare' => '>='
		);
	}

	if ($load_price_min && $load_price_max) {
		$meta_query[] = array(
			'key' => 'property_price',
			'value' => array($load_price_min, $load_price_max),
			'type' => 'numeric',
			'compare' => 'between'
		);
	} else {
		if ($load_price_min) {
			$meta_query[] = array(
				'key' => 'property_price',
				'value' => $load_price_min,
				'type' => 'numeric',
				'compare' => '>'
			);
		}
		if ($load_price_max) {
			$meta_query[] = array(
				'key' => 'property_price',
				'value' => $load_price_max,
				'type' => 'numeric',
				'compare' => '<'
			);
		}
	}

	$tax_query = array();
	if ($load_hood) {
		$tax_query[] = array(
			'taxonomy' => 'neighborhood',
			'field' => 'slug',
			'terms' => $load_hood
		);
	}

	$args = array(
		'post_type' => 'property',
		'post_status' => 'publish',
		'posts_per_page' => 30,
		's' => $load_search,
		'meta_query' => $meta_query,
		'tax_query' => $tax_query,
		'orderby' => 'date',
		'order' => 'desc'
	);

	if ($load_sort_by && $load_sort_order) {
		if ($load_sort_by === 'property_availability') {
			$args['meta_key'] = $load_sort_by;
			$args['orderby'] = array('meta_value' => 'DESC', 'date' => 'DESC');
			$args['order'] = $load_sort_order;
		} else {
			$args['meta_key'] = $load_sort_by;
			$args['orderby'] = 'meta_value_num';
			$args['order'] = $load_sort_order;
		}
	}

	$listings = new WP_Query($args);

	$data = array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'current_page' => get_query_var('page') ? get_query_var('page') : 1,
		'max_page' => $listings->max_num_pages,
		'security_filter' => wp_create_nonce('seagrove_filter_properties'),
		'security_load' => wp_create_nonce('seagrove_loadmore_properties')
	);
	wp_localize_script('maps-js', 'helper', $data);

	$terms = get_terms(array(
		'taxonomy' => 'neighborhood'
	));
	if (!empty($terms)) {
		foreach ($terms as $term) {
			$term_name = $term->name;
			$term_slug = $term->slug;
			$hoods[] = $term_slug;
		}
	}
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php get_template_part('components/map/', 'header', []); ?>

		<div class="map-page">

			<?php if ($listings->have_posts()) { ?>

				<div id="map"></div>

				<div id="load-more" class="map-load-more">
					<?php if ($listings->max_num_pages > 1) {
						echo '<a id="loadmore" class="map-load-more-btn">Load More</a>';
					} ?>
				</div>

				<div class="map-list">

					<div class="map-list-content">

						<?php if (have_posts()) {
							while (have_posts()) {
								the_post(); ?>
								<?php if (!empty(get_the_content())) { ?>
									<div class="map-page-content">
										<?php the_content(); ?>
									</div>
								<?php } ?>
						<?php }
							wp_reset_postdata();
						} ?>

						<div id="listings" class="listings">
							<?php
								while ($listings->have_posts()) {
									$listings->the_post();
									get_template_part('components/property/', 'card', []);
								}
								wp_reset_postdata();
							?>
						</div>

						<div id="load-more" class="load-more">
							<?php if ($listings->max_num_pages > 1) {
								echo '<a id="loadmore" class="load-more-btn">Load More</a>';
							} ?>
						</div>

					</div>

					<div class="map-filter-control-main"><a href="#" class="map-filter-btn">Filter & Sort</a></div>

				</div>

				<div class="map-filter-control-mobile"><a href="#" class="map-filter-btn">Filter & Sort</a></div>

			<?php } else { ?>

				<div class="filter-no-results">
					<p>No results found.</p>
				</div>

			<?php } ?>

			<?php get_template_part('components/map/', 'filters', []); ?>

		</div>

	</main>
</div>

<?php if ($locations) { ?>
	<script>
		var locations = <?php echo json_encode($locations); ?>;
		console.log(locations);
	</script>
<?php } ?>

<div class="map-loader">
	<div class="map-loader-icon">
		<div class="spinner-border" role="status"></div>
	</div>
</div>

<?php get_footer(); ?>
<?php /* Template Name: Map - Commercial */ ?>
<?php get_header(); ?>

<?php
$load_search = get_query_var('search');
$load_price_min = get_query_var('price_min');
$load_price_max = get_query_var('price_max');
$load_size_min = get_query_var('size_min');
$load_size_max = get_query_var('size_max');
$load_availability = get_query_var('availability');
//$load_type = get_query_var('type');
$load_status = get_query_var('status');
//$load_bed = get_query_var('bed');
//$load_bath = get_query_var('bath');
$load_hood = get_query_var('hood');
//$load_sort_by = get_query_var('sort_by');
//$load_sort_order = get_query_var('sort_order');
$load_sort_by = 'property_availability';
$load_sort_order = 'DESC';

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
$meta_query[] = array(
	'key' => 'property_type',
	'value' => 'commercial',
	'compare' => '='
);
if ($load_status) {
	$meta_query[] = array(
		'key' => 'property_status',
		'value' => $load_status,
		'compare' => '='
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

if ($load_size_min && $load_size_max) {
	$meta_query[] = array(
		'key' => 'property_size',
		'value' => array($load_size_min, $load_size_max),
		'type' => 'numeric',
		'compare' => 'between'
	);
} else {
	if ($load_size_min) {
		$meta_query[] = array(
			'key' => 'property_size',
			'value' => $load_size_min,
			'type' => 'numeric',
			'compare' => '>'
		);
	}
	if ($load_size_max) {
		$meta_query[] = array(
			'key' => 'property_size',
			'value' => $load_size_max,
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

		<header class="map-header">
			<div class="container">
				<div class="map-header-container">
					<div class="map-header-col">
						<h2><?php echo the_title(); ?></h2>
					</div>
					<div class="map-header-col">
						<div class="map-key">
							<a>
								<span class="dot">
									<svg version="1.1" id="Layer_1" class="map-key-aqua" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 405 533" style="enable-background:new 0 0 405 533;" xml:space="preserve">
										<path fill="#FFFFFF" d="M388.6,123.9c-10.2-24.1-24.7-45.7-43.3-64.2c-18.6-18.6-40.2-33.1-64.2-43.3C256.2,5.9,229.8,0.5,202.5,0.5s-53.7,5.3-78.6,15.9C99.8,26.6,78.2,41.1,59.7,59.7s-33.1,40.2-43.3,64.2C5.8,148.8,0.5,175.3,0.5,202.5c0,34.8,5.7,58.8,21.1,88.6c15.7,30.5,42.1,68.1,85.9,130.5c19.3,27.5,41.1,58.6,67.1,96.3c6.3,9.1,16.8,14.6,27.9,14.6c11.2,0,21.6-5.4,27.9-14.6c26-37.7,47.8-68.8,67.1-96.3c43.7-62.3,70.1-99.9,85.9-130.5c15.4-29.8,21.1-53.8,21.1-88.6C404.5,175.3,399.2,148.8,388.6,123.9z" />
										<path fill="#519DBB" d="M182.8,512.2C37.5,301.5,10.5,279.9,10.5,202.5c0-106,86-192,192-192s192,86,192,192c0,77.4-27,99-172.3,309.7C212.7,525.9,192.3,525.9,182.8,512.2L182.8,512.2z M202.5,282.5c44.2,0,80-35.8,80-80s-35.8-80-80-80s-80,35.8-80,80S158.3,282.5,202.5,282.5z" />
									</svg>
								</span>
								<span class="dot-title">LISTING</span>
							</a>
							<a>
								<span class="dot">
									<svg version="1.1" id="Layer_1" class="map-key-red" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 405 533" style="enable-background:new 0 0 405 533;" xml:space="preserve">
										<path fill="#FFFFFF" d="M388.6,123.9c-10.2-24.1-24.7-45.7-43.3-64.2c-18.6-18.6-40.2-33.1-64.2-43.3C256.2,5.9,229.8,0.5,202.5,0.5s-53.7,5.3-78.6,15.9C99.8,26.6,78.2,41.1,59.7,59.7s-33.1,40.2-43.3,64.2C5.8,148.8,0.5,175.3,0.5,202.5c0,34.8,5.7,58.8,21.1,88.6c15.7,30.5,42.1,68.1,85.9,130.5c19.3,27.5,41.1,58.6,67.1,96.3c6.3,9.1,16.8,14.6,27.9,14.6c11.2,0,21.6-5.4,27.9-14.6c26-37.7,47.8-68.8,67.1-96.3c43.7-62.3,70.1-99.9,85.9-130.5c15.4-29.8,21.1-53.8,21.1-88.6C404.5,175.3,399.2,148.8,388.6,123.9z" />
										<path fill="#EE2E4F" d="M182.8,512.2C37.5,301.5,10.5,279.9,10.5,202.5c0-106,86-192,192-192s192,86,192,192c0,77.4-27,99-172.3,309.7C212.7,525.9,192.3,525.9,182.8,512.2L182.8,512.2z M202.5,282.5c44.2,0,80-35.8,80-80s-35.8-80-80-80s-80,35.8-80,80S158.3,282.5,202.5,282.5z" />
									</svg>
								</span>
								<span class="dot-title">CLOSED</span>
							</a>
						</div>
						<div class="map-list-controls">
							<a href="#" class="show-map active">
								<span class="icon">
									<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marked-alt" class="svg-inline--fa fa-map-marked-alt fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
										<path fill="currentColor" d="M288 0c-69.59 0-126 56.41-126 126 0 56.26 82.35 158.8 113.9 196.02 6.39 7.54 17.82 7.54 24.2 0C331.65 284.8 414 182.26 414 126 414 56.41 357.59 0 288 0zm0 168c-23.2 0-42-18.8-42-42s18.8-42 42-42 42 18.8 42 42-18.8 42-42 42zM20.12 215.95A32.006 32.006 0 0 0 0 245.66v250.32c0 11.32 11.43 19.06 21.94 14.86L160 448V214.92c-8.84-15.98-16.07-31.54-21.25-46.42L20.12 215.95zM288 359.67c-14.07 0-27.38-6.18-36.51-16.96-19.66-23.2-40.57-49.62-59.49-76.72v182l192 64V266c-18.92 27.09-39.82 53.52-59.49 76.72-9.13 10.77-22.44 16.95-36.51 16.95zm266.06-198.51L416 224v288l139.88-55.95A31.996 31.996 0 0 0 576 426.34V176.02c0-11.32-11.43-19.06-21.94-14.86z"></path>
									</svg>
								</span>
							</a>
							<a href="#" class="show-list">
								<span class="icon">
									<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="list" class="svg-inline--fa fa-list fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path fill="currentColor" d="M80 368H16a16 16 0 0 0-16 16v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-64a16 16 0 0 0-16-16zm0-320H16A16 16 0 0 0 0 64v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16V64a16 16 0 0 0-16-16zm0 160H16a16 16 0 0 0-16 16v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-64a16 16 0 0 0-16-16zm416 176H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"></path>
									</svg>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>

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

							<?php while ($listings->have_posts()) { ?>

								<?php
								$listings->the_post();
								$ID = $listings->post->ID;
								$index = $listings->current_post;
								$src = get_the_post_thumbnail_url($ID, 'large');
								$src_medium = get_the_post_thumbnail_url($ID, 'medium');
								$srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'large');
								$image = get_the_post_thumbnail($ID, 'thumbnail', array('data-src' => $src, 'data-srcset' => $srcset, 'class' => 'lazy'));
								$title = get_the_title($ID);
								$url = get_the_permalink($ID);
								$content = get_the_content($ID);
								$lat = get_post_meta($ID, 'lat', true);
								$lng = get_post_meta($ID, 'lng', true);
								$street_number = rtrim(get_post_meta($ID, 'street_number', true));
								$route = rtrim(get_post_meta($ID, 'route', true));
								$unit = rtrim(get_post_meta($ID, 'unit', true));
								$locality = rtrim(get_post_meta($ID, 'locality', true));
								$administrative_area_level_1 = rtrim(get_post_meta($ID, 'administrative_area_level_1', true));
								$postal_code = rtrim(get_post_meta($ID, 'postal_code', true));
								$country = get_post_meta($ID, 'country', true);
								$availability = get_field('property_availability', $ID);
								$status = get_field('property_status', $ID);
								$type = get_field('property_type', $ID);
								$bed = get_field('property_beds', $ID);
								$bath = get_field('property_bath', $ID);
								$size = number_format((float) get_field('property_size', $ID));
								$lot = number_format((float) get_field('property_size_lot', $ID));
								$price = number_format((float) get_field('property_price', $ID));
								$hood = get_field('property_neighborhood', $ID);
								if ($hood) {
									$hood_name = $hood->name;
								}
								if ($availability == 'Yes') {
									$marker = get_stylesheet_directory_uri() . '/icons/map-marker-aqua.svg';
								} else {
									$marker = get_stylesheet_directory_uri() . '/icons/map-marker-red.svg';
								}
								$locations[] = array(
									'ID' => $ID,
									'index' => $index,
									'url' => $url,
									'image' => $src_medium,
									'title' => $title,
									'lat' => $lat,
									'lng' => $lng,
									'street_number' => $street_number,
									'route' => $route,
									'unit' => $unit,
									'locality' => $locality,
									'administrative_area_level_1' => $administrative_area_level_1,
									'postal_code' => $postal_code,
									'country' => $country,
									'bed' => $bed,
									'bath' => $bath,
									'size' => $size,
									'lot' => $lot,
									'price' => $price,
									'marker' => $marker
								);
								?>

								<article id="property-<?php echo $ID; ?>" class="list-item list-item-<?php echo $index; ?> property listing" data-index="<?php echo $index; ?>" data-id="<?php echo $ID; ?>" data-avail="<?php echo $availability; ?>" data-status="<?php echo $status; ?>" data-type="<?php echo $type; ?>" data-hood="<?php echo $hood_name; ?>" data-price="<?php echo $price; ?>" data-size="<?php echo $size; ?>">
									<div class="property-card">
										<div class="content">
											<div class="image">
												<div class="thumbnail">
													<?php //echo $image; 
													?>
													<?php if (!empty($srcset)) { ?>
														<img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 992px) 1024px" class="lazy" />
													<?php } ?>
													<div class="lazy-overlay on"></div>
													<?php
													if ($availability == 'Yes') {
														$avail = 'avail';
														if ($status == 'Sale') {
															//$stat = 'sale';
															$text = 'For Sale';
														} else {
															//$stat = 'rent';
															$text = 'For Rent';
														}
													} else {
														$avail = 'no-avail';
														if ($status == 'Sale') {
															//$stat = 'sale';
															$text = 'Sold';
														} else {
															//$stat = 'rent';
															$text = 'Leased';
														}
													}
													?>
													<div class="flag <?php echo $avail; ?>"><?php echo $text; ?></div>
												</div>
											</div>
											<div class="info">
												<div class="title">
													<h6><?php echo $title; ?></h6>
												</div>
												<div class="address">
													<span><?php echo $street_number; ?></span>
												</div>
												<div class="details">
													<?php if (isset($bed) && !empty($bed) && $bed != 0) { ?>
														<span class="meta bed">&bull; <?php echo $bed; ?> bed</span>
													<?php } ?>
													<?php if (isset($bath) && !empty($bath) && $bath != 0) { ?>
														<span class="meta bath">&bull; <?php echo $bath; ?> bath</span>
													<?php } ?>
													<?php if (isset($size) && !empty($size) && $size != 0) { ?>
														<span class="meta size">&bull; <?php echo $size; ?> sqft</span>
													<?php } ?>
													<?php if (isset($lot) && !empty($lot) && $lot != 0) { ?>
														<span class="meta lot">&bull; <?php echo $lot; ?> sqft lot</span>
													<?php } ?>
													<?php if (isset($price) && !empty($price) && $price != 0) { ?>
														<span class="meta price">&bull; $<?php echo $price; ?></span>
													<?php } ?>
												</div>
											</div>
										</div>
										<div class="buttons">
											<a href="#" id="marker-link" class="marker-link" data-marker-id="<?php echo $index; ?>">Locate</a>
											<a href="<?php echo $url; ?>">View Details</a>
										</div>
									</div>
								</article>

							<?php } ?>
							<?php wp_reset_postdata(); ?>

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

			<div class="map-filters-container">
				<form id="map-filters" action="" method="" name="map-filters" class="map-filters">
					<div class="form-content">
						<div id="filters" class="form-col filters">
							<div class="form-header">Filter by</div>

							<div class="form-section">
								<div class="form-section-title">Availability</div>
								<div class="buttons filter-availability" data-filter-group="availability">
									<div class="button checked">
										<input type="radio" name="availability" value="" id="avail-both" class="" data-filter="" checked>
										<label for="avail-both">Both</label>
									</div>
									<div class="button">
										<input type="radio" name="availability" value="Yes" id="avail-yes" class="" data-filter="Yes" <?php if ($load_availability == 'Yes') {
																																			echo 'checked';
																																		} ?>>
										<label for="avail-yes">Yes</label>
									</div>
									<div class="button">
										<input type="radio" name="availability" value="No" id="avail-no" class="" data-filter="No" <?php if ($load_availability == 'No') {
																																		echo 'checked';
																																	} ?>>
										<label for="avail-no">No</label>
									</div>
								</div>
							</div>

							<div class="form-section">
								<div class="form-section-title">Sale Type</div>
								<div class="buttons filter-status" data-filter-group="status">
									<div class="button checked">
										<input type="radio" name="status" value="" id="status-both" class="" data-filter="" checked>
										<label for="status-both">Both</label>
									</div>
									<div class="button">
										<input type="radio" name="status" value="Sale" id="status-sale" class="" data-filter="Sale" <?php if ($load_status == 'Sale') {
																																		echo 'checked';
																																	} ?>>
										<label for="status-sale">Buy</label>
									</div>
									<div class="button">
										<input type="radio" name="status" value="Lease" id="status-lease" class="" data-filter="Lease" <?php if ($load_status == 'Lease') {
																																			echo 'checked';
																																		} ?>>
										<label for="status-lease">Rent</label>
									</div>
								</div>
							</div>

							<input type="hidden" name="type" value="Commercial">
							<input type="hidden" name="bed" value="">
							<input type="hidden" name="bath" value="">

							<?php if (!empty($terms)) { ?>
								<div class="form-section">
									<div class="form-section-title">Neighborhood</div>
									<div class="form-section-content filter-hood">
										<select name="hood" data-filter-group="hood">
											<option value="" class="" data-filter="">All</option>
											<?php foreach ($terms as $term) { ?>
												<?php
												$term_name = $term->name;
												$term_slug = $term->slug;
												?>
												<option value="<?php echo $term_slug; ?>" class="" <?php if ($load_hood == $term_slug) {
																										echo 'selected';
																									} ?>><?php echo $term_name; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							<?php } ?>

							<div class="form-section">
								<div class="form-section-title">Price</div>
								<div class="form-section-content filter-price">
									<input type="text" name="price_min" id="price_min" placeholder="Min price" <?php if ($load_price_min) {
																													echo 'value="' . $load_price_min . '"';
																												} ?> />
									<input type="text" name="price_max" id="price_max" placeholder="Max price" <?php if ($load_price_max) {
																													echo 'value="' . $load_price_max . '"';
																												} ?> />
								</div>
							</div>

							<div class="form-section">
								<div class="form-section-title">SQFT</div>
								<div class="form-section-content filter-size">
									<input type="text" name="size_min" id="size_min" placeholder="Min sqft" <?php if ($load_size_min) {
																												echo 'value="' . $load_size_min . '"';
																											} ?> />
									<input type="text" name="size_max" id="size_max" placeholder="Max sqft" <?php if ($load_size_max) {
																												echo 'value="' . $load_size_max . '"';
																											} ?> />
								</div>
							</div>

							<div class="form-section">
								<div class="form-section-title">Keyword</div>
								<div class="form-section-content filter-keyword">
									<input type="text" name="search" id="search" placeholder="gables, condo, renovation, pool, etc." <?php if ($load_search) {
																																			echo 'value="' . $load_search . '"';
																																		} ?> />
									<button id="search-reset" class="search-reset"></button>
									<!--<div class="search-result <?php //if ($load_search) { echo 'open'; } 
																	?>"><span class="search-keyword">"<?php //if ($load_search) { echo $load_search; } 
																										?>"</span><input type="button" id="search-reset" class="search-reset" value="X"></div>-->
								</div>
							</div>

						</div>

						<div class="form-sep"></div>

						<div id="sorts" class="form-col sorts">
							<div class="form-header">Sort by</div>
							<div class="form-section sort-section">

								<ul class="sort-col">
									<li class="">
										<label for="order-date">
											<input type="radio" name="sort" value="" id="order-date" class="" data-sort-by="" data-sort-order="" checked>
											<div class="radio-check"></div>
											<div class="radio-text"><span>DATE (newest)</span></div>
										</label>
									</li>

									<li class="">
										<label for="order-avail">
											<input type="radio" name="sort" value="property_availability" id="order-avail" class="" data-sort-by="property_availability" data-sort-order="DESC" <?php if ($load_sort_by == 'property_availability' && $load_sort_order == 'DESC') {
																																																	echo 'checked';
																																																} ?>>
											<div class="radio-check"></div>
											<div class="radio-text"><span>AVAILABILITY</span></div>
										</label>
									</li>

									<li class="">
										<label for="order-price-low-high">
											<input type="radio" name="sort" value="property_price-ASC" id="order-price-low-high" class="" data-sort-by="property_price" data-sort-order="ASC" <?php if ($load_sort_by == 'property_price' && $load_sort_order == 'ASC') {
																																																	echo 'checked';
																																																} ?>>
											<div class="radio-check"></div>
											<div class="radio-text"><span>PRICE (low to high)</span></div>
										</label>
									</li>
									<li class="">
										<label for="order-price-high-low">
											<input type="radio" name="sort" value="property_price-DESC" id="order-price-high-low" class="" data-sort-by="property_price" data-sort-order="DESC" <?php if ($load_sort_by == 'property_price' && $load_sort_order == 'DESC') {
																																																	echo 'checked';
																																																} ?>>
											<div class="radio-check"></div>
											<div class="radio-text"><span>PRICE (high to low)</span></div>
										</label>
									</li>
								</ul>
								<ul class="sort-col">
									<li class="">
										<label for="order-size-low-high">
											<input type="radio" name="sort" value="property_size-ASC" id="order-size-low-high" class="" data-sort-by="property_size" data-sort-order="ASC" <?php if ($load_sort_by == 'property_size' && $load_sort_order == 'ASC') {
																																																echo 'checked';
																																															} ?>>
											<div class="radio-check"></div>
											<div class="radio-text"><span>SQFT (low to high)</span></div>
										</label>
									</li>
									<li class="">
										<label for="order-size-high-low">
											<input type="radio" name="sort" value="property_size-DESC" id="order-size-high-low" class="" data-sort-by="property_size" data-sort-order="DESC" <?php if ($load_sort_by == 'property_size' && $load_sort_order == 'DESC') {
																																																	echo 'checked';
																																																} ?>>
											<div class="radio-check"></div>
											<div class="radio-text"><span>SQFT (high to low)</span></div>
										</label>
									</li>
									<li class="">
										<label for="order-lot-low-high">
											<input type="radio" name="sort" value="property_size_lot-ASC" id="order-lot-low-high" class="" data-sort-by="property_size_lot" data-sort-order="ASC" <?php if ($load_sort_by == 'property_size_lot' && $load_sort_order == 'ASC') {
																																																		echo 'checked';
																																																	} ?>>
											<div class="radio-check"></div>
											<div class="radio-text"><span>LOT SQFT (low to high)</span></div>
										</label>
									</li>
									<li class="">
										<label for="order-lot-high-low">
											<input type="radio" name="sort" value="property_size_lot-DESC" id="order-lot-high-low" class="" data-sort-by="property_size_lot" data-sort-order="DESC" <?php if ($load_sort_by == 'property_size_lot' && $load_sort_order == 'DESC') {
																																																		echo 'checked';
																																																	} ?>>
											<div class="radio-check"></div>
											<div class="radio-text"><span>LOT SQFT (high to low)</span></div>
										</label>
									</li>
								</ul>

							</div>
						</div>
					</div>
				</form>
				<div class="form-buttons">
					<div class="form-buttons-content">
						<div class="form-buttons-inner">
							<button id="apply" class="apply btn-cta">Apply</button>
							<!--<input type="hidden" name="action" value="sgfilter">-->
							<a href="#" id="reset" class="reset-btn">Reset all</a>
						</div>
					</div>
				</div>
				<div class="close-filters"><a href="#" class="close-button close-filter-btn"></a></div>
			</div>

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
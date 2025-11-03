<?php
    $slides = get_posts(array(
        'post_type' => 'property',
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => 'homepage'
            )
        )
    ));
?>

<?php if (!empty($slides)) { ?>
    <section class="home-slider">
        <div id="slider" class="slider">
            <?php foreach ($slides as $slide) { ?>
                <?php
                    $ID = $slide->ID;
                    $link = get_the_permalink($ID);
                    $title = $slide->post_title;
                    if (wp_is_mobile()) {
                        $src = get_the_post_thumbnail_url($ID, 'medium_large');
                        $img = get_the_post_thumbnail($ID, 'medium_large', array('src' => '', 'data-lazy' => $src));
                    } else {
                        $src = get_the_post_thumbnail_url($ID, 'full');
                        $img = get_the_post_thumbnail($ID, 'full', array('src' => '', 'data-lazy' => $src));
                    }
                    $number = rtrim(get_post_meta($ID, 'street_number', true));
                    $street = get_post_meta($ID, 'route', true);
                    $route = get_post_meta($ID, 'route', true);
                    $unit = get_post_meta($ID, 'unit', true);
                    $city = get_post_meta($ID, 'locality', true);
                    $state = get_post_meta($ID, 'administrative_area_level_1', true);
                    $availability = get_field('property_availability', $ID);
                    $status = get_field('property_status', $ID);
                    $bed = get_field('property_beds', $ID);
                    $bath = get_field('property_bath', $ID);
                    $size = number_format((float) get_field('property_size', $ID));
                    $lot = number_format((float) get_field('property_size_lot', $ID));
                    $price = number_format((float) get_field('property_price', $ID));
                    if ($availability == 'Yes') {
                        if ($status == 'Sale') {
                            $slide_title = 'Exclusive Offering';
                        } else {
                            $slide_title = 'Available for Rent';
                        }
                    } else {
                        if ($status == 'Sale') {
                            $slide_title = 'Successfully Sold';
                        } else {
                            $slide_title = 'Leased';
                        }
                    }
                    if ($availability == 'Yes') {
                        $avail = 'avail';
                        if ($status == 'Sale') {
                            $text = 'For Sale';
                            $price_top = 'offered for';
                            $price_bottom = '';
                        } else {
                            $text = 'For Rent';
                            $price_top = 'offered for';
                            $price_bottom = 'per month';
                        }
                    } else {
                        $avail = 'no-avail';
                        if ($status == 'Sale') {
                            $text = 'Sold';
                            $price_top = 'sold for';
                            $price_bottom = '';
                        } else {
                            $text = 'Leased';
                            $price_top = 'leased for';
                            $price_bottom = 'per month';
                        }
                    }
                ?>
                <div class="slide home-slide" data-nav-title="">
                    <div class="slide-image property-slide-image">
                        <?php echo $img; ?>
                    </div>
                    <div class="slide-content">
                        <a href="<?php echo $link; ?>">
                            <div class="slide-info">
                                <!-- <div class="slide-title"><h5><?php // echo $slide_title; 
                                                                    ?></h5></div> -->
                                <div class="flag relative <?php echo $avail; ?>"><?php echo $text; ?></div>
                                <div class="slide-address">
                                    <p><?php echo $title; ?> </p>
                                </div>
                                <div class="slide-details">
                                    <?php if (!empty($bed) && $bed != 0) { ?>
                                        <span class="meta">&bull; <?php echo $bed; ?> bed</span>
                                    <?php } ?>
                                    <?php if (!empty($bath) && $bath != 0) { ?>
                                        <span class="meta">&bull; <?php echo $bath; ?> bath</span>
                                    <?php } ?>
                                    <?php if (!empty($size) && $size != 0) { ?>
                                        <span class="meta">&bull; <?php echo $size; ?> sqft</span>
                                    <?php } ?>
                                    <?php if (!empty($lot) && $lot != 0) { ?>
                                        <span class="meta">&bull; <?php echo $lot; ?> sqft lot</span>
                                    <?php } ?>
                                    <?php if (!empty($price) && $price != 0) { ?>
                                        <span class="meta">&bull; $<?php echo $price; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="slide-button">
                                <span>View Details</span>
                                <span class="icon icon-caret-right">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
                                        <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
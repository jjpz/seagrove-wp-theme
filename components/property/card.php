<?php
    $ID = $listings->post->ID;
    $index = $listings->current_post;
    $src = get_the_post_thumbnail_url($ID, 'large');
    $src_medium = get_the_post_thumbnail_url($ID, 'medium');
    $srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'medium');
    $image = wp_get_attachment_image($loader_image, 'thumbnail', false, array('data-src' => $src, 'data-srcset' => $srcset, 'class' => 'lazy'));
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

<article id="property-<?php echo $ID; ?>" class="list-item list-item-<?php echo $index; ?> property listing" data-index="<?php echo $index; ?>" data-id="<?php echo $ID; ?>">
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
                <div class="d-none" style="display:none!important;">
                    <?php if ($availability) { ?><div>Available: <?php echo $availability; ?></div><?php } ?>
                    <?php if ($status) { ?><div>Status: <?php echo $status; ?></div><?php } ?>
                    <?php if ($type) { ?><div>Type: <?php echo $type; ?></div><?php } ?>
                    <?php if ($hood) { ?><div>Hood: <?php echo $hood_name; ?></div><?php } ?>
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
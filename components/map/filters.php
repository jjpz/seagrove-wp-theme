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
                            <label for="status-sale">Sale</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="status" value="Lease" id="status-lease" class="" data-filter="Lease" <?php if ($load_status == 'Lease') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                            <label for="status-lease">Lease</label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Property Type</div>
                    <div class="buttons filter-type" data-filter-group="type">
                        <div class="button checked">
                            <input type="radio" name="type" value="" id="type-both" class="" data-filter="" checked>
                            <label for="type-both">Both</span>
                        </div>
                        <div class="button">
                            <input type="radio" name="type" value="Residential" id="type-residential" class="" data-filter="Residential" <?php if ($load_type == 'Residential') {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>>
                            <label for="type-residential">Residential</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="type" value="Commercial" id="type-commercial" class="" data-filter="Commercial" <?php if ($load_type == 'Commercial') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                            <label for="type-commercial">Commercial</label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Bed</div>
                    <div class="buttons filter-beds">
                        <?php
                        $bed_array = array();
                        $bedrooms = new WP_Query(array(
                            'post_type' => 'property',
                            'post_status' => 'publish',
                            'posts_per_page' => -1
                        ));
                        if ($bedrooms->have_posts()) {
                            while ($bedrooms->have_posts()) {
                                $bedrooms->the_post();
                                $bed = get_field('property_beds', $bedrooms->post->ID);
                                if (!empty($bed)) {
                                    $bed_array[] = $bed;
                                    $bed_array = array_unique($bed_array);
                                }
                            }
                            wp_reset_postdata();
                        }
                        ?>
                        <div class="button checked">
                            <input type="radio" name="bed" id="bed-any" value="" checked>
                            <label for="bed-any">Any</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="bed" id="bed-1" value="1" <?php if ($load_bed == '1') {
                                                                                    echo 'checked';
                                                                                } ?>>
                            <label for="bed-1">1+</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="bed" id="bed-2" value="2" <?php if ($load_bed == '2') {
                                                                                    echo 'checked';
                                                                                } ?>>
                            <label for="bed-2">2+</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="bed" id="bed-3" value="3" <?php if ($load_bed == '3') {
                                                                                    echo 'checked';
                                                                                } ?>>
                            <label for="bed-3">3+</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="bed" id="bed-4" value="4" <?php if ($load_bed == '4') {
                                                                                    echo 'checked';
                                                                                } ?>>
                            <label for="bed-4">4+</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="bed" id="bed-5" value="5" <?php if ($load_bed == '5') {
                                                                                    echo 'checked';
                                                                                } ?>>
                            <label for="bed-5">5+</label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Bath</div>
                    <div class="buttons filter-bath">
                        <div class="button checked">
                            <input type="radio" name="bath" id="bath-any" value="" checked>
                            <label for="bath-any">Any</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="bath" id="bath-1" value="1" <?php if ($load_bath == '1') {
                                                                                        echo 'checked';
                                                                                    } ?>>
                            <label for="bath-1">1+</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="bath" id="bath-2" value="2" <?php if ($load_bath == '2') {
                                                                                        echo 'checked';
                                                                                    } ?>>
                            <label for="bath-2">2+</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="bath" id="bath-3" value="3" <?php if ($load_bath == '3') {
                                                                                        echo 'checked';
                                                                                    } ?>>
                            <label for="bath-3">3+</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="bath" id="bath-4" value="4" <?php if ($load_bath == '4') {
                                                                                        echo 'checked';
                                                                                    } ?>>
                            <label for="bath-4">4+</label>
                        </div>
                        <div class="button">
                            <input type="radio" name="bath" id="bath-5" value="5" <?php if ($load_bath == '5') {
                                                                                        echo 'checked';
                                                                                    } ?>>
                            <label for="bath-5">5+</label>
                        </div>
                    </div>
                </div>

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
                        <!--<li class="">
                    <label for="order-beds">
                        <input type="radio" name="sort" value="property_beds-DESC" id="order-beds" class="" data-sort-by="property_beds" data-sort-order="DESC" <?php if ($load_sort_by == 'property_beds' && $load_sort_order == 'DESC') {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                        <div class="radio-check"></div>
                        <div class="radio-text"><span>BEDS</span></div>
                    </label>
                </li>
                <li class="">
                    <label for="order-bath">
                        <input type="radio" name="sort" value="property_bath-DESC" id="order-bath" class="" data-sort-by="property_bath" data-sort-order="DESC" <?php if ($load_sort_by == 'property_bath' && $load_sort_order == 'DESC') {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                        <div class="radio-check"></div>
                        <div class="radio-text"><span>BATHS</span></div>
                    </label>
                </li>-->
                        <li class="">
                            <label for="order-size-low-high">
                                <input type="radio" name="sort" value="property_size-ASC" id="order-size-low-high" class="" data-sort-by="property_size" data-sort-order="ASC" <?php if ($load_sort_by == 'property_size' && $load_sort_order == 'ASC') {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } ?>>
                                <div class="radio-check"></div>
                                <div class="radio-text"><span>LIVING SQFT (low to high)</span></div>
                            </label>
                        </li>
                        <li class="">
                            <label for="order-size-high-low">
                                <input type="radio" name="sort" value="property_size-DESC" id="order-size-high-low" class="" data-sort-by="property_size" data-sort-order="DESC" <?php if ($load_sort_by == 'property_size' && $load_sort_order == 'DESC') {
                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                    } ?>>
                                <div class="radio-check"></div>
                                <div class="radio-text"><span>LIVING SQFT (high to low)</span></div>
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
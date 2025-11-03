<?php
    extract($args);
    $about_title = carbon_get_post_meta($ID, 'crb_home_about_title');
    $about_images = carbon_get_post_meta($ID, 'crb_home_about_images');
    $about_items = carbon_get_post_meta($ID, 'crb_home_about_items');
?>

<section id="about" class="home-about">
    <div class="container">
        <div class="row">

            <?php if (!empty($about_title)) { ?>
                <div class="col-12">
                    <div class="home-about-title">
                        <h2 class="h2-new"><?php echo $about_title; ?></h2>
                    </div>
                </div>
            <?php } ?>

            <div class="col-sm-8">
                <div class="home-about-images">
                    <?php if (isset($about_images) && is_array($about_images) && !empty($about_images)) {
                        $count = 0 ?>

                        <?php foreach ($about_images as $image) {
                            $count++ ?>
                            <?php if ($count <= 5) { ?>
                                <?php
                                $src = wp_get_attachment_image_url($image, 'large');
                                $srcset = wp_get_attachment_image_srcset($image, 'large');
                                $img = wp_get_attachment_image($loader_image, 'full', false, array('data-src' => $src, 'data-srcset' => $srcset, 'class' => 'lazy'));
                                ?>

                                <div class="image">
                                    <div class="post-thumbnail">
                                        <?php //echo $img; 
                                        ?>
                                        <img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 992px) 1024px" class="lazy" />
                                        <div class="lazy-overlay on"></div>
                                        <div class="flag no-avail">SOLD</div>
                                    </div>
                                </div>

                            <?php } ?>
                        <?php } ?>

                    <?php } ?>
                </div>
            </div>

            <div class="col-sm-4">
                <?php if (!empty($about_items)) { ?>
                    <?php foreach ($about_items as $item) { ?>
                        <?php
                        $title = $item['crb_home_about_item_title'];
                        $text = $item['crb_home_about_item_text'];
                        $link_url = $item['crb_home_about_item_link_url'];
                        $link_text = $item['crb_home_about_item_link_text'];
                        ?>
                        <div class="home-about-item">
                            <h3 class="h3-new"><?php echo $title; ?></h3>
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

        </div>
    </div>
</section>
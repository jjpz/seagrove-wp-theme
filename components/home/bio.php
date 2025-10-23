<?php
    $banner_image = get_field('home_banner_image', $ID);
    $src = wp_get_attachment_image_url($banner_image, 'large');
    $srcset = wp_get_attachment_image_srcset($banner_image, 'large');
    $img = wp_get_attachment_image($loader_image, 'full', false, array('data-src' => $src, 'class' => 'lazy'));
    $banner_subtitle = get_field('home_banner_subtitle', $ID);
    $banner_text = get_field('home_banner_text', $ID);
?>

<section class="home-banner">
    <div class="container">
        <div class="home-banner-image">
            <div class="post-thumbnail">
                <?php //echo $img; ?>
                <img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 992px) 1024px" class="lazy" />
                <div class="lazy-overlay on"></div>
            </div>
            <div class="home-banner-content">
                <h3 class="h3-new"><?php echo $banner_subtitle; ?></h3>
                <p><?php echo $banner_text; ?></p>
            </div>
        </div>
    </div>
</section>
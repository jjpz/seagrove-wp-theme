<?php get_header('agent'); ?>

<div id="primary" class="content-area">
<main id="main" class="site-main">

<header class="marketing-header">
	<div class="container text-center"><h2 class="h2-new">Marketing Assets</h2></div>
</header>

<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $ID = get_the_ID();
        $title = get_the_title();
        $number = rtrim(get_post_meta($ID, 'street_number', true));
        $street = get_post_meta($ID, 'route', true);
        $route = get_post_meta($ID, 'route', true);
        $unit = get_post_meta($ID, 'unit', true);
        $city = get_post_meta($ID, 'locality', true);
        $state = get_post_meta($ID, 'administrative_area_level_1', true);
        $availability = get_field('property_availability', $ID);
        $status = get_field('property_status', $ID);
        $type = get_field('property_type', $ID);
        $src = get_the_post_thumbnail_url($ID, 'large');
        $srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'large');
        $link = get_the_permalink($ID);
        $email_blast = get_field('property_marketing_email_blast', $ID);
        $marketing_facebook = get_field('property_marketing_facebook', $ID);
        $marketing_instagram = get_field('property_marketing_instagram', $ID);
        $branded_social_images = get_field('property_marketing_branded_social_images', $ID);
        $booklet = get_field('property_marketing_booklet', $ID);
        $mailer_eddm = get_field('property_marketing_mailer_eddm', $ID);
        $mailer_direct_mail = get_field('property_marketing_mailer_direct_mail', $ID);
        $agents = get_field('property_agents', $ID);

        function agentCloneLinks($propertyLink) {
            $agents = get_posts(array(
                'post_type' => 'agent',
                'post_status' => 'publish',
                'numberposts' => -1,
                'order' => 'ASC',
                'orderby' => 'title'
            ));
            if (!empty($agents)) {
                foreach ($agents as $agent) {
                    echo '<li class="col-sm-6 property-marketing-item property-marketing-agent"><a href="'.$propertyLink.'?_agent='.$agent->post_name.'" target="_blank"><span>'.$agent->post_title.'</span><span class="icon-link">
                    <svg width="15" height="15" viewBox="0 0 512 512">
                        <path style="fill:#519DBB;" d="M326.612,185.391c59.747,59.809,58.927,155.698,0.36,214.59c-0.11,0.12-0.24,0.25-0.36,0.37l-67.2,67.2c-59.27,59.27-155.699,59.262-214.96,0c-59.27-59.26-59.27-155.7,0-214.96l37.106-37.106c9.84-9.84,26.786-3.3,27.294,10.606c0.648,17.722,3.826,35.527,9.69,52.721c1.986,5.822,0.567,12.262-3.783,16.612l-13.087,13.087c-28.026,28.026-28.905,73.66-1.155,101.96c28.024,28.579,74.086,28.749,102.325,0.51l67.2-67.19c28.191-28.191,28.073-73.757,0-101.83c-3.701-3.694-7.429-6.564-10.341-8.569c-4.177-2.868-6.753-7.542-6.947-12.606c-0.396-10.567,3.348-21.456,11.698-29.806l21.054-21.055c5.521-5.521,14.182-6.199,20.584-1.731C313.422,173.314,320.289,179.068,326.612,185.391L326.612,185.391z M467.547,44.449c-59.261-59.262-155.69-59.27-214.96,0l-67.2,67.2c-0.12,0.12-0.25,0.25-0.36,0.37c-58.566,58.892-59.387,154.781,0.36,214.59c6.323,6.323,13.19,12.077,20.521,17.196c6.402,4.468,15.064,3.789,20.584-1.731l21.054-21.055c8.35-8.35,12.094-19.239,11.698-29.806c-0.194-5.064-2.77-9.738-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569c-28.073-28.073-28.191-73.639,0-101.83l67.2-67.19c28.239-28.239,74.3-28.069,102.325,0.51c27.75,28.3,26.872,73.934-1.155,101.96l-13.087,13.087c-4.35,4.35-5.769,10.79-3.783,16.612c5.864,17.194,9.042,34.999,9.69,52.721c0.509,13.906,17.454,20.446,27.294,10.606l37.106-37.106C526.817,200.149,526.817,103.709,467.547,44.449L467.547,44.449z"/>
                    </svg>
                </span></a></li>';
                }
            }
        }
?>

    <section class="property-content">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-6 property-marketing-col">
                    <div class="property-marketing-image">
                    <img src="" srcset="" data-srcset="<?php echo $srcset; ?>" class="lazy" />
                    <div class="lazy-overlay on"></div>
                        <?php
                        if ( $availability == 'Yes' ) {
                            $avail = 'avail';
                            if ( $status == 'Sale' ) {
                                $stat = 'sale';
                                $text = 'For Sale';
                            } else {
                                $stat = 'rent';
                                $text = 'For Rent';
                            }
                        } else {
                            $avail = 'no-avail';
                            if ( $status == 'Sale' ) {
                                $stat = 'sale';
                                $text = 'Sold';
                            } else {
                                $stat = 'rent';
                                $text = 'Leased';
                            }
                        }
                        ?>
					    <div class="flag <?php echo $avail . ' ' . $stat; ?>"><?php echo $text; ?></div>
                    </div>
                </div>
                <div class="col-lg-6 property-marketing-col">
                    <div class="property-info">
                        <div class="property-address">
                            <h1><?php echo $number; ?></h1>
                            <?php if ( !empty($unit) ) { ?>
                            <h3><?php echo $unit; ?></h3>
                            <?php } ?>
                            <h2 class="h2"><?php echo $city; ?>, <?php echo $state; ?></h2>
                        </div>
                        <div class="property-link">
                                <a class="btn-cta" href="<?php echo $link; ?>" target="_blank">Property Page</a>
                                <div class="property-link-announcement">
                                    <span class="icon-caret-left">
                                        <svg viewBox="0 0 192 512"><path fill="currentColor" d="M192 127.338v257.324c0 17.818-21.543 26.741-34.142 14.142L29.196 270.142c-7.81-7.81-7.81-20.474 0-28.284l128.662-128.662c12.599-12.6 34.142-3.676 34.142 14.142z"></path></svg>
                                    </span>
                                    <span class="property-link-text">Share this page with your networks!</span>
                                </div>
                        </div>
                        <div class="property-marketing">
                            <?php if (!empty($email_blast) || !empty($marketing_facebook) || !empty($marketing_instagram) || !empty($branded_social_images)) { ?>
                            <div class="property-marketing-assets">
                                <p class="property-marketing-assets-title">Digital</p>
                                <ul>
                                    <?php if (!empty($email_blast)) { ?>
                                    <li class="property-marketing-item email-blast">
                                        <a href="<?php echo $email_blast; ?>" target="_blank"><span>Email Blast</span><span class="icon-link icon-link-external">
                                            <svg width="15" height="15" viewBox="0 0 512 512">
                                                <path style="fill:#519DBB;" d="M432,320h-32c-8.837,0-16,7.163-16,16v112H64V128h144c8.837,0,16-7.163,16-16V80c0-8.837-7.163-16-16-16H48C21.49,64,0,85.49,0,112v352c0,26.51,21.49,48,48,48l0,0h352c26.51,0,48-21.49,48-48l0,0V336C448,327.163,440.837,320,432,320z M488,0H360c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37c-9.389,9.356-9.415,24.552-0.059,33.941c0.02,0.02,0.039,0.039,0.059,0.059L157.67,377c9.356,9.389,24.552,9.415,33.941,0.059c0.02-0.02,0.039-0.039,0.059-0.059l243.61-243.68L471,169c15,15,41,4.5,41-17V24C512,10.745,501.255,0,488,0z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if (!empty($marketing_facebook)) { ?>
                                    <li class="property-marketing-item marketing-facebook">
                                        <a href="<?php echo $marketing_facebook; ?>" target="_blank">
                                            <span>Facebook</span><span class="icon-link icon-link-external">
                                                <svg width="15" height="15" viewBox="0 0 512 512">
                                                    <path style="fill:#519DBB;" d="M432,320h-32c-8.837,0-16,7.163-16,16v112H64V128h144c8.837,0,16-7.163,16-16V80c0-8.837-7.163-16-16-16H48C21.49,64,0,85.49,0,112v352c0,26.51,21.49,48,48,48l0,0h352c26.51,0,48-21.49,48-48l0,0V336C448,327.163,440.837,320,432,320z M488,0H360c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37c-9.389,9.356-9.415,24.552-0.059,33.941c0.02,0.02,0.039,0.039,0.059,0.059L157.67,377c9.356,9.389,24.552,9.415,33.941,0.059c0.02-0.02,0.039-0.039,0.059-0.059l243.61-243.68L471,169c15,15,41,4.5,41-17V24C512,10.745,501.255,0,488,0z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if (!empty($marketing_instagram)) { ?>
                                    <li class="property-marketing-item marketing-instagram">
                                        <a href="<?php echo $marketing_instagram; ?>" target="_blank">
                                            <span>Instagram</span><span class="icon-link icon-link-external">
                                                <svg width="15" height="15" viewBox="0 0 512 512">
                                                    <path style="fill:#519DBB;" d="M432,320h-32c-8.837,0-16,7.163-16,16v112H64V128h144c8.837,0,16-7.163,16-16V80c0-8.837-7.163-16-16-16H48C21.49,64,0,85.49,0,112v352c0,26.51,21.49,48,48,48l0,0h352c26.51,0,48-21.49,48-48l0,0V336C448,327.163,440.837,320,432,320z M488,0H360c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37c-9.389,9.356-9.415,24.552-0.059,33.941c0.02,0.02,0.039,0.039,0.059,0.059L157.67,377c9.356,9.389,24.552,9.415,33.941,0.059c0.02-0.02,0.039-0.039,0.059-0.059l243.61-243.68L471,169c15,15,41,4.5,41-17V24C512,10.745,501.255,0,488,0z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if (!empty($branded_social_images)) { ?>
                                    <li class="property-marketing-item branded-social-images">
                                        <a href="<?php echo $branded_social_images; ?>" target="_blank">
                                            <span>Branded Social Images</span><span class="icon-link icon-link-external">
                                                <svg width="15" height="15" viewBox="0 0 512 512">
                                                    <path style="fill:#519DBB;" d="M432,320h-32c-8.837,0-16,7.163-16,16v112H64V128h144c8.837,0,16-7.163,16-16V80c0-8.837-7.163-16-16-16H48C21.49,64,0,85.49,0,112v352c0,26.51,21.49,48,48,48l0,0h352c26.51,0,48-21.49,48-48l0,0V336C448,327.163,440.837,320,432,320z M488,0H360c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37c-9.389,9.356-9.415,24.552-0.059,33.941c0.02,0.02,0.039,0.039,0.059,0.059L157.67,377c9.356,9.389,24.552,9.415,33.941,0.059c0.02-0.02,0.039-0.039,0.059-0.059l243.61-243.68L471,169c15,15,41,4.5,41-17V24C512,10.745,501.255,0,488,0z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php } ?>
                            <?php if (!empty($booklet) || !empty($mailer_eddm) || !empty($mailer_direct_mail)) { ?>
                            <div class="property-marketing-assets">
                                <p class="property-marketing-assets-title">Print</p>
                                <ul>
                                    <?php if (!empty($booklet)) { ?>
                                    <li class="property-marketing-item booklet">
                                        <a href="<?php echo $booklet; ?>" target="_blank">
                                            <span>Booklet</span><span class="icon-link icon-link-external">
                                                <svg width="15" height="15" viewBox="0 0 512 512">
                                                    <path style="fill:#519DBB;" d="M432,320h-32c-8.837,0-16,7.163-16,16v112H64V128h144c8.837,0,16-7.163,16-16V80c0-8.837-7.163-16-16-16H48C21.49,64,0,85.49,0,112v352c0,26.51,21.49,48,48,48l0,0h352c26.51,0,48-21.49,48-48l0,0V336C448,327.163,440.837,320,432,320z M488,0H360c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37c-9.389,9.356-9.415,24.552-0.059,33.941c0.02,0.02,0.039,0.039,0.059,0.059L157.67,377c9.356,9.389,24.552,9.415,33.941,0.059c0.02-0.02,0.039-0.039,0.059-0.059l243.61-243.68L471,169c15,15,41,4.5,41-17V24C512,10.745,501.255,0,488,0z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if (!empty($mailer_eddm)) { ?>
                                    <li class="property-marketing-item mailer-eddm">
                                        <a href="<?php echo $mailer_eddm; ?>" target="_blank">
                                            <span>Mailer (EDDM)</span><span class="icon-link icon-link-external">
                                                <svg width="15" height="15" viewBox="0 0 512 512">
                                                    <path style="fill:#519DBB;" d="M432,320h-32c-8.837,0-16,7.163-16,16v112H64V128h144c8.837,0,16-7.163,16-16V80c0-8.837-7.163-16-16-16H48C21.49,64,0,85.49,0,112v352c0,26.51,21.49,48,48,48l0,0h352c26.51,0,48-21.49,48-48l0,0V336C448,327.163,440.837,320,432,320z M488,0H360c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37c-9.389,9.356-9.415,24.552-0.059,33.941c0.02,0.02,0.039,0.039,0.059,0.059L157.67,377c9.356,9.389,24.552,9.415,33.941,0.059c0.02-0.02,0.039-0.039,0.059-0.059l243.61-243.68L471,169c15,15,41,4.5,41-17V24C512,10.745,501.255,0,488,0z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if (!empty($mailer_direct_mail)) { ?>
                                    <li class="property-marketing-item mailer-direct-mail">
                                        <a href="<?php echo $mailer_direct_mail; ?>" target="_blank">
                                            <span>Mailer (Direct Mail)</span><span class="icon-link icon-link-external">
                                                <svg width="15" height="15" viewBox="0 0 512 512">
                                                    <path style="fill:#519DBB;" d="M432,320h-32c-8.837,0-16,7.163-16,16v112H64V128h144c8.837,0,16-7.163,16-16V80c0-8.837-7.163-16-16-16H48C21.49,64,0,85.49,0,112v352c0,26.51,21.49,48,48,48l0,0h352c26.51,0,48-21.49,48-48l0,0V336C448,327.163,440.837,320,432,320z M488,0H360c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37c-9.389,9.356-9.415,24.552-0.059,33.941c0.02,0.02,0.039,0.039,0.059,0.059L157.67,377c9.356,9.389,24.552,9.415,33.941,0.059c0.02-0.02,0.039-0.039,0.059-0.059l243.61-243.68L471,169c15,15,41,4.5,41-17V24C512,10.745,501.255,0,488,0z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="property-agent-links">
                            <p class="property-marketing-assets-title">Agent Pages</p>
                            <ul class="row">
                                <?php agentCloneLinks($link); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (!empty($agents)) { $count = 0; ?>
    <section class="property-specialists">
        <div class="container">
            <div class="property-agents">
                <div class="row no-gutters">

                    <div class="col-12">
                        <h2 class="h2">Property Specialists</h2>
                    </div>

                    <?php
                    foreach ( $agents as $agent) {
                        $count++;
                        $agent_id = $agent->ID;
                        if ( $count == 1 ) {
                            $agent1_id = $agent->ID;
                            $agent1_name = get_the_title($agent1_id);
                        }
                        $image = get_the_post_thumbnail_url($agent_id, 'full');
                        $name = $agent->post_title;
                        $link = get_the_permalink($agent_id);
                        $phone = get_field('agent_phone', $agent_id);
                        $email = get_field('agent_email', $agent_id);
                    ?>

                        <div class="col-lg-6 property-agent">
                            <div class="property-agent-info">
                                <div class="property-agent-image">
                                    <div class="agent-avatar">
                                        <a href="<?php echo $link; ?>">
                                            <div class="post-thumbnail">
                                                <!--<img src="<?php echo $image; ?>" class="agent-img" alt="<?php echo $name; ?>" />-->
                                                <?php echo get_the_post_thumbnail($agent_id, 'full'); ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="property-agent-contact">
                                    <div class="agent-name"><h3 class="h3-new"><a href="<?php echo $link; ?>"><?php echo $name; ?></a></h3></div>
                                    <?php if ( !empty($phone) ) { ?>
                                    <div class="agent-phone">
                                        <a href="#" class="" data-toggle="class" data-target="#agent-modal-<?php echo $agent_id ?>" data-classes="open">
                                            <span class="icon">
                                                <svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
                                            </span>
                                            <span class=""><?php echo $phone; ?></span>
                                        </a>
                                    </div>
                                    <?php } ?>
                                    <?php if ( !empty($email) ) { ?>
                                    <div class="agent-email">
                                        <a href="mailto:<?php echo $email; ?>" target="_blank">
                                            <span class="icon">
                                                <svg version="1.1" id="Layer_1" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                <path fill="currentColor" d="M464,64H48C21.5,64,0,85.5,0,112v288c0,26.5,21.5,48,48,48h416c26.5,0,48-21.5,48-48V112C512,85.5,490.5,64,464,64zM464,112v40.8c-22.4,18.3-58.2,46.7-134.6,106.5c-16.8,13.2-50.2,45.1-73.4,44.7c-23.2,0.4-56.6-31.5-73.4-44.7C106.2,199.5,70.4,171.1,48,152.8V112H464zM48,400V214.4c22.9,18.3,55.4,43.9,104.9,82.6c21.9,17.2,60.1,55.2,103.1,55c42.7,0.2,80.5-37.2,103.1-54.9c49.5-38.8,82-64.4,104.9-82.7V400H48z"/>
                                                </svg>
                                            </span>
                                            <span class=""><?php echo $email; ?></span>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div id="agent-modal-<?php echo $agent_id ?>" class="modal contact-modal">
                            <a class="modal-overlay" data-toggle="class" data-target="#agent-modal-<?php echo $agent_id ?>" data-classes="open"></a>
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

                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <footer class="property-footer">
        <div class="container">
            <div class="contact-bar property-contact-bar">
                <div class="contact-bar-container">
                    <div class="row no-gutters justify-content-between contact-bar-row">
                        <div class="col-md-6 col-sm-12 contact-col">
                            <div class="contact-property-address">
                                <a>
                                    <span class="contact-bar-icon">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="door-open" class="svg-inline--fa fa-door-open fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M624 448h-80V113.45C544 86.19 522.47 64 496 64H384v64h96v384h144c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM312.24 1.01l-192 49.74C105.99 54.44 96 67.7 96 82.92V448H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h336V33.18c0-21.58-19.56-37.41-39.76-32.17zM264 288c-13.25 0-24-14.33-24-32s10.75-32 24-32 24 14.33 24 32-10.75 32-24 32z"></path></svg>
                                    </span>
                                    <span class="">
                                        <span><?php echo (isset( $number ) && $number != '') ? $number . ', ' : ''; ?></span>
                                        <span><?php //echo (isset( $street ) && $street != '') ? $street : ''; ?></span>
                                        <span><?php echo (isset( $city ) && $city != '') ? $city . ', ' : ''; ?></span>
                                        <span><?php echo (isset( $state ) && $state != '') ? $state : ''; ?></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 contact-col">
                            <div class="contact-property-contact">
                                <?php if ( !empty($agents) ) { ?>
                                <a href="#" class="" data-toggle="class" data-target="#agent-modal-<?php echo $agent1_id; ?>" data-classes="open">
                                <?php } else { ?>
                                <a href="#" class="" data-toggle="class" data-target="#contact-modal" data-classes="open">
                                <?php } ?>
                                    <span class="contact-bar-icon">
                                        <svg aria-hidden="true" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"></path></svg>
                                    </span>
                                    <span>Request more info</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <?php } ?>
<?php } ?>

</main>
</div>

<?php get_footer('agent'); ?>
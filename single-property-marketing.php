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
        $src = get_the_post_thumbnail_url($ID, 'full');
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
                    echo '<li><a href="'.$propertyLink.'?_agent='.$agent->post_name.'" target="_blank">'.$agent->post_title.'</a></li>';
                }
            }
        }
?>

    <section class="property-content">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-6 property-col">
                    <div class="property-marketing-image">
                        <img src="<?php echo $src; ?>" alt="">
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
                <div class="col-lg-6 property-col">
                    <div class="property-info">
                        <div class="property-address">
                            <h1><?php echo $number; ?></h1>
                            <?php if ( !empty($unit) ) { ?>
                            <h3><?php echo $unit; ?></h3>
                            <?php } ?>
                            <h2 class="h2"><?php echo $city; ?>, <?php echo $state; ?></h2>
                        </div>
                        <div class="property-link">
                                <a href="<?php echo $link; ?>" target="_blank">Property Page</a>
                        </div>
                        <div class="property-marketing">
                            <div class="property-marketing-digital">
                                <p>Digital</p>
                                <ul>
                                    <?php if (!empty($email_blast)) { ?>
                                    <li class="property-marketing-digital-item email-blast">
                                        <a href="<?php echo $email_blast; ?>" target="_blank">Email Blast</a>
                                    </li>
                                    <?php } ?>
                                    <?php if (!empty($marketing_facebook)) { ?>
                                    <li class="property-marketing-digital-item marketing-facebook">
                                        <a href="<?php echo $marketing_facebook; ?>" target="_blank">Facebook</a>
                                    </li>
                                    <?php } ?>
                                    <?php if (!empty($marketing_instagram)) { ?>
                                    <li class="property-marketing-digital-item marketing-instagram">
                                        <a href="<?php echo $marketing_instagram; ?>" target="_blank">Instagram</a>
                                    </li>
                                    <?php } ?>
                                    <?php if (!empty($branded_social_images)) { ?>
                                    <li class="property-marketing-digital-item branded-social-images">
                                        <a href="<?php echo $branded_social_images; ?>" target="_blank">Branded Social Images</a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="property-marketing-print">
                                <p>Print</p>
                                <ul>
                                    <?php if (!empty($booklet)) { ?>
                                    <li class="property-marketing-print-item booklet">
                                        <a href="<?php echo $booklet; ?>" target="_blank">Booklet</a>
                                    </li>
                                    <?php } ?>
                                    <?php if (!empty($mailer_eddm)) { ?>
                                    <li class="property-marketing-print-item mailer-eddm">
                                        <a href="<?php echo $mailer_eddm; ?>" target="_blank">Mailer (EDDM)</a>
                                    </li>
                                    <?php } ?>
                                    <?php if (!empty($mailer_direct_mail)) { ?>
                                    <li class="property-marketing-print-item mailer-direct-mail">
                                        <a href="<?php echo $mailer_direct_mail; ?>" target="_blank">Mailer (DIrect Mail)</a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="property-agent-links">
                            <p>Agent Pages</p>
                            <ul>
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
<?php
    extract($args);
    $intro_title = get_field('home_intro_title', $ID);
    $intro_subtitle = get_field('home_intro_subtitle', $ID);
    $intro_text = get_field('home_intro_text', $ID);
    $intro_btn_url = get_field('home_intro_button_url', $ID);
    $intro_btn_text = get_field('home_intro_button_text', $ID);
?>

<section class="home-intro">
    <div class="container">
        <div class="row">

            <div class="col-sm-6">
                <div class="home-intro-title">
                    <h1><?php echo $intro_title; ?></h1>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="home-intro-content">
                    <div class="home-intro-content-title">
                        <h3 class="h3-new"><?php echo $intro_subtitle; ?></h3>
                    </div>
                    <p><?php echo $intro_text; ?></p>
                    <?php if (!empty($intro_btn_url)) { ?>
                        <a href="<?php echo $intro_btn_url; ?>" class="btn-cta btn-wide">
                            <span><?php echo $intro_btn_text; ?></span>
                            <span class="icon-caret-right">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" class="svg-inline--fa fa-caret-right fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
                                    <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                                </svg>
                            </span>
                        </a>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</section>
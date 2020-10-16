<?php get_header(); ?>

<div id="primary" class="content-area">
<main id="main" class="site-main">
<section class="error-404 not-found">
<div class="container my-5">
<header class="page-header">
<h1 class="page-title text-center"><?php esc_html_e( 'Page not found.', 'solid' ); ?></h1>
</header>
<div class="page-content">
<p class="text-center"><?php esc_html_e( 'It looks like nothing was found at this location. Try one of the links above or go to the home page.', 'solid' ); ?></p>
</div>
</div>
</section>
</main>
</div>

<?php
get_footer();

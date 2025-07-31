<?php
/**
 * Template Name: Services Page
 */
get_header();
?>
    <main class="services-page">
        <div class="container">
            <?php get_template_part('parts/breadcrumbs'); ?>
        </div>


        <?php if (have_rows('content')): ?>
            <?php while (have_rows('content')): the_row(); ?>
                <?php get_template_part('parts/flexible/flexible', get_row_layout()); ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </main>

<?php get_footer(); ?>
<?php
/**
 * Template Name: Contact Page
 */

get_header(); ?>

<main>
    <?php if (have_rows('content')): ?>
        <?php while (have_rows('content')): the_row(); ?>
            <?php get_template_part('parts/flexible/flexible', get_row_layout()); ?>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>

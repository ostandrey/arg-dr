<?php
/**
 * Single
 *
 * Loop container for single post content
 */
get_header(); ?>

<main>
    <!-- BEGIN of flexible content -->
    <?php if (have_rows('content')): ?>
        <?php while (have_rows('content')): the_row(); ?>
            <?php get_template_part('parts/flexible/flexible', get_row_layout()); ?>
        <?php endwhile; ?>

        <?php wp_reset_postdata();
    endif; ?>

</main>
    <?php get_footer(); ?>


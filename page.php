<?php
/**
 * Page
 */
get_header(); ?>

<main>
    <!-- BEGIN of flexible content -->
    <?php if ( have_rows( 'content' ) ): ?>
        <?php while ( have_rows( 'content' ) ): the_row(); ?>
            <?php get_template_part( 'parts/flexible/flexible', get_row_layout() ); ?>
        <?php endwhile; ?>
    <?php endif; ?>
    <!-- END of flexible content -->
</main>

<?php get_footer(); ?>

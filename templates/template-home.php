<?php
/**
 * Template Name: Home Page
 */
get_header();
?>
	

	<!-- BEGIN of main content -->
<main class="section">
    <?php if ( have_rows( 'content' ) ): ?>
        <?php while ( have_rows( 'content' ) ): the_row(); ?>
            <?php get_template_part('parts/flexible/flexible', get_row_layout()); ?>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

	<!-- END of main content -->

<?php get_footer(); ?>

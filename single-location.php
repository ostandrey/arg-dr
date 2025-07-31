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
    <!-- END of flexible content -->
</main>
<?php $footer = get_field('footer');
$location_footer = get_field('location_footer', 'options');
if ($footer) { ?>
    <footer class="location-footer">
        <div class="container">
            <?php echo $location_footer; ?>
        </div>
    </footer>
    <?php wp_footer(); ?>
    <?php if ($ada_script = get_field('ada', 'options')) : ?>
        <?php echo $ada_script; ?>
    <?php endif; ?>
    </body>
    </html>
<?php } else { ?>
    <?php get_footer(); ?>
<?php } ?>

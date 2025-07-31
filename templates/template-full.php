<?php
/**
 * Template Name: Full Width
 */
get_header(); ?>

    <main class="full-width-page">
        <div class="container">
            <!-- Breadcrumbs -->
            <?php get_template_part('parts/breadcrumbs'); ?>

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="full-width-content">
                        <header class="full-width-content__header">
                            <h1 class="full-width-content__title"><?php the_title(); ?></h1>
                            <?php if (get_the_modified_date() !== get_the_date()) : ?>
                                <div class="full-width-content__updated">
                                    <?php
                                    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';
                                    $updated_text = $current_lang === 'en' ? 'Last updated:' : 'Останнє оновлення:';
                                    ?>
                                    <span><?php echo esc_html($updated_text); ?> <?php echo get_the_modified_date('d.m.Y'); ?></span>
                                </div>
                            <?php endif; ?>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="full-width-content__image">
                                <?php the_post_thumbnail('large', array('class' => 'full-width-content__img')); ?>
                            </div>
                        <?php endif; ?>

                        <div class="full-width-content__body">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </main>

<?php get_footer(); ?>
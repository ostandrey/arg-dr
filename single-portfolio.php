<?php
/**
 * Single specialties
 *
 * Loop container for single post content
 */
get_header(); ?>

<main>

    <section class="single-portfolio">
        <div class="container">
            <div class="single-portfolio__title">
                <h2>
                    <?php the_title(); ?>
                </h2>
            </div>
            <div class="row mb-4">
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                    <?php the_post_thumbnail('full');  ?>
                </div>
                <div class="col-xl-8 col-lg-6 col-md-6 col-12 pt-3 pt-md-0">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php if($gallery = get_field('porfolio_gallery')) { ?>
            <div class="single-portfolio__gallery">
                <?php foreach ($gallery as $image) { ?>
                    <div class="single-portfolio__item">
                        <a href="<?php echo $image['url']; ?>" data-fancybox="single-portfolio__item">
                            <?php echo wp_get_attachment_image($image['id'], 'full')?>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>


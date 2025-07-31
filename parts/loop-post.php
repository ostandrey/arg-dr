<?php
/**
 * Template part for displaying posts in the blog archive
 */
?>

<div class="blog-card">
    <a href="<?php the_permalink(); ?>" class="blog-card__link">
        <div class="blog-card__image">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full', array('class' => 'blog-card__img')); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.jpg" alt="<?php the_title_attribute(); ?>" class="blog-card__img">
            <?php endif; ?>
        </div>
        <div class="blog-card__content">
            <h3 class="blog-card__title"><?php the_title(); ?></h3>
            <div class="blog-card__excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>
        </div>
    </a>
</div>
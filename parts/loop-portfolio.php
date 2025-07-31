<!-- BEGIN of Post -->
<?php $hidden_btn =  !get_field('individual_page') ? 'portfolio__hidden-btn' : ''; ?>


<article id="post-<?php the_ID(); ?>" class="portfolio__item <?php echo $hidden_btn; ?>">
    <?php if (has_post_thumbnail()) : ?>
        <?php  the_post_thumbnail('full_hd', array('class' => 'preview__thumb')); ?>
    <?php endif; ?>
        <div class="button d-flex flex-column justify-content-center">
            <?php echo get_the_title(); ?>
            <?php if ($location = get_field('location')) { ?>
            <div class="portfolio__location">
                <?php echo $location; ?>
            </div>
            <?php } ?>
        </div>

    <?php if (get_field('individual_page')) { ?>
        <?php $individual_page_url = get_permalink(); ?>
        <a href="<?php echo $individual_page_url; ?>" class="career__link"></a>
    <?php } else {
        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_url = wp_get_attachment_url($thumbnail_id);
        ?>
        <a class="portfolio__gallery-link" href="<?php echo $thumbnail_url;?>" data-fancybox="portfolio__gallery">
            <?php the_post_thumbnail('full', array('class' => 'portfolio__gallery-img')); ?>
        </a>
    <?php } ?>
</article>
<!-- END of Post -->
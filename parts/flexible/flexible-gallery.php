<?php
$title_switch = get_sub_field('title_switch');
$title = get_sub_field('title');
$gallery = get_sub_field('gallery'); ?>

<section class="section-gallery py-3">
    <div class="container">
        <?php if ($title_switch && $title) { ?>
            <div class="section-gallery__title mb-3">
                <h2>
                    <?php echo $title; ?>
                </h2>
            </div>
        <?php }
        if ($gallery) { ?>
            <div class="section-gallery__list pb-4">
                <?php foreach ($gallery as $image) { ?>
                    <div class="section-gallery__item">
                        <a href="<?php echo $image['url']; ?>" data-fancybox="section-gallery">
                        <?php echo wp_get_attachment_image($image['id'], 'full') ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>

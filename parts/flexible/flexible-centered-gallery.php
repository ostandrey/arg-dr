<?php
$title_switch = get_sub_field('title_switch');
$title = get_sub_field('title');
$gallery = get_sub_field('gallery');
$columns = get_sub_field('columns') ?: 3; // Default to 3 columns
?>

<section class="section-centered-gallery py-5">
    <div class="container">
        <?php if ($title_switch && $title) { ?>
            <div class="section-centered-gallery__title mb-4">
                <h2 class="text-center">
                    <?php echo $title; ?>
                </h2>
            </div>
        <?php }
        if ($gallery) { ?>
            <div class="section-centered-gallery__list">
                <?php foreach ($gallery as $image) { ?>
                    <div class="section-centered-gallery__item section-centered-gallery__item--<?php echo $columns; ?>-cols">
                        <a href="<?php echo $image['url']; ?>" data-fancybox="centered-gallery" class="section-centered-gallery__link">
                            <?php echo wp_get_attachment_image($image['id'], 'large', array('class' => 'section-centered-gallery__image')); ?>
                            <div class="section-centered-gallery__overlay">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.66 12.66L5.66 19.66" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.66 12.66V19.66H12.66" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section> 

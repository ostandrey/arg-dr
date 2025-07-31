<?php

$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$title = get_sub_field('title');
$background_color = get_sub_field('background_color');
$side = get_sub_field('side');
$text = get_sub_field('text');
$gallery = get_sub_field('gallery');
?>

<section class="container-fluid py-md-5 <?= $background_color ?> <?= $module_class ?>"
         id="<?= $module_id ?>">
    <div class="container">
        <div class="row">
            <div>
                <?php if ($title):
                    echo $title;
                endif; ?>
            </div>
            <div class="d-flex justify-content-between w-100 <?php echo $side ? 'd-flex flex-xl-row-reverse' : '' ?> specialties__wrapper">
                <div class="col-xl-5 column">
                    <?php echo $text; ?>
                </div>
                <div class="col-12 col-md-12 col-xl-7">
                    <div class="specialties-gallery__list">
                        <?php if (is_array($gallery)):?>
                            <?php foreach ($gallery as $gallery_item):?>
                                <div class="specialties-gallery__item">
                                    <img src="<?php echo esc_url($gallery_item['sizes']['full_hd']); ?>"
                                         alt="<?php echo esc_attr($gallery_item['alt']); ?>"/>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

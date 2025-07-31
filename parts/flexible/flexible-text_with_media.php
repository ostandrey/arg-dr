<?php

$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$background_image = get_sub_field('background_image');
$overlay = get_sub_field('overlay');
$image = get_sub_field('image');
$size = get_sub_field('size');
$video = get_sub_field('video');
$text = get_sub_field('text');
$side = get_sub_field('side');
$color_text = get_sub_field('color_text');

$background_image = get_sub_field('background') ? $background_image : false;
$image_size = !$size ? 'fit' : 'full';
$text_background = !$size ? 'text-bg' : '';
$text_wrapper = !$size ? 'text-wrapper' : '';
$color_text = $color_text === 'white' ? 'content__text-white' : '';
?>

<section class="position-relative <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="content__background" <?php bg($background_image, 'full_hd'); ?>></div>
    <div class="container location-container">

        <div class="<?php echo !$size ? 'content__wrapper--static' : 'py-5'; ?> <?php echo $side ? 'content__wrapper--reverse' : ''; ?> content__wrapper">

            <div class="content__text <?php echo $text_wrapper; ?> <?php echo $side ? 'right' : 'left'; ?>">
                <div class="<?php echo $color_text; ?>">
                    <?php echo $text; ?>
                </div>
                <?php if ($text_background): ?>
                    <div class="<?php echo $side ? 'right' : 'left'; ?> <?php echo $text_background; ?>"></div>
                <?php endif; ?>
            </div>

            <div class="content__media">
                <?php if ($image): ?>
                    <img src="<?php echo esc_url($image['sizes']['large']); ?>"
                         alt="<?php echo esc_attr($image['alt']); ?>"
                         class="size--<?php echo $image_size; ?>"
                    />
                <?php endif; ?>

                <?php if ($video): ?>
                    <div class="text-img-video__video-wrapper">
                        <?php echo '<video width="640" height="360" controls>';
                        echo '<source src="' . esc_url($video) . '" type="video/mp4">';
                        echo '</video>'; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <div class="content__overlay content__overlay--<?php echo $overlay; ?>"></div>
</section>
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

$image_size = !$size ? 'fit' : 'full';
$text_background = !$size ? 'blue' : '';
$form_title = get_sub_field('form_title');
$contact_form = get_sub_field('form');
?>

<section class="position-relative <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="content__background"
    <?php bg($background_image, 'full_hd'); ?></div>
    <div class="<?php echo !$size ? '' : 'container'; ?>">

        <div class="">
            <div class="<?php echo !$size ? '' : 'py-5'; ?> <?php echo $side ? 'd-flex flex-row-reverse' : ''; ?> content__wrapper">
                <div class="content__text <?php echo $text_background; ?>">
                    <?php echo $text; ?>
                </div>
                <div class="content__media">
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image['sizes']['large']); ?>"
                             alt="<?php echo esc_attr($image['alt']); ?>"
                             class="size--<?php echo $image_size; ?>"
                        />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="content__overlay content__overlay--<?php echo $overlay; ?>"></div>
</section>

<?php if (is_array($contact_form)): ?>
    <h3 class="location-hero__form-title"><?php echo $form_title; ?></h3>
    <div class="location-hero__form">
        <?php echo do_shortcode("[gravityform id='{$contact_form['id']}' title='false' description='false' ajax='true']"); ?>
    </div>
<?php endif; ?>
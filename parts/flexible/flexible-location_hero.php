<?php
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$title = get_sub_field('title');
$background_image = get_sub_field('background_image');
$text = get_sub_field('text');
$form_title = get_sub_field('form_title');
$contact_form = get_sub_field('form');


$title ? $title : get_the_title('');
?>

<section class="w-100 hero d-flex flex-column justify-content-center align-items-center <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="location-hero__background"  <?php bg($background_image, 'full_hd')?>></div>
    <div class="location-hero__container">
        <h1 class="location-hero__title text-center align-middle"><?php echo $title; ?></h1>
        <div class="location-hero__text text-center">
            <?php echo $text;?>
        </div>
        <?php if (is_array($contact_form)): ?>
            <h3 class="location-hero__form-title"><?php echo $form_title; ?></h3>
            <div class="location-hero__form">
                <?php echo do_shortcode("[gravityform id='{$contact_form['id']}' title='false' description='false' ajax='true']"); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="location-hero__overlay"></div>
</section>
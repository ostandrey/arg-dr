<?php
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$title = get_sub_field('title');
$background_image = get_sub_field('background_image');

$title_included = get_sub_field('title_field');
$background_included = get_sub_field('background_field');
$background_image = $background_included ? $background_image : false;
?>

<section class="w-100 hero d-flex justify-content-center align-items-center <?php echo $module_class ?>" id="<?php echo $module_id ?>">
    <div class="hero__background"  <?php bg($background_image, 'full_hd')?>></div>
    <?php if ($title_included) { ?>
    <h1 class="hero__title text-center align-middle"><?php echo $title; ?></h1>
    <?php } ?>
    <div class="hero__overlay"></div>
</section>

<?php

$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$text = get_sub_field('text');
$button_section = get_sub_field('button_section');
$bottom_space = get_sub_field('bottom_space');

$bottom_padding = !$bottom_space ? 'py-md-5' : 'pt-md-5';
?>

<section class="container-fluid py-5 <?php echo $bottom_padding; ?> full-text <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <div class="row d-flex justify-content-between flex-md-row flex-column">
            <div class="col-12 col-xl-8 col-lg-7 row full-text__title--blue">
                <?php echo $text; ?>
            </div>
            <div class="text-md-right col-xl-4 p-0 text-center button__container">
                <?php echo $button_section; ?>
            </div>
        </div>
    </div>
</section>

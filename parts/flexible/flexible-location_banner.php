<?php

$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$text = get_sub_field('text');
$background_color = get_sub_field('background_color');
?>

<section class="container-fluid banner banner--<?= $background_color ?>  <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <div class="row banner__text">
            <?php echo $text; ?>
        </div>
    </div>
</section>

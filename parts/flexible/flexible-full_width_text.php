<?php

$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$text = get_sub_field('text');
$top_space = get_sub_field('top_padding');

$top_padding = !$top_space ? 'py-5' : 'pt-md-3 pb-md-5';
?>

<section class="container-fluid <?= $top_padding ?> full-text <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
            <?php echo $text; ?>
    </div>
</section>

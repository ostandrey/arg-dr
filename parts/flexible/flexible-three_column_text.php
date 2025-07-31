<?php

$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$title = get_sub_field('title');
$text_columns = get_sub_field('text_columns');
$background_color = get_sub_field('background_color');
?>

<section class="container-fluid py-md-5 full-text <?= $background_color ?> <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container py-4">
        <?php if ($title): ?>
            <h4><?php echo $title; ?></h4>
        <?php endif; ?>
        <div class="row gap-3 columns__list">
            <?php if (is_array($text_columns)): ?>
                <?php foreach ($text_columns as $text_column):
                    $text = $text_column['text'];
                    ?>
                    <div class="col-12 col-md-4 column">
                        <?php echo $text; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

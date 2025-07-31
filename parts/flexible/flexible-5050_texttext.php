<?php
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$title = get_sub_field('title');
$text_left = get_sub_field('full_text_editors_left');
$text_right = get_sub_field('full_text_editors_right');
?>

<section class="container-fluid text-5050 py-md-5 <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <div class="row">

            <?php if ($title) : ?>
                <div class="col-12">
                    <h2 class="text-5050__title"><?php echo $title ?></h2>
                </div>
            <?php endif; ?>

            <div class="col-sm-12 col-md-6 text-5050_text-left">
                <?php if ($text_left) :
                    echo $text_left;
                endif; ?>
            </div>

            <div class="col-sm-12 col-md-6 text-5050_text-right">
                <?php if ($text_right) :
                    echo $text_right;
                endif; ?>
            </div>
        </div>
    </div>
</section>
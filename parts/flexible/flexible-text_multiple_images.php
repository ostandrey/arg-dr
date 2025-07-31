<?php

$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$text = get_sub_field('text');
$images = get_sub_field('images');
$side = get_sub_field('side');
?>

<section class="container-fluid pt-4 pb-md-5 <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <div class="w-100 d-flex justify-content-between flex-md-row flex-sm-column">
            <div class="row align-items-center <?php echo $side ? 'flex-row-reverse' : '' ?>">
                <div class="col-md-6 col-sm-12">
                    <?php echo $text; ?>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="gallery py-5 py-md-0">
                        <?php
                        if ( $images ): ?>
                            <?php foreach ( $images as $image ): ?>
                                <div class="">
                                    <img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                    <p><?php echo $image['caption']; ?></p>
                                </div><!-- END of .columns-->
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


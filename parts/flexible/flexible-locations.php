<?php
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$side = get_sub_field('side');
$location_info = get_sub_field('location_info');
$location_field = get_sub_field('location_field');
$location_image = get_sub_field('location_image');
$map = get_sub_field('map');
?>

<section class="container-fluid py-md-5 locations <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">

            <div class="row w-100 justify-content-between py-4 py-md-0 <?php echo $side ? 'flex-row-reverse' : '' ?>">
                <div class="col-12 col-md-4 col-sm-6 column">
                    <?php echo $location_info; ?>
                </div>
                <div class="col-12 col-md-8 col-sm-12 pt-4 pt-md-0 locations__map">
                    <?php if($location_field):?>
                        <?php echo $map ? : '' ?>
                    <?php else :?>
                        <?php if($location_image):?>
                            <img class="img-responsive" src="<?php echo $location_image['url']; ?>" alt="<?php echo $location_image['alt']; ?>"/>
                        <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
        </div>

</section>

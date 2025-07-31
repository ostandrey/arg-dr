<?php
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');

$side = get_sub_field('side');
$content = get_sub_field('content');
$form = get_sub_field('form');
$enable_the_script = get_sub_field('enable_the_script');
$script = get_sub_field('script');

$text_position = $side ? 'flex-row-reverse' : '';
?>

<section class="careers <?php echo $module_class; ?> py-5" id="<?php echo $module_id; ?>">
    <div class="container">
        <div class="row <?php echo $text_position; ?>">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="careers__content mb-3">
                    <?php echo $content; ?>
                </div>
                <?php if ($enable_the_script) { ?>
                <div class="careers__work">
                    <?php echo $script; ?>
                </div>
                <?php } ?>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="careers__form">
                    <?php echo do_shortcode("[gravityform id='{$form
                    ['id']}' title='false' description='false' ajax='true']"); ?>
                </div>
            </div>
        </div>
    </div>
</section>




<?php

$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$text = get_sub_field('text');
$contact_form = get_sub_field('form');
$side = get_sub_field('side');
?>


<section class="container-fluid py-md-5 py-lg-4 contact <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <div class="row contact__container d-flex <?php echo !$side ? 'd-flex flex-row-reverse' : '' ?>">
            <?php if (is_array($contact_form)): ?>
                <div class="contact__form col">
                    <?php echo do_shortcode("[gravityform id='{$contact_form['id']}' title='false' description='false' ajax='true']"); ?>
                </div>
            <?php endif; ?>
            <?php if ($text): ?>
                <div class="contact__text col">
                    <?php echo $text; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>



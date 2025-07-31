<?php
$module_class = get_sub_field('module_class');
$module_id = get_sub_field('module_id');
$logos = get_sub_field('logos');
?>

<div class="container-fluid py-md-4 <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <div class="row d-flex justify-content-center position-relative">
            <div class="logos logos--desktop logos-slider">
                <?php if (is_array($logos)): ?>
                    <?php foreach ($logos as $logo):
                        $image = $logo['image'];
                        ?>
                        <div>
                            <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="logos--mobile py-5">
                <?php if (is_array($logos)): ?>
                    <?php foreach ($logos as $logo):
                        $image = $logo['image'];
                        ?>
                        <div>
                            <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

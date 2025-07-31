<?php
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$title = get_sub_field('title');
$specialties = get_sub_field('specialties');
?>


<div class="container-fluid py-md-4 p-0 px-md-g <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <div class="row d-flex justify-content-center flex-column">
            <h2 class="text-center products__title"><?php echo $title ?></h2>
            <div class="specialties">
                <?php if (is_array($specialties)): ?>
                    <?php foreach ($specialties as $specialty):
                        $permalink = get_permalink($specialty->ID);
                        $spec_title = get_the_title($specialty->ID);
                        $image = get_the_post_thumbnail($specialty->ID);
                        $image_color = get_field('image_color', $specialty->ID);
                        $image_color = $image_color ? 'specialties__item--gray' : '';
                        ?>
                        <a href="<?php echo $permalink ?>" class="specialties__item <?php echo $image_color; ?>">
                            <div class="specialties__image-container">
                                <?php echo $image ?>
                            </div>
                            <h4 class="button"><?php echo esc_html($spec_title); ?></h4>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

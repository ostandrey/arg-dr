<?php

$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$tiles = get_sub_field('tiles');
?>

<div class="container-fluid py-md-4 position-relative <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="tiles">
                <?php if (is_array($tiles)): ?>
                    <?php foreach ($tiles as $tile):
                        $image = $tile['background_image'];
                        $content = $tile['content'];
                        $overlay = $tile['overlay'];
                        $icon = $tile['icon'];
                        ?>
                        <div class="tile">
                            <div class="tile__background">
                                <img src="<?php echo esc_url($image['sizes']['large']); ?>"
                                     alt="<?php echo esc_attr($image['alt']); ?>"
                                     class="tile__image"
                                />
                                
                                <div class="tile__overlay--<?php echo $overlay?>"></div>
                            </div>


                            <div class="tile__content">
                                <?php echo $content?>
                            </div>
                            <?php if($icon):?>
                                <div class="tile__graphic">
                                    <img src="<?php echo esc_url($icon['sizes']['large']); ?>" alt="">
                                </div>
                            <?php endif;?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
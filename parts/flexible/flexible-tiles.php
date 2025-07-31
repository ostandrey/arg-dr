<?php
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$title = get_sub_field('title');
$tiles = get_sub_field('tiles');
?>


<div class="container-fluid py-sm-5 career <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <?php if($title):?>
            <h2 class="text-center"><?php echo $title?></h2>
        <?php endif;?>
        <div class="career__list">
            <?php if (is_array($tiles)): ?>
                <?php foreach ($tiles as $tile):
                    $image = $tile['background_image'];
                    $image_color = $tile['background_color'];
                    $image_color = $image_color ? 'career__image-container--gray' : '';
                    $link = $tile['link'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    $tile_title = $tile['tile_title'];
                    $overlay = $tile['blue_overlay'] ? 'career__image-container--overlay' : $tile['blue_overlay'] ;
                    ?>
                    <div class="career__item">
                        <div class="career__image-container <?= $overlay ?> <?php echo $image_color; ?>">
                            <img src="<?php echo esc_url($image['sizes']['large']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"
                            />
                        </div>
                        <h4 class="button"><?php echo esc_html($tile_title); ?></h4>
                        <a href="<?php echo  $link['url']; ?>" target="<?php echo $link_target; ?>" class="career__link"></a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

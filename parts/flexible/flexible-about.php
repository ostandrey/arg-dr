<?php
/**
 * About Section
 */
$section_label = get_sub_field('section_label');
$section_title = get_sub_field('section_title');
$info_blocks = get_sub_field('info_blocks');

$left_column_block = null;
$top_row_blocks = [];
$bottom_row_blocks = [];

if ($info_blocks && count($info_blocks) > 0) {
    foreach ($info_blocks as $index => $block) {
        if ($block['content_type'] === 'text' && !$left_column_block) {
            $left_column_block = $block;
            unset($info_blocks[$index]);
            break;
        }
    }

    $count = 0;
    foreach ($info_blocks as $index => $block) {
        if ($count < 2) {
            $top_row_blocks[] = $block;
            unset($info_blocks[$index]);
            $count++;
        } else {
            break;
        }
    }

    foreach ($info_blocks as $block) {
        $bottom_row_blocks[] = $block;
    }
}
?>

<section class="about">
    <div class="container">
        <?php if ($section_label): ?>
            <div class="about__heading">
                <span class="about__tag"><?php echo esc_html($section_label); ?></span>

                <?php if ($section_title): ?>
                    <h3 class="about__title"><?php echo esc_html($section_title); ?></h3>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="about__content">
            <div class="about__left-column">
                <?php if ($left_column_block): ?>
                    <div class="about__text-block">
                        <?php if ($left_column_block['block_title']): ?>
                            <h3 class="about__block-title"><?php echo esc_html($left_column_block['block_title']); ?></h3>
                        <?php endif; ?>

                        <?php if ($left_column_block['description']): ?>
                            <div class="about__desc">
                                <?php echo wp_kses_post($left_column_block['description']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="about__right-column">
                <div class="about__right-grid">
                    <?php if (!empty($top_row_blocks)): ?>
                        <div class="about__grid-row">
                            <?php foreach ($top_row_blocks as $block): ?>
                                <div class="about__grid-item">
                                    <?php if ($block['content_type'] === 'text'): ?>
                                        <div class="about__text-block">
                                            <?php if ($block['block_title']): ?>
                                                <h3 class="about__block-title"><?php echo esc_html($block['block_title']); ?></h3>
                                            <?php endif; ?>

                                            <?php if ($block['description']): ?>
                                                <div class="about__desc">
                                                    <?php echo wp_kses_post($block['description']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php elseif ($block['content_type'] === 'image' && !empty($block['image'])): ?>
                                        <div class="about__image">
                                            <?php echo wp_get_attachment_image($block['image']['ID'], 'large', false, ['class' => 'img-fluid']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($bottom_row_blocks)): ?>
                        <div class="about__grid-row">
                            <?php foreach ($bottom_row_blocks as $block): ?>
                                <div class="about__grid-item">
                                    <?php if ($block['content_type'] === 'text'): ?>
                                        <div class="about__text-block">
                                            <?php if ($block['block_title']): ?>
                                                <h3 class="about__block-title"><?php echo esc_html($block['block_title']); ?></h3>
                                            <?php endif; ?>

                                            <?php if ($block['description']): ?>
                                                <div class="about__desc">
                                                    <?php echo wp_kses_post($block['description']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php elseif ($block['content_type'] === 'image' && !empty($block['image'])): ?>
                                        <div class="about__image">
                                            <?php echo wp_get_attachment_image($block['image']['ID'], 'large', false, ['class' => 'img-fluid']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
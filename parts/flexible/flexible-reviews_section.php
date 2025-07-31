<?php
/**
 * Reviews Section
 *
 *
 */

$section_title = get_sub_field('section_title');
$reviews = get_sub_field('reviews');

if (empty($reviews)) {
    return;
}
?>

<section class="reviews">
    <div class="container">
        <?php if ($section_title): ?>
            <div class="reviews__title">
                <?php echo $section_title; ?>
            </div>
        <?php endif; ?>

        <?php if ($reviews): ?>
            <div class="reviews__cards">
                <div class="reviews__row">
                    <?php
                    for ($i = 0; $i < 2 && $i < count($reviews); $i++):
                        $review = $reviews[$i];
                        $icon = $review['icon'];
                        $title = $review['title'];
                        $description = $review['description'];
                        ?>
                        <div class="reviews__card reviews__card--half">
                            <?php if ($icon): ?>
                                <div class="reviews__card-icon">
                                    <?php display_svg($icon, 'reviews__icon'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($title): ?>
                                <h3 class="reviews__card-title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>

                            <?php if ($description): ?>
                                <div class="reviews__card-description"><?php echo esc_html($description); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>

                <?php if (count($reviews) > 2): ?>
                    <div class="reviews__row">
                        <?php
                        for ($i = 2; $i < 5 && $i < count($reviews); $i++):
                            $review = $reviews[$i];
                            $icon = $review['icon'];
                            $title = $review['title'];
                            $description = $review['description'];
                            ?>
                            <div class="reviews__card reviews__card--third">
                                <?php if ($icon): ?>
                                    <div class="reviews__card-icon">
                                        <?php display_svg($icon, 'reviews__icon'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($title): ?>
                                    <h3 class="reviews__card-title"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php if ($description): ?>
                                    <div class="reviews__card-description"><?php echo esc_html($description); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

                <?php if (count($reviews) > 5): ?>
                    <div class="reviews__row">
                        <?php
                        for ($i = 5; $i < 7 && $i < count($reviews); $i++):
                            $review = $reviews[$i];
                            $icon = $review['icon'];
                            $title = $review['title'];
                            $description = $review['description'];
                            ?>
                            <div class="reviews__card reviews__card--half">
                                <?php if ($icon): ?>
                                    <div class="reviews__card-icon">
                                        <?php display_svg($icon, 'reviews__icon'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($title): ?>
                                    <h3 class="reviews__card-title"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php if ($description): ?>
                                    <div class="reviews__card-description"><?php echo esc_html($description); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
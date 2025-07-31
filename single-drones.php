<?php
/**
 * The template for displaying single drone
 */

get_header();

// Get drone data
$drone_title = get_the_title();
$short_description = get_field('short_description');
$gallery = get_field('gallery');
$package_title = get_field('package_title') ?: 'У комплекті';
$package_contents = get_field('package_contents');
$order_button = get_field('order_button');

// Get drone tags
$drone_tags = get_the_terms(get_the_ID(), 'drone_tag');

$description_title = get_field('description_title') ?: 'Опис';
$features = get_field('features');
$description_gallery = get_field('additional_images');

$full_width_features = [];
$half_width_features = [];
$third_width_features = [];

if ($features) {
    foreach ($features as $feature) {
        if ($feature['width'] === 'full') {
            $full_width_features[] = $feature;
        } elseif ($feature['width'] === 'third') {
            $third_width_features[] = $feature;
        } else {
            $half_width_features[] = $feature;
        }
    }
}

$half_width_rows = array_chunk($half_width_features, 2);
$third_width_rows = array_chunk($third_width_features, 3);

$characteristics_title = get_field('specifications_title') ?: 'Характеристики';
$specification_groups = get_field('specification_groups');
?>

    <main class="drone-single">
        <!-- Hero Section -->
        <section class="drone-hero">
            <div class="container">
                <!-- Breadcrumbs -->
                <?php get_template_part('parts/breadcrumbs'); ?>

                <div class="drone-hero__content">
                    <!-- Slider Section -->
                    <div class="drone-hero__slider-wrapper">
                        <?php if ($gallery && !empty($gallery)) : ?>
                            <div class="drone-hero__slider">
                                <?php foreach ($gallery as $image) : ?>
                                    <div class="drone-hero__slide">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="drone-hero__image">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <div class="drone-hero__no-image">
                                <div class="drone-hero__placeholder">
                                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" fill="none"/>
                                        <path d="M3 8.4V19H21V8.4M3 8.4V5H21V8.4M3 8.4L12 13.5L21 8.4" stroke="#A1A0A0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Description Section -->
                    <div class="drone-hero__description">
                        <h1 class="drone-hero__title"><?php echo esc_html($drone_title); ?></h1>

                        <?php if ($drone_tags && !is_wp_error($drone_tags)) : ?>
                            <div class="drone-hero__tags-wrapper">
                                <div class="drone-hero__tags">
                                    <?php foreach ($drone_tags as $tag) : ?>
                                        <span class="drone-hero__tag"><?php echo esc_html($tag->name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($short_description) : ?>
                            <div class="drone-hero__text">
                                <?php echo wp_kses_post($short_description); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($package_contents && !empty($package_contents)) : ?>
                            <div class="drone-hero__package">
                                <div class="drone-hero__package-title"><?php echo esc_html($package_title); ?></div>
                                <div class="drone-hero__package-list">
                                    <?php foreach ($package_contents as $item) : ?>
                                        <div class="drone-hero__package-item">
                                            <div class="drone-hero__package-check">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.25 4.5L6.75 12L3.75 9" stroke="#FF7B00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <div class="drone-hero__package-content">
                                                <span class="drone-hero__package-name"><?php echo esc_html($item['item_name']); ?></span>
                                                <span class="drone-hero__package-quantity"><?php echo esc_html($item['quantity']); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($order_button) :
                            $link_url = $order_button['url'];
                            $link_title = $order_button['title'] ?: 'Замовити';
                            $link_target = $order_button['target'] ? $order_button['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="drone-hero__button"><?php echo esc_html($link_title); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="drone-description">
            <div class="container">
                <h2 class="drone-description__title"><?php echo esc_html($description_title); ?></h2>

                <div class="drone-description__cards">
                    <?php
                    foreach ($full_width_features as $feature) :
                        ?>
                        <div class="drone-description__row">
                            <div class="drone-description__card drone-description__card--full">
                                <?php if (!empty($feature['icon'])) : ?>
                                    <div class="drone-description__icon">
                                        <?php
                                        if (is_numeric($feature['icon'])) {
                                            echo wp_get_attachment_image($feature['icon'], 'full');
                                        } elseif (is_array($feature['icon'])) {
                                            echo '<img src="' . esc_url($feature['icon']['url']) . '" alt="' . esc_attr($feature['icon']['alt'] ?? '') . '">';
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <h3 class="drone-description__card-title"><?php echo esc_html($feature['title']); ?></h3>
                                <div class="drone-description__card-text"><?php echo $feature['description']; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php
                    foreach ($half_width_rows as $row) :
                        ?>
                        <div class="drone-description__row">
                            <?php foreach ($row as $feature) : ?>
                                <div class="drone-description__card drone-description__card--half">
                                    <?php if (!empty($feature['icon'])) : ?>
                                        <div class="drone-description__icon">
                                            <?php
                                            if (is_numeric($feature['icon'])) {
                                                echo wp_get_attachment_image($feature['icon'], 'full');
                                            } elseif (is_array($feature['icon'])) {
                                                echo '<img src="' . esc_url($feature['icon']['url']) . '" alt="' . esc_attr($feature['icon']['alt'] ?? '') . '">';
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <h3 class="drone-description__card-title"><?php echo esc_html($feature['title']); ?></h3>
                                    <div class="drone-description__card-text"><?php echo $feature['description']; ?></div>
                                </div>
                            <?php endforeach; ?>

                            <?php
                            if (count($row) === 1) :
                                ?>
                                <div class="drone-description__card drone-description__card--half drone-description__card--empty"></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>

                    <?php
                    foreach ($third_width_rows as $row) :
                        ?>
                        <div class="drone-description__row">
                            <?php foreach ($row as $feature) : ?>
                                <div class="drone-description__card drone-description__card--third">
                                    <?php if (!empty($feature['icon'])) : ?>
                                        <div class="drone-description__icon">
                                            <?php
                                            if (is_numeric($feature['icon'])) {
                                                echo wp_get_attachment_image($feature['icon'], 'full');
                                            } elseif (is_array($feature['icon'])) {
                                                echo '<img src="' . esc_url($feature['icon']['url']) . '" alt="' . esc_attr($feature['icon']['alt'] ?? '') . '">';
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <h3 class="drone-description__card-title"><?php echo esc_html($feature['title']); ?></h3>
                                    <div class="drone-description__card-text"><?php echo $feature['description']; ?></div>
                                </div>
                            <?php endforeach; ?>

                            <?php
                            for ($i = count($row); $i < 3; $i++) :
                                ?>
                                <div class="drone-description__card drone-description__card--third drone-description__card--empty"></div>
                            <?php endfor; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($description_gallery && count($description_gallery) > 0) : ?>
                    <div class="drone-description__gallery">
                        <?php
                        $gallery_count = count($description_gallery);
                        $gallery_class = 'drone-description__gallery--' . ($gallery_count <= 4 ? $gallery_count : 'multi');
                        ?>

                        <div class="drone-description__gallery-inner <?php echo esc_attr($gallery_class); ?>">
                            <?php if ($gallery_count === 3) : ?>
                                <?php
                                $large_image = $description_gallery[0];
                                ?>
                                <div class="drone-description__gallery-item drone-description__gallery-item--large">
                                    <img src="<?php echo esc_url($large_image['url']); ?>"
                                         alt="<?php echo esc_attr($large_image['alt'] ?? ''); ?>"
                                         class="drone-description__gallery-img">
                                </div>

                                <div class="drone-description__gallery-small-column">
                                    <?php for ($i = 1; $i < 3 && $i < $gallery_count; $i++) :
                                        $small_image = $description_gallery[$i];
                                        ?>
                                        <div class="drone-description__gallery-item">
                                            <img src="<?php echo esc_url($small_image['url']); ?>"
                                                 alt="<?php echo esc_attr($small_image['alt'] ?? ''); ?>"
                                                 class="drone-description__gallery-img">
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            <?php else : ?>
                                <?php foreach ($description_gallery as $image) : ?>
                                    <div class="drone-description__gallery-item">
                                        <img src="<?php echo esc_url($image['url']); ?>"
                                             alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                                             class="drone-description__gallery-img">
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="drone-characteristics">
            <div class="container">
                <h2 class="drone-characteristics__title"><?php echo esc_html($characteristics_title); ?></h2>

                <div class="drone-characteristics__content">
                    <?php if ($specification_groups) : ?>
                        <?php foreach ($specification_groups as $index => $group) : ?>
                            <?php if ($index > 0) : ?>
                                <div class="drone-characteristics__divider"></div>
                            <?php endif; ?>

                            <div class="drone-characteristics__container">
                                <h3 class="drone-characteristics__group-title"><?php echo esc_html($group['group_title']); ?></h3>

                                <div class="drone-characteristics__rows">
                                    <?php
                                    if (!empty($group['specifications'])) :
                                        $specs_count = count($group['specifications']);
                                        for ($i = 0; $i < $specs_count; $i += 2) :
                                            $spec_left = $group['specifications'][$i];
                                            $spec_right = ($i + 1 < $specs_count) ? $group['specifications'][$i + 1] : null;

                                            $is_full_width = !$spec_right;
                                            ?>
                                            <div class="drone-characteristics__row <?php echo $is_full_width ? 'drone-characteristics__row--full' : ''; ?>">
                                                <div class="drone-characteristics__text <?php echo $is_full_width ? 'drone-characteristics__text--full' : ''; ?>">
                                                    <div class="drone-characteristics__spec-name"><?php echo esc_html($spec_left['spec_name']); ?></div>
                                                    <div class="drone-characteristics__spec-value"><?php echo esc_html($spec_left['spec_value']); ?></div>
                                                </div>

                                                <?php if (!$is_full_width && $spec_right) : ?>
                                                    <div class="drone-characteristics__text">
                                                        <div class="drone-characteristics__spec-name"><?php echo esc_html($spec_right['spec_name']); ?></div>
                                                        <div class="drone-characteristics__spec-value"><?php echo esc_html($spec_right['spec_value']); ?></div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php
                                        endfor;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php get_template_part('parts/contact-form'); ?>
    </main>

<?php get_footer(); ?>
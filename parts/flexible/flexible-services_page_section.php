<?php
/**
 * Services Page Section
 */
$section_title = get_sub_field('section_title') ?: __('Services', 'argument');

$services_args = array(
    'post_type' => 'service',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
);
$services_query = new WP_Query($services_args);

$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'uk';
?>

<section class="services-page-section">
    <div class="container">
        <?php if ($section_title): ?>
            <h1 class="services-page-section__title"><?php echo esc_html($section_title); ?></h1>
        <?php endif; ?>

        <?php if ($services_query->have_posts()): ?>
            <div class="services-page-section__cards">
                <?php
                $counter = 0;
                $services_per_row = 2;

                while ($services_query->have_posts()): $services_query->the_post();
                    if ($counter % $services_per_row === 0):
                        echo '<div class="services-page-section__row">';
                    endif;

                    $service_link = get_field('service_link');
                    $service_url = $service_link ? $service_link['url'] : '#contact';
                    $service_target = $service_link && isset($service_link['target']) ? $service_link['target'] : '_self';

                    $button_text = '';
                    if ($service_link && !empty($service_link['title'])) {
                        $button_text = $service_link['title'];
                    } else {
                        $button_text = $current_lang === 'en' ? 'Contact Us' : 'Зв\'язатись з Нами';
                    }
                    ?>
                    <a href="<?php echo esc_url($service_url); ?>" target="<?php echo esc_attr($service_target); ?>" class="services-page-section__card">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="services-page-section__card-image">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="services-page-section__card-content">
                            <div class="services-page-section__card-text">
                                <h3 class="services-page-section__card-title"><?php the_title(); ?></h3>
                                <?php if (get_field('service_description')): ?>
                                    <div class="services-page-section__card-description">
                                        <?php echo wp_kses_post(get_field('service_description')); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="services-page-section__card-button btn btn-primary">
                                <?php echo esc_html($button_text); ?>
                            </div>
                        </div>
                    </a>
                    <?php
                    $counter++;
                    if ($counter % $services_per_row === 0 || $counter === $services_query->post_count):
                        echo '</div>';
                    endif;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>
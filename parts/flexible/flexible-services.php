<?php
/**
 * Services Section for Homepage
 */
$section_tag = get_sub_field('section_tag');
$section_title = get_sub_field('section_title');
$button_link = get_sub_field('button_link');
$services_count = get_sub_field('services_count') ?: 4;

$services_args = array(
    'post_type' => 'service',
    'posts_per_page' => $services_count,
    'orderby' => 'menu_order',
    'order' => 'ASC',
);
$services_query = new WP_Query($services_args);
?>

<section class="services">
    <div class="container">
        <div class="services__header">
            <div class="services__header-text">
                <?php if ($section_tag): ?>
                    <div class="services__tag"><?php echo esc_html($section_tag); ?></div>
                <?php endif; ?>

                <?php if ($section_title): ?>
                    <h3 class="services__title"><?php echo esc_html($section_title); ?></h3>
                <?php endif; ?>
            </div>

            <?php if ($button_link && $button_link['url'] && $button_link['title']): ?>
                <a href="<?php echo esc_url($button_link['url']); ?>" target="<?php echo esc_attr($button_link['target'] ?: '_self'); ?>" class="services__button">
                    <?php echo esc_html($button_link['title']); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if ($services_query->have_posts()): ?>
            <div class="services__cards">
                <?php
                $counter = 0;
                $services_per_row = 2;

                while ($services_query->have_posts()): $services_query->the_post();
                    if ($counter % $services_per_row === 0):
                        echo '<div class="services__row">';
                    endif;

                    $service_link = get_field('service_link');
                    $service_url = $service_link ? $service_link['url'] : '#contact';
                    $service_target = $service_link && isset($service_link['target']) ? $service_link['target'] : '_self';
                    ?>
                    <a href="<?php echo esc_url($service_url); ?>" target="<?php echo esc_attr($service_target); ?>" class="services__card">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="services__card-image">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="services__card-content">
                            <div class="services__card-text">
                                <h3 class="services__card-title"><?php the_title(); ?></h3>
                                <?php if (get_field('service_description')): ?>
                                    <div class="services__card-description">
                                        <?php echo wp_kses_post(get_field('service_description')); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="services__card-button">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 17L17 7M17 7H7M17 7V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
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
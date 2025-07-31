<?php
/**
 *
 */

$section_title = get_sub_field('section_title') ?: __('Services', 'argument');
$services_display = get_sub_field('services_display') ?: 'all';
$services_count = get_sub_field('services_count') ?: -1;
$selected_services = get_sub_field('selected_services') ?: [];
$manual_services = get_sub_field('manual_services') ?: [];
?>

<section class="services-section">
    <div class="container">
        <h1 class="services-section__title"><?php echo esc_html($section_title); ?></h1>

        <div class="services-grid">
            <?php
            $services = [];

            if ($services_display === 'all') {
                $args = array(
                    'post_type' => 'services',
                    'posts_per_page' => $services_count,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );

                $services_query = new WP_Query($args);

                if ($services_query->have_posts()) {
                    while ($services_query->have_posts()) {
                        $services_query->the_post();
                        $services[] = array(
                            'id' => get_the_ID(),
                            'title' => get_the_title(),
                            'image' => get_field('service_image'),
                            'description' => get_field('service_description'),
                            'button' => get_field('service_button')
                        );
                    }
                    wp_reset_postdata();
                }
            } elseif ($services_display === 'selected' && !empty($selected_services)) {
                foreach ($selected_services as $service_id) {
                    $services[] = array(
                        'id' => $service_id,
                        'title' => get_the_title($service_id),
                        'image' => get_field('service_image', $service_id),
                        'description' => get_field('service_description', $service_id),
                        'button' => get_field('service_button', $service_id)
                    );
                }
            } elseif ($services_display === 'manual' && !empty($manual_services)) {
                foreach ($manual_services as $service) {
                    $services[] = array(
                        'id' => 0,
                        'title' => $service['service_title'],
                        'image' => $service['service_image'],
                        'description' => $service['service_description'],
                        'button' => $service['service_button']
                    );
                }
            }

            if (!empty($services)) {
                $counter = 0;
                $total_services = count($services);
                $services_per_row = 2;

                foreach ($services as $service) {
                    if ($counter % $services_per_row === 0) {
                        echo '<div class="services-row">';
                    }
                    ?>

                    <a href="<?php echo esc_url($service['button']['url']); ?>" class="service-card">
                        <?php if (!empty($service['image'])) : ?>
                            <div class="service-card__image" style="background-image: url('<?php echo esc_url($service['image']['url']); ?>')"></div>
                        <?php endif; ?>

                        <div class="service-card__content">
                            <div class="service-card__text">
                                <?php if (!empty($service['title'])) : ?>
                                    <h3 class="service-card__title"><?php echo esc_html($service['title']); ?></h3>
                                <?php endif; ?>

                                <?php if (!empty($service['description'])) : ?>
                                    <div class="service-card__description"><?php echo $service['description']; ?></div>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($service['button'])) : ?>
                                <div class="service-card__button btn btn-primary">
                                    <?php echo esc_html($service['button']['title']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>

                    <?php
                    $counter++;

                    if ($counter % $services_per_row === 0 || $counter === $total_services) {
                        echo '</div>';
                    }
                }
            } else {
                echo '<p>' . __('Services are not found.', 'argument') . '</p>';
            }
            ?>
        </div>
    </div>
</section>
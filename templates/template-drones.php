<?php
/**
 * Template Name: Drones
 */

get_header();

$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';

function get_drone_text($field_name) {
    global $current_lang;

    if ($current_lang === 'en') {
        $text = get_field($field_name . '_en', 'option');
        return $text ?: get_field($field_name, 'option');
    } else {
        return get_field($field_name, 'option');
    }
}

// Get parent terms for drone sizes (10 inch, 7 inch, 8 inch)
$drone_sizes = get_terms(array(
    'taxonomy' => 'drone_size',
    'hide_empty' => false,
    'parent' => 0
));

// Get parent terms for drone task types
$drone_task_types = get_terms(array(
    'taxonomy' => 'drone_task_type',
    'hide_empty' => false,
    'parent' => 0
));

$current_size = isset($_GET['size']) ? sanitize_text_field($_GET['size']) : '';
$current_size_subcat = isset($_GET['size_subcat']) ? sanitize_text_field($_GET['size_subcat']) : '';

$current_task = isset($_GET['task']) ? sanitize_text_field($_GET['task']) : '';
$current_task_subcat = isset($_GET['task_subcat']) ? sanitize_text_field($_GET['task_subcat']) : '';

$default_size_drone = get_default_drone_for_section('drone_size');
$default_task_drone = get_default_drone_for_section('drone_task_type');

$default_size_categories = $default_size_drone ? get_drone_categories($default_size_drone->ID, 'drone_size') : null;
$default_task_categories = $default_task_drone ? get_drone_categories($default_task_drone->ID, 'drone_task_type') : null;

$page_title = get_drone_text('drones_page_title');
$size_title = get_drone_text('drones_by_size_title');
$task_title = get_drone_text('drones_by_task_title');
?>

    <section class="drones-section">
        <div class="container">
            <?php get_template_part('parts/breadcrumbs'); ?>
            <div class="drones-section__content">
                <!-- Page Title -->
                <h3 class="drones-section__title">
                    <?php echo esc_html($page_title ?: ($current_lang === 'en' ? 'Drones' : 'Дрони')); ?>
                </h3>

                <div class="drones-section__main">

                    <!-- Drones by Size -->
                    <?php if (!empty($drone_sizes)): ?>
                        <div class="drones-by-size">
                            <div class="drones-category">
                                <h4 class="drones-category__title">
                                    <?php echo esc_html($size_title ?: ($current_lang === 'en' ? 'Drones by Size' : 'Дрони за Розмірами')); ?>
                                </h4>

                                <div class="drones-category__filters">
                                    <?php foreach ($drone_sizes as $size_term):
                                        $subcategories = get_terms(array(
                                            'taxonomy' => 'drone_size',
                                            'hide_empty' => false,
                                            'parent' => $size_term->term_id
                                        ));

                                        $has_drones = false;
                                        foreach ($subcategories as $subcat) {
                                            if (get_drone_by_category($size_term->slug, $subcat->slug, 'drone_size')) {
                                                $has_drones = true;
                                                break;
                                            }
                                        }

                                        if (!$has_drones) continue;
                                        ?>
                                        <div class="filter-group">
                                            <h3 class="filter-group__title"><?php echo esc_html($size_term->name); ?></h3>

                                            <?php if (!empty($subcategories)): ?>
                                                <div class="filter-group__buttons">
                                                    <?php foreach ($subcategories as $subcat):
                                                        $drone_exists = get_drone_by_category($size_term->slug, $subcat->slug, 'drone_size');
                                                        if (!$drone_exists) continue;

                                                        $is_active = false;
                                                        if ($current_size && $current_size_subcat) {
                                                            $is_active = ($current_size == $size_term->slug && $current_size_subcat == $subcat->slug);
                                                        } else if ($default_size_categories) {
                                                            $is_active = ($default_size_categories['parent'] == $size_term->slug && $default_size_categories['child'] == $subcat->slug);
                                                        }

                                                        $filter_url = add_query_arg(array(
                                                            'size' => $size_term->slug,
                                                            'size_subcat' => $subcat->slug,
                                                            'task' => $current_task,
                                                            'task_subcat' => $current_task_subcat
                                                        ));
                                                        ?>
                                                        <a href="<?php echo esc_url($filter_url); ?>"
                                                           class="filter-button <?php echo $is_active ? 'active' : ''; ?>"
                                                           data-section="size"
                                                           data-parent="<?php echo esc_attr($size_term->slug); ?>"
                                                           data-subcat="<?php echo esc_attr($subcat->slug); ?>">
                                                            <?php echo esc_html($subcat->name); ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="drone-showcase" id="size-showcase">
                                    <?php
                                    $display_drone = null;
                                    if ($current_size && $current_size_subcat) {
                                        $display_drone = get_drone_by_category($current_size, $current_size_subcat, 'drone_size');
                                    } else {
                                        $display_drone = $default_size_drone;
                                    }

                                    if ($display_drone) {
                                        echo render_drone_showcase($display_drone);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Drones by Task Type -->
                    <?php if (!empty($drone_task_types)): ?>
                        <div class="drones-by-task">
                            <div class="drones-category">
                                <h4 class="drones-category__title">
                                    <?php echo esc_html($task_title ?: ($current_lang === 'en' ? 'Drones by Task Type' : 'Дрони за Типом Завдань')); ?>
                                </h4>

                                <div class="drones-category__filters">
                                    <?php foreach ($drone_task_types as $task_term):
                                        $subcategories = get_terms(array(
                                            'taxonomy' => 'drone_task_type',
                                            'hide_empty' => false,
                                            'parent' => $task_term->term_id
                                        ));

                                        $has_drones = false;
                                        foreach ($subcategories as $subcat) {
                                            if (get_drone_by_category($task_term->slug, $subcat->slug, 'drone_task_type')) {
                                                $has_drones = true;
                                                break;
                                            }
                                        }

                                        if (!$has_drones) continue;
                                        ?>
                                        <div class="filter-group">
                                            <h3 class="filter-group__title"><?php echo esc_html($task_term->name); ?></h3>

                                            <?php if (!empty($subcategories)): ?>
                                                <div class="filter-group__buttons">
                                                    <?php foreach ($subcategories as $subcat):
                                                        $drone_exists = get_drone_by_category($task_term->slug, $subcat->slug, 'drone_task_type');
                                                        if (!$drone_exists) continue;

                                                        $is_active = false;
                                                        if ($current_task && $current_task_subcat) {
                                                            $is_active = ($current_task == $task_term->slug && $current_task_subcat == $subcat->slug);
                                                        } else if ($default_task_categories) {
                                                            $is_active = ($default_task_categories['parent'] == $task_term->slug && $default_task_categories['child'] == $subcat->slug);
                                                        }

                                                        $filter_url = add_query_arg(array(
                                                            'size' => $current_size,
                                                            'size_subcat' => $current_size_subcat,
                                                            'task' => $task_term->slug,
                                                            'task_subcat' => $subcat->slug
                                                        ));
                                                        ?>
                                                        <a href="<?php echo esc_url($filter_url); ?>"
                                                           class="filter-button <?php echo $is_active ? 'active' : ''; ?>"
                                                           data-section="task"
                                                           data-parent="<?php echo esc_attr($task_term->slug); ?>"
                                                           data-subcat="<?php echo esc_attr($subcat->slug); ?>">
                                                            <?php echo esc_html($subcat->name); ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="drone-showcase" id="task-showcase">
                                    <?php
                                    $display_drone = null;
                                    if ($current_task && $current_task_subcat) {
                                        $display_drone = get_drone_by_category($current_task, $current_task_subcat, 'drone_task_type');
                                    } else {
                                        $display_drone = $default_task_drone;
                                    }

                                    if ($display_drone) {
                                        echo render_drone_showcase($display_drone);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>

<?php if (have_rows('content')): ?>
    <?php while (have_rows('content')): the_row(); ?>
        <?php get_template_part('parts/flexible/flexible', get_row_layout()); ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php
get_footer();
?>

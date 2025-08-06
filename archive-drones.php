<?php
/**
 * The template for displaying drone archive
 *
 * @package YourTheme
 */

get_header();

$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';

// Get all drones
$drones_args = array(
    'post_type' => 'drones',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
);

$drones_query = new WP_Query($drones_args);
$drones = $drones_query->posts;

$page_title = get_field('archive_page_title', 'option') ?: ($current_lang === 'en' ? 'Drones' : 'Дрони');
?>

    <section class="drones-section">
        <div class="container">
            <!-- Breadcrumbs -->
            <div class="bc">
                <a href="<?php echo home_url(); ?>" class="bc-item">Головна</a>
                <span class="bc-separator">/</span>
                <span class="bc-item"><?php echo esc_html($page_title); ?></span>
            </div>

            <div class="drones-section__content">
                <!-- Page Title -->
                <h1 class="drones-section__title">
                    <?php echo esc_html($page_title); ?>
                </h1>

                <div class="drones-section__main">
                    <div class="drones-list">
                        <?php if (!empty($drones)): ?>
                            <div class="drones-grid">
                                <?php foreach ($drones as $drone): 
                                    // Get drone category using standard WordPress categories
                                    $subcategory_title = '';
                                    
                                    // Get the first category for this drone
                                    $categories = get_the_category($drone->ID);
                                    
                                    if (!empty($categories) && !is_wp_error($categories)) {
                                        $subcategory_title = $categories[0]->name;
                                    }
                                ?>
                                    <div class="drones-page-card">
                                        <?php if (!empty($subcategory_title)): ?>
                                            <div class="drone-category">
                                                <span class="drone-category__label"><?php echo esc_html($subcategory_title); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php echo render_drone_showcase($drone); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="no-drones-message">
                                <p><?php echo $current_lang === 'en' ? 'No drones available at the moment.' : 'Наразі дрони недоступні.'; ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
?>

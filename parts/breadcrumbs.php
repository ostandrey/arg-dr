<?php
/**
 * Breadcrumbs with automatic page title detection and translations
 */

$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';
$home_url = function_exists('pll_home_url') ? pll_home_url() : home_url();

function get_translated_page_data($page_slug, $current_lang) {
    $page = get_page_by_path($page_slug);
    if (!$page) return null;

    if (function_exists('pll_get_post')) {
        $translated_id = pll_get_post($page->ID, $current_lang);
        if ($translated_id) {
            return array(
                'url' => get_permalink($translated_id),
                'title' => get_the_title($translated_id)
            );
        }
    }

    return array(
        'url' => get_permalink($page->ID),
        'title' => get_the_title($page->ID)
    );
}

function get_drones_page_data($current_lang) {
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'template-drones.php'
    ));

    if (!empty($pages)) {
        $page_id = $pages[0]->ID;

        if (function_exists('pll_get_post')) {
            $translated_id = pll_get_post($page_id, $current_lang);
            if ($translated_id) {
                $page_id = $translated_id;
            }
        }

        return array(
            'url' => get_permalink($page_id),
            'title' => get_the_title($page_id)
        );
    }

    return get_translated_page_data('drones', $current_lang);
}

function get_breadcrumb_translations($current_lang) {
    return array(
        'home' => $current_lang === 'en' ? 'Home' : 'Головна',
        'blog' => $current_lang === 'en' ? 'Blog' : 'Блог',
        'services' => $current_lang === 'en' ? 'Services' : 'Послуги',
        'drones' => $current_lang === 'en' ? 'Drones' : 'Дрони'
    );
}

$translations = get_breadcrumb_translations($current_lang);
?>

<div class="breadcrumbs">
    <div>
        <a href="<?php echo esc_url($home_url); ?>" class="breadcrumbs__item">
            <?php echo esc_html($translations['home']); ?>
        </a>
        <span class="breadcrumbs__separator">/</span>

        <?php if (is_singular('service')) : ?>
            <?php
            $services_page = get_translated_page_data('services', $current_lang);
            if ($services_page): ?>
                <a href="<?php echo esc_url($services_page['url']); ?>" class="breadcrumbs__item">
                    <?php echo esc_html($services_page['title']); ?>
                </a>
                <span class="breadcrumbs__separator">/</span>
            <?php else: ?>
                <span class="breadcrumbs__item">
                    <?php echo esc_html($translations['services']); ?>
                </span>
                <span class="breadcrumbs__separator">/</span>
            <?php endif; ?>
            <span class="breadcrumbs__item breadcrumbs__item--active"><?php the_title(); ?></span>

        <?php elseif (is_singular('post')) : ?>
            <?php
            $blog_page_id = get_option('page_for_posts');
            $blog_url = '';
            $blog_title = $translations['blog'];

            if ($blog_page_id) {
                // Если есть назначенная страница для постов
                if (function_exists('pll_get_post')) {
                    $translated_blog_id = pll_get_post($blog_page_id, $current_lang);
                    if ($translated_blog_id) {
                        $blog_url = get_permalink($translated_blog_id);
                        $blog_title = get_the_title($translated_blog_id);
                    } else {
                        $blog_url = get_permalink($blog_page_id);
                        $blog_title = get_the_title($blog_page_id);
                    }
                } else {
                    $blog_url = get_permalink($blog_page_id);
                    $blog_title = get_the_title($blog_page_id);
                }
            } else {
                $blog_url = get_post_type_archive_link('post');
                if (function_exists('pll_home_url')) {
                    $blog_url = pll_home_url() . ($current_lang === 'en' ? 'en/blog/' : 'blog/');
                }
            }
            ?>
            <a href="<?php echo esc_url($blog_url); ?>" class="breadcrumbs__item">
                <?php echo esc_html($blog_title); ?>
            </a>
            <span class="breadcrumbs__separator">/</span>
            <span class="breadcrumbs__item breadcrumbs__item--active"><?php the_title(); ?></span>

        <?php elseif (is_singular('drones')) : ?>
            <?php
            $drones_page = get_drones_page_data($current_lang);
            if ($drones_page): ?>
                <a href="<?php echo esc_url($drones_page['url']); ?>" class="breadcrumbs__item">
                    <?php echo esc_html($drones_page['title']); ?>
                </a>
                <span class="breadcrumbs__separator">/</span>
            <?php else: ?>
                <span class="breadcrumbs__item">
                    <?php echo esc_html($translations['drones']); ?>
                </span>
                <span class="breadcrumbs__separator">/</span>
            <?php endif; ?>
            <span class="breadcrumbs__item breadcrumbs__item--active"><?php the_title(); ?></span>

        <?php elseif (is_page_template('template-drones.php')) : ?>
            <span class="breadcrumbs__item breadcrumbs__item--active"><?php the_title(); ?></span>

        <?php elseif (is_home() || is_category() || is_tag() || is_archive()) : ?>
            <span class="breadcrumbs__item breadcrumbs__item--active">
                <?php echo esc_html($translations['blog']); ?>
            </span>

        <?php elseif (is_page()) : ?>
            <span class="breadcrumbs__item breadcrumbs__item--active"><?php the_title(); ?></span>

        <?php endif; ?>
    </div>
</div>
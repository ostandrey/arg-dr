<?php
/**
 * Blog Archive Page
 */
get_header();

$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';

function get_blog_title_from_options($current_lang) {
    if ($current_lang === 'en') {
        $title = get_field('blog_title_en', 'option');
        return !empty($title) ? $title : 'Blog';
    } else {
        $title = get_field('blog_title', 'option');
        return !empty($title) ? $title : 'Блог';
    }
}

$blog_title = get_blog_title_from_options($current_lang);

$translations = array(
    'ua' => array(
        'back' => 'Назад',
        'forward' => 'Вперед',
        'no_posts' => 'Постів не знайдено.',
        'read_more' => 'Читати далі'
    ),
    'en' => array(
        'back' => 'Back',
        'forward' => 'Forward',
        'no_posts' => 'No posts found.',
        'read_more' => 'Read more'
    )
);

$t = $translations[$current_lang];
?>

    <main class="blog-page">
        <!-- Breadcrumbs -->
        <div class="container">
            <?php get_template_part('parts/breadcrumbs'); ?>
        </div>

        <!-- Blog Header -->
        <section class="blog-header">
            <div class="container">
                <h1 class="blog-header__title"><?php echo esc_html($blog_title); ?></h1>
            </div>
        </section>

        <!-- Blog Content -->
        <section class="blog-content">
            <div class="container">
                <?php if (have_posts()) : ?>
                    <div class="blog-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="blog-card">
                                <a href="<?php the_permalink(); ?>" class="blog-card__link">
                                    <div class="blog-card__image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('large', array('class' => 'blog-card__img')); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.jpg"
                                                 alt="<?php the_title_attribute(); ?>" class="blog-card__img">
                                        <?php endif; ?>
                                    </div>
                                    <div class="blog-card__content">
                                        <h3 class="blog-card__title"><?php the_title(); ?></h3>
                                        <div class="blog-card__excerpt">
                                            <?php
                                            $excerpt = get_the_excerpt();
                                            if (empty($excerpt)) {
                                                $excerpt = wp_trim_words(get_the_content(), 25, '...');
                                            }
                                            echo $excerpt;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="blog-card__button">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.66 12.66L5.66 19.66" stroke="white" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.66 12.66V19.66H12.66" stroke="white" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="blog-pagination">
                        <?php
                        $prev_arrow = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
                        $next_arrow = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

                        echo '<div class="pagination-wrapper">';

                        // Previous page
                        if (get_previous_posts_link()) {
                            echo '<div class="pagination-prev">';
                            previous_posts_link('<div class="pagination-arrow pagination-arrow-prev">' . $prev_arrow . '</div><span>' . esc_html($t['back']) . '</span>');
                            echo '</div>';
                        } else {
                            echo '<div class="pagination-prev pagination-prev--disabled">';
                            echo '<div class="pagination-arrow pagination-arrow-prev">' . $prev_arrow . '</div><span>' . esc_html($t['back']) . '</span>';
                            echo '</div>';
                        }

                        // Page numbers
                        echo '<div class="pagination-numbers">';
                        echo paginate_links(array(
                            'prev_next' => false,
                            'type' => 'plain',
                            'end_size' => 1,
                            'mid_size' => 1,
                        ));
                        echo '</div>';

                        // Next page
                        if (get_next_posts_link()) {
                            echo '<div class="pagination-next">';
                            next_posts_link('<span>' . esc_html($t['forward']) . '</span><div class="pagination-arrow pagination-arrow-next">' . $next_arrow . '</div>');
                            echo '</div>';
                        } else {
                            echo '<div class="pagination-next pagination-next--disabled">';
                            echo '<span>' . esc_html($t['forward']) . '</span><div class="pagination-arrow pagination-arrow-next">' . $next_arrow . '</div>';
                            echo '</div>';
                        }

                        echo '</div>';
                        ?>
                    </div>
                <?php else : ?>
                    <div class="blog-empty">
                        <p><?php echo esc_html($t['no_posts']); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <?php get_template_part('parts/cta-section'); ?>
    </main>

<?php get_footer(); ?>
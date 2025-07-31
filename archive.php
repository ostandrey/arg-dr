<?php
/**
 * Home
 *
 * Standard loop for the blog-page
 */
get_header();
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$reviews_hero_title = get_field('news_hero_title', 'options');
$reviews_hero_image = get_field('news_hero_image', 'options');
$current_category = get_queried_object();
$current_category_id = $current_category ? $current_category->term_id : 0;

$title = $reviews_hero_title ?? get_the_archive_title();

$cat_args = array(
    'orderby' => 'name', // Order by name
    'order' => 'ASC',  // Order ascending
    'hide_empty' => false,  // Include empty categories
);

$categories = get_categories($cat_args);

?>

<main>
    <section class="w-100 hero d-flex justify-content-center align-items-center <?= $module_class ?>"
             id="<?= $module_id ?>">
        <div class="hero__background" <?php bg($reviews_hero_image, 'full_hd') ?>></div>
        <h1 class="hero__title text-center align-middle"><?php echo $title; ?></h1>
        <div class="hero__overlay"></div>
    </section>

    <div class="container py-md-5">
        <div class="row pb-sm-4 category__list">
            <?php foreach ($categories as $category): ?>
                <?php $is_active = ($category->term_id == $current_category_id); ?>
                <div class="category__container <?php echo $is_active ? 'category__container-active' : ''; ?>">
                    <a href="<?php echo get_category_link($category->term_id); ?>" class="category__title">
                        <h2><?php echo esc_html($category->name); ?></h2>
                    </a>
                </div>
                <div class="separator"></div>
            <?php endforeach; ?>
        </div>
        <div class="row posts-list">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('parts/loop', 'post'); // Post item ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <!-- BEGIN of pagination -->
            <?php bootstrap_pagination(); ?>
            <!-- END of pagination -->
        </div>
    </div>
</main>

<?php get_footer(); ?>
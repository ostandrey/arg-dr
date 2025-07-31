<?php
/**
 * Single Post Template
 */
get_header();

$post_title = get_the_title();
$post_date = get_the_date('d.m.Y');
$post_content = get_the_content();
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

$quote_text = get_field('quote_text');
$quote_author = get_field('quote_author');
$show_table_of_contents = get_field('show_table_of_contents');
$checklist_title = get_field('checklist_title');
$checklist_items = get_field('checklist_items');
?>

    <main class="blog-single">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <?php get_template_part('parts/breadcrumbs'); ?>
            </div>
        </div>

        <div class="container">
            <!-- Post Header -->
            <div class="blog-single__header">
                <h1 class="blog-single__title"><?php echo esc_html($post_title); ?></h1>
                <div class="blog-single__date"><?php echo esc_html($post_date); ?></div>
            </div>

            <!-- Featured Image -->
            <?php if ($featured_image) : ?>
                <div class="blog-single__featured-image">
                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($post_title); ?>" class="blog-single__img">
                </div>
            <?php endif; ?>

            <!-- Quote Section -->
            <?php if ($quote_text) : ?>
                <div class="blog-single__quote">
                    <div class="blog-single__quote-line"></div>
                    <div class="blog-single__quote-content">
                        <?php if ($quote_author) : ?>
                            <div class="blog-single__quote-author"><?php echo esc_html($quote_author); ?></div>
                        <?php endif; ?>
                        <div class="blog-single__quote-text">
                            <?php echo wp_kses_post($quote_text); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Table of Contents -->
            <?php if ($show_table_of_contents) : ?>
                <div class="blog-single__toc" id="toc-container"></div>
            <?php endif; ?>

            <!-- Main Content -->
            <div class="blog-single__content">
                <?php the_content(); ?>
            </div>

            <!-- Checklist Section -->
            <?php if ($checklist_items && is_array($checklist_items) && count($checklist_items) > 0) : ?>
                <div class="blog-single__checklist">
                    <?php if ($checklist_title) : ?>
                        <h3 class="blog-single__checklist-title"><?php echo esc_html($checklist_title); ?></h3>
                    <?php endif; ?>

                    <div class="blog-single__table-wrapper">
                        <table class="blog-single__table">
                            <thead>
                            <tr>
                                <th><?php echo esc_html(get_field('checklist_column_1_header') ?: 'Параметр'); ?></th>
                                <th><?php echo esc_html(get_field('checklist_column_2_header') ?: 'Важливість на полі бою'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($checklist_items as $item) : ?>
                                <tr>
                                    <td><?php echo esc_html($item['parameter']); ?></td>
                                    <td><?php echo esc_html($item['importance']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Post Navigation -->
            <div class="blog-single__navigation">
                <div class="blog-single__navigation-prev">
                    <?php previous_post_link('%link', '<div class="blog-single__navigation-arrow blog-single__navigation-arrow--prev"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span>Попередня стаття</span>'); ?>
                </div>
                <div class="blog-single__navigation-next">
                    <?php next_post_link('%link', '<span>Наступна стаття</span><div class="blog-single__navigation-arrow blog-single__navigation-arrow--next"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>'); ?>
                </div>
            </div>
        </div>

        <!-- Contact Form Section -->
        <?php get_template_part('parts/cta-section'); ?>
    </main>

<?php get_footer(); ?>
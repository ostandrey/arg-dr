<?php
/**
 * Client Reviews Section
 */

$section_tag = get_sub_field('section_tag');
$section_title = get_sub_field('section_title');
$client_reviews_source = get_sub_field('client_reviews_source');

$client_reviews = [];

if ($client_reviews_source === 'selected') {
    $selected_client_reviews = get_sub_field('selected_client_reviews');
    if ($selected_client_reviews) {
        $client_reviews = $selected_client_reviews;
    }
} else {
    $client_reviews_count = get_sub_field('client_reviews_count') ?: 3;

    $args = [
        'post_type' => 'client_reviews',
        'posts_per_page' => $client_reviews_count,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    $client_reviews_query = new WP_Query($args);

    if ($client_reviews_query->have_posts()) {
        $client_reviews = $client_reviews_query->posts;
    }
}

if (empty($client_reviews)) {
    return;
}
?>

<section class="client-reviews">
    <div class="container">
        <?php if ($section_tag): ?>
            <div class="client-reviews__tag"><?php echo esc_html($section_tag); ?></div>
        <?php endif; ?>

        <?php if ($section_title): ?>
            <h2 class="client-reviews__title"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($client_reviews)): ?>
            <div class="client-reviews__slider" data-reviews-slider>
                <?php foreach ($client_reviews as $review): ?>
                    <div class="client-reviews__slide">
                        <div class="client-reviews__card">
                            <div class="client-reviews__card-content">
                                <h3 class="client-reviews__card-title"><?php echo esc_html(get_the_title($review->ID)); ?></h3>

                                <div class="client-reviews__card-text">
                                    <?php
                                    $content = get_the_content(null, false, $review->ID);
                                    $content = apply_filters('the_content', $content);
                                    $content = str_replace(']]>', ']]&gt;', $content);

                                    $paragraphs = explode('</p>', $content);
                                    foreach ($paragraphs as $paragraph) {
                                        if (trim($paragraph)) {
                                            echo '<p>' . trim(strip_tags($paragraph)) . '</p>';
                                        }
                                    }
                                    ?>
                                </div>

                                <?php
                                $review_author = get_field('author', $review->ID);
                                if ($review_author):
                                    ?>
                                    <div class="client-reviews__card-author"><?php echo esc_html($review_author); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
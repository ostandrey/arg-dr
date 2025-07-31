<?php
/**
 * Page
 */
get_header();
//Use isset
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$reviews_hero_title = get_field('reviews_hero_title', 'options');
$reviews_hero_image = get_field('reviews_hero_image', 'options');

$reviews_hero_title_field = get_field('reviews_hero_title_field', 'options');
$reviews_hero_field = get_field('reviews_hero_field', 'options');

$title = $reviews_hero_title ?? get_the_archive_title();

?>

<main>
    <section class="w-100 hero d-flex justify-content-center align-items-center <?= $module_class ?>" id="<?= $module_id ?>">
        <?php if ($reviews_hero_title_field) { ?>
        <div class="hero__background"  <?php bg($reviews_hero_image, 'full_hd')?>></div>
        <?php }
        if ($reviews_hero_field) { ?>
        <h1 class="hero__title text-center align-middle"><?php echo $title; ?></h1>
        <?php } ?>
        <div class="hero__overlay"></div>
    </section>


    <div class="container">
        <section class='d-flex py-5 reviews__wrapper'>
            <?php
            $query_arg = array(
                'post_type' => 'reviews',
                'posts_per_page' => 12,
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'reviews_categories',
                        'field'    => 'slug',
                        'terms'    => 'clients',
                    ),
                ),
            );
            $the_query = new WP_Query($query_arg);
            if ($the_query->have_posts()) :
                $num_chunks = 2;

                // Initialize an array to store posts in different chunks
                $post_chunks = array_fill(0, $num_chunks, []);

                // Loop through posts and distribute them into different chunks
                $chunk_index = 0;
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    $post_chunks[$chunk_index][] = get_post(); // Store the whole post object
                    $chunk_index = ($chunk_index + 1) % $num_chunks;
                }

                // Render posts in different sections
                for ($i = 0; $i < $num_chunks; $i++) :
                    ?>
                        <div class="reviews__posts d-flex flex-column">
                            <?php foreach ($post_chunks[$i] as $post) : setup_postdata($post); ?>
                                <?php get_template_part('parts/loop', 'reviews'); // Post item ?>
                            <?php endforeach; ?>
                        </div>
                <?php endfor;
                wp_reset_postdata();
                ?>
            <?php endif; ?>
        </section>
    </div>
</main>

<?php get_footer(); ?>

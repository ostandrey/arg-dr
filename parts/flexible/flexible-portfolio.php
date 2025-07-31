<?php
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$title = get_sub_field('title');
$load_more_link = get_sub_field('load_more_link');
?>

<section class="container-fluid full-text <?= $module_class ?>" id="<?= $module_id ?>">
    <div class="container">
        <div class="row">
            <?php if ($title): ?>
                <h2><?php echo $title; ?></h2>
            <?php endif; ?>
            <div class="container">
                <section class='portfolio'>
                    <?php
                    $choose_portfolios = get_sub_field('choose_portfolios');
                    if ($choose_portfolios) :
                        ?>
                        <div class='portfolio__list'>
                            <?php foreach($choose_portfolios as $post) {
                                setup_postdata($post)
                                ?>
                                <?php get_template_part('parts/loop', 'portfolio'); // Post item
                                ?>
                            <?php
                            wp_reset_postdata();
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </section>
            </div>
            <?php
            if ($load_more_link):
                $link_url = $load_more_link['url'];
                $link_title = $load_more_link['title'];
                $link_target = $load_more_link['target'] ? $load_more_link['target'] : '_self';
                ?>
                <div class="col-12 d-flex justify-content-center py-5">
                    <a class="btn button--blue" href="#" type="button" id="load-more-btn"><?php echo esc_html($link_title); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</section>


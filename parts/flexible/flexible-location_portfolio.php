<?php
$module_id = get_sub_field('module_id');
$module_class = get_sub_field('module_class');
$title = get_sub_field('title');
$portfolios = get_sub_field('portfolio');
$form_title = get_sub_field('form_title');
$contact_form = get_sub_field('form');
$background_image = get_sub_field('background_image');
?>

<section class="container-fluid <?= $module_class ?>" <?php bg($background_image, 'full_hd'); ?> id="<?= $module_id ?>">
    <div class="container location-container">
        <div class="row">
            <?php if ($title): ?>
                <h2><?php echo $title; ?></h2>
            <?php endif; ?>
            <div class="container">
                <section class='location-portfolio__list pt-5'>
                    <?php if (is_array($portfolios)): ?>
                        <?php foreach ($portfolios as $post):
                            setup_postdata($post);
//                            $permalink = get_permalink($portfolio->ID);
//                            $spec_title = get_the_title($portfolio->ID);
//                            $image = get_the_post_thumbnail($portfolio->ID);
                            ?>
                            <div class="location-portfolio__item">
                                <div class="location-portfolio__image">
                                    <?php the_post_thumbnail('full'); ?>
                                </div>
                                <h4><?php the_title(); ?></h4>
                                <div class="hero__overlay"></div>
                                <?php if (get_field('individual_page')) { ?>
                                    <?php $individual_page_url = get_field('individual_page_url'); ?>
                                    <a href="<?php echo $individual_page_url; ?>" class="location-portfolio__link"></a>
                                <?php } else {
                                    $thumbnail_id = get_post_thumbnail_id();
                                    $thumbnail_url = wp_get_attachment_url($thumbnail_id);
                                    ?>
                                    <a class="location-portfolio__link" href="<?php echo $thumbnail_url;?>" data-fancybox="portfolio__gallery">
                                    </a>
                                <?php } ?>
                            </div>
                        <?php
                        wp_reset_postdata();
                        endforeach; ?>
                    <?php endif; ?>
                </section>
            </div>
        </div>

        <?php if (is_array($contact_form)): ?>
            <div class="pt-5 form__wrapper">
                <?php echo $form_title; ?>
                <div class="py-5 location-hero__form location-hero__form--blue">
                    <?php echo do_shortcode("[gravityform id='{$contact_form['id']}' title='false' description='false' ajax='true']"); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>


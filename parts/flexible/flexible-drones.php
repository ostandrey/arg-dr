<?php
$tag      = get_sub_field('section_tag');
$title    = get_sub_field('section_title');
$section_button = get_sub_field('section_button');
$drones = get_sub_field('drones_slider');

if ($drones && is_array($drones) && !empty($drones)):
    ?>
    <section class="drones-slider-section">
        <div class="container">
            <div class="drones-slider-section__header">
                <div class="drones-slider-section__text">
                    <?php if ($tag): ?>
                        <div class="drones-slider-section__tag"><?php echo esc_html($tag); ?></div>
                    <?php endif; ?>
                    <?php if ($title): ?>
                        <h3 class="drones-slider-section__title"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>
                </div>
                <?php if ($section_button && is_array($section_button) && !empty($section_button['url'])): ?>
                    <a href="<?php echo esc_url($section_button['url']); ?>"
                       class="btn btn--green"
                        <?php if (!empty($section_button['target'])) echo 'target="_blank" rel="noopener"'; ?>>
                        <?php echo esc_html($section_button['title']); ?>
                    </a>
                <?php endif; ?>
            </div>

            <div class="drones-slider">
                <?php foreach ($drones as $post):
                    setup_postdata($post);

                    $sizes = get_the_terms(get_the_ID(), 'drone_size');
                    $task_types = get_the_terms(get_the_ID(), 'drone_task_type');

                    $all_terms = array();

                    if ($sizes && !is_wp_error($sizes)) {
                        foreach ($sizes as $size) {
                            if ($size->name === "7" && $size->parent !== 0) {
                                continue;
                            }
                            $all_terms[] = $size;
                        }
                    }

                    if ($task_types && !is_wp_error($task_types)) {
                        foreach ($task_types as $task_type) {
                            if ($task_type->name === "7" && $task_type->parent !== 0) {
                                continue;
                            }
                            $all_terms[] = $task_type;
                        }
                    }
                    ?>
                    <div>
                        <div class="drone-card">
                            <div class="drone-card__img">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('full_hd');
                                } else {
                                    echo '<img src="' . get_template_directory_uri() . '/assets/images/placeholder.jpg" alt="Placeholder">';
                                }
                                ?>
                            </div>
                            <div class="drone-card__title"><?php the_title(); ?></div>
                            <?php if (!empty($all_terms)): ?>
                                <div class="drone-card__tags">
                                    <?php
                                    $count = 0;
                                    foreach ($all_terms as $term):
                                        if ($count < 5):
                                            ?>
                                            <span class="drone-tag"><?php echo esc_html($term->name); ?></span>
                                        <?php
                                        endif;
                                        $count++;
                                    endforeach;

                                    if (count($all_terms) > 5):
                                        ?>
                                        <span class="drone-more">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="drone-card__link">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.63605 18.364L18.364 5.63603M18.364 5.63603H10.4179M18.364 5.63603V13.5821" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
            <div class="drones-slider-section__slider-nav">
                <button class="drones-slider-prev" type="button" aria-label="Prev"></button>
                <button class="drones-slider-next" type="button" aria-label="Next"></button>
            </div>
        </div>
    </section>
<?php endif; ?>
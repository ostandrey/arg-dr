<?php
$tag      = get_field('drones_tag');
$title    = get_field('drones_title');
$section_button = get_field('section_button');
$drones   = get_field('drones_slider');

if ($drones):
    ?>
    <section class="drones-section">
        <div class="container">
            <div class="drones-section__header">
                <?php if ($tag): ?>
                    <div class="drones-section__tag"><?php echo esc_html($tag); ?></div>
                <?php endif; ?>
                <?php if ($title): ?>
                    <h2 class="drones-section__title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if ($section_button): ?>
                    <a href="<?php echo esc_url($section_button['url']); ?>"
                       class="btn btn--green"
                        <?php if ($section_button['target']) echo 'target="_blank" rel="noopener"'; ?>>
                        <?php echo esc_html($section_button['title']); ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="drones-section__slider-nav">
                <button class="drones-slider-prev" type="button" aria-label="Назад"></button>
                <button class="drones-slider-next" type="button" aria-label="Вперёд"></button>
            </div>
            <div class="drones-slider">
                <?php foreach ($drones as $post): setup_postdata($post);
                    $tags = get_the_terms(get_the_ID(), 'drone_tag');
                    ?>
                    <a href="<?php the_permalink(); ?>" class="drone-card">
                        <div class="drone-card__img">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                        <div class="drone-card__title"><?php the_title(); ?></div>
                        <?php if ($tags): ?>
                            <div class="drone-card__tags">
                                <?php foreach ($tags as $tag): ?>
                                    <span class="drone-tag"><?php echo esc_html($tag->name); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
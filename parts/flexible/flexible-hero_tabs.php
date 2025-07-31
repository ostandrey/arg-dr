<?php
$tabs = get_sub_field('tabs');
?>
<section class="hero hero--tabs">
    <div class="container">
        <?php if ($title = get_sub_field('hero_title')): ?>
            <h1 class="hero__title mb-5"><?php echo esc_html($title); ?></h1>
        <?php endif; ?>

        <?php if ($tabs): ?>
            <div class="hero__content">
                <div class="hero__text-tabs">
                    <div class="tab-content" id="hero-tab-content">
                        <?php foreach ($tabs as $i => $tab): ?>
                            <div class="tab-pane fade <?php if ($i == 0) echo 'show active'; ?>"
                                 id="hero-tab-pane-<?php echo $i; ?>"
                                 role="tabpanel"
                                 aria-labelledby="hero-tab-<?php echo $i; ?>">
                                <div class="hero__tag-text">
                                    <?php if ($tab['tab_tag']): ?>
                                        <div class="hero__tag">
                                            <span><?php echo esc_html($tab['tab_tag']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($tab['tab_description']): ?>
                                        <div class="hero__desc">
                                            <?php echo wp_kses_post($tab['tab_description']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <nav class="hero__tabs">
                        <div class="nav hero__nav-tabs" id="hero-tab" role="tablist">
                            <?php foreach ($tabs as $i => $tab): ?>
                                <a class="hero__tab <?php if ($i == 0) echo 'active'; ?>"
                                   id="hero-tab-<?php echo $i; ?>"
                                   data-toggle="tab"
                                   data-tab-index="<?php echo $i; ?>"
                                   href="#hero-tab-pane-<?php echo $i; ?>"
                                   role="tab"
                                   aria-controls="hero-tab-pane-<?php echo $i; ?>"
                                   aria-selected="<?php echo $i == 0 ? 'true' : 'false'; ?>">
                                    <?php echo esc_html($tab['tab_title']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </nav>
                </div>

                <div class="hero__img-container">
                    <?php foreach ($tabs as $i => $tab): ?>
                        <?php if ($tab['tab_image']): ?>
                            <div class="hero__img tab-image <?php if ($i == 0) echo 'active'; ?>" data-tab-img="<?php echo $i; ?>">
                                <?php echo wp_get_attachment_image($tab['tab_image']['ID'], 'full'); ?>
                                <?php if ($tab['tab_link']): ?>
                                    <a href="<?php echo esc_url($tab['tab_link']['url']); ?>"
                                       class="hero__img-button"
                                        <?php if ($tab['tab_link']['target']) echo 'target="' . esc_attr($tab['tab_link']['target']) . '"'; ?>>
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.7109 37.2891L37.2891 10.7109M37.2891 10.7109H20.8359M37.2891 10.7109V27.1641" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
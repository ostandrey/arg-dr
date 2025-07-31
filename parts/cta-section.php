<?php
/**
 * Global CTA Section Template Part
 */

$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';

if ($current_lang === 'en') {
    $title = get_option('options_cta_title_en') ?: get_option('options_cta_title');
    $subtitle_1 = get_option('options_cta_subtitle_1_en') ?: get_option('options_cta_subtitle_1');
    $subtitle_2 = get_option('options_cta_subtitle_2_en') ?: get_option('options_cta_subtitle_2');

    $button_data = get_option('options_cta_button_en') ?: get_option('options_cta_button');
    $button = $button_data ? maybe_unserialize($button_data) : null;
} else {
    $title = get_option('options_cta_title');
    $subtitle_1 = get_option('options_cta_subtitle_1');
    $subtitle_2 = get_option('options_cta_subtitle_2');
    $button = maybe_unserialize(get_option('options_cta_button'));
}

if (empty($title) && empty($button)) {
    return;
}
?>

<section class="cta">
    <div class="container">
        <div class="cta__content">
            <div class="cta__text">
                <?php if ($subtitle_1 || $subtitle_2): ?>
                    <div class="cta__subtitles">
                        <?php if ($subtitle_1): ?>
                            <div class="cta__subtitle"><?php echo esc_html($subtitle_1); ?></div>
                        <?php endif; ?>

                        <?php if ($subtitle_2): ?>
                            <div class="cta__subtitle"><?php echo esc_html($subtitle_2); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($title): ?>
                    <h3 class="cta__title"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>
            </div>

            <?php if ($button && is_array($button)): ?>
                <a href="<?php echo esc_url($button['url']); ?>"
                   target="<?php echo esc_attr($button['target'] ?: '_self'); ?>"
                   class="cta__button">
                    <?php echo esc_html($button['title']); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
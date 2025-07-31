<?php
/**
 * Contact Form Template Part
 */

$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';

if ($current_lang === 'en') {
    $title = get_option('options_contact_form_title_en') ?: get_option('options_contact_form_title');
    $form_data = get_option('options_contact_form_en') ?: get_option('options_contact_form');
} else {
    $title = get_option('options_contact_form_title');
    $form_data = get_option('options_contact_form');
}

$form = $form_data ? maybe_unserialize($form_data) : null;


?>

<section class="form-section" id="contact-form" data-lang="<?php echo esc_attr($current_lang); ?>">
    <div class="container">
        <div class="form-section__content">
            <?php if ($title): ?>
                <h2 class="form-section__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <div id="form-messages" class="form-messages" style="display: none;"></div>

            <div class="form-section__form">
                <?php
                if ($form && function_exists('gravity_form')) {
                    $form_id = is_array($form) || is_object($form) ? $form['id'] : $form;
                    gravity_form($form_id, false, false, false, '', false, 1);
                } else {
                    echo '<p>' . ($current_lang === 'en' ? 'The form is not found.' : 'Форма не знайдена.') . '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</section>
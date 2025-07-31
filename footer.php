<?php
/**
 * Footer
 */

$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'uk';

if ($current_lang === 'en') {
    global $wpdb;

    $copyright = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_copyright_en'") ?: 'Created by Arctic Web';
    $footer_navigation_title = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_navigation_title_en'") ?: 'Navigation';
    $footer_contacts_title = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_contacts_title_en'") ?: 'Contacts';
    $footer_email = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_email_en'");
    $footer_phone = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_phone_en'");
    $footer_phone_link = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_phone_link_en'");

    $footer_logo_id = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_logo_en'");
    $footer_logo = null;
    if ($footer_logo_id) {
        $footer_logo = array(
            'url' => wp_get_attachment_url($footer_logo_id),
            'alt' => get_post_meta($footer_logo_id, '_wp_attachment_image_alt', true),
            'width' => wp_get_attachment_metadata($footer_logo_id)['width'] ?? '',
            'height' => wp_get_attachment_metadata($footer_logo_id)['height'] ?? ''
        );
    }

    if (!$footer_email) $footer_email = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_email'");
    if (!$footer_phone) $footer_phone = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_phone'");
    if (!$footer_phone_link) $footer_phone_link = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_phone_link'");
    if (!$footer_logo) {
        $footer_logo_id = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_logo'");
        if ($footer_logo_id) {
            $footer_logo = array(
                'url' => wp_get_attachment_url($footer_logo_id),
                'alt' => get_post_meta($footer_logo_id, '_wp_attachment_image_alt', true),
                'width' => wp_get_attachment_metadata($footer_logo_id)['width'] ?? '',
                'height' => wp_get_attachment_metadata($footer_logo_id)['height'] ?? ''
            );
        }
    }

    $social_networks = array();
    $social_count = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_social_en'");

    if ($social_count && is_numeric($social_count) && $social_count > 0) {
        for ($i = 0; $i < $social_count; $i++) {
            $platform = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM {$wpdb->options} WHERE option_name = %s", "options_footer_social_en_{$i}_social_platform"));
            $serialized_social_link = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM {$wpdb->options} WHERE option_name = %s", "options_footer_social_en_{$i}_social_link"));
            $social_icon_id = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM {$wpdb->options} WHERE option_name = %s", "options_footer_social_en_{$i}_social_icon"));

            $social_url = null;
            $social_title = null;
            $social_target = null;

            if ($serialized_social_link) {
                $link_data = maybe_unserialize($serialized_social_link);
                if (is_array($link_data)) {
                    $social_url = $link_data['url'] ?? null;
                    $social_title = $link_data['title'] ?? null;
                    $social_target = $link_data['target'] ?? null;
                }
            }

            if ($social_url) {
                $icon_data = null;
                if ($social_icon_id) {
                    $icon_data = array(
                        'url' => wp_get_attachment_url($social_icon_id),
                        'alt' => get_post_meta($social_icon_id, '_wp_attachment_image_alt', true) ?: ucfirst($platform)
                    );
                }

                $social_networks[] = array(
                    'platform' => $platform,
                    'url' => $social_url,
                    'title' => $social_title ?: $platform,
                    'target' => $social_target ?: '_blank',
                    'icon' => $icon_data
                );
            }
        }
    }

    if (empty($social_networks)) {
        if (have_rows('footer_social', 'options')) {
            while (have_rows('footer_social', 'options')) {
                the_row();
                $platform = get_sub_field('social_platform');
                $social_link = get_sub_field('social_link');
                $social_icon = get_sub_field('social_icon');

                if ($social_link) {
                    $social_networks[] = array(
                        'platform' => $platform,
                        'url' => $social_link['url'],
                        'title' => $social_link['title'],
                        'target' => $social_link['target'] ?: '_blank',
                        'icon' => $social_icon
                    );
                }
            }
        }
    }

    $bottom_links = array();
    $links_count = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'options_footer_bottom_links_en'");

    if ($links_count && is_numeric($links_count) && $links_count > 0) {
        for ($i = 0; $i < $links_count; $i++) {
            $serialized_link = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM {$wpdb->options} WHERE option_name = %s", "options_footer_bottom_links_en_{$i}_bottom_link_en"));

            if ($serialized_link) {
                $link_data = maybe_unserialize($serialized_link);

                if (is_array($link_data) && !empty($link_data['url'])) {
                    $bottom_links[] = array(
                        'url' => $link_data['url'],
                        'title' => $link_data['title'] ?: 'Link',
                        'target' => $link_data['target'] ?: '_self'
                    );
                }
            }
        }
    }

    if (empty($bottom_links)) {
        if (have_rows('footer_bottom_links', 'options')) {
            while (have_rows('footer_bottom_links', 'options')) {
                the_row();
                $bottom_link = get_sub_field('bottom_link');

                if ($bottom_link) {
                    $bottom_links[] = array(
                        'url' => $bottom_link['url'],
                        'title' => $bottom_link['title'],
                        'target' => $bottom_link['target'] ?: '_self'
                    );
                }
            }
        }
    }

} else {
    $copyright = get_field('copyright', 'options') ?: '© 2024 Arctic Web. Всі права захищені.';
    $footer_navigation_title = get_field('footer_navigation_title', 'options') ?: 'Навігація';
    $footer_contacts_title = get_field('footer_contacts_title', 'options') ?: 'Контакти';
    $footer_logo = get_field('footer_logo', 'options');
    $footer_email = get_field('footer_email', 'options');
    $footer_phone = get_field('footer_phone', 'options');
    $footer_phone_link = get_field('footer_phone_link', 'options');

    $social_networks = array();
    if (have_rows('footer_social', 'options')) {
        while (have_rows('footer_social', 'options')) {
            the_row();
            $platform = get_sub_field('social_platform');
            $social_link = get_sub_field('social_link');
            $social_icon = get_sub_field('social_icon');

            if ($social_link) {
                $social_networks[] = array(
                    'platform' => $platform,
                    'url' => $social_link['url'],
                    'title' => $social_link['title'],
                    'target' => $social_link['target'] ?: '_blank',
                    'icon' => $social_icon
                );
            }
        }
    }

    $bottom_links = array();
    if (have_rows('footer_bottom_links', 'options')) {
        while (have_rows('footer_bottom_links', 'options')) {
            the_row();
            $bottom_link = get_sub_field('bottom_link');

            if ($bottom_link) {
                $bottom_links[] = array(
                    'url' => $bottom_link['url'],
                    'title' => $bottom_link['title'],
                    'target' => $bottom_link['target'] ?: '_self'
                );
            }
        }
    }
}

?>

<footer class="footer">
    <div class="container">
        <div class="footer__main">
            <div class="footer__logo">
                <a href="<?php echo esc_url(function_exists('pll_home_url') ? pll_home_url() : home_url()); ?>">
                    <?php if ($footer_logo && isset($footer_logo['url'])): ?>
                        <img src="<?php echo esc_url($footer_logo['url']); ?>"
                             alt="<?php echo esc_attr($footer_logo['alt'] ?: get_bloginfo('name')); ?>"
                             <?php if ($footer_logo['width']): ?>width="<?php echo esc_attr($footer_logo['width']); ?>"<?php endif; ?>
                             <?php if ($footer_logo['height']): ?>height="<?php echo esc_attr($footer_logo['height']); ?>"<?php endif; ?>>
                    <?php else: ?>
                        <?php show_custom_logo(); ?>
                    <?php endif; ?>
                </a>
            </div>

            <nav class="footer__nav">
                <h3 class="footer__title"><?php echo esc_html($footer_navigation_title); ?></h3>
                <?php
                if (has_nav_menu('footer-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'menu_class' => 'footer__menu',
                        'depth' => 1
                    ));
                }
                ?>
            </nav>

            <div class="footer__contacts">
                <h3 class="footer__title"><?php echo esc_html($footer_contacts_title); ?></h3>
                <ul class="footer__contact-list">
                    <?php if ($footer_email): ?>
                        <li class="footer__contact-item">
                            <a href="mailto:<?php echo esc_attr($footer_email); ?>"
                               class="footer__contact-link"><?php echo esc_html($footer_email); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if ($footer_phone): ?>
                        <li class="footer__contact-item">
                            <a href="tel:<?php echo esc_attr($footer_phone_link ?: $footer_phone); ?>"
                               class="footer__contact-link"><?php echo esc_html($footer_phone); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if (!empty($social_networks)): ?>
                    <div class="footer__social">
                        <?php foreach ($social_networks as $social): ?>
                            <a href="<?php echo esc_url($social['url']); ?>"
                               class="footer__social-link"
                               target="<?php echo esc_attr($social['target'] ?? '_blank'); ?>"
                               aria-label="<?php echo esc_attr($social['title'] ?: ucfirst($social['platform'])); ?>">
                                <?php if (isset($social['icon']) && $social['icon'] && isset($social['icon']['url'])): ?>
                                    <img src="<?php echo esc_url($social['icon']['url']); ?>"
                                         alt="<?php echo esc_attr($social['icon']['alt'] ?: ucfirst($social['platform'])); ?>"
                                         class="footer__social-icon"
                                         width="24" height="24">
                                <?php else: ?>
                                    <span><?php echo esc_html(ucfirst($social['platform'])); ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($bottom_links)): ?>
            <div class="footer__bottom">
                <div class="footer__links">
                    <?php foreach ($bottom_links as $link): ?>
                        <a href="<?php echo esc_url($link['url']); ?>"
                           class="footer__bottom-link"
                           target="<?php echo esc_attr($link['target'] ?? '_self'); ?>">
                            <?php echo esc_html($link['title']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($copyright): ?>
            <div class="footer-copy">
                <?php echo wp_kses_post($copyright); ?>
            </div>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>
<?php if ($ada_script = get_field('ada', 'options')): ?>
    <?php echo $ada_script; ?>
<?php endif; ?>
</body>
</html>
<?php
/**
 * Header
 */

$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';

$phone = get_option('options_phone');

if ($current_lang === 'en') {
    $header_button_data = get_option('options_header_button_en') ?: get_option('options_header_button');
} else {
    $header_button_data = get_option('options_header_button');
}

$header_button = $header_button_data ? maybe_unserialize($header_button_data) : null;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <meta name="format-detection" content="telephone=no,email=no,url=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class('no-outline'); ?>>
<?php wp_body_open(); ?>

<header class="header" id="header">
    <div class="container">
        <div class="header__inner d-flex align-items-center justify-content-between">
            <?php show_custom_logo(); ?>

            <nav class="header__nav d-none d-lg-block">
                <?php
                if (has_nav_menu('header-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'header-menu',
                        'menu_class' => 'header__menu list-unstyled d-flex mb-0',
                        'container' => false,
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'walker' => new Bootstrap_Navigation(),
                    ));
                }
                ?>
            </nav>

            <div class="header__actions d-flex align-items-center">
                <div class="header__lang ml-3 d-none d-lg-block">
                    <button class="lang-trigger" id="langTrigger">
                        <?php
                        if (function_exists('pll_current_language')) {
                            echo strtoupper(pll_current_language('slug'));
                        } else {
                            echo 'UA';
                        }
                        ?>
                    </button>

                    <div class="lang-modal" id="langModal">
                        <?php if (function_exists('pll_the_languages')) {
                            $languages = pll_the_languages(array(
                                'raw' => 1,
                                'hide_if_no_translation' => 0
                            ));

                            foreach ($languages as $lang) {
                                $class = $lang['current_lang'] ? 'current' : '';
                                $tooltip = '';

                                echo '<a href="' . esc_url($lang['url']) . '" 
                                         class="lang-option ' . $class . '" 
                                         >' .
                                    strtoupper($lang['slug']) . '</a>';
                            }
                        } else {
                            echo '<a href="#" class="lang-option current" data-tooltip="перейти на Українську">UA</a>';
                            echo '<a href="#" class="lang-option" data-tooltip="switch to English">EN</a>';
                        } ?>
                    </div>
                </div>

                <?php if ($header_button && is_array($header_button)): ?>
                    <a href="<?php echo esc_url($header_button['url']); ?>"
                       class="header__button button d-none d-lg-inline-flex ml-3"
                        <?php if (!empty($header_button['target'])) echo 'target="' . esc_attr($header_button['target']) . '"'; ?>>
                        <?php echo esc_html($header_button['title']); ?>
                    </a>
                <?php endif; ?>

                <button class="header__burger d-lg-none ml-3" type="button" id="mobileMenuToggle">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>

        <div class="header__mobile d-lg-none" id="mobileMenu">
            <div class="header__mobile-inner">
                <nav class="header__mobile-nav">
                    <?php
                    if (has_nav_menu('header-menu')) {
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'menu_class' => 'header__mobile-menu list-unstyled',
                            'container' => false,
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker' => new Bootstrap_Navigation(),
                        ));
                    }
                    ?>
                </nav>

                <div class="header__mobile-actions">
                    <div class="header__mobile-lang mb-3">
                        <?php if (function_exists('pll_the_languages')) {
                            $languages = pll_the_languages(array(
                                'raw' => 1,
                                'hide_if_no_translation' => 0
                            ));

                            echo '<div class="mobile-lang-options d-flex justify-content-center gap-3">';
                            foreach ($languages as $lang) {
                                $class = $lang['current_lang'] ? 'current' : '';
                                echo '<a href="' . esc_url($lang['url']) . '" 
                                         class="mobile-lang-option ' . $class . '">' .
                                    strtoupper($lang['slug']) . '</a>';
                            }
                            echo '</div>';
                        } else {
                            echo '<div class="mobile-lang-options d-flex justify-content-center gap-3">';
                            echo '<a href="#" class="mobile-lang-option current">UA</a>';
                            echo '<a href="#" class="mobile-lang-option">EN</a>';
                            echo '</div>';
                        } ?>
                    </div>

                    <?php if ($header_button && is_array($header_button)): ?>
                        <a href="<?php echo esc_url($header_button['url']); ?>"
                           class="header__button button w-100"
                            <?php if (!empty($header_button['target'])) echo 'target="' . esc_attr($header_button['target']) . '"'; ?>>
                            <?php echo esc_html($header_button['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
<?php

/**
 * Example shortcode
 * [example_shortcode foo=bar]
 *
 * @param $atts array Shortcode attributes
 *
 * @return string
 */


add_shortcode(
    'listmenu', function( $atts, $content = null ) {
    require_once( 'class-evo-menu-walker.php' );

    $atts = array_change_key_case( (array) $atts, CASE_LOWER );

    $listmenu_atts = shortcode_atts(
        [
            'after' => '',
            'before' => '',
            'container' => 'div',
            'container_class' => '',
            'container_id' => '',
            'depth' => 0,
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'link_after' => '',
            'link_before' => '',
            'menu' => '',
            'menu_class' => 'menu',
            'menu_id' => '',
            'theme_location' => '',
            'walker' => new Evo_Menu_Walker(),
        ], $atts
    );

    return wp_nav_menu(
        array(
            'after' => $listmenu_atts['after'],
            'before' => $listmenu_atts['before'],
            'container' => $listmenu_atts['container'],
            'container_class' => $listmenu_atts['container_class'],
            'container_id' => $listmenu_atts['container_id'],
            'depth' => $listmenu_atts['depth'],
            'echo' => false,
            'fallback_cb' => $listmenu_atts['fallback_cb'],
            'link_after' => $listmenu_atts['link_after'],
            'link_before' => $listmenu_atts['link_before'],
            'menu' => $listmenu_atts['menu'],
            'menu_class' => $listmenu_atts['menu_class'],
            'menu_id' => $listmenu_atts['menu_id'],
            'theme_location' => $listmenu_atts['theme_location'],
            'walker' => $listmenu_atts['walker'],
        )
    );
}
);
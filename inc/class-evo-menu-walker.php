<?php
/**
 * Evo Menu Walker
 *
 * @package WordPress
 * @subpackage Evolution
 * @since 3.0.0
 */

/**
 * Class Name: Evo_Menu_Walker
 *
 * A custom WordPress nav menu walker to implement custom styles.
 */

/* Check if Class Exists. */
if ( ! class_exists( 'Evo_Menu_Walker' ) ) {
    /**
     * Evo_Menu_Walker class.
     *
     * @extends Walker_Nav_Menu
     */
    class Evo_Menu_Walker extends Walker_Nav_Menu {
        /**
         * Start El.
         *
         * @access public
         * @param mixed $output Passed by reference. Used to append additional content.
         * @param mixed $item Menu item data object.
         * @param int   $depth (default: 0) Depth of menu item. Used for padding.
         * @param array $args (default: array()) Arguments.
         * @param int   $id (default: 0) Menu item ID.
         * @return void
         */
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $value = '';

            $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . '>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
            $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
            $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= '<span class="title">' . $args->link_before . apply_filters( 'the_title',$item->title,$item->ID ) . '</span></a>' . $args->link_after;

            if ( $item->description ) {
                $item_output .= '<span class="sub"> - ' . $item->description . '</span></a>';
            }

            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }
}
<?php
/**
 * Functions
 */

/******************************************************************************
 * Included Functions
 ******************************************************************************/

// Helpers function
require_once get_stylesheet_directory() . '/inc/helpers.php';
// Install Recommended plugins
require_once get_stylesheet_directory() . '/inc/recommended-plugins.php';
// Walker modification
require_once get_stylesheet_directory() . '/inc/class-bootstrap-navigation.php';
// Home slider function
include_once get_stylesheet_directory() . '/inc/home-slider.php';
// Dynamic admin
include_once get_stylesheet_directory() . '/inc/class-dynamic-admin.php';
// SVG Support
include_once get_stylesheet_directory() . '/inc/svg-support.php';
// Lazy Load
include_once get_stylesheet_directory() . '/inc/class-lazyload.php';
// Extend WP Search with Custom fields
include_once get_stylesheet_directory() . '/inc/custom-fields-search.php';
// WooCommerce functionality
//include_once get_stylesheet_directory() . '/inc/woo-custom.php';
// Include all additional shortcodes
include_once get_stylesheet_directory() . '/inc/shortcodes.php';

// Register ACF Gravity Forms field
add_action('init', function () {
    if (class_exists('ACF')) {
        require_once 'inc/class-fxy-acf-field-gf-field-v5.php';
    }
});

// Constants
define( 'IMAGE_PLACEHOLDER', get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg' );

/******************************************************************************
 * Global Functions
 ******************************************************************************/

/**
 * Prevent Fatal error on site if ACF not installed/activated
 */
function include_acf_placeholder() {
	include_once get_stylesheet_directory() . '/inc/acf-placeholder.php';
}

add_action( 'wp', 'include_acf_placeholder', PHP_INT_MAX );

/**
 * WP 5.2 wp_body_open backward compatibility
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

// By adding theme support, we declare that this theme does not use a
// hard-coded <title> tag in the document head, and expect WordPress to
// provide it for us.
add_theme_support( 'title-tag' );

//  Add widget support shortcodes
add_filter( 'widget_text', 'do_shortcode' );

// Support for Featured Images
add_theme_support( 'post-thumbnails' );

// Custom Background
add_theme_support( 'custom-background', array( 'default-color' => 'fff' ) );

// Custom Header
add_theme_support( 'custom-header', array(
	'default-image' => get_template_directory_uri() . '/images/custom-logo.png',
	'height'        => '200',
	'flex-height'   => true,
	'uploads'       => true,
	'header-text'   => false
) );

// Custom Logo
add_theme_support( 'custom-logo', array(
	'height'      => '150',
	'flex-height' => true,
	'flex-width'  => true,
) );

//function show_custom_logo( $size = 'medium' ) {
//	if ( $custom_logo_id = get_theme_mod( 'custom_logo' ) ) {
//		$logo_image = wp_get_attachment_image( $custom_logo_id, $size, false, array(
//			'class'    => 'custom-logo',
//			'itemprop' => 'siteLogo',
//			'alt'      => get_bloginfo( 'name' ),
//		) );
//	} else {
//		$logo_url = get_stylesheet_directory_uri() . '/assets/images/custom-logo.png';
//		$w        = 200;
//		$h        = 160;
//		$logo_image = '<img src="' . $logo_url . '" width="' . $w . '" height="' . $h . '" class="custom-logo" itemprop="siteLogo" alt="' . get_bloginfo( 'name' ) . '">';
//	}
//
//	$html       = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" title="%2$s" itemscope>%3$s</a>', esc_url( home_url( '/' ) ), get_bloginfo( 'name' ), $logo_image );
//	echo apply_filters( 'get_custom_logo', $html );
//}
function show_custom_logo($size = 'medium')
{
    if ($custom_logo__url = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')) {
        $logo_image = return_svg($custom_logo__url[0], 'custom-logo', $size);
    } else {
        $logo_url = get_stylesheet_directory_uri() . '/assets/images/custom-logo.png';
        $w        = 200;
        $h        = 160;
        $logo_image = '<img src="' . $logo_url . '" width="' . $w . '" height="' . $h . '" class="custom-logo" itemprop="siteLogo" alt="' . get_bloginfo('name') . '">';
    }

    $html = sprintf('<a href="%1$s" class="custom-logo-link" rel="home" title="%2$s" itemscope>%3$s</a>', esc_url(home_url('/')), get_bloginfo('name'), $logo_image);
    echo apply_filters('get_custom_logo', $html);
}

// Add HTML5 elements
add_theme_support( 'html5', array(
	'comment-list',
	'search-form',
	'comment-form',
	'gallery',
	'caption',
	'script',
	'style'
) );

// Add RSS Links generation
add_theme_support( 'automatic-feed-links' );
// Hide comments feed link
add_filter( 'feed_links_show_comments_feed', '__return_false' );

// Add excerpt to pages
add_post_type_support( 'page', 'excerpt' );

function custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

// Register Navigation Menu
register_nav_menus( array(
	'header-menu' => 'Header Menu',
	'footer-menu' => 'Footer Menu'
) );

// Create pagination
/**
 * Bootstrap Pagination with Polylang support
 */
function bootstrap_pagination($query = '') {
    if (empty($query)) {
        global $wp_query;
        $query = $wp_query;
    }

    $big = 999999999;

    $prev_text = function_exists('pll__') ? pll__('Назад') : __('Назад', 'default');
    $next_text = function_exists('pll__') ? pll__('Вперед') : __('Вперед', 'default');

    $links = paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'prev_next' => true,
        'prev_text' => '<div class="blog-pagination__arrow blog-pagination__arrow--prev"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span>' . $prev_text . '</span>',
        'next_text' => '<span>' . $next_text . '</span><div class="blog-pagination__arrow blog-pagination__arrow--next"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $query->max_num_pages,
        'type'      => 'list',
        'end_size'  => 1,
        'mid_size'  => 1,
    ));

    $pagination = str_replace('page-numbers', 'page-numbers', $links);
    $pagination = str_replace('<ul class="page-numbers">', '<div class="blog-pagination"><ul class="page-numbers">', $pagination);
    $pagination = str_replace('</ul>', '</ul></div>', $pagination);
    $pagination = str_replace('current', 'current', $pagination);

    echo $pagination;
}

// Register Sidebars
function bootstrap_widgets_init() {
	/* Sidebar Right */
	register_sidebar( array(
		'id'            => 'bootstrap_sidebar_right',
		'name'          => __( 'Sidebar Right' ),
		'description'   => __( 'This sidebar is located on the right-hand side of each page.' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget__title">',
		'after_title'   => '</h5>',
	) );

}

add_action( 'widgets_init', 'bootstrap_widgets_init' );

// Remove #more anchor from posts
function remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end - $offset );
	}

	return $link;
}

add_filter( 'the_content_more_link', 'remove_more_jump_link' );

// Remove more tag <span> anchor
function remove_more_anchor( $content ) {
	return str_replace( '<p><span id="more-' . get_the_ID() . '"></span></p>', '', $content );
}

add_filter( 'the_content', 'remove_more_anchor' );


/******************************************************************************************************************************
 * Enqueue Scripts and Styles for Front-End
 *******************************************************************************************************************************/

function bootstrap_scripts_and_styles() {
	if ( ! is_admin() ) {

		// Disable gutenberg built-in styles
		wp_dequeue_style( 'wp-block-library' );

		// Load Stylesheets
		//core
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', null, '4.3.1' );

		//system
		wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css', null, null );/*2rd priority*/
		wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', null, null );/*1st priority*/

		// Load JavaScripts
		//core
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap.min', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', null, '4.3.1', true );

		//plugins
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/plugins/slick.min.js', null, '1.8.1', true );
		wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/assets/js/plugins/lazyload.min.js', null, '12.4.0', true );
		wp_enqueue_script( 'matchHeight', get_template_directory_uri() . '/assets/js/plugins/jquery.matchHeight-min.js', null, '0.7.2', true );
//		wp_enqueue_script( 'fancybox.v2', get_template_directory_uri() . '/assets/js/plugins/jquery.fancybox.v2.js', null, '2.1.5', true );
		wp_enqueue_script( 'fancybox.v3', get_template_directory_uri() . '/assets/js/plugins/jquery.fancybox.v3.js', null, '3.5.2', true );
//		wp_enqueue_script( 'jarallax', get_template_directory_uri() . '/assets/js/plugins/jarallax.min.js', null, '1.12.0', true );

		//custom javascript
		wp_enqueue_script( 'global', get_template_directory_uri() . '/assets/js/global.js', null, null, true ); /* This should go first */
        wp_localize_script( 'global', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'drone_ajax_nonce' ) ) );
    }
}

add_action( 'wp_enqueue_scripts', 'bootstrap_scripts_and_styles' );

// Safe Performance Optimizations - Database and WordPress cleanup
function safe_performance_optimizations() {
    // Remove unnecessary WordPress features
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    
    // Remove unnecessary WordPress meta tags
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    
    // Remove wp-embed script (not needed for most sites)
    if (!is_admin()) {
        wp_dequeue_script('wp-embed');
        wp_deregister_script('wp-embed');
    }
}

add_action('init', 'safe_performance_optimizations');

// Optimize database queries
function optimize_database_settings() {
    // Limit post revisions to save database space
    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', 5);
    }
    
    // Optimize autosave interval
    if (!defined('AUTOSAVE_INTERVAL')) {
        define('AUTOSAVE_INTERVAL', 300); // 5 minutes
    }
}

add_action('init', 'optimize_database_settings');

// Safe Image Optimization - Add lazy loading and WebP support
function safe_image_optimization() {
    // Add lazy loading to images (native browser support)
    add_filter('wp_get_attachment_image_attributes', function($attr, $attachment, $size) {
        if (!is_admin()) {
            $attr['loading'] = 'lazy';
            $attr['decoding'] = 'async';
        }
        return $attr;
    }, 10, 3);
    
    // Add WebP support for supported browsers
    add_filter('wp_get_attachment_image_src', function($image, $attachment_id, $size, $icon) {
        if (is_array($image) && function_exists('imagewebp')) {
            $webp_path = str_replace(array('.jpg', '.jpeg', '.png'), '.webp', $image[0]);
            if (file_exists($webp_path)) {
                $image[0] = $webp_path;
            }
        }
        return $image;
    }, 10, 4);
}

add_action('init', 'safe_image_optimization');

// Safe Asset Optimization - Improve loading without breaking functionality
function safe_asset_optimization() {
    // Add preload for critical fonts
    add_action('wp_head', function() {
        echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/fonts/Unbounded-Regular.woff2" as="font" type="font/woff2" crossorigin>';
        echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/fonts/IBMPlexSans-Regular.woff2" as="font" type="font/woff2" crossorigin>';
    }, 1);
    
    // Add DNS prefetch for external resources
    add_action('wp_head', function() {
        echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">';
        echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">';
        echo '<link rel="dns-prefetch" href="//code.jquery.com">';
    }, 1);
    
    // Add resource hints for faster loading
    add_action('wp_head', function() {
        echo '<link rel="preconnect" href="' . get_template_directory_uri() . '">';
    }, 1);
}

add_action('init', 'safe_asset_optimization');

add_filter( 'acf/load_field/type=google_map', function ( $field ) {
	$google_map_api = 'https://maps.googleapis.com/maps/api/js';
	$api_args       = array(
		'key' => get_theme_mod( 'google_maps_api' ) ?: 'AIzaSyBgg23TIs_tBSpNQa8RC0b7fuV4SOVN840',
		'language' => 'en',
		'v' => '3.exp'
	);
	wp_enqueue_script( 'google.maps.api', add_query_arg( $api_args, $google_map_api ), null, null, true );

	return $field;
} );

/******************************************************************************
 * Additional Functions
 *******************************************************************************/

// Specify image sizes that need to be optimized
function specify_sizes_to_optimize( $sizes ) {
	if ( empty( $sizes ) || $sizes == 'thumbnail,medium' ) {
		$sizes = 'thumbnail,medium,medium_large,large,large_high,full_hd,1536x1536,2048x2048';
	}

	return $sizes;
}

add_filter( 'wbcr/factory/populate_option_allowed_sizes_thumbnail', 'specify_sizes_to_optimize' );

// Disable Robin Image optimizer backup
add_filter( 'wbcr/factory/populate_option_backup_origin_images', function () {
	return ! empty( get_option( 'wbcr_io_backup_origin_images' ) ) ? get_option( 'wbcr_io_backup_origin_images' ) : 0;
} );

// Disable Robin Image resize image
add_filter( 'wbcr/factory/populate_option_resize_larger', function () {
	return ! empty( get_option( 'wbcr_io_resize_larger' ) ) ? get_option( 'wbcr_io_resize_larger' ) : 0;
} );

// Enable revisions for all custom post types
add_filter( 'cptui_user_supports_params', function () {
	return array( 'revisions' );
} );

// Limit number of revisions for all post types
function limit_revisions_number() {
	return 10;
}

add_filter( 'wp_revisions_to_keep', 'limit_revisions_number');

// Add ability ro reply to comments
add_filter( 'wpseo_remove_reply_to_com', '__return_false' );

// Register Post Type Slider
function post_type_slider() {
	$post_type_slider_labels = array(
		'name'               => _x( 'Slider', 'post type general name', 'default' ),
		'singular_name'      => _x( 'Slide', 'post type singular name', 'default' ),
		'add_new'            => _x( 'Add New', 'slide', 'default' ),
		'add_new_item'       => __( 'Add New Slide', 'default' ),
		'edit_item'          => __( 'Edit Slide', 'default' ),
		'new_item'           => __( 'New Slide', 'default' ),
		'all_items'          => __( 'All Slides', 'default' ),
		'view_item'          => __( 'View Slide', 'default' ),
		'search_items'       => __( 'Search Slides', 'default' ),
		'not_found'          => __( 'No slides found.', 'default' ),
		'not_found_in_trash' => __( 'No slides found in Trash.', 'default' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Slider'
	);
	$post_type_slider_args   = array(
		'labels'        => $post_type_slider_labels,
		'description'   => 'Display Slider',
		'public'        => false,
		'show_ui'       => true,
		'menu_icon'     => 'dashicons-format-gallery',
		'menu_position' => 5,
		'supports'      => array(
			'title',
			'thumbnail',
			'page-attributes',
			'editor',
			'post-formats'
		),
		'has_archive'   => false,
		'hierarchical'  => true
	);
	register_post_type( 'slider', $post_type_slider_args );
	add_theme_support( 'post-formats', array( 'video' ) );
	remove_post_type_support( 'post', 'post-formats' );
}

add_action( 'init', 'post_type_slider' );

// Add Video background Metabox to slider post type
add_action( 'add_meta_boxes', 'slide_background_metabox' );

function slide_background_metabox() {
	$screens = array( 'slider' );
	add_meta_box( 'slide_background', __( 'Slide background', 'default' ), 'slider_background_callback', $screens );
}

function slider_background_callback( $post, $meta ) {
	wp_nonce_field( 'save_video_bg', 'project_nonce' );
	?>
	<style>
		.fields-list {
			margin-left: -12px;
			margin-right: -12px;
		}
		.fields-list::after {
			content: '';
			display: table;
			clear: both;
		}
		.field-wrap {
			float: left;
			padding-left: 12px;
			padding-right: 12px;
			box-sizing: border-box;
		}
	</style>
	<div class="fields-list">
		<div class="field-wrap" style="width: 70%">
			<p class="label-wrapper"><label for="slide_video" style="display: block;"><b><?php _e('Video background','default'); ?></b></label><em><?php _e('Enter here link to video from Media Library or YouTube','default'); ?></em></p>
			<input type="text" id="slide_video" name="slide_video_bg" value="<?php echo get_post_meta( $post->ID, 'slide_video_bg', true ); ?>" style="width: 100%;"/>
		</div>
		<div class="field-wrap" style="width: 30%">
			<p class="label-wrapper"><label for="video_aspect_ratio" style="display: block;"><b><?php _e('Video aspect ratio','default'); ?></b></label></p>
			<?php
			$aspect_ratio = get_post_meta( $post->ID, 'video_aspect_ratio', true ) ?: '16:9';
			$ratio_list   = array( '16:9', '4:3', '2.39:1' );
			?>
			<select name="video_aspect_ratio" id="video_aspect_ratio" style="width: 100%;">
				<?php foreach ( $ratio_list as $item ): ?>
					<option value="<?php echo $item; ?>" <?php selected( $aspect_ratio, $item ); ?>><?php echo $item; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="clearfix" style="clear:both"></div>
	</div>
	<?php
}

/**
 * Update slide background on slide save
 */

add_action( 'save_post', 'save_slide_background' );

function save_slide_background( $post_id ) {

	if ( ! isset( $_POST['slide_video_bg'] ) && ! isset( $_POST['video_aspect_ratio'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['project_nonce'], 'save_video_bg' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	update_post_meta( $post_id, 'video_aspect_ratio', $_POST['video_aspect_ratio'] );
	update_post_meta( $post_id, 'slide_video_bg', $_POST['slide_video_bg'] );

}

/**
 * Print script to hande appearance of metabox
 */
//add_action('admin_enqueue_scripts','display_metaboxes');
add_action( 'admin_footer', 'display_metaboxes' );

function display_metaboxes() {

	if ( get_post_type() == "slider" ) :
		?>
		<script type="text/javascript">// <![CDATA[
			$ = jQuery;

			function displayMetaboxes() {
				$( '#slide_background' ).hide();
				var selectedFormat = $( 'input[name=\'post_format\']:checked' ).val();
				if ( selectedFormat == 'video' ) {
					$( '#slide_background' ).show();
				}
			}

			$( function() {
				displayMetaboxes();
				$( 'input[name=\'post_format\']' ).change( function() {
					displayMetaboxes();
				} );
			} );
			// ]]></script>
	<?php
	endif;
}

// Enable control over YouTube iframe through API + add unique ID

function add_youtube_iframe_args( $html, $url, $args ) {

	/* Modify video parameters. */
	if ( strstr( $html, 'youtube.com/embed/' ) && ! empty( $args['location'] ) ) {
		preg_match_all( '|embed/(.*)\?|', $html, $matches );
		$html = str_replace( '?feature=oembed', '?feature=oembed&enablejsapi=1&autoplay=1&mute=1&controls=0&loop=1&showinfo=0&rel=0&playlist=' . $matches[1][0], $html );
		$html = str_replace( '<iframe', '<iframe rel="0" enablejsapi="1" id=slide-' . get_the_ID(), $html );
	}

	return $html;
}

add_filter( 'oembed_result', 'add_youtube_iframe_args', 10, 3 );

/**
 * Remove author archive pages
 */
function remove_author_archive_page() {
	global $wp_query;

	if ( is_author() ) {
		$wp_query->set_404();
		status_header(404);
		// Redirect to homepage
		// wp_redirect(get_option('home'));
	}
}
add_action( 'template_redirect', 'remove_author_archive_page' );

/**
 * Remove comments feed links
 */
add_filter( 'post_comments_feed_link', '__return_null' );

// Stick Admin Bar To The Top
if ( ! is_admin() ) {
	add_action( 'get_header', 'remove_topbar_bump' );

	function remove_topbar_bump() {
		remove_action( 'wp_head', '_admin_bar_bump_cb' );
	}

	function stick_admin_bar() {
		echo "
			<style type='text/css'>
				body.admin-bar {margin-top:32px !important}
				@media screen and (max-width: 782px) {
					body.admin-bar { margin-top:46px !important }
				}
			</style>
			";
	}

	add_action( 'admin_head', 'stick_admin_bar' );
	add_action( 'wp_head', 'stick_admin_bar' );
}

// Customize Login Screen
function wordpress_login_styling() {
	if ( $custom_logo_id = get_theme_mod( 'custom_logo' ) ) {
		$custom_logo_img = wp_get_attachment_image_src( $custom_logo_id, 'medium' );
		$custom_logo_src = $custom_logo_img[0];
	} else {
		$custom_logo_src = 'wp-admin/images/wordpress-logo.svg?ver=20131107';
	}
	?>
	<style type="text/css">
		.login #login h1 a {
			background-image: url('<?php echo $custom_logo_src; ?>');
			background-size: contain;
			background-position: 50% 50%;
			width: auto;
			height: 120px;
		}

		body.login {
			background-color: #f1f1f1;
		<?php if ($bg_image = get_background_image()) {?> background-image: url('<?php echo $bg_image; ?>') !important;
		<?php } ?> background-repeat: repeat;
			background-position: center center;
		}
	</style>
<?php }

add_action( 'login_enqueue_scripts', 'wordpress_login_styling' );

function admin_logo_custom_url() {
	$site_url = get_bloginfo( 'url' );

	return ( $site_url );
}

add_filter( 'login_headerurl', 'admin_logo_custom_url' );

/**
 * Display GravityForms fields label if it set to Hidden
 */

function display_gf_fields_label() {
	echo '<style>.hidden_label label.gfield_label{visibility:visible;line-height:inherit;}.theme-overlay .theme-version{display: none;}</style>';
}

add_action( 'admin_head', 'display_gf_fields_label' );

// ACF Pro Options Page

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );

}

// Set Google Map API key

function set_custom_google_api_key() {
	acf_update_setting( 'google_api_key', get_theme_mod( 'google_maps_api' ) ?: 'AIzaSyBgg23TIs_tBSpNQa8RC0b7fuV4SOVN840' );
}

add_action( 'acf/init', 'set_custom_google_api_key' );

// Disable Emoji

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );
function disable_wp_emojis_in_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// Wrap any iframe and emved tag into div for responsive view

function iframe_wrapper( $content ) {
	// match any iframes
	$pattern = '~<iframe.*?<\/iframe>|<embed.*?<\/embed>~';
	preg_match_all( $pattern, $content, $matches );

	foreach ( $matches[0] as $match ) {
		// Check if it is a video player iframe
		if ( strpos( $match, 'youtu' ) || strpos( $match, 'vimeo' ) ) {
			// wrap matched iframe with div
			$wrappedframe = '<div class="embed-responsive embed-responsive-16by9">' . $match . '</div>';
			//replace original iframe with new in content
			$content = str_replace( $match, $wrappedframe, $content );
		}
	}

	return $content;
}

add_filter( 'the_content', 'iframe_wrapper' );
add_filter( 'acf_the_content', 'iframe_wrapper' );


// Dynamic Admin
if ( is_admin() ) {
	// $dynamic_admin = new DynamicAdmin();
	//	$dynamic_admin->addField( 'page', 'template', 'Page Template', 'template_detail_field_for_page' );

	// $dynamic_admin->run();
}

// Custom outline color
add_action( 'wp_head', 'custom_outline_color' );

function custom_outline_color() {
	$outline_color = get_theme_mod( 'outline_color' );
	if ( $outline_color ) {
		echo "<style>a,input,button,textarea,select{outline-color: {$outline_color}}</style>";
	}
}

// Register Google Maps API key settings in customizer

function register_google_maps_settings( $wp_customize ) {
	$wp_customize->add_section( 'google_maps', array(
		'title'    => __( 'Google Maps', 'default' ),
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'google_maps_api', array(
		'default' => 'AIzaSyBgg23TIs_tBSpNQa8RC0b7fuV4SOVN840',
	) );
	$wp_customize->add_control( 'google_maps_api', array(
		'label'    => __( 'Google Maps API key', 'default' ),
		'section'  => 'google_maps',
		'settings' => 'google_maps_api',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'outline_color', array() );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'outline_color', array(
		'label' => __( 'Outline color', 'default' ),
		'section' => 'colors',
		'settings' => 'outline_color'
	) ) );
}

add_action( 'customize_register', 'register_google_maps_settings' );

/**
 * Enable GF Honeypot for all forms
 *
 * @param $form
 * @param $is_new
 */

function enable_honeypot_on_new_form_creation( $form, $is_new ) {
	if ( $is_new ) {
		$form['enableHoneypot'] = true;
		$form['is_active']      = 1;
		GFAPI::update_form( $form );
	}
}

add_action( 'gform_after_save_form', 'enable_honeypot_on_new_form_creation', 10, 2 );

/**
 * Disable date field autocomplete popup
 *
 * @param string $input field HTML markup
 * @param object $field GForm field object
 *
 * @return string
 */

function gform_remove_date_autocomplete( $input, $field ) {
	if ( is_admin() ) {
		return $input;
	}
	if ( GFFormsModel::is_html5_enabled() && $field->type == 'date' ) {
		$input = str_replace( '<input', '<input autocomplete="off" ', $input );
	}

	return $input;
}

add_filter( 'gform_field_content', 'gform_remove_date_autocomplete', 11, 2 );

/**
 * Copyright field functionality
 *
 * @param array $field ACF Field settings
 *
 * @return array
 */

function populate_copyright_instructions( $field ) {
	$field['instructions'] = 'Input <code>@year</code> to replace static year with dynamic, so it will always shows current year.';

	return $field;
}

add_action( 'acf/load_field/name=copyright', 'populate_copyright_instructions');

if ( ! is_admin() ) {
	// Replace @year with current year
	add_filter( 'acf/load_value/name=copyright', function ( $value ) {
		return str_replace( '@year', date( 'Y' ), $value );
	} );
}

/**
 * Apply lazyload to whole page content
 */

function lazyload() {
	ob_start( 'lazyloadBuffer' );
}

add_action( 'template_redirect', 'lazyload' );

/**
 * @param string $html HTML content.
 *
 * @return string
 */
function lazyloadBuffer( $html ) {
	$lazy   = new CreateLazyImg;
	$buffer = $lazy->ignoreScripts( $html );
	$buffer = $lazy->ignoreNoscripts( $buffer );

	$html = $lazy->lazyloadImages( $html, $buffer );
	$html = $lazy->lazyloadPictures( $html, $buffer );
	$html = $lazy->lazyloadBackgroundImages( $html, $buffer );

	return $html;
}

/**
 * Custom styles in TinyMCE
 *
 * @param array $buttons
 *
 * @return array
 */

function custom_style_selector( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}

add_filter( 'mce_buttons_2', 'custom_style_selector' );

function insert_custom_formats( $init_array ) {
	// Define the style_formats array
	$style_formats               = array(
		array(
			'title'    => 'Heading 1',
			'classes'  => 'h1',
			'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
			'wrapper'  => false,
		),
		array(
			'title'    => 'Heading 2',
			'classes'  => 'h2',
			'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
			'wrapper'  => false,
		),
		array(
			'title'    => 'Heading 3',
			'classes'  => 'h3',
			'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
			'wrapper'  => false,
		),
		array(
			'title'    => 'Heading 4',
			'classes'  => 'h4',
			'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
			'wrapper'  => false,
		),
		array(
			'title'    => 'Heading 5',
			'classes'  => 'h5',
			'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
			'wrapper'  => false,
		),
		array(
			'title'    => 'Heading 6',
			'classes'  => 'h6',
			'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
			'wrapper'  => false,
		),
		array(
			'title'    => 'Button',
			'classes'  => 'button',
			'selector' => 'a',
			'wrapper'  => false,
		),
		array(
			'title'  => 'Small text',
			'inline' => 'small',
		),
		array(
			'title'    => 'Two columns',
			'classes'  => 'two-columns',
			'selector' => 'p,h1,h2,h3,h4,h5,h6,ul',
		),
		array(
			'title'    => 'Three columns',
			'classes'  => 'three-columns',
			'selector' => 'p,h1,h2,h3,h4,h5,h6,ul',
		),
        array(
            'title'    => 'Blue Button',
            'classes'  => 'button--blue',
            'selector' => 'a',
            'wrapper'  => false,
        ),
        array(
            'title'    => 'Red Button',
            'classes'  => 'button--red',
            'selector' => 'a',
            'wrapper'  => false,
        ),
        array(
            'title'    => 'Transparent Blue Button',
            'classes'  => 'button-transparent-blue',
            'selector' => 'a',
            'wrapper'  => false,
        ),
        array(
            'title'    => 'Green Heading',
            'classes'  => 'heading-green',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper'  => false,
        ),
        array(
            'title'    => 'Blue Heading',
            'classes'  => 'heading-blue',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper'  => false,
        ),
        array(
            'title'    => 'Text Center',
            'classes'  => 'text-center',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper'  => false,
        ),

        array(
            'title'    => 'List Image',
            'classes'  => 'list-image',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper'  => false,
        ),

        array(
            'title'    => 'Accent',
            'inline'   => 'span',
            'classes'  => 'accent',
            'wrapper'  => false,
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
        ),
	);
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}

add_filter( 'tiny_mce_before_init', 'insert_custom_formats' );

add_editor_style();

/**
 * Add custom color to TinyMCE editor text color selector
 *
 * @param $init array
 *
 * @return mixed array
 */

function expand_default_editor_colors( $init ) {
	$default_colours = '"000000", "Black","993300", "Burnt orange","333300", "Dark olive","003300", "Dark green","003366", "Dark azure","000080", "Navy Blue","333399", "Indigo","333333", "Very dark gray","800000", "Maroon","FF6600", "Orange","808000", "Olive","008000", "Green","008080", "Teal","0000FF", "Blue","666699", "Grayish blue","808080", "Gray","FF0000", "Red","FF9900", "Amber","99CC00", "Yellow green","339966", "Sea green","33CCCC", "Turquoise","3366FF", "Royal blue","800080", "Purple","999999", "Medium gray","FF00FF", "Magenta","FFCC00", "Gold","FFFF00", "Yellow","00FF00", "Lime","00FFFF", "Aqua","00CCFF", "Sky blue","993366", "Brown","C0C0C0", "Silver","FF99CC", "Pink","FFCC99", "Peach","FFFF99", "Light yellow","CCFFCC", "Pale green","CCFFFF", "Pale cyan","99CCFF", "Light sky blue","CC99FF", "Plum","FFFFFF", "White"';

	$custom_colours  = '
		"123154", "Navy",
		"173a62", "Light Navy",
		"e21c54", "Red",
		"1d1d1d", "Black",
		"737373", "Gray",';

	$init['textcolor_map']  = '[' . $default_colours . ',' . $custom_colours . ']';
	$init['textcolor_rows'] = 6; // expand colour grid to 6 rows

	return $init;
}

add_filter( 'tiny_mce_before_init', 'expand_default_editor_colors' );


/*********************** PUT YOU FUNCTIONS BELOW ********************************/

add_image_size( 'full_hd', 1920, 0, array( 'center', 'center' ) );
add_image_size( 'large_high', 1024, 0, false );
// add_image_size( 'name', width, height, array('center','center'));

// Prevent page jumping on form submit
add_filter( 'gform_confirmation_anchor', '__return_false' );

// Show Gravity Form field label appearance dropdown
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// Replace standard form input with button
function form_submit_button( $button, $form ) {
	if ( $form['button']['type'] == 'image' && ! empty( $form['button']['imageUrl'] ) ) {
		return $button;
	}

	$button_inner = $form['button']['text'] ?: __( 'Submit', 'default' );

	return str_replace( array( 'input', '/>' ), array( 'button', '>' ), $button ) . "{$button_inner}</button>";
}

add_filter( "gform_submit_button", "form_submit_button", 10, 2 );

// Add ADA support on Gravity form error message
function form_submit_error_ada_notice( $msg ) {
	return str_replace( "class=", "role='alert' class=", $msg );
}

add_filter( 'gform_validation_message', 'form_submit_error_ada_notice' );

// Add ADA support on Gravity form success message
function form_submit_success_ada_notice( $msg ) {
	return str_replace( "id='gform_confirmation_message", "role='alert' id='gform_confirmation_message", $msg );
}

add_filter( 'gform_confirmation', 'form_submit_success_ada_notice' );

// Disable gutenberg
add_filter('use_block_editor_for_post_type', '__return_false');

/**
 * Replace Wordpress email Sender name
 *
 * @return string
 */

function replace_email_sender_name() {
	return get_bloginfo();
}

add_filter( 'wp_mail_from_name', 'replace_email_sender_name' );

/**
 * Add WooCommerce support
 */

function theme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );


/*******************************************************************************/


/******************* HIDE/SHOW WORDPRESS PLUGINS MENU ITEM *********************/

/**
 * Remove and Restore ability to Add new plugins to site
 */

function remove_plugins_menu_item( $role_name ) {
	$role = get_role( $role_name );
	$role->remove_cap( 'activate_plugins' );
	$role->remove_cap( 'install_plugins' );
	$role->remove_cap( 'upload_plugins' );
	$role->remove_cap( 'update_plugins' );
}

function restore_plugins_menu_item( $role_name ) {
	$role = get_role( $role_name );
	$role->add_cap( 'activate_plugins' );
	$role->add_cap( 'install_plugins' );
	$role->add_cap( 'upload_plugins' );
	$role->add_cap( 'update_plugins' );
}

// remove_plugins_menu_item('administrator');
// restore_plugins_menu_item('administrator');


/*******************************************************************************/

//AJAX for Load More Locations

add_action('wp_ajax_nopriv_load_more_locations', 'load_more_locations');
add_action('wp_ajax_load_more_locations', 'load_more_locations');

function load_more_locations() {
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $idPost = $_POST['id'] ? $_POST['id'] : 0;
    $posts_per_page = 3;
    $query_max_post = new WP_Query(array(
        'post_type'      => 'portfolio',
        'posts_per_page' => -1,
        'offset'         => $offset,
        'post_status'    => 'publish'
    ));
    $args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => $posts_per_page,
        'post_status'    => 'publish',
        'post__not_in'   => $idPost
    );

    $query = new WP_Query($args);
    $posts = array();
    $post_count = 0;

    if ($query->have_posts()) {
        while ($query->have_posts() && $post_count < $posts_per_page) {
            $query->the_post();
            ob_start();
            get_template_part('parts/loop', 'portfolio');
            $posts[] = ob_get_clean();
            $post_count++;
        }
    }

    $more_posts = $query_max_post->post_count > ($offset + $posts_per_page);
    wp_reset_postdata();

    wp_send_json(array(
        'posts' => $posts,
        'more' => $more_posts,
        'test' => $query_max_post->post_count,
        'test2' => $offset + $posts_per_page
    ));
}
//Exclude CPT from search
function exclude_cpt_from_search($query) {
    if ($query->is_main_query() && $query->is_search() && !is_admin()) {
        $query->set('post_type', array('post', 'page'));
    }
}
add_filter('pre_get_posts', 'exclude_cpt_from_search');

/**
 * Gravity Forms
 */
add_filter('gform_pre_render', 'custom_gform_pre_render');
function custom_gform_pre_render($form) {
    if ($form['id'] == 1) {
        $form['cssClass'] .= ' custom-drone-form';
    } elseif ($form['id'] == 2) {
        $form['cssClass'] .= ' contact-form';
    }

    elseif ($form['id'] == 4) {
        $form['cssClass'] .= ' custom-drone-form';
    } elseif ($form['id'] == 5) {
        $form['cssClass'] .= ' contact-form';
    }

    return $form;
}

add_action('wp_head', 'add_custom_form_styles');
function add_custom_form_styles() {
    ?>
    <style>
        #gform_wrapper_1,
        #gform_wrapper_2,
        #gform_wrapper_4,
        #gform_wrapper_5 {
            width: 100%;
        }

        #gform_wrapper_1 .gform_body,
        #gform_wrapper_4 .gform_body {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            grid-gap: 88px !important;
        }

        #gform_wrapper_1 .gform_fields,
        #gform_wrapper_4 .gform_fields {
            display: flex !important;
            flex-direction: column !important;
            gap: 24px !important;
        }

        #gform_wrapper_1 .gfield,
        #gform_wrapper_4 .gfield {
            margin-bottom: 24px !important;
        }

        #gform_wrapper_1 .gform_footer,
        #gform_wrapper_4 .gform_footer {
            grid-column: 2 !important;
        }

        #gform_wrapper_2 .gform_body,
        #gform_wrapper_5 .gform_body {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            grid-gap: 24px !important;
        }

        #gform_wrapper_2 .gform_fields,
        #gform_wrapper_5 .gform_fields {
            display: flex !important;
            flex-direction: column !important;
            gap: 24px !important;
        }

        #gform_wrapper_2 .gfield,
        #gform_wrapper_5 .gfield {
            margin-bottom: 24px !important;
        }

        #gform_wrapper_2 .gform_footer,
        #gform_wrapper_5 .gform_footer {
            grid-column: 2 !important;
            text-align: center !important;
        }

        @media (max-width: 991px) {
            #gform_wrapper_1 .gform_body,
            #gform_wrapper_2 .gform_body,
            #gform_wrapper_4 .gform_body,
            #gform_wrapper_5 .gform_body {
                grid-template-columns: 1fr !important;
                justify-items: center;
            }

            #gform_wrapper_1 .gform_footer,
            #gform_wrapper_2 .gform_footer,
            #gform_wrapper_4 .gform_footer,
            #gform_wrapper_5 .gform_footer {
                grid-column: 1 !important;
                justify-items: center;
            }
        }
    </style>
    <?php
}

add_filter('gform_submit_button', 'custom_submit_button', 10, 2);
function custom_submit_button($button, $form) {
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';
    $button_text = $form['button']['text'];

    if (empty($button_text)) {
        $is_drone_form = in_array($form['id'], [1, 4]);
        $is_contact_form = in_array($form['id'], [2, 5]);

        if ($is_drone_form) {
            $button_text = $current_lang === 'en' ? 'Customize Drone' : 'Кастомізувати Дрон';
        } elseif ($is_contact_form) {
            $button_text = $current_lang === 'en' ? 'Contact Us' : 'Зв\'язатись із нами';
        } else {
            $button_text = $current_lang === 'en' ? 'Submit' : 'Відправити';
        }
    }

    return '<button type="submit" class="gform_button button" id="gform_submit_button_' . $form['id'] . '">' . esc_html($button_text) . '</button>';
}


add_action('wp_footer', 'force_gravity_forms_layout');
function force_gravity_forms_layout() {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const droneFormIds = [1, 4];
            droneFormIds.forEach(function(id) {
                const wrapper = document.getElementById('gform_wrapper_' + id);
                if (wrapper) {
                    const body = wrapper.querySelector('.gform_body');
                    const footer = wrapper.querySelector('.gform_footer');

                    if (body) {
                        body.style.display = 'grid';
                        body.style.gridTemplateColumns = window.innerWidth > 991 ? '1fr 1fr' : '1fr';
                        body.style.gap = window.innerWidth > 991 ? '88px' : '24px';
                    }

                    if (footer) {
                        footer.style.gridColumn = window.innerWidth > 991 ? '2' : '1';
                    }
                }
            });

            const contactFormIds = [2, 5];
            contactFormIds.forEach(function(id) {
                const wrapper = document.getElementById('gform_wrapper_' + id);
                if (wrapper) {
                    const body = wrapper.querySelector('.gform_body');
                    const footer = wrapper.querySelector('.gform_footer');
                    const button = wrapper.querySelector('.gform_button');

                    if (body) {
                        body.style.display = 'grid';
                        body.style.gridTemplateColumns = window.innerWidth > 991 ? '1fr 1fr' : '1fr';
                        body.style.gap = '24px';
                    }

                    if (footer) {
                        footer.style.gridColumn = window.innerWidth > 991 ? '2' : '1';
                        footer.style.textAlign = 'center';
                    }

                    if (button) {
                        button.style.maxWidth = '240px';
                    }
                }
            });

            window.addEventListener('resize', function() {
                const allFormIds = [1, 2, 4, 5];
                allFormIds.forEach(function(id) {
                    const wrapper = document.getElementById('gform_wrapper_' + id);
                    if (wrapper) {
                        const body = wrapper.querySelector('.gform_body');
                        const footer = wrapper.querySelector('.gform_footer');

                        if (body) {
                            if (window.innerWidth <= 991) {
                                body.style.gridTemplateColumns = '1fr';
                                body.style.gap = '24px';
                            } else {
                                if (id === 1 || id === 4) {
                                    body.style.gridTemplateColumns = '1fr 1fr';
                                    body.style.gap = '88px';
                                } else {
                                    body.style.gridTemplateColumns = '1fr 1fr';
                                    body.style.gap = '24px';
                                }
                            }
                        }

                        if (footer) {
                            footer.style.gridColumn = window.innerWidth > 991 ? '2' : '1';
                        }
                    }
                });
            });
        });
    </script>
    <?php
}


add_filter('gform_confirmation', 'translate_gf_confirmation', 10, 4);
function translate_gf_confirmation($confirmation, $form, $entry, $ajax) {
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';

    if ($current_lang === 'en') {
        $confirmations = array(
            'Дякуємо за ваше повідомлення!' => 'Thank you for your message!',
            'Ми зв\'яжемося з вами найближчим часом.' => 'We will contact you soon.',
            'Форма успішно відправлена.' => 'Form submitted successfully.',
            'Дякуємо за заявку!' => 'Thank you for your request!',
        );

        if (is_array($confirmation) && isset($confirmation['message'])) {
            foreach ($confirmations as $ua => $en) {
                $confirmation['message'] = str_replace($ua, $en, $confirmation['message']);
            }
        } elseif (is_string($confirmation)) {
            foreach ($confirmations as $ua => $en) {
                $confirmation = str_replace($ua, $en, $confirmation);
            }
        }
    }

    return $confirmation;
}
function load_drone_by_term() {
    check_ajax_referer('drone_ajax_nonce', 'nonce');

    $term_id = isset($_POST['term_id']) ? intval($_POST['term_id']) : 0;
    $section = isset($_POST['section']) ? sanitize_text_field($_POST['section']) : '';

    if (!$term_id) {
        wp_send_json_error('Неверный ID термина');
    }

    $taxonomy = ($section === 'size') ? 'drone_size' : 'drone_task_type';

    $args = array(
        'post_type' => 'drone',
        'posts_per_page' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();

        ob_start();
        ?>
        <div class="drone-catalog__image-container">
            <?php if (has_post_thumbnail($post_id)) : ?>
                <?php echo get_the_post_thumbnail($post_id, 'large'); ?>
            <?php endif; ?>

            <a href="<?php echo get_permalink($post_id); ?>" class="drone-catalog__link">
                <div class="drone-catalog__link-button">
                    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.32 20.83L35.71 34.22M35.71 20.83V34.22H22.32" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </a>
        </div>

        <div class="drone-catalog__specs">
            <?php
            if (function_exists('have_rows') && have_rows('catalog_specifications', $post_id)) {
                echo '<div class="drone-catalog__specs-list">';
                while (have_rows('catalog_specifications', $post_id)) {
                    the_row();
                    $label = get_sub_field('label');
                    $value = get_sub_field('value');

                    echo '<div class="drone-catalog__spec-item">';
                    echo '<div class="drone-catalog__spec-label">' . esc_html($label) . '</div>';
                    echo '<div class="drone-catalog__spec-value">' . esc_html($value) . '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>
        </div>
        <?php
        $html = ob_get_clean();

        wp_send_json_success(array('html' => $html));
    } else {
        wp_send_json_error('Drones are not found');
    }
}
add_action('wp_ajax_load_drone_by_term', 'load_drone_by_term');
add_action('wp_ajax_nopriv_load_drone_by_term', 'load_drone_by_term');

function load_drone_by_id() {
    check_ajax_referer('drone_ajax_nonce', 'nonce');

    $drone_id = isset($_POST['drone_id']) ? intval($_POST['drone_id']) : 0;
    $section = isset($_POST['section']) ? sanitize_text_field($_POST['section']) : '';

    if (!$drone_id) {
        wp_send_json_error('Incorrcet drone ID');
    }

    ob_start();
    ?>
    <div class="drone-catalog__image-container">
        <?php if (has_post_thumbnail($drone_id)) : ?>
            <?php echo get_the_post_thumbnail($drone_id, 'large'); ?>
        <?php endif; ?>

        <a href="<?php echo get_permalink($drone_id); ?>" class="drone-catalog__link">
            <div class="drone-catalog__link-button">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.32 20.83L35.71 34.22M35.71 20.83V34.22H22.32" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </a>
    </div>

    <div class="drone-catalog__specs">
        <?php
        if (function_exists('have_rows') && have_rows('catalog_specifications', $drone_id)) {
            echo '<div class="drone-catalog__specs-list">';
            while (have_rows('catalog_specifications', $drone_id)) {
                the_row();
                $label = get_sub_field('label');
                $value = get_sub_field('value');

                echo '<div class="drone-catalog__spec-item">';
                echo '<div class="drone-catalog__spec-label">' . esc_html($label) . '</div>';
                echo '<div class="drone-catalog__spec-value">' . esc_html($value) . '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </div>
    <?php
    $html = ob_get_clean();

    wp_send_json_success(array('html' => $html));
}
add_action('wp_ajax_load_drone_by_id', 'load_drone_by_id');
add_action('wp_ajax_nopriv_load_drone_by_id', 'load_drone_by_id');


/******************************************************************************
 * AJAX Handlers - Drone Showcase
 ******************************************************************************/

function enqueue_drone_ajax_script() {
    wp_localize_script('global', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('drone_ajax_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_drone_ajax_script');

add_action('wp_ajax_load_drone_by_category', 'handle_load_drone_by_category');
add_action('wp_ajax_nopriv_load_drone_by_category', 'handle_load_drone_by_category');

// Add a test endpoint for debugging
add_action('wp_ajax_test_drone_queries', 'test_drone_queries');
add_action('wp_ajax_nopriv_test_drone_queries', 'test_drone_queries');

function test_drone_queries() {
    // Test basic drone queries
    $all_drones = get_posts(array(
        'post_type' => 'drones',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));
    
    $drone_size_terms = get_terms(array(
        'taxonomy' => 'drone_size',
        'hide_empty' => false
    ));
    
    $drone_task_terms = get_terms(array(
        'taxonomy' => 'drone_task_type',
        'hide_empty' => false
    ));
    
    // Test specific category combinations
    $test_results = array();
    
    // Test size categories
    $test_size_combinations = array(
        array('parent' => '10-inch', 'child' => '10-wn-gt'),
        array('parent' => '7-inch', 'child' => '7-longrange'),
        array('parent' => '8-inch', 'child' => '8-shooter')
    );
    
    foreach ($test_size_combinations as $combo) {
        $drone = get_drone_by_category($combo['parent'], $combo['child'], 'drone_size');
        $test_results['size_' . $combo['parent'] . '_' . $combo['child']] = $drone ? $drone->ID : null;
    }
    
    // Test task categories
    $test_task_combinations = array(
        array('parent' => 'to-engage-ground-targets', 'child' => '10-wn-gt'),
        array('parent' => 'for-hitting-air-targets', 'child' => '10-shooter')
    );
    
    foreach ($test_task_combinations as $combo) {
        $drone = get_drone_by_category($combo['parent'], $combo['child'], 'drone_task_type');
        $test_results['task_' . $combo['parent'] . '_' . $combo['child']] = $drone ? $drone->ID : null;
    }
    
    wp_send_json_success(array(
        'total_drones' => count($all_drones),
        'drone_size_terms' => $drone_size_terms,
        'drone_task_terms' => $drone_task_terms,
        'test_results' => $test_results
    ));
}

function handle_load_drone_by_category() {
    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'drone_ajax_nonce')) {
        wp_send_json_error('Security check failed');
        return;
    }

    $parent_slug = sanitize_text_field($_POST['parent_slug'] ?? '');
    $subcat_slug = sanitize_text_field($_POST['subcat_slug'] ?? '');
    $taxonomy = sanitize_text_field($_POST['taxonomy'] ?? '');

    error_log("AJAX request received: parent_slug=$parent_slug, subcat_slug=$subcat_slug, taxonomy=$taxonomy");

    if (empty($parent_slug) || empty($subcat_slug) || empty($taxonomy)) {
        wp_send_json_error('Missing required parameters');
        return;
    }

    if (!in_array($taxonomy, ['drone_size', 'drone_task_type'])) {
        wp_send_json_error('Invalid taxonomy');
        return;
    }

    $drone = get_drone_by_category($parent_slug, $subcat_slug, $taxonomy);

    if ($drone) {
        ob_start();
        render_drone_showcase_html($drone);
        $html = ob_get_clean();

        wp_send_json_success(['html' => $html]);
    } else {
        wp_send_json_error('No drone found for the selected category');
    }
}


function get_drone_by_category($parent_slug, $subcat_slug, $taxonomy) {
    // Get the child term directly by slug
    $child_term = get_term_by('slug', $subcat_slug, $taxonomy);
    
    if (!$child_term) {
        error_log("Drone category lookup failed: child_term not found, subcat_slug=$subcat_slug, taxonomy=$taxonomy");
        return null;
    }
    
    // Get the parent term
    $parent_term = get_term_by('slug', $parent_slug, $taxonomy);
    
    if (!$parent_term) {
        error_log("Drone category lookup failed: parent_term not found, parent_slug=$parent_slug, taxonomy=$taxonomy");
        return null;
    }
    
    // Verify that the child term is actually a child of the parent term
    if ($child_term->parent != $parent_term->term_id) {
        error_log("Drone category hierarchy mismatch: child_term->parent={$child_term->parent}, parent_term->term_id={$parent_term->term_id}");
        return null;
    }
    
    $args = array(
        'post_type' => 'drones',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $child_term->term_id,
                'include_children' => false
            )
        )
    );

    $query = new WP_Query($args);
    $result = $query->have_posts() ? $query->posts[0] : null;
    
    if (!$result) {
        error_log("No drone found for category: parent_slug=$parent_slug, subcat_slug=$subcat_slug, taxonomy=$taxonomy, child_term_id={$child_term->term_id}");
    }
    
    return $result;
}


function get_default_drone_for_section($taxonomy) {
    // Get all parent terms from the taxonomy
    $parent_terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'parent' => 0,
        'fields' => 'ids'
    ));
    
    if (empty($parent_terms)) {
        return null;
    }
    
    // Get all subcategories (children of parent terms) that have drones
    $subcategories = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => true, // Only get terms that have posts
        'parent__in' => $parent_terms,
        'fields' => 'ids'
    ));
    
    if (empty($subcategories)) {
        return null;
    }
    
    $args = array(
        'post_type' => 'drones',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $subcategories,
                'operator' => 'IN'
            )
        )
    );

    $query = new WP_Query($args);
    return $query->have_posts() ? $query->posts[0] : null;
}


function get_drone_categories($drone_id, $taxonomy) {
    $terms = wp_get_post_terms($drone_id, $taxonomy);

    if (empty($terms)) return null;

    $parent_term = null;
    $child_term = null;

    foreach ($terms as $term) {
        if ($term->parent == 0) {
            $parent_term = $term;
        } else {
            $child_term = $term;
        }
    }

    if ($parent_term && $child_term) {
        return array(
            'parent' => $parent_term->slug,
            'child' => $child_term->slug
        );
    }

    return null;
}


function render_drone_showcase_html($drone) {
    if (!$drone) {
        echo '<p>Drone not found</p>';
        return;
    }

    $drone_id = $drone->ID;
    $drone_title = get_the_title($drone_id);
    $drone_image = get_the_post_thumbnail($drone_id, 'full');
    $drone_link = get_permalink($drone_id);

    $specifications = function_exists('get_field') ? get_field('catalog_specifications', $drone_id) : [];

    // Get drone categories using standard WordPress categories
    $drone_categories = array();
    
    // Get standard WordPress categories for this drone
    $categories = get_the_category($drone_id);
    
    if (!empty($categories) && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            if (!empty($category->name)) {
                $drone_categories[] = $category->name;
            }
        }
    }

    ?>
    <div class="drone-showcase__content">
        <div class="drone-showcase__image">
            <?php if ($drone_image): ?>
                <?php echo $drone_image; ?>
            <?php else: ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/drone-placeholder.jpg'); ?>"
                     alt="<?php echo esc_attr($drone_title); ?>" class="img-fluid">
            <?php endif; ?>
            
            <a href="<?php echo esc_url($drone_link); ?>" class="drone-showcase__link-button">
                <svg width="50" height="50" viewBox="0 0 24 24" fill="none">
                    <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <div class="drone-showcase__specs">
            <?php if ($specifications && is_array($specifications)): ?>
                <?php foreach ($specifications as $spec): ?>
                    <?php if (!empty($spec['label']) && !empty($spec['value'])): ?>
                        <div class="spec-block">
                            <div class="spec-block__label"><?php echo esc_html($spec['label']); ?></div>
                            <div class="spec-block__value"><?php echo esc_html($spec['value']); ?></div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <?php if (!empty($drone_categories)): ?>
                    <div class="spec-block">
                        <div class="spec-block__label">Category</div>
                        <div class="spec-block__value"><?php echo esc_html(implode(', ', $drone_categories)); ?></div>
                    </div>
                <?php else: ?>
                    <?php if (!empty($drone_categories)): ?>
                        <div class="spec-block">
                            <div class="spec-block__label">Category</div>
                            <div class="spec-block__value"><?php echo esc_html(implode(', ', $drone_categories)); ?></div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php
}


function render_drone_showcase($drone) {
    if (!$drone) return '';

    ob_start();
    render_drone_showcase_html($drone);
    return ob_get_clean();
}


add_filter('gform_confirmation', 'custom_gform_confirmation_behavior', 10, 4);

function custom_gform_confirmation_behavior($confirmation, $form, $entry, $ajax) {
    if ($ajax) {
        $confirmation .= '<script>  
            jQuery(document).ready(function($) {  
                setTimeout(function() {  
                    $("#gform_wrapper_' . $form['id'] . '").show();  
                }, 100);  
            });  
        </script>';
    }
    return $confirmation;
}

add_filter('gform_enable_ajax', '__return_true');


add_filter('gform_confirmation', 'simple_toast_confirmation', 10, 4);

function simple_toast_confirmation($confirmation, $form, $entry, $ajax) {
    if ($ajax) {
        $message = is_array($confirmation) ? $confirmation['message'] : $confirmation;
        $clean_message = wp_strip_all_tags($message);

        return '<div id="gform_confirmation_message_' . $form['id'] . '" style="display:none;">' . esc_html($clean_message) . '</div>  
        <script>  
        jQuery(document).ready(function($) {  
            var message = $("#gform_confirmation_message_' . $form['id'] . '").text();  
            if (typeof showToast === "function" && message) {  
                showToast(message, "success");  
            }  
              
            setTimeout(function() {  
                $("#gform_wrapper_' . $form['id'] . '").html(originalFormContent["' . $form['id'] . '"]);  
                  
                $("#gform_' . $form['id'] . ' input[type=text], #gform_' . $form['id'] . ' input[type=email], #gform_' . $form['id'] . ' input[type=tel], #gform_' . $form['id'] . ' textarea").val("");  
                $("#gform_' . $form['id'] . ' select").prop("selectedIndex", 0);  
                $("#gform_' . $form['id'] . ' input[type=radio], #gform_' . $form['id'] . ' input[type=checkbox]").prop("checked", false);  
            }, 200);  
        });  
        </script>';
    }
    return $confirmation;
}


function add_back_to_top_button() {
    ?>
    <div class="back-to-top" id="backToTop">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 20L20 12H15V4H9V12H4L12 20Z" fill="currentColor"/>
        </svg>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.getElementById('backToTop');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.add('visible');
                } else {
                    backToTopButton.classList.remove('visible');
                }
            });

            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'add_back_to_top_button');

/******************************************************************************
 * Polylang Pro Integration
 ******************************************************************************/

add_action('init', 'fix_polylang_cookie_conflict', 1);
function fix_polylang_cookie_conflict() {
    $problematic_cookies = ['pll_language', 'secure', 'wordpress_sec_'];

    foreach ($problematic_cookies as $cookie_name) {
        if (isset($_COOKIE[$cookie_name])) {
            unset($_COOKIE[$cookie_name]);
            setcookie($cookie_name, '', time() - 3600, '/', '', false, false);
        }
    }
}

add_filter('pll_cookie', 'custom_pll_cookie_settings');
function custom_pll_cookie_settings($cookie) {
    return array(
        'name' => 'site_language',
        'expire' => time() + YEAR_IN_SECONDS,
        'path' => '/',
        'domain' => '',
        'secure' => is_ssl(),
        'httponly' => false,
        'samesite' => 'Lax'
    );
}

// ACF filters moved to init hook to prevent translation loading issues

function get_option_by_language($field_name, $fallback = '') {
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';

    if ($current_lang === 'en') {
        $en_value = get_field($field_name . '_en', 'options');
        if ($en_value) {
            return $en_value;
        }
    }

    $ua_value = get_field($field_name, 'options');
    return $ua_value ?: $fallback;
}

function get_common_option($field_name, $fallback = '') {
    $value = get_field($field_name, 'options');
    return $value ?: $fallback;
}

add_filter('pll_get_post_types', 'add_cpt_to_pll', 10, 2);
function add_cpt_to_pll($post_types, $is_settings) {
    if ($is_settings) {
        $post_types['drones'] = 'drones';
        $post_types['service'] = 'service';
        $post_types['client_reviews'] = 'client_reviews';
    }
    return $post_types;
}

add_filter('pll_get_taxonomies', 'add_tax_to_pll', 10, 2);
function add_tax_to_pll($taxonomies, $is_settings) {
    if ($is_settings) {
        $taxonomies['drone_size'] = 'drone_size';
        $taxonomies['drone_task_type'] = 'drone_task_type';
    }
    return $taxonomies;
}


add_filter('gform_enable_ajax', '__return_false');

add_filter('gform_confirmation', 'redirect_with_toast_message', 10, 4);
function redirect_with_toast_message($confirmation, $form, $entry, $ajax) {
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';

    $is_drone_form = in_array($form['id'], [1, 4]);
    $is_contact_form = in_array($form['id'], [2, 5]);

    if ($is_drone_form) {
        $success_message = $current_lang === 'en'
            ? 'Thank you! Your drone customization request has been sent successfully.'
            : 'Дякуємо! Ваша заявка на кастомізацію дрона успішно надіслана.';
    } elseif ($is_contact_form) {
        $success_message = $current_lang === 'en'
            ? 'Thank you! Your message has been sent successfully. We will contact you soon.'
            : 'Дякуємо! Ваше повідомлення успішно надіслано. Ми зв\'яжемося з вами найближчим часом.';
    } else {
        $success_message = $current_lang === 'en'
            ? 'Thank you! Your form has been submitted successfully.'
            : 'Дякуємо! Форма успішно відправлена.';
    }

    $encoded_message = urlencode($success_message);
    $url = add_query_arg(array(
        'form_sent' => $form['id'],
        'toast_message' => $encoded_message
    ), wp_get_referer());

    $confirmation = array('redirect' => $url);
    return $confirmation;
}

add_action('wp_footer', 'reset_form_and_show_toast');
function reset_form_and_show_toast() {
    if (isset($_GET['form_sent']) && isset($_GET['toast_message'])) {
        $form_id = intval($_GET['form_sent']);
        $message = urldecode($_GET['toast_message']);
        ?>
        <script>
            jQuery(document).ready(function($) {
                $('#gform_<?php echo $form_id; ?>')[0].reset();

                showFormToast('<?php echo esc_js($message); ?>', 'success');

                const url = new URL(window.location);
                url.searchParams.delete('form_sent');
                url.searchParams.delete('toast_message');
                history.replaceState(null, null, url);
            });
        </script>
        <?php
    }
}

add_action('wp_footer', 'add_simple_toast_functionality');
function add_simple_toast_functionality() {
    ?>
    <style>
        .form-toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .form-toast {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            position: relative;
            font-weight: 500;
        }

        .form-toast button {
            position: absolute;
            top: 5px;
            right: 10px;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: inherit;
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            .form-toast-container {
                top: 10px;
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }
    </style>

    <script>
        function showFormToast(message, type) {
            let container = document.querySelector('.form-toast-container');
            if (!container) {
                container = document.createElement('div');
                container.className = 'form-toast-container';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            toast.className = 'form-toast';

            toast.innerHTML = `
            <span style="margin-right: 10px; font-weight: bold;">✓</span>
            ${message}
            <button onclick="this.parentElement.remove()">×</button>
        `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 100);

            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 300);
            }, 5000);
        }
    </script>
    <?php
}

// Fix ACF translation loading issue - Move ACF filters to proper hook
function fix_acf_translation_loading() {
    // Only add ACF filters if ACF is active
    if (class_exists('ACF')) {
        add_filter('acf/settings/current_language', 'my_acf_settings_current_language');
        add_filter('acf/settings/default_language', 'my_acf_settings_default_language');
        add_filter('acf/load_value', 'auto_translate_options_fields', 10, 3);
    }
}

add_action('init', 'fix_acf_translation_loading');

function my_acf_settings_current_language($language) {
    if (function_exists('pll_current_language')) {
        return pll_current_language();
    }
    return $language;
}

function my_acf_settings_default_language($language) {
    if (function_exists('pll_default_language')) {
        return pll_default_language();
    }
    return $language;
}

function auto_translate_options_fields($value, $post_id, $field) {
    if ($post_id !== 'options') {
        return $value;
    }

    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';

    if ($current_lang === 'en') {
        $en_field_name = $field['name'] . '_en';
        $en_value = get_field($en_field_name, 'options');

        if ($en_value) {
            return $en_value;
        }
    }

    return $value;
}

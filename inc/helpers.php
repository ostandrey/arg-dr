<?php
/**
 * Enqueue external fonts with font-display: swap; property
 *
 * @param string $url fonts link GoogleFonts/Typekit
 * @param bool $echo echo or return the styles
 *
 * @return string
 */
function enqueue_fonts( $url, $echo = true ) {
	$response = wp_remote_get( $url );
	$body     = wp_remote_retrieve_body( $response );

	if ( strpos( $body, 'font-display' ) === false ) {
		$body = str_replace( '}', 'font-display:swap;}', $body );
	}

	if ( $echo ) {
		echo '<style>' . $body . '</style>';
	} else {
		return '<style>' . $body . '</style>';
	}
}

/**
 * Output HTML markup of template with passed args
 *
 * @param string $file File name without extension (.php)
 * @param array $args Array with args ($key=>$value)
 * @param string $default_folder Requested file folder
 *
 * */
function show_template( $file, $args = null, $default_folder = 'parts' ) {
	echo return_template( $file, $args, $default_folder );
}

/**
 * Return HTML markup of template with passed args
 *
 * @param string $file File name without extension (.php)
 * @param array $args Array with args ($key=>$value)
 * @param string $default_folder Requested file folder
 *
 * @return string template HTML
 * */
function return_template( $file, $args = null, $default_folder = 'parts' ) {
	$file = $default_folder . '/' . $file . '.php';
	if ( $args ) {
		extract( $args );
	}
	if ( locate_template( $file ) ) {
		ob_start();
		include( locate_template( $file ) ); //Theme Check free. Child themes support.
		$template_content = ob_get_clean();

		return $template_content;
	}

	return '';
}

/**
 * Get Post Featured image
 *
 * @var int $id Post id
 * @var string $size = 'full' featured image size
 *
 * @return string Post featured image url
 * @author DimonPDAA
 */
function get_attached_img_url( $id = 0, $size = "medium_large" ) {
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );

	return $img[0];
}

/**
 * Dynamic admin function
 *
 * @var string $column_name Column id
 * @var int $post_id Post id
 *
 * @return void
 */
function template_detail_field_for_page( $column_name, $post_id ) {
	if ( $column_name == 'template' ) {
		$template_name = str_replace( '.php', '', get_post_meta( $post_id, '_wp_page_template', true ) );
		echo '<span style="text-transform: capitalize;">' . str_replace( array(
				'template-',
				'/'
			), '', substr( $template_name, strpos( $template_name, '/' ), strlen( $template_name ) ) ) . ' Page</span>';
	}

	return;
}

/**
 * Output background image style
 *
 * @param array|string $img Image array or url
 * @param string $size Image size to retrieve
 * @param bool $echo Whether to output the the style tag or return it.
 *
 * @return string|void String when retrieving.
 */
function bg( $img = '', $size = '', $echo = true ) {

	if ( empty( $img ) ) {
		return false;
	}

	if ( is_array( $img ) ) {
		$url = $size ? $img['sizes'][$size] : $img['url'];
	} else {
		$url = $img;
	}

	$string = 'style="background-image: url(' . $url . ')"';

	if ( $echo ) {
		echo $string;
	} else {
		return $string;
	}
}

/**
 * Format phone number, trim all unnecessary characters
 *
 * @param string $string Phone number
 *
 * @return string Formatted phone number
 */
function sanitize_number( $string ) {
	return preg_replace( '/[^+\d]+/', '', $string );
}

/**
 * Convert file url to path
 *
 * @param string $url Link to file
 *
 * @return bool|mixed|string
 */

function convert_url_to_path( $url ) {
	if ( ! $url ) {
		return false;
	}
	$url       = str_replace( array( 'https://', 'http://' ), '', $url );
	$home_url  = str_replace( array( 'https://', 'http://' ), '', site_url() );
	$file_part = ABSPATH . str_replace( $home_url, '', $url );
	$file_part = str_replace( '//', '/', $file_part );
	if ( file_exists( $file_part ) ) {
		return $file_part;
	}

	return false;
}

/**
 * Return/Output SVG as html
 *
 * @param array|string $img Image link or array
 * @param string $class Additional class attribute for img tag
 * @param string $size Image size if $img is array
 *
 * @return void
 */
function display_svg( $img, $class = '', $size = 'medium' ) {
	echo return_svg( $img, $class, $size );
}

function return_svg( $img, $class = '', $size = 'medium' ) {
	if ( ! $img ) {
		return '';
	}

	$file_url = is_array( $img ) ? $img['url'] : $img;

	$file_info = pathinfo( $file_url );
	if ( $file_info['extension'] == 'svg' ) {
		$file_path         = convert_url_to_path( $file_url );

		if ( ! $file_path ) {
			return '';
		}

		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer"      => false,
				"verify_peer_name" => false,
			),
		);
		$image             = file_get_contents( $file_path, false, stream_context_create( $arrContextOptions ) );
		if ( $class ) {
			$image = str_replace( '<svg ', '<svg class="' . esc_attr( $class ) . '" ', $image );
		}
		$image = preg_replace('/^(.*)?(<svg.*<\/svg>)(.*)?$/is', '$2', $image);

	} elseif ( is_array( $img ) ) {
		$image = wp_get_attachment_image( $img['id'], $size, false, array( 'class' => $class ) );
	} else {
		$image = '<img class="' . esc_attr( $class ) . '" src="' . esc_url( $img ) . '" alt="' . esc_attr( $file_info['filename'] ) . '"/>';
	};

	return $image;
}

/**
 * Check if URL is YouTube or Vimeo video
 * @param string $url Link to video
 *
 * @return bool
 */
function is_embed_video( $url ) {
	if ( ! $url ) {
		return false;
	}

	$yt_pattern    = '#^https?://(?:www\.)?(?:youtube\.com/watch|youtu\.be/)#';
	$vimeo_pattern = '#^https?://(.+\.)?vimeo\.com/.*#';

	$is_vimeo   = ( preg_match( $vimeo_pattern, $url ) );
	$is_youtube = ( preg_match( $yt_pattern, $url ) );

	return ( $is_vimeo || $is_youtube );
}


/**
 * Get SVG real size (width+height / viewbox) and use it in <img> width, height attr
 *
 * @param array|false  $image         Either array with src, width & height, icon src, or false.
 * @param int          $attachment_id Image attachment ID.
 * @param string|array $size          Size of image. Image size or array of width and height values
 *                                    (in that order). Default 'thumbnail'.
 * @param bool         $icon          Whether the image should be treated as an icon. Default false.
 *
 * @return array
 */
function fix_wp_get_attachment_image_svg( $image, $attachment_id, $size, $icon ) {
	if ( is_array( $image ) && preg_match( '/\.svg$/i', $image[0] ) && $image[1] <= 1 ) {
		if ( is_array( $size ) ) {
			$image[1] = $size[0];
			$image[2] = $size[1];
		} elseif ( ( $xml = simplexml_load_file( $image[0] ) ) !== false ) {
			$attr     = $xml->attributes();
			$viewbox  = explode( ' ', $attr->viewBox );
			$image[1] = isset( $attr->width ) && preg_match( '/\d+/', $attr->width, $value ) ? (int) $value[0] : ( count( $viewbox ) == 4 ? (int) $viewbox[2] : null );
			$image[2] = isset( $attr->height ) && preg_match( '/\d+/', $attr->height, $value ) ? (int) $value[0] : ( count( $viewbox ) == 4 ? (int) $viewbox[3] : null );
		} else {
			$image[1] = $image[2] = null;
		}
	}

	return $image;
}

add_filter( 'wp_get_attachment_image_src', 'fix_wp_get_attachment_image_svg', 10, 4 );
<?php
/**
 * The file that defines the dynamic styles of the plugin.
 *
 * @link       https://grandplugin.com
 * @since      1.0.0
 *
 * @package    WPGP_WordPress_Slider
 * @subpackage WPGP_WordPress_Slider/public
 */

// Section Title Typography.
$wpgpyg_section_title_font_family    = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo', null, 'font-family' );
$wpgpyg_section_title_font_weight    = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo', null, 'font-weight' );
$wpgpyg_section_title_font_style     = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo', null, 'font-style' );
$wpgpyg_section_title_text_align     = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo', null, 'text-align' );
$wpgpyg_section_title_text_transform = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo', null, 'text-transform' );
$wpgpyg_section_title_font_size      = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo', null, 'font-size' );
$wpgpyg_section_title_line_height    = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo', null, 'line-height' );
$wpgpyg_section_title_letter_spacing = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo', null, 'letter-spacing' );
$wpgpyg_section_title_color          = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo', null, 'color' );
$wpgpyg_section_title_unit           = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo', null, 'unit' );

// Video Title Typography.
$wpgpyg_video_title_font_family    = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo', null, 'font-family' );
$wpgpyg_video_title_font_weight    = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo', null, 'font-weight' );
$wpgpyg_video_title_font_style     = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo', null, 'font-style' );
$wpgpyg_video_title_text_align     = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo', null, 'text-align' );
$wpgpyg_video_title_text_transform = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo', null, 'text-transform' );
$wpgpyg_video_title_font_size      = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo', null, 'font-size' );
$wpgpyg_video_title_line_height    = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo', null, 'line-height' );
$wpgpyg_video_title_letter_spacing = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo', null, 'letter-spacing' );
$wpgpyg_video_title_color          = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo', null, 'color' );
$wpgpyg_video_title_unit           = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo', null, 'unit' );

// Video Description Typography.
$wpgpyg_desc_font_family    = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo', null, 'font-family' );
$wpgpyg_desc_font_weight    = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo', null, 'font-weight' );
$wpgpyg_desc_font_style     = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo', null, 'font-style' );
$wpgpyg_desc_text_align     = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo', null, 'text-align' );
$wpgpyg_desc_text_transform = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo', null, 'text-transform' );
$wpgpyg_desc_font_size      = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo', null, 'font-size' );
$wpgpyg_desc_line_height    = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo', null, 'line-height' );
$wpgpyg_desc_letter_spacing = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo', null, 'letter-spacing' );
$wpgpyg_desc_color          = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo', null, 'color' );
$wpgpyg_desc_unit           = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo', null, 'unit' );

$wpgpyt_grid_column = wpgpyg_get_post_meta( $post_id, 'wpgpyt_grid_column' );

$wpgpyt_subscribe_position = wpgpyg_get_options( 'wpgpyt_subscribe_position' );

$wpgpyg_css = array(

	'#wpgpyg--section-title-' . $post_id => array(
		'margin-bottom' => $wpgpyg_section_title_margin_bottom . 'px',
	),

);

// Section Title Typography.
if ( $wpgpyg_section_title_show && $wpgpyg_section_title_font_load ) {

	$wpgpyg_css[ '#wpgpyg--section-title-' . $post_id ] = array(
		'font-family'    => $wpgpyg_section_title_font_family ? $wpgpyg_section_title_font_family : 'inherit',
		'font-weight'    => $wpgpyg_section_title_font_weight ? $wpgpyg_section_title_font_weight : 'inherit',
		'font-style'     => $wpgpyg_section_title_font_style ? $wpgpyg_section_title_font_style : 'inherit',
		'text-align'     => $wpgpyg_section_title_text_align ? $wpgpyg_section_title_text_align : 'inherit',
		'text-transform' => $wpgpyg_section_title_text_transform ? $wpgpyg_section_title_text_transform : 'inherit',
		'font-size'      => $wpgpyg_section_title_font_size ? $wpgpyg_section_title_font_size . 'px' : 'inherit',
		'line-height'    => $wpgpyg_section_title_line_height ? $wpgpyg_section_title_line_height . 'px' : 'inherit',
		'letter-spacing' => $wpgpyg_section_title_letter_spacing ? $wpgpyg_section_title_letter_spacing . 'px' : 'inherit',
		'color'          => $wpgpyg_section_title_color ? $wpgpyg_section_title_color : 'inherit',
	);
}

$wpgpyt_dynamic_css = '';
if ( 'grid' === $wpgpyt_display_mode ) {

	$wpgpyg_css[ '#wpgpyg--grid-' . $post_id . ' .wpgpyt--card-content h2' ] = array(
		'font-family'    => $wpgpyg_video_title_font_family ? $wpgpyg_video_title_font_family : 'inherit',
		'font-weight'    => $wpgpyg_video_title_font_weight ? $wpgpyg_video_title_font_weight : 'inherit',
		'font-style'     => $wpgpyg_video_title_font_style ? $wpgpyg_video_title_font_style : 'inherit',
		'text-align'     => $wpgpyg_video_title_text_align ? $wpgpyg_video_title_text_align : 'inherit',
		'text-transform' => $wpgpyg_video_title_text_transform ? $wpgpyg_video_title_text_transform : 'inherit',
		'font-size'      => $wpgpyg_video_title_font_size ? $wpgpyg_video_title_font_size . 'px' : 'inherit',
		'line-height'    => $wpgpyg_video_title_line_height ? $wpgpyg_video_title_line_height . 'px' : 'inherit',
		'letter-spacing' => $wpgpyg_video_title_letter_spacing ? $wpgpyg_video_title_letter_spacing . 'px' : 'inherit',
		'color'          => $wpgpyg_video_title_color ? $wpgpyg_video_title_color : 'inherit',
	);

	$wpgpyg_css[ '#wpgpyg--grid-' . $post_id . ' .wpgpyt--card-content .wpgpyt--desc' ] = array(
		'font-family'    => $wpgpyg_desc_font_family ? $wpgpyg_desc_font_family : 'inherit',
		'font-weight'    => $wpgpyg_desc_font_weight ? $wpgpyg_desc_font_weight : 'inherit',
		'font-style'     => $wpgpyg_desc_font_style ? $wpgpyg_desc_font_style : 'inherit',
		'text-align'     => $wpgpyg_desc_text_align ? $wpgpyg_desc_text_align : 'inherit',
		'text-transform' => $wpgpyg_desc_text_transform ? $wpgpyg_desc_text_transform : 'inherit',
		'font-size'      => $wpgpyg_desc_font_size ? $wpgpyg_desc_font_size . 'px' : 'inherit',
		'line-height'    => $wpgpyg_desc_line_height ? $wpgpyg_desc_line_height . 'px' : 'inherit',
		'letter-spacing' => $wpgpyg_desc_letter_spacing ? $wpgpyg_desc_letter_spacing . 'px' : 'inherit',
		'color'          => $wpgpyg_desc_color ? $wpgpyg_desc_color : 'inherit',
	);

	$wpgpyt_dynamic_css = '@media screen and (min-width: 60em) {
		#wpgpyg--' . $post_id . ' .wpgpyt--card {
			max-width: calc(' . 100 / $wpgpyt_grid_column . '% -  1em);
		}
	}';
}

$wpgpyt_grid_responsive_width = '';
if ( 'slider' === $wpgpyt_display_mode ) {

	$wpgpyt_grid_responsive_width .= '@media only screen and (max-width: 480px) {
		#wpgp--youtube-gallery-' . $post_id . ' .swiper-container {
			width: ' . $wpgpyg_display_width_mobile . $wpgpyg_display_width_unit . ';
		}
		#wpgp--youtube-gallery-' . $post_id . ' .wpgp--video-container {
			width: ' . $wpgpyg_display_width_mobile . $wpgpyg_display_width_unit . ';
		}
	}
	@media only screen and (min-width: 480px) {
		#wpgp--youtube-gallery-' . $post_id . ' .swiper-container {
			width: ' . $wpgpyg_display_width_mobile . $wpgpyg_display_width_unit . ';
		}
		#wpgp--youtube-gallery-' . $post_id . ' .wpgp--video-container {
			width: ' . $wpgpyg_display_width_mobile . $wpgpyg_display_width_unit . ';
		}
	}
	@media only screen and (min-width: 767px) {
		#wpgp--youtube-gallery-' . $post_id . ' .swiper-container {
			width: ' . $wpgpyg_display_width_tablet . $wpgpyg_display_width_unit . ';
		}
		#wpgp--youtube-gallery-' . $post_id . ' .wpgp--video-container {
			width: ' . $wpgpyg_display_width_tablet . $wpgpyg_display_width_unit . ';
		}
	}
	@media only screen and (min-width: 1024px) {
		#wpgp--youtube-gallery-' . $post_id . ' .swiper-container {
			width: ' . $wpgpyg_display_width_laptop . $wpgpyg_display_width_unit . ';
		}
		#wpgp--youtube-gallery-' . $post_id . ' .wpgp--video-container {
			width: ' . $wpgpyg_display_width_laptop . $wpgpyg_display_width_unit . ';
		}
	}
	@media only screen and (min-width: 1280px) {
		#wpgp--youtube-gallery-' . $post_id . ' .swiper-container {
			width: ' . $wpgpyg_display_width_desktop . $wpgpyg_display_width_unit . ';
		}
		#wpgp--youtube-gallery-' . $post_id . ' .wpgp--video-container {
			width: ' . $wpgpyg_display_width_desktop . $wpgpyg_display_width_unit . ';
		}
	}';
}

if ( 'button' === $wpgpyt_display_mode ) {

	$wpgpyg_css[ '#wpgpyt-single-button-' . $post_id ] = array(
		'text-align' => $wpgpyt_single_btn_position,
	);
}

$wpgpyg_css['#wpgpyt--ytsubscribe'] = array(
	'text-align' => $wpgpyt_subscribe_position,
);

/***********************
 * CSS Rendering Engine.
 */
$wpgpyg_output_css = '';

foreach ( $wpgpyg_css as $style => $style_array ) {

	$wpgpyg_output_css .= $style . '{';

	foreach ( $style_array as $property => $value ) {

		$wpgpyg_output_css .= $property . ':' . $value . ';';
	}
	$wpgpyg_output_css .= '}';
}

echo '<style>';

// Computed style.
echo esc_html( $wpgpyg_output_css );

// Other CSS.
echo esc_html( $wpgpyt_dynamic_css . $wpgpyt_grid_responsive_width );

echo '</style>';

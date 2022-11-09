<?php

/**
 * The file that defines the Shortcode of the plugin.
 *
 * @link       https://www.grandplugin.com
 * @since      1.0.0
 *
 * @package    WPGP_YouTube_Gallery
 * @subpackage WPGP_YouTube_Gallery/includes
 */

/**
 * The file that defines the Shortcode of the plugin.
 *
 * @since      1.0.0
 * @package    WPGP_YouTube_Gallery
 * @subpackage WPGP_YouTube_Gallery/includes
 * @author     GrandPlugin <help@grandplugin.com>
 */
class WPGP_YouTube_Gallery_Shortcode {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		/**
		 * A Custom function to get post meta with sanitization and validation.
		 *
		 * @param [type] $post_id Current post ID.
		 * @param string $option Meta key.
		 * @param [type] $default Default meta value.
		 * @param string $option_two Nested meta key.
		 * @param [type] $default_two Nested meta value.
		 * @return mixed
		 */
		function wpgpyg_get_post_meta( $post_id, $option = '', $default = null, $option_two = '', $default_two = null ) {

			$options = get_post_meta( $post_id, '_wpgp_page_options', true );
			if ( ! empty( $option_two ) ) {

				return ( isset( $options[ $option ][ $option_two ] ) ) ? $options[ $option ][ $option_two ] : $default_two;
			} else {

				return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
			}
		}

		/**
		 * A Custom function to get post options settings with sanitization and validation.
		 *
		 * @param string $option Options key.
		 * @param [type] $default Default option value.
		 * @param string $option_two Nested option key.
		 * @param [type] $default_two Nested option value.
		 * @return mixed
		 */
		function wpgpyg_get_options( $option = '', $default = null, $option_two = '', $default_two = null ) {

			$options = get_option( '_wpgp_option_settings' );
			if ( ! empty( $option_two ) ) {

				return ( isset( $options[ $option ][ $option_two ] ) ) ? $options[ $option ][ $option_two ] : $default_two;
			} else {

				return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
			}
		}

	}

	/**
	 * A shortcode for this plugin.
	 *
	 * @since   1.0.0
	 * @param   string $atts attribute of this shortcode.
	 */
	public function wpgp_shortcode_execute( $atts ) {

		$post_id = intval( $atts['id'] );

		// General Settings.
		$wpgpyg_section_title_show          = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_show' );
		$wpgpyg_section_title_margin_bottom = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_margin_bottom' );
		$wpgpyt_display_mode                = wpgpyg_get_post_meta( $post_id, 'wpgpyt_display_mode' );
		$wpgpyt_video_from                  = wpgpyg_get_post_meta( $post_id, 'wpgpyt_video_from' );
		$wpgpyg_channel_id                  = wpgpyg_get_post_meta( $post_id, 'wpgpyt_channel_id' );
		$wpgpyg_playlist_id                 = wpgpyg_get_post_meta( $post_id, 'wpgpyt_playlist_id' );
		$wpgpyt_single_id                   = wpgpyg_get_post_meta( $post_id, 'wpgpyt_single_id' );
		$wpgpyt_single_btn_txt              = wpgpyg_get_post_meta( $post_id, 'wpgpyt_single_btn_txt' );
		$wpgpyt_single_btn_position         = wpgpyg_get_post_meta( $post_id, 'wpgpyt_single_btn_position' );
		$wpgpyt_gallery_theme               = wpgpyg_get_post_meta( $post_id, 'wpgpyt_gallery_theme' );

		// Grid Display Settings.
		$wpgpyg_display_width_desktop = wpgpyg_get_post_meta( $post_id, 'wpgpyt_display_width', null, 'top' );
		$wpgpyg_display_width_laptop  = wpgpyg_get_post_meta( $post_id, 'wpgpyt_display_width', null, 'right' );
		$wpgpyg_display_width_tablet  = wpgpyg_get_post_meta( $post_id, 'wpgpyt_display_width', null, 'bottom' );
		$wpgpyg_display_width_mobile  = wpgpyg_get_post_meta( $post_id, 'wpgpyt_display_width', null, 'left' );
		$wpgpyg_display_width_unit    = wpgpyg_get_post_meta( $post_id, 'wpgpyt_display_width', null, 'unit' );
		$wpgpyg_video_title_show      = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_show' );
		$wpgpyg_video_desc_show       = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_desc_show' );
		$wpgpyg_video_desc_length     = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_desc_length' );

		// Control Settings.
		$wpgpyg_max_result             = wpgpyg_get_post_meta( $post_id, 'wpgpyt_max_result' );
		$wpgpyg_order                  = wpgpyg_get_post_meta( $post_id, 'wpgpyt_search_order' );
		$wpgpyt_video_duration         = wpgpyg_get_post_meta( $post_id, 'wpgpyt_video_duration' );
		$wpgpyt_video_title_show       = wpgpyg_get_post_meta( $post_id, 'wpgpyt_video_title_show' );
		$wpgpyt_published_before_after = wpgpyg_get_post_meta( $post_id, 'wpgpyt_published_before_after' );
		$wpgpyt_date_before            = wpgpyg_get_post_meta( $post_id, 'wpgpyt_date_before' );
		$wpgpyt_date_after             = wpgpyg_get_post_meta( $post_id, 'wpgpyt_date_after' );

		// Typography.
		$wpgpyg_section_title_font_load = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_font_load' );
		$wpgpyg_video_title_font_load   = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_font_load' );
		$wpgpyg_desc_font_load          = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_font_load' );
		$wpgpyg_meta_font_load          = wpgpyg_get_post_meta( $post_id, 'wpgpyg_meta_font_load' );

		$wpgpyg_section_title_typo = wpgpyg_get_post_meta( $post_id, 'wpgpyg_section_title_typo' );
		$wpgpyg_video_title_typo   = wpgpyg_get_post_meta( $post_id, 'wpgpyg_video_title_typo' );
		$wpgpyg_desc_typo          = wpgpyg_get_post_meta( $post_id, 'wpgpyg_desc_typo' );
		$wpgpyg_meta_typo          = wpgpyg_get_post_meta( $post_id, 'wpgpyg_meta_typo' );

		/**
		 * Load Google font.
		 *
		 * @package shortcode
		 */
		if ( wpgpyg_get_options( 'wpgpyg_dequeue_google_font' ) ) {

			$wpgp_unique_id     = uniqid();
			$wpgp_enqueue_fonts = array();
			$wpgp_typography    = array();

			// Typography.
			$wpgp_typography[] = $wpgpyg_section_title_typo;
			$wpgp_typography[] = $wpgpyg_video_title_typo;
			$wpgp_typography[] = $wpgpyg_desc_typo;
			$wpgp_typography[] = $wpgpyg_meta_typo;

			if ( ! empty( $wpgp_typography ) ) {

				foreach ( $wpgp_typography as $wpgp_font ) {

					if ( isset( $wpgp_font['type'] ) && 'google' === $wpgp_font['type'] ) {

						$wpgp_variant         = ( isset( $wpgp_font['font-weight'] ) ) ? ':' . $wpgp_font['font-weight'] : '';
						$wpgp_subset          = isset( $wpgp_font['subset'] ) ? ':' . $wpgp_font['subset'] : '';
						$wpgp_enqueue_fonts[] = $wpgp_font['font-family'] . $wpgp_variant . $wpgp_subset;
					}
				}
			}

			if ( ! empty( $wpgp_enqueue_fonts ) ) {

				wp_enqueue_style( 'wpgp--google-fonts' . $wpgp_unique_id, esc_url( add_query_arg( 'family', rawurlencode( implode( '|', $wpgp_enqueue_fonts ) ), '//fonts.googleapis.com/css' ) ), array(), $this->version );
			}
		} // Google font enqueue dequeue.

		ob_start();

		wp_enqueue_style( $this->plugin_name . 'slider-css' );

		echo '<style>' . wpgpyg_get_options( 'wpgpyt_custom_css' ) . '</style>';

		require WPGP_YOUTUBE_GALLERY_DIR_PATH_FILE . 'public/wpgp-youtube-gallery-dynamic-styles.php';

		require WPGP_YOUTUBE_GALLERY_DIR_PATH_FILE . 'public/partials/wpgpyt-query.php';

		if ( ! empty( get_the_title( $post_id ) ) && $wpgpyg_section_title_show ) {

			echo '<h2 id="wpgpyg--section-title-' . esc_attr( $post_id ) . '">' . esc_html( get_the_title( $post_id ) ) . '</h2>';
		}

		if ( ! empty( $wpgpyg_api_key ) ) {

			switch ( $wpgpyt_display_mode ) {
				case 'gallery':
					include WPGP_YOUTUBE_GALLERY_DIR_PATH_FILE . 'public/partials/wpgpyt-gallery.php';
					break;

				case 'grid':
					include WPGP_YOUTUBE_GALLERY_DIR_PATH_FILE . 'public/partials/wpgpyt-grid.php';
					break;

				case 'slider':
					include WPGP_YOUTUBE_GALLERY_DIR_PATH_FILE . 'public/partials/wpgpyt-slider.php';
					break;

				case 'button':
					include WPGP_YOUTUBE_GALLERY_DIR_PATH_FILE . 'public/partials/wpgpyt-button.php';
					break;

				default:
					include WPGP_YOUTUBE_GALLERY_DIR_PATH_FILE . 'public/partials/wpgpyt-slider.php';
					break;
			}
		} else {

			echo '<p style="background-color: #f44336;color: #fff8dc;padding: 5px 15px;">Please set your API key here → <a style="color: #fff;text-decoration: underline;" href="' . esc_url( admin_url() ) . 'edit.php?post_type=wpgp_youtube_gallery&page=wpgpyg_settings" target="_blank">Settings Page</a></p>';
		}

		wp_enqueue_script( $this->plugin_name . 'slider-js' );

		return ob_get_clean();
	}

	/**
	 * Another shortcode only for subscribe button.
	 *
	 * @return mixed
	 */
	public function wpgp_shortcode_subscribe() {

		ob_start();

		include WPGP_YOUTUBE_GALLERY_DIR_PATH_FILE . 'public/partials/wpgpyt-subscribe.php';

		return ob_get_clean();
	}

}

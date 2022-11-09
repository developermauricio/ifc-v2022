<?php
/**
 * Plugin Name:  ERPlayer - Radio player for Elementor
 * Description: Add a radio player to the Elementor Page Builder
 * Plugin URI:  https://pro.radio
 * Version: 1.1.0
 * Author: Pro.Radio
 * Author URI: https://pro.radio
 * Text Domain: erplayer
 * Domain Path: /languages
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 
/**
 * Main Builder Class
 * The init class that runs the Elementor Radio Player Builder plugin.
 * @since 1.0.0
 */
final class Elementor_Radio_Player {
 
	/**
	 * Plugin Version
	 */
	const VERSION = '1.0.8';
 
	/**
	 * Minimum Elementor Version
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.8.4';
 
	/**
	 * Minimum PHP Version
	 */
	const MINIMUM_PHP_VERSION = '7.1';
 
	/**
	 * Constructor
	 */
	public function __construct() {
		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );
		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}
 
	/**
	 * Load Textdomain
	 */
	public function i18n() {
		load_plugin_textdomain( 'erplayer' );
	}
 
	/**
	 * Initialize the plugin
	 */
	public function init() {
 
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}
 
		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}
 
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}
 		
		// Once we get here, We have passed all validation checks so we can safely include our plugin
		include plugin_dir_path( __FILE__ ) . '/inc/backend/metaboxes/meta_box.php';
		include plugin_dir_path( __FILE__ ) . '/inc/backend/posttype/radiochannel.php';
		include plugin_dir_path( __FILE__ ) . '/inc/frontend/func/playlist-radio.php';
		include plugin_dir_path( __FILE__ ) . '/inc/frontend/func/playlist-radio-elementor.php';
		include plugin_dir_path( __FILE__ ) . '/inc/frontend/func/create-track.php';
		include plugin_dir_path( __FILE__ ) . '/inc/frontend/func/mp3streamtitle.php';
		include plugin_dir_path( __FILE__ ) . '/inc/frontend/func/proxy.php';
		include plugin_dir_path( __FILE__ ) . '/inc/frontend/player.php';
		include plugin_dir_path( __FILE__ ) . '/inc/frontend/assets.php';
		include plugin_dir_path( __FILE__ ) . '/inc/frontend/func/popup.php';
		include plugin_dir_path( __FILE__ ) . '/inc/elementor/_plugin.php';
	}
 
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
 
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'erplayer' ),
			'<strong>' . esc_html__( 'Elementor Radio Player', 'erplayer' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'erplayer' ) . '</strong>'
		);
 
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
 
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
 
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'erplayer' ),
			'<strong>' . esc_html__( 'ProRadio Builder', 'erplayer' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'erplayer' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
 
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
 
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
 
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'erplayer' ),
			'<strong>' . esc_html__( 'Elementor Radio Player', 'erplayer' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'erplayer' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);
 
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}
 
// Instantiate elementor-proradio.
new Elementor_Radio_Player();
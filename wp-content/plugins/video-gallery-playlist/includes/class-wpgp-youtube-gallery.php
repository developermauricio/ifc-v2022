<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.grandplugin.com
 * @since      1.0.0
 *
 * @package    WPGP_YouTube_Gallery
 * @subpackage WPGP_YouTube_Gallery/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WPGP_YouTube_Gallery
 * @subpackage WPGP_YouTube_Gallery/includes
 * @author     GrandPlugin <help@grandplugin.com>
 */
class WPGP_YouTube_Gallery {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WPGP_YouTube_Gallery_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

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
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WPGP_YOUTUBE_GALLERY_VERSION' ) ) {
			$this->version = WPGP_YOUTUBE_GALLERY_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'wpgp-youtube-gallery';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WPGP_YouTube_Gallery_Loader. Orchestrates the hooks of the plugin.
	 * - WPGP_YouTube_Gallery_i18n. Defines internationalization functionality.
	 * - WPGP_YouTube_Gallery_Admin. Defines all hooks for the admin area.
	 * - WPGP_YouTube_Gallery_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Autoloading system registered.
		 */
		spl_autoload_register( array( $this, 'wpgp_youtube_gallery_autoloader' ) );

		$this->loader = new WPGP_YouTube_Gallery_Loader();

	}

	/**
	 * Automatically included all of the directories by the autoloader.
	 *
	 * @param string $class_name Search all of the class name from this file.
	 * @return string
	 */
	private function wpgp_youtube_gallery_autoloader( $class_name ) {

		// Convert the class name to the file name.
		$class_file = 'class-' . str_replace( '_', '-', strtolower( $class_name ) ) . '.php';

		// Set up the list of directories to look in.
		$classes_dir   = array();
		$include_dir   = realpath( plugin_dir_path( __FILE__ ) );
		$classes_dir[] = $include_dir;

		// Add each of the possible directories to the list.
		foreach ( array( 'admin', 'public' ) as $option ) {

			$classes_dir[] = str_replace( 'includes', $option, $include_dir );
		}

		// Look in each directory and see if the class file exists.
		foreach ( $classes_dir as $class_dir ) {

			$inc = $class_dir . DIRECTORY_SEPARATOR . $class_file;

			// If it does require it.
			if ( file_exists( $inc ) ) {

				require_once $inc;
				return true;
			}
		}
		return false;
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WPGP_YouTube_Gallery_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new WPGP_YouTube_Gallery_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new WPGP_YouTube_Gallery_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Plugin admin custom post types.
		$plugin_admin_cpt = new WPGP_YouTube_Gallery_CPT( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'init', $plugin_admin_cpt, 'wpgp_custom_post_type' );
		$this->loader->add_filter( 'post_updated_messages', $plugin_admin_cpt, 'wpps_updated_messages', 10, 2 );
		$this->loader->add_action( 'admin_menu', $plugin_admin_cpt, 'wpgp_help_admin_submenu', 15 );
		$this->loader->add_action( 'admin_init', $plugin_admin_cpt, 'wpgp_safe_welcome_redirect' );
		$this->loader->add_filter( 'admin_footer_text', $plugin_admin_cpt, 'wpgp_review_text', 10, 2 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new WPGP_YouTube_Gallery_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// Plugin Shortcode.
		$plugin_shortcode = new WPGP_YouTube_Gallery_Shortcode( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wpgp_action_tag_for_shortcode', $plugin_shortcode, 'wpgp_shortcode_execute' );
		add_shortcode( 'wpgpyt_gallery', array( $plugin_shortcode, 'wpgp_shortcode_execute' ) );
		add_shortcode( 'wpgpyt_subscribe', array( $plugin_shortcode, 'wpgp_shortcode_subscribe' ) );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    WPGP_YouTube_Gallery_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

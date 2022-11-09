<?php
namespace Elementor_Radio_Player;


 
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin {
 
	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;
 
	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
					 
		return self::$_instance;
	}
 
	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		// wp_register_script( 'awesomesauce', plugins_url( '/assets/js/awesomesauce.js', __FILE__ ), [ 'jquery' ], filemtime( __FILE__ ), true );
	}




 
	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {

		// Radio widget files
		require_once( __DIR__ . '/widgets/radio/fields/functionalities.php' );
		require_once( __DIR__ . '/widgets/radio/fields/channels.php' );
		require_once( __DIR__ . '/widgets/radio/fields/backgrounds.php' );
		require_once( __DIR__ . '/widgets/radio/fields/togglebutton.php' );
		require_once( __DIR__ . '/widgets/radio/fields/settings.php' );
		require_once( __DIR__ . '/widgets/radio/fields/colors.php' );
		require_once( __DIR__ . '/widgets/radio/fields/typo.php' );
		require_once( __DIR__ . '/widgets/radio/widget-elementor-radio.php' );
		// Radio widget end
	}
 
	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Register Widgets
		$this->include_widgets_files();
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ElementorRadioPlayer() );
		

	}

	public function add_elementor_widget_categories( $elements_manager ) {
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'radioplayer',
			[
				'title' => esc_html__( 'Radio Player', 'erplayer' ),
				'icon' => 'fa fa-plug',
			]
		);
	}
 
	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
 		//Add category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ], 0 );
		// // Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		// // Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}
 
// Instantiate Plugin Class
Plugin::instance();
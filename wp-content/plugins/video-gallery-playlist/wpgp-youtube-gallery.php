<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wpqode.com
 * @since             1.0.0
 * @package           WPGP_YouTube_Gallery
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress YouTube Gallery
 * Plugin URI:        https://wpqode.com/plugins/wordpress-youtube-gallery/
 * Description:       This plugin shows gallery or slider form your YouTube channel or playlist.
 * Version:           1.3.0
 * Author:            WPQode
 * Author URI:        https://wpqode.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpgp-youtube-gallery
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define global constants.
 */
$wpgpyg_plugin_data = get_file_data(
	__FILE__,
	array(
		'version' => 'Version',
	)
);
define( 'WPGP_YOUTUBE_GALLERY_VERSION', $wpgpyg_plugin_data['version'] );
define( 'WPGP_YOUTUBE_GALLERY_DIR_PATH_FILE', plugin_dir_path( __FILE__ ) );
define( 'WPGP_YOUTUBE_GALLERY_DIR_URL_FILE', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpgp-youtube-gallery-activator.php
 */
function activate_wpgp_youtube_gallery() {
	/**
	 * When the plugin is activated, a transient gets added.
	 * Transient max age is 60 seconds.
	 */
	set_transient( '_wpgp_safe_redirect', true, 60 );

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpgp-youtube-gallery-activator.php';
	WPGP_YouTube_Gallery_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpgp-youtube-gallery-deactivator.php
 */
function deactivate_wpgp_youtube_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpgp-youtube-gallery-deactivator.php';
	WPGP_YouTube_Gallery_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpgp_youtube_gallery' );
register_deactivation_hook( __FILE__, 'deactivate_wpgp_youtube_gallery' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpgp-youtube-gallery.php';

/**
 * WPGP Framework.
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/wpgp-framework/classes/setup.class.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/wpgp-framework/metabox/init.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/wpgp-framework/metabox/general.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/wpgp-framework/metabox/controls.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/wpgp-framework/metabox/typography.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/wpgp-framework/metabox/shortcode.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/wpgp-framework/option/settings.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpgp_youtube_gallery() {

	$plugin = new WPGP_YouTube_Gallery();
	$plugin->run();

}
run_wpgp_youtube_gallery();

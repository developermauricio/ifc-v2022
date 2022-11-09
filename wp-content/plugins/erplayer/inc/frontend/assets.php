<?php
/**
 * @package WordPress
 * @subpackage Elemento Radio Player
 * @version 1.0.0
*/

/**
 * Enqueue frontend assets
 */

if(!function_exists('erplayer_frontend_assets')){
	add_action("wp_enqueue_scripts",'erplayer_frontend_assets');
	function erplayer_frontend_assets(){

		// Get version
		if ( is_admin() ) {
			$plugin_data = get_plugin_data( __FILE__ );
			$ver = $plugin_data['Version'];
		} else {
			$ver = get_file_data( __FILE__ , array('Version'), 'plugin');
		}

		// JS
		$deps = array('jquery', 'jquery-ui-core', 'jquery-ui-widget');
		wp_enqueue_script( 'jquery-marquee', plugins_url('/assets/js/jquery.marquee.js' , __FILE__ ), $deps, $ver, true );  $deps[] = 'jquery-marquee';
		wp_enqueue_script( 'erplayer-frontend', plugins_url('/assets/js/erplayer-frontend-min.js' , __FILE__ ), $deps, $ver, true ); 
		
		// CSS
		wp_enqueue_style( "erplayer-frontend",plugins_url('/assets/css/erplayer.css'	, __FILE__ ), false, $ver, "all" );
		wp_enqueue_style( "erplayer-icons",plugins_url('/assets/font/erplayer-icons/styles.css'	, __FILE__ ), false, $ver, "all" );
	}
}

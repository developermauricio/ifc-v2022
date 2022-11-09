<?php
/**
 * @package WordPress
 * @subpackage Elemento Radio Player
 * @version 1.0.0
*/  



/**
 * =============================================|
 * WHAT IS THIS FILE?							|
 * ---------------------------------------------|
 * This is a built-in server side proxy to read |
 * web radio feed data from servers that 		|
 * doesn't have the proper CORS settings.		|
 * 												|
 * The ajax call will be redirected to wordpress|
 * and processed via server with a straight 	|
 * output.										|
 * _____________________________________________|
 * */

/** 
 * =============================================
 * Radio proxy function
 * ---------------------------------------------
 * If the GET parameter is passes, containing an
 * url to read, the content will be red server 
 * side and presented to the javascript
 * =============================================
 * */

if( !function_exists( 'erplayer_proxy' ) ){
	add_action( 'init', 'erplayer_proxy', 1 );
	function erplayer_proxy(){
		if( isset($_GET)){
			if(array_key_exists('qtproxycall',$_GET)){
				$urlReal = base64_decode( $_GET['qtproxycall'] );
				if( !array_key_exists('icymetadata', $_GET) ){
					$data = wp_remote_get( $urlReal );
					if ( is_array( $data ) ) {
						echo $data['body'];
						die();
					}
				} else {
					// ICY metadata
					die( erplayer_getMp3StreamTitle($urlReal) );
				}
				die('Unauthorized call');
			} 
		}
	}
}

/**
 * =============================================
 * This will output an item containing the proxy URL, 
 * hat will be used by javascript for the ajax calls
 * =============================================
 * */

if( !function_exists('erplayer_add_proxy_param')){
	add_action("wp_footer", "erplayer_add_proxy_param");
	function erplayer_add_proxy_param(){
		?>
		<div id="erplayer-radiofeed-proxyurl" class="qt-hidden" data-proxyurl="<?php echo site_url(); ?>"></div>
		<?php  
	}
}
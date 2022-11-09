<?php
/**
 * @package WordPress
 * @subpackage Elemento Radio Player
 * @version 1.0.0
*/

if(!function_exists('erplayer_popup')){
	add_action('init', 'erplayer_popup');
	function erplayer_popup(){
		if(isset($_GET)){
			if(array_key_exists('erplayerpopup', $_GET) ){
				$playerdata = base64_decode( $_GET[ 'erplayerpopup' ] );
				$data = json_decode( $playerdata, true );
				ob_start();
				?>
				<!doctype html>
				<html class="no-js" <?php language_attributes(); ?>>
					<head>
						<meta charset="<?php bloginfo( 'charset' ); ?>">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<?php wp_head(); ?>
					</head>
					<body>
						<?php 
						$erp_radio_channels = json_decode( $data['radioChannelsPopup'], true);
						$data['erp_radio_channels'] = $erp_radio_channels;
						/**
						 * Troubleshooting control
						 */
					
						echo erplayer_player($data);
						wp_footer(); 
						?>
					</body>
				</html>
				<?php  
				echo ob_get_clean();
				die();	
			}
		}
		return;
	}
}


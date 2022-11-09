<?php
/**
 * @package WordPress
 * @subpackage Elemento Radio Player
 * @version 1.0.0
*/

if(!function_exists('erplayer_playlist_radio_elementor')){
	function erplayer_playlist_radio_elementor( $channels ){
		ob_start();
		if( !is_array( $channels ) ){
			return;
		}
		if(count($channels) == 0 ){
			return;
		}
		foreach( $channels as $radio ){
			if( !array_key_exists('erpc_mp3', $radio)){
				continue;
			}
			if( $radio['erpc_mp3'] == ''){
				continue;
			}
			$file = $radio['erpc_mp3'];
			$erplayer_logo = get_post_meta( $id, 'erplayer_logo', true );

			if(array_key_exists('erpc_logo', $radio)){
				$radio['erpc_logo'] = $radio['erpc_logo']['url'];
			}
			$track_data = array(
				'title'					=> $radio['erpc_title'],
				'img_id' 				=> false,
				'pic'					=> $radio['erpc_logo'],
				'thumbnail_url'			=> $radio['erpc_logo'],
				'artwork'				=> $radio['erpc_logo'],
				'artist'				=> false,
				'link'					=> false,
				'file'					=> trim( $file ),
				'type'					=> "radio",
				'album'					=> $radio['erpc_subtitle'],
				'server_type'			=> $radio['erpc_servertype'],
				'shoutcast_channel' 	=> $radio['erpc_shoutcast_channel'],
				'shoutcast_host' 		=> $radio['erpc_shoutcast_host'],
				'shoutcast_port' 		=> $radio['erpc_shoutcast_port'],
				'shoutcast_protocol'	=> $radio['erpc_shoutcast_protocol'],
				'icecast_url' 			=> $radio['erpc_icecasturl'],
				'icecast_mountpoint' 	=> $radio['erpc_icecast_mountpoint'],
				'icecast_channel' 		=> $radio['erpc_icecast_channel'],
				'radiodotco'			=> $radio['erpc_radiodotco'],
				'airtime'				=> $radio['erpc_airtime'],
				'radionomy_userid' 		=> $radio['erpc_radionomy_userid'],
				'radionomy_apikey' 		=> $radio['erpc_radionomy_apikey'],
				'live365' 				=> $radio['erpc_live365'],
				'textfeed' 				=> $radio['erpc_textfeed'],
				'use_proxy' 			=> $radio['erpc_useproxy'],
			);
			erplayer_create_track( $track_data );
			
		}
		return ob_get_clean();
	}
}




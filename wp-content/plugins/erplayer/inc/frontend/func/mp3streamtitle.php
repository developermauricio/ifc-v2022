<?php
/**
 * @package WordPress
 * @subpackage Elemento Radio Player
 * @version 1.0.0
*/  


/**
 * Attempt to get the song titles from the icy headers
 * // Example request: ?qtproxycall=[STREAM URL AUDIO HERE]&icymetadata=1
 */

function erplayer_getMp3StreamTitle($steam_url)
{
	$debug = 0; // set to 1 to test the radio streaming output
	$result =  esc_html__('No titles available','erplayer');
	$icy_metaint = -1;
	$needle = 'StreamTitle=';
	$ua = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36';
	$opts = array(
		'http' => array(
			'method' => 'GET', 
			'header' => 'Icy-MetaData: 1', 
			'user_agent' => $ua
		),
		"ssl"=>array(
			'allow_self_signed' => true,
		    "verify_peer" => false,
		    "verify_peer_name" => false,
		)
	);

	$default = stream_context_set_default($opts);

	if( !$stream = fopen($steam_url, 'r')  ){
		return esc_html__('Cannot open the stream', 'erplayer');
	}
	if ($stream && ($meta_data = stream_get_meta_data($stream)) && isset($meta_data['wrapper_data'])) {
		foreach ($meta_data['wrapper_data'] as $header) {
			if (strpos(strtolower($header), 'icy-metaint') !== false) {
				$tmp = explode(":", $header);
				$icy_metaint = trim($tmp[1]);
				break;
			}
		}
		
		if ($icy_metaint != -1) {
			$buffer = stream_get_contents($stream, 300, $icy_metaint);
			if (strpos($buffer, $needle) !== false) {
				$title = explode($needle, $buffer);
				$title = trim($title[1]);
				if( $title !== ''){
					$result = substr($title, 1, strpos($title, ';') - 2);
				} 
			}
		} 
		if ($stream) {
			fclose($stream);
		}
	}
	return $result;
}

<?php
/**
 * @package WordPress
 * @subpackage Elemento Radio Player
 * @version 1.0.0
*/

if(!function_exists('erplayer_playlist_radio')){
	function erplayer_playlist_radio(){
		ob_start();
		$args = array(
			'post_type' => erplayer_radiochannel_name(),
			'ignore_sticky_posts' => 1,
			'post_status' => 'publish',
			'orderby' => array ( 'menu_order' => 'ASC', 'date' => 'DESC'),
			'suppress_filters' => false,
			'posts_per_page' => -1,
			'paged' => 1,
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'erplayer_exclude',
					'compare' => 'NOT EXISTS'
				),
				array(
					'key' => 'erplayer_exclude',
					'value' => false,
					'compare' => '='
				),
				
			)
		);
		$wp_query = new WP_Query( $args );
		if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$post = $wp_query->post;
			setup_postdata( $post );

			/**
			 * Radio item loaded in the playlist
			 */
			$id = $post->ID;
			$file = get_post_meta( $id, 'erplayer_mp3', true );
			
			if( $file ){
				$erplayer_logo = get_post_meta( $id, 'erplayer_logo', true );
				$track_data = array(
					'title'					=> $post->post_title,
					'img_id' 				=> $erplayer_logo,
					'artist'				=> false,
					'link'					=> get_the_permalink( $post->ID ),
					'file'					=> trim( $file ),
					'type'					=> "radio",
					'album'					=> get_post_meta($id, 'erplayer_subtitle',true),
					'server_type'			=> get_post_meta($id, 'erplayer_servertype',true),
					'shoutcast_channel' 	=> get_post_meta( $id, 'erplayer_shoutcast_channel',true ),
					'shoutcast_host' 		=> get_post_meta( $id, 'erplayer_shoutcast_host',true ),
					'shoutcast_port' 		=> get_post_meta( $id, 'erplayer_shoutcast_port',true ),
					'shoutcast_protocol'	=> get_post_meta( $id, 'erplayer_shoutcast_protocol',true ),
					'icecast_url' 			=> get_post_meta( $id, 'erplayer_icecasturl',true ),
					'icecast_mountpoint' 	=> get_post_meta( $id, 'erplayer_icecast_mountpoint',true ),
					'icecast_channel' 		=> get_post_meta( $id, 'erplayer_icecast_channel',true ),
					'radiodotco'			=> get_post_meta( $id, 'erplayer_radiodotco',true ),
					'airtime'				=> get_post_meta( $id, 'erplayer_airtime',true ),
					'radionomy_userid' 		=> get_post_meta( $id, 'erplayer_radionomy_userid',true ),
					'radionomy_apikey' 		=> get_post_meta( $id, 'erplayer_radionomy_apikey',true ),
					'live365' 				=> get_post_meta( $id, 'erplayer_live365',true ),
					'textfeed' 				=> get_post_meta( $id, 'erplayer_textfeed',true ),
					'use_proxy' 			=> get_post_meta( $id, 'erplayer_useproxy',true ),
				);
				erplayer_create_track( $track_data );
			}
			wp_reset_postdata();
		endwhile; endif;
		wp_reset_postdata();
		return ob_get_clean();
	}
}




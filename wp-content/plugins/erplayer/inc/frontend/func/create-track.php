<?php
/**
 * @package WordPress
 * @subpackage Elemento Radio Player
 * @version 1.0.0
*/

if(!function_exists('erplayer_create_track')){
	function erplayer_create_track( $trackData ) {

		ob_start();
		extract( 
			shortcode_atts( 
				array(
					'pic' => '',
					'thumbnail_url'  => false,
					'img_id' 				=> false,
					'title'					=> false,
					'artist'				=> false,
					'album'					=> false,
					'link'					=> false,
					'file'					=> false,
					'type'					=> "track",
					'shoutcast_channel' 	=> '',
					'shoutcast_host' 		=> false,
					'shoutcast_port' 		=> false,
					'shoutcast_protocol'	=> false,
					'icecast_url' 			=> false,
					'icecast_mountpoint' 	=> false,
					'icecast_channel' 		=> false,
					'radiodotco'			=> false,
					'airtime'				=> false,
					'radionomy_userid' 		=> false,
					'radionomy_apikey'		=> false,
					'live365' 				=> false,
					'textfeed' 				=> false,
					'use_proxy' 			=> false,
					), 
				$trackData 
			) 
		);


		/**
		 * Find icon and cover
		 */
		// $pic = '';
		// $thumbnail_url  = false;
		if($img_id){
			// Attachment ID
			if( is_attachment($img_id) ){
				$tinythumb = false;
				$tinythumb = wp_get_attachment_image_src($img_id,'post-thumbnail');
				$pic = wp_get_attachment_image_src($img_id,'medium');
				$pic = $pic[0];
				$thumbnail_url = $tinythumb[0];
			// Featured image
			} else {
				if( has_post_thumbnail( $img_id )) {
					$pic = get_the_post_thumbnail_url(null, array(370,370)); 
					$tinythumb = get_the_post_thumbnail_url(null, array(70,70));
					$thumbnail_url = $tinythumb;
				} else if ( wp_get_attachment_image_src($img_id, array(370,370) ) ){
					$pic = wp_get_attachment_image_src($img_id, array(370,370) );
					$pic = $pic[0];
					$tinythumb = wp_get_attachment_image_src($img_id, array(70,70) );
					$thumbnail_url = $tinythumb[0];
				}
			}
			$trackData['artwork'] = $pic;
		}

		$data = json_encode( array_filter( $trackData ) );
		?>
		<li>
			<span data-erplayer-trackdata="<?php echo esc_attr( $data ); ?>" class="erplayer__btn erplayer__playlist__cover">
				<?php if( $thumbnail_url ){ ?><img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="cover"><?php } ?>
				<i class="erplayer-icon-play erplayer-playIcon"></i>
				<i class="erplayer-icon-pause erplayer-pauseIcon"></i>
			</span>
			<h5><?php if($artist){  echo esc_html( $artist ); }; if($artist && $title){ echo '-'; }  if($title){  echo esc_html( $title ); } ?></h5>
		</li>
		<?php  
		echo ob_get_clean();
	}
}
?>
<?php

wp_enqueue_script( $this->plugin_name . 'spidochetube' );
if ( 'scroll' === $wpgpyt_gallery_theme ) {

	wp_enqueue_style( $this->plugin_name . 'darkscroll' );
	wp_enqueue_script( $this->plugin_name . 'nicescroll' );
} else {

	wp_enqueue_style( $this->plugin_name . 'minimal' );
}

if ( ! empty( $wpgpyg_first_video_id ) ) {

	?>

<script>
	(function( $ ) {
	'use strict';

		$( document ).ready(function() {

			var wpgpygAPIkey    = '<?php echo esc_html( $wpgpyg_api_key ); ?>';
			var wpgpygListID    = '<?php echo esc_html( $wpgpyg_playlist_id ); ?>';
			var wpgpygMaxResult = '<?php echo esc_html( $wpgpyg_max_result ); ?>';

			$('#youtube').spidochetube({
				key             : wpgpygAPIkey, // API Key
				id              : wpgpygListID, // Playlist ID
				max_results     : wpgpygMaxResult,
				paging          : 'loadmore',
				scroll_duration : 500,
				complete: function(){
					// Initialize the scroll plugin after the playlist is ready
					$('#spidochetube_list').niceScroll({cursorcolor:'#666', cursorborder:'0px solid #fff',autohidemode:false});
				}
			});

			$('.venobox').venobox();
		});

	})( jQuery );
</script>

<style>
	#spidochetube_list li img {
		display: inline-block;
	}
</style>

<div id="youtube" class="spidochetube"></div>

	<?php

} else {

	echo '<ul>';
	foreach ( $wpgpyg_get_videos->error->errors[0] as $wpgpyg_error ) {

		echo '<li>' . esc_html( $wpgpyg_error ) . '</li>';
	}
	echo '</ul>';
}

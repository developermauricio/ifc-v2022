<?php

wp_enqueue_style( $this->plugin_name . 'venobox' );
wp_enqueue_script( $this->plugin_name . 'venobox' );

?>

<style>
.vbox-content iframe {
	margin: 0 auto;
}
.wpgpyt-btn {
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
	text-decoration: none;
	padding: 10px 20px;
	color: #fff;
	background-color: #dc3545;
}
.wpgpyt-btn:hover {
	box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}
</style>

<script>
jQuery(function($) {

	$('.venobox').venobox();
});
</script>

<div id="wpgpyt-single-button-<?php echo esc_attr( $post_id ); ?>">
	<a class="venobox wpgpyt-btn" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=<?php echo esc_html( $wpgpyt_single_id ); ?>">
	<?php echo esc_html( $wpgpyt_single_btn_txt ); ?>
	</a>
</div>

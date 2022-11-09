<?php

wp_enqueue_style( $this->plugin_name . 'swiper' );
wp_enqueue_script( $this->plugin_name . 'swiper' );

?>

<style>
.swiper-container {
	width: 80%;
	height: 80%;
}
.swiper-slide {
	background-position: center;
	background-size: contain;
	background-repeat: no-repeat;
	cursor: pointer;
	height: auto;
	background: aliceblue;
}
.wpgpyg--wrapper {
	background: rgba(0,0,0,0.55);
	width: 50px;
	height: 24px;
	border-radius: 5px;
	padding-top: 10px;
	margin-top: -10px;
	position: absolute;
	top: 50%;
	left: 50%;
	-webkit-transform: translate(-50%);
	-ms-transform: translate(-50%);
	transform: translate(-50%);
}
.swiper-slide:hover .wpgpyg--wrapper {
	background: #cd201f;
}
.wpgpyg--tri {
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 7px 0 7px 14px;
	border-color: transparent transparent transparent #ffffff;
	margin: 0 auto;
}
.swiper-pagination {
	position: relative !important;
}
.swiper-pagination .swiper-pagination-bullet{
	margin: 0 3px;
}
.wpgp--video-container {
	overflow: hidden;
	position: relative;
	width: 80%;
	padding-bottom: 15px;
	margin: 0 auto;
	margin-bottom: 10px;
}
.wpgp--video-container::after {
	padding-top: 56.25%;
	display: block;
	content: '';
}
.wpgp--video-container iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
.swiper-slide img {
	width: 100%;
}
.wpgpyt-slider-thumb {
	position: relative;
}
.swiper-slide h3 {
	margin: 0;
	padding: 10px;
	font-size: 17px;
	line-height: 20px;
	font-weight: bold;
	text-align: center;
}
</style>
<!-- Swiper -->
<div id="wpgp--youtube-gallery-<?php echo esc_attr( $post_id ); ?>" class="wpgp--youtube-gallery">
	<div class="wpgp--video-container">
		<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_html( $wpgpyg_first_video_id ); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
	<div class="swiper-container">
		<div class="swiper-wrapper">
		<?php
		foreach ( $wpgpyg_get_videos->items as $wpgpyg_video ) :
			if ( 'playlist' === $wpgpyt_video_from ) {

				// Playlist.
				$wpgpyg_video_id = $wpgpyg_video->snippet->resourceId->videoId;
			} else {

				// Channel.
				$wpgpyg_video_id = $wpgpyg_video->id->videoId;
			}
			?>
			<div class="swiper-slide" data-video-id="<?php echo esc_html( $wpgpyg_video_id ); ?>">
				<div class="wpgpyt-slider-thumb">
					<img src="<?php echo esc_url( $wpgpyg_video->snippet->thumbnails->high->url ); ?>" alt="<?php echo esc_attr( $wpgpyg_video->snippet->title ); ?>" />
					<div class="wpgpyg--wrapper">
						<div class="wpgpyg--tri"></div>
					</div>
				</div>
				<?php
				if ( $wpgpyt_video_title_show ) {

					echo '<h3>' . esc_html( $wpgpyg_video->snippet->title ) . '</h3>';
				}
				?>
			</div>
			<?php endforeach; ?>
		</div>

		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
	<!-- Add Pagination -->
	<div class="swiper-pagination"></div>
</div>

<!-- Initialize Swiper -->
<script>
	(function( $ ) {
	'use strict';

		$( document ).ready(function() {

			$("div.wpgp--youtube-gallery").each(function () {
				var _theGallery = $(this).attr("id");

				$("#" + _theGallery + " .swiper-slide").click(function () {

					var _videoID = $(this).data("video-id");
					console.log(_videoID);
					$("#" + _theGallery + " iframe").attr("src", "https://www.youtube.com/embed/" + _videoID).fadeOut("fast").fadeIn("slow");
				});

			});

			var swiper = new Swiper('.swiper-container', {
				slidesPerView: 3,
				spaceBetween: 10,
				pagination: {
					el: '.swiper-pagination',
					clickable: true
				},
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				// Responsive breakpoints
				breakpoints: {
					// when window width is >= 320px
					320: {
					slidesPerView: 2,
					spaceBetween: 10
					},
					// when window width is >= 480px
					480: {
					slidesPerView: 2,
					spaceBetween: 20
					},
					// when window width is >= 640px
					640: {
					slidesPerView: 3,
					spaceBetween: 10
					}
				}
			});
		});

	})( jQuery );
</script>

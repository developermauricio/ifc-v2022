<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.grandplugin.com
 * @since      1.0.0
 *
 * @package    WPGP_YouTube_Gallery
 * @subpackage WPGP_YouTube_Gallery/public/partials
 */

wp_enqueue_style( $this->plugin_name . 'venobox' );
wp_enqueue_script( $this->plugin_name . 'venobox' );

?>

<style>
.wpgpyt--card {
	background: white;
	margin-bottom: 2em;
}

.wpgpyt--card a {
	color: black;
	text-decoration: none;
}

.wpgpyt--card a:hover {
	box-shadow: 3px 3px 8px hsl(0, 0%, 80%);
}

.wpgpyt--card-content {
	padding: 1.4em;
}

.wpgpyt--card-content h2 {
	margin-top: 0;
	margin-bottom: .5em;
	font-weight: bold;
}

.wpgpyt--card-content p {
	font-size: 80%;
}

/* Flexbox stuff */

.wpgpyt--cards {
	display: flex;
	flex-wrap: wrap;
}

.wpgpyt--card {
	flex: 1 0 500px;
	box-sizing: border-box;
	margin: 1rem .25em;
}

@media screen and (min-width: 40em) {
	.wpgpyt--card {
		max-width: calc(50% -  1em);
	}
}

@media screen and (min-width: 60em) {
	.wpgpyt--card {
		max-width: calc(33% - 1em);
	}
}

.centered {
	margin: 0 auto;
	padding: 0 1em;
}

@media screen and (min-width: 52em) {
	.centered {
		max-width: 52em;
	}
}

/* Youtube Play Button */
picture.wpgpyt--thumbnail {
	position: relative;
	display: block;
}
.wpgpyg--wrapper {
	background: rgba(0,0,0,0.55);
	width: 50px;
	height: 34px;
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
picture.wpgpyt--thumbnail:hover .wpgpyg--wrapper {
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

/* Centering the venobox iframe */
.vbox-content iframe {
	margin: 0 auto;
}
</style>

<script>
jQuery(function($) {

	$('.venobox').venobox();
});
</script>

<section id="wpgpyg--grid-<?php echo $post_id; ?>" class="wpgpyt--cards">

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
	<article class="wpgpyt--card">

		<a class="venobox" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=<?php echo esc_html( $wpgpyg_video_id ); ?>">
			<picture class="wpgpyt--thumbnail">
				<img src="<?php echo esc_url( $wpgpyg_video->snippet->thumbnails->high->url ); ?>" alt="<?php echo esc_attr( $wpgpyg_video->snippet->title ); ?>">
				<div class="wpgpyg--wrapper">
					<div class="wpgpyg--tri"></div>
				</div>
			</picture>
		</a>

		<?php if ( $wpgpyg_video_title_show || $wpgpyg_video_desc_show ) : ?>
		<div class="wpgpyt--card-content">

			<?php if ( $wpgpyg_video_title_show ) : ?>
			<a class="venobox" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=<?php echo esc_html( $wpgpyg_video_id ); ?>">
				<h2><?php echo esc_html( $wpgpyg_video->snippet->title ); ?></h2>
			</a>
			<?php endif; ?>

			<?php if ( $wpgpyg_video_desc_show ) : ?>
			<p class="wpgpyt--desc"><?php echo esc_textarea( wp_trim_words( $wpgpyg_video->snippet->description, $wpgpyg_video_desc_length ) ); ?></p>
			<?php endif; ?>
		</div><!-- .card-content -->
		<?php endif; ?>

	</article><!-- .card -->
	<?php endforeach; ?>

</section><!-- .cards -->

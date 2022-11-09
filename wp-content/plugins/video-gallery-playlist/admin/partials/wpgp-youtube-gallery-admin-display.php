<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.grandplugin.com
 * @since      1.0.0
 *
 * @package    WPGP_YouTube_Gallery
 * @subpackage WPGP_YouTube_Gallery/admin/partials
 */

?>

<!-- Help Page -->
<div class="wrap about-wrap wpgp--help">
	<h1><?php esc_html_e( 'Welcome to YouTube Gallery!', 'wpgp-youtube-gallery' ); ?></h1>
	<p class="about-text"><span class="text">
		<?php
			esc_html_e( 'Thank you for installing YouTube Gallery! You\'re now running the most popular YouTube Gallery premium plugin.', 'wpgp-youtube-gallery' );
		?>
		</span><span class="help-badge"></span>
	</p>
	<hr>
	<!-- <div class="headline-feature feature-video">
		<iframe width="560" height="315" src="https://www.youtube.com/embed/2R16tCBOw-s" frameborder="0" allowfullscreen></iframe>
	</div>
	<hr> -->
	<div class="feature-section three-col">
		<div class="col">
			<div class="wpgp--feature wpgp--text-center">
				<i class="sp-font fa fa-life-ring"></i>
				<h3><?php esc_html_e( 'Need any Assistance?', 'wpgp-youtube-gallery' ); ?></h3>
				<p><?php esc_html_e( 'Our Expert Support Team is always ready to help you out promptly.', 'wpgp-youtube-gallery' ); ?></p>
				<a href="https://grandplugin.com/submit-ticket/" target="_blank" class="button button-primary"><?php esc_html_e( 'Contact Support', 'wpgp-youtube-gallery' ); ?></a>
			</div>
		</div>
		<div class="col">
			<div class="wpgp--feature wpgp--text-center">
				<i class="sp-font fa fa-file-text" aria-hidden="true"></i>
				<h3><?php esc_html_e( 'Looking for Documentation?', 'wpgp-youtube-gallery' ); ?></h3>
				<p><?php esc_html_e( 'We have detailed documentation on every aspect of YouTube Gallery.', 'wpgp-youtube-gallery' ); ?></p>
				<a href="https://grandplugin.com/docs/" target="_blank" class="button button-primary"><?php esc_html_e( 'Documentation', 'wpgp-youtube-gallery' ); ?></a>
			</div>
		</div>
		<div class="col">
			<div class="wpgp--feature wpgp--text-center">
				<i class="sp-font fa fa-heart" aria-hidden="true"></i>
				<h3><?php esc_html_e( 'Love This Plugin?', 'wpgp-youtube-gallery' ); ?></h3>
				<p><?php esc_html_e( 'If you love YouTube Gallery, please leave us a 5 star rating.', 'wpgp-youtube-gallery' ); ?></p>
				<a href="https://wordpress.org/plugins/search/grandplugin/" target="_blank"
					class="button button-primary"><?php esc_html_e( 'Rate the Plugin', 'wpgp-youtube-gallery' ); ?></a>
			</div>
		</div>
	</div>
	<hr>
	<div class="plugin-section">
		<div class="sp-plugin-section-title">
			<h2><?php esc_html_e( 'Take your website beyond the typical with more premium plugins!', 'wpgp-youtube-gallery' ); ?></h2>
			<h4><?php esc_html_e( 'Some more premium plugins are ready to make your website awesome.', 'wpgp-youtube-gallery' ); ?></h4>
		</div>
		<div class="three-col">
			<div class="col">
				<div class="wpgp--plugin">
					<img src="<?php echo esc_url( WPGP_YOUTUBE_GALLERY_DIR_URL_FILE . '/admin/img/wordpress-post-slider-card.jpg' ); ?>"
						alt="WordPress Post Slider">
					<div class="wpgp--plugin-content">
						<h3><?php esc_html_e( 'WordPress Post Slider', 'wpgp-youtube-gallery' ); ?></h3>
						<p><?php esc_html_e( 'The most versatile and industry leading WordPress post slider plugin built to create and manage WordPress posts with excellent design and multiple options. To know more click the button below.', 'wpgp-youtube-gallery' ); ?></p>
						<a href="https://www.grandplugin.com/plugins/" target="_blank" class="button"><?php esc_html_e( 'View Details', 'wpgp-youtube-gallery' ); ?></a>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="wpgp--plugin">
					<img src="<?php echo esc_url( WPGP_YOUTUBE_GALLERY_DIR_URL_FILE . '/admin/img/covid-19-visualization-card.jpg' ); ?>"
						alt="Covid-19 Visualizations">
					<div class="wpgp--plugin-content">
						<h3><?php esc_html_e( 'Covid-19 Visualizations', 'wpgp-youtube-gallery' ); ?></h3>
						<p><?php esc_html_e( 'Free live mobile-friendly Covid-19 Visualizations plugin for WordPress. Display the current situation with an easy Shortcode Generator. Highly customizable. No Coding Required!' ); ?></p>
						<a href="https://www.grandplugin.com/plugins/" target="_blank" class="button"><?php esc_html_e( 'View Details', 'wpgp-youtube-gallery' ); ?></a>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="wpgp--plugin">
					<img src="<?php echo esc_url( WPGP_YOUTUBE_GALLERY_DIR_URL_FILE . '/admin/img/wordpress-youtube-gallery-card.jpg' ); ?>"
						alt="WordPress YouTube Gallery">
					<div class="wpgp--plugin-content">
						<h3><?php esc_html_e( 'WordPress YouTube Gallery', 'wpgp-youtube-gallery' ); ?></h3>
						<p><?php esc_html_e( 'The best responsive and API based Gallery plugin for WordPress with a lot of customization options. It helps you to display videos from YouTube Channel, Playlist, Live Stream on your site.', 'wpgp-youtube-gallery' ); ?></p>
						<a href="https://www.grandplugin.com/plugins/" target="_blank" class="button"><?php esc_html_e( 'View Details', 'wpgp-youtube-gallery' ); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

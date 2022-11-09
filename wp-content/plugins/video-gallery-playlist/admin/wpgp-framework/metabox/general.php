<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Create a section
//
WPGP::createSection(
	$wpgp_page_opts,
	array(
		'title'  => __( 'General', 'wpgp-youtube-gallery' ),
		'icon'   => 'fa fa-puzzle-piece',
		'fields' => array(

			array(
				'type'    => 'content',
				'content' => '<div class="wpgp--menu-detail">
									<strong>General</strong>
									<a href="https://www.grandplugin.com/support-forum/" target="_blank" class="">Need Help?</a>
									<br>
									<p>General settings connecting the most important part of this plugin. You must have to set the API key before come with those settings. There are 4 display mode are available in General settings. And two methods for retrieving the videos. All the settings are based on latest YouTube data API systems.</p>
								</div>',
			),

			array(
				'id'         => 'wpgpyg_section_title_show',
				'type'       => 'switcher',
				'title'      => __( 'Show the section title', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Show/Hide the section title.', 'wpgp-youtube-gallery' ),
				'text_on'    => __( 'Show', 'wpgp-youtube-gallery' ),
				'text_off'   => __( 'Hide', 'wpgp-youtube-gallery' ),
				'text_width' => 75,
				'default'    => true,
			),
			array(
				'id'         => 'wpgpyg_section_title_margin_bottom',
				'type'       => 'slider',
				'title'      => __( 'Section Title Margin Bottom', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Set margin bottom form section title.', 'wpgp-youtube-gallery' ),
				'unit'       => 'px',
				'default'    => 10,
				'dependency' => array( 'wpgpyg_section_title_show', '==', 'true' ),
				'class'      => 'wpgp--width-50',
			),
			array(
				'id'       => 'wpgpyt_display_mode',
				'type'     => 'button_set',
				'title'    => __( 'Display Mode', 'wpgp-youtube-gallery' ),
				'subtitle' => __( 'Set a display mode.', 'wpgp-youtube-gallery' ),
				'options'  => array(
					'gallery' => __( 'Gallery', 'wpgp-youtube-gallery' ),
					'grid'    => __( 'Grid', 'wpgp-youtube-gallery' ),
					'slider'  => __( 'Slider', 'wpgp-youtube-gallery' ),
					'button'  => __( 'Button', 'wpgp-youtube-gallery' ),
				),
				'default'  => 'gallery',
			),
			array(
				'id'          => 'wpgpyt_display_width',
				'type'        => 'spacing',
				'title'       => __( 'Gallery Width', 'wpgp-youtube-gallery' ),
				'subtitle'    => __( 'Gallery maximum width in responsive view.', 'wpgp-youtube-gallery' ),
				'top_icon'    => '<i class="fa fa-desktop"></i>',
				'right_icon'  => '<i class="fa fa-laptop"></i>',
				'bottom_icon' => '<i class="fa fa-tablet"></i>',
				'left_icon'   => '<i class="fa fa-mobile-phone"></i>',
				'default'     => array(
					'top'    => '100', // Desktop.
					'right'  => '80', // Laptop.
					'bottom' => '70', // Tablet.
					'left'   => '60', // Mobile.
					'unit'   => '%',
				),
				'dependency'  => array( 'wpgpyt_display_mode', '==', 'slider' ),
				'class'       => 'wpgp--no-placeholder',
			),
			array(
				'id'         => 'wpgpyt_grid_column',
				'type'       => 'spinner',
				'title'      => __( 'Grid Column', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Specifies the maximum number of column for grid display mode.', 'wpgp-youtube-gallery' ),
				'min'        => 1,
				'max'        => 5,
				'default'    => 3,
				'dependency' => array( 'wpgpyt_display_mode', '==', 'grid' ),
			),
			array(
				'id'          => 'wpgpyt_video_from',
				'type'        => 'select',
				'title'       => __( 'Video From', 'wpgp-youtube-gallery' ),
				'subtitle'    => __( 'Select a method to display video from.', 'wpgp-youtube-gallery' ),
				'placeholder' => 'Select an option',
				'options'     => array(
					'channel'  => 'Channel',
					'playlist' => 'Playlist',
				),
				'default'     => 'playlist',
				'dependency'  => array( 'wpgpyt_display_mode', '!=', 'button' ),
			),
			array(
				'id'         => 'wpgpyt_channel_id',
				'type'       => 'text',
				'title'      => __( 'Channel ID', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Set your channel ID.', 'wpgp-youtube-gallery' ),
				'desc'       => 'To get your channel ID:<br>Visit → <a href="https://www.youtube.com/account_advanced">YouTube Account Advanced settings</a>',
				'default'    => 'UC3pV6eELigzhTjzBUPmT6_A',
				'dependency' => array( 'wpgpyt_display_mode|wpgpyt_video_from', '!=|==', 'button|channel' ),
			),
			array(
				'id'          => 'wpgpyt_playlist_id',
				'type'        => 'text',
				'title'       => __( 'Playlist ID', 'wpgp-youtube-gallery' ),
				'subtitle'    => __( 'Set your playlist ID.', 'wpgp-youtube-gallery' ),
				'placeholder' => __( 'https://www.youtube.com/playlist?list=', 'wpgp-youtube-gallery' ),
				'desc'        => 'View all <a href="https://www.youtube.com/view_all_playlists">Playlists</a>',
				'default'     => 'PLVODYj2uxE85hAENw39bxUBC0K3xRg2AW',
				'dependency'  => array( 'wpgpyt_display_mode|wpgpyt_video_from', '!=|==', 'button|playlist' ),
			),
			array(
				'id'         => 'wpgpyt_gallery_theme',
				'type'       => 'button_set',
				'title'      => __( 'Theme', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Set a theme for the gallery.', 'wpgp-youtube-gallery' ),
				'options'    => array(
					'minimal' => __( 'Minimal', 'wpgp-youtube-gallery' ),
					'scroll'  => __( 'Scroll', 'wpgp-youtube-gallery' ),
				),
				'default'    => 'scroll',
				'dependency' => array( 'wpgpyt_display_mode', '==', 'gallery' ),
			),
			array(
				'id'          => 'wpgpyt_single_id',
				'type'        => 'text',
				'title'       => __( 'Video ID', 'wpgp-youtube-gallery' ),
				'subtitle'    => __( 'Set a video ID.', 'wpgp-youtube-gallery' ),
				'placeholder' => __( 'https://www.youtube.com/watch?v=', 'wpgp-youtube-gallery' ),
				'desc'        => '<img src="' . WPGP_YOUTUBE_GALLERY_DIR_URL_FILE . 'admin/img/youtube-video-id.png" />',
				'default'     => 'RvrOeXvmaMY',
				'dependency'  => array( 'wpgpyt_display_mode', '==', 'button' ),
			),
			array(
				'id'         => 'wpgpyt_single_btn_txt',
				'type'       => 'text',
				'title'      => __( 'Button Text', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Set your button text.', 'wpgp-youtube-gallery' ),
				'default'    => '► Tutorial',
				'dependency' => array( 'wpgpyt_display_mode', '==', 'button' ),
			),
			array(
				'id'         => 'wpgpyt_single_btn_position',
				'type'       => 'button_set',
				'title'      => __( 'Button Position', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Set a button position.', 'wpgp-youtube-gallery' ),
				'options'    => array(
					'left'   => __( 'Left', 'wpgp-youtube-gallery' ),
					'center' => __( 'Center', 'wpgp-youtube-gallery' ),
					'right'  => __( 'Right', 'wpgp-youtube-gallery' ),
				),
				'default'    => 'center',
				'dependency' => array( 'wpgpyt_display_mode', '==', 'button' ),
			),

			array(
				'type'       => 'subheading',
				'content'    => 'Grid Display Settings',
				'dependency' => array( 'wpgpyt_display_mode', '==', 'grid' ),
			),
			array(
				'id'         => 'wpgpyg_video_title_show',
				'type'       => 'switcher',
				'title'      => __( 'Show Video Title', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Show/Hide the video title.', 'wpgp-youtube-gallery' ),
				'text_on'    => __( 'Show', 'wpgp-youtube-gallery' ),
				'text_off'   => __( 'Hide', 'wpgp-youtube-gallery' ),
				'text_width' => 75,
				'default'    => true,
				'dependency' => array( 'wpgpyt_display_mode', '==', 'grid' ),
			),
			array(
				'id'         => 'wpgpyg_video_desc_show',
				'type'       => 'switcher',
				'title'      => __( 'Show Video Description', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Show/Hide the video description.', 'wpgp-youtube-gallery' ),
				'text_on'    => __( 'Show', 'wpgp-youtube-gallery' ),
				'text_off'   => __( 'Hide', 'wpgp-youtube-gallery' ),
				'text_width' => 75,
				'default'    => true,
				'dependency' => array( 'wpgpyt_display_mode', '==', 'grid' ),
			),
			array(
				'id'         => 'wpgpyg_video_desc_length',
				'type'       => 'spinner',
				'title'      => __( 'Description Length', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Trims the description to a certain number of words.', 'wpgp-youtube-gallery' ),
				'min'        => 5,
				'default'    => 50,
				'dependency' => array( 'wpgpyt_display_mode|wpgpyg_video_desc_show', '==|==', 'grid|true' ),
			),

		),
	)
);

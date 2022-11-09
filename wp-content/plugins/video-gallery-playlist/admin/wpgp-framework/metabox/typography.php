<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Create a section
//
WPGP::createSection(
	$wpgp_page_opts,
	array(
		'title'  => 'Typography',
		'icon'   => 'fa fa-font',
		'fields' => array(

			array(
				'type'    => 'content',
				'content' => '<div class="wpgp--menu-detail">
									<strong>Typography</strong>
									<a href="https://www.grandplugin.com/support-forum/" target="_blank" class="">Need Help?</a>
									<br>
									<p>Arranging the content of the gallery to make it more legible, readable, and appealing when displayed. You can prevent to load google font individually. If you leave any style field empty, the particular style will be inherited to its parent element of your theme. To know more you can connect us with help button beside.</p>
									<p style="background: antiquewhite;padding: 10px;text-align: center;color: chocolate;">Typography options are available for only <b>Grid</b> display mode.</p>
								</div>',
			),

			array(
				'id'         => 'wpgpyg_section_title_font_load',
				'type'       => 'switcher',
				'title'      => __( 'Load Section Title Font', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'On/Off google font for the section title.', 'wpgp-youtube-gallery' ),
				'text_on'    => __( 'On', 'wpgp-youtube-gallery' ),
				'text_off'   => __( 'Off', 'wpgp-youtube-gallery' ),
				'text_width' => 70,
				'default'    => true,
			),
			array(
				'id'           => 'wpgpyg_section_title_typo',
				'type'         => 'typography',
				'title'        => __( 'Section Title Font', 'wpgp-youtube-gallery' ),
				'subtitle'     => __( 'Set section title font properties.', 'wpgp-youtube-gallery' ),
				'preview'      => 'always',
				'preview_text' => __( 'Grand Slider Section Title', 'wpgp-youtube-gallery' ),
			),
			array(
				'id'         => 'wpgpyg_video_title_font_load',
				'type'       => 'switcher',
				'title'      => __( 'Load video Title Font', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'On/Off google font for the video title.', 'wpgp-youtube-gallery' ),
				'text_on'    => __( 'On', 'wpgp-youtube-gallery' ),
				'text_off'   => __( 'Off', 'wpgp-youtube-gallery' ),
				'text_width' => 70,
				'default'    => true,
			),
			array(
				'id'           => 'wpgpyg_video_title_typo',
				'type'         => 'typography',
				'title'        => __( 'video Title Font', 'wpgp-youtube-gallery' ),
				'subtitle'     => __( 'Set video title font properties.', 'wpgp-youtube-gallery' ),
				'preview'      => 'always',
				'preview_text' => __( 'Grand Slider video Title', 'wpgp-youtube-gallery' ),
			),
			array(
				'id'         => 'wpgpyg_desc_font_load',
				'type'       => 'switcher',
				'title'      => __( 'Load Description Font', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'On/Off google font for the video description.', 'wpgp-youtube-gallery' ),
				'text_on'    => __( 'On', 'wpgp-youtube-gallery' ),
				'text_off'   => __( 'Off', 'wpgp-youtube-gallery' ),
				'text_width' => 70,
				'default'    => true,
			),
			array(
				'id'           => 'wpgpyg_desc_typo',
				'type'         => 'typography',
				'title'        => __( 'Description Font', 'wpgp-youtube-gallery' ),
				'subtitle'     => __( 'Set video description font properties.', 'wpgp-youtube-gallery' ),
				'preview'      => 'always',
				'preview_text' => __( 'Grand Slider video Description', 'wpgp-youtube-gallery' ),
			),
			array(
				'id'         => 'wpgpyg_meta_font_load',
				'type'       => 'switcher',
				'title'      => __( 'Load Post Meta Font', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'On/Off google font for the post meta.', 'wpgp-youtube-gallery' ),
				'text_on'    => __( 'On', 'wpgp-youtube-gallery' ),
				'text_off'   => __( 'Off', 'wpgp-youtube-gallery' ),
				'text_width' => 70,
				'default'    => true,
			),
			array(
				'id'           => 'wpgpyg_meta_typo',
				'type'         => 'typography',
				'title'        => __( 'Post Meta Font', 'wpgp-youtube-gallery' ),
				'subtitle'     => __( 'Set post meta font properties.', 'wpgp-youtube-gallery' ),
				'preview'      => 'always',
				'preview_text' => __( 'Grand Slider Post Meta', 'wpgp-youtube-gallery' ),
			),

		),
	)
);

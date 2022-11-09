<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Create a section
//
WPGP::createSection(
	$wpgp_page_opts,
	array(
		'title'  => __( 'Controls', 'wpgp-youtube-gallery' ),
		'icon'   => 'fa fa-cog',
		'fields' => array(

			array(
				'type'    => 'content',
				'content' => '<div class="wpgp--menu-detail">
									<strong>Controls</strong>
									<a href="https://www.grandplugin.com/support-forum/" target="_blank" class="">Need Help?</a>
									<br>
									<p>Our best controlling system helps you to create elegant and professionally looking gallery. Some methods are help with the query to displaying. Like orders, published date and video duration. Specified a total video to show maximum number of videos. All options are specific and exact what you need in your website.</p>
								</div>',
			),

			array(
				'id'          => 'wpgpyt_search_order',
				'type'        => 'select',
				'title'       => __( 'Order', 'wpgp-youtube-gallery' ),
				'subtitle'    => __( 'Specifies the method that will be used to order resources. The default value is relevance.', 'wpgp-youtube-gallery' ),
				'placeholder' => 'Select an option',
				'options'     => array(
					'date'       => __( 'Date', 'wpgp-youtube-gallery' ),
					'rating'     => __( 'Rating', 'wpgp-youtube-gallery' ),
					'relevance'  => __( 'Relevance', 'wpgp-youtube-gallery' ),
					'title'      => __( 'Title', 'wpgp-youtube-gallery' ),
					'videoCount' => __( 'Video Count', 'wpgp-youtube-gallery' ),
					'viewCount'  => __( 'View Count', 'wpgp-youtube-gallery' ),
				),
				'default'     => 'relevance',
			),
			array(
				'id'       => 'wpgpyt_max_result',
				'type'     => 'spinner',
				'title'    => __( 'Total Video', 'wpgp-youtube-gallery' ),
				'subtitle' => __( 'Specifies the maximum number of videos that showed. Acceptable values are 0 to 50, inclusive. The default value is 5.', 'wpgp-youtube-gallery' ),
				'min'      => 0,
				'max'      => 50,
				'default'  => 5,
			),
			array(
				'id'       => 'wpgpyt_published_before_after',
				'type'     => 'button_set',
				'title'    => __( 'Published', 'wpgp-youtube-gallery' ),
				'subtitle' => __( 'To show videos at the specified date.', 'wpgp-youtube-gallery' ),
				'options'  => array(
					'before'  => __( 'Before', 'wpgp-youtube-gallery' ),
					'current' => __( 'Current', 'wpgp-youtube-gallery' ),
					'after'   => __( 'After', 'wpgp-youtube-gallery' ),
				),
				'default'  => 'current',
			),
			array(
				'id'         => 'wpgpyt_date_before',
				'type'       => 'date',
				'title'      => __( 'Published Before', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Show only videos created before or at the specified date.', 'wpgp-youtube-gallery' ),
				'settings'   => array(
					'dateFormat' => 'yy-mm-dd',
				),
				'dependency' => array( 'wpgpyt_published_before_after', '==', 'before' ),
			),
			array(
				'id'         => 'wpgpyt_date_after',
				'type'       => 'date',
				'title'      => __( 'Published After', 'wpgp-youtube-gallery' ),
				'subtitle'   => __( 'Show only videos created at or after the specified date.', 'wpgp-youtube-gallery' ),
				'settings'   => array(
					'dateFormat' => 'yy-mm-dd',
				),
				'dependency' => array( 'wpgpyt_published_before_after', '==', 'after' ),
			),
			array(
				'id'       => 'wpgpyt_video_duration',
				'type'     => 'radio',
				'title'    => __( 'Video Duration', 'wpgp-youtube-gallery' ),
				'subtitle' => __( 'Show only videos with matching duration.', 'wpgp-youtube-gallery' ),
				'options'  => array(
					'any'    => __( '<strong>Any</strong> – This is the default value.', 'wpgp-youtube-gallery' ),
					'long'   => __( '<strong>Long</strong> – Only include videos longer than 20 minutes.', 'wpgp-youtube-gallery' ),
					'medium' => __( '<strong>Medium</strong> – Only include videos that are between four and 20 minutes long (inclusive).', 'wpgp-youtube-gallery' ),
					'short'  => __( '<strong>Short</strong> – Only include videos that are less than four minutes long.', 'wpgp-youtube-gallery' ),
				),
				'default'  => 'any',
			),

			array(
				'type'    => 'subheading',
				'content' => 'Show/Hide Components',
			),
			array(
				'id'         => 'wpgpyt_video_title_show',
				'type'       => 'switcher',
				'title'      => 'Video Title',
				'text_on'    => 'Show',
				'text_off'   => 'Hide',
				'text_width' => 80,
				'default'    => false,
			),

		),
	)
);

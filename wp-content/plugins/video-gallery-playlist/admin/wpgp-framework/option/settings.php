<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Set a unique slug-like ID.
$prefix = '_wpgp_option_settings';

//
// Create customize options.
WPGP::createOptions(
	$prefix,
	array(
		'framework_title'   => __( 'YouTube Gallery Settings', 'wpgp-youtube-gallery' ),
		'menu_title'        => __( 'Settings', 'wpgp-youtube-gallery' ),
		'menu_parent'       => 'edit.php?post_type=wpgp_youtube_gallery',
		'menu_slug'         => 'wpgpyg_settings',
		'menu_type'         => 'submenu',
		'sticky_header'     => false,
		'show_bar_menu'     => false,
		'show_search'       => false,
		'show_network_menu' => false,
		'theme'             => 'light',
		'footer_credit'     => __( 'Giving a <a href="https://codecanyon.net/item/add-to-cart-button-pro-for-woocommerce/reviews/25512311" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating to this plugin.', 'wk-add-to-cart-button-for-woocommerce' ),
		'class'             => 'wpgp--option-settings',
	)
);

//
// Create a section.
WPGP::createSection(
	$prefix,
	array(
		'title'  => __( 'Settings', 'wpgp-youtube-gallery' ),
		'fields' => array(

			array(
				'id'         => 'wpgp_api_tutorial',
				'type'       => 'accordion',
				'accordions' => array(
					array(
						'title'  => 'How to get API key?',
						'fields' => array(
							array(
								'type'    => 'content',
								'content' => '<style>
                                iframe.wpgp--api-tut-right {
                                    float: right;
                                }
                                @media screen and (max-width: 782px) {
                                iframe.wpgp--api-tut-right {
                                    width: 100%;
                                    }
                                }
                                </style>
                                <div style="float: left;padding: 8px 50px; display: inline-block; padding-left: 4%;">To get API key:<br>
                                <ol>
                                    <li>Go to → <a target="_blank" href="https://console.developers.google.com/apis/api/youtube.googleapis.com/credentials">Google API Console</a></li>
                                    <li>Create Project / Create Credentials</li>
                                    <li>API Keys</li>
                                    <li>Copy the Key</li>
                                    <li>Done!</li>
                                </ol>
                                </div>
								<iframe class="wpgp--api-tut-right" width="560" height="315" src="https://www.youtube.com/embed/6qkjv36rwCo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
							),
						),
					),
				),
			),

			array(
				'id'       => 'wpgp_api_key',
				'type'     => 'text',
				'title'    => __( 'API Key', 'wpgp-youtube-gallery' ),
				'subtitle' => __( 'Paste your API key here.', 'wpgp-youtube-gallery' ),
			),

			array(
				'type'    => 'subheading',
				'content' => 'Configure a Subscribe Button',
			),
			array(
				'id'       => 'wpgpyt_subscribe_id',
				'type'     => 'text',
				'title'    => __( 'Channel Name or ID', 'wpgp-youtube-gallery' ),
				'subtitle' => __( 'Set your channel name or ID.', 'wpgp-youtube-gallery' ),
				'desc'     => 'Get your <a href="https://www.youtube.com/account_advanced" target="_blank">channel ID</a>',
				'default'  => 'UCpJf6LGZ0a4n9Lj4aVt9spg',
			),
			array(
				'id'      => 'wpgpyt_subscribe_layout',
				'type'    => 'button_set',
				'title'   => __( 'Layout', 'wpgp-youtube-gallery' ),
				'options' => array(
					'default' => __( 'Default', 'wpgp-youtube-gallery' ),
					'full'    => __( 'Full', 'wpgp-youtube-gallery' ),
				),
				'default' => 'default',
			),
			array(
				'type'       => 'content',
				'content'    => '<img src="' . WPGP_YOUTUBE_GALLERY_DIR_URL_FILE . 'public/img/layout_default.png">',
				'dependency' => array( 'wpgpyt_subscribe_layout|wpgpyt_subscribe_count', '==|!=', 'default|hidden' ),
			),
			array(
				'type'       => 'content',
				'content'    => '<img src="' . WPGP_YOUTUBE_GALLERY_DIR_URL_FILE . 'public/img/layout_full.png">',
				'dependency' => array( 'wpgpyt_subscribe_layout|wpgpyt_subscribe_count', '==|!=', 'full|hidden' ),
			),
			array(
				'type'       => 'content',
				'content'    => '<img src="' . WPGP_YOUTUBE_GALLERY_DIR_URL_FILE . 'public/img/layout_default_count_hidden.png">',
				'dependency' => array( 'wpgpyt_subscribe_layout|wpgpyt_subscribe_count', '==|==', 'default|hidden' ),
			),
			array(
				'type'       => 'content',
				'content'    => '<img src="' . WPGP_YOUTUBE_GALLERY_DIR_URL_FILE . 'public/img/layout_full_count_hidden.png">',
				'dependency' => array( 'wpgpyt_subscribe_layout|wpgpyt_subscribe_count', '==|==', 'full|hidden' ),
			),
			array(
				'id'      => 'wpgpyt_subscribe_count',
				'type'    => 'button_set',
				'title'   => __( 'Layout', 'wpgp-youtube-gallery' ),
				'options' => array(
					'default' => __( 'Default (shown)', 'wpgp-youtube-gallery' ),
					'hidden'  => __( 'Hidden', 'wpgp-youtube-gallery' ),
				),
				'default' => 'default',
			),
			array(
				'id'       => 'wpgpyt_subscribe_position',
				'type'     => 'button_set',
				'title'    => __( 'Position', 'wpgp-youtube-gallery' ),
				'subtitle' => __( 'Set a position for subscribe button.', 'wpgp-youtube-gallery' ),
				'options'  => array(
					'left'   => __( 'Left', 'wpgp-youtube-gallery' ),
					'center' => __( 'Center', 'wpgp-youtube-gallery' ),
					'right'  => __( 'Right', 'wpgp-youtube-gallery' ),
				),
				'default'  => 'center',
			),
			array(
				'type'     => 'content',
				'title'    => __( 'Subscribe Button Shortcode', 'wpgp-youtube-gallery' ),
				'subtitle' => __( 'Paste the shortcode anywhere to show the subscribe button.', 'wpgp-youtube-gallery' ),
				'content'  => '<style>
				.wpgp--shortcode-field-wrap {
					display: inline-block;
					padding: 10px;
					border: 1px dashed #DCDCDC;
				}
				.wpgp--shortcode-field-wrap code {
					font-size: 15px;
					font-weight: bold;
					-webkit-touch-callout: all;
					-webkit-user-select: all;
					-khtml-user-select: all;
					-moz-user-select: all;
					-ms-user-select: all;
					user-select: all;
					background: transparent;
				}
				</style>
				<div class="wpgp--shortcode-field-wrap"><code title="Click to select the Shortcode">[wpgpyt_subscribe]</code></div>',
			),
			array(
				'type'    => 'subheading',
				'content' => 'Additional Custom CSS',
			),
			array(
				'id'       => 'wpgpyt_custom_css',
				'type'     => 'code_editor',
				'title'    => __( 'Custom CSS', 'wpgp-youtube-gallery' ),
				'subtitle' => __( 'Place additional styles here.', 'wpgp-youtube-gallery' ),
				'settings' => array(
					'theme' => 'mbo',
					'mode'  => 'css',
				),
			),
			array(
				'id'       => 'wpgpyg_dequeue_google_font',
				'type'     => 'switcher',
				'title'    => __( 'Dequeue Google Fonts', 'wpgp-youtube-gallery' ),
				'subtitle' => __( 'On/Off loading google fonts.', 'wpgp-youtube-gallery' ),
				'text_on'  => __( 'On', 'wpgp-youtube-gallery' ),
				'text_off' => __( 'Off', 'wpgp-youtube-gallery' ),
				'default'  => true,
			),

		),
	)
);

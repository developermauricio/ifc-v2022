<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.1.4
*/

namespace Elementor_Radio_Player\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
// use Elementor\Core\Schemes\Typography;


add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
	if( $section_id == 'erplayer_channels' ){


		/**
		 * Display a default cover?
		 */
		$section->add_control(
			'includeArchive',
			[
				'label' => esc_html__( 'Include radio channels archive', 'erplayer' ),
				'return_value' => '1',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				"description" => esc_html__( "Use the list of channels from the Radio Channel post type.", "erplayer"),
			]
		);


		/**
		 * Display a default cover?
		 */
		$section->add_control(
			'displayDefault',
			[
				'label' => esc_html__( 'Set a radio logo fallback', 'erplayer' ),
				'return_value' => '1',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				"description" => esc_html__( "Add a default image for the radio channels without the logo", "erplayer"),
			]
		);
		/**
		 * Default cover uploader
		 */
		$section->add_control(
			'defaultImage',
			[
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label' => esc_html__( 'Default radio logo', 'erplayer' ),
				"description" => esc_html__( "Used for radio channels without a logo", "erplayer"),
				'condition' => [
					'displayDefault' => '1',
				],
			]
		);

		$section->add_control(
			'bgOpacity',
			[
				'label' => esc_html__( 'Album cover background image opacity', 'erplayer' ),
				"description"	=> esc_html__( "Change the alpha for the radio logo or cover used as dynamic background for the player", "erplayer"),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'label_block' => true,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				]
			]
		);

		/**
		 * Dynamic album cover
		 */
		$section->add_control(
			'searchCover',
			[
				'label' => esc_html__( 'Search album cover', 'erplayer' ),
				'return_value' => '1',
				'default' => '1',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				"description" => esc_html__( "Try to retrieve the album artwork from the song titles.", "erplayer"),
			]
		);



		// Start repeater
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'erpc_title',
			[
				'label' => esc_html__( 'Title', 'erplayer' ),
				'label_block' => false,
				'type' => Controls_Manager::TEXT,
			]
		);

		/**
		 * Default cover uploader
		 */
		$repeater->add_control(
			'erpc_logo',
			[
				'label' => esc_html__('Radio logo', 'erplayer' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description"	=> esc_html__( "Squared, 300x300px", "erplayer"),
			]
		);


		$repeater->add_control(
			'erpc_subtitle',
			[
				'label' => esc_html__( 'Radio subtitle', 'erplayer' ),
				'label_block' => false,
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'erpc_mp3',
			[
				'label' => esc_html__( 'Audio stream URL', 'erplayer' ),
				'label_block' => false,
				'type' => Controls_Manager::TEXT,
			]
		);


		/**
		 * Display a default cover?
		 */
		$repeater->add_control(
			'readTitles',
			[
				'label' => esc_html__( 'Display song titles', 'erplayer' ),
				'return_value' => '1',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				"description" => esc_html__( "Add a default image for the radio channels without the logo", "erplayer"),
			]
		);


		$repeater->add_control(
			'erpc_servertype',
			[
				'label' => esc_html__( 'Server type', 'erplayer' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'select',
				'condition' => [ 
					'readTitles' => '1'
				],
				'options' => [
					'select'  => esc_html__( 'Read song titles from:', 'erplayer' ),
					'type-auto'  => esc_html__( 'Metadata', 'erplayer' ),
					'type-shoutcast'  => esc_html__( 'SHOUTcast', 'erplayer' ),
					'type-icecast'  => esc_html__( 'IceCast', 'erplayer' ),
					'type-radiodotco'  => esc_html__( 'Radio.co', 'erplayer' ),
					'type-airtime'  => esc_html__( 'AirTime', 'erplayer' ),
					'type-radionomy'  => esc_html__( 'Radionomy', 'erplayer' ),
					'type-live365'  => esc_html__( 'Live365', 'erplayer' ),
					'type-text'  => esc_html__( 'Plain text (author - title)', 'erplayer' ),
				]
			]
		);

			/**
			 * ========================
			 * SHOUTCAST
			 * ========================
			 */
			$repeater->add_control(
				'erpc_shoutcast_host',
				[
					'label' => esc_html__('SHOUTCast XMl Feed HOST', 'erplayer' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-shoutcast',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);
			$repeater->add_control(
				'erpc_shoutcast_port',
				[
					'label' => esc_html__('SHOUTCast XMl Feed PORT', 'erplayer' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-shoutcast',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);
			$repeater->add_control(
				'erpc_shoutcast_channel',
				[
					'label' => esc_html__('SHOUTCast Channel (default 1)', 'erplayer' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-shoutcast',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);
			$repeater->add_control(
				'erpc_shoutcast_protocol',
				[
					'label' => esc_html__('SHOUTCast protocol', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'http',
					'options' => [
						'http'  => esc_html__( 'Automatic (uses https when port is 443)', "erplayer" ), 
						'https'  => esc_html__( 'Force HTTPS', "erplayer" ),
					],
					'condition' => [ 
						'erpc_servertype' => 'type-shoutcast',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);

			/**
			 * ========================
			 * ICECAST
			 * ========================
			 */
			$repeater->add_control(
				'erpc_icecasturl',
				[
					'label' => esc_html__('IceCast json URL', 'erplayer' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-icecast',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);
			$repeater->add_control(
				'erpc_icecast_mountpoint',
				[
					'label' => esc_html__('IceCast mountpoint (including "/")', 'erplayer' ),
					"description" => esc_html__( "Optional", "erplayer"),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-icecast',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);
			$repeater->add_control(
				'erpc_icecast_channel',
				[
					'label' => esc_html__('IceCast channel',		 'erplayer' ),
					"description" => esc_html__( "Optional", "erplayer"),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-icecast',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);

			/**
			 * ========================
			 * RADIO.CO
			 * ========================
			 */
			$repeater->add_control(
				'erpc_radiodotco',
				[
					'label' => esc_html__('Radio.co radio ID', 'erplayer' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-radiodotco',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);

			/**
			 * ========================
			 * AIRTIME
			 * ========================
			 */
			$repeater->add_control(
				'erpc_airtime',
				[
					'label' => esc_html__('Airtime', 'erplayer' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-airtime',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);

			/**
			 * ========================
			 * RADIONOMY
			 * ========================
			 */
			$repeater->add_control(
				'erpc_radionomy_userid',
				[
					'label' => esc_html__('Radionomy user ID', 'erplayer' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-radionomy',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);
			$repeater->add_control(
				'erpc_radionomy_apikey',
				[
					'label' => esc_html__('Radionomy API key', 'erplayer' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-radionomy',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]

				]
			);
			/**
			 * ========================
			 * Live365
			 * ========================
			 */
			$repeater->add_control(
				'erpc_live365',
				[
					'label' => esc_html__('Live365 ID', 'erplayer' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-live365',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);

			/**
			 * ========================
			 * Plain text
			 * ========================
			 */
			$repeater->add_control(
				'erpc_textfeed',
				[
					'label' => esc_html__('Plain text', 'erplayer' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [ 
						'erpc_servertype' => 'type-text',
					//	'relation' => 'and',
//						'readTitles' => '1'
					]
				]
			);

			//////////////////////////////////////////////////////////////////////////

		/**
		 * 
		 * PROXY OPTION
		 * 
		 */
		$repeater->add_control(
			'erpc_useproxy',
			[
				'label' => esc_html__('Use proxy', 'erplayer'),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [ 
						'readTitles' => '1'
					],
				'description' 	=> esc_html__("Try this option if you can't see any title. The ajax request will be served by an internal PHP proxy to fix CORS block caused by some radio providers", 'erplayer')
			]
		);


		/**
		 * =================================================================
		 * Add all the fields to the repeater
		 * =================================================================
		 */
		

		$section->add_control(
			'important_note',
			[				
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => '<strong>'.esc_html__( 'We recommend adding the Radio Channels using the custom post type Radio Channels instead of here.', 'erplayer' ).'</strong> '.esc_html__( 'In this way you will need to enter your channel details only once.', 'erplayer' ),
				'content_classes' => 'erplayer',
			]
		);

		$section->add_control(
			'erp_radio_channels',
			[
				'label' => esc_html__( 'Radio channels', 'erplayer' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ erpc_title }}}',
				'prevent_empty' => false,
				'fields' => $repeater->get_controls()
			]
		);
			
	}
}, 10, 3 );
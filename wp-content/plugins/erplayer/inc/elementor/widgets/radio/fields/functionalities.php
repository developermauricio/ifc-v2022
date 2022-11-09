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
	if( $section_id == 'erplayer_functionalities' ){

		$section->add_control(
			'showPlist',
			[
				'label' => esc_html__( 'Display playlist button', 'erplayer' ),
				'return_value' => '1',
				'default' => '1',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				"description" => esc_html__( "Hide or show the icon to open the playlist", "erplayer"),
			]
		);

		$section->add_control(
			'showVolume',
			[
				'label' => esc_html__( 'Display volume control', 'erplayer' ),
				'return_value' => '1',
				'default' => '1',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				"description" => esc_html__( "Desktop only: you can't control the volume on mobile from the browser", "erplayer"),
			]
		);
		
		$section->add_control(
			'startVolume',
			[
				'label' => esc_html__( 'Start volume', 'erplayer' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'label_block' => true,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				]
			]
		);

		

		
			
	}
}, 10, 3 );
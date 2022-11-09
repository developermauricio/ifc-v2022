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
	if( $section_id == 'erplayer_backgrounds' ){

		
		$section->add_control(
			'backgroundColor',
			[
				'label' => esc_html__( 'Background color', 'erplayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$section->add_control(
			'bgHeadings',
			[
				'label' => esc_html__( 'Background image', 'erplayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);



		/**
		 * Default cover uploader
		 */
		$section->add_control(
			'defaultBgImg',
			[
				'label' => esc_html__( 'Default background image', 'erplayer' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description"	=> esc_html__( "Upload any image to be used as player background", "erplayer"),
			]
		);
		$section->add_control(
			'defaultBgImgOp',
			[
				'label' => esc_html__( 'Default background image opacity', 'erplayer' ),
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
					'size' => 1,
				],
			]
		);
			
	}
}, 10, 3 );
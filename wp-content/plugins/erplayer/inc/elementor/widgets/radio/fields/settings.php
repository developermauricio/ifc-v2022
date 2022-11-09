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
	if( $section_id == 'erplayer_settings' ){

		
		/**
			 * Layout controls
			 */
			$section->add_control(
				'layout',
				[
					'label' => esc_html__( 'Layout', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'card',
					'options' => [
						'card'  => esc_html__( 'Card', 'erplayer' ),
						'bar' => esc_html__( 'Bar compact', 'erplayer' ),
						'fullscreenbar' => esc_html__( 'Full width bar', 'erplayer' ),
						'buttononly' => esc_html__( 'Button only', 'erplayer' ),
					],
				]
			);


			$section->add_control(
				'thumbSize',
				[
					'label' => esc_html__( 'Thumbnail size', 'erplayer' ),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'label_block' => true,
					'range' => [
						'px' => [
							'min' => 60,
							'max' => 110,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 60,
					]
				]
			);



			$section->add_control(
				'playBtnSize',
				[
					'label' => esc_html__( 'Button size', 'erplayer' ),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'label_block' => true,
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 220,
							'step' => 10,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 45,
					],
					'condition' => [
						'layout' => 'buttononly',
					],
				]
			);









			/**
			 * Positioning controls
			 */
			$section->add_control(
				'position',
				[
					'label' => esc_html__( 'Position', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'inline',
					'options' => [
						'inline'  => esc_html__( 'Inline', 'erplayer' ),
						'fixed' => esc_html__( 'Fixed', 'erplayer' )
					],
				]
			);

			/**
			 * Display a default cover?
			 */
			$section->add_control(
				'bodyPadding',
				[
					'label' => esc_html__( 'Auto page spacing', 'erplayer' ),
					'return_value' => '1',
					'type' => \Elementor\Controls_Manager::SWITCHER,
					"description" => esc_html__( "For fixed positioning", "erplayer"),
					'condition' => [
						'position' => 'fixed',
					],
				]
			);

			

			$section->add_control(
				'location',
				[
					'label' => esc_html__( 'Location', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'tr',
					'options' => [
						'tr'  => esc_html__( 'Top right', 'erplayer' ),
						'tl'  => esc_html__( 'Top left', 'erplayer' ),
						'br'  => esc_html__( 'Bottom right', 'erplayer' ),
						'bl' => esc_html__( 'Bottom left', 'erplayer' )
					],
					'condition' => [
						'position' => 'fixed',
					],
				]
			);


			$section->add_control(
				'playlistDirection',
				[
					'label' => esc_html__( 'Playlist side', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => false,
					'options' => [
						'audo' => esc_html__( 'Auto', 'erplayer' ),
						'down'  => esc_html__( 'Down', 'erplayer' ),
						'up'  => esc_html__( 'Up', 'erplayer' ),
					],
					'condition' => [
						'layout' => 'fullscreenbar',
					],
				]
			);

			

			$section->add_control(
				'maxWidth',
				[
					'label' => esc_html__( 'Maximum width', 'erplayer' ),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'label_block' => true,
					'range' => [
						'px' => [
							'min' => 270,
							'max' => 1260,
							'step' => 20,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 270,
					],
				]
			);

			$section->add_control(
				'margin',
				[
					'label' => esc_html__( 'Margin', 'erplayer' ),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'label_block' => true,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 20,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					]
				]
			);

			$section->add_control(
				'padding',
				[
					'label' => esc_html__( 'Internal padding', 'erplayer' ),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'label_block' => true,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 40,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 15,
					]
				]
			);

			$section->add_control(
			'boxShadow',
			[
				'label' => esc_html__( 'Player shadow', 'erplayer' ),
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

		$section->add_control(
			'boxRadius',
			[
				'label' => esc_html__( 'Box radius', 'erplayer' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'label_block' => true,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				]
			]
		);

		$section->add_control(
			'coverRadius',
			[
				'label' => esc_html__( 'Cover radius', 'erplayer' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'label_block' => true,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				]
			]
		);

		
			
	}
}, 10, 3 );
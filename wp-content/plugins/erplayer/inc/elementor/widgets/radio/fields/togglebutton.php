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
use Elementor\Core\Schemes\Typography;


add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
	if( $section_id == 'erplayer_togglebutton' ){

		
		$section->add_control(
				'erplayer_important_note',
				[
					'label' => esc_html__( 'Visible only when setting Position to Fixed', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
				]
			);

			$section->add_control(
				'showToggle',
				[
					'label' => esc_html__( 'Display a toggle button', 'erplayer' ),
					'return_value' => '1',
					'default' => '1',
					'type' => \Elementor\Controls_Manager::SWITCHER,
					"description" => esc_html__( "For fixed location", "erplayer"),
					'condition' => [
						'position' => 'fixed',
					],
				]
			);

			$section->add_control(
				'popup',
				[
					'label' => esc_html__( 'Open in popup', 'erplayer' ),
					'return_value' => '1',
					'type' => \Elementor\Controls_Manager::SWITCHER,
					"description" => esc_html__( "Open a popup window with the player", "erplayer"),
					'condition' => [
						'showToggle' => '1',
					],
				]
			);

				// POPUP WIDTH
				$section->add_control(
					'popupW',
					[
						'label' => esc_html__( 'Popup width', 'erplayer' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => '300',
						'condition' => [
							'popup' => '1',
						],
					]
				);
				// POPUP H
				$section->add_control(
					'popupH',
					[
						'label' => esc_html__( 'Popup height', 'erplayer' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => '300',
						'condition' => [
							'popup' => '1',
						],
					]
				);



			$section->add_control(
				'elementorPlayerState',
				[
					'label' => esc_html__( 'Initial player visibility', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => 'visible',
					'default' => 'visible',
					'options' => [
						'visible'  => esc_html__( 'Visible', 'erplayer' ),
						'hidden'  => esc_html__( 'Hidden', 'erplayer' ),
					],
					'condition' => [
						'showToggle' => '1'
					],
				]
			);

			// Toggle button colors
			$section->add_control(
				'toggleBgColor',
				[
					'label' => esc_html__( 'Toggle button background', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'showToggle' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .erplayer__toggletbutton' => 'background-color: {{VALUE}};',
					],
				]
			);
			$section->add_control(
				'toggleHoverBg',
				[
					'label' => esc_html__( 'Toggle button background hover', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'showToggle' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .erplayer__toggletbutton:hover::after' => 'background-color: {{VALUE}};',
					],
				]
			);
			$section->add_control(
				'toggleTextColor',
				[
					'label' => esc_html__( 'Toggle button text', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'showToggle' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .erplayer__toggletbutton' => 'color: {{VALUE}};',
					],
				]
			);
			$section->add_control(
				'toggleHoverColor',
				[
					'label' => esc_html__( 'Toggle button text hover', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'showToggle' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .erplayer__toggletbutton:hover' => 'color: {{VALUE}};',
					],
				]
			);
			


			$section->add_control(
				'toggleHeight',
				[
					'label' => esc_html__( 'Height', 'erplayer' ),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'label_block' => true,
					'range' => [
						'px' => [
							'min' => 15,
							'max' => 100,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 20,
					],
					'condition' => [
						'showToggle' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .erplayer__toggletbutton' => 'line-height: {{SIZE}}{{UNIT}}; height:auto;',
					],
				]
			);
			$section->add_control(
				'togglePadding',
				[
					'label' => esc_html__( 'Padding', 'erplayer' ),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'label_block' => true,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 30,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 20,
					],
					'condition' => [
						'showToggle' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .erplayer__toggletbutton' => 'padding: {{SIZE}}{{UNIT}};',
					],
				]
			);


			$section->add_control(
				'toggleRadius',
				[
					'label' => esc_html__( 'Toggle button radius', 'erplayer' ),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'label_block' => true,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 50,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 5,
					],
					'condition' => [
						'showToggle' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .erplayer__toggletbutton' => 'border-radius: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$section->add_control(
				'toggleFsize',
				[
					'label' => esc_html__( 'Toggle font size', 'erplayer' ),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'label_block' => true,
					'range' => [
						'px' => [
							'min' => 16,
							'max' => 40,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 16,
					],
					'condition' => [
						'showToggle' => '1',
					],
				]
			);

		
			$section->add_control(
				'btnlabel',
				[
					'label' => esc_html__( 'Toggle button label', 'erplayer' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					"description" => esc_html__( "Text for the visibility button", "erplayer"),
					'condition' => [
						'position' => 'fixed',
					],
				]
			);

			
	}
}, 10, 3 );
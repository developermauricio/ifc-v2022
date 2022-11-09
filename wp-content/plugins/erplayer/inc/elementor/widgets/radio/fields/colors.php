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
	if( $section_id == 'erplayer_colors' ){
		$section->add_control(
			'textColor',
			[
				'label' => esc_html__( 'Text color', 'erplayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff'
			]
		);
		$section->add_control(
			'accentColor',
			[
				'label' => esc_html__( 'Accent color', 'erplayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ff0056'
			]
		);
	}
}, 10, 3 );
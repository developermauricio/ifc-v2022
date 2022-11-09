<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.1.4
*/

namespace Elementor_Radio_Player\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Base;
use Elementor\Group_Control_Typography;

use Elementor\Control_Font;


add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
	if( $section_id == 'erplayer_typo' ){

		$section->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typo_title',
				'label' => esc_html__( 'Title Typography', 'erplayer' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .erplayer__info__title',
				'exclude' => [ 'line_height', 'text_decoration' ],
			]
		);

		$section->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typo_artist',
				'label' => esc_html__( 'Artist Typography', 'erplayer' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'exclude' => [ 'line_height', 'text_decoration' ],
				'selector' => '{{WRAPPER}} .erplayer__info__artist',
			]
		);
		
		$section->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typo_album',
				'label' => esc_html__( 'Album Typography', 'erplayer' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'exclude' => [ 'line_height', 'text_decoration' ],
				'selector' => '{{WRAPPER}} .erplayer__info__album',
			]
		);
	}
}, 10, 3 );
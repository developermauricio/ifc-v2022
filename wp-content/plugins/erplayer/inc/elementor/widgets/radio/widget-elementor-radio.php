<?php
/**
 * @source  https://developers.elementor.com/elementor-controls/
 * @author  QantumThemes
 * @package  Elementor Proradio
 * @version  1.0.0
 */


namespace Elementor_Radio_Player\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
// use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ElementorRadioPlayer extends Widget_Base {
	public function get_name() {
		return 'elementor-radio-player'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Radio Player', 'erplayer' );
	}
	public function get_icon() {
		return 'fa fa-broadcast-tower';
	}
	public function get_categories() {
		return [ 'radioplayer' ]; // needs to be registered in _plugin.php
	}
	// Javascript
	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);
      wp_register_script( 'erplayer-editor-script', plugins_url( '/elementor-radio-player.js', __FILE__ ), [ 'jquery','elementor-frontend' ], '1.0.0', true );
   	}
 	public function get_script_depends() {
	     return [ 'erplayer-editor-script' ];
	}

	protected function _register_controls() {


		/**
		 * =================================================================
		 * Section: channels
		 * =================================================================
		 */
		$this->start_controls_section(
			'erplayer_channels',
			[
				'label' => esc_html__( 'Radio channels', 'erplayer' ),
			]
		);
			// Important::::::::::::::::::::::::::::::::::::
			// Fields added by fields/channels.php
			// :::::::::::::::::::::::::::::::::::::::::::::
			$this->end_controls_section();


		


		

		/**
		 * =================================================================
		 * Section: Layout
		 * =================================================================
		 */
		$this->start_controls_section(
			'erplayer_settings',
			[
				'label' => esc_html__( 'Design settings', 'erplayer' ),
			]
		);
			// Important::::::::::::::::::::::::::::::::::::
			// Fields added by fields/settings.php
			// :::::::::::::::::::::::::::::::::::::::::::::
			$this->end_controls_section();


		/**
		 * =================================================================
		 * Section: Typography
		 * =================================================================
		 */
		$this->start_controls_section(
			'erplayer_typo',
			[
				'label' => esc_html__( 'Typography', 'erplayer' ),
			]
		);
			// Important::::::::::::::::::::::::::::::::::::
			// Fields added by fields/typo.php
			// :::::::::::::::::::::::::::::::::::::::::::::
			$this->end_controls_section();

		




		

		/**
		 * =================================================================
		 * Section: Toggle button
		 * =================================================================
		 */
		$this->start_controls_section(
			'erplayer_togglebutton',
			[
				'label' => esc_html__( 'Toggle button', 'erplayer' ),
				'condition' => [
						'position' => 'fixed',
					],
			]
		);
			// Important::::::::::::::::::::::::::::::::::::
			// Fields added by fields/togglebutton.php
			// :::::::::::::::::::::::::::::::::::::::::::::		
			$this->end_controls_section();


		/**
		 * ======================================
		 * Section:
		 * Appearance
		 * ======================================
		 */
		$this->start_controls_section(
			'erplayer_backgrounds',
			[
				'label' => esc_html__( 'Backgrounds', 'erplayer' ),
			]
		);
			// Important::::::::::::::::::::::::::::::::::::
			// Fields added by fields/backgrounds.php
			// :::::::::::::::::::::::::::::::::::::::::::::			
			$this->end_controls_section();
			
		/**
		 * ======================================
		 * Section:
		 * Colors
		 * ======================================
		 */

		$this->start_controls_section(
			'erplayer_colors',
			[
				'label' => esc_html__( 'Text colors', 'erplayer' ),
			]
		);
			// Important::::::::::::::::::::::::::::::::::::
			// Fields added by fields/colors.php
			// :::::::::::::::::::::::::::::::::::::::::::::	
			$this->end_controls_section();

		/**
		 * ======================================
		 * Section:
		 * Defaults
		 * ======================================
		 */
		$this->start_controls_section(
			'erplayer_functionalities',
			[
				'label' => esc_html__( 'Functionalities', 'erplayer' ),
			]
		);
			// Important::::::::::::::::::::::::::::::::::::
			// Fields added by fields/functionalities.php
			// :::::::::::::::::::::::::::::::::::::::::::::
			$this->end_controls_section();

		
	}
	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		$atts['playerId'] = $this->get_id();
		
		$atts['boxShadow'] = intval($atts['boxShadow']['size']) / 100;
		if( array_key_exists('startVolume', $atts ) ){
			$atts['startVolume'] = intval($atts['startVolume']['size'])/100;
		}
		
		if( array_key_exists('maxWidth', $atts ) ){
			$atts['maxWidth'] = intval($atts['maxWidth']['size']);
		}
		if( array_key_exists('margin', $atts ) ){
			$atts['margin'] = intval($atts['margin']['size']);
		}
		if( array_key_exists('padding', $atts ) ){
			$atts['padding'] = intval($atts['padding']['size']);
		}
		if( array_key_exists('boxRadius', $atts ) ){
			$atts['boxRadius'] = intval($atts['boxRadius']['size']);
		}
		if( array_key_exists('coverRadius', $atts ) ){
			$atts['coverRadius'] = intval($atts['coverRadius']['size']);
		}
		if( array_key_exists('toggleRadius', $atts ) ){
			$atts['toggleRadius'] = intval($atts['toggleRadius']['size']);
		}
		if( array_key_exists('togglePadding', $atts ) ){
			$atts['togglePadding'] = intval($atts['togglePadding']['size']);
		}
		if( array_key_exists('toggleHeight', $atts ) ){
			$atts['toggleHeight'] = $atts['toggleHeight']['size'];
		}
		if( array_key_exists('toggleFsize', $atts ) ){
			$atts['toggleFsize'] = $atts['toggleFsize']['size'];
		}
		if( array_key_exists('playBtnSize', $atts ) ){
			$atts['playBtnSize'] = intval($atts['playBtnSize']['size']);
		}
		if( array_key_exists('bgOpacity', $atts ) ){
			$atts['bgOpacity'] = $atts['bgOpacity']['size'];
		}
		if( array_key_exists('defaultBgImgOp', $atts ) ){
			$atts['defaultBgImgOp'] = $atts['defaultBgImgOp']['size'];
		}
		if( array_key_exists('thumbSize', $atts ) ){
			$atts['thumbSize'] = $atts['thumbSize']['size'];
		}
		if( array_key_exists('elementorPlayerState', $atts ) ){
			$atts['state'] = $atts['elementorPlayerState'];
		}

		/**
		 * Special typography parameters
		 * We need to encode and pass them to the js because otherwise the popup won't work
		 */
		$typo_settings = array();
		foreach( $atts as $key => $value ){
			if( preg_match('/typo_title/', $key ) ||  preg_match('/typo_album/', $key ) ||  preg_match('/typo_artist/', $key ) ){
				$typo_settings[$key] = $value;
			}
		}
		if( count( $typo_settings ) > 0 ){
			$atts['typoSettings'] = json_encode( $typo_settings );
		}

		if('1' !== $atts['showToggle'] && 'fixed' === $atts['location'] ){
			$atts['showToggle'] = '1';
		}
		if(array_key_exists('defaultImage', $atts)){
			$atts['defaultImage'] = $atts['defaultImage']['url'];
		}
		if(array_key_exists('defaultBgImg', $atts)){
			$atts['defaultBgImg'] = $atts['defaultBgImg']['url'];
		}

		if(function_exists('erplayer_player')){
			echo erplayer_player( $atts );
		}
	}
	protected function _content_template() {}
}
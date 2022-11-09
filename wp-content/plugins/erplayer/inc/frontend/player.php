<?php
/**
 * @package WordPress
 * @subpackage Elemento Radio Player
 * @version 1.0.6
*/


if(!function_exists('erplayer_is_editing')){
	function erplayer_is_editing(){
		if ( ! did_action( 'elementor/loaded' ) ) {
			return false;
		}
		if ( \Elementor\Plugin::$instance->preview->is_preview_mode() || \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			return true;
		}
		return false;
	}
}


if(!function_exists('erplayer_player')){
	add_shortcode( 'erplayer', 'erplayer_player' );
	function erplayer_player($atts = []){
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}
		/**
		 * Shortcode parameters
		 */
		extract( // Extract is allowed because the shortcode attributes are specified
			shortcode_atts(
				array(
					'includeArchive' => false,
					'postid' => get_the_ID(),
					'typoSettings' => false,
					'popup' => false,
					'popupW' => '300',
					'popupH' => '300',
					'playerId' => 'playerIdDefault',
					'title_typography' => false,
					'font' => false,
					'erp_radio_channels' => false,
					'boxShadow' => 50,
					'playBtnSize' => 45,
					'startVolume' => 0.5,
					'searchCover' => '1',
					'open' => false,
					'defaultImage' => plugins_url('/assets/img/default.jpg' , __FILE__ ),
					'displayDefault' => false,
					'layout' => 'card',
					'position' => 'inline',
					'location' => 'tr',
					'state' => 'visible',
					'maxWidth' => 270, 
					'margin' => 0,
					'padding' => 15, 
					'boxRadius' => 10,
					'coverRadius' => 3,
					'bgOpacity' => 0,
					'thumbSize' => 60,
					'showPlist' => '1',
					'showVolume' => '1',
					// Player colors:
					'backgroundColor' => false,
					'textColor' => false,
					'accentColor' => false,
					// button:
					'toggleBgColor' => false,
					'toggleTextColor' => false,
					'toggleHoverColor' => false,
					'toggleHoverBg' => false,
					'toggleRadius' => false,
					'toggleHeight' => false,
					'togglePadding' => false,
					'toggleFsize' => false,
					'defaultBgImg' => false,
					'defaultBgImgOp' => 1,
					'playlistDirection' => false,
					'btnlabel' => false, 
					'showToggle' => '1',
					'bodyPadding' => false 
				),
				$atts 
			) 
		);


		/**
		 * Create options object
		 * @var options = json objext
		 */
		$options_array = [];

		$options_array['showVolume'] = ($showVolume == '1')? '1' : 0;
		$options_array['showPlist'] = esc_js( $showPlist );


		$options_array['postid'] = esc_js($postid );
		$options_array['startVolume'] = esc_js( $startVolume );
		$options_array['boxRadius'] = esc_js( $boxRadius );
		$options_array['coverRadius'] = esc_js( $coverRadius );
		$options_array['margin'] = esc_js( $margin );
		$options_array['layout'] = esc_js( $layout );
		$options_array['bgOpacity'] = esc_js( $bgOpacity );	
		$options_array['location'] = esc_js( $location );	
		$options_array['bodyPadding'] = esc_js( $bodyPadding );	
		$options_array['playBtnSize'] = esc_js( $playBtnSize );
		$options_array['toggleBgColor'] = esc_js( $toggleBgColor );		
		$options_array['toggleTextColor'] = esc_js( $toggleTextColor );	
		$options_array['toggleHoverColor'] = esc_js( $toggleHoverColor );
		$options_array['toggleHoverBg'] = esc_js( $toggleHoverBg );		
		$options_array['toggleRadius'] = esc_js( $toggleRadius );	
		$options_array['toggleHeight'] = esc_js( $toggleHeight );	
		$options_array['togglePadding'] = esc_js( $togglePadding );	
		$options_array['toggleFsize'] = esc_js( $toggleFsize );	
		$options_array['playlistDirection'] = esc_js( $playlistDirection );
		
		
		$options_array['defaultBgImg'] = esc_js( $defaultBgImg );
		$options_array['defaultBgImgOp'] = esc_js( $defaultBgImgOp );
		$options_array['searchCover'] = esc_js( $searchCover );
		$options_array['popup'] = esc_js( $popup );
		$options_array['thumbSize'] = esc_js( $thumbSize );
		$options_array['includeArchive'] = esc_js( $includeArchive );
		$options_array['radioChannelsPopup'] = json_encode( $erp_radio_channels );
		
		
		/**
		 * If we are preparing a popup player, the font settings have to be passed via javascript
		 */
		if( $popup && $typoSettings ){
			$options_array['typoSettings'] =  $typoSettings ;
		}

		$options_array['boxShadow'] = esc_js( $boxShadow );

		if( $backgroundColor ){
			$options_array['backgroundColor'] = esc_js( $backgroundColor );
		}
		if( $textColor ){
			$options_array['textColor'] = esc_js( $textColor );
		}
		if( $accentColor ){
			$options_array['accentColor'] = esc_js( $accentColor );
		}
		if( $defaultImage ){
			$options_array['defaultImage'] = esc_js( $defaultImage );
		}
		if( $displayDefault ) {
			$options_array['displayDefault'] = esc_js( $displayDefault );
		}
		if( $padding ) {
			$padding = intval($padding);
			if( $padding < 0 ){
				$padding = 0;
			}
			$options_array['padding'] = esc_js( $padding );
		}
		if( $maxWidth ){
			$maxWidth = intval($maxWidth);
			if( $maxWidth < 270 ){
				$maxWidth = 270;
			}
			$options_array['maxWidth'] = esc_js( $maxWidth );
		}

		// Create a custom ID required to target javascript and styles
		$customClass = 'erplayer-id-'.esc_attr( $playerId );
		$options_array['customClass'] = $customClass;
		$customClassButton = 'erplayer-togglebutton-'.$customClass;

		// Convert the options array to a json ovject that will be passed to the javascript
		$options = json_encode( array_filter( $options_array ) );



		/**
		 * Create classes
		 */
		$classes = [];
		$classes[] = 'erplayer';
		$classes[] = ''; // default classes
		$classes[] = 'erplayer--'.$layout;
		$classes[] = 'erplayer--'.$position;
		$classes[] = 'erplayer--'.$location;
		$classes[] = 'erplayer--'.$state;
		$classes[] = 'erplayer--open-'.$playlistDirection;
		$classes = implode(' ', $classes);

		/**
		 * If we chose a fixed position, the player will be written in the footer.
		 * But if we are editing with Elementor we still will output the widget inline otherwise it won't work
		 */
		$erplayer_is_editing = erplayer_is_editing();

		
		/**
		 * ===============================================================
		 * Popup page output
		 * ===============================================================
		 */
		
		if(isset($_GET)){
			if(array_key_exists('erplayerpopup', $_GET) ){
				?>
				<div class="elementor-<?php echo get_the_ID() ?>">
					<div class="elementor-element elementor-element-<?php echo esc_attr( $playerId ); ?>">
						<?php 
						/**
						 * Player widget
						 */
						include plugin_dir_path( __FILE__ ) . '/templates/player-html.php';  
						?>
					</div>
				</div>
				<?php
				return;
			}
		}

		/**
		 * ===============================================================
		 * Fixed position output: player in footer
		 * ===============================================================
		 */
		if( 'fixed' == $position && !$erplayer_is_editing && !$popup ){
			add_action( 'wp_footer', function() use($options, $classes, $playerId, $erp_radio_channels, $includeArchive){ 
				?>
				<div class="elementor-<?php echo get_the_ID() ?>">
					<div class="elementor-element elementor-element-<?php echo esc_attr( $playerId ); ?>">
						<?php 
						/**
						 * Player template
						 */
						include plugin_dir_path( __FILE__ ) . '/templates/player-html.php';  
						?>
					</div>
				</div>
				<?php
			});
		}

		/**
		 * ===============================================================
		 * Inline page HTML Output starts
		 * ===============================================================
		 */
		ob_start();
		
		if( !$popup ){
			include plugin_dir_path( __FILE__ ) . '/templates/button-toggle.php';
		} else {
			include plugin_dir_path( __FILE__ ) . '/templates/button-popup.php';
		}
		// Display if the position is not fixed OR if I'm editing, so also for popup
		if ( 'fixed' !== $position || $erplayer_is_editing ) {
			/**
			 * Player template
			 */
		    include plugin_dir_path( __FILE__ ) . '/templates/player-html.php';
		}

		return ob_get_clean();
	}
}
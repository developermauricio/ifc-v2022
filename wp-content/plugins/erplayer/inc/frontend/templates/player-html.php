<div class="<?php echo esc_attr( $classes ); ?>" data-erplayer-widget data-erplayer-options="<?php echo esc_attr( $options); ?>" >
	<div class="erplayer-content">
		<?php  

		/**
		 * Widget
		 */
		?>
		<div data-erplayer-container class="erplayer__container">
			<audio id="erplayer-audio" data-erplayer-audio preload="none"></audio>
			<div class="erplayer__bgcolor"></div>
			<div data-erplayer-background class="erplayer__background"></div>
			<div data-erplayer-wrapper class="erplayer__wrapper">
				<div class="erplayer__wrapper__container">
					<div class="erplayer__info">
						<div data-erplayer-trackcover class="erplayer__info__cover"></div>
						<h3 class="erplayer__info__title erplayer-marquee"><span data-erplayer-title></span></h3>
						<h4 class="erplayer__info__artist erplayer-marquee"><span data-erplayer-artist></span></h4>
						<h6 class="erplayer__info__album erplayer-marquee"><span data-erplayer-album></span></h6>
					</div>
					<div data-erplayer-controls class="erplayer__controls">
						<div class="erplayer__slidercontrol erplayer__slidercontrol--progressbar">
							<span data-erplayer-timer class="erplayer__timer">--:--</span>
							<div data-erplayer-progressbar class="erplayer__progressbar erplayer__slidercontrol__slider">
								<div data-erplayer-playhead  class="erplayer__slidercontrol__bar erplayer__playhead"></div>
								<div data-erplayer-bufferhead class="erplayer__slidercontrol__bar erplayer__bufferhead"></div>
								<div class="erplayer__slidercontrol__trackbar"></div>
								<input type="range" data-erplayer-cue class="erplayer__slidercontrol__input" min="0" max="1" step="0.005" value="0" />
							</div>
							<span data-erplayer-duration class="erplayer__duration">--:--</span>
						</div>
						<span data-erplayer-prev class="erplayer__btn erplayer__prev"><i class="erplayer-icon-to-start"></i></span>
						<span data-erplayer-play class="erplayer__btn erplayer__play"><i class="erplayer-icon-play"></i></span>
						<span data-erplayer-pause class="erplayer__btn erplayer__pause"><i class="erplayer-icon-pause"></i></span>
						<span data-erplayer-next class="erplayer__btn erplayer__next"><i class="erplayer-icon-to-end"></i></span>
						<div data-erplayer-volumecontroller class="erplayer__slidercontrol erplayer__slidercontrol--volume">
							<span data-erplayer-mute class="erplayer__btn erplayer__mute"><i class="erplayer-icon-volume"></i></span>
							<div class="erplayer__slidercontrol__slider">
								<div data-erplayer-volume-bar class="erplayer__volume-bar erplayer__slidercontrol__bar"></div>
								<div class="erplayer__slidercontrol__trackbar"></div>
								<input type="range" data-erplayer-volume-input class="erplayer__volume-input erplayer__slidercontrol__input" min="0" max="1" step="0.01" value="1" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<span data-erplayer-plist-toggler class="erplayer__btn erplayer__openplaylist"><i class="erplayer-icon-menu erplayer-openicon"></i><i class="erplayer-icon-cancel erplayer-closeicon"></i></span>
			<div data-erplayer-playlist class="erplayer__playlist <?php if($open){ ?>open<?php } ?>">
				<ul data-erplayer-playlist-html>
					<?php
					
					/**
					 * Shortcode channels
					 */
					if( false != $erp_radio_channels ){

						echo wp_kses_post( erplayer_playlist_radio_elementor( $erp_radio_channels ) );
					} 

					/**
					 * Database channels
					 */
					if( false != $includeArchive ){
						echo wp_kses_post( erplayer_playlist_radio() );
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
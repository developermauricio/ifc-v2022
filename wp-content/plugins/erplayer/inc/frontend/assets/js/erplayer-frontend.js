// Version 1.0.6

( function( $ ) {
	"use strict";

	$.erplayer = {
		
		// Global parameters for this instance
		proxyURL: $("#erplayer-radiofeed-proxyurl").data('proxyurl'),
		playlist: [],
		currentSong: 0,
		playPercent: 0,
		bufferPercent: 0,
		duration: 0,
		buffered: 0,
		seekPoint: 0,
		playerState: 'pause',
		marqueeInstances: [], // array of marquee instances for this player
		
		// Options
		options: {
			timeInterval: 2 * 60 * 1000 , // [milliseconds]
			qtFeedInterval: false, // container function for the loop
			postid: false,
			popup: false,
			typoSettings: false,
			showPlist: false,
			showVolume: false,
			boxShadow: false,
			startVolume: 1,
			searchCover: false,
			open: false,
			defaultImage: false,
			displayDefault: false,
			maxWidth: false,
			margin: false,
			padding: false,
			layout: false,
			playBtnSize: 45,
			playlistDirection: false,
			location: false,
			boxRadius: false,
			coverRadius: false,
			bgOpacity: 0,
			customClass: false,
			bodyPadding: false,
			backgroundColor: false,
			textColor: false,
			accentColor: false,
			toggleBgColor: false,
			toggleTextColor: false,
			toggleHoverColor: false,
			toggleHoverBg: false,
			toggleRadius: false,
			toggleHeight: false,
			togglePadding: false,
			toggleFsize: false,
			defaultBgImg: false,
			defaultBgImgOp: 1,
			thumbSize: 60,
			fileFormats: [".wav", ".aac", ".ogg",".m4a",".flac",".m3u", ".radio", ".stream", ".mp3", ".ira", ".di", ".io", ".ad", ".com", ".xyz", ".pro", ".eu"]
		},

		// Constructor method
		_create: function(){
			
			// Create control variables
			this.player = this.element;
			
			// Extend default options using the shortcode attributes
			var htmlOptions = this.player.data( 'erplayer-options' );
			this.options = $.extend(this.options,  htmlOptions );

			// Set widget items
			this.playlistHtml = this.player.find('[data-erplayer-playlist-html] li');
			this.playerContainer = this.player.find('[data-erplayer-container]');
			this.playerWrapper = this.player.find('[data-erplayer-wrapper]');
			this.playerToggleBtn = this.player.find('[data-erplayer-togglerbutton]');
			this.controls = this.player.find("[data-erplayer-controls]");
			this.playButton = this.player.find("[data-erplayer-play]");
			this.pauseButton = this.player.find("[data-erplayer-pause]");
			this.nextButton = this.player.find("[data-erplayer-next]");
			this.prevButton = this.player.find('[data-erplayer-prev]');
			this.muteBtn = this.player.find('[data-erplayer-mute]');
			this.volume = this.player.find('[data-erplayer-volume-input]');
			this.volumeBar = this.player.find('[data-erplayer-volume-bar]');
			this.playhead = this.player.find('[data-erplayer-playhead]');
			this.bufferhead = this.player.find('[data-erplayer-bufferhead]');
			this.progressbar = this.player.find('[data-erplayer-progressbar]');
			this.cue = this.player.find('[data-erplayer-cue]');
			this.timer = this.player.find('[data-erplayer-timer]');
			this.durationTime = this.player.find('[data-erplayer-duration]');
			this.songtitle = this.player.find('[data-erplayer-title]');
			this.artist = this.player.find('[data-erplayer-artist]');
			this.album = this.player.find('[data-erplayer-album]');
			this.cover = this.player.find('[data-erplayer-trackcover]');
			this.bg = this.player.find('[data-erplayer-background]');
			this.toggler = this.player.find('[data-erplayer-plist-toggler]');
			this.playlistContainer = this.player.find('[data-erplayer-playlist]');
			this.audio = this.player.find("[data-erplayer-audio]");
			this.myAudio = this.audio[0];
			this.volumeLevel = 1;
			this.initializePlayer();
		},

		/**
		 * Initialize the player
		 * @return {[type]} [description]
		 */
		initializePlayer: function(){
			var that = this;
			that.createCss();
			that.createListeners();
			that.createButtons();
			that.getBarsWidth();
			that.refreshPlaylist(); // converts all of the songs in the HTML list to an array
			that.loadSound();
			that.initVolume();
			that.initCue();
			that.player.delay(700).promise().done(function(){
				that.playerContainer.animate({opacity:1}, 300);
			});
			/**
			 * Update bars size
			 */
			$( window ).resize(function() {
				// Here it should call getBarsWidth but apparently there is a browser known bug giving a wrong value if called after resize
			});
		},


		arrayKeyExists: function (key, search) {
		  if (!search || (search.constructor !== Array && search.constructor !== Object)) {
		    return false;
		  }
		  return key in search;
		},


		/**
		 * Create the custom CSS
		 */
		createCss: function(){
			var that = this;
			var styles = '';
			var customClass = that.options.customClass;
			that.player.attr('id', customClass );

			/**
			 * typoSettings
			 * =================================================================
			 * important: this is used only when delivering the popup!
			 * Otherwise Elementor does it automatically.
			 * =================================================================
			 */
			if( that.options.typoSettings ){
				var typoSettings = $.parseJSON( that.options.typoSettings );

				// ====================== TITLE ========================
				if( typoSettings.typo_title_typography === 'custom' ){
					var fontStyles = '#'+customClass+' .erplayer__info__title { ';
						var fontUrl;
						var fontFamily;
						if( typoSettings.typo_title_font_family ){
							fontFamily = typoSettings.typo_title_font_family;
							fontUrl = fontFamily.split(' ').join('+');
							fontStyles += 'font-family:"'+fontFamily+'";';
						}
						
						// Size
						if( typoSettings.typo_title_font_size ){
							if( typoSettings.typo_title_font_size.size ){
								fontStyles += 'font-size:'+typoSettings.typo_title_font_size.size+typoSettings.typo_title_font_size.unit+';';
							}
						}

						// Weight
						if( typoSettings.typo_title_font_weight ){
							fontStyles += 'font-weight:'+typoSettings.typo_title_font_weight+';';
							fontUrl += ':'+typoSettings.typo_title_font_weight;
						}
						// Style
						if( typoSettings.typo_title_font_style ){
							fontStyles += 'font-style:'+typoSettings.typo_title_font_style+';';
							fontUrl += 'i';
						}
						// Letter spacing
						if( typoSettings.typo_title_letter_spacing ){
							if( typoSettings.typo_title_letter_spacing.size ){
								fontStyles += 'letter-spacing:'+typoSettings.typo_title_letter_spacing.size+typoSettings.typo_title_letter_spacing.unit+';';
							}
						}
						// Text transform
						if( typoSettings.typo_title_text_transform ){
							fontStyles += 'text-transform:'+typoSettings.typo_title_text_transform+';';
						}

						// Close the selector
					fontStyles += '}';

					// Enqueue the font family
					if( fontUrl ){
						$('head').append('<link rel="stylesheet" id="google-fonts-'+customClass+'-css" href="https://fonts'+'.googleapis'+'.com/css'+'?'+'family='+fontUrl+'" type="text/css" media="all">');
					}
					styles += fontStyles;
				}

				// ====================== ARTIST ========================
				
				if( typoSettings.typo_artist_typography === 'custom' ){
					
					var fontStylesArtist = '#'+customClass+' .erplayer__info__artist { ';
						// The selector is open
						var fontUrlArtist;
						var fontFamilyArtist;
						// Family
						if( typoSettings.typo_artist_font_family ){
							fontFamilyArtist = typoSettings.typo_artist_font_family;
							fontUrlArtist = fontFamilyArtist.split(' ').join('+');
							fontStylesArtist += 'font-family:"'+fontFamilyArtist+'";';
						}
						
						// Size
						if( typoSettings.typo_artist_font_size ){
							if( typoSettings.typo_artist_font_size.size ){
								fontStylesArtist += 'font-size:'+typoSettings.typo_artist_font_size.size+typoSettings.typo_artist_font_size.unit+';';
							}
						}

						// Weight
						if( typoSettings.typo_artist_font_weight ){
							fontStylesArtist += 'font-weight:'+typoSettings.typo_artist_font_weight+';';
							fontUrlArtist += ':'+typoSettings.typo_artist_font_weight;
						}
						// Style
						if( typoSettings.typo_artist_font_style ){
							fontStylesArtist += 'font-style:'+typoSettings.typo_artist_font_style+';';
							fontUrlArtist += 'i';
						}
						// Letter spacing
						if( typoSettings.typo_artist_letter_spacing ){
							if( typoSettings.typo_artist_letter_spacing.size ){
								fontStylesArtist += 'letter-spacing:'+typoSettings.typo_artist_letter_spacing.size+typoSettings.typo_artist_letter_spacing.unit+';';
							}
						}
						// Text transform
						if( typoSettings.typo_artist_text_transform ){
							fontStylesArtist += 'text-transform:'+typoSettings.typo_artist_text_transform+';';
						}

						// Close the selector
					fontStylesArtist += '}';

					// Enqueue the font family
					if( fontUrlArtist ){
						$('head').append('<link rel="stylesheet" id="google-fonts-'+customClass+'-css" href="https://fonts.googleapis.com/css?family='+fontUrlArtist+'" type="text/css" media="all">');
					}
					styles += fontStylesArtist;
				}


				// ====================== TITLE ========================
				
				if( typoSettings.typo_album_typography === 'custom' ){
					
					var fontStylesAlbum = '#'+customClass+' .erplayer__info__album { ';
						// The selector is open
						var fontUrlAlbum;
						var fontFamilyAlbum;
						// Family
						if( typoSettings.typo_album_font_family ){
							fontFamilyAlbum = typoSettings.typo_album_font_family;
							fontUrlAlbum = fontFamilyAlbum.split(' ').join('+');
							fontStylesAlbum += 'font-family:"'+fontFamilyAlbum+'";';
						}
						
						// Size
						if( typoSettings.typo_album_font_size ){
							if( typoSettings.typo_album_font_size.size ){
								fontStylesAlbum += 'font-size:'+typoSettings.typo_album_font_size.size+typoSettings.typo_album_font_size.unit+';';
							}
						}

						// Weight
						if( typoSettings.typo_album_font_weight ){
							fontStylesAlbum += 'font-weight:'+typoSettings.typo_album_font_weight+';';
							fontUrlAlbum += ':'+typoSettings.typo_album_font_weight;
						}
						// Style
						if( typoSettings.typo_album_font_style ){
							fontStylesAlbum += 'font-style:'+typoSettings.typo_album_font_style+';';
							fontUrlAlbum += 'i';
						}
						// Letter spacing
						if( typoSettings.typo_album_letter_spacing ){
							if( typoSettings.typo_album_letter_spacing.size ){
								fontStylesAlbum += 'letter-spacing:'+typoSettings.typo_album_letter_spacing.size+typoSettings.typo_album_letter_spacing.unit+';';
							}
						}
						// Text transform
						if( typoSettings.typo_album_text_transform ){
							fontStylesAlbum += 'text-transform:'+typoSettings.typo_album_text_transform+';';
						}

						// Close the selector
					fontStylesAlbum += '}';

					// Enqueue the font family
					if( fontUrlAlbum ){
						$('head').append('<link rel="stylesheet" id="google-fonts-'+customClass+'-css" href="https://fonts.googleapis.com/css?family='+fontUrlAlbum+'" type="text/css" media="all">');
					}
					styles += fontStylesAlbum;
				}
			}

			/**
			 * Shadow
			 */
			if( false === that.options.boxShadow ){
				that.options.boxShadow = 0;
			}
			styles += '#'+customClass+' '+'.erplayer__container{box-shadow:0 0 16px rgba(0,0,0,'+that.options.boxShadow+');}';

			/**
			 * Set max width
			 */
			if( false !== that.options.maxWidth ){
				// styles += "\n";
				styles += '#'+customClass+' '+'.erplayer__container{max-width:'+that.options.maxWidth+'px;}';
			}

			/**
			 * Thumbnail size
			 */
			if( false !== that.options.thumbSize){
				styles += '#'+customClass+' '+' .erplayer__info__cover{width:'+that.options.thumbSize+'px;height:'+that.options.thumbSize+'px;}';
				if( 'bar' === that.options.layout ){
					styles += '#'+customClass+' '+' .erplayer__play, #'+customClass+' '+' .erplayer__pause {width:calc('+that.options.thumbSize+'px - 15px);height:calc('+that.options.thumbSize+'px - 15px);line-height:calc('+that.options.thumbSize+'px - 15px); border-radius: 50%;}';
					styles += '#'+customClass+' .erplayer__wrapper__container{min-height:'+that.options.thumbSize+'px}';
					
				}
				if( 'fullscreenbar' === that.options.layout ){
					var btnPad = (that.options.thumbSize - 60)/2;
					styles += '#'+customClass+' '+' .erplayer__controls {padding-top: '+btnPad+'px;padding-bottom: '+btnPad+'px;}';
					styles += '#'+customClass+' '+' .erplayer__slidercontrol--volume {margin-top: '+ (btnPad / 4) +'px}';

					styles += '@media only screen and (max-width: 1170px){';
					styles += '#'+customClass+' '+' .erplayer__controls {padding-left: '+btnPad+'px;padding-right: '+btnPad+'px;}';
					styles += '}';

				}
			}

			if( 'buttononly' === that.options.layout && that.options.playBtnSize  ){
				styles += '#'+customClass+' '+' .erplayer__btn ,  #'+customClass+' '+' .erplayer__btn.loading, #'+customClass+' '+' .erplayer__btn.loading::before, #'+customClass+' .erplayer__controls .erplayer__btn.loading::before { width:'+that.options.playBtnSize+'px;height:'+that.options.playBtnSize+'px;line-height:'+that.options.playBtnSize+'px;}';
				styles += '#'+customClass+'  .erplayer__slidercontrol--volume{line-height:'+that.options.playBtnSize+'px}';
				var btnBorderWidth = Number(that.options.playBtnSize) * 0.07;
				styles += '#'+customClass+' '+' .erplayer__play::before, #'+customClass+' '+' .erplayer__pause::before, #'+customClass+' '+' .erplayer__btn.loading::before { border-width:'+ btnBorderWidth +'px; transform: translate(-'+btnBorderWidth+'px, -'+btnBorderWidth+'px);}';
				var iconSize = Number(that.options.playBtnSize) * 0.5;
				styles += '#'+customClass+' '+' .erplayer__play i, #'+customClass+' '+' .erplayer__pause i { font-size:'+ iconSize +'px;  }';
			}

			/**
			 * radius
			 */
			if( false !== that.options.boxRadius ){
				styles += '#'+customClass+' .erplayer__bgcolor, #'+customClass+' .erplayer__bgcolor, #'+customClass+' .erplayer__wrapper, #'+customClass+' .erplayer__container,  #'+customClass+' .erplayer__background {border-radius:'+that.options.boxRadius+'px;}';
			}
			if( false !== that.options.coverRadius ){
				styles += '#'+customClass+' '+'.erplayer__info__cover {border-radius:'+that.options.coverRadius+'px;}';
			}

			/**
			 * Background image
			 */
			if( false !== that.options.bgOpacity ){
				styles += '#'+customClass+' '+'.erplayer__background {opacity:'+that.options.bgOpacity+';}';
			}

			if( false !== that.options.backgroundColor ){
				styles += '#'+customClass+' '+'.erplayer__container, #'+customClass+' '+'.erplayer__bgcolor {background-color:'+that.options.backgroundColor+';}';
				if( that.options.layout === 'fullscreenbar' ) {
					styles += '#'+customClass+' '+'.erplayer__playlist {background-color:'+that.options.backgroundColor+';}';
				}
			}
			if( false !== that.options.textColor ){
				styles += '#'+customClass+' .erplayer__container ,#'+customClass+' .erplayer__container h3 ,#'+customClass+' .erplayer__container h4 ,#'+customClass+' .erplayer__container h5 ,#'+customClass+' .erplayer__container h6 ,  #'+customClass+' .erplayer__btn{color:'+that.options.textColor+';}';
				styles += '#'+customClass+' .erplayer__play::after, #'+customClass+' .erplayer__pause::after{background-color:'+that.options.textColor+';}';
			}
			if( false !== that.options.accentColor ){
				styles += '#'+customClass+' .erplayer__btn.loading::before{border-left-color:'+that.options.accentColor+';}';	
				styles += '#'+customClass+'  .erplayer__slidercontrol__bar,  #'+customClass+'input[type="range"]::-webkit-slider-thumb {background:'+that.options.accentColor+';}';	
				styles += '#'+customClass+' .erplayer__slidercontrol input[type="range"]::-webkit-slider-thumb {background-color:'+that.options.accentColor+';}';	
				if( that.options.layout === 'card' ) {
					styles += '#'+customClass+' .erplayer__playlist.open::-webkit-scrollbar-thumb {background-color:'+that.options.accentColor+';}';	
				}
			}

			if( $.erplayerIsMobile() ){
				styles += '#'+customClass+' .erplayer__slidercontrol--volume {display: none;}';	
			} else {
				/**
				 * volume button hide
				 */
				if( '1' !== that.options.showVolume ){
					styles += '#'+customClass+' .erplayer__slidercontrol--volume {display: none;}';	
				}
			}

			/**
			 * background image
			 */
			if(  false !== that.options.defaultBgImg && '' !== that.options.defaultBgImg ){
				that.player.find('.erplayer__bgcolor').append('<img src="'+that.options.defaultBgImg+'">');
				if( false !== that.options.defaultBgImgOp ){
					that.player.find('.erplayer__bgcolor img').css({opacity: that.options.defaultBgImgOp});
					styles += '#'+customClass+' .erplayer__bgcolor img {opacity:'+that.options.defaultBgImgOp+';}';	
				}
			}

			/**
			 * Desktop only
			 */
			styles += '@media only screen and (min-width: 1170px){';
			
				/**
				 * Playlist button hide
				 */
				if( '1' !== that.options.showPlist ){
					styles += '#'+customClass+' .erplayer__openplaylist {display: none;}';	
				}

				/**
				 * Margins
				 */
				if( false !== that.options.margin ){
					styles += '#'+customClass+' '+'.erplayer__container {margin:'+that.options.margin+'px;}';
				}

				if( false !== that.options.accentColor ){
					styles += '#'+customClass+' .erplayer__btn:hover{color:'+that.options.accentColor+';}';					
				}
				/**
				 * Padding
				 */
				if( false !== that.options.padding ){
					styles += '#'+customClass+' '+'.erplayer__wrapper {padding:'+that.options.padding+'px;}';
					styles += '#'+customClass+'.erplayer--fullscreenbar '+'.erplayer__openplaylist {margin-right:'+that.options.padding+'px;}';
					styles += '#'+customClass+'.erplayer--bar '+'.erplayer__openplaylist {margin-right:'+that.options.padding+'px;}';		
					styles += '#'+customClass+'.erplayer--fullscreenbar '+'.erplayer__playlist {padding-left:'+that.options.padding+'px;padding-right:'+that.options.padding+'px;}';	
					styles += '#'+customClass+'.erplayer--fullscreenbar .erplayer__slidercontrol--volume{right:'+ (30 + Number(that.options.padding) ) +'px;}';
				}
			styles += '}';

			// Leave last!
			if( that.options.layout === 'fullscreenbar' && that.options.bodyPadding ){
				if( that.options.location === 'tr' || that.options.location === 'tl' ){
					styles += 'body {margin-top: '+that.playerContainer.outerHeight()+'px;}';
				} else if( that.options.location === 'br' || that.options.location === 'bl' ){
					styles += 'body {margin-bottom: '+that.playerContainer.outerHeight()+'px;}';
				}
			}
			$('#erplayer-custom-css-'+customClass).remove();
			$('head').append('<style id="erplayer-custom-css-'+customClass+'">'+styles+'</style>');
		},

		/**
		 * Cue
		 */
		initCue: function(){
			var that = this;
			that.cue.val( 0 );
			that.cue.on('input', function(){
				that.seekCue();
			});
		},

		/**
		 * Volume slider
		 */
		initVolume: function(){
			var that = this;

			// Mobile: start at 1
			if( $.erplayerIsMobile() ){
				that.options.startVolume = 1;
			}

			// Initialize starting volume
			that.volume.val( that.options.startVolume);
			that.setVolume();
			// Bind input
			that.storedVolume = that.options.startVolume;
			that.muteBtn.on('click', function(){ 
				if(that.volume.val() > 0 ){
					that.muteBtn.addClass('muted');
					that.storedVolume = that.volume.val();
					that.volume.val( 0 );
				} else {
					that.muteBtn.removeClass('muted');
					that.volume.val( that.storedVolume );
				}
				that.setVolume();
			});
			that.volume.on('input', function(){
				that.setVolume();
			});
		},

		/**
		 * Create buttons
		 */
		 createButtons: function(){
		 	var that = this;
			// Fixed player toggle
			$('[data-erplayer-togglerbutton]').off('click');
			$('[data-erplayer-togglerbutton]').on('click', function(e){ 
				e.preventDefault();
				var target = $(this).data('erplayer-togglerbutton');
				$('#'+target).toggleClass('erplayer--visible'); 
			});
			// Player
			that.playButton.on('click', function(){ 
				that.player.find('[data-erplayer-playlist-id="'+that.currentSong+'"]').addClass('erplayer-track-active');
				that.playSound(); 
			});
			that.pauseButton.on('click', function(){ 
				that.player.find('.erplayer-track-active').removeClass('erplayer-track-active');
				that.pauseSound(); 
			});
			that.nextButton.on('click', function(){ 
				that.nextTrack(); 
			});
			that.prevButton.on('click', function(){ 
				that.prevTrack(); 
			});
			that.toggler.on('click', function(){ 
				that.playlistContainer.focus();
				that.playlistContainer.toggleClass('open');
				that.toggler.toggleClass('open');
				that.player.toggleClass('erplayer-playlist-open');
			});
			that.playlistScrollFix();
		},

		playlistScrollFix: function(){
			var that = this;
			that.playlistContainer.on( 'mousewheel DOMMouseScroll', function ( e ) {
			    var e0 = e.originalEvent,
			        delta = e0.wheelDelta || -e0.detail;

			    this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
			    e.preventDefault();
			});
		},

		/**
		 * Create the listeners
		 */
		createListeners: function(){
			var that = this;
			that.myAudio.addEventListener("loadstart", function(){
				that.pauseButton.addClass('loading').css({'pointer-events': 'none'}).find('i').animate({opacity: 0.3}, 500);
			}, false);
			that.myAudio.addEventListener("durationchange", function(){
				that.bufferUpdate();
			}, false);
			that.myAudio.addEventListener("progress", function(){
				that.bufferUpdate();
			}, false);
			that.myAudio.addEventListener("timeupdate", function(){
				that.timeUpdate();
			}, false);
			that.myAudio.addEventListener("canplay", function () {
				that.pauseButton.removeClass('loading').css({'pointer-events': 'initial'}).find('i').animate({opacity: 1}, 500);
				that.duration = that.myAudio.duration;
				if(that.playlist[that.currentSong].type === 'radio'){
					jQuery('[data-erplayer-duration]').html('');
				} else {
					that.durationTime.html( that.formatSecondsAsTime(  that.myAudio.duration.toString() ) );
				}
			}, false);
			that.myAudio.addEventListener("ended", function(){
				that.nextTrack();
			}, false);
		},
		

		/**
		 * Marquee for longer texts
		 */
		
		marqueeText: function( that, applyOnlyToSongs ) {

			if('function' !== typeof( $.fn.marquee ) ){ // missing marquee library? quit
				return;
			}
			
			var marquees = that.player.find('.erplayer-marquee');
			if( true === applyOnlyToSongs ){
				marquees = that.player.find('.erplayer__info__artist, .erplayer__info__album');
			}


			// Destroy any old instance of the marquee
			if( that.marqueeInstances.length > 0 ){
				for( var mi = 0; mi < that.marqueeInstances.length; mi++ ){
					if( 'undefined' !== typeof( that.marqueeInstances[mi] )){
						that.marqueeInstances[mi].marquee('destroy');
					}
				}
				that.player.find('.erplayer-marquee').marquee('destroy');
				that.marqueeInstances = []; // reset
				// console.log('second run');
				// return;
			}
			$.each(marquees, function(i,c){
				var item = $(c);
				if(item.find('.js-marquee').length === 0){
					// item.html('<span class="js-marquee">'+item.html()+'</span>');
				}

				if(  item.outerWidth() >  item.find('span').outerWidth() ){ // the title is short? quit!
					return;
				}
				that.marqueeInstances[i] = item.marquee({
					duration: 12000,
					gap: item.outerWidth(),
					delayBeforeStart: 1000,
					direction: 'left',
					duplicated: false,
					pauseOnCycle: 5000,
					startVisible: true
				});
			});

		
			
		},
		refreshPlaylist: function(){
			var that = this;
			that.playlist = [];
			that.playlistItems = that.player.find('[data-erplayer-trackdata]');
			// LOOP: Each item in the playlist
			if( 0 === that.playlistItems.length ){
			
				that.cover.hide();
				that.songtitle.html('No channels');
				that.album.html('Check settings');
				return;
			} else {
				that.cover.show();
			}
			that.playlistItems.each(function(i,c){
				var item = $(c);
				that.playlist[i] = item.data('erplayer-trackdata');
				item.attr('data-erplayer-playlist-id', i);
				item.on('click', function(e){
					e.preventDefault();
					if( that.currentSong === i ){
						if(that.playerState === 'play'){
							item.removeClass('erplayer-track-active');
							that.pauseSound();
						} else {
							item.addClass('erplayer-track-active');
							that.playSound();
							that.playlistContainer.removeClass('open');
							that.toggler.removeClass('open');
							that.player.removeClass('erplayer-playlist-open');
						}
					} else {
						that.player.find('.erplayer-track-active').removeClass('erplayer-track-active');
						item.addClass('erplayer-track-active');
						that.currentSong = i;
						that.pauseSound();
						that.loadSound();
						that.playSound();
						that.playlistContainer.removeClass('open');
						that.toggler.removeClass('open');
						that.player.removeClass('erplayer-playlist-open');
					}
				});
			});
		},


		//  * =======================================================================
		//  * FEED READERS
		//  * =======================================================================
		 
		readShoutcast: function(that){
			var protocol 	= 'http';
			
			var mydata = false;
			var shoutcastUrl;
			var feedurl;
			var feedData = that.qtFeedData;
			var channel = feedData.shoutcast_channel || 1;
			
			if(feedData.shoutcast_port === '443' || feedData.shoutcast_protocol === 'https' ){
				protocol 	= 'https';
			}
			
			shoutcastUrl = protocol+'://'+feedData.shoutcast_host+':'+feedData.shoutcast_port+'/stats?sid='+channel+'&json=1';
			feedurl 	= shoutcastUrl;
			if(feedData.use_proxy && that.proxyURL){
				feedurl = that.proxyURL;
				mydata = {
					"qtproxycall":  window.btoa(shoutcastUrl)
				};
			}
			$.ajax({
				type: 'GET',
				cache: false,
				url: feedurl,
				async: true,
				data: mydata,
				contentType: "application/json",
				success: function(json) {
					if('object' !== typeof( json )){
						json = JSON.parse(json);
					}
					that.result =  json.songtitle;
					that.applyTitle();
				}
			});
		},
		readIcecast: function(that){
			var feedurl = that.qtFeedData.icecast_url;
			var source;
			var title;
			var songdata;
			if(that.qtFeedData.use_proxy && that.proxyURL){
				feedurl = that.proxyURL;
				songdata = {
			        "qtproxycall":   window.btoa(that.qtFeedData.icecast_url),
			    };
			}
			
			$.ajax({
				type: 'GET',
				cache: false,
				url: feedurl,
				async: true,
				jsonpCallback: "parseMusic",
				jsonp: false,
				// dataType: 'jsonp', // not working with some radios
				data: songdata,
				// contentType: "application/json",
				success: function(json) {
					if('object' !== typeof( json )){
						json = JSON.parse(json);
					}
					source = json.icestats.source;

					if('undefined' === typeof(source)){ 
						return; 
					}
					if(that.qtFeedData.icecast_mountpoint){
						source = source[that.qtFeedData.icecast_mountpoint];
					}
					if(that.qtFeedData.icecast_channel){
						source = source[that.qtFeedData.icecast_channel];
					}
					if("undefined" === typeof(source.title)){
						source = source[0];
					}
					title = source.title;
					if( source.artist ){
						title = title +' - '+source.artist;
					}
					that.result = title;
					that.applyTitle();
				}
			});
		},

		readAirtime: function(that){
			$.ajax({
				type: 'GET',
				cache: false,
				url: that.proxyURL,
				async: true,
				data: {
			        "qtproxycall":   window.btoa(that.qtFeedData.airtime),
			    },
				contentType: "application/json",
				success: function(data) {
					var jsondata = JSON.parse(data);
					that.result =  jsondata.tracks.current.name;
					that.applyTitle();
				}
			});
		},
		readText: function(that){
			var tfeedurl = that.qtFeedData.textfeed;
			if(that.qtFeedData.use_proxy && that.proxyURL){
				tfeedurl = that.proxyURL;
			}
			$.ajax({
				type: 'GET',
				cache: false,
				url: tfeedurl,
				async: true,
				dataType: "text",
				data: { "qtproxycall":  window.btoa(that.qtFeedData.textfeed) },
				success: function(data) {
					that.result = data;
					that.applyTitle();
				}
			});
		},
		readRadioDotCo: function(that){
			$.ajax({
				type: 'GET',
				cache: false,
				url: 'https://public.radio.co/stations/' + that.qtFeedData.radiodotco + '/status',
				async: true,
				contentType: "application/json",
				success: function(data) {
					that.result = data.current_track.title;
					that.applyTitle();
				}
			});
		},
		readLive365: function(that){
			var originalUrl = 'https://api.live365.com/station/'+that.qtFeedData.live365;
			var feedUrl = originalUrl;
			if(that.qtFeedData.use_proxy && that.proxyURL){
				feedUrl = that.proxyURL;
			}
			$.ajax({
				type: 'GET',
				cache: false,
				url: feedUrl,
				data: { "qtproxycall":  window.btoa(originalUrl) },
				async: true,
				success: function(data) {
					var jsondata = JSON.parse(data);
					that.result = jsondata['current-track'].artist+' - '+jsondata['current-track'].title;
					that.applyTitle();
				}
			});
		},
		readRadionomy: function(that){
			var originalUrl = 'http://api.radionomy.com/currentsong.cfm?radiouid='+that.qtFeedData.radionomy_userid+'&apikey='+that.qtFeedData.radionomy_apikey+'&callmeback=yes&type=xml&cover=yes';
			var feedUrl = originalUrl;
			$.ajax({
			   	type: 'GET',
				url: feedUrl,
				async: true,
				cache: false,
				dataType: "xml",
				jsonpCallback: "parseMusic",
				jsonp: true,
				success: function(data) {
					that.result = $(data).find('artists').html()+ ' - ' + $(data).find('title').html();
					that.applyTitle();
				}
			});
		},
		readAuto: function(that){
			var $url = that.qtFeedData.file;
			$.ajax({
			   	type: 'GET',
				url: that.proxyURL,//$url,
				headers: {
			        "Icy-MetaData":"1",
			    },
			    jsonpCallback: 'parseMusic',
				async: true,
				cache: false,
				data: { "qtproxycall":  window.btoa($url), 'icymetadata': '1'  },
				success: function(data) {
					that.result = data;
					that.applyTitle();
				}
			});
		},
		// ----------------------------------------------- FEED READERS END ------------------------------------
		getThumbnail: function(){
			var that = this;
			var term =  that.result.split(' - ').join('-').split(' ').join('+').split('(').join('+').split(')').join('+').split('[').join('+').split(']').join('+');
			var thumb; // image from itunes
			var album; // album title from itunes
			var apiUrl = 'https'+'://'+'itunes'+'.apple'+'.com/'+'search?'+'term='+term;
			$.ajax({
				type: 'GET',
				cache: true,
				url: apiUrl,
				async: true,
				dataType: 'jsonp',
				context: this,
				success: function(json) {
					if('object' !== typeof( json )){
						json = JSON.parse(json);
					}
					if(json.resultCount > 0){
						thumb = json.results[0].artworkUrl100;
						album = json.results[0].collectionName;
						that.cover.show().html('<img src="'+thumb+'">');
						that.bg.show().html('<img src="'+thumb+'">');
					} else {
						if( that.defaultCover ){
							that.cover.show().html('<img src="'+that.defaultCover+'">');
							that.bg.show().html('<img src="'+that.defaultCover+'">');
						} else {
							that.cover.hide();
							that.bg.hide();
						}
					}
				}
			});
		},
		applyTitle: function( ){
			var that = this;
			var result = that.result;
			if(result === undefined){
				return;
			}
			that.album.html('').hide();
			that.artist.html('').hide();

			var albumHolder = that.album.closest('.erplayer__info__album');
			var artistHolder = that.album.closest('.erplayer__info__artist');
			albumHolder.html('<span data-erplayer-album="" style="display: none;"></span>');
			artistHolder.html('<span data-erplayer-artist="" style="display: none;"></span>');
			that.artist = that.player.find('[data-erplayer-artist]');
			that.album = that.player.find('[data-erplayer-album]');


			if(false !== result && result !== ''){
				var feedsplit = result.split(" - "), artist = '', album = '';
				if(feedsplit.length > 1){
					artist = feedsplit[0];
					album = feedsplit[1];
				} else {
					artist = "";
					album = result;
				}
				that.album.show();
				that.artist.show();
				that.album.html(album);
				that.artist.html(artist);
			} else {
				that.album.html( that.playlist[that.currentSong].album ).show();
			}

			var applyOnlyToSongs = true;
			that.marqueeText( that , applyOnlyToSongs );
			if( false !== that.cover ){ // if a selector is specified, fetch the cover artwork
				that.getThumbnail();
			}
			return;
		},
		stopFeed: function(qtFeedInterval){
			if( false !== qtFeedInterval ){
				clearInterval( qtFeedInterval );
			}
		},

		startFeed: function(){

			// local variables
			var that = this;

			// object state vars
			that.qtFeedData = that.playlist[that.currentSong];
			if( !that.qtFeedData.server_type ){
				that.album.html( that.playlist[that.currentSong].album ).show();
				that.marqueeText( that, true );
				return;
			}
			that.result = '';
			that.applyTitle();
			that.feedFunction = {};
			that.feedFunction.type = that.qtFeedData.server_type;
			that.feedFunction.func = false;
			// Stop the feed
			that.stopFeed( that.qtFeedInterval );		
			// Pick the right function
			switch( that.qtFeedData.server_type ) {
				case 'type-shoutcast':
					that.feedFunction.func = that.readShoutcast;
					break;
				case 'type-icecast':
					that.feedFunction.func = that.readIcecast;
					break;
				case 'type-radiodotco':
					that.feedFunction.func = that.readRadioDotCo;
					break;
				case 'type-airtime':
					that.feedFunction.func = that.readAirtime;
					break;
				case 'type-radionomy':
					that.feedFunction.func = that.readRadionomy;
					break;
				case 'type-live365':
					that.feedFunction.func = that.readLive365;
					break;
				case 'type-text':
					that.feedFunction.func = that.readText;
					break;
				case 'type-auto':
					that.feedFunction.func = that.readAuto;
					break;
				default:
					return; // type is required, no type no titles
			}

			// Execute the selected function
			that.feedFunction.func(that);
			that.qtFeedInterval = setInterval(
				function(){ 
					that.feedFunction.func(that);
				}, 
				that.options.timeInterval
			);
		},
		
		loadSound: function(){
			var that = this;
			if( that.playlist.length === 0 ){
				return;
			}
			that.cue.val( 0 );
			that.audio.html( '<source src="'+that.playlist[that.currentSong].file+'" type="audio/mp3" style="display:none">' );
			that.myAudio.src =  that.playlist[ that.currentSong ].file;
			that.audio.title = that.playlist[that.currentSong].title;
			that.channelCount = 0;
			that.audio.load();
			that.artist.html('');
			that.songtitle.html('');
			that.album.html('');
			that.formatCheck();
			
			/**
			 * Stop song titles feed reading
			 */
			that.stopFeed();

			// Debugging - here is the problem. Do destroy first
			// 
			// 
			
			// that.player.find('.erplayer-marquee').marquee('destroy');

			if( that.playlist[that.currentSong].title ){
				that.songtitle.html( that.playlist[that.currentSong].title );
			}


			if( that.playlist[that.currentSong].artist ){
				that.artist.html( that.playlist[that.currentSong].artist );
			}
			
			if( that.playlist[that.currentSong].album ){
				that.album.html( that.playlist[that.currentSong].album );
			}


			//-------------------- COVER OR LOGO --------------------
			// Any channel can have its own logo, or use the logo from
			// the Elementor default image parameter.
			//=======================================================
			that.defaultCover = false;
			if( that.playlist[that.currentSong].artwork ){
				that.defaultCover = that.playlist[that.currentSong].artwork;
			} else {
				if( that.options.defaultImage && that.options.displayDefault ){
					that.defaultCover = that.options.defaultImage;	
				}
			}
			if( that.defaultCover ){
				that.cover.show();
				that.bg.show();
				that.cover.html('<img src="'+that.defaultCover+'">');
				that.bg.html('<img src="'+that.defaultCover+'">');
			} else {
				that.cover.html('');
				that.bg.html('');
				that.cover.hide();
				that.bg.hide();
			}
			that.playhead.width(0);
			that.bufferhead.width(0);
			if(that.playlist[that.currentSong].type === 'radio'){
				that.playhead.css({ 'width' : (that.progressbarWidth - 11)  + "px" });
				that.progressbar.addClass('disabled');
			} else {
				that.progressbar.removeClass('disabled');
			}
			// If we have the songs feed library, let's load the title and cover
			// if(that.channelCount>=8){
			// 	return;
			// }
			if( 'radio' === that.playlist[that.currentSong].type ){
				that.startFeed();
			}
			if(that.playerState === 'play'){
				that.playSound();
			}
		},
		switchState: function(){
			if( this.playerState === 'play' ){
				this.controls.addClass('erplayer-playing');
			} else {
				this.controls.removeClass('erplayer-playing');
			}
		},
		toRegEx: function(a){
			return new RegExp(a);
		},
		playSound: function(){
			// Pause other players first
			$.each( $.erplayerWidgets , function(){
				$(this).theplayer('pauseSound');
			});
			// Then play
			var that = this;
			if(that.playlist[that.currentSong].type === 'radio' && true === that.radioIsPaused ){
				that.myAudio.src = that.playlist[that.currentSong].file;
			}
			that.myAudio.play();
			that.playerState = 'play';
			that.switchState();
		},
		radioIsPaused: false,
		pauseSound: function(){
			var that = this;
			that.myAudio.pause();
			if(that.playlist[that.currentSong].type === 'radio'){
				that.myAudio.src = null;
				that.radioIsPaused = true;
			}
			that.playerState = 'pause';
			that.switchState();
			that.stopFeed();
		},
		nextTrack: function(){
			if((this.currentSong + 1) === this.playlist.length){
				this.currentSong = 0;
			} else {
				this.currentSong++;
			}
			this.loadSound();
		},
		prevTrack: function(){
			if((this.currentSong - 1) === -1){
				this.currentSong = 0;
			} else {
				this.currentSong--;
			}
			this.loadSound();
		},
		timeUpdate: function(){
			var that = this;
			var myAudio = document.getElementById('erplayer-audio');
			that.playPercent =  myAudio.currentTime / myAudio.duration;
			that.timer.html( that.formatSecondsAsTime( that.myAudio.currentTime.toString() ) );
			if(!isNaN(that.playPercent)){
				if( that.playlist[that.currentSong].type !== 'radio' ){
					that.playhead.css({ 'width' : (that.progressbarWidth - 13) * that.playPercent + "px" });
					that.cue.val( that.playPercent );
				}
			}
		},
		bufferUpdate: function(){
			var that = this;
			if(that.myAudio.duration === Infinity || that.playlist[that.currentSong].type === 'radio'){
				return;
			}
			if( that.myAudio.duration > 0 ){
				that.bufferPercent = that.myAudio.buffered.end(0) / that.myAudio.duration;
				that.bufferhead.css({ 'width' : (that.progressbarWidth - 12) * that.bufferPercent + "px" });
			}
		},
		getBarsWidth: function(){
			this.progressbarWidth = this.progressbar.width();
			this.volumebarWidth = this.volumeBar.width();
		},
		formatSecondsAsTime: function(secs) {
			var hr  = Math.floor(secs / 3600);
			var min = Math.floor((secs - (hr * 3600))/60);
			var sec = Math.floor(secs - (hr * 3600) -  (min * 60));
			if (sec < 10){ 
				sec  = "0" + sec;
			}
			return min + ':' + sec;
		},
		seekCue: function(){
			var that = this;
			if(this.playlist[that.currentSong].type === 'radio'){
				return;
			}
			that.seekPoint = that.cue[0].value ;
			that.myAudio.currentTime = that.seekPoint * that.myAudio.duration;
		},
		formatCheck: function(){
			var that = this;
			$.each(that.options.fileFormats, function(i,f){
            	f = f.split('.');
            	f = f[1];
            	var fr = that.toRegEx(f);
            	if( fr.test(that.myAudio.src) ){
	            	that.channelCount++;
	            }
            });
		},
		setVolume: function(){
			this.volumeLevel = this.volume[0].value ;
			this.volumeBar.css({ 'width' : (this.volumebarWidth - 13) * this.volumeLevel + "px" });
			this.myAudio.volume = this.volumeLevel;
			if(this.volumeLevel > 0){
				this.muteBtn.removeClass('muted');
			} else {
				this.muteBtn.addClass('muted');
			}
		}
	};

	// Prevent the popup from being recognized as mobile
	$.erplayerIsMobile = function(){
		var res = window.screen.width * window.devicePixelRatio;
		var test = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || res < 1170 ;
		return test;
	};

	$.fn.erplayerPopupWindow = function(){
		$("body").on("click", ".qt-popupwindow", function(e){
			e.preventDefault();
			var settings, parameters, winObj;
			// for overrideing the default settings
			var btn = $(this),
				destination = btn.attr("href"),
				name = btn.attr("data-name"),
				width= btn.attr("data-width"),
				height= btn.attr("data-height");

			settings = {
				height:600, // sets the height in pixels of the window.
				width:600, // sets the width in pixels of the window.
				toolbar:0, // determines whether a toolbar (includes the forward and back buttons) is displayed {1 (YES) or 0 (NO)}.
				scrollbars:1, // determines whether scrollbars appear on the window {1 (YES) or 0 (NO)}.
				status:0, // whether a status line appears at the bottom of the window {1 (YES) or 0 (NO)}.
				resizable:1, // whether the window can be resized {1 (YES) or 0 (NO)}. Can also be overloaded using resizable.
				left:0, // left position when the window appears.
				top:0, // top position when the window appears.
				center:0, // should we center the window? {1 (YES) or 0 (NO)}. overrides top and left
				createnew:1, // should we create a new window for each occurance {1 (YES) or 0 (NO)}.
				location:0, // determines whether the address bar is displayed {1 (YES) or 0 (NO)}.
				menubar:0, // determines whether the menu bar is displayed {1 (YES) or 0 (NO)}.
				onUnload:null // function to call when the window is closed
			};
			if(width) {
				settings.width = width;
			}
			if(height) {
				settings.height = height;
			}
			// center the window
			if (settings.center === 1)
			{
				settings.top = (screen.height-(settings.height + 110))/2;
				settings.left = (screen.width-settings.width)/2;
			}
			parameters = "location=" + settings.location + ",menubar=" + settings.menubar + ",height=" + settings.height + ",width=" + settings.width + ",toolbar=" + settings.toolbar + ",scrollbars=" + settings.scrollbars  + ",status=" + settings.status + ",resizable=" + settings.resizable + ",left=" + settings.left  + ",screenX=" + settings.left + ",top=" + settings.top  + ",screenY=" + settings.top;
			/*
			Main popup opening function
			 */
			winObj = window.open(destination, name, parameters);
			var unloadInterval;
			if (settings.onUnload) {
				unloadInterval = setInterval(function() {
					if (!winObj || winObj.closed) {
						clearInterval(unloadInterval);	
						settings.onUnload.call($(this));
					}
				},500);
			}
			return false;
		});
	};

	/**
	 * Initialization function
	 * used also by Elementor editor, don't rename this
	 */
	$.elementorRadioPlayerInit = function(){
		$.widget("erplayer.theplayer", $.erplayer);
		$.erplayerWidgets = [];
		$("[data-erplayer-widget]").each(function(){
			var player = $(this).theplayer();
			$.erplayerWidgets.push( player );
		});
		$.fn.erplayerPopupWindow();
	};

	/**====================================================================
	 *
	 *	Page Ready Trigger
	 * 
	 ====================================================================*/
	$(document).ready(function() {
		$.elementorRadioPlayerInit();
	});
} )( jQuery );
<?php
/**
 * @package WordPress
 * @subpackage Elemento Radio Player
 * @version 1.0.0
*/

// Declared once to reuse in all the queries
if(!function_exists('erplayer_radiochannel_name')){
	function erplayer_radiochannel_name(){
		return 'erplayer-raiochannel';
	}
}


if(!function_exists('erplayer_register_type_radiochannel')){
	add_action( 'init', 'erplayer_register_type_radiochannel' );
	function erplayer_register_type_radiochannel() {
		
		$labelsradio = array(
			'name' => esc_html__("Radio channels","erplayer"),
			'singular_name' => esc_html__("Radio channel","erplayer"),
			'add_new' => esc_html__('Add new channel',"erplayer"),
			'add_new_item' => esc_html__("Add new radio channel","erplayer"),
			'edit_item' => esc_html__("Edit radio channel","erplayer"),
			'new_item' => esc_html__("New radio channel","erplayer"),
			'all_items' => esc_html__('All radio channels',"erplayer"),
			'view_item' => esc_html__("View radio channel","erplayer"),
			'search_items' => esc_html__("Search radio channels","erplayer"),
			'not_found' =>  esc_attr__("No radio channels found","erplayer"),
			'not_found_in_trash' => esc_html__("No radio channels found in Trash","erplayer"), 
			'parent_item_colon' => '',
			'menu_name' => esc_html__("Radio channels","erplayer")
		);
	    $args = array(
	    	'labels' => $labelsradio,
	        'public' => true,
			'publicly_queryable' => false,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => 'radio-channel' ),
			'capability_type' => 'page',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => 50,
			'page-attributes' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-media-audio',
			'supports' => array('title','thumbnail', 'page-attributes')
	    );
	    register_post_type( erplayer_radiochannel_name(), $args );

	}
	function erplayer_radiochannel_flush() {
	    erplayer_register_type_radiochannel();
	    flush_rewrite_rules();
	}
	register_activation_hook( __FILE__, 'erplayer_radiochannel_flush' );
}

/* = Fields
===================================================*/
function erplayer_radiochannel_customfields(){
	
	$radio_details = array(
		array(
			'label' => esc_html__('MP3 Stream URL', 'erplayer' ),
			'id'    => 'erplayer_mp3',
			'type'  => 'text'
			),
		array(
			'label' => esc_html__('Radio subtitle', 'erplayer' ),
			'id'    => 'erplayer_subtitle',
			'type'  => 'text'
			),
		array(
			'label' => esc_html__('Radio logo', 'erplayer' ),
			'id'    => 'erplayer_logo',
			'type'  => 'image'
			),
		array(
			'label' => esc_html__('Server type',		 'erplayer' ),
			'id'    => 'erplayer_servertype',
			'type' 	=> 'select',
			'default' => false,
			'options' => array (
				array(
					'label' => esc_html__( 'Metadata',		 'erplayer' ), 
					'value' => 'type-auto' 
				),	
				array(
					'label' => esc_html__( 'SHOUTcast',		 'erplayer' ), 
					'value' => 'type-shoutcast' 
				),	
				array(
					'label' => esc_html__( 'IceCast', "erplayer" ), 
					'value' => 'type-icecast' ,	
				),
				array(
					'label' => esc_html__( 'Radio.co', "erplayer" ), 
					'value' => 'type-radiodotco' ,	
				),
				array(
					'label' => esc_html__( 'AirTime', "erplayer" ), 
					'value' => 'type-airtime' 
				),
				array(
					'label' => esc_html__( 'Radionomy', "erplayer" ), 
					'value' => 'type-radionomy' ,	
				),
				array(
					'label' => esc_html__( 'Live365', "erplayer" ), 
					'value' => 'type-live365' ,	
				),
				array(
					'label' => esc_html__( 'Plain text (author - title)', "erplayer" ), 
					'value' => 'type-text' ,	
				)
			)//options
		),
		array(
			'label' => esc_html__('SHOUTCast XMl Feed HOST', 'erplayer' ),
			'id'    => 'erplayer_shoutcast_host',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-shoutcast'
				)
			)
		),
		array(
			'label' => esc_html__('SHOUTCast XMl Feed PORT', 'erplayer' ),
			'id'    => 'erplayer_shoutcast_port',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-shoutcast'
				)
			)
			),
		array(
			'label' => esc_html__('SHOUTCast Channel (default 1)', 'erplayer' ),
			'id'    => 'erplayer_shoutcast_channel',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-shoutcast'
				)
			)
			),
		array(
			'label' 	=> esc_html__('SHOUTCast protocol', 'erplayer' ),
			'id'    	=> 'erplayer_shoutcast_protocol',
			'desc'		=> esc_html__('Force HTTPS protocol for non-443 port. Ask your streaming provider for the right settings.', 'erplayer'),
			'type' 		=> 'select',
			'default' 	=> "http",
			'options' 	=> array (
				array(
					'label' => esc_html__( 'Automatic (uses https when port is 443)', "erplayer" ), 
					'value' => 'http' 
				),	
				array(
					'label' => esc_html__( 'Force HTTPS', "erplayer" ), 
					'value' => 'https',	
				)
			),
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-shoutcast'
				)
			)
		),
		array(
			'label' => esc_html__('IceCast json URL', 'erplayer' ),
			'id'    => 'erplayer_icecasturl',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-icecast'
				)
			),
			'desc' 	=> esc_html__('Important! Needs to be in your same protocol of the website! If your site is in https you have to put the URL with https and your icecast server needs to support this', 'erplayer'),
			),
		array(
			'label' => esc_html__('IceCast mountpoint (including "/")', 'erplayer' ),
			'id'    => 'erplayer_icecast_mountpoint',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-icecast'
				)
			),
			'desc' 	=> esc_html__('Optional', 'erplayer' ),
			'type'  => 'text'
			),
		array(
			'label' => esc_html__('IceCast channel',		 'erplayer' ),
			'desc'  => esc_html__('only for Icecast radios with multi-channel feed', 'erplayer'),
			'id'    => 'erplayer_icecast_channel',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-icecast'
				)
			),
			'type'  => 'text'
			),
		array(
			'label' => esc_html__('Radio.co radio ID', 'erplayer' ),
			'id'    => 'erplayer_radiodotco',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-radiodotco'
				)
			),
			'desc' 	=> esc_html__('For Radio.co users, find the ID in the streaming URL, example: https://streamer.radio.co/[YOUR ID]/listen#.mp3', 'erplayer'),
			),
		array(
			'label' => esc_html__('Airtime', 'erplayer' ),
			'id'    => 'erplayer_airtime',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-airtime'
				)
			),
			'desc' 	=> esc_html__('For AirTime Pro users add your API url (http://[YOUR ID].airtime.pro/api/live-info-v2)', 'erplayer'),
			),
		array(
			'label' => esc_html__('Radionomy user ID', 'erplayer' ),
			'id'    => 'erplayer_radionomy_userid', 
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-radionomy'
				)
			),
			'desc' 	=> esc_html__('Looks like xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx', 'erplayer'),
			),
		array(
			'label' => esc_html__('Radionomy API key', 'erplayer' ),
			'id'    => 'erplayer_radionomy_apikey',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-radionomy'
				)
			),
			'desc' 	=> esc_html__('Looks like xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx', 'erplayer'),
			),
		array(
			'label' => esc_html__('Live365 ID',		 'erplayer' ),
			'id'    => 'erplayer_live365',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-live365'
				)
			),
			'desc' => esc_html__('Alphanumeric ID only, not the full URL. Example: for the channel http://player.live365.com/x12345?l input only x12345', 'erplayer'),
			),
		array(
			'label' => esc_html__('Plain text', 'erplayer' ),
			'id'    => 'erplayer_textfeed',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'erplayer_servertype',
					'value'	=> 'type-text'
				)
			),
			'desc' 	=> esc_html__('If you have a URL displaying a plain text as ARTIST NAME - SONG TITLE add the URL in this field.', 'erplayer'),
			),
		array(
			'label' => esc_html__('Exclude from playlist', 'erplayer'),
			'id'    => 'erplayer_exclude',
			'type'  => 'checkbox',
			'desc' 	=> esc_html__('Do  not include this radio channel in the default playlist.', 'erplayer'),
			),
		array(
			'label' => esc_html__('Use proxy', 'erplayer'),
			'id'    => 'erplayer_useproxy',
			'type'  => 'checkbox',
			'desc' 	=> esc_html__("Try this option if you can't see any title. The ajax request will be served by an internal PHP proxy to fix CORS block caused by some radio providers", 'erplayer')
			),
	);
	if (class_exists('Metaboxes_Custom_Add_Meta_Box')){
		$erplayer_radiochannel_metas = new Metaboxes_Custom_Add_Meta_Box( 'erplayer_radiochannel_metas', 'Radio channel details', $radio_details, erplayer_radiochannel_name(), true );
	}
}

add_action('wp_loaded', 'erplayer_radiochannel_customfields');  

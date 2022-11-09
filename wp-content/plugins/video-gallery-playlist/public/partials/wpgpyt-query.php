<?php

$wpgpyg_api_key  = wpgpyg_get_options( 'wpgp_api_key' );
$wpgpyg_base_url = 'https://www.googleapis.com/youtube/v3/';

$wpgpyg_video_duration_link = '';
if ( 'any' !== $wpgpyt_video_duration ) {

	$wpgpyg_video_duration_link = 'videoDuration=' . $wpgpyt_video_duration . '&';
}

$wpgpyg_video_published_link = '';
if ( 'current' !== $wpgpyt_published_before_after ) {

	switch ( $wpgpyt_published_before_after ) {
		case 'before':
			$wpgpyg_video_published_link = $wpgpyt_date_before;
			break;

		case 'after':
			$wpgpyg_video_published_link = $wpgpyt_date_after;
			break;

		default:
			$wpgpyg_video_published_link = '';
			break;
	}
}

if ( 'playlist' === $wpgpyt_video_from ) {

	// Playlist.
	$wpgpyg_api_url = $wpgpyg_base_url . 'playlistItems?part=snippet&maxResults=' . $wpgpyg_max_result . '&playlistId=' . $wpgpyg_playlist_id . '&key=' . $wpgpyg_api_key;

} else {

	// Channel.
	$wpgpyg_api_url = $wpgpyg_base_url . 'search?' . $wpgpyg_video_duration_link . $wpgpyg_video_published_link . 'key=' . $wpgpyg_api_key . '&channelId=' . $wpgpyg_channel_id . '&part=snippet,id&order=' . $wpgpyg_order . '&maxResults=' . $wpgpyg_max_result;
}

$wpgpyg_request    = wp_remote_get( $wpgpyg_api_url );
$wpgpyg_response   = wp_remote_retrieve_body( $wpgpyg_request );
$wpgpyg_get_videos = json_decode( $wpgpyg_response );

if ( 'playlist' === $wpgpyt_video_from ) {

	// Playlist.
	$wpgpyg_first_video_id = $wpgpyg_get_videos->items[0]->snippet->resourceId->videoId;

} else {

	// Channel.
	$wpgpyg_first_video_id = $wpgpyg_get_videos->items[0]->id->videoId;
}

<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Metabox of the PAGE and POST both.
// Set a unique slug-like ID
//
$prefix_meta_opts = '_prefix_meta_options';

//
// Create a metabox
//
WPGP::createMetabox(
	$prefix_meta_opts,
	array(
		'title'     => 'Shortcode',
		'post_type' => 'wpgp_youtube_gallery',
		'context'   => 'side',
	)
);

//
// Create a section
//
if ( isset( $_GET['post'] ) ) {

	WPGP::createSection(
		$prefix_meta_opts,
		array(
			'fields' => array(

				array(
					'type'  => 'shortcode',
					'class' => 'wpgp--shortcode-field',
				),
			),
		)
	);
} else {

	WPGP::createSection(
		$prefix_meta_opts,
		array(
			'fields' => array(

				array(
					'type'    => 'content',
					'content' => 'Shortcode will appear here after publish the slider.',
				),

			),
		)
	);
}

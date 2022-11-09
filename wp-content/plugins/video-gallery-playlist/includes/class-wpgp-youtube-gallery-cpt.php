<?php

/**
 * The file that defines the Custom Post Type of the plugin.
 *
 * @link       https://www.grandplugin.com
 * @since      1.0.0
 *
 * @package    WPGP_YouTube_Gallery
 * @subpackage WPGP_YouTube_Gallery/includes
 */

/**
 * The file that defines the Custom Post Type of the plugin.
 *
 * @since      1.0.0
 * @package    WPGP_YouTube_Gallery
 * @subpackage WPGP_YouTube_Gallery/includes
 * @author     GrandPlugin <help@grandplugin.com>
 */
class WPGP_YouTube_Gallery_CPT {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Settings page ID for post-to-card settings.
	 */
	const PAGE_ID = 'wpgp_youtube_gallery';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Custom Post Type of the Plugin.
	 *
	 * @since    1.0.0
	 */
	public function wpgp_custom_post_type() {

		$labels = apply_filters(
			self::PAGE_ID . '_post_type_labels',
			array(
				'name'               => esc_html_x( 'Manage Galleries', 'wpgp-youtube-gallery' ),
				'singular_name'      => esc_html_x( 'Galleries', 'wpgp-youtube-gallery' ),
				'add_new'            => esc_html__( 'Add New', 'wpgp-youtube-gallery' ),
				'add_new_item'       => esc_html__( 'Add New Gallery', 'wpgp-youtube-gallery' ),
				'edit_item'          => esc_html__( 'Edit Galleries', 'wpgp-youtube-gallery' ),
				'new_item'           => esc_html__( 'New Galleries', 'wpgp-youtube-gallery' ),
				'view_item'          => esc_html__( 'View  Galleries', 'wpgp-youtube-gallery' ),
				'search_items'       => esc_html__( 'Search Galleries', 'wpgp-youtube-gallery' ),
				'not_found'          => esc_html__( 'No Gallery found.', 'wpgp-youtube-gallery' ),
				'not_found_in_trash' => esc_html__( 'No Gallery found in trash.', 'wpgp-youtube-gallery' ),
				'parent_item_colon'  => esc_html__( 'Parent Item:', 'wpgp-youtube-gallery' ),
				'menu_name'          => esc_html__( 'YouTube Gallery', 'wpgp-youtube-gallery' ),
				'all_items'          => esc_html__( 'Manage Galleries', 'wpgp-youtube-gallery' ),
			)
		);

		$args = apply_filters(
			self::PAGE_ID . '_post_type_args',
			array(
				'labels'              => $labels,
				'public'              => false,
				'hierarchical'        => false,
				'exclude_from_search' => true,
				'show_ui'             => true,
				'show_in_admin_bar'   => false,
				'menu_position'       => apply_filters( self::PAGE_ID . '_menu_position', 15 ),
				'menu_icon'           => 'dashicons-video-alt3',
				'rewrite'             => false,
				'query_var'           => false,
				'imported'            => true,
				'supports'            => array( 'title' ),
			)
		);
		register_post_type( self::PAGE_ID, $args );

	}

	/**
	 * Change Galleries updated messages.
	 *
	 * @param string $messages The Update messages.
	 * @return statement
	 */
	public function wpps_updated_messages( $messages ) {
		global $post, $post_ID;
		$messages[ self::PAGE_ID ] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => sprintf( __( 'Galleries updated.', 'wpgp-youtube-gallery' ) ),
			2  => '',
			3  => '',
			4  => __( ' updated.', 'wpgp-youtube-gallery' ),
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Galleries restored to revision from %s', 'wpgp-youtube-gallery' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => sprintf( __( 'Galleries published.', 'wpgp-youtube-gallery' ) ),
			7  => __( 'Galleries saved.', 'wpgp-youtube-gallery' ),
			8  => sprintf( __( 'Galleries submitted.', 'wpgp-youtube-gallery' ) ),
			9  => sprintf( __( 'Galleries scheduled for: <strong>%1$s</strong>.', 'wpgp-youtube-gallery' ), date_i18n( __( 'M j, Y @ G:i', 'wpgp-youtube-gallery' ), strtotime( $post->post_date ) ) ),
			10 => sprintf( __( 'Galleries draft updated.', 'wpgp-youtube-gallery' ) ),
		);
		return $messages;
	}

	/**
	 * Admin help page
	 *
	 * @since    2.0.0
	 */
	public function wpgp_help_admin_submenu() {
		add_submenu_page(
			'edit.php?post_type=' . self::PAGE_ID,
			__( 'Help', 'post-to-card' ),
			__( 'Help', 'post-to-card' ),
			'manage_options',
			'grandplugin_help',
			array( $this, 'ptc_help_callback' )
		);
	}

	/**
	 * Safe Welcome Page Redirect.
	 *
	 * Safe welcome page redirect which happens only
	 * once and if the site is not a network or MU.
	 *
	 * @since 1.0.0
	 */
	public function wpgp_safe_welcome_redirect() {
		// Bail if no activation redirect transient is present. (if ! true).
		if ( ! get_transient( '_wpgp_safe_redirect' ) ) {
			return;
		}

		// Delete the redirect transient.
		delete_transient( '_wpgp_safe_redirect' );

		// Bail if activating from network or bulk sites.
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
			return;
		}

		// Redirects to a specific Page.
		wp_safe_redirect(
			add_query_arg(
				array(
					'post_type' => self::PAGE_ID,
					'page'      => 'grandplugin_help',
				),
				admin_url( 'edit.php' )
			)
		);

	}

	/**
	 * Admin help callback function
	 *
	 * @since    1.0.0
	 */
	public function ptc_help_callback() {

		include_once WPGP_YOUTUBE_GALLERY_DIR_PATH_FILE . '/admin/partials/wpgp-youtube-gallery-admin-display.php';
	}

	/**
	 * Bottom review notice.
	 *
	 * @param string $text The review notice.
	 * @return string
	 */
	public function wpgp_review_text( $text ) {

		$screen = get_current_screen();
		if ( self::PAGE_ID === get_post_type() || ( self::PAGE_ID . '_page_grandplugin_help' === $screen->id ) ) {

			$url  = 'https://wordpress.org/plugins/search/grandplugin/';
			$text = sprintf( __( 'If you love this plugin, please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your review is so important to us and we are delighted you are happy to share your experience with others on this platform.', 'wpgp-youtube-gallery' ), $url );
		}

		return $text;
	}

}

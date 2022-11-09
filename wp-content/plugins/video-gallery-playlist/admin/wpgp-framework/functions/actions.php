<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'wpgp_get_icons' ) ) {
  function wpgp_get_icons() {

    if( ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'wpgp_icon_nonce' ) ) {

      ob_start();

      WPGP::include_plugin_file( 'fields/icon/default-icons.php' );

      $icon_lists = apply_filters( 'wpgp_field_icon_add_icons', wpgp_get_default_icons() );

      if( ! empty( $icon_lists ) ) {

        foreach ( $icon_lists as $list ) {

          echo ( count( $icon_lists ) >= 2 ) ? '<div class="wpgp-icon-title">'. $list['title'] .'</div>' : '';

          foreach ( $list['icons'] as $icon ) {
            echo '<a class="wpgp-icon-tooltip" data-wpgp-icon="'. $icon .'" title="'. $icon .'"><span class="wpgp-icon wpgp-selector"><i class="'. $icon .'"></i></span></a>';
          }

        }

      } else {

        echo '<div class="wpgp-text-error">'. esc_html__( 'No data provided by developer', 'wpgp' ) .'</div>';

      }

      wp_send_json_success( array( 'content' => ob_get_clean() ) );

    } else {

      wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'wpgp' ) ) );

    }

  }
  add_action( 'wp_ajax_wpgp-get-icons', 'wpgp_get_icons' );
}

/**
 *
 * Export
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'wpgp_export' ) ) {
  function wpgp_export() {

    if( ! empty( $_GET['export'] ) && ! empty( $_GET['nonce'] ) && wp_verify_nonce( $_GET['nonce'], 'wpgp_backup_nonce' ) ) {

      header('Content-Type: application/json');
      header('Content-disposition: attachment; filename=backup-'. gmdate( 'd-m-Y' ) .'.json');
      header('Content-Transfer-Encoding: binary');
      header('Pragma: no-cache');
      header('Expires: 0');

      echo json_encode( get_option( wp_unslash( $_GET['export'] ) ) );

    }

    die();
  }
  add_action( 'wp_ajax_wpgp-export', 'wpgp_export' );
}

/**
 *
 * Import Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'wpgp_import_ajax' ) ) {
  function wpgp_import_ajax() {

    if( ! empty( $_POST['import_data'] ) && ! empty( $_POST['unique'] ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'wpgp_backup_nonce' ) ) {

      $import_data = json_decode( wp_unslash( trim( $_POST['import_data'] ) ), true );

      if( is_array( $import_data ) ) {

        update_option( wp_unslash( $_POST['unique'] ), wp_unslash( $import_data ) );
        wp_send_json_success();

      }

    }

    wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'wpgp' ) ) );

  }
  add_action( 'wp_ajax_wpgp-import', 'wpgp_import_ajax' );
}

/**
 *
 * Reset Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'wpgp_reset_ajax' ) ) {
  function wpgp_reset_ajax() {

    if( ! empty( $_POST['unique'] ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'wpgp_backup_nonce' ) ) {
      delete_option( wp_unslash( $_POST['unique'] ) );
      wp_send_json_success();
    }

    wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'wpgp' ) ) );

  }
  add_action( 'wp_ajax_wpgp-reset', 'wpgp_reset_ajax' );
}

/**
 *
 * Chosen Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'wpgp_chosen_ajax' ) ) {
  function wpgp_chosen_ajax() {

    if( ! empty( $_POST['term'] ) && ! empty( $_POST['type'] ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'wpgp_chosen_ajax_nonce' ) ) {

      $capability = apply_filters( 'wpgp_chosen_ajax_capability', 'manage_options' );

      if( current_user_can( $capability ) ) {

        $type       = $_POST['type'];
        $term       = $_POST['term'];
        $query_args = ( ! empty( $_POST['query_args'] ) ) ? $_POST['query_args'] : array();
        $options    = WPGP_Fields::field_data( $type, $term, $query_args );

        wp_send_json_success( $options );

      } else {
        wp_send_json_error( array( 'error' => esc_html__( 'You do not have required permissions to access.', 'wpgp' ) ) );
      }

    } else {
      wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'wpgp' ) ) );
    }

  }
  add_action( 'wp_ajax_wpgp-chosen', 'wpgp_chosen_ajax' );
}

/**
 *
 * Set icons for wp dialog
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'wpgp_set_icons' ) ) {
  function wpgp_set_icons() {
    ?>
    <div id="wpgp-modal-icon" class="wpgp-modal wpgp-modal-icon">
      <div class="wpgp-modal-table">
        <div class="wpgp-modal-table-cell">
          <div class="wpgp-modal-overlay"></div>
          <div class="wpgp-modal-inner">
            <div class="wpgp-modal-title">
              <?php esc_html_e( 'Add Icon', 'wpgp' ); ?>
              <div class="wpgp-modal-close wpgp-icon-close"></div>
            </div>
            <div class="wpgp-modal-header wpgp-text-center">
              <input type="text" placeholder="<?php esc_html_e( 'Search a Icon...', 'wpgp' ); ?>" class="wpgp-icon-search" />
            </div>
            <div class="wpgp-modal-content">
              <div class="wpgp-modal-loading"><div class="wpgp-loading"></div></div>
              <div class="wpgp-modal-load"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
  add_action( 'admin_footer', 'wpgp_set_icons' );
  add_action( 'customize_controls_print_footer_scripts', 'wpgp_set_icons' );
}

<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WPGP_Field_backup' ) ) {
  class WPGP_Field_backup extends WPGP_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'wpgp_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'wpgp-export', 'export' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="wpgp_transient[wpgp_import_data]" class="wpgp-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary wpgp-confirm wpgp-import" data-unique="'. $unique .'" data-nonce="'. $nonce .'">'. esc_html__( 'Import', 'wpgp' ) .'</button>';
      echo '<small>( '. esc_html__( 'copy-paste your backup string here', 'wpgp' ).' )</small>';

      echo '<hr />';
      echo '<textarea readonly="readonly" class="wpgp-export-data">'. json_encode( get_option( $unique ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary wpgp-export" target="_blank">'. esc_html__( 'Export and Download Backup', 'wpgp' ) .'</a>';

      echo '<hr />';
      echo '<button type="submit" name="wpgp_transient[wpgp_reset_all]" value="wpgp_reset_all" class="button wpgp-warning-primary wpgp-confirm wpgp-reset" data-unique="'. $unique .'" data-nonce="'. $nonce .'">'. esc_html__( 'Reset All', 'wpgp' ) .'</button>';
      echo '<small class="wpgp-text-error">'. esc_html__( 'Please be sure for reset all of options.', 'wpgp' ) .'</small>';

      echo $this->field_after();

    }

  }
}

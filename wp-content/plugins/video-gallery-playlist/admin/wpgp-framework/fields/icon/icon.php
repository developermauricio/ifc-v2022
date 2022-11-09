<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WPGP_Field_icon' ) ) {
  class WPGP_Field_icon extends WPGP_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'wpgp' ),
        'remove_title' => esc_html__( 'Remove Icon', 'wpgp' ),
      ) );

      echo $this->field_before();

      $nonce  = wp_create_nonce( 'wpgp_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="wpgp-icon-select">';
      echo '<span class="wpgp-icon-preview'. $hidden .'"><i class="'. $this->value .'"></i></span>';
      echo '<a href="#" class="button button-primary wpgp-icon-add" data-nonce="'. $nonce .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button wpgp-warning-primary wpgp-icon-remove'. $hidden .'">'. $args['remove_title'] .'</a>';
      echo '<input type="text" name="'. $this->field_name() .'" value="'. $this->value .'" class="wpgp-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo $this->field_after();

    }

  }
}

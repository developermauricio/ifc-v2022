<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: palette
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WPGP_Field_palette' ) ) {
  class WPGP_Field_palette extends WPGP_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $palette = ( ! empty( $this->field['options'] ) ) ? $this->field['options'] : array();

      echo $this->field_before();

      if( ! empty( $palette ) ) {

        echo '<div class="wpgp-siblings wpgp--palettes">';

        foreach ( $palette as $key => $colors ) {

          $active  = ( $key === $this->value ) ? ' wpgp--active' : '';
          $checked = ( $key === $this->value ) ? ' checked' : '';

          echo '<div class="wpgp--sibling wpgp--palette'. $active .'">';

          if( ! empty( $colors ) ) {

            foreach( $colors as $color ) {

              echo '<span style="background-color: '. $color .';"></span>';

            }

          }

          echo '<input type="radio" name="'. $this->field_name() .'" value="'. $key .'"'. $this->field_attributes() . $checked .'/>';
          echo '</div>';

        }

        echo '</div>';

      }

      echo '<div class="clear"></div>';

      echo $this->field_after();

    }

  }
}

<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: button_set
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WPGP_Field_button_set' ) ) {
  class WPGP_Field_button_set extends WPGP_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'multiple' => false,
        'options'  => array(),
      ) );

      $value = ( is_array( $this->value ) ) ? $this->value : array_filter( (array) $this->value );

      echo $this->field_before();

      if( ! empty( $args['options'] ) ) {

        echo '<div class="wpgp-siblings wpgp--button-group" data-multiple="'. $args['multiple'] .'">';

        foreach( $args['options'] as $key => $option ) {

          $type    = ( $args['multiple'] ) ? 'checkbox' : 'radio';
          $extra   = ( $args['multiple'] ) ? '[]' : '';
          $active  = ( in_array( $key, $value ) || ( empty( $value ) && empty( $key ) )  ) ? ' wpgp--active' : '';
          $checked = ( in_array( $key, $value ) || ( empty( $value ) && empty( $key ) ) ) ? ' checked' : '';

          echo '<div class="wpgp--sibling wpgp--button'. $active .'">';
          echo '<input type="'. $type .'" name="'. $this->field_name( $extra ) .'" value="'. $key .'"'. $this->field_attributes() . $checked .'/>';
          echo $option;
          echo '</div>';

        }

        echo '</div>';

      }

      echo '<div class="clear"></div>';

      echo $this->field_after();

    }

  }
}

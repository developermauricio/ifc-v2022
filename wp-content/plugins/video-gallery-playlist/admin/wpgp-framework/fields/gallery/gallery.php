<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: gallery
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WPGP_Field_gallery' ) ) {
  class WPGP_Field_gallery extends WPGP_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'add_title'   => esc_html__( 'Add Gallery', 'wpgp' ),
        'edit_title'  => esc_html__( 'Edit Gallery', 'wpgp' ),
        'clear_title' => esc_html__( 'Clear', 'wpgp' ),
      ) );

      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo $this->field_before();

      echo '<ul>';

      if( ! empty( $this->value ) ) {

        $values = explode( ',', $this->value );

        foreach ( $values as $id ) {
          $attachment = wp_get_attachment_image_src( $id, 'thumbnail' );
          echo '<li><img src="'. $attachment[0] .'" /></li>';
        }

      }

      echo '</ul>';
      echo '<a href="#" class="button button-primary wpgp-button">'. $args['add_title'] .'</a>';
      echo '<a href="#" class="button wpgp-edit-gallery'. $hidden .'">'. $args['edit_title'] .'</a>';
      echo '<a href="#" class="button wpgp-warning-primary wpgp-clear-gallery'. $hidden .'">'. $args['clear_title'] .'</a>';
      echo '<input type="text" name="'. $this->field_name() .'" value="'. $this->value .'"'. $this->field_attributes() .'/>';

      echo $this->field_after();

    }

  }
}

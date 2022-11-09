<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: background
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WPGP_Field_background' ) ) {
  class WPGP_Field_background extends WPGP_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args                             = wp_parse_args( $this->field, array(
        'background_color'              => true,
        'background_image'              => true,
        'background_position'           => true,
        'background_repeat'             => true,
        'background_attachment'         => true,
        'background_size'               => true,
        'background_origin'             => false,
        'background_clip'               => false,
        'background_blend-mode'         => false,
        'background_gradient'           => false,
        'background_gradient_color'     => true,
        'background_gradient_direction' => true,
        'background_image_preview'      => true,
        'background_image_library'      => 'image',
        'background_image_placeholder'  => esc_html__( 'No background selected', 'wpgp' ),
      ) );

      $default_value                    = array(
        'background-color'              => '',
        'background-image'              => '',
        'background-position'           => '',
        'background-repeat'             => '',
        'background-attachment'         => '',
        'background-size'               => '',
        'background-origin'             => '',
        'background-clip'               => '',
        'background-blend-mode'         => '',
        'background-gradient-color'     => '',
        'background-gradient-direction' => '',
      );

      $default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

      $this->value = wp_parse_args( $this->value, $default_value );

      echo $this->field_before();

      echo '<div class="wpgp--blocks">';

      //
      // Background Color
      if( ! empty( $args['background_color'] ) ) {

        echo '<div class="wpgp--block">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="wpgp--title">'. esc_html__( 'From', 'wpgp' ) .'</div>' : '';

        WPGP::field( array(
          'id'      => 'background-color',
          'type'    => 'color',
          'default' => $default_value['background-color'],
        ), $this->value['background-color'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      //
      // Background Gradient Color
      if( ! empty( $args['background_gradient_color'] ) && ! empty( $args['background_gradient'] ) ) {

        echo '<div class="wpgp--block">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="wpgp--title">'. esc_html__( 'To', 'wpgp' ) .'</div>' : '';

        WPGP::field( array(
          'id'      => 'background-gradient-color',
          'type'    => 'color',
          'default' => $default_value['background-gradient-color'],
        ), $this->value['background-gradient-color'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      //
      // Background Gradient Direction
      if( ! empty( $args['background_gradient_direction'] ) && ! empty( $args['background_gradient'] ) ) {

        echo '<div class="wpgp--block">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="wpgp--title">'. esc_html__( 'Direction', 'wpgp' ) .'</div>' : '';

        WPGP::field( array(
          'id'          => 'background-gradient-direction',
          'type'        => 'select',
          'options'     => array(
            ''          => esc_html__( 'Gradient Direction', 'wpgp' ),
            'to bottom' => esc_html__( '&#8659; top to bottom', 'wpgp' ),
            'to right'  => esc_html__( '&#8658; left to right', 'wpgp' ),
            '135deg'    => esc_html__( '&#8664; corner top to right', 'wpgp' ),
            '-135deg'   => esc_html__( '&#8665; corner top to left', 'wpgp' ),
          ),
        ), $this->value['background-gradient-direction'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      echo '</div>';

      //
      // Background Image
      if( ! empty( $args['background_image'] ) ) {

        echo '<div class="wpgp--media">';

        WPGP::field( array(
          'id'          => 'background-image',
          'type'        => 'media',
          'library'     => $args['background_image_library'],
          'preview'     => $args['background_image_preview'],
          'placeholder' => $args['background_image_placeholder']
        ), $this->value['background-image'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      echo '<div class="wpgp--selects">';

      //
      // Background Position
      if( ! empty( $args['background_position'] ) ) {

        WPGP::field( array(
          'id'              => 'background-position',
          'type'            => 'select',
          'options'         => array(
            ''              => esc_html__( 'Background Position', 'wpgp' ),
            'left top'      => esc_html__( 'Left Top', 'wpgp' ),
            'left center'   => esc_html__( 'Left Center', 'wpgp' ),
            'left bottom'   => esc_html__( 'Left Bottom', 'wpgp' ),
            'center top'    => esc_html__( 'Center Top', 'wpgp' ),
            'center center' => esc_html__( 'Center Center', 'wpgp' ),
            'center bottom' => esc_html__( 'Center Bottom', 'wpgp' ),
            'right top'     => esc_html__( 'Right Top', 'wpgp' ),
            'right center'  => esc_html__( 'Right Center', 'wpgp' ),
            'right bottom'  => esc_html__( 'Right Bottom', 'wpgp' ),
          ),
        ), $this->value['background-position'], $this->field_name(), 'field/background' );

      }

      //
      // Background Repeat
      if( ! empty( $args['background_repeat'] ) ) {

        WPGP::field( array(
          'id'          => 'background-repeat',
          'type'        => 'select',
          'options'     => array(
            ''          => esc_html__( 'Background Repeat', 'wpgp' ),
            'repeat'    => esc_html__( 'Repeat', 'wpgp' ),
            'no-repeat' => esc_html__( 'No Repeat', 'wpgp' ),
            'repeat-x'  => esc_html__( 'Repeat Horizontally', 'wpgp' ),
            'repeat-y'  => esc_html__( 'Repeat Vertically', 'wpgp' ),
          ),
        ), $this->value['background-repeat'], $this->field_name(), 'field/background' );

      }

      //
      // Background Attachment
      if( ! empty( $args['background_attachment'] ) ) {

        WPGP::field( array(
          'id'       => 'background-attachment',
          'type'     => 'select',
          'options'  => array(
            ''       => esc_html__( 'Background Attachment', 'wpgp' ),
            'scroll' => esc_html__( 'Scroll', 'wpgp' ),
            'fixed'  => esc_html__( 'Fixed', 'wpgp' ),
          ),
        ), $this->value['background-attachment'], $this->field_name(), 'field/background' );

      }

      //
      // Background Size
      if( ! empty( $args['background_size'] ) ) {

        WPGP::field( array(
          'id'        => 'background-size',
          'type'      => 'select',
          'options'   => array(
            ''        => esc_html__( 'Background Size', 'wpgp' ),
            'cover'   => esc_html__( 'Cover', 'wpgp' ),
            'contain' => esc_html__( 'Contain', 'wpgp' ),
          ),
        ), $this->value['background-size'], $this->field_name(), 'field/background' );

      }

      //
      // Background Origin
      if( ! empty( $args['background_origin'] ) ) {

        WPGP::field( array(
          'id'            => 'background-origin',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Origin', 'wpgp' ),
            'padding-box' => esc_html__( 'Padding Box', 'wpgp' ),
            'border-box'  => esc_html__( 'Border Box', 'wpgp' ),
            'content-box' => esc_html__( 'Content Box', 'wpgp' ),
          ),
        ), $this->value['background-origin'], $this->field_name(), 'field/background' );

      }

      //
      // Background Clip
      if( ! empty( $args['background_clip'] ) ) {

        WPGP::field( array(
          'id'            => 'background-clip',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Clip', 'wpgp' ),
            'border-box'  => esc_html__( 'Border Box', 'wpgp' ),
            'padding-box' => esc_html__( 'Padding Box', 'wpgp' ),
            'content-box' => esc_html__( 'Content Box', 'wpgp' ),
          ),
        ), $this->value['background-clip'], $this->field_name(), 'field/background' );

      }

      //
      // Background Blend Mode
      if( ! empty( $args['background_blend_mode'] ) ) {

        WPGP::field( array(
          'id'            => 'background-blend-mode',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Blend Mode', 'wpgp' ),
            'normal'      => esc_html__( 'Normal', 'wpgp' ),
            'multiply'    => esc_html__( 'Multiply', 'wpgp' ),
            'screen'      => esc_html__( 'Screen', 'wpgp' ),
            'overlay'     => esc_html__( 'Overlay', 'wpgp' ),
            'darken'      => esc_html__( 'Darken', 'wpgp' ),
            'lighten'     => esc_html__( 'Lighten', 'wpgp' ),
            'color-dodge' => esc_html__( 'Color Dodge', 'wpgp' ),
            'saturation'  => esc_html__( 'Saturation', 'wpgp' ),
            'color'       => esc_html__( 'Color', 'wpgp' ),
            'luminosity'  => esc_html__( 'Luminosity', 'wpgp' ),
          ),
        ), $this->value['background-blend-mode'], $this->field_name(), 'field/background' );

      }

      echo '</div>';

      echo $this->field_after();

    }

    public function output() {

      $output    = '';
      $bg_image  = array();
      $important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
      $element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];

      // Background image and gradient
      $background_color        = ( ! empty( $this->value['background-color']              ) ) ? $this->value['background-color']              : '';
      $background_gd_color     = ( ! empty( $this->value['background-gradient-color']     ) ) ? $this->value['background-gradient-color']     : '';
      $background_gd_direction = ( ! empty( $this->value['background-gradient-direction'] ) ) ? $this->value['background-gradient-direction'] : '';
      $background_image        = ( ! empty( $this->value['background-image']['url']       ) ) ? $this->value['background-image']['url']       : '';


      if( $background_color && $background_gd_color ) {
        $gd_direction   = ( $background_gd_direction ) ? $background_gd_direction .',' : '';
        $bg_image[] = 'linear-gradient('. $gd_direction . $background_color .','. $background_gd_color .')';
      }

      if( $background_image ) {
        $bg_image[] = 'url('. $background_image .')';
      }

      if( ! empty( $bg_image ) ) {
        $output .= 'background-image:'. implode( ',', $bg_image ) . $important .';';
      }

      // Common background properties
      $properties = array( 'color', 'position', 'repeat', 'attachment', 'size', 'origin', 'clip', 'blend-mode' );

      foreach( $properties as $property ) {
        $property = 'background-'. $property;
        if( ! empty( $this->value[$property] ) ) {
          $output .= $property .':'. $this->value[$property] . $important .';';
        }
      }

      if( $output ) {
        $output = $element .'{'. $output .'}';
      }

      $this->parent->output_css .= $output;

      return $output;

    }

  }
}

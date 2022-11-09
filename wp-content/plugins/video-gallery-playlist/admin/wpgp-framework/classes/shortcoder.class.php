<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Shortcoder Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WPGP_Shortcoder' ) ) {
  class WPGP_Shortcoder extends WPGP_Abstract{

    // constans
    public $unique       = '';
    public $abstract     = 'shortcoder';
    public $blocks       = array();
    public $sections     = array();
    public $pre_tabs     = array();
    public $pre_sections = array();
    public $args         = array(
      'button_title'     => 'Add Shortcode',
      'select_title'     => 'Select a shortcode',
      'insert_title'     => 'Insert Shortcode',
      'show_in_editor'   => true,
      'defaults'         => array(),
      'class'            => '',
      'gutenberg'        => array(
        'title'          => 'WPGP Shortcodes',
        'description'    => 'WPGP Shortcode Block',
        'icon'           => 'screenoptions',
        'category'       => 'widgets',
        'keywords'       => array( 'shortcode', 'wpgp', 'insert' ),
        'placeholder'    => 'Write shortcode here...',
      ),
    );

    // run shortcode construct
    public function __construct( $key, $params = array() ) {

      $this->unique       = $key;
      $this->args         = apply_filters( "wpgp_{$this->unique}_args", wp_parse_args( $params['args'], $this->args ), $this );
      $this->sections     = apply_filters( "wpgp_{$this->unique}_sections", $params['sections'], $this );
      $this->pre_tabs     = $this->pre_tabs( $this->sections );
      $this->pre_sections = $this->pre_sections( $this->sections );

      add_action( 'admin_footer', array( &$this, 'add_shortcode_modal' ) );
      add_action( 'customize_controls_print_footer_scripts', array( &$this, 'add_shortcode_modal' ) );
      add_action( 'wp_ajax_wpgp-get-shortcode-'. $this->unique, array( &$this, 'get_shortcode' ) );

      if( ! empty( $this->args['show_in_editor'] ) ) {

        WPGP::$shortcode_instances[] = wp_parse_args( array( 'hash' => md5( $key ), 'modal_id' => $this->unique ), $this->args );

        // elementor editor support
        if( WPGP::is_active_plugin( 'elementor/elementor.php' ) ) {
          add_action( 'elementor/editor/before_enqueue_scripts', array( 'WPGP', 'add_admin_enqueue_scripts' ), 20 );
          add_action( 'elementor/editor/footer', array( &$this, 'add_shortcode_modal' ) );
          add_action( 'elementor/editor/footer', 'wpgp_set_icons' );
        }

      }

    }

    // instance
    public static function instance( $key, $params = array() ) {
      return new self( $key, $params );
    }

    public function pre_tabs( $sections ) {

      $result  = array();
      $parents = array();
      $count   = 100;

      foreach( $sections as $key => $section ) {
        if( ! empty( $section['parent'] ) ) {
          $section['priority'] = ( isset( $section['priority'] ) ) ? $section['priority'] : $count;
          $parents[$section['parent']][] = $section;
          unset( $sections[$key] );
        }
        $count++;
      }

      foreach( $sections as $key => $section ) {
        $section['priority'] = ( isset( $section['priority'] ) ) ? $section['priority'] : $count;
        if( ! empty( $section['id'] ) && ! empty( $parents[$section['id']] ) ) {
          $section['subs'] = wp_list_sort( $parents[$section['id']], array( 'priority' => 'ASC' ), 'ASC', true );
        }
        $result[] = $section;
        $count++;
      }

      return wp_list_sort( $result, array( 'priority' => 'ASC' ), 'ASC', true );
    }

    public function pre_sections( $sections ) {

      $result = array();

      foreach( $this->pre_tabs as $tab ) {
        if( ! empty( $tab['subs'] ) ) {
          foreach( $tab['subs'] as $sub ) {
            $result[] = $sub;
          }
        }
        if( empty( $tab['subs'] ) ) {
          $result[] = $tab;
        }
      }

      return $result;
    }

    // get default value
    public function get_default( $field ) {

      $default = ( isset( $field['id'] ) && isset( $this->args['defaults'][$field['id']] ) ) ? $this->args['defaults'][$field['id']] : null;
      $default = ( isset( $field['default'] ) ) ? $field['default'] : $default;

      return $default;

    }

    public function add_shortcode_modal() {

      $class        = ( $this->args['class'] ) ? ' '. $this->args['class'] : '';
      $has_select   = ( count( $this->pre_tabs ) > 1 ) ? true : false;
      $single_usage = ( ! $has_select ) ? ' wpgp-shortcode-single' : '';
      $hide_header  = ( ! $has_select ) ? ' hidden' : '';

    ?>
      <div id="wpgp-modal-<?php echo $this->unique; ?>" class="wp-core-ui wpgp-modal wpgp-shortcode<?php echo $single_usage . $class; ?>" data-modal-id="<?php echo $this->unique; ?>" data-nonce="<?php echo wp_create_nonce( 'wpgp_shortcode_nonce' ); ?>">
        <div class="wpgp-modal-table">
          <div class="wpgp-modal-table-cell">
            <div class="wpgp-modal-overlay"></div>
            <div class="wpgp-modal-inner">
              <div class="wpgp-modal-title">
                <?php echo $this->args['button_title']; ?>
                <div class="wpgp-modal-close"></div>
              </div>
              <?php

                echo '<div class="wpgp-modal-header'. $hide_header .'">';
                echo '<select>';
                echo ( $has_select ) ? '<option value="">'. $this->args['select_title'] .'</option>' : '';

                $tab_key = 1;
                foreach ( $this->pre_tabs as $tab ) {

                  if( ! empty( $tab['subs'] ) ) {

                    echo '<optgroup label="'. $tab['title'] .'">';

                    foreach ( $tab['subs'] as $sub ) {

                      $view      = ( ! empty( $sub['view'] ) ) ? ' data-view="'. $sub['view'] .'"' : '';
                      $shortcode = ( ! empty( $sub['shortcode'] ) ) ? ' data-shortcode="'. $sub['shortcode'] .'"' : '';
                      $group     = ( ! empty( $sub['group_shortcode'] ) ) ? ' data-group="'. $sub['group_shortcode'] .'"' : '';

                      echo '<option value="'. $tab_key .'"'. $view . $shortcode . $group .'>'. $sub['title'] .'</option>';

                      $tab_key++;
                    }

                    echo '</optgroup>' ;

                  } else {

                      $view      = ( ! empty( $tab['view'] ) ) ? ' data-view="'. $tab['view'] .'"' : '';
                      $shortcode = ( ! empty( $tab['shortcode'] ) ) ? ' data-shortcode="'. $tab['shortcode'] .'"' : '';
                      $group     = ( ! empty( $tab['group_shortcode'] ) ) ? ' data-group="'. $tab['group_shortcode'] .'"' : '';

                      echo '<option value="'. $tab_key .'"'. $view . $shortcode . $group .'>'. $tab['title'] .'</option>';

                    $tab_key++;
                  }

                }

                echo '</select>';
                echo '</div>';

              ?>
              <div class="wpgp-modal-content">
                <div class="wpgp-modal-loading"><div class="wpgp-loading"></div></div>
                <div class="wpgp-modal-load"></div>
              </div>
              <div class="wpgp-modal-insert-wrapper hidden"><a href="#" class="button button-primary wpgp-modal-insert"><?php echo $this->args['insert_title']; ?></a></div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

    public function get_shortcode() {

      ob_start();

      $shortcode_key = wpgp_get_var( 'shortcode_key' );

      if( ! empty( $shortcode_key ) && wp_verify_nonce( wpgp_get_var( 'nonce' ), 'wpgp_shortcode_nonce' ) ) {

        $unallows  = array( 'group', 'repeater', 'sorter' );
        $section   = $this->pre_sections[$shortcode_key-1];
        $shortcode = ( ! empty( $section['shortcode'] ) ) ? $section['shortcode'] : '';
        $view      = ( ! empty( $section['view'] ) ) ? $section['view'] : 'normal';

        if( ! empty( $section ) ) {

          //
          // View: normal
          if( ! empty( $section['fields'] ) && $view !== 'repeater' ) {

            echo '<div class="wpgp-fields">';

            foreach ( $section['fields'] as $field ) {

              if( in_array( $field['type'], $unallows ) ) { $field['_notice'] = true; }

              // Extra tag improves for spesific fields (border, spacing, dimensions etc...)
              $field['tag_prefix'] = ( ! empty( $field['tag_prefix'] ) ) ? $field['tag_prefix'] .'_' : '';

              $field_default = $this->get_default( $field );

              WPGP::field( $field, $field_default, $shortcode, 'shortcode' );

            }

            echo '</div>';

          }

          //
          // View: group and repeater fields
          $repeatable_fields = ( $view === 'repeater' && ! empty( $section['fields'] ) ) ? $section['fields'] : array();
          $repeatable_fields = ( $view === 'group' && ! empty( $section['group_fields'] ) ) ? $section['group_fields'] : $repeatable_fields;

          if( ! empty( $repeatable_fields ) ) {

            $button_title    = ( ! empty( $section['button_title'] ) ) ? ' '. $section['button_title'] : esc_html__( 'Add one more', 'wpgp' );
            $inner_shortcode = ( ! empty( $section['group_shortcode'] ) ) ? $section['group_shortcode'] : $shortcode;

            echo '<div class="wpgp--repeatable">';

              echo '<div class="wpgp--repeat-shortcode">';

                echo '<div class="wpgp-repeat-remove fa fa-times"></div>';

                echo '<div class="wpgp-fields">';

                foreach ( $repeatable_fields as $field ) {

                  if( in_array( $field['type'], $unallows ) ) { $field['_notice'] = true; }

                  // Extra tag improves for spesific fields (border, spacing, dimensions etc...)
                  $field['tag_prefix'] = ( ! empty( $field['tag_prefix'] ) ) ? $field['tag_prefix'] .'_' : '';

                  $field_default = $this->get_default( $field );

                  WPGP::field( $field, $field_default, $inner_shortcode.'[0]', 'shortcode' );

                }

                echo '</div>';

              echo '</div>';

            echo '</div>';

            echo '<div class="wpgp--repeat-button-block"><a class="button wpgp--repeat-button" href="#"><i class="fa fa-plus-circle"></i> '. $button_title .'</a></div>';

          }

        }

      } else {
        echo '<div class="wpgp-field wpgp-text-error">'. esc_html__( 'Error: Nonce verification has failed. Please try again.', 'wpgp' ) .'</div>';
      }

      wp_send_json_success( array( 'content' => ob_get_clean() ) );

    }

    // Once editor setup for gutenberg and media buttons
    public static function once_editor_setup() {

      if ( function_exists( 'register_block_type' ) ) {
        add_action( 'init', array( 'WPGP_Shortcoder', 'add_guteberg_block' ) );
      }

      if ( wpgp_wp_editor_api() ) {
        add_action( 'media_buttons', array( 'WPGP_Shortcoder', 'add_media_buttons' ) );
      }

    }

    // Add gutenberg blocks.
    public static function add_guteberg_block() {

      wp_register_script( 'wpgp-gutenberg-block', WPGP::include_plugin_url( 'assets/js/wpgp-gutenberg-block.js' ), array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components' ) );

      wp_localize_script( 'wpgp-gutenberg-block', 'wpgp_gutenberg_blocks', WPGP::$shortcode_instances );

      foreach( WPGP::$shortcode_instances as $hash => $value ) {

        register_block_type( 'wpgp-gutenberg-block/block-'. $hash, array(
          'editor_script' => 'wpgp-gutenberg-block',
        ) );

      }

    }

    // Add media buttons
    public static function add_media_buttons( $editor_id ) {

      foreach( WPGP::$shortcode_instances as $hash => $value ) {
        echo '<a href="#" class="button button-primary wpgp-shortcode-button" data-editor-id="'. $editor_id .'" data-modal-id="'. $value['modal_id'] .'">'. $value['button_title'] .'</a>';
      }

    }

  }
}

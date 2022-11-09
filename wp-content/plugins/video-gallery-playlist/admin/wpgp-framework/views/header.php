<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

  $demo    = get_option( 'wpgp_demo_mode', false );
  $text    = ( ! empty( $demo ) ) ? 'Deactivate' : 'Activate';
  $status  = ( ! empty( $demo ) ) ? 'deactivate' : 'activate';
  $class   = ( ! empty( $demo ) ) ? ' wpgp-warning-primary' : '';
  $section = ( ! empty( $_GET['section'] ) ) ? $_GET['section'] : 'about';
  $links   = array(
    'about'           => 'About',
    'quickstart'      => 'Quick Start',
    'documentation'   => 'Documentation',
    'free-vs-premium' => 'Free vs Premium',
    'support'         => 'Support',
    'relnotes'        => 'Release Notes',
  );

?>
<div class="wpgp-welcome wpgp-welcome-wrap">

  <h1>Welcome to Codestar Framework v<?php echo WPGP::$version; ?></h1>

  <p class="wpgp-about-text">A Simple and Lightweight WordPress Option Framework for Themes and Plugins</p>

  <p class="wpgp-demo-button"><a href="<?php echo add_query_arg( array( 'wpgp-demo' => $status ) ); ?>" class="button button-primary<?php echo $class; ?>"><?php echo $text; ?> Demo</a></p>

  <div class="wpgp-logo">
    <div class="wpgp--effects"><i></i><i></i><i></i><i></i></div>
    <div class="wpgp--wp-logos">
      <div class="wpgp--wp-logo"></div>
      <div class="wpgp--wp-plugin-logo"></div>
    </div>
    <div class="wpgp--text">Codestar Framework</div>
    <div class="wpgp--text wpgp--version">v<?php echo WPGP::$version; ?></div>
  </div>

  <h2 class="nav-tab-wrapper wp-clearfix">
    <?php
      foreach( $links as $key => $link ) {

        if( WPGP::$premium && $key === 'free-vs-premium' ) { continue; }

        $activate = ( $section === $key ) ? ' nav-tab-active' : '';

        echo '<a href="'. add_query_arg( array( 'page' => 'wpgp-welcome', 'section' => $key ), admin_url( 'tools.php' ) ) .'" class="nav-tab'. $activate .'">'. $link .'</a>';

      }
    ?>
  </h2>

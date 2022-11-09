<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ifc23qw' );

/** Database username */
define( 'DB_USER', 'forge' );

/** Database password */
define( 'DB_PASSWORD', 'SRnJ04NcPbna2SlJsciu' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'MFa3~J R0=#~LkBjH9bJnc*6YN`Vtl+yc%DRP:KZr5/(3m-iCV3C~ Z)H2R!1Rl`' );
define( 'SECURE_AUTH_KEY',   'q|s[/i;e~j73MrFF.gN|k~iz$IDC0vaT+~jeUVJ$9mGq.<:=<xl>b?bP.U[&uGQD' );
define( 'LOGGED_IN_KEY',     'm|YQ<[ob6$u=p>N=!rTt)u.7&g+H7r*[:KwZFr.] .5kYOgmRP|dF%t SRKLJQkk' );
define( 'NONCE_KEY',         'yY9HH]QipgNaR3Gt`^_1CtVaJ9sY{jQ;x;fKyY+E4A]@].b@QxVx$,kX<{q5&_b7' );
define( 'AUTH_SALT',         '+%aR/7+2]nR {scvz% @,4&K03Q1v%}1*F|li6[v RciTJAm10Zb)wN(OY!9~3@%' );
define( 'SECURE_AUTH_SALT',  ']5d+!r_[2/= PNZ[CS9Oc`XI#.Tx)B*-Xj~%0ffwuwREzh XAdyowb.l{CxE3V)w' );
define( 'LOGGED_IN_SALT',    'iMTtCtI{~Y)?!LhzLE+*lU,u$pWa!;Fv1>Aa#$lY?od@wdnNX0b]|_1jRW>F.G*}' );
define( 'NONCE_SALT',        '`V/*:,M&aGM]:4zG_qIfrOvpELyE]kpGqa._Ky(% ~g65I{x<$ GezqA*X-l:0-H' );
define( 'WP_CACHE_KEY_SALT', '}Rp:*aUI`&+SL:%1Z M#`M/,S`H)O_~5FX3^S}@5#vf; VhSKJC29<r].P(Pa3%c' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

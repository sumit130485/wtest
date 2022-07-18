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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wtest' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '<v/ Kk<>ZLae5cp8kWhi*SfnIo.)9>?3|h%LV2OI*1LLAP~%@020:EY{L?Vz2d0p' );
define( 'SECURE_AUTH_KEY',  '8g0F/j.o5#.-usSZbUA-*CD6Fn,m[@HP uAI: ,n|(kHb({d+uqsC;zc yWjwMa+' );
define( 'LOGGED_IN_KEY',    'gwwG>EV,mBBfi7v+u&xNFY{|{UT:-Tn;wCG#DRk_;9{[KhTHz9Q?KF_+OVa/!v_W' );
define( 'NONCE_KEY',        '(VbL|De-J]op+5AxYs`#10$V@k7j).8 u{[i1=F[TZ%p+uyQtC[Hs3b_NXk^4XW ' );
define( 'AUTH_SALT',        'soC.=Y.(~{wun$B.VwFU(uz.5M=&c0S]H1D&h;3SbmOgsi{mu~C|pr^lOMa^wnZw' );
define( 'SECURE_AUTH_SALT', 'TgfL8$~>f]!^8:[?a8gv68Z>Fd{z=szdXFl3y|A/g,abBc3@ZUpyyMJxdv<%!.eu' );
define( 'LOGGED_IN_SALT',   '!8M!?N.E^0{fHw]aiBQkrdmKL9o/3L%dV{6eLO|oT2noHoxO,Tv,nBn9@brJ8WDs' );
define( 'NONCE_SALT',       'QAO-,r8xz&np{7-9>I/r3CCo}yMrsox{[M/]-&Xv|O#Vq]k$#nV:A,:>v[>ob4fZ' );

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

<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mysite' );

/** Database username */
define( 'DB_USER', 'user' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

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
define( 'AUTH_KEY',         '?PytOa|j^Pj] PZC;CmZt+#ykld!ts5uv^Z7b:)6F% 5l?w+]1-Z!pilrhW|:vbf' );
define( 'SECURE_AUTH_KEY',  'tnl6+x9ZzaZ5@lns2*kHj|*^<F@.2.!Kyv4Q[xH~W>]R]jj6]wr!=(gHh#tY.f:q' );
define( 'LOGGED_IN_KEY',    '~5,Uw7C;8E](D`amX,A?dd@P1D6hpL]KF8?2@U#(sfP0`Y Y|c^G3w;)yl1F?eum' );
define( 'NONCE_KEY',        'z2.AGrH;(:HH.<Z:G_osFoMCzQ,4arC;9#2rE.2.$X>?^KkaqXIMovmB(M,r(pci' );
define( 'AUTH_SALT',        '4!{~jW:&*td<{VcaktluL$F87(C&]Sx7nz}n~,89wX,s>E#u3*Fid}~QD=g7^/$N' );
define( 'SECURE_AUTH_SALT', '^CdqNIV<i3iwu[e,dKEY0g7Wyp.vHLZ!ff^q`k_@LY7.E7;%Q!WaH&wW*gpI]@2T' );
define( 'LOGGED_IN_SALT',   'f!#bo1NQaW)3%PKzA#qqD}Ds.xXnH:5c3>m3j68%OYjs$1+q#%uj3?L?XluBZB]r' );
define( 'NONCE_SALT',       '}GNO% 3ddS (aH~r|r1B`lP6Tit5Gv.j_,B7^2Zxc5<W_}`~LJ~H.f6SDWtsKl^$' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpgg_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
/** On error */
error_reporting(E_ALL); // включаем вывод ошибок
ini_set('display_errors', 1); // включаем вывод ошибок на экран
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);

define( 'ALLOW_UNFILTERED_UPLOADS', true );

//test sending email
define('WP_MAIL_SMTP_AUTH', false);
define('WP_MAIL_SMTP_SECURE', '');
define('WP_MAIL_SMTP_HOST', 'localhost');
define('WP_MAIL_SMTP_PORT', 25);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

//define(' WP_MEMORY_LIMIT', '100M');


/** Off error
 *
 * error_reporting(0); // выключаем вывод информации об ошибках
 * ini_set('display_errors', 0); // выключаем вывод информации об ошибках на экран
 * define('WP_DEBUG', false);
 * define('WP_DEBUG_DISPLAY', false);
 */
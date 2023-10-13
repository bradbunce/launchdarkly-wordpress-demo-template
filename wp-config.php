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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpressuser' );

/** Database password */
define( 'DB_PASSWORD', 'Q&Z#rhxXsWMyL7eC' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/** Method that WordPress should use to write to the filesystem. */
define('FS_METHOD', 'direct');

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
define('AUTH_KEY',         ']5!1|| aQSb|KC$j}3z^HBrq<}S+ZaWD!%G dh,8d^-sI{6rI@VOj;k`QE#)KM;r');
define('SECURE_AUTH_KEY',  'r/e_rK=!H%rEL&yT=2o-31-|=yh@ydSW&!co!y_bnw7A.Bi-n <rR&:]CE--{ll4');
define('LOGGED_IN_KEY',    '>ofIY4~HyfQjT,0:H&k=|]cr0RR;3zf&<R=~4X$W*jQ>O.Xdm1(A6JT.W]+~!|-&');
define('NONCE_KEY',        'IN=t)J9HK6HrHxLav$dpXS)E<@AviQzhGLj.lrWeO-+Lr@,?/p|E0x@[r*4S^ht-');
define('AUTH_SALT',        'T,b80K?6.l-rqjS`&%n+81Ciy|_d/`~JO;v9t3=%PTzuyx)xnNW&sZ1n/;&+/q!4');
define('SECURE_AUTH_SALT', '[@;Ua@rEQ-[rAGa-#(=|A6GTa0{t+TV=|<]~>Dv:tz#dZ@KujsGCx-tl`05v7gwH');
define('LOGGED_IN_SALT',   '.;8-:SrB%?Ilj!O6V?hCD>)QS+v<i+uUu>sX-V&l#c3 IA+77v ah6L!lt`[X&6t');
define('NONCE_SALT',       'STXjUMe0tpT[R&9nLRL>/UZ$e.&ZxW:mn6-~a[MV{q-G|<qB{UgP<,1T5ma1bhCC');
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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


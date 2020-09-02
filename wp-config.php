<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_inclass' );

/** MySQL database username */
define( 'DB_USER', 'wp_inclass' );

/** MySQL database password */
define( 'DB_PASSWORD', 'JFRtJBKfFm8nUdQU' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '<<A4#}-~;RwD^~ob-(Z`!YTx2/~[w+9&CGUgs7ip#|DlPl=[459`^B=lh3B]95;#');
define('SECURE_AUTH_KEY',  ';A|>Uh+c#!HSG6:>uBYc~jK6w1nXrP#;5f^]=scMdkWgp11B=|E@%`_Gv;wG2YDx');
define('LOGGED_IN_KEY',    'V;3h1T(q>q,-n$s}@ K?AMSffysh  >,TuAm4TTxYhS@RfiI>/byestlBTyjqsPp');
define('NONCE_KEY',        'n9KJ$iCJYsEw|l%}FWl*?+%8jTh3Cs}@Hy3K<]48L8pmIm0%IKawJ,>C{)%:| %m');
define('AUTH_SALT',        ']VDZ%sID3?$-}G`gT|%gKT~Zyk|1A/%)_u(w}33Vc|e$_x/Cm0%0l_[Jp#?HKiBp');
define('SECURE_AUTH_SALT', 'YB`}?CAB=omnU]t6mT~4Q 2OJF8+=0 KH6,ujPqQArx]JFh$tK1c]q:0zhI/w>|W');
define('LOGGED_IN_SALT',   '=[{!{:x-bpQ(uX,q-t_wB(nG{_-zKN3[z;`|tI1sK|qWnDI,nq41;~+#GtfybZ;1');
define('NONCE_SALT',       'Fwnn5I,rn)OQW+B{W-g|+Gh%~UzrT<v1_cm[Ev,i[<-xPP`^Mz=JdDL,uE1f|0zi');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'rdw_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wpdemo');

/** MySQL database username */
define('DB_USER', 'wpdemo');

/** MySQL database password */
define('DB_PASSWORD', 'wpdemopwd');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '#48>{Z)D*0&nfh,P9n[_%%-0o,M;j%,Z6UOXcw_v0mJw)s5bE54*2&gy&IZlQ0-J');
define('SECURE_AUTH_KEY',  '-<H5*sp-ba aXs~,N4x@EmnpCQA,dQuy~^q#uZKQ`&KID+WXWS]mNQi8VlK@G:Ju');
define('LOGGED_IN_KEY',    'gKU+I%:*&lUJ$9Gp%;d,iJ4#QHhvi!J+PA=Rq.zJ9Q+V|]yY=nEc-G$!r)SAN$-C');
define('NONCE_KEY',        'F!`s47Z0g3$t~H-q,PB-}[N_S*/i^Ro3^sd&O]uFE+wZ 7-B|}-@dt1Dkjn.|D!j');
define('AUTH_SALT',        'o]zOj0>55x 4diN4fCKGBB<fX_$(ewoo_j.#*Xa2eh>CYmVzdy;Qgv9|,y2h^mW|');
define('SECURE_AUTH_SALT', '1@YmSwe%b]C(J3stSk+d-,![{%W:<pcGxknTA=mOQ+qD]!0IS;7U2)3Jg-u*^ra3');
define('LOGGED_IN_SALT',   '#&f1)dhsK^{-/NOo)Y6Y:=z|(qqeQ#MDQ$qHW19i-Z}bVI{xpg0:PnE7:slS0K`d');
define('NONCE_SALT',       'z80c=.d[9|f0/7|5}IYdv`v*kfgQNT]%k8Bv}6GE6#/;j`:CQ+mo@/7vb_yg-!x<');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

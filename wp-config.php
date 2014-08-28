<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'C:\xampp\htdocs\4daagse\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', '4daagse');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'ymUGPk(OwDtR[up?Bi,xstL$UlCz_LU?Kuup812);W2j.M+K8G$-`@GejDQQI~=(');
define('SECURE_AUTH_KEY',  'm;afoKOmH#V}xRs{j6_WlFx+0,PlOg4Wlb9>d=[-:rdMF5rP`kZS?aBa,nQr<?@7');
define('LOGGED_IN_KEY',    '>{;0;=|c`Vr%mXtYBKGrNg1]B+fJ@fYM4.6SYe|kmzqG+{tFPX>Ciy<t[}Q7uozv');
define('NONCE_KEY',        'Q@2HemT+^%vs,v9]cu<z[G5 c-ek~9AUlnk]<T~8DY|J=Hxc$3[q>)2?CAli7=L/');
define('AUTH_SALT',        'anc`f@} l=OvM}i;3|m8)[n8?eJeFs==/A6wY3-t5J|t5Q*DGKs_z-Bjw,Kpj&]S');
define('SECURE_AUTH_SALT', 'YQV1*+FU>^ ~u@S_SsC%!31G*hOG-7><w|mLe`-F@Wh(um=&-TJhFHt+NFKOHWMt');
define('LOGGED_IN_SALT',   'Z?O:9H;g%YJ(d-N^v8-Xd;Ok-0Q+_,}a>>h>l6t!]2s?24U(rKdMnzf1JFej[4BT');
define('NONCE_SALT',       '1<-%P=+-Hk4wmce{PQx?3LVU%x=g[DW0tNrgd}vGo@yFzAC2+e*4OkroI3bnH8@X');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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

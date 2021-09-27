<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** Enable W3 Total Cache */





/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
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

define('DB_NAME', 'metallgarant');

/** MySQL database username */
define('DB_USER', 'metallgarant');

/** MySQL database password */
define('DB_PASSWORD', '7F1v3H6g');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'P$ahHSvp^X%qb$zVbu@CHFzqY)4aA5I8i18#tm9!X^V(#Uszi0de&7ENfo9)VXM2');
define('SECURE_AUTH_KEY',  'zNUjJ*h1DxGCG8s#iU*KFj^0!Ys*YYdc0GyOri!zun@(!&@a^k4jH4yqjlHArgyd');
define('LOGGED_IN_KEY',    'FE!A0nbnhgz&DCKaRZZq*w0qlYwm0neblnB%#AcQLSTXZuei(!^E2q$#kTo&HqAZ');
define('NONCE_KEY',        'b6)$^UQ)e6n1aj5ti%QQ$DhDVXfgrdKK0we(iIosC*M%GEtO)FQ(yJO507#Zy5fD');
define('AUTH_SALT',        'xHF(n!XETW^i#vygA1Y3l&6M4^uh@NucUD3%HW(OjUXRa!GDzXGQLZ^e!jyorWbL');
define('SECURE_AUTH_SALT', '!l8!s@KodkiPdWucS7#vJDqr)ou8sr4^sEo^Bq7hzE(3$#uhW%90xoCgp@UQnJ7O');
define('LOGGED_IN_SALT',   '#giiA*xzZARJWYag^IPBrHC2pubrPUJslF!keeJX!WkIbeMyMTfj#4jP8QuS1CIv');
define('NONCE_SALT',       'LxL!Yj&5vGz)K5fW7rql9f4S7LfPzC$#F^tiKP#(PPtjcv66!DXTeJfyTIrd8idm');
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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'ru_RU');

define ('FS_METHOD', 'direct');

define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

?>
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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'web_comandas');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'mysqlpass');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'Ux<`&a*hKs/(RL:kEx2SJ;w8KB?Ewvco??Y:iI)6QqkWFH/W{}ZW#U)mB Uxam0u');
define('SECURE_AUTH_KEY',  'l4iMg+~CiX?>@X>[`0(0zfJ-70HWY))c3eWOXK%DE`ljUS>7)(O_:vzY/)f;;Xv0');
define('LOGGED_IN_KEY',    'V e;V4^z:<it7rgq<n$U7sKTI(A{?HQ>(N+*cZYW?My/oP9-jI3;]8bQ$P9vY.L)');
define('NONCE_KEY',        ';#kn#kp%j{q#Q9>,kWAQY(MgzG CH.7Q[>.v!p5r8 ^X]-Uynh3}Jo&$1;#h|Sz;');
define('AUTH_SALT',        '^4qOu8h^BUJed *|) `Fq0Y>S8e*ZQK}w`JCShtVft>[S*?6vFr=YALr(i)8pi 9');
define('SECURE_AUTH_SALT', 'f`PNncz0>+KCVi-q7bnn /AA@d:r61e<U-Xjv4d`-?CmLb1W-c5|&b%b]!Q`&^Qh');
define('LOGGED_IN_SALT',   '5->y,YzaPWS{wF;$I&3.&>*3h@x3vH64.LNW:WI8~d[YdATdMLpEpD}T|&xcpFp!');
define('NONCE_SALT',       'Q}7vzHYNL.4bNtf@2h_4-Ru<J$it%s`vk:}J7O$P6-;br#X2h?36TV=4)#?W|:a,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'pros_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

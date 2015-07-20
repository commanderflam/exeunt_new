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
define('DB_NAME', 'exeuntma_exmag2013_x8291dby');

/** MySQL database username */
define('DB_USER', 'exeuntma_seanexm');

/** MySQL database password */
define('DB_PASSWORD', 'dasgestus01');

/** MySQL hostname */
define('DB_HOST', '10.168.1.58');

/** Database Charset to use in creating database tables. */
//define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'vp:1xY4~}#U.|F/e})vKYJ<=}Y?*d;d+tn)X_X4W5T3aL=kT13`+MxWQD@|6ca?S');
define('SECURE_AUTH_KEY',  'jexPORw[iU]+ogb;?PxL)w%]vt=ANH6i,:. UVCK&</1b_ M|f<p?B?Wg9o-Lq=b');
define('LOGGED_IN_KEY',    '(s?@3v%waQJ%[F>O<by)#kW*kG%(8_an;0=M!y+TJ`@}E(GeY/io+xHmFJcZMtcF');
define('NONCE_KEY',        'I/5gI|Oc~xmt)_{RKNPj{DFZ-![X@xh4^7|M<0,^6~A48`Rge2v$HLYW(zmf7<Tp');
define('AUTH_SALT',        '=bfea{6@S-vq1 cNByYN.*j=T[L]ixki*G7|(z(*xpG_GMT/(-ALgib6Zd~C-E7|');
define('SECURE_AUTH_SALT', 'QUFKgiI^e)$}C=N5BT2$M4y{|vw59_&i|{-|Sz =|/*:Ictop|{0]aB2?Y**~L&3');
define('LOGGED_IN_SALT',   'miYY@-s5%]DYiYI?rj_/g^4H#p/xk<ghQJq; cNOrsio-/[J7(&^7fr?g0iL+$A+');
define('NONCE_SALT',       '}1WvE}DYw[*aS?1whYka+C%|Ui2fTnToI8uxc|O$PkiKy/4pVXgm<f&UlHE-ZXuT');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_7qojos_';

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
	
	define('WP_HOME','http://exeuntmagazine.com/');
	define('WP_SITEURL','http://exeuntmagazine.com/');
	

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

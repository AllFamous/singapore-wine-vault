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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'swv_project');

/** MySQL database username */
define('DB_USER', 'swv_user');

/** MySQL database password */
define('DB_PASSWORD', 'KAbMobt#[5#N');

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
define('AUTH_KEY',         'c/h`#ov-`*/R^7YaA-U<a*++p][#`bft1ef#q:NIv4i>~jIZc=Uh&}2_+vv#C-Sc');
define('SECURE_AUTH_KEY',  'M|R 3d7Gn?HBSDMB3r!47]ldPV,csRmchfe.2dL-i)S4&v<&BlXZLZU2&O8&]amQ');
define('LOGGED_IN_KEY',    '|h||Z`Qc__&h<^E.IM/~|C`eA0CY]?aJh-Xx<-AEo80 `j0aBP=cm(-2PB[Dnss0');
define('NONCE_KEY',        ',?:i#CbAuiFfWffM|n?LeQ%:-CS7y.6?ld6dxXb&6(fmg6d]*d5kX|pK|M x.1=j');
define('AUTH_SALT',        '>ZY&8Q3X4]uSZm;N`@u)tB|@Df^a4oM~>NMI;i6nGX|=;oAFq+rBX6_0}jj1Y$xA');
define('SECURE_AUTH_SALT', 'JM6n`c]y9r+-B4c`.hL?`pzvcB_([7jY(xF/D$;x86-s;Nd6E?!-Vt+cT$D]F;#k');
define('LOGGED_IN_SALT',   'b.tFT[N[{G<-I&ItEMdj]9#Vm)`6Z26pb){I%-|@Rr~]vE[x^3l[gaHD3e]o*d$c');
define('NONCE_SALT',       'W;-;RNFdi&<$RD*DKKMDtZF p-DJ`Tf(rY.r(6nFP=bC..0mjjoV>.Xy:i._EgCa');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'swv_';

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

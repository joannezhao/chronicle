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

/** MySQL database username */

/** MySQL database password */

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
define('FS_METHOD', 'direct');
define('AUTH_KEY',         'fM6?URU,1V_1eC-q(|0Am1y,A=VC_@k-&|JrtND7H>_Q:Jv~5VN:C+;3t1#wjQ1P');
define('SECURE_AUTH_KEY',  '_[(FE4nE=, P]i&-%lQ{HXV)&7+TGalSWOFA1C>Tf|+TOm+!O$^As/d?y]S_A(Xj');
define('LOGGED_IN_KEY',    'V%>M^TD--}=-N)915(ZM4NO>F.=&<l-HYk$hB@naU.2p3] iO!Yzxt~nD=lR1xw4');
define('NONCE_KEY',        '/gOyqdZ4C&#^?|pjnWO.f-2QH,eE2sLN|qA^+I;V-$)` l9K`6mPJzS3#)]N3U4%');
define('AUTH_SALT',        'NZR~^L4Z&X~b^^fBYo#-Mjg_)CsRv4}:08+>EJPf-M22buv3a{OF$-45V}XgmT#5');
define('SECURE_AUTH_SALT', 'J}.th#sTv[tkZv&oM-+SAw^k]8]g1oZf7rB0.Psikmojy-|P7so@hVq ck8Sr[ms');
define('LOGGED_IN_SALT',   'T-+z}!WR_JA?v(=@8bmxjny@ts:;E3`?3*qc)rk*T>Dk4}9fd|-8bIJ/(bPMH^Zs');
define('NONCE_SALT',       '4;BmG8$W3R_N![K:3g /s4v-jWY`h8]QirA-bLt=:6`ZA=0+(rS~&:A-D3.V5ojJ');
define('DB_NAME', 'wordpress');
define('DB_USER', 'wordpress');
define('DB_PASSWORD', 'QiwShFSoJE');
require_once(ABSPATH . 'wp-settings.php');

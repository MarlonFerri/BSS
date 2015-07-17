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
define('DB_NAME', 'blueskytosmile');

/** MySQL database username */
define('DB_USER', 'blueskytosmile');

/** MySQL database password */
define('DB_PASSWORD', 'bsssql');

/** MySQL hostname */
define('DB_HOST', '186.202.152.34');

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
define('AUTH_KEY',         '`CQ;rAzwDMZQ2vN1bK>o5&;&:lp0EH!Yrc>S[E`ImslBmo!*U28~2n$wqX)W`PG;');
define('SECURE_AUTH_KEY',  '@1aaU(GLK(O6yrOJ($Cf{sVSE}y#$!L5jLA$@m]7Z9XR$jqGTBFxF53QoxDsER^,');
define('LOGGED_IN_KEY',    'bn=Azq^7{5oGy<ZC>8yRLpvLUEk8*wIHujFA>HAjf$$i$y,^B@%v@W<w6b=Bs:/c');
define('NONCE_KEY',        't|[V(J>r(V]O.=,/%7/)=C {l:}@#]5yrk>8q#f@5/*Os|.<(<O#N_e^qePqh[G9');
define('AUTH_SALT',        'kW([LMz;uP}4rZH)Q!=(BX=SYk0XZU.bo0dH6-[LX8o$Co6&Wl?MV@HUAo8Z$Z_5');
define('SECURE_AUTH_SALT', 'W5u2w_37VL,j/SZsQnRVMapfRzgUbbXOU~F:Q;#J!Ivsx&KC:^L/3d~9M%K0EC!0');
define('LOGGED_IN_SALT',   'YGR_U@k>O8ytbEn=A+%,0$$;{7nq<T!{DtVsV^ )T{z)gNiy0ULF][ w2W-SNYyN');
define('NONCE_SALT',       '2J|unDii3KRlygYsP1F;Q164uEG]sieM94u8.}e6H0o~f?C,3A[d[(Ji^I2-h^><');

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

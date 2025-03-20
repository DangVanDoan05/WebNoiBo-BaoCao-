<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kamashop' );

/** Database username */
define( 'DB_USER', 'kamashop' );

/** Database password */
define( 'DB_PASSWORD', '123456' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '7bD;|qFZB^00/(jpwDm*|tA#*e$a>&B2`~qRPgCQiDNYxdjItH4Evf<Nq#ylNk)x' );
define( 'SECURE_AUTH_KEY',  '&bRsCnR]Mv&H#|X6C%Oc%USyU~yt#ib&}37X9_V;9!`Wiz6QY:jm|>.t$$wZczV%' );
define( 'LOGGED_IN_KEY',    'NpgVVN)n>H3u2:7^!nv=x2IBN=[*t/8T)gxQ[l4}+!/oFp!u y(iu]p~xWl[TkC2' );
define( 'NONCE_KEY',        'UWY81Z)tqaR_+I;T,f~qjxR<RoupT18}vpZ]>2]*QoMLxjKfp?V:W+p4_8UYk9d#' );
define( 'AUTH_SALT',        'i)Vh|Y}onBa!LB0ut3C?&2Y bxj,F7W.#A?i-Qg<4>u|<w?P[@+,-:<L>i7+clR$' );
define( 'SECURE_AUTH_SALT', ':UL>P=/|Utg C58N~MyoqWMB)UcMs,icbxd<:G-}9`k^+;;~`8q:$t(5+G~k.HTp' );
define( 'LOGGED_IN_SALT',   '^@&?A2Ef8$Gxb{y/-H8w.vuh%k4H@%_soWE8/w~mXBM%/s^X$AuO:wIC~)44>$OY' );
define( 'NONCE_SALT',       '96xrvG?]6F46Hp[/?$98w1,j*m7ozq&0eVse@tv%F@m|37os7~ovxK3Vnd3%Eh2e' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'tb_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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

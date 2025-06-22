<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '`!tMKJ!K.)a-0:Jc.%fO]_EEmjJR&8Ad<z^y?Ydb#[A%lZ,6#)>c.khT*McmnTg,' );
define( 'SECURE_AUTH_KEY',   '6{m5qrs2~mUUcFWPcEn-M%VqpA/XSf*p$@+rm`C?/-I((},#j>:S{=e+WOI <_Zw' );
define( 'LOGGED_IN_KEY',     'k@v-+ e-k=oD&LkMqf,N<]AhVN>h-0~k%={yg6!0Lbp444Mx2r_zg>X#ix81n[<e' );
define( 'NONCE_KEY',         'uK;j2d`5#j`5D#cAMcqvwnoYXb=fgc(#QXk:e,~9T@IWh@Reio&V4lYx 6!,9`ZK' );
define( 'AUTH_SALT',         'z66_ZhWIaXZ3c?&q4PA#nMJhj>/W45v$L~Bs9Z1B;/^UZbP{$h<w:cq`(wpm<qDD' );
define( 'SECURE_AUTH_SALT',  '/dA5u[ao4}y=5SB(n=-qJ_;[z*$:sT[.R~GYcD[%9TX/YQd~U!Ng[Hm}$vAq87>+' );
define( 'LOGGED_IN_SALT',    'SeWg~lOj.Jju2 Nq2zGfI+ESj1E|XT/6mG5X{k;E ph8>N=:1aV^TLPm^Rb6a69e' );
define( 'NONCE_SALT',        'uc`3f6@n==)5K+&^Q&z4:qBUaI1E.*AmPW7(IK)0A,8N_.{huy PosPXfBJN!2DY' );
define( 'WP_CACHE_KEY_SALT', 'jT}jih8)AiOVBQxJ~Iidf__~S[xn+s@VMOrPQHx!d%`Nk4D2e0`|5BCZyh*Qn0).' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );

define('WP_ALLOW_MULTISITE', true);
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
define( 'DOMAIN_CURRENT_SITE', 'dogpages-plugin-apache.local' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

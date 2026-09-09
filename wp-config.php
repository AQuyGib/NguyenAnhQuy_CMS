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
define( 'DB_NAME', 'wordpress_nguyenanhquy' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'N+(SEYjq7>-*eD+frc@Wka-S)lZ=fWJ3 c+#G&!S`n@BL}u%-lS C2Y+E38$!Azi' );
define( 'SECURE_AUTH_KEY',  'w~_,u#L=agC[I~pO4 ^t.`t95|om@~, Gy_lB-NE[=$B5[*Ftq+Ev>-pit8DVEqr' );
define( 'LOGGED_IN_KEY',    'A|Dp*U[PSao`5?7LlQ)-yF~~ivJY:@:|,u9T+y)}x]p>N<mw{3SZWb|`2lqjcIuu' );
define( 'NONCE_KEY',        'O1el7M7]#?ynVHhoVgRQ4S<:B:GR^]c&#Iz%a&]&4)kWG.JVHL/qmgiy;/P6:m!~' );
define( 'AUTH_SALT',        'ji6ab)=~F]t8?.8}fmH<~g*k2:Ti)0xBkY`^E?)xTpO,&+Yo=~o9rs;v|`uZ8<)o' );
define( 'SECURE_AUTH_SALT', ')[PK#?*+<#ruS/IOeg8Z7q_C=(t^+a_IxKO<F!u-vzI((&c0VO9B0Ye:ioQC0<21' );
define( 'LOGGED_IN_SALT',   '0tMBl@Yq_v/krve52Zx+ZGR!P2|vuPL7(BQj&c>P/fwg-mlFt@#uAR9 h?XGk<kp' );
define( 'NONCE_SALT',       ']f,Z]1{MR;8i?8[Z*ow8>*E&!yE1HzxF!g$N3id.o|7Qmd8(0V 2}*kh %)f]Y>y' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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

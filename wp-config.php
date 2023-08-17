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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'profile' );

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
define( 'AUTH_KEY',         'zHTovr?EV%xw05i:RyqIKP!DG*15_0Fgt=gnVm98(ShY0&{|T9_D}K!b*Tlv%6L5' );
define( 'SECURE_AUTH_KEY',  '8d`Gn0*D7eE .NL,%a~3Khy9>:DfJRoJ>k@rRlWL6$|M8xao?}lzXTO$:R<x{Sup' );
define( 'LOGGED_IN_KEY',    'at{u]+:R%RP5&a1lRo_zY>!|Td8lXFWJ$Zp.7YLJ0[ABJ=?g0JQ{#)^66tG[~3_k' );
define( 'NONCE_KEY',        'FVdYIeK?|:a%*|8toz{JD;~h{c+}2E{&vt]}nTb>^u8,8C^|dw`q Uihjlk!9l;P' );
define( 'AUTH_SALT',        'S_ <T$=rSlRka<_i>?Zkn)Q@B k7^>u5S9(eUt)@U(:|]rW3RF5*4o{`iuLqrrO>' );
define( 'SECURE_AUTH_SALT', '#z!wY:$Y6oywLW~OoL?Ul=wG!`qX2%ZrZv{0daF6H?{Z0*Dwg8FkrmWVR FiWXH*' );
define( 'LOGGED_IN_SALT',   'T12Y(Ma3c7.KFdHbZ|Yy`$}1(Nn)R++_y5`iX_iGW>PWk%e[,aa.D/mTV*,mnJF*' );
define( 'NONCE_SALT',       '};_xFm;fZ^+<0>z~#@5zC^@Q3fl#kuiAiD`[`9KXVb)BYpE9E41IbVAWK>u|hDq$' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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

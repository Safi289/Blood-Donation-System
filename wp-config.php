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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Z*/S }BJ4vZSHE]}B#R X0fO~vj2ocj:}!t:jx3+(AdBT-^]o!9j9XY7&A!}kT4,' );
define( 'SECURE_AUTH_KEY',  'L+%CmFEp6IEgLp>CFXesw7YrrDMgXk8/aKTZ`$[i8yc,,s{Sxy6CgYvo RM#cwY?' );
define( 'LOGGED_IN_KEY',    '&0K2]H,>h%Q%-Ths1D.aoW>*(;c! c~]0U~(H8/vDEpn88Nf]]V& LL72~lb1QUL' );
define( 'NONCE_KEY',        'IzUx0=kCq#Wp.LH_$i#FE?[c(+f9ml%<8hOb&*;kLh1^/yTJmuyEgaXpS#=7NAxd' );
define( 'AUTH_SALT',        '}hbX0{f92I/8fB,^I2C~joZ}bz]!<.$[y%s;&*y_eNvbFk$iT;C($1oH$$_ysvHE' );
define( 'SECURE_AUTH_SALT', 'a0QBp0X^{<Ei{<#}}A/@fYwJ1zOk:p?XhxZY&dHu*@>/%u>wOP$@bFCZC3EDRHr@' );
define( 'LOGGED_IN_SALT',   'O5GGHl7oiCFJx8!+;]Me:lAS;7$_#D_TUpp4(ygFKJu?2/9!Y^<>yM5/e7rD-T=9' );
define( 'NONCE_SALT',       'W` Y_Y.AoV,_H2:e>&f&pOs @s9CHYUE_)xmeF-EHW1foKw+vWb:nBKbv0Gf-zDh' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

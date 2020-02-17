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
define( 'DB_NAME', 'bike' );

/** MySQL database username */
define( 'DB_USER', 'bike_db' );

/** MySQL database password */
define( 'DB_PASSWORD', 'LDKFGA5zSZIvCf6L' );

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
define( 'AUTH_KEY',         '!GuV!E:rfwt[j?)w(/Ed0.t#^`;:F%}<I Ho0)(`%D`B?g6y<DJ>2&!FPheOc:J^' );
define( 'SECURE_AUTH_KEY',  'B>j^/md:1wKSxXe ]{l0y-8S?~`*nHC%rNsE%)vAT(jYr^2M+RUN60n,Vo[WbpeQ' );
define( 'LOGGED_IN_KEY',    '2eJ>-xY]cj$`cXAER5K6V~oLoFb~KkYaH_v{;cLTtkW&uG:65t-[!a~@yKp9gy9r' );
define( 'NONCE_KEY',        '#{J_Td9yAy<r;yf/{d!na3g#c:;d-~K6(idKhOz:[4YfI3mTqQ&{5`I|bzfq6QZ-' );
define( 'AUTH_SALT',        'F+]gA-L^k8G].5&xR%HR&N[kp^uCi]8F=``9>_Sr[]r0/YS;$iOS%@,2Ts}493/G' );
define( 'SECURE_AUTH_SALT', ']ger{r}A0VzYHb_Eb$+u($]Rg5zbFIyX>N+j!N071`aH02<Ik8D(*4GVb4+K7+Zy' );
define( 'LOGGED_IN_SALT',   'fYZC^t1eW%wy/ikGgaG9,OZ?wa47 _M5VEh[?r&1PGdqFy{1+Fl%M9xRxUljM*IK' );
define( 'NONCE_SALT',       'h-iVXLtj#_^(s8AW=m]d?oPWagcKb]OW*$2YJ:rfnz*ZM<j=V9>h_xs1-TqB(osx' );

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

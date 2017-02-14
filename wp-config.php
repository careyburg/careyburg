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
define('DB_NAME', 'careyburg');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '@?&FwD*BAOLT@>er}QnRkig^oIVE0kt25-17nb@g<G1*3mT*^6]X4lsu?5eKd)Eg');
define('SECURE_AUTH_KEY',  'rcqBgNjAd|t4DGL~/42a;H0!Vzg+l3F9BEzYtIHg%y+C7OYwNGQ~uFPcaxq*~7<[');
define('LOGGED_IN_KEY',    ')KwIC1|{W6qo}3mGADQ?MZ[1[)$GNDSdawOD8]8.SU,56|/]O6Y${_ *e6wr;?aA');
define('NONCE_KEY',        'C?,Q83:rvd@*v-?I>QwzRH@ClEMxbmn^x@CR<U^n),:bE{U %DGwEYToUa }E**c');
define('AUTH_SALT',        'O39T6i^H!sg+`cSJ_xt5N9oGLTGku)A^*&NJR22e|^[0XHdA[KW+UMx#aOH$)UX9');
define('SECURE_AUTH_SALT', 'P7^@`., 7W=lx:WrRd|qI|,j9>3r[09yM:17$2(.ZDB[?tnP6Eo2(j4WyqM$:e*H');
define('LOGGED_IN_SALT',   'Rcvm=}Oxh),kRMUkXEFRKzs#=7%eLroN@4Qjc:-QOD{3-nT[G{`>.0j,q*WZl.:a');
define('NONCE_SALT',       '(muodwUp5z4xmWy|;I<k9w^o@2krLD#3T0n 2HKc-b<wh-l8l9[|XXOZs~z]ZIFB');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

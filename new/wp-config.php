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
define('DB_NAME', 'lij1600108341923');

/** MySQL database username */
define('DB_USER', 'lij1600108341923');

/** MySQL database password */
define('DB_PASSWORD', 's9I#pygLtnl');

/** MySQL hostname */
define('DB_HOST', 'lij1600108341923.db.6193192.hostedresource.com');

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
define('AUTH_KEY',         'w4MqC7@ZOHk1dDmSGKmq');
define('SECURE_AUTH_KEY',  '_kOVLfHcjmjF4vYv_8O$');
define('LOGGED_IN_KEY',    'vSA48N(mWw-n=Hx8w#Sk');
define('NONCE_KEY',        'HPGsnU)ZR%%y(w(8_JM=');
define('AUTH_SALT',        'mjy#q)HD=P=)wvqTa7Wv');
define('SECURE_AUTH_SALT', 'Q8K#EGsILmnZhU=ngQ1r');
define('LOGGED_IN_SALT',   'cz!1&)1H5f)T_hmbPHsY');
define('NONCE_SALT',       'J=%QtbRPx2CC5xcgkI)H');

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

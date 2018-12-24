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

//mysql://:@/?reconnect=true
define('DB_NAME', 'heroku_601594a5ee8afc6');

/** MySQL database username */
define('DB_USER', 'b5f8cf07c8d1de');

/** MySQL database password */
define('DB_PASSWORD', 'd2ef4dfe');

/** MySQL hostname */
define('DB_HOST', 'us-cdbr-iron-east-01.cleardb.net');

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
define('AUTH_KEY',         '90b3ae7a1acb817fb4eabb8a41f1a3274fdbfbd5d47c5e7048ba10fab6f2ae3e');
define('SECURE_AUTH_KEY',  'e8c73fae784427d222e48eef6b30669a5dc80625076722bdb074c1ec6031773a');
define('LOGGED_IN_KEY',    'ddbe125fe73e8d5519bd1152ec05f417988edf2e5636e65c9c5d02ff9a3b7830');
define('NONCE_KEY',        '6a74f75172b2cff332d19f52ec3d317f672ec5660fb2fd578b0b4e9c9fa9f980');
define('AUTH_SALT',        '84978fc5eb79e39f59b04027fad0825e0485cd122ccc264d59b3ace54fcb076c');
define('SECURE_AUTH_SALT', 'd270bd72c1bf6fa66ecc84b81b144ce3fed5302883ab0413f3b3a4a6cf86c3ec');
define('LOGGED_IN_SALT',   '7f80a642b63b08d80b3cc510e2a0770e01c671591446dfc4b206174f67fc5b1b');
define('NONCE_SALT',       '8ceee875bceec840daa2c368a1a1c4afffe847790583b67a15cb4c24ff9c4434');

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
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
*/

if ( defined( 'WP_CLI' ) ) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_TEMP_DIR', 'E:/xampp/apps/wordpress/tmp');


//  Disable pingback.ping xmlrpc method to prevent Wordpress from participating in DDoS attacks
//  More info at: https://docs.bitnami.com/?page=apps&name=wordpress&section=how-to-re-enable-the-xml-rpc-pingback-feature

if ( !defined( 'WP_CLI' ) ) {
    // remove x-pingback HTTP header
    add_filter('wp_headers', function($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    });
    // disable pingbacks
    add_filter( 'xmlrpc_methods', function( $methods ) {
            unset( $methods['pingback.ping'] );
            return $methods;
    });
    add_filter( 'auto_update_translation', '__return_false' );
}

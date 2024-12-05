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
define( 'DB_NAME', 'wpage' );

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
define( 'AUTH_KEY',         'pNt[^.;]V~nkRV&),3/4!shmQ,bDaAN(l+;i;!XYHTl3$.30DDxQU}OED{FO$eub' );
define( 'SECURE_AUTH_KEY',  'tQkNcqj1jGpkvnODp(OyynsA(iX+AlkY<[?WC?b>4Hvk(x%D*?X#;}:Op5lDC.#y' );
define( 'LOGGED_IN_KEY',    'T+cvAk9pjBDH<|6Rb@+[h|UQ`04iU-2y%{xl>.P6gz ypLx}_|2Kdp&=HfD`Z]Fz' );
define( 'NONCE_KEY',        'e[A%Y)+TOS1e6AE] Mfv@OgmNB5L]3HjVfR`4@/w^ ;:4/uWRAXqC=2<^97[IMI(' );
define( 'AUTH_SALT',        'hladSEQ`3=J|V9d6{ICHVgM81Z<+DI(r;a5 K[fr>[}|,*X6k *@Cl0x:a^|e/6|' );
define( 'SECURE_AUTH_SALT', 'Q1gI{@z``~|0@F[KRW})g5@oCscG.Uw(sD-O98;*]&RNVKQAn.b=6FTV0j6&WUaZ' );
define( 'LOGGED_IN_SALT',   'O=kFw:g}~<=${k,QFFGn`$8NmD_s|*$v]|8+l|>CGonIvJ9;~eY{mK*qN%VhBN,|' );
define( 'NONCE_SALT',       'l[ndkJ^ w$fx!usYOJl}kh tm%/:7|Fr=IEbNAjHzk+cdrytbXd78=FNdbHcD~$l' );

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

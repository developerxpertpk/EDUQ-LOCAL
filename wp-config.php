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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'testwordpress_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'toor' );

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
define( 'AUTH_KEY',         'Zr.tu9]Bm56Y3y{?d:Q2*|0fmWOP$L[xTf[HcE8YOaZa(}.8MI#]Y2Z[%8eM_Pk$' );
define( 'SECURE_AUTH_KEY',  '3#gRZ)?){A3$ZCI.qm%mk1D_OqQg>D/6m%T@;TNX7m]n9hfXF(i|+Sp2)XmVG&hT' );
define( 'LOGGED_IN_KEY',    '4(kzl`R/V%#fDc6vvTZ^n3eq)=+z%HWG`MvA#ddv@asK7jBl__++%IeE^HCPZV].' );
define( 'NONCE_KEY',        't ,k`0txUo0}.D]9O{:9TDuwKh}L]GIWGc<_Id%,k!Q-?!=>r@bF,S7Cy)ej0-9%' );
define( 'AUTH_SALT',        '%Ul|F:YCzj :$zu^;VY_X5i![86n(?j{%^OJyW!:GyL{C>R1T35p**HPgdkx I0k' );
define( 'SECURE_AUTH_SALT', 'L5F*oO&8IwW.eDCa:f4@kSvs!fNmcPPb,YOw:~r%>q^pF2cVp=nqA,@maVIlxPo1' );
define( 'LOGGED_IN_SALT',   'lZZ88P-,T6S-CC+gCg-X&-;115myw;^b7xTr3DG0XXXp##y+KG-6A$VEN%nXF7_W' );
define( 'NONCE_SALT',       'CLZnV;#*C:X5jn9dt#!>KWQ*u~f(v}!19Jv/p%v*>tAVJD!WT#}1UWi3mzgD>z23' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

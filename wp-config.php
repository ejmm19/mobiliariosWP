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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

/** Database hostname */
define( 'DB_HOST', 'db' );

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
define( 'AUTH_KEY',         '_+2u{,Ke1<fRPi3Xe<XUt2#lv`Ax{z2W19zhfOh<JaT|JL0`]k@*`y=&Q>XNP~D(' );
define( 'SECURE_AUTH_KEY',  'Yjaeeei>#IOBglM/bd&])doaAIHJ[>Y3.kK.PYsd-,eLM/5#dD7/y$o[MD;oFDdV' );
define( 'LOGGED_IN_KEY',    'K H[$5wrG,T Bsz9soClWJjO).9X?ciQ[]*IlQo27O*0;KOtNs/zvq%5;(m>Qi*y' );
define( 'NONCE_KEY',        'p?0a(_dDSF7<i%;!6hk+/vku^=*DD=W}>Df4oG]MY%.rttCTy1Og7{Lnu^8(0Hfs' );
define( 'AUTH_SALT',        '%Q km=chkC}?p6P *%&|B^eZjG5$IeP`*Tf>*1lp[DlsxC1Ipu]8QghR8r4:Jn2>' );
define( 'SECURE_AUTH_SALT', 'lKylr=9uKktA+@99I`I3_C^ [=n=kl1t{@G4()Lnm~:GvS6sIN[%%YEx,~o&O_vC' );
define( 'LOGGED_IN_SALT',   '>}K BEJr2gL*NrlHrm$~Bbh:a*JXpI(txCzXzn|anqMGo:Fk$>jNJHMp1lrhBYxW' );
define( 'NONCE_SALT',       '0Ygt}X#{d2x%PS`7x3ss;dB+xM3Iwj,~u?mAAA%kGCW>HaKiC7ysHfq)74q?{z#,' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '0011_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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

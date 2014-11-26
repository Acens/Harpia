<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'harpia');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'UpdpoS]!4PVO)z`]VmXd,7%|-~C2pwkWeY=P;)YXE a=,mE^IT+vjHz{.FIujNA|');
define('SECURE_AUTH_KEY',  'DOvUPG[l@^S<j$]wV%;x<jt|O%epE1V5`p;;+g*c&ucG+9FH^12;X$AmVmW)7p[R');
define('LOGGED_IN_KEY',    '# 1n:KSkZtbv[ig@_bh5mcF.mAoFs~}p6[oM5kpSbK!mqy+9p;} ,[x!-zJ6J(Lb');
define('NONCE_KEY',        'nk;Ma(`TZ}QhgmJ.|AxJnlo*$|%[n]%+CD60-Z#~GXR-k]Lo+TH|GvDGqS.P7e}o');
define('AUTH_SALT',        '9}|}h_=>E;:FRe&doj*jeT@-^aT+PyV6^f^PId46%s7)j) z@VjZ2^maYl-:G&wC');
define('SECURE_AUTH_SALT', '?)XN3%9iJ <X{DSD{Mu^nN-mfitq%d[Ga~=6ot]$Lo<Di]7,|)I%)W@Uvc@3Nf6R');
define('LOGGED_IN_SALT',   '#x+nMi]lz~1$oBvmoM2S?Q*8x[|/j)CPc(+&8Uw7.qxfRx*foWBbkNjG-p3JiR?J');
define('NONCE_SALT',       'uQIh&@n,G}3$/}si&_}hCUcn*5J:-1daoOdw/t+9Yw+!7<0eC 3}c;=]S*HO:$,j');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

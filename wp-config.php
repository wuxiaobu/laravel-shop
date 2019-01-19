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
define('DB_NAME', 'wordpress_wuxiaobu');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Ftk48G0NUDrN');

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
define('AUTH_KEY',         '> |JUov:3GIeiK|^+w:lT5&PO];MS]Tje,R$]f=ajjv|gGc3{6,`No5#~sU)@d]m');
define('SECURE_AUTH_KEY',  'Cn9}.3T6U)L#]YM}R[iiFg,o[>B+!Hvd*HL4T{~yxp1F&K1.5lu*$qTsNX&x`Yje');
define('LOGGED_IN_KEY',    'DDz)ycRVEI23h*-vWHLi./(]N5D~5$dH_(ggnp*mGGzD]G .B9|Xz4h4yg}3}zW9');
define('NONCE_KEY',        '*m4YQrY1-NWJu#_C KqnkwA(#iLyf|1)]5[ktH/n3$1`!z4yew&(n/^=~G|)2=e)');
define('AUTH_SALT',        '(_/EqI,7T;C]N9@?AK6.<6k+Hl_0m ;.o`fS#d5SQD^{+-qJO6:Pns!D9wg-a}_O');
define('SECURE_AUTH_SALT', 'eQd=*TL$B>|xf,HnF]rF` ZW/:.z@ISQRSb6W7Vace|3QD_-Q!?z%H88fJz-*ETz');
define('LOGGED_IN_SALT',   '^@S%ocKhUVCFY*<P(/n5.PQ:-Jr}9cC}F=TG}E&_q. kJo}/wONd@/snfg!$:Y, ');
define('NONCE_SALT',       '91VI?t}ZPj%!(}hRc4M{9Q}13O;1w;!>Q)#ax[Nm<~8:8Cl-0Vk]vihY,wz-:0&%');
define('FS_METHOD','direct');

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

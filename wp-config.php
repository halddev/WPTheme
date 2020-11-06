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

if (strstr($_SERVER['SERVER_NAME'], 'fictional-university.local')) {
	define('DB_NAME', 'local');
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_HOST', 'localhost');
} else { //Siteground credentials
	define('DB_NAME', 'dbfdss4hm89hw9');
	define('DB_USER', 'uahunebr283j3');
	define('DB_PASSWORD', 'MartinApd37prh');
	define('DB_HOST', '127.0.0.1');
}



/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'MZItJEubfYzsYzwPOLuvKc1sGLFmuXbGHBR+i25ZLPMIGWy6ZDvL4h65kesdocB21bEYjCNMc/7kzHaAfUF+kA==');
define('SECURE_AUTH_KEY',  '4VYehE0lOU1LJFoZMvqinkhQ19OimVloxCuo2R+Av3McC6lVOUPj1/CoEnVWwNuAt+OZPFy+s/5mYXfTITPQ/w==');
define('LOGGED_IN_KEY',    'lNEAADaEMr3lUOlHjkC7x4haDmkBMNf3DgpZgjHLoCA/CaKpDKRm6hi9a7ouYxPbEO6Er5cDATm2HSukVmSecQ==');
define('NONCE_KEY',        'TQ5oLagW0JtD+DOm9tq6DLHD7RtnDxrH2hPxz+7Rgue0nIfIdfUN9D8VUKFPOA1tV7HMofmLpj/FlXJXtSE+iw==');
define('AUTH_SALT',        '1m2QflU0UpQ493SwOyObrOu8XPh+tgoUi42Xy2ElmK+ZSigRSJHr0SkWmxE9RbGaSBmlUM3WpzLgeqIfZFFpTg==');
define('SECURE_AUTH_SALT', 'Q6Xseq2tSkm11ivdtsDfQb8A4OiDPRgHFj7y5ROVfqar4DL794snTh4h5YLCOMGNLEGWtZHyQvR9+XJauybbCA==');
define('LOGGED_IN_SALT',   'noFtkQrOCUYPzbFIg1y9Yn9YE7woxhJhpzeChaeXAxCgqmdXv/QnpdUnStHM/DGWH2ApNaxzeNVEUPZxOsHuXQ==');
define('NONCE_SALT',       'jCgJjDskWfZ7qm1RT8xfmL63KG77Gqj3PRWnYNnfNPqp9Daq+FXudv7vnd6gAeg06hFtUlaEQI+GrxGw3oh+6w==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

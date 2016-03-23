<?php		
/*
 * Redsand Wordpress Library
 * Version: 2.1.5
 * Modify: 12/29/2014
 * Author: RedSand Team
 *
 */
if(!isset($_SESSION)) { 
	session_start(); 
}

/// CONST //
define('RS_LIB_PATH', get_template_directory().'/rslib' );
define('RS_LIB_URL', strpos(RS_LIB_PATH, 'wp-content/plugins') > 0 ? plugins_url('rslib', RS_LIB_PATH) : get_stylesheet_directory_uri() . '/rslib');

define('RS_META_KEY_PREFIX', 'rs-');

define('RS_NOT_SET', '__RS_NOT_SET__');

define('LANGUAGES_PATH',  get_template_directory() . '/languages');

define('RS_VERSION', '2.1.4');

/// RS CLASS ///

if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
    include_once(RS_LIB_PATH . '/classes/class.rslib.php');
	global $RS;
	$RS = new RS(); $RS->init();
}
else{
	wp_die('Sorry, Your site only run with PHP 5.3.0 or higher but current PHP version is '. PHP_VERSION . '.<br/>Please contact system administrator to upgrade it.');
}

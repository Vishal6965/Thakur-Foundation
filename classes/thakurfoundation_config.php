<?php
ini_set('display_errors', 1);
//error_reporting(0);
ini_set('max_execution_time', '100000');
session_start();
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');

/*define('DB_USERNAME', '*********');
define('DB_PASSWORD', '********');
define('DB_NAME', '********');*/

define('DB_USERNAME', '*********');
define('DB_PASSWORD', '*********');
define('DB_NAME', '*********');

define('SITE_PATH', substr(dirname(__FILE__),0,-8));
define('SITE_CLASS_PATH', SITE_PATH.'/classes');
define('ADMIN_PATH', SITE_PATH . '/admin');

define('SITE_URL', 'https://www.thakur-foundation.org/');
define('TEST_SITE_URL', SITE_URL);

date_default_timezone_set('Asia/Calcutta');
require_once (SITE_CLASS_PATH . '/dbconnect.php');
require_once (SITE_CLASS_PATH . '/thakurfoundation_class.php');

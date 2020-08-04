<?php
ini_set('display_errors', 1);
//error_reporting(0);
ini_set('max_execution_time', '100000');
session_start();
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');

//define('DB_USERNAME', 'aiofusion');
//define('DB_PASSWORD', '$wD.@dej%N){');
//define('DB_NAME', 'aiofusion');

/*define('DB_USERNAME', 'mockupor_thakur');
define('DB_PASSWORD', 'Thakur123');
define('DB_NAME', 'mockupor_thakur');*/

define('DB_USERNAME', 'thakurfo_main');
define('DB_PASSWORD', 'Thakur123');
define('DB_NAME', 'thakurfo_main');

define('SITE_PATH', substr(dirname(__FILE__),0,-8));
define('SITE_CLASS_PATH', SITE_PATH.'/classes');
define('ADMIN_PATH', SITE_PATH . '/admin');

define('SITE_URL', 'https://www.thakur-foundation.org/');
define('TEST_SITE_URL', SITE_URL);

date_default_timezone_set('Asia/Calcutta');
require_once (SITE_CLASS_PATH . '/dbconnect.php');
require_once (SITE_CLASS_PATH . '/thakurfoundation_class.php');

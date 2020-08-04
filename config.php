<?php
$base_url="https://www.thakur-foundation.org/";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$mysql_hostname = "localhost";
$mysql_user = "********";
$mysql_password = "**********";
$mysql_database = "**********";
$con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysqli_select_db($con,$mysql_database) or die("Opps some thing went wrong in db connect");
?>

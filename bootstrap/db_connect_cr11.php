<?php 

ob_start();
//session_start();

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'cr11_ivan_zykov_php_car_rental');

$mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

//Check connection
if ($mysqli->connect_error) {
	die('Connection failed: ' . $mysqli->connect_errno . $mysqli->connect_error);
} else {
	//echo 'Connection live!';
}

?>
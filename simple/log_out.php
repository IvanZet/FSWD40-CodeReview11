<?php 

ob_start();
session_start();

//Redirect if button was no pushed
if (!isset($_SESSION['user'])) {
	header('Location: index.php');
	exit;
} else {
	header ('Location: cars_locations.php');
}

//Log out and redirect when button "Log out" was pushed
if (isset($_GET['logout'])) {
	unset($_SESSION['user'], $_SESSION['isAdmin']);
	session_unset();
	session_destroy();
	header('Location: index.php');
}
exit
?>
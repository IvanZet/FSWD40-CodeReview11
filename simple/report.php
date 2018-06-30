<?php 
ob_start();
session_start();

if (!isset($_SESSION['user'])) {
	header('Location: index.php');
	exit;
} else if (!$_SESSION['isAdmin']) {//If user not admin?
	header('Location: cars_locations.php');
	exit;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
</head>
<body>
	<section>
		<p>Logged in as: <?php echo $_SESSION['email']; ?></p>
	</section>
	<main>
		
	</main>
</body>
</html>
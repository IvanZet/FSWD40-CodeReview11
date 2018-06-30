<?php 
ob_start();
session_start();

//Redirect a logged in
if (isset($_SESSION['user'])) {
	header('Location: cars_locations.php');
	exit;
}

require_once('db_connect_cr11.php');

//Try to login a user
$error = false;
$errorMsg = '';

if (isset($_POST['btn_login'])) {
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$pass = mysqli_real_escape_string($mysqli, $_POST['pass']);

	//Chek email input
	if (empty($email)) {
		$error = true;
		$errorMsg .= 'Please enter email! ';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$errorMsg .= 'Please enter a valid email! ';
	}

	//Check password input
	if (empty($pass)) {
		$error = true;
		$errorMsg .= 'Please enter password! ';
	}

	//If mail and pass OK, try to login a user
	if (!$error) {
		$pass = hash('sha256', $pass);

		$sql = "SELECT user_id, email, pass
						FROM users
						WHERE email = '$email';";

		$result = $mysqli->query($sql);
		//Count number of rows returned
		$cout = 0;
		if (is_object($result)) {
			$count = mysqli_num_rows($result);
			if($count != 0) {
				$user = $resul->fetcht_all(MYSQLI_ASSOC);
				if ($count == 1 && $user[0]['pass'] == $pass) {//If a single user found and password matches
					$_SESSION['user'] = $user[0]['user_id'];
					header ('Location: cars_locations.php');
				} else {
					echo 'Password wrong, try again!';
				}
			} else {//If no such email found
				echo 'No user with such email found!';
			}
		} else {
		echo 'Something went wwong, try again!';	
		}	
	} else {//If invalid email or password was input
		echo $errorMsg;
	}
}

if (isset($result)) {
	$result->free();
}
if (isset($mysqli)) {
	$mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<link rel="icon" type="image/x-icon" href="car-114-232990.png">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="sign_up.php" title="">Sign up</a></li>
			</ul>
			<ul>
				<li><a href="office_list.php" title="">Offices</a></li>
			</ul>
			<ul>
				<li><a href="cars_list.php" title="">Cars</a></li>
			</ul>
			<ul>
				<li><a href="cars_locations.php" title="">Location of cars</a></li>
			</ul>
			<ul>
				<li><a href="#" title="">Log out</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<fieldset>
			<legend>Sing In or click Sign Up above</legend>
			<form action="index.php" method="POST">
				<label for="inputEmail">Email address</label>
	      <input type="email" name="email" id="inputEmail" autocomplete="on" autofocus><br>
	      <label for="inputPassword">Password</label>
	      <input type="password" name="pass" id="inputPassword" autocomplete="on"><br>
	      <button type="submit" name="btn_login">Sign in</button>
			</form>
		</fieldset>
	</main>
</body>
</html>
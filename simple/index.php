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

		$sql = "SELECT user_id, email, pass, is_admin
						FROM users
						WHERE email = '$email';";

		$result = $mysqli->query($sql);
		//Count number of rows returned
		$cout = 0;
		if (is_object($result)) {
			$count = mysqli_num_rows($result);
			if($count != 0) {
				$user = $result->fetch_all(MYSQLI_ASSOC);
				if ($count == 1 && $user[0]['pass'] == $pass) {//If a single user found and password matches
					$_SESSION['user'] = $user[0]['user_id'];
					$_SESSION['isAdmin'] = $user[0]['is_admin'];
					$_SESSION['email'] = $user[0]['email'];
					header ('Location: cars_locations.php');
				} else {
					echo 'Password wrong, try again!';
				}
			} else {//If no such email found
				echo 'No user with such email found!';
			}
		} else {
		echo 'Something went wrong, try again!';	
		}	
	} else {//If invalid email or password was input
		echo $errorMsg;
	}
}

//var_dump($_SESSION['user']);

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
		</nav>
	</header>
	<main>
		<fieldset>
			<legend>Sing In or click Sign Up above</legend>
			<form action="index.php" method="POST">
				<label for="inputEmail">Email address</label>
	      <input type="text" name="email" id="inputEmail" autocomplete="on" autofocus><br>
	      <label for="inputPassword">Password</label>
	      <input type="text" name="pass" id="inputPassword" autocomplete="on"><br>
	      <button type="submit" name="btn_login">Sign in</button>
			</form>
		</fieldset>
		<p>Use email: admin@gmail.com<br>and password: 123456<br>to login as <strong>administrator</strong></p>
	</main>
</body>
</html>
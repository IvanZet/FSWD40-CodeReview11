<?php 
ob_start();
session_start();

if (isset($_SESSION['user'])) {
	header ('Location: cars_locations.php');
}

//Check if user has already sugned in
if(isset($_SESSION['user'])) {
	header('Location: big_list_boot.php');
	exit;
}

require_once('db_connect_cr11.php');

$error = false;
$errorMsg = '';
if(isset($_POST['btn-signUp'])) {
	//Read input fields
	$first_name = mysqli_real_escape_string($mysqli, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($mysqli, $_POST['last_name']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$pass = mysqli_real_escape_string($mysqli, $_POST['pass']);

	//Check first name
	if (empty($first_name)) {
		$error = true;
		$errorMsg .= 'Please enter your first name! ';
	} else if (strlen($first_name) < 3) {
		$error = true;
		$errorMsg .= 'Your name should be at lest 3 letter long! ';
	} else if (!preg_match("/^[A-Za-z ]+$/", $first_name)) {
		$error = true;
		$errorMsg .= 'First name must contain alphabets and spaces only! ';
	}

	//Check last name
	if (empty($last_name)) {
		$error = true;
		$errorMsg .= 'Please enter your last name! ';
	} else if (strlen($last_name) < 3) {
		$error = true;
		$errorMsg .= 'Your last name should be at lest 3 letter long! ';
	} else if (!preg_match("/^[A-Za-z ]+$/", $last_name)) {
		$error = true;
		$errorMsg .= 'First last name must contain alphabets and spaces only! ';
	}

	//Check email
	if(empty($email)) {
		$error = true;
		$errorMsg .= 'Please enter your email! ';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$errorMsg .= 'Please enter a valid email! ';
	} else { //Check if email aready registered

		$sql = "SELECT email
						FROM users
						WHERE email = '$email'";
		$result = $mysqli->query($sql);
		$count = 0;
		
		if (is_object($result)) {
			$count = mysqli_num_rows($result);

			if ($count == 0) {
				$row = $result->fetch_all(MYSQLI_ASSOC);
			} else {
				$error = true;
				$errorMsg .= 'Provided email was already registered. Pick another email! ';
			}
		} else {
			$error = true;
			$errorMsg .= 'Error: returned SQL statement is not an object! ';
		}
	}

	//Validate password
	if (empty($pass)) {
		$error = true;
		$errorMsg .= 'Please enter a desired password! ';
	} else if (strlen($pass) < 6) {
		$error = true;
		$errorMsg .= 'Passwordd should be at least 6 characters long! ';
	}

	//Hash pass for security
	$pass = hash('sha256', $pass);

	//Check for errors and save to DB a new user
	if(!$error) {
		echo 'No errors!';
		$sql = "INSERT INTO users (first_name, last_name, email, pass)
						VALUES 						('$first_name', '$last_name', '$email', '$pass')";
		$result = $mysqli->real_query($sql);

		if ($result) {
			echo 'Registered as a new user! You may login.';
			unset($first_name, $last_name, $email, $pass);
		} else {
			echo 'Something went wrong, try again!';
			//var_dump($result);
		}
	} else {
		echo $errorMsg;
	}
}

//Free $result, close $mysqli
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
	<title>Sign Up</title>
	<link rel="icon" type="image/x-icon" href="car-114-232990.png">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="index.php" title="">Sign in</a></li>
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
			<legend>Fill in the form to sign up</legend>
			<form action="sign_up.php" method="POST">
				<label>First name: <input type="text" name="firstName"></label><br>
				<label>Last name: <input type="text" name="lastName"></label><br>
				<label>Email: <input type="email" name="email"></label><br>
				<br>
				<label>Password: <input type="password" name="pass"></label><br>
				<input type="button" name="btn-signUp" value="Sign Up">
			</form>
		</fieldset>
		<p>Use email: admin@gmail.com<br>and password: 123456<br>to login as administrator</p>
	</main>
</body>
</html>
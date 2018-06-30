<?php

ob_start();
session_start();

//Redirect a not logged in user
if (!isset($_SESSION['user'])) {
	header('Location: index.php');
	exit;
}

//Include DB connection
require_once('db_connect_cr11.php');

//Get list of cars in offices
$sql = "SELECT brand, model, street, house
				FROM cars
				INNER JOIN offices
					ON cars.fk_office_id = offices.office_id
				ORDER BY brand;";

$result = $mysqli->query($sql);

//Include my custom functioins
require_once('ivansFunctions.php');

//Check SQL query
if (!$result) {
	ivansEchoError ($mysqli, $sql); //echo info about errors
} else {
	$carsLocations = $result->fetch_all(MYSQLI_ASSOC);
}

//Get list of offices
$sql = "SELECT office_id, street, house
				FROM offices;";

$result = $mysqli->query($sql);

//Check SQL query
if (!$result) {
	ivansEchoError ($mysqli, $sql); //echo info about errors
} else {
	$offices = $result->fetch_all(MYSQLI_ASSOC);
}

//var_dump($cars);

//Close connection, free result
$result->free();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cars in offices</title>
	<link rel="icon" type="image/x-icon" href="car-114-232990.png">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="office_list.php" title="">Offices</a></li>
			</ul>
			<ul>
				<li><a href="cars_list.php" title="">Cars</a></li>
			</ul>
			<ul>
				<li><a href="cars_locations.php" title="">Location of cars</a></li>
			</ul>
			<?php
			if ($_SESSION['isAdmin']) {//Show only for admins
				echo '<ul>
								<li><a href="report.php" title="">Report</a></li>
							</ul>';
			}
			?>
			<ul>
				<li><a href="log_out.php?logout" title="">Log out</a></li>
			</ul>
		</nav>
	</header>
	<section>
		<p>Logged in as: <?php echo $_SESSION['email']; ?></p>
	</section>
	<main>
		<h2>Cars in offices</h2>
		<select name="">
			<?php 
			foreach ($offices as $row) {?>
				<option value="<?php echo $row['office_id']; ?>"><?php echo $row['street'] . " " . $row['house'] ?></option>
			<?php
			}
			?>
		</select>
		<table>
			<thead>
				<tr>
					<th>Car</th>
					<th>Office address</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($carsLocations as $row) {
					echo "<tr>
									<td>" . $row['brand'] . " " . $row['model'] . "</td>
									<td>" . $row['street'] . " " . $row['house'] . "</td>
								</tr>";
				}
				?>
			</tbody>
		</table>
	</main>
</body>
</html>

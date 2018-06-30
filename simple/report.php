<?php 
ob_start();
session_start();

//Redirect logged no logged in users
if (!isset($_SESSION['user'])) {
	header('Location: index.php');
	exit;
} else if (!$_SESSION['isAdmin']) {//If user not admin?
	header('Location: cars_locations.php');
	exit;
}

//Start DB connection
require_once('db_connect_cr11.php');

$sql = "SELECT street, house, COUNT(cars.car_id) AS cars_num
				FROM offices
				INNER JOIN cars
					ON offices.office_id = cars.fk_office_id
				GROUP BY street
				ORDER BY street;";

$result = $mysqli->query($sql);

//Include my custom functioins
require_once('ivansFunctions.php');

//Check SQL query
if (!$result) {
	ivansEchoError ($mysqli, $sql); //echo info about errors using custom function
} else {
	$rows = $result->fetch_all(MYSQLI_ASSOC);
}

//Close connection, free result
$result->free();
$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Report</title>
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
		<table>
			<caption>Number of cars available per office</caption>
			<thead>
				<tr>
					<th>Office</th>
					<th>Number of cars</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($rows as $office) {
					echo "<tr>
									<td>" . $office['street'] . " " . $office['house'] . "</td>
									<td>" . $office['cars_num'] . "</td>
								</tr>";
				}
				?>
			</tbody>
		</table>
	</main>
</body>
</html>
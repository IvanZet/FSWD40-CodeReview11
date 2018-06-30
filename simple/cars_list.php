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

$sql = "SELECT brand, model
				FROM cars
				ORDER BY brand;";

$result = $mysqli->query($sql);

//Include my custom functioins
require_once('ivansFunctions.php');

//Check SQL query
if (!$result) {
	ivansEchoError ($mysqli, $sql); //echo info about errors
} else {
	$cars = $result->fetch_all(MYSQLI_ASSOC);
}

//var_dump($cars);

//Close connection, free result
$result->free();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cars list</title>
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
			<caption>Our fleet</caption>
			<thead>
				<tr>
					<th>Brand</th>
					<th>Model</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($cars as $aCar) {
					echo "<tr>";
					foreach ($aCar as $feature) {
						echo "<td>" . $feature . "</td>";
					}
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</main>
</body>
</html>
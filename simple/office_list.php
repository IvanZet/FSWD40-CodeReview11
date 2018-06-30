<?php 

ob_start();

//Include DB connection
require_once('db_connect_cr11.php');

$sql = "SELECT street, house, postal_code
				FROM offices;";

$result = $mysqli->query($sql);

//Include my custom functioins
require_once('ivansFunctions.php');

//Check SQL query
if (!$result) {
	ivansEchoError ($mysqli, $sql); //echo info about errors
} else {
	$offices = $result->fetch_all(MYSQLI_ASSOC);
}

//var_dump($offices);

//Close connection, free result
$result->free();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Our offices</title>
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
			<ul>
				<li><a href="#" title="">Log out</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<table>
			<caption>Our offices in Vienna</caption>
			<thead>
				<tr>
					<th>Street</th>
					<th>House</th>
					<th>Postal code</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($offices as $anOffice) {
					echo "<tr>";
					foreach ($anOffice as $feature) {
						echo "<td>". $feature . "</td>";
					}
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</main>
</body>
</html>
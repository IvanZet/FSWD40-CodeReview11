<?php 

ob_start();

//Include DB connection
require_once('db_connect_cr11.php');

$sql = "SELECT brand, model
				FROM cars";

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
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
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
</body>
</html>
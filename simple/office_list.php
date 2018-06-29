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
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
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
</body>
</html>
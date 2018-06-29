<?php 

//Include DB connection
require_once ('db_connect_cr11.php');

$sql = "SELECT street, house, postal_code
				FROM offices";

$result = $mysqli->query($sql);

//Check SQL query
if (!$result) {
	echo '<p></p>SQL Error no: ' . $mysqli->connect_errno . "</p>";
	echo '<p></p>SQL Error: ' . $mysqli->connect_error . "</p>";
	echo '<p></p>SQL statement: ' . $sql . "</p>";
	echo '<p></p>MySQL affected rows: ' . $mysqli->affected_rows . "</p>";
} else {
	$offices = $result->fetch_all(MYSQLI_ASSOC);
}

//var_dump($offices);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Our offices</title>
	<style>
		caption {
			margin-top: 20px;
		}
		table, th, td {
			border:  1px solid black;
		}
		th, td {
			padding: 5px;
		}
		table {
			border-collapse: collapse;
		}
	</style>
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
			foreach ($offices as $office) {
				echo "<tr>";
				foreach ($office as $feature) {
					echo "<td>". $feature . "</td>";
				}
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</body>
</html>

<?php
//Close connection, free result
$result->free();
$mysqli->close();
?>
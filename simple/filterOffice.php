<?php
//Read the office id from front-side
$office = '';
if (isset($_POST['office'])) {
	$office = $_POST['office'];
} else {
	$office = 'all';
}

require_once('db_connect_cr11.php');

//Where clause in case not all offices chosen
$sqlWhere = "WHERE office_id = '$office'";
if ($office == 'all') {
	$sqlWhere = "";
}

//Get info for the filtered office
$sql = "SELECT brand, model, street, house
				FROM cars
				INNER JOIN offices
					ON cars.fk_office_id = offices.office_id
				$sqlWhere
				ORDER BY brand;";

$result = $mysqli->query($sql);


//Check SQL query
$error = false;
if (!$result) {
	$error = true;
	$errorMsg = 'No SQL result!';
} else {
	$carsLocations = $result->fetch_all(MYSQLI_ASSOC);
}

//Write HTML to fill the table with filtered data
$tableContent = '';
foreach ($carsLocations as $row) {
	$tableContent .= "<tr>
											<td>" . $row['brand'] . " " . $row['model'] . "</td>
											<td>" . $row['street'] . " " . $row['house'] . "</td>
										</tr>";
}

//Return table of error message to front-end
if (!$error) {
	echo $tableContent;
} else {
	echo $errorMsg;
}
?>
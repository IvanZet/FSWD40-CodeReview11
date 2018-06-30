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
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/x-icon" href="car-114-232990.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">CAR rental</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="cars_list.php">Fleet<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="office_list.php">Offices</a>
      </li><li class="nav-item">
        <a class="nav-link" href="cars_locations.php">Cars locations</a>
      </li>
    </ul>
  </div>
</nav>
</header>
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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
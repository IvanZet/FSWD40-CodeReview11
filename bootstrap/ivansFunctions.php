<?php 

function ivansEchoError ($mysqli, $sql) {
	echo "<p>MySQL Eror no: " . $mysqli->connect_errno . "</p>";
	echo "<p>MySQL Error: " . $mysqli->connect_error . "</p>";
	echo "<p>SQL statement: " . $sql . "</p>";
	echo "<p>MySQL affected rows: " . $mysqli->affected_rows ."</p>";
}

?>
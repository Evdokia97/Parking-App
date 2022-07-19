<?php


//connect to server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web2019";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else{
	echo("Conection succes");
}

ini_set('max_execution_time', 300);

$sql="TRUNCATE TABLE popperblock";
if ($conn->query($sql) === TRUE) {
				echo "Table cleared successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

$sql="TRUNCATE TABLE sintetagmenes";
if ($conn->query($sql) === TRUE) {
				echo "Table cleared successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
$sql="TRUNCATE TABLE parking";
if ($conn->query($sql) === TRUE) {
				echo "Table cleared successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$sql="TRUNCATE TABLE kampili";
if ($conn->query($sql) === TRUE) {
				echo "Table cleared successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}





?>
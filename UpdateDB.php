<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web2019";
$conn = new mysqli($servername, $username, $password, $dbname);

$UpdateCurve = "UPDATE kampili SET kind = '$_POST[curve]' WHERE id = '$_POST[id]'";
$UpdateParking = "UPDATE parking SET thesis = '$_POST[parking]' WHERE id = '$_POST[id]'";
$K = $conn->query($UpdateCurve);
$L = $conn->query($UpdateParking);




?>
<?php
require 'polygons.php';
$uploadOk = 1;
$kmlFileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

//upload to server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web2019";

// Create connection
$conn = new mysqli($localhost,$username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else{
	echo("Conection succes<br>");
}
ini_set('max_execution_time', 300);

$hour=array();
$center=array();
$residence=array();
$stable=array();
$default=array();

$center=[0.75,0.55,0.46,0.19,0.2,0.2,0.39,0.55,0.67,0.8,0.95,0.9,0.95,0.9,0.88,0.83,0.7,0.62,0.74,0.8,0.8,0.95,0.92,0.76];
$residence=[0.69,0.71,0.73,0.68,0.69,0.7,0.67,0.55,0.49,0.43,0.34,0.45,0.48,0.53,0.5,0.56,0.73,0.41,0.42,0.48,0.54,0.6,0.72,0.66];
$stable=[0.18,0.17,0.21,0.25,0.22,0.17,0.16,0.39,0.54,0.77,0.78,0.83,0.78,0.78,0.8,0.76,0.78,0.79,0.84,0.57,0.38,0.24,0.19,0.23];

for($h=0; $h<24; $h++){
	$hour[$h]=$h;
	$sql="INSERT INTO zitisi (hour,center,residence,stable) VALUES ($hour[$h],$center[$h],$residence[$h],$stable[$h])";
	if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    

   $zitisifeature = array(   //edw kanw geoJson

			'properties' => array(
			'hour' => $hour ,
			'center' => $center ,
			'residence' => $residence ,
			'stable' => $stable ,
			'default' => $default ,
		));
				
		
}
 array_push($geojson['zitisifeature'], $zitisifeature);

?>



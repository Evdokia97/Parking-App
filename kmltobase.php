<?php
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
ini_set('max_execution_time', 900);
$kml = simplexml_load_file('C:\Users\Kiriaki\Desktop\mykml.kml');
//print_r($kml->Document);
foreach ($pluthismos=$kml->Document->Folder->Placemark as $Item) {

     foreach($Item->description as $Attribute){ //loopa etsi oste na paroume to description gia kathe block
        echo ($Attribute);
		$pieces = explode(" ", $Attribute);
		echo sizeof($pieces);
		//print_r ($pieces);
        echo 1;
    }
}

$x=0;
$kke=0.00;
foreach ($pluthismos=$kml->Document->Folder->Placemark as $Item) {
    $x=$x+1;
    $kke=$kke+1;
    $kke_ml=$kke;
    //echo "<br>";
    $coordinates = $Item->MultiGeometry->Polygon->outerBoundaryIs->LinearRing->coordinates;
    $cordsData = trim(((string) $coordinates));
    $explodedData = explode(" ", $cordsData);
    $explodedData = array_map('trim', $explodedData);
    //echo "<br># ",$x,".<br>";
    print_r($explodedData);
    ////////////////////////////////////////////////////////
    $points = "";

    foreach ($explodedData as $index => $coordinateString) {
        $coordinateSet = array_map('trim', explode(',', $coordinateString));
        //print_r($coordinateSet);


        if(count($coordinateSet) == 2){

            $points .= " new LatLng({$coordinateSet[1]}, {$coordinateSet[0]}),";
            echo "<br>@";
            print_r($coordinateSet[1]);

            echo "<br>^^";
            print_r($coordinateSet[0]);
            /////////////////////////////////////
            $kke_ml=$kke_ml+0.01;
            echo "#####", $kke_ml;
            $sql = "INSERT INTO sintetagmenes (id, x1, y1) VALUES($kke_ml, $coordinateSet[1], $coordinateSet[0] );";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
           } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            ////////////////////////////////

        } else {
            echo '<br/>Unhandled case for data set : ' . print_r($coordinateSet, true);
        }
    }
    // at the end, remove the last ','
    //$polygonDataArray[] = "new PolygonOptions().add(" . substr($points, 0, -1) . ")";
    /////////////////////////////////////////////////////////////////////////
    foreach($Item->description as $Attribute){ //loopa etsi oste na paroume to description gia kathe block
        //echo ($Attribute);

		$pieces = explode(" ", $Attribute);
		//echo sizeof($pieces);
		//print_r ($pieces);
		if (sizeof($pieces)>16){ //se polla tetragona den uparxei pluthismos edo ginete o elegxos
			$piecesB = explode(">", $pieces[18]);
			$pluthismos=intval($piecesB[1]); //gia na to eisxorisoume sti vasi prepei na to metatrepsoume se int
			//print_r($piecesB[1]);
           // echo "<br>Population= ";
            //echo $pluthismos;
           // echo "<br>";
		} else {
			$pluthismos=0;   
        }

        echo $x;
        $sql = "INSERT INTO popperblock (id, population) VALUES($x, $pluthismos );";//population
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        

        $sql = "INSERT INTO parking (id, thesis) VALUES({$x}, 40 )";//vazw stathera 40 thesis parking 
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        $sql = "INSERT INTO kampili (id, kind) VALUES({$x}, 'Center' )"; 
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }    

        
    }


}


echo "<br>-----------------------------------<br>";

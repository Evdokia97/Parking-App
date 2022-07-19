<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web2019";

$geojson = array(
   'type'      => 'FeatureCollection',
   'features'  => array()
);

$count=1.01;
ini_set('max_execution_time', '300');
 $conn = new mysqli($servername, $username, $password, $dbname);
 


$a = 0 ;
$num = 0;
$i = 0 ;

			//ΚΑΝΩ QUERY ΣΤΗ ΒΑΣΗ ΜΟΥ ΓΙΑ ΝΑ ΠΑΡΩ ΤΑ ΣΤΟΙΧΕΙΑ ΠΟΥ ΘΕΛΩ.//
 for($count = 1;$count<350;$count++){
	 $points=floor($count); //me to floor pairnei oles tis times near tou count.
	 $coordinates = array() ;   //kanw pinaka pou tha apothikeuw oles tis sintetagmenes kathe poligonou!
     $sql = "SELECT x1, y1 FROM sintetagmenes where floor(id)=$points";
	 $pop = "SELECT population FROM popperblock WHERE (id)=$count" ;
	 $thesis = "SELECT thesis FROM parking WHERE (id)=$count" ;
	 $curve = "SELECT kind FROM kampili WHERE (id)=$count" ;
     $result = $conn->query($sql);
	 $resultpop = $conn->query($pop);
	 $resultthe = $conn ->query($thesis);
	 $resultcur = $conn ->query($curve);
	 			//ΠΑΙΡΝΩ ΤΙΣ ΘΕΣΕΙΣ PARKING ΚΑΘΕ ΠΟΛΥΓΩΝΟΥ//
	 $rowthesis = mysqli_fetch_row($resultthe);
	 $base_thesis = $rowthesis[0];
	 			//ΠΑΙΡΝΩ ΤΟΝ ΠΛΗΘΥΣΜΟ ΚΑΘΕ ΠΟΛΥΓΩΝΟΥ
	  $row = mysqli_fetch_row($resultpop);
     $base_pl = $row[0];
	 			//ΠΑΙΡΝΩ ΤΟ ΕΙΔΟΣ ΚΑΜΠΥΛΗΣ ΤΟΥ ΠΟΛΥΓΩΝΟΥ
	 $rowCurve = mysqli_fetch_row($resultcur);
	 $base_cur = $rowCurve[0];
	 $temp = array();
	 if ($result->num_rows > 0) {  		//check an exw ftasei sto telos tou pinaka

         while($row = $result->fetch_assoc()) {  //gia na parei gia athe poligwno me to idio id tis sintetagmenes 

             $coordinates[] = [(float)$row["y1"], (float)$row["x1"]];  	//ton thelw anestrammeno


             $a++ ;
             $num++;

         }

         $end[$count-1] = $a;   //gia na ksekinisei pali apo tin arxi gia to epomeno id



     }



	 do{
		 $reversed = array_reverse($coordinates);    //to anastrefw gia na to parw ws x,y.Epeidi to pira y x prin.
		 if($reversed != Null){
		 array_push($temp,$reversed);
		 }
		 
		 $feature = array(   //edw kanw geoJson

		'type' => 'Feature',
		
        'geometry' => array(
            'type' => 'Polygon',
			 'coordinates' => $temp    //wste na parei tis coordinates
        ),
		'properties' => array(
			'id' => $count ,
			'thesis' => $base_thesis ,
			'Piasmenes' => (int)(20/100 * $base_pl),   //epeidi to 20% twn monimon katoikwn tou kathe poligwnou einai oi piasmenes
			'kampili' => $base_cur ,
			'Pososto' => 0 ,
			'Centroid' => 0,
			'Eleutheres'=>0
			 
			
		
		));

		 $i++;
	 }while($i<count($end));



     array_push($geojson['features'], $feature);

 }
 echo json_encode($geojson);






?>

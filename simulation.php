<!DOCTYPE html>

<html>

<head>
    <title></title>

    <meta charset="utf-8" />
    <meta name="viewport"  />

   <meta charset="utf-8" />
    <meta name="viewport"  />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>

  <script src="https://unpkg.com/@turf/turf@3.5.2/turf.min.js"></script>



<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

.navbar {
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.subnav {
  float: left;
  overflow: hidden;
}

.subnav .subnavbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .subnav:hover .subnavbtn {
  background-color: black;
}

.subnav-content {
  display: none;
  position: absolute;
  left: 0;
  background-color: black;
  width: 100%;
  z-index: 1;
}

.subnav-content a {
  float: left;
  color: white;
  text-decoration: none;
}

.subnav-content a:hover {
  background-color: #eee;
  color: black;
}

.subnav:hover .subnav-content {
  display: block;
}
</style>
<style>


/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>

<body>

<div class="navbar">
  <a href="../index.php">Αρχική</a>

   <a href="../edit.php">Είσοδος</a>
   <a href="../simulation.php">Βρές θέση</a>
 </div>




    <div id="map" style="width: 800px; height: 600px;  margin:auto; margin-top : 9px ; border-style: solid; border-width: 5px; border-color: grey; "></div>



    <script type="text/javascript">

     var map = L.map('map').setView([40.6430126, 22.934004], 14);
    mapLink =
        '<a href="http://openstreetmap.org">OpenStreetMap</a>';
    L.tileLayer(
        'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapLink + ' ',
            maxZoom: 18,
        }).addTo(map);
    </script>

     <button class="open-button" onclick="openForm()">Τρέξε</button>

<div class="form-popup" id="myForm">

  <form action="/action_page.php"  class="form-container" id="form">
    

     <div class="row">
        <div class="col-md-4">
            <form action="#" method="post" class="form-box" id="form">
              
                <label>Παρακαλώ επιλέξτε το πολύγωνο που επιθυμείτε.</label>
                 <div class="form-group">
                    <label>Ώρα:</label>
                    <input id = "myhour" type="number" min="0" max="23" placeholder="00">:
                    <input id = "myminutes" type="number" min="0" max="59" placeholder="00">
                                
                </div>

                <div class="form-group">
                  <span id="Required" style="color:#ff0000;"></span>
                    <button id="btemu" type="button" class="btn btn-md btn-info">Τρέξε</button>
                    
                </div>
                <span id="error" style="color:#ff0000"></span>
                <button type="button" class="btn cancel" onclick="closeForm()">Κλείσιμο</button>
                
            </form>
        </div>
    </div>
</div>
</div>


</body>
</html>


<script>

  var myStyle = {
     grey:{
   "color": "#232052",
     "weight": 1,
     "opacity": 3 ,
   "fillColor": "#808080"
   },
   red:{
   "color": "#232052",
     "weight": 1,
     "opacity": 3 ,
   "fillColor": "#ff0000"
   },
   green:{
   "color": "#232052",
     "weight": 1,
     "opacity": 3 ,
   "fillColor": "#008000"
   },
   yellow:{
   "color": "#232052",
     "weight": 1,
     "opacity": 3 ,
   "fillColor": "#ffff00"
   }

 };


function openForm() {
  document.getElementById("myForm").style.display = "block";
}
function closeForm() {
  document.getElementById("myForm").style.display = "none";
}


  var clicks=0 ;
  var InpuTime ;
  var El;
  var El2;

  var hold;
  var hoy = new Date();
  var time= hoy.getHours();

  $.ajax({
    method: "GET", url: "geoJson.php", dataType: "json" ,
    }).done(function (data) {
        hold = data ;
        El =  L.geoJson(hold, {
          style: getColor,
          onEachFeature: function (feature, layer) {
        //console.log("hi");
         }}).addTo(map);
      })

       function ColorBlockin(sum , feature){
         if(sum <= 0.59*feature.properties.thesis){
           return myStyle.red  ;
          // alert("green");
        }else if(sum> 0.59*feature.properties.thesis && sum <= 0.84*feature.properties.thesis){
           return myStyle.yellow ;
          // alert("yellow");
         }else {
           return myStyle.green ;
          // alert("red");
         }
       }

       function exportToJsonFile(jsonData) {
    let dataStr = JSON.stringify(jsonData);
    let dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);

    let exportFileDefaultName = 'data.json';

    let linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
}

 document.getElementById("btemu").addEventListener("click", function(){
   clicks++;
   InpuTime = document.getElementById("myhour").value ;
   if(clicks == 1 ) map.removeLayer(El);
   if(clicks > 1 ) map.removeLayer(El2);




   El2 = L.geoJson(hold, {
    style: getColor,
    onEachFeature: function (feature, layer) {

          }


     }).addTo(map);
   	exportToJsonFile(table1);

 });




var table1=[];
var jsonFile=[];

function getColor(feature){
    if(clicks>=1){
      time = InpuTime ;
    }
          if(feature.properties.kampili == 'Center') {
      var CenterT = [0.75,0.55,0.46,0.19,0.2,0.2,0.39,0.55,0.67,0.8,0.95,0.9,0.95,0.9,0.95,0.9,0.7,0.83,0.7,0.62,0.74,0.8,0.8,0.76];
      var check = CenterT[time] ;
      var Piasmenes = feature.properties.Piasmenes;
      var Eleutheres = (feature.properties.thesis - Piasmenes) * check ;
       var sum = (feature.properties.thesis - Eleutheres) ;
       feature.properties.Eleutheres=Eleutheres;
       feature.properties.Pososto=sum;
       var centroid=turf.centroid(feature);
       var long=centroid.geometry.coordinates[0];
       var lat=centroid.geometry.coordinates[1];


      
     

      		jsonFile={
      			"id":feature.properties.id,
      			"Pososto":feature.properties.Pososto,
      			"centroid":[long,lat]

      		}

      		table1.push(jsonFile);

      	 return ColorBlockin(sum, feature);	

      //
       }
      else if(feature.properties.kampili == 'Residence') {
      var ResT = [0.69,0.71,0.73,0.68,0.69,0.7,0.67,0.55,0.49,0.43,0.34,0.45,0.48,0.53,0.5,0.56,0.73,0.41,0.42,0.48,0.54,0.6,0.72,0.66];
      var check = ResT[time] ;
      var Piasmenes = feature.properties.Piasmenes;
      var Eleutheres = (feature.properties.thesis - Piasmenes) * check ;
      sum = (feature.properties.thesis - Eleutheres) ;
      feature.properties.Pososto=sum;
      feature.properties.Eleutheres=Eleutheres;

      var centroid=turf.centroid(feature);
       var long=centroid.geometry.coordinates[0];
       var lat=centroid.geometry.coordinates[1];


      
     

      		jsonFile={
      			"id":feature.properties.id,
      			"Pososto":feature.properties.Pososto,
      			"centroid":[long,lat]

      		}

     
     


      	table1.push(jsonFile)
      	 return ColorBlockin(sum, feature);


      }
       else{
         var StaticT = [0.18,0.17,0.21,0.25,0.22,0.17,0.16,0.39,0.54,0.77,0.78,0.83,0.78,0.83,0.78,0.78,0.8,0.76,0.78,0.79,0.84,0.57,0.38,0.24];
      var check = StaticT[time] ;
      var Piasmenes = feature.properties.Piasmenes;
      var Eleutheres = (feature.properties.thesis - Piasmenes) * check ;
      sum = (feature.properties.thesis - Eleutheres) ;
     feature.properties.Pososto=sum;
    feature.properties.Eleutheres=Eleutheres;

     var centroid=turf.centroid(feature);
       var long=centroid.geometry.coordinates[0];
       var lat=centroid.geometry.coordinates[1];


      
     

      		jsonFile={
      			"id":feature.properties.id,
      			"Pososto":feature.properties.Pososto,
      			"centroid":[long,lat]

      		}
   
      
      
		
	table1.push(jsonFile)

      return ColorBlockin(sum, feature);	

       }



     }

//EURESI PARKING//
var max  = [];
var free;
var ckicks = 0 ;
var FnlExp ;
var lat1;
var lng1;
map.on('click',function(e){
if(clicks >=1){
	map.removeLayer(clickCircle);
	map.removeLayer(m1);
	map.removeLayer(m2);
	map.removeLayer(p1);
}

L.popup()
	.setLatLng(e.latlng)
	.setContent('<h5> Εδώ θέλετε να πάτε??</h5>\
        <button id="button-YES" type="button" style = "border-radius:4px; background-color:#00FF00;width:45%;">ΝΑΙ</button>\
        <button id="button-NO" type="button" style="border-radius:4px; background-color: red; width:45%;">ΟΧΙ</button>')
        .openOn(map);
        document.getElementById("button-YES").addEventListener("click", function() {

          coord = e.latlng;
           lat1 = coord.lat;
           lng1 = coord.lng;
          
          //console.log("You clicked the map at latitude: " + lat1 + " and longitude: " + lng1);
          map.closePopup();
          L.popup()
          .setLatLng(e.latlng)
          .setContent('<label for="input-radius"> ΔΙΑΛΕΞΤΕ ΑΚΤΙΝΑ AΝΑΖΗΤΗΣΗΣ</label>\
          <br>\
          <input id="input-radius" type="number" />\
          <button id="button-R" type="button" style="border-radius:4px;">Εισαγωγή</button>')
          .openOn(map);
          document.getElementById("button-R").addEventListener("click",function(){
          	clicks++ ;
          	map.closePopup();
          	var r=document.getElementById("input-radius").value;

          	clickCircle=L.circle([lat1,lng1],r*1).addTo(map);


          	L.geoJson(hold,{
          		onEachFeature:function(feature,layer){


          		var centroid=turf.centroid(feature);
          		from=turf.point([lat1,lng1]);
          		var to= turf.point([centroid.geometry.coordinates[1],centroid.geometry.coordinates[0]]);
          		var coords = [centroid.geometry.coordinates[1],centroid.geometry.coordinates[0]];
          		units="kilometers";
          		free=feature.properties.Eleutheres;
           		var distance=turf.distance(from,to,units);

          		if(distance<=(r*1/1000)){
 
          			max.push([free,coords]);


          		}

          		}
          	})
          	var tempMax = max[0][0];
          	//console.log(max[0][1]);
          	var p ;
          	for(let i=0; i< max.length-1;i++){
          		if(max[i][0] >= tempMax){
          			p = i ;
          			tempMax = max[i][0];
          		}
          	}
          	m1 =L.marker([lat1,lng1]).addTo(map);
          	m2 = L.marker(max[p][1]).addTo(map);
          	point1 = [lat1,lng1];
          	point2 = max[p][1];
          	var latlngs = [[lat1,lng1],max[p][1]];
          	p1 = L.polyline(latlngs , {color : 'blue'}).addTo(map);
          	DDistance = turf.distance(point1,point2,"kilometers");
          	FnlExp = {
          		"Distance" : DDistance*1000 ,
          		"coordinates" : max[p][1]
          	}
          	exportToJsonFile(FnlExp);
          })
})    
document.getElementById("button-NO").addEventListener("click",function(){
	map.closePopup();
})



})





</script>

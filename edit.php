
<!DOCTYPE html>
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: admin/login.php");
    exit;
}
?>
<html>

<head>
    <title></title>

    <meta charset="utf-8" />
    <meta name="viewport"  />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>

  <script src="https://unpkg.com/@turf/turf@3.5.2/turf.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>


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
</head>
<body>

<div class="navbar">
  <a href="../index.php">Αρχική</a>
   <a href="../edit.php">Επεξεργασία</a>
 
    <div class="subnav">
    <button class="subnavbtn">Δεδομένα <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="" onclick="load()">Φόρτωση</a>
      <a href="" onclick="deleteinfo()">Διαγραφή</a>
    </div>
    </div>
       <a href="../admin/logout.php">Αποσύνδεση</a>
  </div> 
  
</div>


    <div id="map" style="width: 800px; height: 600px;  margin:auto; margin-top : 50px ; border-style: solid; border-width: 5px; border-color: grey; "></div>





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

    <div class="clickIt">
    <label for="appt" style="color:black; font-weight:bold;">ΕΞΟΜΟΙΩΣΗ</label>
    <br>

  <div id="TIME">
  <input id = "a1" type="number" min="0" max="23" placeholder="0">:
  <input id = "a2" type="number" min="0" max="59" placeholder="00">
</div>
     <br>
     <button id="btemu" type="button"> Έναρξη </button>
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



function pop(e){

  var target=e.target;
  
   
  L.popup()
         .setLatLng(e.latlng)
          .setContent('<form id="popup-form">\ <table class="popup-table">\
  <tr class="popup-table-row">\
      <th class="popup-table-header">Το id του πολυγώνου:<br></th>\
      <td id="getid" class="popup-table-data" name="did" value="getid">\
      </td>\
      <tr class="popup-table-row">\
       <th id= "thespark">Θέσεις στάθμευσης:</th>\
      <td id="getparknum" ></td>\
    </tr>\
     </select><br>\
  <th class="popup-table-header">Καμπύλη Ζήτησης:</th>\
      <td id="getcurve" class="popup-table-data"></td>\
    </tr>\
    </table>\
    <button id="submit" type="button" >Αποθήκευση αλλαγών</button>\
    <br>\
  <label for="newpark">Νέες θέσεις στάθμευσης:</label>\
   <input id="newpark" class="popup-input" type="number" />\
  <br>\
   <label for="newcurve">Νέα Καμπύλη Ζήτησης:</label>\
   <select id="curveselection">\
    <option id="C" value="Center">Center</option>\
  <option id="H" value="Home">Home</option>\
  <option id="S" value="Static">Static</option>\
   </tr>\
     </form>')
        .openOn(map);
      
  document.getElementById("getid").innerHTML = e.layer.feature.properties.id; 
  document.getElementById("getparknum").innerHTML = e.layer.feature.properties.thesis;
  document.getElementById("getcurve").innerHTML = e.layer.feature.properties.kampili;

    document.getElementById("submit").addEventListener("click", function(){
      var k = document.getElementById("curveselection");
       
      if(k.options[k.selectedIndex].value != '' || document.getElementById("newpark").value != ''){
      e.layer.feature.properties.kampili = k.options[k.selectedIndex].value;
      document.getElementById("getcurve").innerHTML = k.options[k.selectedIndex].value;
      e.layer.feature.properties.thesis = document.getElementById("newpark").value;
      document.getElementById("getparknum").innerHTML = document.getElementById("newpark").value;
      
      $.post('UpdateDB.php', {'curve': k.options[k.selectedIndex].value , 'id' : e.layer.feature.properties.id ,'parking': document.getElementById("newpark").value }, function(d)
        {
            
        });
      }
      
    });
}


     
      
 var hold;
 var El ;
$.ajax({
  method: "GET", url: "geoJson.php", dataType: "json" ,
  }).done(function (data) {
      hold = data ;
      El =  L.geoJson(hold, {
        style: myStyle.grey,
        onEachFeature: function (feature, layer) {
        //console.log("hi");
       }
         }).addTo(map).on("click",pop); 

    })

 
 
 function load(){
      alert( "Your database is almolst ready,please wait one minute" );
      window.open('http://localhost/kmltobase.php');
            
      
      
      }
      function deleteinfo(){
           alert( "Your database is empty." );
            $.ajax({
                url: 'http://localhost/delete.php'    });  
          
      }
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


var clicks=0;
document.getElementById("btemu").addEventListener("click", function(){
   clicks++;
   if(clicks == 1 ) map.removeLayer(El);
   if(clicks > 1 ) map.removeLayer(El2);




   El2 = L.geoJson(hold, {
    style: getColor,
    onEachFeature: function (feature, layer) {

          }


     }).addTo(map);

 });





function getColor(feature){
   time=document.getElementById("a1").value; 
   if(feature.properties.kampili == 'Center') {
      var CenterT = [0.75,0.55,0.46,0.19,0.2,0.2,0.39,0.55,0.67,0.8,0.95,0.9,0.95,0.9,0.95,0.9,0.7,0.83,0.7,0.62,0.74,0.8,0.8,0.76];
      var check = CenterT[time] ;
      var Piasmenes = feature.properties.Piasmenes;
      var Eleutheres = (feature.properties.thesis - Piasmenes) * check ;
          var sum = (feature.properties.thesis - Eleutheres) ;
       feature.properties.Pososto=sum;
              feature.properties.Eleutheres=Eleutheres;

       



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

    
     


      return ColorBlockin(sum, feature);  

       }



     }










</script>

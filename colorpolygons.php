
<!DOCTYPE html>

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
  <a href="../index.php">Χάρτης</a>

   <a href="../edit.php">Επεξεργασία</a>
 
    <div class="subnav">
    <button class="subnavbtn">Δεδομένα <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="" onclick="load()">Φόρτωση</a>
      <a href="" onclick="deleteinfo()">Διαγραφή</a>

    </div>
    </div>
        <a href="../admin_sim.php">Εκτέλεση εξομοίωσης</a>
       <a href="../admin/logout.php">Αποσύνδεση</a>
  </div> 
  
   <button class="open-button" onclick="openForm()">Τρέξε</button>

<div class="form-popup" id="myForm">

  <form action="/action_page.php"  class="form-container" id="form">
    

     <div class="row">
        <div class="col-md-4">
            <form action="#" method="post" class="form-box" id="form">
              
                
                 <div class="form-group">
                    <label>Ώρα:</label>
                    <input id = "myhour" type="number" min="0" max="23" placeholder="00">:
                    <input id = "myminutes" type="number" min="0" max="59" placeholder="00">
                                
                </div>

                <div class="form-group">
                  <span id="Required" style="color:#ff0000;"></span>
                    <button id="btn-emu" type="button" class="btn btn-md btn-info" onclick="Run()">Τρέξε</button>
                    
                </div>
                <span id="error" style="color:#ff0000"></span>
                <button type="button" class="btn cancel" onclick="closeForm()">Κλείσιμο</button>
                
            </form>
        </div>
    </div>
</div>
</div>


<script>

  




function openForm() {
  document.getElementById("myForm").style.display = "block";
}
function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

 function load(){

      alert( "Your database is almolst ready,please wait one minute" );
      window.open('http://localhost/kmltobase.php');
            
      
      
      }
      function deleteinfo(){
           alert( "Your database is empty." );
            $.ajax({
                url: 'http://localhost/delete.php'    });  
          
      }


</script>
 
    
  
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

     //export data to JSON file//
function exportToJsonFile(jsonData) {
    let dataStr = JSON.stringify(jsonData);
    let dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);

    let exportFileDefaultName = 'data.json';

    let linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
}



function Run(){
   
hour = document.getElementById("myhour").value;
minutes = document.getElementById("myminutes").value;


     
var hold;
 var El ;
$.ajax({
  method: "GET", url: "geoJson.php", dataType: "json" ,
  }).done(function (data) {
      hold = data ;
      El =  L.geoJson(hold, {
        style: getColor,
        onEachFeature: function (feature, layer) {
       // alert("hi");
       }
         }).addTo(map); 

    })
    
    
        
    
  function getColor(feature){
    // alert("I'm in");
     if(feature.properties.kampili == 'Center') {
      var CenterT = [0.75,0.55,0.46,0.19,0.2,0.2,0.39,0.55,0.67,0.8,0.95,0.9,0.95,0.9,0.95,0.9,0.7,0.83,0.7,0.62,0.74,0.8,0.8,0.76];
      var check = CenterT[hour] ;
      var Piasmenes = feature.properties.Piasmenes;
      var Eleutheres = (feature.properties.thesis - Piasmenes) * check ;
      sum = (feature.properties.thesis - Eleutheres) ; 
      var Pososto = feature.properties.Pososto;
      Pososto=sum;  
      //feature.properties.Pososto = sum ;
      //alert("gimme the color");

        jsonFile={
         "id":feature.properties.id,
         "Pososto":sum

      }
      ExpO.push(jsonFile);
     
     
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
   }
   }  
     

            
</script>





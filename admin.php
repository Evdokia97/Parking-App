
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
  <a href="../index.php">Χάρτης</a>

   <a href="../edit.php">Επεξεργασία</a>
 
    <div class="subnav">
    <button class="subnavbtn">Δεδομένα <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="" onclick="load()">Φόρτωση</a>
      <a href="" onclick="deleteinfo()">Διαγραφή</a>

    </div>
    </div>
      <a href="../colorpolygons.php">Εκτέλεση εξομοίωσης</a>
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
    <script>

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
                
                

</body>
</html>



 
 


</script>

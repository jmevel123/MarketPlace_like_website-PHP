<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contact us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
      #map {
        height: 400px; 
        width: 100%;  
       }
    </style>

</head>
<body>

    <?php include_once("navbar.php") ?>

<div class="container">

    <h1 class="mb-5">Contact us</h1>
    <div class="row">

        <div class="col-lg-6">
            <div id="map"></div>
        </div>

        <div class="col-lg-6">
             <h3>Adress</h3>
             <p>24-26 rue Pasteur <br> 94250 <br> Le Kremlin-Bicêtre</p>
             <h3>Telephone</h3>
             <p>08 36 65 65 65</p>
             <h3>Email</h3>
             <p>gang-bang@overflow.com</p>
        </div>
    </div>

</div>

<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>



<script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: 48.815223, lng: 2.362995};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 12, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
    </script>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM2ztAQugm4BID2w1QQf_5EvqrGaxCx8Y&callback=initMap"
  type="text/javascript"></script>

    
</body>
</html>
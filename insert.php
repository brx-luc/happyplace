<?php
require_once 'marker.class.php';
require_once 'crud/config.php';
//$con = new Database("localhost", "root", "", "happyplace");

if(isset($_REQUEST['lat'])&& isset($_REQUEST['lng'])){
  $newMarker = new Marker($_REQUEST['lat'], $_REQUEST['lng']);
  $newMarker->create($con);
}
header('Location: karte.php');
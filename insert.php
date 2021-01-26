<?php
require_once 'marker.class.php';
require_once 'database.class.php';
$con = new Database("localhost", "root", "", "happyplace");

if(isset($_REQUEST['latitude'])&& isset($_REQUEST['longitude'])){
  $newMarker = new Marker($_REQUEST['latitude'], $_REQUEST['longitude']);
  $newMarker->create($con);
}
header('Location: karte.php');
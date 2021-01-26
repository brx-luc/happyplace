<?php 
require_once 'marker.class.php';
require_once 'database.class.php';
$con = new Database("localhost", "root", "", "happyplace");

$markers = Marker::fetchAll($con);
<?php 
require_once 'marker.class.php';
require_once 'crud/config.php';
//$con = new Database("localhost", "root", "", "happyplace");

$markers = Marker::fetchAll($con);
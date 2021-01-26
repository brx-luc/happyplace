<?php

class Marker {
  public $id;
  public $lat;
  public $lng;

  public function toJSON(){
    return json_encode([
      "id" => $this->id,
      "latitude" => $this->lat,
      "longitude" => $this->lng
    ]);
  }
  public function __construct($lat, $lng, $id = null){
    $this->lat = $lat;
    $this->lng = $lng;
    $this->id = $id;
  }

  public function create($con){
    $lat = $con->escape($this->lat);
    $lng = $con->escape($this->lng);
    $sql = "INSERT into 'tbl_marker' (latitude, longitude) VALUES ('$lat', '$lng');";

    $result = $con->query($sql);
  }

  public static function fetchAll($con)
  {
    $sql = "SELECT * FROM `tbl_marker`";
    $result = $con->query($sql);

    if (!$result) {
      die($con->error);
    }
    $markersFromDatabase = $result->fetch_all(MYSQLI_ASSOC);
    $markers = [];

    foreach ($markersFromDatabase as $marker) {
      $markers[] = new Marker($marker['latitude'], $marker['longitude'], $marker['id']);
    }
    return $markers;
  }
}

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
/**
 * Strassenkoordinaten über Nominatim API abfragen.
 * Vorlage für Lernende
 */
//$db = 'happyplace';
/*$db = new mysqli('localhost', 'root', '', 'happyplace');

// CHANGES MADE BELOW THIS LINE ARE AT OWN RISK //

// Query to fetch randomly one place without coordinates
$places = "SELECT * FROM tbl_orte ".
          "WHERE ( latitude is NULL OR latitude='') " .
          "AND ( longitude is NULL OR longitude='') " .
          "ORDER BY RAND() LIMIT 1;";

if (mysqli_connect_errno())
 {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($result = $db->query($places)) {
  while($row = $result->fetch_object()) {
    $place_id = $row->name;
    $coord = nominatimCoordinates($row->name . ",Schweiz"); // Restrict to switzerland
  }
} else {
  $mysqli->close();
  die('Query Error (' . $mysqli->errno . ') ' . $mysqli->error);
}

if ($place_id > 0) {
  $update = sprintf("UPDATE places SET %s WHERE id=%d", $coord, $place_id);
  if(!$db->query($update)) {
    echo ('Query Error (' . $mysqli->errno . ') ' . $mysqli->error);
  }
}

$mysqli->close();*/


function nominatimCoordinates($search) {
  $sql = "";
  // &osm_type=way => Only fetch roads
  $base = "https://nominatim.openstreetmap.org/search?q=%s&osm_type=way&format=json";
  $useragent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)';
  $referer   = "https://www.zli.ch";

  $url = sprintf($base, $search);

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_USERAGENT, $agent);
  curl_setopt($curl, CURLOPT_REFERER, $referer);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  $response = curl_exec($curl);
  $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);

  if ($httpcode == 200) {
      $response = json_decode($response, true);
      // Build SQL UPDATE query;
      $sql = "latitude='".$response[0]['lat']."', longitude='".$response[0]['lon']."'";
  } else {
      echo 'ERROR: ' . $httpcode;
  }
  return $sql;
}
?>
<form action="" method="POST">
<input type="text" name="Name" placeholder="Vorname"><br>
<input type="text" name="Nachname" placeholder="Nachname"><br>
<input type="text" name="longitude" placeholder="Longitude"><br>
<input type="text" name="latitude" placeholder="Latitude"><br>
<input type="color" name="farbe" placeholder="Farbe"><br>
<input type="submit" name="absenden" value="Absenden"><br>
</form>
</body>
</html>
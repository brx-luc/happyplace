<?php
  require_once 'data.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css" type="text/css">
    <link href="css/style.css" rel="stylesheet">
    <style>
      .map {
        height: 1000px;
        width: 1800px;
      }
      input{
            display: block;
        }
        label{
            display: block;
            margin-top: 0.5rem;
            font-size: 1rem;
            color:  #0067ab;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
    <title>OpenLayers example</title>
  </head>
  <body>
    <form method="POST" action="insert.php">
      <div>
        <label for="lat">Latitude</label>
        <input id="lat" name="latitude" />
      </div>
      <div>
        <label for="lng">Longitude</label>
        <input id="lng" name="longitude" />
      </div>
      <button type="submit">Add Marker</button>
    </form>
      <div id="map" class="map"></div>
      
    <script type="text/javascript">
    var markerPoints = [<?php 
                      foreach ($markers as $marker){
                      print $marker->toJSON();
                      print ",\n\n";
                      }?>];
    var markers = [];
    for (let marker of markerPoints){
      markers.push(new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([marker.lng, marker.lat]))
      }));
    }
    var markers = new ol.layer.Vector({
      source: new ol.source.Vector({
        features: markers
      }),
      style: new ol.style.Style({
        image: new ol.style.Icon({
          anchor: [0.5, 46],
          anchorXUnits: 'fraction',
          anchorYUnits: 'pixels',
          src: 'home.svg'
        })
      })
    })
      var map = new ol.Map({
        target: 'map',
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          }),
          markers
        ],
        view: new ol.View({
          center: ol.proj.fromLonLat([8.5208324, 47.3601270]),
          zoom: 10
        })        
      });
      function set_center(lng, lat, zoomget=17){
        	map.setView(new ol.View({
                center: ol.proj.transform([lng, lat], 'EPSG:4326', 'EPSG:3857'),
            	zoom: zoomget
            }));
        }
        function add_map_point(lng, lat, color) {
            var vectorLayer = new ol.layer.Vector({
                source: new ol.source.Vector({
                    features: [new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lng), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
                      })]
                }),
            })
            map.addLayer(vectorLayer);
        }
    </script>
  </body>
</html>
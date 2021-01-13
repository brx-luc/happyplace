<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css" type="text/css">
    <style>
      .map {
        height: 1000px;
        width: 1800px;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
    <title>OpenLayers example</title>
  </head>
  <body>
    <h2>My Map</h2>
    <div id="map" class="map"></div>
    <script type="text/javascript">
      var myRequest = new XMLHttpRequest();
      var map = new ol.Map({
        target: 'map',
        layers: [
          /*new ol.layer.Tile({
            source: new ol.source.OSM()
          }),*/
          new ol.layer.Vector({
            source: new ol.source.Vector({
              url: './assets/data/countries.geojson', 
              format: new ol.format.GeoJSON()
                           
            })
          }),
           new ol.layer.Tile({
              source: new ol.source.XYZ({
                urls : ["http://a.tile3.opencyclemap.org/landscape/{z}/{x}/{y}.png","http://b.tile3.opencyclemap.org/landscape/{z}/{x}/{y}.png","http://c.tile3.opencyclemap.org/landscape/{z}/{x}/{y}.png"]
            })
          })
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
    <div id="list"> 
    <button style="background-color: #f1f1f1;" id="dark-light" onclick="dark_light()"><i class="fas fa-lightbulb"></i></button>
    <button style="background-color: #f1f1f1;" onclick="set_center(0, 0, 1);" id="map_reset"><i class="fas fa-redo"></i> Reset Map</button>
    <h2><i class="fas fa-users"></i> Members</h2>

        <script type='text/javascript'>
            add_map_point(9.5761204, 46.9821456, '00ff00');
        </script><a style='background-color: #f1f1f1;' class='list-content' onclick='set_center(9.5761204, 46.9821456);'>1 |  L*** B****</a><br>
        <script type='text/javascript'>
            add_map_point(8.507186, 47.4187622, '0000ff');
        </script><a style='background-color: #f1f1f1;' class='list-content' onclick='set_center(8.507186, 47.4187622);'>2 |  O***** J****</a><br>
        <script type='text/javascript'>
            add_map_point(8.72571, 47.2475, 'ff0000');
        </script><a style='background-color: #f1f1f1;' class='list-content' onclick='set_center(8.72571, 47.2475);'>3 |  R**** L******</a><br>    
        <script type='text/javascript'>
        add_map_point(8.5724143, 47.4049996, 'ff0000');
        </script><a style='background-color: #f1f1f1;' class='list-content' onclick='set_center(8.5724143, 47.4049996);'>3 |  J**** J***</a><br>    
    <?php
    require_once 'register.php';
    ?>
  </body>
</html>
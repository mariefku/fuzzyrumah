@extends('layout.app')

@section('content')


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCzX9p40w9AMetlyG_qUi_9rw0ifj9rhk&libraries=places,drawing,geometry&.js"></script>

<script type="text/javascript" src=" {{ asset('js/maps.google.polygon.containsLatLng.js') }} "></script>

<style>

h3 {
  margin: 4px 0;
  padding: 5px 0;
  font-family: arial, sans-serif;
  width: 100%;
  color: #fff;
}

a {
  font-family: arial, sans-serif;
  color: #00B2EE;
  text-decoration: none;
}
a:hover {
  color: #55d4ff;
}

#map-canvas {
  width: auto;
  height: 500px;
}

#info {
  color: #222;
}

.lngLat {
  color: #fff;
  margin-bottom: 5px;
}
.lngLat .one {
  padding-left: 250px;
}
.lngLat .two {
  padding-left: 34px;
}

#clipboard-btn {
  float: left;
  margin-right: 10px;
  padding: 6px 8px;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
}

#info {
  height: 140px;
  float: left;
  margin-bottom: 30px;
  border: solid 2px #eee;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  -moz-box-shadow: inset 0 2px 5px #444;
  -webkit-box-shadow: inset 0 2px 5px #444;
  box-shadow: inset 0 2px 5px #444;
}

#info, .lngLat {
  font-family: arial, sans-serif;
  font-size: 12px;
  padding-top: 10px;
  width: 270px;
}
</style>
<body onload="initialize()">
  <div id="map-canvas"></div>
  <div class="lngLat"><span class="one">Lat</span><span class="two">,Lng</span></div>
</body>


<script>
//var myPolygon;
function initialize() {
  // Map Center
  var myLatLng = new google.maps.LatLng(-7.05853510764094, 110.42596254370801);
  // General Options
  var mapOptions = {
    zoom: 12,
    center: myLatLng,
    mapTypeId: google.maps.MapTypeId.RoadMap
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
  @foreach ($polygons as $polygon)
    // Polygon Coordinates
    var triangleCoords = [{!! $polygon->area_lokasi !!}];
    // Styling & Controls
    myPolygon = new google.maps.Polygon({
      paths: triangleCoords,
      draggable: false, // turn off if it gets annoying
      editable: false,
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.35
    });

    myPolygon.setMap(map);
    isinthepolygon(myPolygon);

    if(isinthepolygon(myPolygon))
    {
      alert({!! $polygon->harga_area !!});
    }

  @endforeach
}

function isinthepolygon(myPolygon){

  var isWithinPolygon = myPolygon.containsLatLng(-7.062189, 110.432398);
  return isWithinPolygon;
}

</script>
@endsection
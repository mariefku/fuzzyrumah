@extends('layout.app')

@section('content')

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCzX9p40w9AMetlyG_qUi_9rw0ifj9rhk&libraries=places,drawing,geometry&.js"></script>
<script type="text/javascript" src=" {{ asset('js/maps.google.polygon.containsLatLng.js') }} "></script>
<style >

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

<form class="form-horizontal" action="add" method="post">
  {{ csrf_field() }}
    <div class="form-group">
      <label for="nama_area" class="control-label">nama_area</label>
      <div class="">
        <input type="text" class="form-control" id="nama_area" placeholder="Judul Lokasi" name="nama_area" value="{{ old('nama_lokasi') }}">
      </div>
    </div>
    <div class="form-group">
      <label for="harga_area" class="control-label">harga_area</label>
      <div class="">
        <input type="text" class="form-control" id="harga_area" placeholder="Judul Lokasi" name="harga_area" value="{{ old('nama_lokasi') }}">
      </div>
    </div>
    <div class="form-group">
      <input type="text" id="area_lokasi" name="area_lokasi">
      <input type="text" id="area_lokasi_dec" class="col-sm-12" name="area_lokasi">
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Simpan</button>
        </div>
    </div>
</form>


<body onload="initialize()">
  <div id="map-canvas"></div>
  <div class="lngLat"><span class="one">Lat</span><span class="two">,Lng</span></div>
</body>
<button id="clipboard-btn" onclick="copyToClipboard(document.getElementById('info').innerHTML)">Copy to Clipboard</button>
<textarea id="info"></textarea>

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
  // Polygon Coordinates
  var triangleCoords = [
    new google.maps.LatLng(-7.05855510764094, 110.42536254370793),
    new google.maps.LatLng(-7.05621523673188, 110.42920305960774),
    new google.maps.LatLng(-7.061580289365345, 110.43239984534375)
  ];
  // Styling & Controls
  myPolygon = new google.maps.Polygon({
    paths: triangleCoords,
    draggable: true, // turn off if it gets annoying
    editable: true,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });

  myPolygon.setMap(map);
  google.maps.event.addListener(myPolygon, "dragend", getPolygonCoords);
  google.maps.event.addListener(myPolygon.getPath(), "insert_at", getPolygonCoords);
  google.maps.event.addListener(myPolygon.getPath(), "remove_at", getPolygonCoords);
  google.maps.event.addListener(myPolygon.getPath(), "set_at", getPolygonCoords);
}



//Display Coordinates below map
function getPolygonCoords() {
  var len = myPolygon.getPath().getLength();
  var htmlStr = "";
  var area = "";
  for (var i = 0; i < len; i++) {
    htmlStr += "new google.maps.LatLng" + myPolygon.getPath().getAt(i) + ", ";
    //Use this one instead if you want to get rid of the wrap > new google.maps.LatLng(),
    area += "" + myPolygon.getPath().getAt(i);
  }
  document.getElementById('info').innerHTML = htmlStr;
  jQuery('#area_lokasi').val(encodePolygon(myPolygon));
  jQuery('#area_lokasi_dec').val(decodePolygon(encodePolygon(myPolygon)));
  console.log(myPolygon);
  isinthepolygon(myPolygon);
}

function isinthepolygon(myPolygon){

  var isWithinPolygon = myPolygon.containsLatLng(-7.061580289365345, 110.43239984534375);
}

function encodePolygon(polygon)
    {
        //This variable gets all bounds of polygon.

        var path = polygon.getPath();

        var encodeString = google.maps.geometry.encoding.encodePath(path);

        return encodeString;
        /* store encodeString in database */
    }

function decodePolygon(polygon)
    {
        //This variable gets all bounds of polygon.

        var dec = google.maps.geometry.encoding.decodePath(polygon);
        return dec;
        /* store encodeString in database */
    }

function copyToClipboard(text) {
  window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
}



</script>

@endsection
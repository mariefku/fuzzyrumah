@extends('layout.app')

@section('content')


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCzX9p40w9AMetlyG_qUi_9rw0ifj9rhk&libraries=geometry,places"></script>


<style>
.modal-dialog {
  width: 100%;
  padding: 0;
}
.modal-body{
  height: 460px;
  padding: 0px;
}
.modal-header{
  padding: 5px;
}

#map-canvas {
  width:100%;
  height:460px;
}

</style>

<div id="note" class='col-sm-6'>

  @foreach ($markers as $marker)
    <br>
    <span class="info">
      Marker <strong>{{ $marker->nama_lokasi }}</strong>: <span id="{{ $marker->id }}" class="bool"></span>
    </span>
  @endforeach
    <br>
    <span class="info">
      <strong style="font-size: 150%; color: blue;">Jumlah Lokasi: <span id="jml_lokasi"></span></strong>
    </span>
    <br>
    <span class="info">
      <strong style="font-size: 150%; color: green;">Total True: <span id="jml_true"></span></strong>
    </span>
    <br>
    <span class="info">
      <strong style="font-size: 150%; color: red;">Total False: <span id="jml_false"></span></strong>
    </span>
</div>

<div class="col-sm-6">
  <div class="form-group">
    <label for="jml_true_lokasi">Jumlah True Lokasi Berdasar Kategori</label>
    <input type="text" name="" id="jml_true_lokasi" class="form-control">
  </div>
  <div class="form-group">
    <label for="kategori_lokasi">Kategori Lokasi Dalam Radius</label>
    <input type="text" class="form-control" id="kategori_lokasi">
  </div>
</div>

<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Open Map
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <h1 style="margin:0;padding:0;">PILIH LOKASI</h1>
      </div>
      <div class="modal-body">
        <div id="map-canvas" class="col-sm-12"></div>
      </div>
      <div class="modal-footer">
        <div class="form-group col-sm-6" style="text-align: left;">
          <label for="show_all_marker">
            <input type="checkbox" name="" id="show_all_marker" onchange="onMethodTypeChange(this.checked);"> Show All Marker
          </label>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>


<script>
/** var locations =  {!! json_encode($markers) !!};
  var lat = -7.0581870994;
  var lng = 110.4266451361;

  var map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:{
      lat: lat,
      lng: lng
    },
    zoom: 15
  });

  var marker, i;

  for (i = 0; i < locations.length; i++) {
     
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
           // icon: icons[]
            map: map
           // map_icon_label: '<span class="map-icon map-icon-point-of-interest"></span>'
        })
      ;


      var infoWindow = new google.maps.InfoWindow;
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
              infoWindow.setContent(locations[i].nama_lokasi);
              infoWindow.open(map, marker);
          }
      })(marker, i));
  }*/     
var show_all_value = false;
var
    on = {
          labelOrigin: new google.maps.Point(11, 25),
          url: '{{ asset('transparent.gif') }}',
          size: new google.maps.Size(22, 40),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(11, 40),
      },
    off = {
          labelOrigin: new google.maps.Point(11, 25),
          url: '{{ asset('transparent.gif') }}',
          size: new google.maps.Size(22, 40),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(11, 40),
      };


function onMethodTypeChange(value){
  show_all_value = value;
  if (show_all_value){
    on = {
          labelOrigin: new google.maps.Point(11, 25),
          url: '{{ asset('marker_green.png') }}',
          size: new google.maps.Size(22, 40),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(11, 40),
      },
    off = {
          labelOrigin: new google.maps.Point(11, 25),
          url: '{{ asset('marker_red.png') }}',
          size: new google.maps.Size(22, 40),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(11, 40),
      };
    updateMarkersIcons();
  }else{
    on = {
          labelOrigin: new google.maps.Point(11, 25),
          url: '{{ asset('transparent.gif') }}',
          size: new google.maps.Size(22, 40),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(11, 40),
      },
    off = {
          labelOrigin: new google.maps.Point(11, 25),
          url: '{{ asset('transparent.gif') }}',
          size: new google.maps.Size(22, 40),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(11, 40),
      };
    updateMarkersIcons();
  }
};



window.onload = function init() {

    var
        contentCenter = '<span class="infowin">Center Marker (draggable)</span>',

        latLngCenter = new google.maps.LatLng(-7.05853510764094, 110.42596254370801),
        latLngCMarker = new google.maps.LatLng(-7.05853510764094, 110.42596254370801),
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 15,
            center: latLngCenter,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false
        }),
        markerCenter = new google.maps.Marker({
            position: latLngCMarker,
            title: 'Center of Circle',
            //label: 'x',
            map: map,
            draggable: true,
            icon: {
                    labelOrigin: new google.maps.Point(11, 20),
                    url: '{{ asset('marker_orange.png') }}',
                    size: new google.maps.Size(22, 40),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(11, 40),
                  },
        }),
        infoCenter = new google.maps.InfoWindow({
            content: contentCenter
        }),

        // exemplary setup: 
        // Assumes that your map is signed to the var "map"
        // Also assumes that your marker is named "marker"

        radius = 1000,
        circle = new google.maps.Circle({
            map: map,
            clickable: false,
            draggable: false,
            // metres
            radius: radius,
            fillColor: '#fff',
            fillOpacity: 0,
            strokeColor: 'red', //'#313131',
            strokeOpacity: .7,
            strokeWeight: .8
        });
    // attach circle to marker
    circle.bindTo('center', markerCenter, 'position');

    var
      // get the Bounds of the circle
      bounds = circle.getBounds(),
      // Note spans
      locations =  {!! json_encode($markers) !!},
      marker=[],
      note,
      jml_true=0,
      jml_false=0,
      i,
      flags = [], output = [];
     
      for (i = 0; i < locations.length; i++) {
        marker[i] = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
            //title: String(locations[i].nama_lokasi),
            //label: {
            //  color: 'black',
            //  fontWeight: 'regular',
            //  text: String(locations[i].nama_lokasi),
            //},
            //labelClass: "labels",
            icon: off,
            map: map
        });
        
        marker[i].setIcon( isWithinBound(marker[i].getPosition(), markerCenter.getPosition()) ? on: off);

        var infoWindow = new google.maps.InfoWindow;
        google.maps.event.addListener(marker[i], 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(locations[i].nama_lokasi);
                infoWindow.open(map, marker[i]);
            }
        })(marker, i));


      };


    // get some latLng object and Question if it's contained in the circle:
    google.maps.event.addListener(markerCenter, 'dragend', function() {
        latLngCenter = markerCenter.position;
        var flags = [], output = [];
        var jml_true=0;
        var jml_false=0;
        for (i = 0; i < locations.length; i++) {
            
            note = jQuery('.bool#'+locations[i].id);
            note.text(isWithinBound(marker[i].getPosition(), markerCenter.getPosition()));
            
            marker[i].setIcon( isWithinBound(marker[i].getPosition(), markerCenter.getPosition()) ? on: off);

            if (isWithinBound(marker[i].getPosition(), markerCenter.getPosition())){
              note.css({"color": "green", "font-size": "100%", "fontWeight" : "bold"});
              jml_true++;
              if( flags[locations[i].kategori_lokasi]) continue;
              flags[locations[i].kategori_lokasi] = true;
              output.push(locations[i].kategori_lokasi);
            }else{
              jml_false++;
              note.css({"color": "red", "font-size": "100%", "fontWeight" : "bold"});
            }

            infoWindow.close();
        };

        jQuery('#jml_lokasi').text(locations.length);
        jQuery('#jml_true').text(jml_true);
        jQuery('#jml_false').text(jml_false);
        jQuery('#jml_true_lokasi').val(output.length);
        jQuery('#kategori_lokasi').val(output);
    });

    google.maps.event.addListener(circle, 'dragend', function() {
        latLngCenter = markerCenter.position;
        var flags = [], output = [];
        var jml_true=0;
        var jml_false=0;
        for (i = 0; i < locations.length; i++) {

            note = jQuery('.bool#'+locations[i].id);
            note.text(isWithinBound(marker[i].getPosition(), markerCenter.getPosition()));

            marker[i].setIcon( isWithinBound(marker[i].getPosition(), markerCenter.getPosition()) ? on: off);

            if (isWithinBound(marker[i].getPosition(), markerCenter.getPosition())){
              note.css({"color": "green", "font-size": "100%", "fontWeight" : "bold"});
              jml_true++;
              if( flags[locations[i].kategori_lokasi]) continue;
              flags[locations[i].kategori_lokasi] = true;
              output.push(locations[i].kategori_lokasi);
            }else{
              jml_false++;
              note.css({"color": "red", "font-size": "100%", "fontWeight" : "bold"});
            }

            infoWindow.close();
        };

        jQuery('#jml_lokasi').text(locations.length);
        jQuery('#jml_true').text(jml_true);
        jQuery('#jml_false').text(jml_false);
        jQuery('#jml_true_lokasi').val(output.length);
        jQuery('#kategori_lokasi').val(output);
    });

    function isWithinBound (marker, center) {
      var location = google.maps.geometry.spherical.computeDistanceBetween(marker,center)
      return radius > location;
    }


    function updateMarkersIcons(){
      for (var i = 0; i < locations.length; i++) {
        marker[i].setIcon( isWithinBound(marker[i].getPosition(), markerCenter.getPosition()) ? on: off);
      }
    }

    window.updateMarkersIcons = updateMarkersIcons;

    google.maps.event.addListener(markerCenter, 'click', function() {
        infoCenter.open(map, markerCenter);
    });

    google.maps.event.addListener(markerCenter, 'drag', function() {
        infoCenter.close();
    });

    $('#myModal').on('shown.bs.modal', function () {
      google.maps.event.trigger(map, 'resize');
      map.setCenter(latLngCenter);
      for (i = 0; i < locations.length; i++) {
        marker[i].setIcon( isWithinBound(marker[i].getPosition(), markerCenter.getPosition()) ? on: off);
      }
    });

    $('#show_all_marker').click( function () {
      google.maps.event.trigger(map, 'resize');
      for (i = 0; i < locations.length; i++) {
        marker[i].setIcon( isWithinBound(marker[i].getPosition(), markerCenter.getPosition()) ? on: off);
      }
    });

};



</script>
  @endsection
@extends('layout.app')

@section('content')

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCzX9p40w9AMetlyG_qUi_9rw0ifj9rhk&libraries=places"></script>

<div id="map-canvas" class="col-sm-12" style="height:500px;"></div>


<script>
  var locations =  {!! json_encode($markers) !!};
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
     if (locations[i].kategori_lokasi == "Sekolah_SD" ){
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
  }}


  </script>
  @endsection
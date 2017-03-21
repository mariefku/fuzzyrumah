@extends('layout.app')

@section('content')
<style>
.modal-dialog {
  width: 100%;
  padding: 0px 5px 0 5px;
  margin: 20px 0px 10px 0px;
}
.modal-body{
  height: 460px;
  padding: 0px;
}

#map-canvas {
  width:100%;
  height:460px;
}

</style>

  <h3></a> Hitung Harga Rumah</h3>

  @if (count($errors) > 0)
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  <form class="form-horizontal" action="{{ action('GuestController@createRumah') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="itemCode" class="col-sm-2 control-label">Harga NJOP Rumah</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="rumahNjop" placeholder="Harga NJOP Rumah" name="njopRumah" value="{{ old('njopRumah') }}">
    </div>
    <label for="" class="control-label">(500.000 - 5.000.000)</label>
  </div>
  <div class="form-group">
    <label for="itemName" class="col-sm-2 control-label">Kondisi Rumah</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="rumahKondisi" placeholder="Kondisi Rumah" name="kondisiRumah" value="{{ old('kondisiRumah') }}">
    </div>
     <label for="" class="control-label">(50 - 100)</label>
  </div>
  <div class="form-group">
    <label for="rumahUsia" class="col-sm-2 control-label">Usia Rumah</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="rumahUsia" placeholder="Usia Rumah" name="usiaRumah" value="{{ old('usiaRumah') }}">
    </div>
     <label for="" class="control-label" >(0 - 30)</label>
  </div>
  <div class="form-group">
    <label for="rumahLuas" class="col-sm-2 control-label">Luas Rumah (m<sup>2</sup>)</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="rumahLuas" placeholder="Luas Rumah" name="luasRumah" value="{{ old('luasRumah') }}">
    </div>
  </div>
  <hr>
  <div class="form-group">
    <label for="tanahNjop" class="col-sm-2 control-label">Harga NJOP Tanah</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="tanahNjop" placeholder="Harga NJOP Tanah" name="njopTanah" value="{{ old('njopTanah') }}">
    </div>
     <label for="" class="control-label">(500.000 - 5.000.000)</label>
  </div>
  <div class="form-group">
    <label for="tanahLokasi" class="col-sm-2 control-label">Lokasi</label>
    <div class="col-sm-5" id="alamat_lokasi_wrapper">
      <textarea name="" id="alamat_lokasi" cols="30" rows="5" class="form-control" readonly></textarea>
    </div>

    <input type="hidden" id="lokas_tanah" name="lokasiTanah">
    <input type="hidden" id="nama_lokasi" name="namaLokasi">
    <input type="hidden" id="lat" name="lat">
    <input type="hidden" id="lng" name="lng">

    <div class="col-sm-2" id="pilih_lokasi_wrapper">
      <!-- Button trigger modal -->

      <button type="button" class="btn btn-default" data-toggle="modal" id="pilih_lokasi" data-target="#myModal">
        <img src="{{ asset('maps.png') }}" alt="" style="width: 40px;height: auto;">
        <div id="pilih_lokasi_text">Pilih Lokasi</div>
      </button>
    </div>
  </div>
  <div class="form-group">
    <label for="rumahTanah" class="col-sm-2 control-label">Luas Tanah (m<sup>2</sup>)</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="rumahTanah" placeholder="Luas Tanah" name="luasTanah" value="{{ old('luasTanah') }}">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Simpan</button>
    </div>
  </div>
</form>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h1 style="margin:0;padding:0;">PILIH LOKASI</h1>
      </div>
      <div class="modal-body">
        <div id="map-canvas" class="col-sm-12"></div>
      </div>
      <div class="modal-footer" style="text-align: left;">
        <div class="form-group col-sm-6" style="text-align: left;">
          <label for="show_all_marker">
            <input type="checkbox" name="" id="show_all_marker" onchange="onMethodTypeChange(this.checked);"> Show All Marker
          </label>
        </div>
        <button type="button" class="btn btn-primary btn-lg" id="btn_selesai" data-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>

<script>
jQuery('#alamat_lokasi_wrapper').hide();

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
        var flags = [], output = [];
        var jml_true=0;
        var jml_false=0;
        for (i = 0; i < locations.length; i++) {
            
            marker[i].setIcon( isWithinBound(marker[i].getPosition(), markerCenter.getPosition()) ? on: off);

            if (isWithinBound(marker[i].getPosition(), markerCenter.getPosition())){
              if( flags[locations[i].kategori_lokasi]) continue;
              flags[locations[i].kategori_lokasi] = true;
              output.push(locations[i].kategori_lokasi);
            }

            infoWindow.close();
        };


        jQuery('#lat').val(markerCenter.getPosition().lat());
        jQuery('#lng').val(markerCenter.getPosition().lng());
        jQuery('#lokas_tanah').val(output.length);
        jQuery('#nama_lokasi').val(output);
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
      map.setCenter(markerCenter.getPosition());
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

    $('#btn_selesai').click( function () {
      codeLatLng(markerCenter.getPosition());

        var flags = [], output = [];
        var jml_true=0;
        var jml_false=0;
        for (i = 0; i < locations.length; i++) {
            
            marker[i].setIcon( isWithinBound(marker[i].getPosition(), markerCenter.getPosition()) ? on: off);

            if (isWithinBound(marker[i].getPosition(), markerCenter.getPosition())){
              if( flags[locations[i].kategori_lokasi]) continue;
              flags[locations[i].kategori_lokasi] = true;
              output.push(locations[i].kategori_lokasi);
            }

            infoWindow.close();
        };

        jQuery('#lat').val(markerCenter.getPosition().lat());
        jQuery('#lng').val(markerCenter.getPosition().lng());
        jQuery('#lokas_tanah').val(output.length);
        jQuery('#nama_lokasi').val(output);
        jQuery('#alamat_lokasi_wrapper').show();
        jQuery('#pilih_lokasi_wrapper').css('padding','0px');
        jQuery('#pilih_lokasi_text').html('Ganti Lokasi');
    });

    function codeLatLng(value)
    {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'latLng': value}, function(results, status)
        {
            if (status == google.maps.GeocoderStatus.OK)
            {
                if (results[0])
                {

                    jQuery('#alamat_lokasi').html(results[0].formatted_address);

                }
                else
                {
                    jQuery('#alamat_lokasi').val("No results found");
                }
            }
            else
            {
                alert("Geocoder failed due to: " + status);
            }
        });
    }

};

</script>

@endsection
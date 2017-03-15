@extends('layout.app')

@section('content')
  
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCzX9p40w9AMetlyG_qUi_9rw0ifj9rhk&libraries=places"></script>

<div class="col-sm-12">
  <form class="form-horizontal" action="add" method="post">
  {{ csrf_field() }}
    <div class="form-group" style="position: fixed;float:right;right:15px;top: 50%">
      <input type="submit" value="Simpan" class="btn btn-primary">
    </div>
    <div class="form-group">
      <label for="namaLokasi" class="control-label">Nama Lokasi</label>
      <div class="">
        <input type="text" class="form-control" id="namaLokasi" placeholder="Judul Lokasi" name="nama_lokasi" value="{{ old('nama_lokasi') }}">
      </div>
    </div>
    <div class="form-group">
      <label for="kategoriLokasi" class="control-label">Kategori Lokasi</label>
          <select class="form-control" id="kategoriLokasi" name="kategori_lokasi">
          <option value="Rumah_Ibadah" {{ ("Rumah_Ibadah" == old("kategori_lokasi")) ? 'selected="selected"' : '' }}>Rumah Ibadah</option>
          <option value="Sekolah_SD" {{ ("Sekolah_SD" == old("kategori_lokasi")) ? 'selected="selected"' : '' }}>Sekolah SD</option>
          <option value="Sekolah_SMP" {{ ("Sekolah_SMP" == old("kategori_lokasi")) ? 'selected="selected"' : '' }}>Sekolah SMP</option>
          <option value="Sekolah_SMA" {{ ("Sekolah_SMA" == old("kategori_lokasi")) ? 'selected="selected"' : '' }}>Sekolah SMA</option>
          <option value="Pasar_Tradisional" {{ ("Pasar_Tradisional" == old("kategori_lokasi")) ? 'selected="selected"' : '' }}>Pasar Tradisional</option>
          <option value="Pasar_Modern" {{ ("Pasar_Modern" == old("kategori_lokasi")) ? 'selected="selected"' : '' }}>Pasar Modern</option>
          <option value="Tempat_Makan" {{ ("Jalan_Raya" == old("kategori_lokasi")) ? 'selected="selected"' : '' }}>Rumah Makan/Caffe/Restoran</option>
          <option value="Jalan_Tol" {{ ("Jalan_Tol" == old("kategori_lokasi")) ? 'selected="selected"' : '' }}>Jalan Tol</option>
          <option value="Universitas" {{ ("Universitas" == old("kategori_lokasi")) ? 'selected="selected"' : '' }}>Universitas</option>
          <option value="Kantor_Pemerintahan" {{ ("Kantor_Pemerintahan" == old("kategori_lokasi")) ? 'selected="selected"' : '' }}>Kantor Pemerintahan</option>
        </select>
    </div>
    <div class="form-group">
      <label for="searchmap" class="control-label">Map</label>
      <div class="">
        <input type="text" class="form-control" id="searchmap" placeholder="Search Location" name="searchmap" value="{{ old('searchmap') }}">
        <div id="map-canvas" class="col-sm-12" style="height:500px;"></div>
      </div>
    </div>
    <div class="form-group">
      <label for="lat" class="control-label">Latitude</label>
      <div class="">
        <input type="text" class="form-control" id="lat" placeholder="Latitude" name="lat" value="{{ old('lat') }}">
      </div>
    </div>
    <div class="form-group">
      <label for="lng" class="control-label">Longitude</label>
      <div class="">
        <input type="text" class="form-control" id="lng" placeholder="Longitude" name="lng" value="{{ old('lng') }}">
      </div>
    </div>
  </form>
</div>

<script>
  var map = new google.maps.Map(document.getElementById('map-canvas'),{
      center:{
          lat: -7.0581870994,
          lng: 110.4266451361
      },
      zoom:15
  });

  var marker = new google.maps.Marker({
    position: {
        lat: -7.0581870994,
        lng: 110.4266451361
    },
    map: map,
    draggable: true
  });

  var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));

  google.maps.event.addListener(searchBox,'places_changed',function(){
        var places = searchBox.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;

        for(i=0; place=places[i];i++){
          bounds.extend(place.geometry.location);
          marker.setPosition(place.geometry.location);
        }
        map.fitBounds(bounds);
        map.setZoom(15);
    });

  google.maps.event.addListener(marker,'position_changed',function(){
    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng();

    $('#lat').val(lat);
    $('#lng').val(lng);
  } ); 


  
  
</script>

@endsection
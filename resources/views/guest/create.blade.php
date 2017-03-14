@extends('layout.app')

@section('content')
  <h3></a> Hitung Harga Rumah</h3>

<div style="width: 100%; height: 500px;" class="">
    {!! Mapper::render() !!}
</div>

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
    <label for="tanahLokasi" class="col-sm-2 control-label">Angka Strategis Lokasi Tanah</label>
    <div class="col-sm-5">
      <ul id="check-list-box" class="list-group checked-list-box">
          <li class="list-group-item" data-color="info">Sekolah SD</li>
          <li class="list-group-item" data-color="info">Sekolah SMP</li>
          <li class="list-group-item" data-color="info">Sekolah SMA</li>
          <li class="list-group-item" data-color="info">Rumah Ibadah</li>
          <li class="list-group-item" data-color="info">Pasar Traditional</li>
          <li class="list-group-item" data-color="info">Pasar Modern</li>
          <li class="list-group-item" data-color="info">Jalan Raya</li>
          <li class="list-group-item" data-color="info">Jalan Tol</li>
          <li class="list-group-item" data-color="info">Kampus/Universitas</li>
          <li class="list-group-item" data-color="info">Kantor Pemerintahan</li>
        </ul>
    </div>
     <label for="" class="control-label">(0 - 10)</label>
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
@endsection
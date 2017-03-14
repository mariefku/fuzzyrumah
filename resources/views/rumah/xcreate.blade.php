@extends('layout.app')

@section('content')
  <h3><a href="{{ action('RumahController@listRumah') }}">Data Harga Rumah</a> | Hitung Harga Rumah</h3>
  @if (count($errors) > 0)
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  <form class="form-horizontal" action="{{ action('RumahController@createRumah') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="itemCode" class="col-sm-2 control-label">Harga NJOP Rumah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rumahNjop" placeholder="Harga NJOP Rumah" name="njopRumah" value="{{ old('njopRumah') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="itemName" class="col-sm-2 control-label">Kondisi Rumah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rumahKondisi" placeholder="Kondisi Rumah" name="kondisiRumah" value="{{ old('kondisiRumah') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="rumahUsia" class="col-sm-2 control-label">Usia Rumah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rumahUsia" placeholder="Usia Rumah" name="usiaRumah" value="{{ old('usiaRumah') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="rumahLuas" class="col-sm-2 control-label">Luas Rumah (m<sup>2</sup>)</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rumahLuas" placeholder="Luas Rumah" name="luasRumah" value="{{ old('luasRumah') }}">
    </div>
  </div>
  <hr>
  <div class="form-group">
    <label for="tanahNjop" class="col-sm-2 control-label">Harga NJOP Tanah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="tanahNjop" placeholder="Harga NJOP Tanah" name="njopTanah" value="{{ old('njopTanah') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="tanahLokasi" class="col-sm-2 control-label">Strategis Lokasi Tanah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="tanahLokasi" placeholder="Angka Strategis" name="lokasiTanah" value="{{ old('lokasiTanah') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="rumahTanah" class="col-sm-2 control-label">Luas Tanah (m<sup>2</sup>)</label>
    <div class="col-sm-10">
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
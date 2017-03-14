@extends('layout.app')

@section('content')
  <h3><a href="{{ action('ItemController@listItem') }}">Data Barang</a> | Menambah Barang</h3>
  @if (count($errors) > 0)
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  <form class="form-horizontal" action="{{ action('ItemController@createItem') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="itemCode" class="col-sm-2 control-label">Kode</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="itemCode" placeholder="Kode" name="code" value="{{ old('code') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="itemName" class="col-sm-2 control-label">Nama Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="itemName" placeholder="Nama Barang" name="name" value="{{ old('name') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputCurrent" class="col-sm-2 control-label">Biaya Produksi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputCurrent" placeholder="Biaya Produksi" name="current_price" value="{{ old('current_price') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputProjection" class="col-sm-2 control-label">Keuntungan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputProjection" placeholder="Proyeksi Keuntungan" name="projection_profit" value="{{ old('projection_profit') }}">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Simpan</button>
    </div>
  </div>
</form>
@endsection
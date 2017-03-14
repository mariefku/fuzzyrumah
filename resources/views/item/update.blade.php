@extends('layout.app')

@section('content')
  <h3><a href="{{ action('ItemController@listItem') }}">Data Barang</a> | <a href="{{ action('ItemController@showItem', $item->id) }}">#{{ $item->code }} {{ $item->name }}</a> | Edit</h3>
  @if (count($errors) > 0)
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  <form class="form-horizontal" action="{{ action('ItemController@updateItem', [$item->id]) }}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="itemCode" class="col-sm-2 control-label">Kode</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="itemCode" placeholder="Kode Item" name="code" value="{{ old('code', $item->code) }}">
    </div>
  </div>
  <div class="form-group">
    <label for="itemName" class="col-sm-2 control-label">Nama Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="itemName" placeholder="Nama Barang" name="name" value="{{ old('name', $item->name) }}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputCompetitor" class="col-sm-2 control-label">Harga Kompetitor</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputCompetitor" placeholder="Harga Kompetitor" name="competitor_price" value="{{ old('competitor_price', $item->competitor_price) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="inputBefore" class="col-sm-2 control-label">Harga Sebelumnya</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputBefore" placeholder="Harga Sebelumnya" name="before_price" value="{{ old('before_price', $item->before_price) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="inputCurrent" class="col-sm-2 control-label">Biaya Produksi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputCurrent" placeholder="Biaya Produksi" name="current_price" value="{{ old('current_price', $item->current_price) }}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputProjection" class="col-sm-2 control-label">Proyeksi Keuntungan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputProjection" placeholder="Proyeksi Keuntungan" name="projection_profit" value="{{ old('projection_profit', $item->projection_profit) }}">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Simpan</button>
    </div>
  </div>
</form>
@endsection
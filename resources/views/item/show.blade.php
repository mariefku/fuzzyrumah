@extends('layout.app')

@section('content')
  <h3><a href="{{ action('ItemController@listItem') }}">Data Barang</a> | #{{ $item->code }} {{ $item->name }}</h3>
  <form class="form-horizontal" action="{{ action('ItemController@updateForm', [$item->id]) }}" method="get">
  <div class="form-group">
    <label for="itemCode" class="col-sm-2 control-label">Kode</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="itemCode" value="{{ $item->code }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="itemName" class="col-sm-2 control-label">Nama Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="itemName" value="{{ $item->name }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="inputCompetitor" class="col-sm-2 control-label">Harga Kompetitor</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputCompetitor" value="{{ currency($item->competitor_price) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="inputBefore" class="col-sm-2 control-label">Harga Sebelumnya</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputBefore" value="{{ currency($item->before_price) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="inputCurrent" class="col-sm-2 control-label">Biaya Produksi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputCurrent" value="{{ currency($item->current_price) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="inputProjection" class="col-sm-2 control-label">Proyeksi Keuntungan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputProjection" value="{{ $item->projection_profit }}%" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="inputFuzzy" class="col-sm-2 control-label">Prediksi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputFuzzy" value="{{ currency($item->fuzzy_price) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="inputFuzzy" class="col-sm-2 control-label">Kalkukasi Profit</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputFuzzy" value="{{ currency($item->fuzzy2_price) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="calcFuzzy" class="col-sm-2 control-label">Kalkulasi Fuzzy 1</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="calcFuzzy" readonly="readonly" style="height: 300px;">
{{ $item->fuzzy_calculation }}
      </textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="calcFuzzy" class="col-sm-2 control-label">Kalkulasi Fuzzy 2</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="calcFuzzy" readonly="readonly" style="height: 300px;">
{{ $item->fuzzy2_calculation }}
      </textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Edit</button>
    </div>
  </div>
</form>
@endsection
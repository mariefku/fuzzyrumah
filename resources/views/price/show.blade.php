@extends('layout.app')

@section('content')
  <h3><a href="{{ action('PriceController@listPrice') }}">Rekam Harga</a> | #{{ $price->item->code }} {{ $price->item->name }} - {{ $price->price_at->format('d M Y') }}</h3>
  <form class="form-horizontal" action="{{ action('PriceController@updateForm', [$price->id]) }}" method="get">
  <div class="form-group">
    <label for="itemId" class="col-sm-2 control-label">Data Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="itemId" value="{{ $price->item->code }} - {{ $price->item->name }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="price" class="col-sm-2 control-label">Harga</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="price" value="{{ $price->price }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="priceDate" class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="priceDate" value="{{ $price->price_at->format('d/m/Y') }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="priceType" class="col-sm-2 control-label">Tipe Harga</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="priceType" value="{{ $price->type_string }}"" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Edit</button>
    </div>
  </div>
</form>
@endsection
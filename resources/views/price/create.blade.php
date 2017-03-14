@extends('layout.app')

@section('content')
  <h3><a href="{{ action('PriceController@listPrice') }}">Rekam Harga</a> | Menambah Rekam Harga</h3>
  @if (count($errors) > 0)
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  <form class="form-horizontal" action="{{ action('PriceController@createPrice') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="itemId" class="col-sm-2 control-label">Data Barang</label>
    <div class="col-sm-10">
      <select class="form-control" id="itemId" name="item_id">
        @foreach ($items as $item)
          <option value="{{ $item->id }}" {{ (old("item_id") == $item->id ? 'selected="selected"' : '') }}>{{ $item->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="price" class="col-sm-2 control-label">Harga</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="price" placeholder="Harga" name="price" value="{{ old('price') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="priceDate" class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-10">
      <input data-provide="datepicker" type="text" class="form-control" id="priceDate" placeholder="dd/mm/yyyy" name="price_at" value="{{ old('price_at') }}">
    </div>
  </div>
  <div class="form-group">
    <label for="priceType" class="col-sm-2 control-label">Tipe Harga</label>
    <div class="col-sm-10">
      <select class="form-control" id="priceType" name="type">
        <option value="SBL" {{ ("SBL" == old("type")) ? 'selected="selected"' : '' }}>Harga Sebelum</option>
        <option value="KOM" {{ ("KOM" == old("type")) ? 'selected="selected"' : '' }}>Harga Kompetitor</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Simpan</button>
    </div>
  </div>
</form>
@endsection
@extends('layout.app')

@section('content')
  <h3>Data Rekam Harga</h3>
  <div class="list-main-btn">
    <div class="row">
      @if (Auth::user()->isLevel('ADMIN'))
      <div class="col-sm-4">
        <a href="{{ action('PriceController@createForm') }}" class="btn btn-success">Tambah Rekam Harga</a>
      </div>
      <div class="col-sm-8">
        <form class="form" role="form" method="get" action="{{ action('PriceController@listPrice') }}">
          <input class="form-control" type="text" name="q" placeholder="search" value="{{ Request::get('q') }}">
        </form>
      </div>
      @else
      <div class="col-sm-12">
        <form class="form" role="form" method="get" action="{{ action('PriceController@listPrice') }}">
          <input class="form-control" type="text" name="q" placeholder="search" value="{{ Request::get('q') }}">
        </form>
      </div>
      @endif
    </div>
  </div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga Barang</th>
        <th>Tipe Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($prices as $price)
      <tr>
        <td>{{ $price->price_at->format('d/m/Y') }}</td>
        <td>{{ $price->item->code }}</td>
        <td>{{ $price->item->name }}</td>
        <td>{{ $price->price }}</td>
        <td>
          @if ($price->type == "SBL")
            Sebelum
          @elseif ($price->type == "KOM")
            Kompetitor
          @else
            {{ $price->type }}
          @endif
        </td>
        <td>
          <form class="list-action" method="get" action="{{ action('PriceController@showPrice', [$price->id]) }}">
            <button type="submit" class="btn btn-default">Show</button>
          </form>
          <form class="list-action" method="post" action="{{ action('PriceController@deletePrice', [$price->id]) }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
    @endforeach
    <tbody>
  </table>
@endsection
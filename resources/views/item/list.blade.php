@extends('layout.app')

@section('content')
  <h3>Daftar Data Harga Barang</h3>
  <div class="list-main-btn">
    <div class="row">
      @if (Auth::user()->isLevel('ADMIN'))
      <div class="col-sm-4">
        <a href="{{ action('ItemController@createForm') }}" class="btn btn-success">Tambah Data Barang</a>
      </div>
      <div class="col-sm-8">
        <form class="form" role="form" method="get" action="{{ action('ItemController@listItem') }}">
          <input class="form-control" type="text" name="q" placeholder="search" value="{{ Request::get('q') }}">
        </form>
      </div>
      @else
      <div class="col-sm-12">
        <form class="form" role="form" method="get" action="{{ action('ItemController@listItem') }}">
          <input class="form-control" type="text" name="q" placeholder="search" value="{{ Request::get('q') }}">
        </form>
      </div>
      @endif
    </div>
  </div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Kode</th>
        <th>Nama Barang</th>
        <th>Kompetitor</th>
        <th>Sebelumnya</th>
        <th>Biaya Produksi</th>
        <th>Keuntungan</th>
        <th>Prediksi</th>
        <th>Kalkulasi Profit</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
      <tr>
        <td>{{ $item->code }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->competitor_price }}</td>
        <td>{{ $item->before_price }}</td>
        <td>{{ $item->current_price }}</td>
        <td>{{ $item->projection_profit }}%</td>
        <td>{{ $item->fuzzy_price }}</td>
        <td>{{ $item->fuzzy2_price }}</td>
        <td>
          <form class="list-action" method="get" action="{{ action('ItemController@showItem', [$item->id]) }}">
            <button type="submit" class="btn btn-default">Show</button>
          </form>
          <form class="list-action" method="post" action="{{ action('ItemController@deleteItem', [$item->id]) }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
    @endforeach
    <tbody>
  </table>
@endsection
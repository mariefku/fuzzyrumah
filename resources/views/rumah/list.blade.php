@extends('layout.app')

@section('content')
  <h3>Daftar Data Harga Rumah</h3>
  <div class="list-main-btn">
    <div class="row">
      @if (Auth::user()->isLevel('ADMIN'))
      <div class="col-sm-4">
        <a href="{{ action('RumahController@createFormRumah') }}" class="btn btn-success">Hitung Harga Rumah</a>
      </div>
      <div class="col-sm-8">
        <form class="form" role="form" method="get" action="{{ action('RumahController@listRumah') }}">
          <input class="form-control" type="text" name="q" placeholder="search" value="{{ Request::get('q') }}">
        </form>
      </div>
      @else
      <div class="col-sm-12">
        <form class="form" role="form" method="get" action="{{ action('RumahController@listRumah') }}">
          <input class="form-control" type="text" name="q" placeholder="search" value="{{ Request::get('q') }}">
        </form>
      </div>
      @endif
    </div>
  </div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Harga NJOP Rumah</th>
        <th width="50" >Kondisi Rumah</th>        
        <th>Usia Rumah</th>
        <th width="70">Luas Rumah</th>
        <th>Harga NJOP Tanah</th>
        <th width="50">Lokasi Tanah</th>
        <th>Luas Tanah</th>
        <th>Prediksi Harga Rumah</th>
        <th>Prediksi Harga Tanah</th>
        <th width="150">Hasil Akhir</th>
        <th width="110">Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($rumahs as $rumah)
    @php
      $fuzzy_price = $rumah->fuzzy_price;
      $luas_rumah = $rumah->luas_rumah;
      $prediksi_rumah = $fuzzy_price * $luas_rumah;

      $fuzzy2_price = $rumah->fuzzy2_price;
      $luas_tanah = $rumah->luas_tanah;
      $prediksi_tanah = $fuzzy2_price * $luas_tanah;

      $hasilAkhir = $prediksi_tanah + $prediksi_rumah;
    @endphp
      <tr>
        <td>{{ currency($rumah->njop_rumah) }}</td>
        <td>{{ $rumah->kondisi_rumah }} %</td>
        <td>{{ $rumah->usia_rumah }} Tahun</td>
        <td>{{ $rumah->luas_rumah }} m<sup>2</sup></td>
        <td>{{ currency($rumah->njop_tanah) }}</td>
        <td>{{ $rumah->lokasi_tanah }}</td>
        <td>{{ $rumah->luas_tanah }} m<sup>2</sup></td>
        <td>{{ currency($fuzzy_price) }}</td>
        <td>{{ currency($fuzzy2_price) }}</td>
        <td>{{ currency($hasilAkhir) }}</td>
        <td>
          <form class="list-action" method="get" action="{{ action('RumahController@showRumah', [$rumah->id]) }}">
            <button type="submit" class="btn btn-default btn-xs">Show</button>
          </form>
          <form class="list-action" method="post" action="{{ action('RumahController@deleteRumah', [$rumah->id]) }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
          </form>
        </td>
    @endforeach
    <tbody>
  </table>
@endsection
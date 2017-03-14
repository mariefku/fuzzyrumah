@extends('layout.app')

@section('content')
  <h3>Pengaturan Rules Fuzzy 2</h3>
    <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Kalkulasi 1</th>
        <th>Proyeksi Keuntungan</th>
        <th>Then</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($fuzzysets as $fuzzyset)
      <tr>
        <td>{{ $fuzzyset->id }}</td>
        <td>{{ $fuzzyset->njop_tanah }}</td>
        <td>{{ $fuzzyset->lokasi_tanah }}</td>
        <td>{{ $fuzzyset->result_price }}</td>
        <td><a href="{{ action('Fuzzy2setController@showSet', [$fuzzyset->id]) }}" class="btn btn-default">Show</a></td>
    @endforeach
    <tbody>
  </table>
@endsection
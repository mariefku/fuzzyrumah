@extends('layout.app')

@section('content')
  <h3>Pengaturan Rules Fuzzy 1</h3>
    <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Harga NJOP Rumah</th>
        <th>Kondisi Rumah</th>
        <th>Usia Rumah</th>
        <th>Then</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($fuzzysets as $fuzzyset)
      <tr>
        <td>{{ $fuzzyset->id }}</td>
        <td>{{ $fuzzyset->njop_rumah }}</td>
        <td>{{ $fuzzyset->kondisi_rumah }}</td>
        <td>{{ $fuzzyset->usia_rumah }}</td>
        <td>{{ $fuzzyset->result_price }}</td>
        <td><a href="{{ action('FuzzysetController@showSet', [$fuzzyset->id]) }}" class="btn btn-default">Show</a></td>
    @endforeach
    <tbody>
  </table>
@endsection
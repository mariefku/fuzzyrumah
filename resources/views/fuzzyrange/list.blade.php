@extends('layout.app')

@section('content')
  <h3>Pengaturan Range Fuzzy 1</h3>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Range</th>
        <th>Batas Bawah</th>
        <th>Batas Atas</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($fuzzyranges as $fuzzyrange)
      <tr>
        <td>{{ $fuzzyrange->id }}</td>
        <td>{{ $fuzzyrange->code }}</td>
        <td>{{ $fuzzyrange->min }}</td>
        <td>{{ $fuzzyrange->max }}</td>
        <td><a href="{{ action('FuzzyrangeController@showRange', [$fuzzyrange->id]) }}" class="btn btn-default">Show</a></td>
    @endforeach
    <tbody>
  </table>
@endsection
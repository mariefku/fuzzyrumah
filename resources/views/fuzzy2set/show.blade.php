@extends('layout.app')

@section('content')
  <h3>Pengaturan Rules Fuzzy 2</h3>
  <form class="form-horizontal" action="{{ action('Fuzzy2setController@updateForm', [$fuzzyset->id]) }}" method="get">
  <div class="form-group">
    <label for="fuzzyPrice" class="col-sm-2 control-label">Kalkulasi 1</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fuzzyPrice" value="{{ $fuzzyset->njop_tanah }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="projectionProfit" class="col-sm-2 control-label">Proyeksi Keuntungan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="projectionProfit" value="{{ $fuzzyset->lokasi_tanah }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="thenPrice" class="col-sm-2 control-label">Then</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="thenPrice" value="{{ $fuzzyset->result_price }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Edit</button>
    </div>
  </div>
</form>
@endsection
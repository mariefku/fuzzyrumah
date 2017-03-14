@extends('layout.app')

@section('content')
  <h3>Pengaturan Range Fuzzy 1</h3>
  <form class="form-horizontal" action="{{ action('FuzzyrangeController@updateForm', [$fuzzyrange->id]) }}" method="get">
    <div class="form-group">
      <label for="state" class="col-sm-2 control-label">Range</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="state" value="{{ $fuzzyrange->code }}" readonly="readonly">
      </div>
    </div>
    <div class="form-group">
      <label for="minValue" class="col-sm-2 control-label">Batas Bawah</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="minValue" value="{{ $fuzzyrange->min }}" readonly="readonly">
      </div>
    </div>
    <div class="form-group">
      <label for="maxValue" class="col-sm-2 control-label">Batas Atas</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="maxValue" value="{{ $fuzzyrange->max }}" readonly="readonly">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Edit</button>
      </div>
    </div>
  </form>
@endsection
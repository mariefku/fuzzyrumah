@extends('layout.app')

@section('content')
  <h3>Pengaturan Range Fuzzy</h3>
  @if (count($errors) > 0)
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  <form class="form-horizontal" action="{{ action('FuzzyrangeController@updateRange', [$fuzzyrange->id]) }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="state" class="col-sm-2 control-label">Range</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="state" value="{{ $fuzzyrange->state }}" readonly="readonly">
      </div>
    </div>
    <div class="form-group">
      <label for="minValue" class="col-sm-2 control-label">Batas Bawah</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="minValue" name="min" value="{{ old('min', $fuzzyrange->min) }}">
      </div>
    </div>
    <div class="form-group">
      <label for="maxValue" class="col-sm-2 control-label">Batas Atas</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="maxValue" name="max" value="{{ old('max', $fuzzyrange->max) }}">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Simpan</button>
      </div>
    </div>
  </form>
@endsection
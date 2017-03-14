@extends('layout.app')

@section('content')
  <h3>Pengaturan Rules Fuzzy 2</h3>
  <form class="form-horizontal" action="{{ action('Fuzzy2setController@updateSet', [$fuzzyset->id]) }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="fuzzyPrice" class="col-sm-2 control-label">Kalkulasi 1</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="fuzzyPrice" value="{{ $fuzzyset->fuzzy_price }}" readonly="readonly">
      </div>
    </div>
    <div class="form-group">
      <label for="projectionProfit" class="col-sm-2 control-label">Proyeksi Keuntungan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="projectionProfit" value="{{ $fuzzyset->projection_profit }}" readonly="readonly">
      </div>
    </div>
    <div class="form-group">
      <label for="thenPrice" class="col-sm-2 control-label">Then</label>
      <div class="col-sm-10">
        <select class="form-control" id="thenPrice" name="result_price">
          <option value="LOW" {{ ("LOW" == $fuzzyset->result_price) ? 'selected="selected"' : '' }}>LOW</option>
          <option value="MID" {{ ("MID" == $fuzzyset->result_price) ? 'selected="selected"' : '' }}>MID</option>
          <option value="HIGH" {{ ("HIGH" == $fuzzyset->result_price) ? 'selected="selected"' : '' }}>HIGH</option>
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
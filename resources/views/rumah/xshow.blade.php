@extends('layout.app')

@section('content')

    @php
      $fuzzy_price = $rumah->fuzzy_price;
      $luas_rumah = $rumah->luas_rumah;
      $prediksi_rumah = $fuzzy_price * $luas_rumah;

      $fuzzy2_price = $rumah->fuzzy2_price;
      $luas_tanah = $rumah->luas_tanah;
      $prediksi_tanah = $fuzzy2_price * $luas_tanah;

      $hasilAkhir = $prediksi_tanah + $prediksi_rumah;
    @endphp

  <h3><a href="{{ action('RumahController@listRumah') }}">Data Barang</a> | #{{ $rumah->code }} {{ $rumah->name }}</h3>
  <form class="form-horizontal" action="{{ action('RumahController@updateFormRumah', [$rumah->id]) }}" method="get">
  <div class="form-group">
    <label for="rumahNjop" class="col-sm-2 control-label">Harga NJOP Rumah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rumahNjop" name="njopRumah" value="{{ currency($rumah->njop_rumah) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="rumahKondisi" class="col-sm-2 control-label">Kondisi Rumah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rumahKondisi" name="kondisiRumah" value="{{ $rumah->kondisi_rumah }}%" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="rumahUsia" class="col-sm-2 control-label">Usia Rumah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rumahUsia" name="usiaRumah" value="{{ $rumah->usia_rumah }} Tahun" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="rumahLuas" class="col-sm-2 control-label">Luas Rumah</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" id="rumahLuas" name="luasRumah" value="{{ $rumah->luas_rumah }}" readonly="readonly"> 
    </div>
    <label for="" class="control-label">m<sup>2</sup></label>
  </div>
  <hr>
  <div class="form-group">
    <label for="tanahNjop" class="col-sm-2 control-label">Harga NJOP Tanah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="tanahNjop" name="njopTanah" value="{{ currency($rumah->njop_tanah) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="tanahLokasi" class="col-sm-2 control-label">Strategis Lokasi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="tanahLokasi" name="lokasiTanah" value="{{ $rumah->lokasi_tanah }}" readonly="readonly">
    </div>
  </div> 
  <div class="form-group">
    <label for="tanahLuas" class="col-sm-2 control-label">Luas Tanah</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" id="tanahLuas" name="luasTanah" value="{{ $rumah->luas_tanah }}" readonly="readonly">
    </div>
    <label for="" class="control-label">m<sup>2</sup></label>
  </div>
  <hr>
  <div class="form-group">
    <label for="inputFuzzy" class="col-sm-2 control-label">Prediksi Harga Rumah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputFuzzy" value="{{ currency($prediksi_rumah) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="inputFuzzy" class="col-sm-2 control-label">Prediksi Harga Tanah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputFuzzy" value="{{ currency($prediksi_tanah) }}" readonly="readonly">
    </div>
  </div>
    <div class="form-group">
    <label for="hasilAkhir" class="col-sm-2 control-label">Hasil Akhir Prediksi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="hasilAkhir" value="{{ currency($hasilAkhir) }}" readonly="readonly">
    </div>
  </div>
  <hr>
  <div class="form-group">
    <label for="calcFuzzy" class="col-sm-2 control-label">Kalkulasi Fuzzy 1</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="calcFuzzy" readonly="readonly" style="height: 300px;">
{{ $rumah->fuzzy_calculation }}
      </textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="calcFuzzy" class="col-sm-2 control-label">Kalkulasi Fuzzy 2</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="calcFuzzy" readonly="readonly" style="height: 300px;">
{{ $rumah->fuzzy2_calculation }}
      </textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Edit</button>
    </div>
  </div>
</form>
@endsection
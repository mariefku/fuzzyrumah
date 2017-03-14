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

  
  <form class="form-horizontal" method="get">
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
    <label for="tanahLokasi" class="col-sm-2 control-label">Angka Strategis Lokasi (0-10)</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="tanahLokasi" name="lokasiTanah" value="{{ $rumah->lokasi_tanah }}" readonly="readonly">
    </div>
  </div> 
  @php
        // Provides: You should eat pizza, beer, and ice cream every day
    $phrase  = $rumah->nama_lokasi;
    $hapus = array("[", "]", "\\", "\"", "\n", "  ");
    $ganti   = array("", "", "", "", "", "");

    $hasilphrase = str_replace($hapus, $ganti, $phrase);

    $pecahhasil = explode(",",$hasilphrase);
  @endphp

  <div class="form-group">
    <label for="nama_lokasi" class="col-sm-2 control-label">Letak Lokasi <br>(dekat dengan)</label>
    <div class="col-sm-10">
      <ul id="check-list-box" class="list-group checked-list-box2">
      @foreach ($pecahhasil as $nama_lokasi)
            <li class="list-group-item " data-color="success" style="float:left;min-width: 236px;"> <span class="glyphicon glyphicon-road" aria-hidden="true"></span> {{ $nama_lokasi }}</li>
      @endforeach
      </ul>
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
      <input type="text" class="form-control" id="inputFuzzy" value="{{ currency($fuzzy_price) }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="inputFuzzy" class="col-sm-2 control-label">Prediksi Harga Tanah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputFuzzy" value="{{ currency($fuzzy2_price) }}" readonly="readonly">
    </div>
  </div>
    <div class="form-group">
    <label for="hasilAkhir" class="col-sm-2 control-label">Hasil Akhir Prediksi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="hasilAkhir" value="{{ currency($hasilAkhir) }}" readonly="readonly">
    </div>
  </div>

  <table class="table" style="width:100%;">
    <tr>
      <td style="padding:10px;border:none;"><h3>Harga Rumah</h3></td>
      <td style="padding-left:20px;border-left: 2px solid #333;border-top:none;"><h3>{{currency($hasilAkhir)}}</h3></td>
    </tr>
    <tr>
      <td style="border:none;"></td>
      <td class="success" style="padding-left:20px;border-left: 2px solid #333;"><h4 style="margin:0px;text-transform:capitalize;">{{numbertoword($hasilAkhir)}}</h4></td>
    </tr>
  </table>
  <hr>
</form>
@endsection
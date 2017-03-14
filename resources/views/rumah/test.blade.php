@extends('layout.app')

@section('content')




              <ul id="check-list-box" class="list-group checked-list-box">
                  <li class="list-group-item" data-color="info">Sekolah SD</li>
                  <li class="list-group-item" data-color="info">Sekolah SMP</li>
                  <li class="list-group-item" data-color="info">Sekolah SMA</li>
                  <li class="list-group-item" data-color="info">Rumah Ibadah</li>
                  <li class="list-group-item" data-color="info">Pasar Traditional</li>
                  <li class="list-group-item" data-color="info">Pasar Modern</li>
                  <li class="list-group-item" data-color="info">Jalan Raya</li>
                  <li class="list-group-item" data-color="info">Jalan Tol</li>
                  <li class="list-group-item" data-color="info">Kampus/Universitas</li>
                  <li class="list-group-item" data-color="info">Kantor Pemerintahan</li>
                </ul>
                <br />
                <button class="btn btn-primary col-xs-12" id="get-checked-data">Get Checked Data</button>

            <pre id="display-json"></pre>


@endsection
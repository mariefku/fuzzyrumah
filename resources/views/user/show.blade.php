@extends('layout.app')

@section('content')
  <h3><a href="{{ action('UserController@listUser') }}">Data Pengguna</a> | {{ $user->name }}</h3>
  <form class="form-horizontal" action="{{ action('UserController@updateForm', [$user->id]) }}" method="get">
  <div class="form-group">
    <label for="userName" class="col-sm-2 control-label">Nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="userName" value="{{ $user->name }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="userEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="userEmail" value="{{ $user->email }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label for="userLevel" class="col-sm-2 control-label">Level</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="userLevel" value="{{ ($user->level == "ADMIN" ? "Admin" : "Sekretaris") }}" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Edit</button>
    </div>
  </div>
</form>
@endsection
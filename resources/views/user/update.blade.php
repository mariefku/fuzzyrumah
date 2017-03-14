@extends('layout.app')

@section('content')
  <h3><a href="{{ action('UserController@listUser') }}">Data Pengguna</a> | <a href="{{ action("UserController@showUser", [$user->id]) }}">{{ $user->name }}</a> | Edit</h3>
  @if (count($errors) > 0)
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  <form class="form-horizontal" action="{{ action('UserController@updateUser', [$user->id]) }}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="userName" class="col-sm-2 control-label">Nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="userName" placeholder="Nama User" name="name" value="{{ old('name', $user->name) }}">
    </div>
  </div>
  <div class="form-group">
    <label for="userEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="userEmail" placeholder="Email" name="email" value="{{ old('email', $user->email) }}">
    </div>
  </div>
  <div class="form-group">
    <label for="userLevel" class="col-sm-2 control-label">Level</label>
    <div class="col-sm-10">
      <select class="form-control" id="userLevel" name="level">
        <option value="ADMIN" {{ ("ADMIN" == old('level', $user->level)) ? 'selected="selected"' : '' }}>Admin</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Simpan</button>
    </div>
  </div>
</form>
<h4>Reset Password</h4>
<form class="form-horizontal" action="{{ action('UserController@changePassword', [$user->id]) }}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="userPassword" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="userPassword" placeholder="Password" name="password" value="">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Simpan</button>
    </div>
  </div>
</form>
@endsection
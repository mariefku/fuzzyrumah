@extends('layout.app')

@section('content')
  <h3>Daftar Data Pengguna</h3>
  <div class="list-main-btn">
    <a href="{{ action('UserController@createForm') }}" class="btn btn-success">Tambah Data Pengguna</a>
  </div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Level</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @if ($user->level == "ADMIN")
            Admin
          @elseif ($user->level == "SEKRE")
            Sekretaris
          @else 
            {{ $user->level }}
          @endif
        </td>
        <td>
          <form class="list-action" method="get" action="{{ action('UserController@showUser', [$user->id]) }}">
            <button type="submit" class="btn btn-default">Show</button>
          </form>
          <form class="list-action" method="post" action="{{ action('UserController@deleteUser', [$user->id]) }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
    @endforeach
    <tbody>
  </table>
@endsection
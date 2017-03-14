@extends('layout.app')

@section('content')
 <div class="wrapper">
    <form class="form-signin" method="post" action="{{ action("Auth\AuthController@postLogin") }}">
      {!! csrf_field() !!}  
      <h2 class="form-signin-heading">Login</h2>
      <input type="text" class="form-control" name="email" placeholder="Email Address" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
      <button class="btn btn-primary" type="submit">Login</button>   
    </form>
  </div>
@endsection
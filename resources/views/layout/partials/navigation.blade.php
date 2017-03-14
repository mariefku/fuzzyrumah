      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            @if (Auth::check())
              <a class="navbar-brand" href="{{ url('/rumah') }}">Aplikasi Fuzzy Rumah</a>
            @else
              <a class="navbar-brand" href="{{ url('/') }}">Aplikasi Fuzzy Rumah</a>
            @endif
          </div>
          <div id="navbar" class="navbar-collapse collapse">

            @if (Auth::check())
            <ul class="nav navbar-nav">
              @if (Auth::user()->isLevel('ADMIN'))
              <li><a href="{{ action('RumahController@listRumah') }}">Data Harga Rumah</a></li>
              <li><a href="{{ action('FuzzysetController@listSet') }}">Rules Fuzzy 1</a></li>
              <li><a href="{{ action('FuzzyrangeController@listRange') }}">Ranges Fuzzy 1</a></li>
              <li><a href="{{ action('Fuzzy2setController@listSet') }}">Rules Fuzzy 2</a></li>
              <li><a href="{{ action('Fuzzy2rangeController@listRange') }}">Ranges Fuzzy 2</a></li>
              <li><a href="{{ action('UserController@listUser') }}">Pengguna</a></li>
              @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a></li>
                  <!-- li class="dropdown-header">Nav header</li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li !-->
                </ul>
              </li>
            </ul>
            @else
            <ul class="nav navbar-nav navbar-right">
              <li><a href="{{ url('/') }}">Home</a></li>
              <li><a href="{{ action('Auth\AuthController@getLogin') }}">Login</a></li>
              <!-- li class="dropdown-header">Nav header</li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li !-->
            </ul>
            @endif
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

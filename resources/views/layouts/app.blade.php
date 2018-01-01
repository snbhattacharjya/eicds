<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
      <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/start')}}">{{config('app.name')}}</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Environment <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{route('state.index')}}">States</a></li>
                  <li><a href="{{route('district.index')}}">Districts</a></li>
                  <li><a href="{{route('icdsproject.index')}}">ICDS Projects</a></li>
                  <li><a href="{{route('sector.index')}}">Sectors</a></li>
                  <li><a href="{{route('anganwadicentre.index')}}">Anganwadi Centres</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Project Settings  <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Caste Category</a></li>
                  <li><a href="#">Target Types</a></li>
                  <li><a href="#">Disability Types</a></li>
                  <li><a href="#">ICDS Services</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Anganwadi Centre Registers  <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('/familydetail')}}">Reg 1 - Family Register</a></li>
                  <li><a href="#">Reg 2 - Supplementary Food Stock</a></li>
                  <li><a href="{{url('/fooddistribution')}}">Reg 3 - Supplementray Food Distribution</a></li>
                  <li><a href="{{url('/preschooleducation')}}">Reg 4 - Preschool Education</a></li>
                  <li><a href="#">Reg 5 - Pregnancy and Delivaery Records</a></li>
                  <li><a href="#">Reg 6 - Immunization and VHND</a></li>
                  <li><a href="#">Reg 7 - Vitamin A Biannual Rounds</a></li>
                  <li><a href="#">Reg 8 - Home Visit Planner</a></li>
                  <li><a href="#">Reg 9 - Case Management and Referrals</a></li>
                  <li><a href="#">Reg 10 - Weight Records for Children</a></li>
                </ul>
              </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              @guest
                  <li><a href="{{ route('login') }}">Login</a></li>
                  <li><a href="{{ route('register') }}">Register</a></li>
              @else
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu">
                          <li>
                              <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                      </ul>
                  </li>
              @endguest
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

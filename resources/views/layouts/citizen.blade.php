<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{asset('mobirise/images/icds-logo-transparent1-689x661.png')}}' />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
<body>
    <div id="app">
      <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{url('/')}}">
              <img alt="{{config('app.name')}}" src="{{asset('mobirise/images/icds-logo-transparent1-689x661.png')}}" height="25" width="25">
            </a>
            <a class="navbar-brand" href="{{url('/')}}">{{config('app.name')}}</a>
          </div>

          @if (Auth::guard('citizen')->check())
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Family Records  <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('/citizen/familydetails')}}">Family Details</a></li>
                  <li><a href="{{url('/citizen/snp')}}">Supplementary Nutrition</a></li>
                  <li><a href="{{url('/citizen/preganancy')}}">Pregnancy Delivery Records</a></li>
                  <li><a href="{{url('/citizen/immunization')}}">Immunisation</a></li>
                  <li><a href="{{url('/citizen/vitamina')}}">Vitamin A</a></li>
                  <li><a href="{{url('/citizen/weightrecords')}}">Weight Records</a></li>
                  <li><a href="{{url('/citizen/preschool')}}">Pre School Education</a></li>
                  <li><a href="{{url('/citizen/migrations')}}">Family Migrations</a></li>
                </ul>
              </li>

            </ul>
          @endif
            <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              @guest
                  <li><a href="{{ route('citizen.login') }}">Login</a></li>
                  <li><a href="{{ route('citizen.register') }}">Register</a></li>
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
    @yield('scripts')
</body>
</html>

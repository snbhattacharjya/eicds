<!DOCTYPE html>
<html >
<head>
  <!-- Site made with Mobirise Website Builder v4.5.4, # -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.5.4, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="{{asset('mobirise/images/icds-logo-transparent1-689x661.png')}}" type="image/x-icon">
  <meta name="description" content="">
  <title>Home</title>

  <link rel="stylesheet" href="{{asset('mobirise/web/assets/mobirise-icons-bold/mobirise-icons-bold.css')}}">
  <link rel="stylesheet" href="{{asset('mobirise/web/assets/mobirise-icons/mobirise-icons.css')}}">
  <link rel="stylesheet" href="{{asset('mobirise/tether/tether.min.css')}}">
  <link rel="stylesheet" href="{{asset('mobirise/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('mobirise/bootstrap/css/bootstrap-grid.min.css')}}">
  <link rel="stylesheet" href="{{asset('mobirise/bootstrap/css/bootstrap-reboot.min.css')}}">
  <link rel="stylesheet" href="{{asset('mobirise/dropdown/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('mobirise/socicon/css/styles.css')}}">
  <link rel="stylesheet" href="{{asset('mobirise/animatecss/animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('mobirise/theme/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('mobirise/mobirise/css/mbr-additional.css')}}" type="text/css">



</head>
<body>
<section class="menu cid-qFFl7Z51jP" once="menu" id="menu1-e">



    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">

                         <img src="{{asset('mobirise/images/icds-logo-transparent1-689x661.png')}}" alt="eicds" title="eIcds" style="height: 3.8rem;">

                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-5" href="#">
                        eIcds</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="#"><span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>
                        Home&nbsp;</a></li>
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="#"><span class="mbri-laptop mbr-iconfont mbr-iconfont-btn"></span>
                        MIS &nbsp;</a></li>
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="#"><span class="mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                        AWC Locator &nbsp;</a></li>
                        <li class="nav-item"><a class="nav-link link text-white display-4" href="#"><span class="mbri-question mbr-iconfont mbr-iconfont-btn"></span>
                        RTI&nbsp;</a></li>
                        @if (Auth::check())
                          <li class="nav-item"><a class="nav-link link text-white display-4" href="{{ url('/home') }}"><span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span>
                          Go to My Account &nbsp;</a></li>
                        @else
                          <li class="nav-item"><a class="nav-link link text-white display-4" href="{{ url('/login') }}"><span class="mbri-login mbr-iconfont mbr-iconfont-btn"></span>
                          Login &nbsp;</a></li>
                          <li class="nav-item"><a class="nav-link link text-white display-4" href="{{ url('/register') }}"><span class="mbri-touch mbr-iconfont mbr-iconfont-btn"></span>
                          Register &nbsp;</a></li>
                        @endif
                      </ul>

        </div>
    </nav>
</section>

<!--<section class="engine"><a href="https://mobirise.co/j">how to design your own website</a></section>-->
  @yield('content')
<section class="cid-qFFl80HSb5" id="footer1-g">
    <div class="container">
        <div class="media-container-row content text-white">
            <div class="col-12 col-md-3">
                <div class="media-wrap">
                    <a href="#/">
                        <img src="{{asset('mobirise/images/icds-logo-transparent1-689x661.png')}}" alt="Mobirise" title="">
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Address
                </h5>
                <p class="mbr-text">Chinsurah, Hooghly<br>West Bengal<br>Pin - 712101</p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Contacts
                </h5>
                <p class="mbr-text">
                    Email: support@eicds.gov.in<br>Phone: +1 (0) 000 0000 001
                    <br>Fax: +1 (0) 000 0000 002
                </p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Links
                </h5>
                <p class="mbr-text"><a href="http://india.gov.in">india.gov.in</a><br><a href="http://mygov.in" target="_blank">mygov.in</a><br><a href="http://nic.in">nic.in</a></p>
            </div>
        </div>
        <div class="footer-lower">
            <div class="media-container-row">
                <div class="col-sm-12">
                    <hr>
                </div>
            </div>
            <div class="media-container-row mbr-white">
                <div class="col-sm-6 copyright">
                    <p class="mbr-text mbr-fonts-style display-7">
                        © Copyright 2017 National Inormatics Centre - All Rights Reserved
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="social-list align-right">
                        <div class="soc-item">
                            <a href="https://twitter.com/mobirise" target="_blank">
                                <span class="socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="https://www.facebook.com/pages/Mobirise/1616226671953247" target="_blank">
                                <span class="socicon-facebook socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="https://www.youtube.com/c/mobirise" target="_blank">
                                <span class="socicon-youtube socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="https://instagram.com/mobirise" target="_blank">
                                <span class="socicon-instagram socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <script src="{{asset('mobirise/web/assets/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('mobirise/popper/popper.min.js')}}"></script>
  <script src="{{asset('mobirise/tether/tether.min.js')}}"></script>
  <script src="{{asset('mobirise/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('mobirise/dropdown/js/script.min.js')}}"></script>
  <script src="{{asset('mobirise/viewportchecker/jquery.viewportchecker.js')}}"></script>
  <script src="{{asset('mobirise/parallax/jarallax.min.js')}}"></script>
  <script src="{{asset('mobirise/smoothscroll/smooth-scroll.js')}}"></script>
  <script src="{{asset('mobirise/touchswipe/jquery.touch-swipe.min.js')}}"></script>
  <script src="{{asset('mobirise/theme/js/script.js')}}"></script>
  <script src="{{asset('mobirise/formoid/formoid.min.js')}}"></script>


 <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i></i></a></div>
    <input name="animation" type="hidden">
  </body>
</html>

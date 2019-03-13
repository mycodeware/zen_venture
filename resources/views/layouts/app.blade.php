<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    @if (env('APP_ENV') == 'production')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130785732-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-130785732-1');
        </script>
    @elseif (env('APP_ENV') == 'staging')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130785732-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-130785732-2');
        </script>

    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,shrink-to-fit=no">

    <!-- Localization -->
    @if (!is_null(\Request::route()) AND \Request::route()->hasParameter('locale'))
        @foreach (config('languages') as $lang => $language)
            <link rel="alternate" hreflang="{{ $lang }}" href="{{ route(Request::route()->getName(), ['locale' => $lang]) }}" />
        @endforeach
    @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if (isset($title)){{ $title }}@else{{ config('app.name') }}@endif</title>
    <meta name="description" content="@if (isset($description)){{ __($description) }}@else{{ __(config('app.description')) }}@endif">
    <meta name="keywords" content="@if (isset($keywords)){{ __($keywords) }}@else{{ __(config('app.keywords')) }}@endif">
    <meta name="norton-safeweb-site-verification" content="wvkrrrbyfs98pfkwsbgcyv-37qqzr1i0vdgvhdg3oxs25u-kmjgqctjbaazqledoxml-pfhh0ez9k2dnn1j806vcxxz056ys0r65002f8z5gvw373c5a5ybjc1b38rvh" />

    <!-- OGP -->
    @if (isset($ogp) && is_array($ogp))
        @foreach ($ogp as $meta)
            <meta
                @if(isset($meta['property']))
                    property="{{ $meta['property'] }}"
                @endif
                @if(isset($meta['name']))
                    name="{{ $meta['name'] }}"
                @endif
                @if(isset($meta['content']))
                    content="{{ $meta['content'] }}"
                @endif
              />
        @endforeach
    @endif

    <!-- Scripts -->
    @php 
    $segment =  Request::segment(2) ;
    if($segment != 'faq')
    {
    @endphp
    @php
    }
    else{
        
    }
    @endphp
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


  <link rel="stylesheet" href="{{ url('css/app.css') }}">
<?php /*
  <link rel="stylesheet" href="{{ url('css/bootsnav.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.min.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ url('css/animate.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ url('css/owl.carousel.min.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
*/?>
    @if (isset($recaptcha) && $recaptcha === true)
        <script src='https://www.google.com/recaptcha/api.js?render={{ env("GRECAPTCHA_SITE_KEY") }}'></script>
    @endif
</head>
<body class="d-flex flex-column h-100">
    <div id="app" class="flex-shrink-0">
         <!-- Start Navigation -->

 <header>

  <div class="container top-container">

  <div class="top_hdr" id="custom-header">

                  <div class="row">

                    <div class="col-md-9 col-sm-9">

                      <div class="tp_hdr">

                        <ul>
                           
                          
                          <li><i class="fa fa-globe" aria-hidden="true"></i> <span class="dis_none">Language: 

                            <a href="#" class="active">{{ config('languages')[app()->getLocale()] }}</a>
                            @foreach (config('languages') as $lang => $language)
                                @if ($lang != app()->getLocale())
                                    @if (!is_null(\Request::route()) AND \Request::route()->hasParameter('locale'))
                                        <a class="dropdown-item" href="{{ route(Request::route()->getName(), ['locale' => $lang]) }}">{{ $language }}</a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">{{ $language }}</a>
                                    @endif
                                @endif
                            @endforeach
                            

                          <li><i class="fa fa-envelope" aria-hidden="true"></i> <span class="dis_none">zenventures@andafrica.co.jp</span></li>

                          <li><i class="fa fa-phone" aria-hidden="true"></i> <span class="dis_none">+81-36868-4986</span></li>

                        </ul>

                      </div>

                    </div>

                    <div class="col-md-3 col-sm-3">

                      <div class="tp_social text-right">

                        <ul>

                          <li><a href="#"><img src="{{ url('img/iconmonstr-twitter-4-24.png') }}"></a></li>

                          <li><a href="#"><img src="{{ url('img/iconmonstr-linkedin-4-24.png') }}"></a></li>

                          <li><a href="#"><img src="{{ url('img/insta.png') }}"></a></li>

                          <li><a href="#"><img src="{{ url('img/iconmonstr-facebook-4-24.png') }}"></a></li>

                        </ul>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

    <nav class="navbar navbar-default navbar-fixed white no-background bootsnav">

            <div class="container">

              

              <div class="main_wrpr" id="nav-custom">
              <div class="row">

            <div class="col-md-5">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">

                    <i class="fa fa-bars"></i>

                </button>

                <a class="navbar-brand" href="{{ route('welcome', app()->getLocale()) }}">

                    <img src="{{ url('img/logo.png') }}" class="logo" alt="" class="img-responsive">

                </a>

            </div>

            <!-- End Header Navigation -->



            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="col-md-7">
            <div class="collapse navbar-collapse" id="navbar-menu">

                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">

                    <!-- <li><a href="{{ route('welcome', app()->getLocale()) }}">Home</a></li> -->

                    <li><a href="{{ route('static.aboutus', app()->getLocale()) }}">{{ __('About Us') }}</a></li>

                    <li><a href="{{ route('event.index', app()->getLocale()) }}">{{ __('Events') }}</a></li>

                    <!--<li><a href="#">FAQ</a></li>-->

                    <li><a href="{{ route('inquiry.index', app()->getLocale()) }}">{{ __('Contact Us') }}</a></li>
                    @guest
                    <li><a href="{{ route('login') }}">{{ __('Log In') }}</a></li>

                    <ul class="jn_us">

                      <li><a href="{{ route('register') }}">Join Us</a></li>

                    </ul>
                    @else
                    <li><a class="nav-link" href="{{ route('dashboard.index') }}">{{ __('My Page') }}</a></li>
                    <li><a class="nav-link" href="{{ route('match.index') }}">{{ __('Match Making') }}</a></li>
                    @endguest

                    @guest
                    @else
                    <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </li>
                            <!-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Account') }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-header">{{ Auth::user()->email }}</div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li> -->
                        @endguest
                </ul>

            </div><!-- /.navbar-collapse -->
            
            </div>
            </div>
          </div>

        </div>   

    </nav>

  </header>
 

        <main class="mb-3">
            @yield('content')
        </main>

    </div>
    
    
    <footer>

    <div class="container">

      <div class="row">

        <div class="col-md-4">

          <div class="cpy_rgt">

          <p>And Africa Co.,Ltd &copy; {{ date('Y') }}</p>

        </div>

        </div>

        <div class="col-md-8">

          <div class="ftr_lst text-right">

            <ul>

              <li><a href="{{ route('static.terms', app()->getLocale()) }}">terms & conditions</a></li>

              <li><a href="{{ route('static.disclaimer', app()->getLocale()) }}">disclaimer</a></li>

              <li><a href="{{ route('static.privacy', app()->getLocale()) }}">privacy policy</a></li>

              <li><a href="{{ route('static.faq', app()->getLocale()) }}">faq</a></li>

              <li><a href="{{ route('inquiry.index', app()->getLocale()) }}">contact us</a></li>

              <li><a href="{{ route('static.aboutus', app()->getLocale()) }}">about us</a></li>

            </ul>

          </div>

        </div>

      </div>

    </div>

  </footer>

  <script src="{{ url('js/app.js') }}"></script>


  <script type="text/javascript">

    var $logo = $('#scroll_top');

    $(document).scroll(function() {

        if($(this).scrollTop()> 50)

        { 

         $('#nav-custom').css("margin-top", "0px");

        }else{

             $('#nav-custom').css("margin-top", "65px");

        }



    });

  </script>

  <script type="text/javascript">

    $('.owl-carousel').owlCarousel({

    loop:true,

    margin:0,

    nav:false,

    dots:false,

    autoplay:false,

    responsive:{

        0:{

            items:1

        },

        600:{

            items:1

        },

        1000:{

            items:1

        }

    }

})

  </script>

<script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.in").each(function(){
            $(this).siblings(".panel-heading").find(".glyphicon").addClass("glyphicon-minus").removeClass("glyphicon-plus");
            $(this).siblings(".panel-heading").find("a").toggleClass("active");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
            $(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
            $(this).siblings(".panel-heading").find("a").addClass("active");
        }).on('hide.bs.collapse', function(){
            $(this).parent().find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
            $(this).siblings(".panel-heading").find("a").removeClass("active");
        });
    });
</script>
</body>
</html>

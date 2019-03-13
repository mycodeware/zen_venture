@extends('layouts.app')

@section('content')
<div class="clearfix"></div>



    <!-- Start Home -->
  
  <section class="sub-header text-center" style="background-image:url({{ url('img/sh-about.jpg') }})">   
    <div class="container">
        
                    <span>COMPANY PROFILE</span>
                    <h3 class="text-capitalize">about us</h3>
    </div>

  </section>
  
<section class="about_outer">
    
    <div class="container">
        <div class="row">
            <div class="col-md-5"><img src="{{ url('img/creative-proccess.jpg') }}"></div>
            <div class="col-md-7">
                <div class="about_inner">
                    
                <h3 class="text-capitalize">{{ __('About ZenVentures') }}</h3>
                <img src="{{ url('img/main1.png') }}" alt="" class="comp_logo">
                <p>{!! __('ZenVentures is an online and offline entrepreneurship ecosystem created and managed by <a href="https://en.andafrica.co.jp/">And Africa Co., Ltd.</a>') !!} {{ __('We support all types of startups, investors, and professionals by providing a platform to connect, raise capital, find talent and be inspired.  Companies, investors, entrepreneurs or job seekers can register to our platform to connect with each other in a curated ecosystem that ensures safety, reliability and support.') }} </p>
               
                </div>
            </div>
        </div>
                    
    </div>

  </section>
  <section class="bg-counter-h1">
                <div class="container">
                    <div class="row">
                        <div class="bnr_blk_otr">

      <div class="row">

        <div class="col-sm-4">

          <div class="bnr-block_frst">

            <div class="mbr-blk">

              <div class="mbr-img">

                <img src="{{ url('img/icon-3.png') }}">

              </div>

              <div class="mbr-cont">

                <h3>50,236</h3>

                <p>Total Registration</p>

              </div>

            </div>

          </div>

        </div>

        <div class="col-sm-4">

          <div class="bnr-block_frst">

            <div class="mbr-blk">

              <div class="mbr-img">

                <img src="{{ url('img/icon-1.png') }}">

              </div>

              <div class="mbr-cont">

                <h3>50,236</h3>

                <p>Total Community</p>

              </div>

            </div>

          </div>

        </div>

        <div class="col-sm-4">

          <div class="bnr-block_frst">

            <div class="mbr-blk">

              <div class="mbr-img">

                <img src="{{ url('img/icon-2.png') }}">

              </div>

              <div class="mbr-cont">

                <h3>50,236</h3>

                <p>Total Matches Made</p>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>
                    </div>
                </div>
            </section>
  
  
    
    <section class="team_outer">
            <div class="container">
                <div class="row">
                    <div class="title_bar"><h2>{{ __('Meet the team') }}</h2></div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                    <div class="box">
                        <div class="image">
                            @php $file = 'img/yo.png' @endphp
                            <a><img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Yo Murofushi" class="img-fluid"></a>
                            <div class="social_icon">
                                <ul>
                                   
                                     <li><a href="https://www.linkedin.com/in/yo-murofushi-234615140/"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="https://www.facebook.com/yo.murofushi.1"><i class="fa fa-facebook"></i></a></li>
                                </ul>
                            </div>
                        </div>
                                                    
                        <div class="info">
                            <h5><a href="#"> {{ __('Yo Murofushi') }}</a>  </h5>
                            <p>Founder & CEO </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="box">
                        <div class="image">
                            @php $file = '/img/buntu.png' @endphp                            
                            <a ><img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Buntu Majaja" class="img-fluid"></a>
                            <div class="social_icon">
                                <!--<ul>
                                   
                                     <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                </ul>-->
                            </div>
                        </div>
                        <div class="info">
                            <h5><a href="#">{{ __('Buntu Majaja') }}</a></h5>
                            <p>Executive </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="box">
                        <div class="image">
                            @php $file = '/img/nicolas.png' @endphp                        
                            <a href="#"><img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Nicolas du Bois" class="img-fluid"></a>
                            <div class="social_icon">
                                <ul>                                   
                                     <li><a href="https://www.linkedin.com/in/nicolas-du-bois-41aaa325/"><i class="fa fa-linkedin"></i></a></li>                                    
                                </ul>
                            </div>
                        </div>
                        <div class="info">
                            <h5><a href="#">{{ __('Nicolas du Bois') }}</a></h5>
                            <p>Executive </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="box">
                        <div class="image">
                        @php $file = '/img/masa.png' @endphp                        
                            <a><img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Masa Tanaka" class="img-fluid"></a>
                            <div class="social_icon">
                                <ul>
                                   <!--
                                     <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>-->
                                </ul>
                            </div>
                        </div>
                        <div class="info">
                            <h5><a href="#">{{ __('Masa Tanaka') }}</a></h5>
                            <p>Executive </p>
                        </div>
                    </div>
                </div>
                
                
                </div>
            </div>
    </section>
    
    <section class="about_outer">
    
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="about_inner">
                <h3 class="text-capitalize">{{ __('About And Africa') }}</h3>
                <img src="{{ url('img/yoko_c.png') }}" class="comp_logo">
                <p>{{ __('And Africa is a consulting and investment advisory firm located in Tokyo, Japan with a branch office in South Africa.  Our vision is to be a bridge between Japan, other developed nations, and African countries. Japan has knowledge, technology and capital, but a declining population and stagnating economy. African countries are dynamic and growing rapidly, but lack jobs, technology and capital. We aim to match the needs of both regions to create sustainable and innovative partnerships.') }} </p>
                <p>{{ __('And also to create exponential growth opportunities for Japanese companies, investors.') }}</p>
                <p>{{ __('And our mission is to promote industrialization and job creation in Africa.') }}</p>
                 
                </div>
            </div>
            <div class="col-md-7"><img src="{{ url('img/about.jpg') }}" class="mar_t30"></div>
            
        </div>
                    
    </div>

  </section>
  <section class="about_outer2">
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="about_inner2">
                    <img src="{{ url('img/about2.png') }}">
                    <ul>
                        <li>{{ __('Industrialization, and contribute to job creation in Africa') }}</li>
                        <li>{{ __('Development of efficient African start-up ecosystem') }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="about_inner2">
                    <img src="{{ url('img/about3.png') }}">
                    <ul>
                        <li>{{ __('Create exponential growth opportunities') }}</li>
                        <li>{{ __('Develop innovative partnerships') }}</li>
                    </ul>
                </div>
            </div>
            
            
        </div>
                    
    </div>

  </section>    
<!--<div class="container-fluid bg-white">
    <div class="px-3 px-md-5 py-3 py-md-5">
        <div class="lead my-3">{{ __('About Us') }}</div>
        <div class="mb-5 pt-3">
            <div class="h3 mb-0">{{ __('About ZenVentures') }}</div>
            <img src="{{ asset('/img/zenventures_logo_h.png') }}" alt="ZenVentures" class="img-fluid w-50 mw-300px mt-1 mb-3 mx-auto d-block">
            <p>
                {!! __('ZenVentures is an online and offline entrepreneurship ecosystem created and managed by <a href="https://en.andafrica.co.jp/">And Africa Co., Ltd.</a>') !!}
                {{ __('We support all types of startups, investors, and professionals by providing a platform to connect, raise capital, find talent and be inspired.  Companies, investors, entrepreneurs or job seekers can register to our platform to connect with each other in a curated ecosystem that ensures safety, reliability and support.') }}
            </p>
            <div class="h5 my-4 lead">{{ __('Meet the team') }}</div>
            <ul class="list-unstyled">
                <h5 class="mt-0 mb-1 ml-1">{{ __('Yo Murofushi') }}</h5>
                <li class="media mb-4">
                    <div class="w-25 mw-175px pr-3 mt-1">
                        @php $file = '/img/yo.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Yo Murofushi" class="w-100 rounded">
                        <div class="h3 text-center mt-2">
                            <a href="https://www.facebook.com/yo.murofushi.1" class="text-dark"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.linkedin.com/in/yo-murofushi-234615140/" class="text-dark"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="media-body">
                        <div>{{ __('Founder & CEO of And Africa Co., Ltd. He focuses on creation of African startup eco-system. He really like to communicate and support African young entrepreneurs in terms of fundraising, client acquisition, mentoring, business skill transfer, etc.') }}</div>
                        <div>{{ __('He used to work at major consulting firm like Deloitte for 5 years, and found his first company exporting secondhand car from Japan to Africa. And then, found And Africa to enhance African young leaders.') }}</div>
                    </div>
                </li>
                <h5 class="mt-0 mb-1 ml-1">{{ __('Buntu Majaja') }}</h5>
                <li class="media mb-4">
                    <div class="w-25 mw-175px pr-3 mt-1">
                        @php $file = '/img/buntu.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Buntu Majaja" class="w-100 rounded">
                    </div>
                    <div class="media-body">
                        <div>{{ __('Executive: Building the African entrepreneurship ecosystem one city at a time. Graduated from Pretoria University (Chemical Engineering), Gordon Institute of Business Science (Post-Graduate Business Administration), Wits Business School (Entrepreneurship and New Venture Creation Masters). He worked with AT Kearney and RIIS in strategy and innovation advisory. He then founded " DUYO " to support African entrepreneurs. Working on developing local entrepreneurship ecosystems throughout Africa based in South Africa.') }}</div>
                    </div>
                </li>
                <h5 class="mt-0 mb-1 ml-1">{{ __('Nicolas du Bois') }}</h5>
                <li class="media mb-4">
                    <div class="w-25 mw-175px pr-3 mt-1">
                        @php $file = '/img/nicolas.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Nicolas du Bois" class="w-100 rounded">
                        <div class="h3 text-center mt-2">
                            <a href="https://www.linkedin.com/in/nicolas-du-bois-41aaa325/" class="text-dark"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="media-body">
                        <div>{{ __('Executive: Driving investments into emerging markets. Graduated from University of Cape Town (Political Economics), Oxford University Graduate School (Economics). He worked with PwC in Cape Town before joining the Japan Exchange and Teaching Program (JET). He’s recent work was in commercial legal advisory with Davis Polk & Wardwell.') }}</div>
                    </div>
                </li>
                <h5 class="mt-0 mb-1 ml-1">{{ __('Masa Tanaka') }}</h5>
                <li class="media mb-4">
                    <div class="w-25 mw-175px pr-3 mt-1">
                        @php $file = '/img/masa.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Masa Tanaka" class="w-100 rounded">
                    </div>
                    <div class="media-body">
                        <div>{{ __('Executive: Developing business solutions in emerging markets. Graduated from Soka University (Business Administration) . Worked in merging market like Thailand over an exchange. There after joined SAP supporting sales before joining analytics and intelligence department focusing on non-manufacturing and medium sized market') }}</div>
                    </div>
                </li>
            </ul>
            <address>
                <strong>{{ __('Contact') }}</strong><br>
                <span class="mr-2"><i class="fas fa-directions"></i></span>{{ __('Headquarters :  6-11-13 Kamirenjaku, Mitaka-City, Tokyo, Japan 181-0012') }}<br>
                <span class="mr-2"><i class="fas fa-directions"></i></span>{{ __('South Africa Branch :  625 Mias Str. Garsfontein, Pretoria, South Africa') }}<br>
                <span class="mr-2"><i class="fas fa-envelope"></i></span>{{ __('E-mail : ') }}<a href="mailto:zenventures&#64;andafrica.co.jp">zenventures&#64;andafrica.co.jp</a><br>
                <span class="mr-2"><i class="fas fa-phone"></i></span>{{ __('Phone (Japan) :  ') }}<a href="tel:+81-36868-4986">+81-36868-4986</a><br>
                <span class="mr-2"><i class="fas fa-phone"></i></span>{{ __('Phone (South Africa) : ') }}<a href="tel:+27-83-384-6879">+27-83-384-6879</a><br>
            </address>
        </div>
        <div class="mb-5 pt-3">
            <div class="h3 mb-0">{{ __('About And Africa') }}</div>
            <img src="{{ asset('/img/andafrica_logo_h.png') }}" alt="And Africa" class="img-fluid w-50 mw-300px mt-1 mb-3 mx-auto d-block">
            <p>{{ __('And Africa is a consulting and investment advisory firm located in Tokyo, Japan with a branch office in South Africa.  Our vision is to be a bridge between Japan, other developed nations, and African countries. Japan has knowledge, technology and capital, but a declining population and stagnating economy. African countries are dynamic and growing rapidly, but lack jobs, technology and capital. We aim to match the needs of both regions to create sustainable and innovative partnerships.') }}</p>
            <div class="pt-2 pb-3">
                <img src="{{ asset('/img/OUR_VISION_And_Africa.png') }}" alt="Our Vision" class="img-fluid w-75 mt-1 mb-3 mx-auto d-block">
            </div>
            <p>{{ __('And our mission is to promote industrialization and job creation in Africa.') }}</p>
            <p>{{ __('And also to create exponential growth opportunities for Japanese companies, investors.') }}</p>
            <div class="py-3">
                <img src="{{ asset('/img/OUR_MISSION_And_Africa.png') }}" alt="Our Mission" class="img-fluid w-75 mt-1 mb-3 mx-auto d-block">
                <div class="row">
                    <div class="col-6 mb-4 px-2">
                        <div class="card border-0 h-100">
                            <div class="card-body text-left border px-3 py-3">
                                <ul class="list-square pl-3 pl-sm-4">
                                    <li>{{ __('Industrialization, and contribute to job creation in Africa') }}</li>
                                    <li>{{ __('Development of efficient African start-up ecosystem') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4 px-2">
                        <div class="card border-0 h-100">
                            <div class="card-body text-left border px-3 py-3">
                                <ul class="list-square pl-3 pl-sm-4">
                                    <li>{{ __('Create exponential growth opportunities') }}</li>
                                    <li>{{ __('Develop innovative partnerships') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <address>
                <strong>{{ __('Web') }}</strong><br>
                <span class="mr-2"><i class="fas fa-globe"></i></span>{{ __('English :  ') }}<a href="https://en.andafrica.co.jp/">https://en.andafrica.co.jp/</a><br>
                <span class="mr-2"><i class="fas fa-globe"></i></span>{{ __('Japanese :  ') }}<a href="https://andafrica.co.jp/">https://andafrica.co.jp/</a><br>
                <div class="h3">
                    <a href="https://www.facebook.com/andafrica.co.ltd/" class="text-dark"><i class="fab fa-facebook"></i></a>
                </div>
            </address>
        </div>
    </div>
</div>-->
@endsection

@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>



    <!-- Start Home -->

  <section class="tp_banner">

    <div class="owl-carousel owl-theme">

    <div class="item">

      <div class="tp_banner_img">

      <img src="{{ url('img/slider1.jpg') }}">

      </div>

      <div class="container sldr-txt">

      <div class="row">

        <div class="col-md-12">

          <div class="banner-text text-center">

            <h1>Match Making Platform for African Startups</h1>

            <a href="#" class="strt-now">Start Now</a>
 <p>ZenVentures is an online entrepreneurship ecosystem where you can find investors and business partners from Africa to the world and Japan</p>
          </div>

        </div>

      </div>

    </div>

    </div>

    <div class="item">

      <div class="tp_banner_img">

      <img src="{{ url('img/slider2.jpg') }}">

    </div>

      <div class="container sldr-txt">

      <div class="row">

        <div class="col-md-12">

          <div class="banner-text text-center">

            <h1>Connecting African Startups to Opportunities</h1>

            <a href="#" class="strt-now">Start Now</a>
 <p>ZenVentures is an online entrepreneurship ecosystem where you can find investors and business partners from Africa to the world and Japan</p>
          </div>

        </div>

      </div>

    </div>

    </div>

    <div class="item">

      <div class="tp_banner_img">

      <img src="{{ url('img/slider3.jpg') }}">

      </div>

      <div class="container sldr-txt">

      <div class="row">

        <div class="col-md-12">

          <div class="banner-text text-center">

            <h1 style="width: 90%;margin: 0 auto;">Finding business partners and creating market access in Africa </h1>

            <a href="#" class="strt-now">Start Now</a>
             <p>ZenVentures is an online entrepreneurship ecosystem where you can find investors and business partners from Africa to the world and Japan</p>

          </div>

        </div>

      </div>

    </div>

    </div>

  </div>

  </section>

  <section class="bnr-block">

    <div class="container">

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

      <div class="wht_brngs text-center">

        <h3>{{ __('What Brings You Here ?') }} {{ __('if you are...') }}</h3>

       

        <div class="Wht-brngs">

          <div class="row">

            <div class="col-md-12">
                @php $file = '/img/ecosystem.png' @endphp
              <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Startup" class="img-responsive">

            </div>

          </div>

        </div>

      </div>

      <div class="strtup">

        <div class="row">

          <div class="col-md-3 col-sm-6">

            <div class="strtup_blk">

              <div class="strp_img">
                @php $file = '/img/startup_africa.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" class="img-responsive">

              </div>

              <div class="strtp_cnt">

                <h6>{{ __('Startup / Entrepreneur') }}<br> {{ __('in Africa') }}</h6>

                <ul>

                <li>{{ __('Fundraising') }}</li>
                <li>{{ __('Client Acquisition') }}</li>
                <li>{{ __('HR Acquisition') }}</li>
                <li>{{ __('Business Alliance') }}</li>
                <li>{{ __('M&A(Exit)') }}</li>
                <li>{{ __('Finding Mentor') }}</li>

                </ul>

              </div>

            </div>

          </div>

          <div class="col-md-3 col-sm-6">

            <div class="strtup_blk">

              <div class="strp_img">
                @php $file = '/img/investor_developed_countries.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Startup" class="img-responsive">

              </div>

              <div class="strtp_cnt">

                <h6>{{ __('ANGEL INVESTOR / VC / CVC / PE') }}ANGEL INVESTOR / VC / CVC / PE<br> {{ __('in developed countries') }}</h6>

                <ul>

                <li>{{ __('Invest in African Startups with Promising Futures') }}</li>
                <li>{{ __('M&A') }}</li>
                <li>{{ __('Information Collection') }}</li>
                <li>{{ __('Business Alliance') }}</li>

                </ul>

              </div>

            </div>

          </div>

          <div class="col-md-3 col-sm-6">

            <div class="strtup_blk">

              <div class="strp_img">
                @php $file = '/img/company_africa_japan.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Startup" class="img-responsive">

              </div>

              <div class="strtp_cnt">
                <h6>{{ __('LARGE SCALE COMPANY / SME') }}<br> {{ __('in Africa and Japan') }}</h6>

                <ul>

                    <li>{{ __('Sales Channel Development') }}</li>
                    <li>{{ __('Client Acquisition') }}</li>
                    <li>{{ __('HR Acquisition') }}</li>
                    <li>{{ __('Fundraising') }}</li>
                    <li>{{ __('M&A(Exit)') }}</li>
                    <li>{{ __('Information Collection') }}</li>

                </ul>

              </div>

            </div>

          </div>

          <div class="col-md-3 col-sm-6">

            <div class="strtup_blk">

              <div class="strp_img">

                @php $file = '/img/professional_africa.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Startup" class="img-responsive">

              </div>

              <div class="strtp_cnt">
                
                <h6>{{ __('PROFESSIONAL / FREELANCER') }}<br> {{ __('in Africa') }}</h6>

                <ul>

                   <li>{{ __('Job Hunting') }}</li>
                   <li>{{ __('Client Acquisition (Inc. Finding Single Shot Work)') }}</li>

                </ul>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

  <section class="wrks">

    <div class="container">

      <div class="row">

        <div class="col-md-12">

          <div class="wrks-head text-center">

            <h2>{{ __("How It Works") }}</h2>

            <p>{{ __("In three simple steps ZenVentures provides a way to be matched with a potential partner that meets your needs and then you can get in touch with them directly") }}</p>

          </div>

        </div>

      </div>

      <div class="wrk_stp">

        <div class="col-md-4 col-sm-4">

          <div class="step_frst text-center">

            <div class="stp_cir">

              @php $file = '/img/howtouse_1.png' @endphp
              <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="SIGN UP">

              <span class="count">01</span>

            </div>

            <div class="stp_txt">

              <p>Register Account</p>

            </div>

          </div>

        </div>

        <div class="col-md-4 col-sm-4">

          <div class="step_frst text-center">

            <div class="stp_cir">

                @php $file = '/img/howtouse_2.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="FILL OUT YOUR PROFILE">

              <span class="count">02</span>

            </div>

            <div class="stp_txt">

              <p>Find Partner</p>

            </div>

          </div>

        </div>

        <div class="col-md-4 col-sm-4">

          <div class="step_frst text-center">

            <div class="stp_cir">

                @php $file = '/img/howtouse_3.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="MOVE TO MATCH MAKING">

              <span class="count">03</span>

            </div>

            <div class="stp_txt">

              <p>Contact Partner</p>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

  <section class="why_Zen">

    <div class="container">

      <div class="row">

        <div class="col-md-12">

          <div class="wrks-head text-center">

            <h2>{{ __('Why ZenVentures ?') }}</h2>

          </div>

        </div>

      </div>

      <div class="why_blks">

        <div class="row">

          <div class="col-md-4 col-sm-4">

            <div class="why_blks_wrpr">

              <div class="why_blks_frst">

              <div class="why_blks_frst_img">

                <img src="{{ url('img/step1.jpg') }}">

              </div>

              <div class="why_blks_frst_cont">

                <p>{{ __('All in one Platform') }}</p>

              </div>

            </div>

            <div class="why_blks_frst_desc">

              <p>{{ __('You can get various opportunities like Fundraising, Client Acquisition, HR Acquisition, etc. here. And you can make use of our coworking space as well.') }}</p>

            </div>

            </div>

          </div>

          <div class="col-md-4 col-sm-4">

            <div class="why_blks_wrpr">

              <div class="why_blks_frst">

              <div class="why_blks_frst_img">

                <img src="{{ url('img/step2.jpg') }}">

              </div>

              <div class="why_blks_frst_cont">

                <p>{{ __('Contact registered users directly') }}</p>

              </div>

            </div>

            <div class="why_blks_frst_desc">

              <p>{{ __('You can contact other users directly through e-mail.') }}</p>

            </div>

            </div>

          </div>

          <div class="col-md-4 col-sm-4">

            <div class="why_blks_wrpr">

              <div class="why_blks_frst">

              <div class="why_blks_frst_img">

                <img src="{{ url('img/step3.jpg') }}">

              </div>

              <div class="why_blks_frst_cont">

                <p>{{ __('Highly Secured') }}</p>

              </div>

            </div>

            <div class="why_blks_frst_desc">

              <p>{{ __('Proof of identity required, Real Name Only.') }}</p>

            </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

  <section class="prtnr">

    <div class="container">

      <div class="row">

        <div class="col-md-6 col-sm-5">

          <div class="prtnr_desc">

            <h2>{{ __('Some of Our Partners') }}</h2>

          </div>

        </div>

        <div class="col-md-6 col-sm-7">

          <div class="prtnr-img">

            <ul>

              <li><img src="{{ url('img/prtnr1.png') }}"></li>

              <li><img src="{{ url('img/prtnr2.png') }}"></li>

              <li><img src="{{ url('img/prtnr3.png') }}"></li>

            </ul>

          </div>

        </div>

      </div>

    </div>

  </section>

  <section class="featured">

    <div class="container">

      <div class="feat_otr">

      <div class="row">
      <div class="featured_frst">

            <h3>{{ __('Featured Startups') }}</h3>

          </div>
          <div class="row">

        @foreach ($entrepreneurs as $entrepreneur)
        @php
            $filename = ($entrepreneur->image_filename)? 'storage/profile/'.$entrepreneur->image_filename: 'img/no_image.png';
        @endphp
        <div class="col-md-4 col-sm-4">
            @guest
            <a data-toggle="modal" href="#login-signup-modal">
            @else
            <a href="{{ route('match.show', ['name' => $entrepreneur->user->name]) }}">
            @endguest

            <div class="feat_bx_wrpr">

             

                    <div class="feat_bx_wrpr_inner ">
                  <div class="col-md-4">

                    <img src="{{ asset($filename) }}" class="img-responsive">

                  </div>
                  <div class="col-md-8">

                    <h6>Name : {{ $entrepreneur->company_name }}</h6>
                    <h6>Country : {{ country($entrepreneur->country_code)->getName()}}</h6>
                    <h6>Round :
                        @if (!is_null($entrepreneur->investment_round))
                            {{ App\User::INVESTMENT_ROUNDS[$entrepreneur->investment_round] }}
                        @endif
                    </h6>
                    <h6>Purpose :</h6>
                    <ul class="pl-4">
                        @foreach ($entrepreneur->purposes as $purpose)
                            <li><h6>{{ App\User::PURPOSES[$purpose->purpose_id] }}</h6></li>
                        @endforeach
                    </ul>

                  </div>
                  </div>
<div class=" row">
                  <div class="col-md-12">
                    <div class="more_detail">
                        <a href="#">{{ __('More Details') }}</a>
                    </div>

                  </div>


          </div>

        </div>
        
        
        </a>
        </div>
        @endforeach
        

      </div>

    </div>
    </div>
    
    <div class="feat_otr">

      <div class="row">
      <div class="featured_frst">

            <h3>{{ __('Featured Companies') }}</h3>

          </div>
        
          <div class="row">
            @foreach ($companies as $company)
        @php
            $filename = ($company->image_filename)? 'storage/profile/'.$company->image_filename: 'img/no_image.png';
        @endphp
        <div class="col-md-4 col-sm-4">
            @guest
            <a data-toggle="modal" href="#login-signup-modal">
            @else
            <a href="{{ route('match.show', ['name' => $company->user->name]) }}">
            @endguest

            <div class="feat_bx_wrpr">

             

                    <div class="feat_bx_wrpr_inner ">
                  <div class="col-md-4">

                    <img src="{{ asset($filename) }}" class="img-responsive">

                  </div>
                  <div class="col-md-8">

                   <h6>Name : {{ $company->company_name }}</h6>
                    <h6>Country : {{ country($company->country_code)->getName()}}</h6>
                    <h6>Purpose :</h6>
                    <ul class="pl-4">
                        @foreach ($company->purposes as $purpose)
                            <li><h6>{{ App\User::PURPOSES[$purpose->purpose_id] }}</h6></li>
                        @endforeach
                    </ul>
                    

                  </div>
                  </div>
<div class=" row">
                  <div class="col-md-12">
                    <div class="more_detail">
                        <a href="#">{{ __('More Details') }}</a>
                    </div>

                  </div>


          </div>

        </div>
        
        
        </a>
        </div>
        @endforeach
       

      </div>

    </div>

    <div class="feat_otr">

      <div class="row">
      <div class="featured_frst">

            <h3>{{ __('Featured Investors') }}</h3>

          </div>
          
          <div class="row">
            @foreach ($investors as $investor)
        @php
            $filename = ($investor->image_filename)? 'storage/profile/'.$investor->image_filename: 'img/no_image.png';
        @endphp
        <div class="col-md-4 col-sm-4">
            @guest
            <a data-toggle="modal" href="#login-signup-modal">
            @else
            <a href="{{ route('match.show', ['name' => $investor->user->name]) }}">
            @endguest

            <div class="feat_bx_wrpr">

             

                    <div class="feat_bx_wrpr_inner ">
                  <div class="col-md-4">

                    <img src="{{ asset($filename) }}" class="img-responsive">

                  </div>
                  <div class="col-md-8">

                   <h6>Name : {{ $investor->company_name }}</h6>
                    <h6>Country : {{ country($investor->country_code)->getName()}}</h6>
                    <h6>Target Round :</h6>
                    <h6>
                        @if (!is_null($investor->round_start))
                            {{ App\User::INVESTMENT_ROUNDS[$investor->round_start] }}
                        @endif
                        {{ __(' ~ ') }}
                        @if (!is_null($investor->round_end))
                            {{ App\User::INVESTMENT_ROUNDS[$investor->round_end] }}
                        @endif
                    </h6>
                    <h6>Investment Scale :</h6>
                    <h6>
                        @if (!is_null($investor->scale_start))
                            {{ App\User::INVESTMENT_RANGE[$investor->scale_start] }}
                        @endif
                        {{ __(' ~ ') }}
                        @if (!is_null($investor->scale_start))
                            {{ App\User::INVESTMENT_RANGE[$investor->scale_end] }}
                        @endif
                    </h6>

                  </div>
                  </div>
<div class=" row">
                  <div class="col-md-12">
                    <div class="more_detail">
                        <a href="#">{{ __('More Details') }}</a>
                    </div>

                  </div>


          </div>

        </div>
        
        
        </a>
        </div>
         @endforeach

      </div>

    </div>
    </div>

    
    
    
    
    
    <div class="feat_otr">

      <div class="row">
      <div class="featured_frst">

            <h3>{{ __('Featured Professionals') }}</h3>

          </div>

          
          <div class="row">
            @foreach ($freelancers as $freelancer)
        @php
            $filename = ($freelancer->image_filename)? 'storage/profile/'.$freelancer->image_filename: 'img/no_image.png';
        @endphp
        <div class="col-md-4 col-sm-4">
            @guest
            <a data-toggle="modal" href="#login-signup-modal">
            @else
            <a href="{{ route('match.show', ['name' => $freelancer->user->name]) }}">
            @endguest

            <div class="feat_bx_wrpr">

             

                    <div class="feat_bx_wrpr_inner ">
                  <div class="col-md-4">

                    <img src="{{ asset($filename) }}" class="img-responsive">

                  </div>
                  <div class="col-md-8">

                    <h6>Country : {{ country($freelancer->country_code)->getName()}}</h6>
                    <h6>Profession :
                        @if (isset($freelancer->profession_name))
                            {{ $freelancer->profession_name }}
                        @endif
                    </h6>
                    <h6 class="mb-0">Qualification : </h6>
                    <h6 class="ml-2">{!! nl2br(e($freelancer->qualification)) !!}</h6>
                    </h6>
                    <h6>Purpose :</h6>
                    <ul class="pl-4">
                        @foreach ($freelancer->purposes as $purpose)
                            <li><h6>{{ App\User::PURPOSES[$purpose->purpose_id] }}</h6></li>
                        @endforeach
                    </ul>

                  </div>
                  </div>
<div class=" row">
                  <div class="col-md-12">
                    <div class="more_detail">
                        <a href="#">More Detail</a>
                    </div>

                  </div>


          </div>

        </div>
        
        
        </a>
        </div>
        @endforeach
        
        
       

      </div>

    </div>
    </div>
    
    
</div>
    

    </div>

  </section>

  <section class="cases">

    <div class="container">

      <div class="row">

        <div class="col-md-12">

          <div class="wrks-head text-center">

            <h2>{{ __('Match Making Cases') }}</h2>

            <p>“{{ __('There is more than one way to Zen a Venture”. What at opportunities are you looking for and which match making case is the right deal for you?') }}</p>

          </div>

        </div>

      </div>

      <div class="case_blk">

        <div class="row">

          <div class="col-sm-6">

            <div class="case_frst">

              <div class="case_blk_otr">

              <div class="case_head text-center">

              <h4>{{ __('Match Making Case 1') }}</h4>

            </div>

            <div class="case_frst_img">
            @php $file = '/img/match_making_1.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="match making" class="img-responsive">

            </div>

           </div>

             <div class="abt_case">

               <div class="row">

                 <div class="col-sm-6 col-xs-6">

                   <div class="abt_case_desc strtp_cnt">

                     <h5>{{ __('We can get opportunities for .....') }}</h5>

                     <ul>

                       <li>{{ __('Fundraising') }}</li>
                        <li>{{ __('Mentoring') }}</li>

                     </ul>

                   </div>

                 </div>

                 <div class="col-sm-6 col-xs-6">

                   <div class="abt_case_desc strtp_cnt tri-right">

                     <h5>{{ __('We can get opportunities for .....') }}</h5>

                     <ul>

                      <li>{{ __('Investment') }}</li>
                       <li>{{ __('Information Collection') }}</li>

                     </ul>

                   </div>

                 </div>

               </div>

             </div>

            </div>

          </div>

          <div class="col-sm-6">

            <div class="case_frst">

              <div class="case_blk_otr">

              <div class="case_head text-center">

              <h4>{{ __('Match Making Case 2') }}</h4>

            </div>

            <div class="case_frst_img">

              @php $file = '/img/match_making_2.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="match making" class="img-responsive">

            </div>

           </div>

             <div class="abt_case">

               <div class="row">

                 <div class="col-sm-6 col-xs-6">

                   <div class="abt_case_desc strtp_cnt">

                     <h5>{{ __('We can get opportunities for .....') }}</h5>

                     <ul>

                       <li>{{ __('HR Acquisition') }}</li>


                     </ul>

                   </div>

                 </div>

                 <div class="col-sm-6 col-xs-6">

                   <div class="abt_case_desc strtp_cnt tri-right">

                     <h5>{{ __('We can get opportunities for .....') }}</h5>

                     <ul>

                       <li>{{ __('Job Hunting') }}</li>


                     </ul>

                   </div>

                 </div>

               </div>

             </div>

            </div>

          </div>

        </div>

      </div><!-- end of case block -->

      <div class="case_blk">

        <div class="row">

          <div class="col-sm-6">

            <div class="case_frst">

              <div class="case_blk_otr">

              <div class="case_head text-center">

              <h4>{{ __('Match Making Case 3') }}</h4>

            </div>

            <div class="case_frst_img">

              @php $file = '/img/match_making_3.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="match making" class="img-responsive">

            </div>

           </div>

             <div class="abt_case">

               <div class="row">
 
                 <div class="col-sm-6 col-xs-6">

                   <div class="abt_case_desc strtp_cnt">

                     <h5>{{ __('We can get opportunities for .....') }}</h5>

                     <ul>

                       <li>{{ __('Sales Channel Development') }}</li>
                        <li>{{ __('M&A') }}</li>
                        <li>{{ __('Client Acquisition') }}</li>
                        <li>{{ __('Business Alliance') }}</li>

                     </ul>

                   </div>

                 </div>

                 <div class="col-sm-6 col-xs-6">

                   <div class="abt_case_desc strtp_cnt tri-right">

                     <h5>{{ __('We can get opportunities for .....') }}</h5>

                     <ul>

                       <li>{{ __('Client Acquisition') }}</li>
                       <li>{{ __('Business Alliance') }}</li>
                     </ul>

                   </div>

                 </div>

               </div>

             </div>

            </div>

          </div>

          <div class="col-sm-6">

            <div class="case_frst">

              <div class="case_blk_otr">

              <div class="case_head text-center">

              <h4>{{ __('Match Making Case 4') }}</h4>

            </div>

            <div class="case_frst_img">

              @php $file = '/img/match_making_4.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="match making" class="img-responsive">

            </div>

           </div>

             <div class="abt_case">

               <div class="row">

                 <div class="col-sm-6 col-xs-6">

                   <div class="abt_case_desc strtp_cnt">

                     <h5>{{ __('We can get opportunities for .....') }}</h5>

                     <ul>

                       <li>{{ __('Business Alliance') }}</li>
                        <li>{{ __('Fundraising') }}</li>
                        <li>{{ __('Client Acquisition') }}</li>

                     </ul>

                   </div>

                 </div>

                 <div class="col-sm-6 col-xs-6">

                   <div class="abt_case_desc strtp_cnt tri-right">

                     <h5>{{ __('We can get opportunities for .....') }}</h5>

                     <ul>

                       <li>{{ __('Business Alliance') }}</li>
                        <li>{{ __('Investment') }}</li>
                        <li>{{ __('Information Collection') }}</li>

                     </ul>

                   </div>

                 </div>

               </div>

             </div>

            </div>

          </div>

        </div>

      </div><!-- end of case block -->

    </div>

  </section>

  <section class="whts_nw">

    <div class="container">

      <div class="row">

        <div class="col-md-12">

          <div class="wrks-head text-center">

            <h2>{{ __("WHAT'S NEW ?") }}</h2>

          </div>

        </div>

      </div>
      
      <div id="posts">
        <post-component></post-component>
      </div>
      
      <!-- <div class="whts_nw_wrpr whts_nw_wrpr2">

          <div class="row">

            <div class="col-md-6 col-sm-6">

              <div class="dt_txt">

                <span>10th January, 2019</span>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

              </div>

              </div>

              <div class="col-md-6 col-sm-6">

              <div class="dt_txt">

                <span>10th January, 2019</span>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

              </div>

              </div>

            </div>

        </div>

        <div class="mr_pst text-center">

          <div class="row">

            <div class="col-sm-6 col-xs-6 text-left">

          <a href="#">Older Posts</a>

        </div>

            <div class="col-sm-6 col-xs-6 text-right">

          <a href="#">Newer Posts</a>

        </div>

        </div>

        </div> -->

      </div>

    </div>

  </section>
@endsection

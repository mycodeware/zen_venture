@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center text-center">
        <div class="alert alert-warning" role="alert">
            <h4>{{ __('Beta version - You can use for free from Dec., 2018 to the end of Feb., 2019 !') }}</h4>
        </div>
    </div>
    <div class="row justify-content-center text-center my-5">
        <h2>{{ __('HERE IS THE AFRICAN STARTUP ECOSYSTEM') }}</h2>
    </div>
    <div class="row bg-white py-4 my-4">
        <div class="col-12">
            @php $file = '/img/ecosystem.png' @endphp
            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="ecosystem" class="img-fluid">
        </div>
    </div>
    <div class="row justify-content-center my-4">
        <div class="col-12 text-center">
            <h3>{{ __('WHAT BRINGS YOU HERE ?') }}</h3>
        </div>
        <div class="col-12 text-center">
            <h3>{{ __('IF YOU ARE...') }}</h3>
        </div>
    </div>
    <div class="row justify-content-center text-center bg-white py-4">
        <div class="col-6 col-sm-6 col-md-3 mb-4 px-2">
            <div class="card border-0 h-100">
                <div class="card-img-top">
                    <div class="my-3">
                        @php $file = '/img/startup_africa.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Startup" class="w-100">
                    </div>
                    <h6>{{ __('STARTUP / ENTREPRENEUR') }}</h6>
                    <h6>{{ __('in Africa') }}</h6>
                </div>
                <div class="card-body text-left border px-3 py-3">
                    <ul class="pl-3 pl-sm-4">
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
        <div class="col-6 col-sm-6 col-md-3 mb-4 px-2">
            <div class="card border-0 h-100">
                <div class="card-img-top">
                    <div class="my-3">
                        @php $file = '/img/investor_developed_countries.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Startup" class="w-100">
                    </div>
                    <h6>{{ __('ANGEL INVESTOR / VC / CVC / PE') }}</h6>
                    <h6>{{ __('in developed countries') }}</h6>
                </div>
                <div class="card-body text-left border px-3 py-3">
                    <ul class="pl-3 pl-sm-4">
                        <li>{{ __('Invest in African Startups with Promising Futures') }}</li>
                        <li>{{ __('M&A') }}</li>
                        <li>{{ __('Information Collection') }}</li>
                        <li>{{ __('Business Alliance') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-3 mb-4 px-2">
            <div class="card border-0 h-100">
                <div class="card-img-top">
                    <div class="my-3">
                        @php $file = '/img/company_africa_japan.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Startup" class="w-100">
                    </div>
                    <h6>{{ __('LARGE SCALE COMPANY / SME') }}</h6>
                    <h6>{{ __('in Africa and Japan') }}</h6>
                </div>
                <div class="card-body text-left border px-3 py-3">
                    <ul class="pl-3 pl-sm-4">
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
        <div class="col-6 col-sm-6 col-md-3 mb-4 px-2">
            <div class="card border-0 h-100">
                <div class="card-img-top">
                    <div class="my-3">
                        @php $file = '/img/professional_africa.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Startup" class="w-100">
                    </div>
                    <h6>{{ __('PROFESSIONAL / FREELANCER') }}</h6>
                    <h6>{{ __('in Africa') }}</h6>
                </div>
                <div class="card-body text-left border px-3 py-3">
                    <ul class="pl-3 pl-sm-4">
                        <li>{{ __('Job Hunting') }}</li>
                        <li>{{ __('Client Acquisition (Inc. Finding Single Shot Work)') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center text-center bg-white pb-4">
        <div class="col-12 col-sm-6 col-md-3 mb-5">
            @guest
                @if (Route::has('register'))
                    <a class="btn btn-success btn-lg btn-block" href="{{ route('register') }}">{{ __('SIGN UP') }}</a>
                @endif
            @else
                @if (Route::has('match.index'))
                    <a class="btn btn-site-color btn-lg btn-block" href="{{ route('match.index') }}">{{ __('MATCH MAKING') }}</a>
                @endif
            @endif
        </div>
    </div>
    <div class="row justify-content-center text-center align-items-center py-2">
        <h3 class="my-4">{{ __("HOW TO USE") }}</h3>
    </div>
    <div class="row bg-white pb-5 pt-3">
        <div class="col-lg-4 col-md-12 pr-lg-4 mb-4">
            <div class="card h-100 px-2 py-2">
                <div class="card-img-top">
                    <div class="h6 text-left">{{ __('1. SIGN UP') }}</div>
                </div>
                <div class="card-body h-100 px-2 py-2">
                    <div class="d-flex align-items-center h-100">
                        @php $file = '/img/howtouse_1.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="SIGN UP" class="img-fluid w-100">
                    </div>
                </div>
                <div class="after-arrow d-lg-block d-none"></div>
            </div>
        </div>
        <div class="col-6 offset-3 mb-4 d-lg-none">
            @php $file = '/img/arrow_down.png' @endphp
            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Arrow" class="img-fluid w-100">
        </div>
        <div class="col-lg-4 col-md-12 pr-lg-4 pl-lg-0 mb-4">
            <div class="card h-100 px-2 py-2">
                <div class="card-img-top">
                    <div class="h6 text-left">{{ __('2. FILL OUT YOUR PROFILE') }}</div>
                </div>
                <div class="card-body h-100 px-2 py-2">
                    <div class="d-flex align-items-center h-100">
                        @php $file = '/img/howtouse_2.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="FILL OUT YOUR PROFILE" class="img-fluid w-100">
                    </div>
                </div>
                <div class="after-arrow d-lg-block d-none"></div>
            </div>
        </div>
        <div class="col-6 offset-3 mb-4 d-lg-none">
            @php $file = '/img/arrow_down.png' @endphp
            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Arrow" class="img-fluid w-100">
        </div>
        <div class="col-lg-4 col-md-12 pr-lg-5 pl-lg-0 mb-4">
            <div class="card h-100 px-2 py-2">
                <div class="card-img-top">
                    <div class="h6 text-left">{{ __('3. MOVE TO “MATCH MAKING”') }}</div>
                </div>
                <div class="card-body h-100 px-2 py-2">
                    <div class="d-flex align-items-center h-100">
                        @php $file = '/img/howtouse_3.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="MOVE TO MATCH MAKING" class="img-fluid w-100">
                    </div>
                </div>
                <div class="after-arrow d-lg-block d-none"></div>
            </div>
        </div>
        <div class="col-6 offset-3 mb-4 d-lg-none">
            @php $file = '/img/arrow_down.png' @endphp
            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Arrow" class="img-fluid w-100">
        </div>
        <div class="col-lg-8 col-md-12 pr-lg-4 mb-4">
            <div class="card h-100 px-2 py-2">
                <div class="card-img-top">
                    <div class="h6 text-left">{{ __('4. CHECK THE LIST OF YOUR POTENTIAL PARTNERS*') }}</div>
                </div>
                <div class="card-body h-100 px-2 py-2">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 pr-lg-4">
                            <div class="d-flex align-items-center h-100 position-relative">
                                @php $file = '/img/howtouse_4_1.png' @endphp
                                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="CHECK THE LIST OF YOUR POTENTIAL PARTNERS" class="img-fluid w-100">
                                <div class="after-arrow d-lg-block d-none"></div>
                            </div>
                        </div>
                        <div class="col-6 offset-3 my-4 d-lg-none">
                            @php $file = '/img/arrow_down.png' @endphp
                            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Arrow" class="img-fluid w-100">
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="d-flex align-items-center h-100">
                                @php $file = '/img/howtouse_4_2.png' @endphp
                                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="CHECK THE LIST OF YOUR POTENTIAL PARTNERS" class="img-fluid w-100">
                            </div>
                        </div>
                    </div>
                    <div><small>{{ __('* : Startup / Investor / Company / Professional') }}</small></div>
                </div>
                <div class="after-arrow d-lg-block d-none"></div>
            </div>
        </div>
        <div class="col-6 offset-3 mb-4 d-lg-none">
            @php $file = '/img/arrow_down.png' @endphp
            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Arrow" class="img-fluid w-100">
        </div>
        <div class="col-lg-4 col-md-12 pr-lg-5 pl-lg-0 mb-4">
            <div class="card h-100 px-2 py-2">
                <div class="card-img-top">
                    <div class="h6 text-left">{{ __('5. CHECK THE DETAILS') }}</div>
                </div>
                <div class="card-body h-100 px-2 py-2">
                    <div class="d-flex align-items-center h-100">
                        @php $file = '/img/howtouse_5.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="CHECK THE DETAILS" class="img-fluid w-100">
                    </div>
                </div>
                <div class="after-arrow d-lg-block d-none"></div>
            </div>
        </div>
        <div class="col-6 offset-3 mb-4 d-lg-none">
            @php $file = '/img/arrow_down.png' @endphp
            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Arrow" class="img-fluid w-100">
        </div>
        <div class="col-lg-6 col-md-12 pr-lg-4 mb-4">
            <div class="card h-100 px-2 py-2">
                <div class="card-img-top">
                    <div class="h6 text-left">{{ __('6. CONTACT REQUEST TO GET THE CONTACT INFORMATION AND FURTHER INFORMATION') }}</div>
                </div>
                <div class="card-body h-100 px-2 py-2">
                    <div class="d-flex align-items-center h-100">
                        @php $file = '/img/howtouse_6.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="CONTACT REQUEST TO GET THE CONTACT INFORMATION AND FURTHER INFORMATION" class="img-fluid w-100">
                    </div>
                </div>
                <div class="after-arrow d-lg-block d-none"></div>
            </div>
        </div>
        <div class="col-6 offset-3 mb-4 d-lg-none">
            @php $file = '/img/arrow_down.png' @endphp
            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Arrow" class="img-fluid w-100">
        </div>
        <div class="col-lg-6 col-md-12 pr-lg-4 pl-lg-0 mb-4">
            <div class="card h-100 px-2 py-2">
                <div class="card-img-top">
                    <div class="h6 text-left">{{ __('7. CONTACT (ZenVentures will confirm first)') }}</div>
                </div>
                <div class="card-body h-100 px-2 py-2">
                    <div class="d-flex align-items-center h-100">
                        @php $file = '/img/howtouse_7.png' @endphp
                        <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="CONTACT (ZenVentures will confirm first)" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 offset-lg-5 col-6 offset-3 mt-3">
            @php $file = '/img/arrow_down.png' @endphp
            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Arrow" class="img-fluid w-100">
        </div>
        <div class="col-lg-2 offset-lg-5 col-4 offset-4 mt-3">
            @php $file = '/img/shakehands.png' @endphp
            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Shake hands" class="img-fluid w-100">
        </div>
        <div class="col-12 my-3 text-center">
            <div class="h4">{{ __('CREATE SOLID RELATIONSHIP') }}</div>
            <div>{{ __('(If you receive the request from another, ZenVentures will send e-mail to you to confirm your intention)') }}</div>
        </div>
    </div>
    @if (is_array($trusted) && count($trusted) > 0)
    <div class="row justify-content-center text-center align-items-center bg-white py-5">
        <div class="col-11 border py-3">
            <h4 class="partners-title position-absolute px-2 bg-white"><strong>{{ __('Some of our partners') }}</strong></h4>
            <div class="row justify-content-center align-items-center">
                @foreach ($trusted as $logo)
                <div class="col-12 col-sm-6 col-md-4 my-4">
                    <img class="img-fluid trusted-logo" src="{{ asset('storage/profile/'.$logo) }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center border-top border-bottom text-center" id="posts">
        <div class="col-12 mb-4 px-lg-5">
            <h3 class="my-4">{{ __("WHAT'S NEW ?") }}</h3>
            <post-component></post-component>
        </div>
    </div>
    <div class="row py-4 pt-5 bg-white">
        <div class="col-12 pt-3 pt-sm-5">
            <div class="match-making mx-0 mx-sm-3">
                <h4 class="match-making-title position-absolute px-2 bg-white"><strong>{{ __('MATCH MAKING CASE 1') }}</strong></h4>
                @php $file = '/img/match_making_1.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="match making" class="img-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="popover bs-popover-bottom popover-static popover-static-left show mx-1 mx-sm-3 my-1 my-sm-3">
                            <div class="arrow"></div>
                            <div class="popover-body px-sm-3 py-sm-3">
                                <h6>{{ __('We can get opportunities for .....') }}</h6>
                                <ul class="pl-0 pl-3 mb-0">
                                    <li>{{ __('Fundraising') }}</li>
                                    <li>{{ __('Mentoring') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="popover bs-popover-bottom popover-static popover-static-right show mx-1 mx-sm-3 my-1 my-sm-3">
                            <div class="arrow"></div>
                            <div class="popover-body px-sm-3 py-sm-3">
                                <h6>{{ __('We can get opportunities for .....') }}</h6>
                                <ul class="pl-0 pl-3 mb-0">
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
    <div class="row py-3 bg-white">
        <div class="col-12 pt-3 pt-sm-5">
            <div class="match-making mx-0 mx-sm-3">
                <h4 class="match-making-title position-absolute px-2 bg-white"><strong>{{ __('MATCH MAKING CASE 2') }}</strong></h4>
                @php $file = '/img/match_making_2.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="match making" class="img-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="popover bs-popover-bottom popover-static popover-static-left show mx-1 mx-sm-3 my-1 my-sm-3">
                            <div class="arrow"></div>
                            <div class="popover-body px-sm-3 py-sm-3">
                                <h6>{{ __('We can get opportunities for .....') }}</h6>
                                <ul class="pl-0 pl-3 mb-0">
                                    <li>{{ __('HR Acquisition') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="popover bs-popover-bottom popover-static popover-static-right show mx-1 mx-sm-3 my-1 my-sm-3">
                            <div class="arrow"></div>
                            <div class="popover-body px-sm-3 py-sm-3">
                                <h6>{{ __('We can get opportunities for .....') }}</h6>
                                <ul class="pl-0 pl-3 mb-0">
                                    <li>{{ __('Job Hunting') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row py-3 bg-white">
        <div class="col-12 pt-3 pt-sm-5">
            <div class="match-making mx-0 mx-sm-3">
                <h4 class="match-making-title position-absolute px-2 bg-white"><strong>{{ __('MATCH MAKING CASE 3') }}</strong></h4>
                @php $file = '/img/match_making_3.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="match making" class="img-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="popover bs-popover-bottom popover-static popover-static-left show mx-1 mx-sm-3 my-1 my-sm-3">
                            <div class="arrow"></div>
                            <div class="popover-body px-sm-3 py-sm-3">
                                <h6>{{ __('We can get opportunities for .....') }}</h6>
                                <ul class="pl-0 pl-3 mb-0">
                                    <li>{{ __('Sales Channel Development') }}</li>
                                    <li>{{ __('M&A') }}</li>
                                    <li>{{ __('Client Acquisition') }}</li>
                                    <li>{{ __('Business Alliance') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="popover bs-popover-bottom popover-static popover-static-right show mx-1 mx-sm-3 my-1 my-sm-3">
                            <div class="arrow"></div>
                            <div class="popover-body px-sm-3 py-sm-3">
                                <h6>{{ __('We can get opportunities for .....') }}</h6>
                                <ul class="pl-0 pl-3 mb-0">
                                    <li>{{ __('Client Acquisition') }}</li>
                                    <li>{{ __('Business Alliance') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row py-3 bg-white">
        <div class="col-12 pt-3 pt-sm-5">
            <div class="match-making mx-0 mx-sm-3">
                <h4 class="match-making-title position-absolute px-2 bg-white"><strong>{{ __('MATCH MAKING CASE 4') }}</strong></h4>
                @php $file = '/img/match_making_4.png' @endphp
                <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="match making" class="img-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="popover bs-popover-bottom popover-static popover-static-left show mx-1 mx-sm-3 my-1 my-sm-3">
                            <div class="arrow"></div>
                            <div class="popover-body px-sm-3 py-sm-3">
                                <h6>{{ __('We can get opportunities for .....') }}</h6>
                                <ul class="pl-0 pl-3 mb-0">
                                    <li>{{ __('Business Alliance') }}</li>
                                    <li>{{ __('Fundraising') }}</li>
                                    <li>{{ __('Client Acquisition') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="popover bs-popover-bottom popover-static popover-static-right show mx-1 mx-sm-3 my-1 my-sm-3">
                            <div class="arrow"></div>
                            <div class="popover-body px-sm-3 py-sm-3">
                                <h6>{{ __('We can get opportunities for .....') }}</h6>
                                <ul class="pl-0 pl-3 mb-0">
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
    <div class="row justify-content-center py-4 pt-5 bg-white">
        <div class="col-12 text-center mb-3 mb-md-4">
            <h3>{{ __('FEATURED STARTUPS') }}</h3>
        </div>
        @foreach ($entrepreneurs as $entrepreneur)
        @php
            $filename = ($entrepreneur->image_filename)? 'storage/profile/'.$entrepreneur->image_filename: 'img/no_image.png';
        @endphp
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 mb-2 featured">
            @guest
            <a data-toggle="modal" href="#login-signup-modal">
            @else
            <a href="{{ route('match.show', ['name' => $entrepreneur->user->name]) }}">
            @endguest
                <div class="card h-100">
                    <div class="card-body">
                        <div class="media">
                            <img class="featured-logo image-fluid mr-3" src="{{ asset($filename) }}">
                            <div class="media-body">
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
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-light">{{ __('More Details') }}</button>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="row justify-content-center py-4 bg-white">
        <div class="col-12 text-center mb-3 mb-md-4">
            <h3>{{ __('FEATURED INVESTORS') }}</h3>
        </div>
        @foreach ($investors as $investor)
        @php
            $filename = ($investor->image_filename)? 'storage/profile/'.$investor->image_filename: 'img/no_image.png';
        @endphp
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 mb-2 featured">
            @guest
            <a data-toggle="modal" href="#login-signup-modal">
            @else
            <a href="{{ route('match.show', ['name' => $investor->user->name]) }}">
            @endguest
                <div class="card h-100">
                    <div class="card-body">
                        <div class="media">
                            <img class="featured-logo image-fluid mr-3" src="{{ asset($filename) }}">
                            <div class="media-body">
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
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-light">{{ __('More Details') }}</button>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="row justify-content-center py-4 bg-white">
        <div class="col-12 text-center mb-3 mb-md-4">
            <h3>{{ __('FEATURED COMPANIES') }}</h3>
        </div>
        @foreach ($companies as $company)
        @php
            $filename = ($company->image_filename)? 'storage/profile/'.$company->image_filename: 'img/no_image.png';
        @endphp
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 mb-2 featured">
            @guest
            <a data-toggle="modal" href="#login-signup-modal">
            @else
            <a href="{{ route('match.show', ['name' => $company->user->name]) }}">
            @endguest
                <div class="card h-100">
                    <div class="card-body">
                        <div class="media">
                            <img class="featured-logo image-fluid mr-3" src="{{ asset($filename) }}">
                            <div class="media-body">
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
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-light">{{ __('More Details') }}</button>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="row justify-content-center py-4 bg-white">
        <div class="col-12 text-center mb-3 mb-md-4">
            <h3>{{ __('FEATURED PROFESSIONALS') }}</h3>
        </div>
        @foreach ($freelancers as $freelancer)
        @php
            $filename = ($freelancer->image_filename)? 'storage/profile/'.$freelancer->image_filename: 'img/no_image.png';
        @endphp
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 mb-2 featured">
            @guest
            <a data-toggle="modal" href="#login-signup-modal">
            @else
            <a href="{{ route('match.show', ['name' => $freelancer->user->name]) }}">
            @endguest
                <div class="card h-100">
                    <div class="card-body">
                        <div class="media">
                            <img class="featured-logo image-fluid mr-3" src="{{ asset($filename) }}">
                            <div class="media-body">
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
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-light">{{ __('More Details') }}</button>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="row justify-content-center mt-5 mb-3">
        <div class="col-12 text-center mb-5">
            <h3>{{ __('Why ZenVentures ?') }}</h3>
        </div>
        <div class="col-12 text-center">
            <ol class="list-unstyled d-inline-block text-left">
                <li class="h2">{{ __('1. All in one platform') }}</li>
                <li class="h2">{{ __('2. Contact registered users directly') }}</li>
                <li class="h2">{{ __('3. Highly Secured') }}</li>
            </ol>
        </div>
    </div>
    <div class="row justify-content-center text-center bg-white px-1 px-sm-3 py-4">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 my-4">
            <div class="card border-0 h-100 mx-3 mx-sm-2">
                <div class="card-body border">
                    <div class="position-absolute rounded-circle icon-lg-pos-0 icon-lg bg-site-color"><img src="{{ asset('/img/settings_white.png') }}"></div>
                    <h3 class="py-3"><u>{{ __('1. All in one platform') }}</u></h3>
                    <h5>{{ __('You can get various opportunities like Fundraising, Client Acquisition, HR Acquisition, etc. here. And you can make use of our coworking space as well.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 my-4">
            <div class="card border-0 h-100 mx-3 mx-sm-2">
                <div class="card-body border">
                    <div class="position-absolute rounded-circle icon-lg-pos-0 icon-lg bg-site-color"><img src="{{ asset('/img/mail_white.png') }}"></div>
                    <h3 class="py-3"><u>{{ __('2. Contact registered users directly') }}</u></h3>
                    <h5>{{ __('You can contact other users directly through e-mail.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 my-4">
          <div class="card border-0 h-100 mx-3 mx-sm-2">
              <div class="card-body border">
                  <div class="position-absolute rounded-circle icon-lg-pos-0 icon-lg bg-site-color"><img src="{{ asset('/img/lock_white.png') }}"></div>
                  <h3 class="py-3"><u>{{ __('3. Highly Secured') }}</u></h3>
                  <h5>{{ __('Proof of identity required, Real Name Only.') }}</h5>
              </div>
          </div>
        </div>
    </div>
    @component('components.login_signup')
    @endcomponent
</div>
@endsection

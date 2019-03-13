@extends('layouts.app')

@section('content')
<div class="clearfix"></div>
    <!-- Start Home -->
  <section class="sub-header text-center" style="background-image:url({{ url('img/sh-about.jpg') }})">
    <div class="container">
        <h3 class="text-capitalize">Matches</h3>
    </div>
  </section>
<section class="s_dashboard_wrapper">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="alert alert-warning" role="alert">
                <h5>{{ __('Beta version - You can use for free from Dec., 2018 to the end of Feb., 2019 !') }}</h5>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">{{ __('Match Making') }}</div> -->
                    <div class="card-body">
                        <div class="top_text">
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><h5>{{ __('I AM / WE ARE') }}</h5></div>
                                <div class="col-md-7 col-xs-12">
                                    <div class="border-bottom border-dark pr-2">
                                        <h5><strong>{{ App\User::TYPES[$type]['display'] }}</strong>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="top_text_2">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                 <h5>{{ __('LOOKING FOR OPPORTUNITIES FOR') }}</h5>
                                </div>
                                <div class="col-md-7 col-xs-12">
                                    <ol>
                                    @foreach ($purposes as $purpose)
                                        <li class="h5 pl-3 border-bottom border-dark mb-4"><strong>{{ App\User::PURPOSES[$purpose->purpose_id] }}</strong></h5>
                                    @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="full_width_dv">
                            <div class="need_text"><h5>{{ __('SO YOU MAY NEED .....') }}</h5></div>
                        </div>
                        <div id="matches">
                            <matched-list-component :ini-params="{{ json_encode($ini_params) }}" :types="{{ json_encode($selectable_types) }}" :type-ths="{{ json_encode($type_theads) }}" :countries="{{ json_encode($countries) }}" :investment-rounds="{{ json_encode(App\User::INVESTMENT_ROUNDS) }}" :professions="{{ json_encode(App\User::PROFESSIONS) }}" :types-purposes="{{ json_encode($types_purposes) }}" :identified="{{ json_encode(App\User::IDENTIFY_IDENTIFIED) }}"></matched-list-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

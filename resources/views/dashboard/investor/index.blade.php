@extends('layouts.app')
@section('content')
<div class="clearfix"></div>
    <!-- Start Home -->
  <section class="sub-header text-center" style="background-image:url({{ url('img/sh-about.jpg') }})">   
    <div class="container">
        <h3 class="text-capitalize">Dashboard</h3>
    </div>
  </section>
<section class="about_outer s_dashboard_wrapper">
    <div class="container">
        <!-- <div class="row justify-content-center text-center">
            <div class="alert alert-warning" role="alert">
                <h5>{{ __('Beta version - You can use for free from Dec., 2018 to the end of Feb., 2019 !') }}</h5>
            </div>
        </div> -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="pb-3 active_text">
                            @if ($investor->user_all->status == App\User::STATUS_ACTIVE)
                                <span class="h4 mx-2 align-bottom">{{ __('Current Status : ') }}{{ __('Active') }}</span>
                                <a href="{{ route('dashboard.deactivate') }}" class="btn btn-outline-secondary btn-sm" role="button">{{ __('Deactivate') }}</a>
                            @else
                                <span class="h4 mx-2 align-bottom">{{ __('Current Status : ') }}{{ __('Inactive') }}</span>
                                <a href="{{ route('dashboard.activate') }}" class="btn btn-outline-success btn-sm" role="button">{{ __('Activate') }}</a>
                            @endif
                        </div>
                        <div class="row">
                            <div class="top_text">
                                <div class="col-md-5 col-xs-12"><h5>{{ __('I AM / WE ARE') }}</h5></div>
                                <div class="col-md-7 col-xs-12">
                                    <div class="border-bottom border-dark pr-2">
                                        <h5><strong>{{ App\User::TYPES[$investor->user_all->type]['display'] }}</strong></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="top_text_2">
                                <div class="col-md-5 col-xs-12"><h5>{{ __('LOOKING FOR OPPORTUNITIES FOR') }}</h5>
                                </div>
                                <div class="col-md-7 col-xs-12">
                                    <ol>
                                    @foreach ($investor->purposes as $purpose)
                                        <li class="h5 pl-3 border-bottom border-dark mb-4"><strong>{{ App\User::PURPOSES[$purpose->purpose_id] }}</strong></li>
                                    @endforeach
                                    </ol>
                                </div>
                                <div class="col-md-12 clearfix">
                                    <div class="edit float-right">
                                        <a href="{{ url('dashboard/edit') }}" class="btn btn-primary btn-sm">
                                            {{ __('Edit') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile_head_dv">
                            <div class="profile_dv"><h4 class="mb-0">{{ __('YOUR PROFILE') }}</h4>
                            </div>
                            @if (isset($completion))
                            <div class="submission_text"><span class="border border-3 px-2 py-2">{{ __('PROFILE COMPLETION : ') }}{{ $completion }}&#x25;</span>
                            </div>
                            @endif
                        </div>
                        <div class="profile_upload_form">
                            <form action="{{ url('dashboard/upload') }}" method="post" enctype="multipart/form-data" onChange="if(typeof jQuery != 'undefined') $('#form-image').submit();" id="form-image">
                                @csrf
                                @method('POST')
                                @php
                                    $filename = ($investor->image_filename)? 'storage/profile/'.$investor->image_filename: 'img/no_image.png';
                                @endphp
                                <h3>{{ __('Your Picture / Company Logo') }}</h3>
                                <div class="media">
                                    <div class="media_center">
                                        <div class="media_thumb">
                                            <img src="{{ asset($filename) }}" alt="logo" class="align-self-center mr-3 w-25 img-thumbnail"/>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <label class="upload_lable">
                                                <input type="file" name="image" class="form-control-file{{ $errors->any() ? ' is-invalid' : '' }}">
                                                <span class="upload_btn">Upload image</span>
                                            </label>
                                            @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $error }}</strong>
                                                    </span>
                                                @endforeach
                                            @endif
                                            <div>{{ __('Max size is 5 MB.') }}</div>
                                            <div>{{ __('Only JPEG and PNG files are allowed') }}</div>
                                        </div>
                                    </div>
                                </div>
                                @if ($investor->image_filename)
                                    <a class="btn btn-danger btn-sm" href="{{ url('dashboard/deleteImage') }}" role="button">{{ __('Remove Picture') }}</a>
                                @endif
                            </form>
                        </div>
                        <div class="dashboard_table table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                  <td>{{ __('First Name') }}</td>
                                  <td>{{ $investor->first_name }}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Family Name') }}</td>
                                  <td>{{ $investor->family_name }}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Country') }}</td>
                                  <td>{{ $investor->country_name }}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Atdress') }}</td>
                                  <td>{{ $investor->atdress }}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Company / Association, etc. (If not belong : “Independent”)') }}</td>
                                  <td>{{ $investor->company_name }}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Website') }}</td>
                                  <td>{{ $investor->website }}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Investment Policy') }}</td>
                                  <td>{!! nl2br(e($investor->investment_policy)) !!}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Business Area of Investment') }}</td>
                                  <td>{!! nl2br(e($investor->business_area)) !!}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Round of Targeted Startup') }}</td>
                                  <td>{{ $investor->round_start_name }}{{ __(' ~ ') }}{{ $investor->round_end_name }}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Investment Scale') }}</td>
                                  <td>{{ $investor->scale_start_name }}{{ __(' ~ ') }}{{ $investor->scale_end_name }}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Investment Track Record So Far') }}</td>
                                  <td>{!! nl2br(e($investor->track_record)) !!}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Have you invested in through “ZenVentures” ? ') }}</td>
                                  <td>
                                  @if (!is_null($investor->has_invested))
                                    {{ $investor->has_invested? __('Yes'): __('No') }}
                                  @endif
                                  </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              <div class="edit">
                                  <a href="{{ url('dashboard/edit') }}" class="btn btn-primary">
                                      {{ __('Edit') }}
                                  </a>
                              </div>
                            </div>
                        </div>
                        <hr>
                        <div class="identified_dv_btm">
                            @if ($investor->identified == App\User::IDENTIFY_IDENTIFIED)
                                <div><img src="{{ asset('/img/identified.png') }}" alt="identified" class="icon mr-2"/><span class="h4 align-bottom">{{ __('You are identified!') }}</span></div>
                                <a href="{{ route('dashboard.identify') }}">{{ __('See identity proof document.') }}</a>
                            @elseif ($investor->identified == App\User::IDENTIFY_REJECTED)
                                <h4>{{ __('You identity proof document is rejected by admin...') }}</h4>
                                <a href="{{ route('dashboard.identify') }}">{{ __('Submit another identity proof document.') }}</a>
                            @elseif ($investor->identified == App\User::IDENTIFY_PENDING)
                                <h4>{{ __('You identity proof document is pending...') }}</h4>
                                <a href="{{ route('dashboard.identify') }}">{{ __('See identity proof document still pending.') }}</a>
                            @else
                                <h4>{{ __('You are unidentified...') }}</h4>
                                <a href="{{ route('dashboard.identify') }}">{{ __('Submit identity proof document.') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
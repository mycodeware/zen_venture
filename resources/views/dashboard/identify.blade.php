@extends('layouts.app')

@section('content')
<div class="clearfix"></div>
    <!-- Start Home -->
  <section class="sub-header text-center" style="background-image:url({{ url('img/sh-about.jpg') }})">   
    <div class="container">
        <h3 class="text-capitalize">Identity Proof Document</h3>
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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('My Page') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Identity Proof Document') }}</li>
                </ol>
            </nav>
            <div class="card">
                <!-- <div class="card-header">Identity Proof Document</div> -->
                <div class="card-body identity_body">
                    <h3 class="identity_head">{{ __('Identity Proof Document') }}</h3>
                    @php
                        $filename = ($entity->identity_filename)? $entity->identity_filename: null;
                    @endphp
                    <div class="identity_subhead">
                        @if ($entity->identified == App\User::IDENTIFY_IDENTIFIED)
                            <p>{{ __('Your identity proof document is approved.') }}</p>
                        @elseif ($entity->identified == App\User::IDENTIFY_PENDING)
                            <p>{{ __('Your identity proof document is pending. Please wait for approval.') }}</p>
                        @elseif ($entity->identified == App\User::IDENTIFY_REJECTED)
                            <p>{{ __('Your identity proof document is rejected. Please re-submit another document.') }}</p>
                        @else
                            @if (!is_null($filename))
                                <p>{{ __('Your identity proof document has been submitted. Please wait for approval.') }}</p>
                            @else
                                <p>{{ __('Your identity proof document is Not yet submitted.') }}</p>
                            @endif
                        @endif
                        @if (!is_null($filename))
                            <a href="{{ route('identity.index', $filename) }}" target="_blank">{{ __('See your submitted identity proof document.') }}</a>
                        @endif
                    </div>
                    @if ($entity->identified != App\User::IDENTIFY_IDENTIFIED && $entity->identified != App\User::IDENTIFY_PENDING)
                        <div class="mt-3 s_identity_form">
                            <div class="identity_media">
                                <div class="identity_form_inr">
                                    <form action="{{ url('dashboard/uploadIdentity') }}" method="post" enctype="multipart/form-data" onChange="if(typeof jQuery != 'undefined') $('#form-identify').submit();" id="form-identify">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label class="input_label" for="form-identify-input">{{ __('Submit identity proof document') }}</label>
                                            <input type="file" name="identity" class="form-control-file{{ $errors->any() ? ' is-invalid' : '' }}" id="form-identify-input">
                                            @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $error }}</strong>
                                                    </span>
                                                @endforeach
                                            @endif
                                            <div class="text_dv">{{ __('Approvable document : ') }}</div>
                                            <ul class="mb-0">
                                                <li>{{ __('Passport') }}</li>
                                                <li>{{ __('ID card or ID book') }}</li>
                                                <li>{{ __('Driver\'s license') }}</li>
                                            </ul>
                                            <div class="text_dv">{{ __('Max size is 5 MB.') }}</div>
                                            <div class="text_dv">{{ __('Only JPEG, PNG and PDF files are allowed.') }}</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if (!is_null($entity->identity_filename))
                            <a class="btn btn-danger btn-sm" href="{{ url('dashboard/deleteIdentity') }}" role="button">{{ __('Remove Identity Proof Document') }}</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

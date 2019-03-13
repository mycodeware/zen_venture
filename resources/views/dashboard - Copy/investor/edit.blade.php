@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        @if (session('message_error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('message_error') }}
            </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="{{ url('dashboard') }}" method="post" id="form-edit">
                        @csrf
                        @method('POST')
                        @php
                            $purposes = !is_null(old('purposes'))? old('purposes'): $purposes;
                            $first_name = !is_null(old('first_name'))? old('first_name'): $investor->first_name;
                            $family_name = !is_null(old('family_name'))? old('family_name'): $investor->family_name;
                            $country_code = !is_null(old('country_code'))? old('country_code'): $investor->country_code;
                            $address = !is_null(old('address'))? old('address'): $investor->address;
                            $company_name = !is_null(old('company_name'))? old('company_name'): $investor->company_name;
                            $website = !is_null(old('website'))? old('website'): $investor->website;
                            $investment_policy = !is_null(old('investment_policy'))? old('investment_policy'): $investor->investment_policy;
                            $business_area = !is_null(old('business_area'))? old('business_area'): $investor->business_area;
                            $round_start = !is_null(old('round_start'))? old('round_start'): $investor->round_start;
                            $round_end = !is_null(old('round_end'))? old('round_end'): $investor->round_end;
                            $scale_start = !is_null(old('scale_start'))? old('scale_start'): $investor->scale_start;
                            $scale_end = !is_null(old('scale_end'))? old('scale_end'): $investor->scale_end;
                            $track_record = !is_null(old('track_record'))? old('track_record'): $investor->track_record;
                            $has_invested = !is_null(old('has_invested'))? old('has_invested'): $investor->has_invested;
                        @endphp
                        @if ($investor->exists)
                        <div class="form-group row">
                            <label for="purposes" class="col-md-10 offset-md-1 col-form-label text-md-left">{{ __('I AM / WE ARE LOOKING FOR OPPORTUNITIES FOR .....') }}</label>
                            <div class="col-md-10 offset-md-1">
                                @foreach (App\User::TYPES_PURPOSES[$type] as $purpose)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="purposes[]" value="{{ $purpose }}" {{ in_array($purpose, $purposes)? "checked":"" }}>
                                        <label class="form-check-label">{{ App\User::PURPOSES[$purpose] }}</label>
                                    </div>
                                @endforeach
                                <input class="form-control{{ $errors->has('purposes') ? ' is-invalid' : '' }}" type="hidden">
                                @if ($errors->has('purposes'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('purposes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="purpose" value="true">
                        @endif
                        <div class="row">
                            <div class="mx-3 my-3 px-2 py-2 bg-light">
                                <span class="text-success ml-2"><i class="fas fa-asterisk"></i></span>{{ __(' : REQUIRED') }}
                                <span class="text-warning ml-2"><i class="fas fa-star"></i></span>{{ __(' : EXPOSED') }}
                            </div>
                        </div>
                        <h3 class="mt-3"><strong>{{ __('PIC') }}</strong></h3>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first_name">{{ __('First Name') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $first_name }}" required @if ($investor->identified == App\User::IDENTIFY_IDENTIFIED) {{ 'readonly' }} @endif>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="family_name">{{ __('Family Name') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="family_name" type="text" class="form-control{{ $errors->has('family_name') ? ' is-invalid' : '' }}" name="family_name" value="{{ $family_name }}" required @if ($investor->identified == App\User::IDENTIFY_IDENTIFIED) {{ 'readonly' }} @endif>
                                @if ($errors->has('family_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if ($investor->identified == App\User::IDENTIFY_IDENTIFIED)
                                <div class="form-group col-12 form-text text-muted">{{ __('Not allowed to change Name after your identity proof document is approved.') }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="country_code">{{ __('Country') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <select id="country_code" class="form-control{{ $errors->has('country_code') ? ' is-invalid' : '' }}" name="country_code" required>
                                    @foreach ($countries as $key => $country)
                                        <option value="{{ $key }}" {{ $country_code == $key? "selected":"" }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if ($investor->exists)
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="address">{{ __('Address') }}</label>
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $address }}">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="company_name">{{ __('Company / Association, etc. (If not belong : “Independent”)') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ $company_name }}" required>
                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if ($investor->exists)
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="website">{{ __('Website') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ $website }}">
                                @if ($errors->has('website'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h3 class="mt-3"><strong>{{ __('Investment') }}</strong></h3>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="investment_policy">{{ __('Investment Policy (Less than 300 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="investment_policy" class="countable-text form-control{{ $errors->has('investment_policy') ? ' is-invalid' : '' }}" name="investment_policy" rows="8" data-max="300">{{ $investment_policy }}</textarea>
                                @if ($errors->has('investment_policy'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('investment_policy') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="business_area">{{ __('Business Area of Investment (Less than 100 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="business_area" class="countable-text form-control{{ $errors->has('business_area') ? ' is-invalid' : '' }}" name="business_area" rows="8" data-max="100">{{ $business_area }}</textarea>
                                @if ($errors->has('business_area'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('business_area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <label>{{ __('Round of Targeted Startup') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span>
                            <span>
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#investment-round-modal"><u>{{ __('Reference') }}</u></button>
                            </span>
                        </label>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <select id="round_start" class="form-control{{ $errors->has('round_start') ? ' is-invalid' : '' }}" name="round_start" required>
                                    @foreach (App\User::INVESTMENT_ROUNDS as $key => $round)
                                        <option value="{{ $key }}" {{ $round_start == $key? "selected":"" }}>{{ $round }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('round_start'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('round_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1 text-md-center">
                                {{ __(' ~ ') }}
                            </div>
                            <div class="form-group col-md-5">
                                <select id="round_end" class="form-control{{ $errors->has('round_end') ? ' is-invalid' : '' }}" name="round_end" required>
                                    @foreach (App\User::INVESTMENT_ROUNDS as $key => $round)
                                        <option value="{{ $key }}" {{ $round_end == $key? "selected":"" }}>{{ $round }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('round_end'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('round_end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <label>{{ __('Investment Scale') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <select id="scale_start" class="form-control{{ $errors->has('scale_start') ? ' is-invalid' : '' }}" name="scale_start" required>
                                    @foreach (App\User::INVESTMENT_RANGE as $key => $amount)
                                        <option value="{{ $key }}" {{ $scale_start == $key? "selected":"" }}>{{ $amount }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('scale_start'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('scale_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1 text-md-center">
                                {{ __(' ~ ') }}
                            </div>
                            <div class="form-group col-md-5">
                                <select id="scale_end" class="form-control{{ $errors->has('scale_end') ? ' is-invalid' : '' }}" name="scale_end" required>
                                    @foreach (App\User::INVESTMENT_RANGE as $key => $amount)
                                        <option value="{{ $key }}" {{ $scale_end == $key? "selected":"" }}>{{ $amount }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('scale_end'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('scale_end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if ($investor->exists)
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="track_record">{{ __('Investment Track Record So Far (Less than 300 Letters)') }}</label>
                                <textarea id="track_record" class="countable-text form-control{{ $errors->has('track_record') ? ' is-invalid' : '' }}" name="track_record" rows="8" data-max="300">{{ $track_record }}</textarea>
                                @if ($errors->has('track_record'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('track_record') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <h6>{{ __('Have you invested in through “ZenVentures” ?') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_invested" value="{{ intval(TRUE) }}" {{ $has_invested? "checked":"" }}>
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_invested" value="{{ intval(FALSE) }}" {{ !$has_invested? "checked":"" }}>
                                    <label class="form-check-label">No</label>
                                </div>
                                <input class="form-control{{ $errors->has('has_invested') ? ' is-invalid' : '' }}" type="hidden">
                                @if ($errors->has('has_invested'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('has_invested') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <button type="submit" name="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        @if ($investor->exists)
                            <a class="btn btn-secondary" href="{{ url('dashboard') }}" role="button">{{ __('Cancel') }}</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@component('components.investment_round_modal')
@endcomponent
@endsection

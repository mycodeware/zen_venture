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
                            $first_name = !is_null(old('first_name'))? old('first_name'): $freelancer->first_name;
                            $family_name = !is_null(old('family_name'))? old('family_name'): $freelancer->family_name;
                            $country_code = !is_null(old('country_code'))? old('country_code'): $freelancer->country_code;
                            $address = !is_null(old('address'))? old('address'): $freelancer->address;
                            $age = !is_null(old('age'))? old('age'): $freelancer->age;
                            $website = !is_null(old('website'))? old('website'): $freelancer->website;
                            $career = !is_null(old('career'))? old('career'): $freelancer->career;
                            $profession = !is_null(old('profession'))? old('profession'): $freelancer->profession;
                            if (!is_null(old('profession_remark'))) {
                                $profession_remark = old('profession_remark');
                            } elseif (isset($freelancer->professions_all) && !is_null($freelancer->professions_all->first())) {
                                $profession_remark = $freelancer->professions_all->first()->remark;
                            } else {
                                $profession_remark = '';
                            }
                            $qualification = !is_null(old('qualification'))? old('qualification'): $freelancer->qualification;
                            $strength = !is_null(old('strength'))? old('strength'): $freelancer->strength;
                            $purpose_message = !is_null(old('purpose_message'))? old('purpose_message'): $freelancer->purpose_message;
                            $appeal_message = !is_null(old('appeal_message'))? old('appeal_message'): $freelancer->appeal_message;
                        @endphp
                        @if ($freelancer->exists)
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
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $first_name }}" required @if ($freelancer->identified == App\User::IDENTIFY_IDENTIFIED) {{ 'readonly' }} @endif>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="family_name">{{ __('Family Name') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="family_name" type="text" class="form-control{{ $errors->has('family_name') ? ' is-invalid' : '' }}" name="family_name" value="{{ $family_name }}" required @if ($freelancer->identified == App\User::IDENTIFY_IDENTIFIED) {{ 'readonly' }} @endif>
                                @if ($errors->has('family_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if ($freelancer->identified == App\User::IDENTIFY_IDENTIFIED)
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
                        @if ($freelancer->exists)
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
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="age">{{ __('Age') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <select id="age" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age">
                                    @foreach (App\User::AGE_RANGE as $key => $age_range)
                                        <option value="{{ $key }}" {{ $age == $key? "selected":"" }}>{{ $age_range }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('age'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="website">{{ __('Website (If you have)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ $website }}">
                                @if ($errors->has('website'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h3 class="mt-3"><strong>{{ __('Profession') }}</strong></h3>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="career">{{ __('Your Career (Less than 500 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="career" class="countable-text form-control{{ $errors->has('career') ? ' is-invalid' : '' }}" name="career" rows="8" data-max="500">{{ $career }}</textarea>
                                @if ($errors->has('career'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('career') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="profession">{{ __('Profession') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <edit-profession-component :professions="{{ json_encode(App\User::PROFESSIONS) }}" :selected="{{ json_encode($profession) }}" :ini-remark="{{ json_encode($profession_remark) }}" class="{{ $errors->has('field') ? ' is-invalid' : '' }}"></edit-profession-component>
                                @if ($errors->has('profession'))
                                    <input class="form-control{{ $errors->has('profession') ? ' is-invalid' : '' }}" type="hidden">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('profession_remark'))
                                    <input class="form-control{{ $errors->has('profession_remark') ? ' is-invalid' : '' }}" type="hidden">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profession_remark') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="qualification">{{ __('Qualification/Skills (Less than 100 Letters)') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="qualification" class="countable-text form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification" rows="8" data-max="100" required>{{ $qualification }}</textarea>
                                @if ($errors->has('qualification'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('qualification') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if ($freelancer->exists)
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="strength">{{ __('Strength / Uniqueness (Less than 300 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="strength" class="countable-text form-control{{ $errors->has('strength') ? ' is-invalid' : '' }}" name="strength" rows="8" data-max="300">{{ $strength }}</textarea>
                                @if ($errors->has('strength'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('strength') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h3 class="mt-3"><strong>{{ __('Purpose Here') }}</strong></h3>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="purpose_message">{{ __('What are you looking for concretely here ? (Less than 300 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="purpose_message" class="countable-text form-control{{ $errors->has('purpose_message') ? ' is-invalid' : '' }}" name="purpose_message" rows="8" data-max="300">{{ $purpose_message }}</textarea>
                                @if ($errors->has('purpose_message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('purpose_message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="appeal_message">{{ __('Appeal Message (Less than 300 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="appeal_message" class="countable-text form-control{{ $errors->has('appeal_message') ? ' is-invalid' : '' }}" name="appeal_message" rows="8" data-max="300">{{ $appeal_message }}</textarea>
                                @if ($errors->has('appeal_message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('appeal_message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <button type="submit" name="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        @if ($freelancer->exists)
                            <a class="btn btn-secondary" href="{{ url('dashboard') }}" role="button">{{ __('Cancel') }}</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

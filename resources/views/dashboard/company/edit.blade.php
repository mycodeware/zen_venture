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
    <div class="row justify-content-center mt-4">
        @if (session('message_error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('message_error') }}
            </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">Dashboard</div> -->

                <div class="card-body">
                    <form action="{{ url('dashboard') }}" method="post" id="form-edit">
                        @csrf
                        @method('POST')
                        @php
                            $purposes = !is_null(old('purposes'))? old('purposes'): $purposes;
                            $first_name = !is_null(old('first_name'))? old('first_name'): $company->first_name;
                            $family_name = !is_null(old('family_name'))? old('family_name'): $company->family_name;
                            $position = !is_null(old('position'))? old('position'): $company->position;
                            $department = !is_null(old('department'))? old('department'): $company->department;
                            $company_name = !is_null(old('company_name'))? old('company_name'): $company->company_name;
                            $website = !is_null(old('website'))? old('website'): $company->website;
                            $country_code = !is_null(old('country_code'))? old('country_code'): $company->country_code;
                            $address = !is_null(old('address'))? old('address'): $company->address;
                            $founded_date = !is_null(old('founded_date'))? old('founded_date'): $company->founded_date;
                            $revenue_scale = !is_null(old('revenue_scale'))? old('revenue_scale'): $company->revenue_scale;
                            $capital_scale = !is_null(old('capital_scale'))? old('capital_scale'): $company->capital_scale;
                            $employee_number = !is_null(old('employee_number'))? old('employee_number'): $company->employee_number;
                            if (!is_null(old('field'))) {
                                $field_id = old('field');
                            } else {
                                $field_id = $user_categories->first()? $user_categories->first()->category->field->id: 1;
                            }
                            $checked_categories = !is_null(old('categories'))? old('categories'): array_column($user_categories->all(), 'category_id');
                            $checked_categories_remarks = !is_null(old('remarks'))? old('remarks'): array_column($user_categories->all(), 'remark', 'category_id');
                            $briefing_business = !is_null(old('briefing_business'))? old('briefing_business'): $company->briefing_business;
                            $briefing_service = !is_null(old('briefing_service'))? old('briefing_service'): $company->briefing_service;
                            $purpose_message = !is_null(old('purpose_message'))? old('purpose_message'): $company->purpose_message;
                            $appeal_message = !is_null(old('appeal_message'))? old('appeal_message'): $company->appeal_message;
                        @endphp
                        @if ($company->exists)
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
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $first_name }}" required @if ($company->identified == App\User::IDENTIFY_IDENTIFIED) {{ 'readonly' }} @endif>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="family_name">{{ __('Family Name') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="family_name" type="text" class="form-control{{ $errors->has('family_name') ? ' is-invalid' : '' }}" name="family_name" value="{{ $family_name }}" required @if ($company->identified == App\User::IDENTIFY_IDENTIFIED) {{ 'readonly' }} @endif>
                                @if ($errors->has('family_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if ($company->identified == App\User::IDENTIFY_IDENTIFIED)
                                <div class="form-group col-12 form-text text-muted">{{ __('Not allowed to change Name after your identity proof document is approved.') }}</div>
                            @endif
                        </div>
                        @if ($company->exists)
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="position">{{ __('Position') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" value="{{ $position }}">
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="department">{{ __('Department') }}</label>
                                <input id="department" type="text" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="{{ $department }}">
                                @if ($errors->has('department'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <h3 class="mt-3"><strong>{{ __('Company Overview') }}</strong></h3>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="company_name">{{ __('Company Name') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ $company_name }}" required>
                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if ($company->exists)
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
                        @endif
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
                        @if ($company->exists)
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="address">{{ __('Address') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
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
                                <label for="founded_date">{{ __('Founded Date') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="founded_date" type="date" class="form-control{{ $errors->has('founded_date') ? ' is-invalid' : '' }}" name="founded_date" value="{{ $founded_date }}">
                                <div class="small text-muted mx-1 my-1">{{ __('YYYY/MM/DD') }}</div>
                                @if ($errors->has('founded_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('founded_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="field">{{ __('Industry') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <edit-field-component :fields="{{ $fields }}" :selected="{{ $field_id }}" class="{{ $errors->has('field') ? ' is-invalid' : '' }}"></edit-field-component>
                                @if ($errors->has('field'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('field') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <edit-category-component :categories="{{ $categories }}" :selected="selectedField" :checked="checkedCategories" :ini-checked="{{ json_encode($checked_categories, JSON_NUMERIC_CHECK) }}" :ini-remarks="{{ json_encode($checked_categories_remarks) }}"></edit-category-component>
                                <input class="form-control{{ $errors->has('categories') ? ' is-invalid' : '' }}" type="hidden">
                                @if ($errors->has('categories'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('categories') }}</strong>
                                    </span>
                                @endif
                                <input class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" type="hidden">
                                @if ($errors->has('remarks'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                                @endif
                                @foreach ($categories as $category)
                                    @if ($errors->has('remarks.'.$category->id))
                                        <input class="form-control{{ $errors->has('remarks.'.$category->id) ? ' is-invalid' : '' }}" type="hidden">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('remarks.'.$category->id) }}</strong>
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="revenue_scale">{{ __('Revenue Scale (Range)') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <select id="revenue_scale" class="form-control{{ $errors->has('revenue_scale') ? ' is-invalid' : '' }}" name="revenue_scale">
                                    @foreach (App\User::REVENUE_SCALE as $key => $revenue)
                                        <option value="{{ $key }}" {{ $revenue_scale == $key? "selected":"" }}>{{ $revenue }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('revenue_scale'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('revenue_scale') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="capital_scale">{{ __('Capital Scale (Range)') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <select id="capital_scale" class="form-control{{ $errors->has('capital_scale') ? ' is-invalid' : '' }}" name="capital_scale">
                                    @foreach (App\User::CAPITAL_SCALE as $key => $capital)
                                        <option value="{{ $key }}" {{ $capital_scale == $key? "selected":"" }}>{{ $capital }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('capital_scale'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('capital_scale') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="employee_number">{{ __('Employee Number (Range)') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <select id="employee_number" class="form-control{{ $errors->has('employee_number') ? ' is-invalid' : '' }}" name="employee_number">
                                    @foreach (App\User::EMPLOYEE_NUMBER as $key => $employee)
                                        <option value="{{ $key }}" {{ $employee_number == $key? "selected":"" }}>{{ $employee }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('employee_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('employee_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h3 class="mt-3"><strong>{{ __('Business Description') }}</strong></h3>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="briefing_business">{{ __('Briefing of Your Business (Less than 100 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="briefing_business" class="countable-text form-control{{ $errors->has('briefing_business') ? ' is-invalid' : '' }}" name="briefing_business" rows="8" data-max="100">{{ $briefing_business }}</textarea>
                                @if ($errors->has('briefing_business'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('briefing_business') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="briefing_service">{{ __('Description of Your Service / Product (Less than 300 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="briefing_service" class="countable-text form-control{{ $errors->has('briefing_service') ? ' is-invalid' : '' }}" name="briefing_service" rows="8" data-max="300">{{ $briefing_service }}</textarea>
                                @if ($errors->has('briefing_service'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('briefing_service') }}</strong>
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
                        @if ($company->exists)
                            <a class="btn btn-secondary" href="{{ url('dashboard') }}" role="button">{{ __('Cancel') }}</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

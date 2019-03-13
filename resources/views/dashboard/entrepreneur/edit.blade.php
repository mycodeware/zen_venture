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
                            $first_name = !is_null(old('first_name'))? old('first_name'): $entrepreneur->first_name;
                            $family_name = !is_null(old('family_name'))? old('family_name'): $entrepreneur->family_name;
                            $country_code = !is_null(old('country_code'))? old('country_code'): $entrepreneur->country_code;
                            $company_name = !is_null(old('company_name'))? old('company_name'): $entrepreneur->company_name;
                            $company_website = !is_null(old('company_website'))? old('company_website'): $entrepreneur->company_website;
                            $company_address = !is_null(old('company_address'))? old('company_address'): $entrepreneur->company_address;
                            $founded_date = !is_null(old('founded_date'))? old('founded_date'): $entrepreneur->founded_date;
                            $number_of_members = !is_null(old('number_of_members'))? old('number_of_members'): $entrepreneur->number_of_members;
                            $company_vision = !is_null(old('company_vision'))? old('company_vision'): $entrepreneur->company_vision;
                            if (!is_null(old('field'))) {
                                $field_id = old('field');
                            } else {
                                $field_id = $user_categories->first()? $user_categories->first()->category->field->id: 1;
                            }
                            $checked_categories = !is_null(old('categories'))? old('categories'): array_column($user_categories->all(), 'category_id');
                            $checked_categories_remarks = !is_null(old('remarks'))? old('remarks'): array_column($user_categories->all(), 'remark', 'category_id');
                            $board_members = !is_null(old('board_members'))? old('board_members'): $entrepreneur->board_members;
                            $briefing = !is_null(old('briefing'))? old('briefing'): $entrepreneur->briefing;
                            $target_customers = !is_null(old('target_customers'))? old('target_customers'): $entrepreneur->target_customers;
                            $value_proposition = !is_null(old('value_proposition'))? old('value_proposition'): $entrepreneur->value_proposition;
                            $competitors = !is_null(old('competitors'))? old('competitors'): $entrepreneur->competitors;
                            $revenue_cost = !is_null(old('revenue_cost'))? old('revenue_cost'): $entrepreneur->revenue_cost;
                            $is_fundraising = !is_null(old('is_fundraising'))? old('is_fundraising'): $entrepreneur->is_fundraising;
                            $investment_round = !is_null(old('investment_round'))? old('investment_round'): $entrepreneur->investment_round;
                            $has_investor = !is_null(old('has_investor'))? old('has_investor'): $entrepreneur->has_investor;
                            $investors = !is_null(old('investors'))? old('investors'): $entrepreneur->investors;
                            $funding_amount = !is_null(old('funding_amount'))? old('funding_amount'): $entrepreneur->funding_amount;
                            $desired_help = !is_null(old('desired_help'))? old('desired_help'): $entrepreneur->desired_help;
                            $messages = !is_null(old('messages'))? old('messages'): $entrepreneur->messages;
                        @endphp
                        @if ($entrepreneur->exists)
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
                        <h3 class="mt-3"><strong>{{ __('President') }}</strong></h3>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first_name">{{ __('First Name') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $first_name }}" required @if ($entrepreneur->identified == App\User::IDENTIFY_IDENTIFIED) {{ 'readonly' }} @endif>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="family_name">{{ __('Family Name') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="family_name" type="text" class="form-control{{ $errors->has('family_name') ? ' is-invalid' : '' }}" name="family_name" value="{{ $family_name }}" required @if ($entrepreneur->identified == App\User::IDENTIFY_IDENTIFIED) {{ 'readonly' }} @endif>
                                @if ($errors->has('family_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if ($entrepreneur->identified == App\User::IDENTIFY_IDENTIFIED)
                                <div class="form-group col-12 form-text text-muted">{{ __('Not allowed to change Name after your identity proof document is approved.') }}</div>
                            @endif
                        </div>
                        <h3 class="mt-3"><strong>{{ __('Company Overview') }}</strong></h3>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="country_code">{{ __('Country (Registered)') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
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
                        @if ($entrepreneur->exists)
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="company_website">{{ __('Company Website') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="company_website" type="text" class="form-control{{ $errors->has('company_website') ? ' is-invalid' : '' }}" name="company_website" value="{{ $company_website }}">
                                @if ($errors->has('company_website'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="company_address">{{ __('Company Address') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="company_address" type="text" class="form-control{{ $errors->has('company_address') ? ' is-invalid' : '' }}" name="company_address" value="{{ $company_address }}">
                                @if ($errors->has('company_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_address') }}</strong>
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
                                <label for="number_of_members">{{ __('Number of Members') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <input id="number_of_members" type="number" class="form-control{{ $errors->has('number_of_members') ? ' is-invalid' : '' }}" name="number_of_members" min="0" value="{{ is_numeric($number_of_members)? $number_of_members: 0 }}">
                                @if ($errors->has('number_of_members'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('number_of_members') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="company_vision">{{ __('Company Vision (Less than 300 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="company_vision" class="countable-text form-control{{ $errors->has('company_vision') ? ' is-invalid' : '' }}" name="company_vision" rows="8" data-max="300">{{ $company_vision }}</textarea>
                                @if ($errors->has('company_vision'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_vision') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="field">{{ __('Field of Business') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
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
                                <label for="board_members">{{ __('Name and Career of Board Members (Less than 500 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="board_members" class="countable-text form-control{{ $errors->has('board_members') ? ' is-invalid' : '' }}" name="board_members" rows="8" data-max="500">{{ $board_members }}</textarea>
                                @if ($errors->has('board_members'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('board_members') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h3 class="mt-3"><strong>{{ __('Business Description') }}</strong></h3>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="briefing">{{ __('Description of Your Service (Less than 500 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="briefing" class="countable-text form-control{{ $errors->has('briefing') ? ' is-invalid' : '' }}" name="briefing" rows="8" data-max="500">{{ $briefing }}</textarea>
                                @if ($errors->has('briefing'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('briefing') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="target_customers">{{ __('Issue of Your Target Customers / Clients (Less than 500 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="target_customers" class="countable-text form-control{{ $errors->has('target_customers') ? ' is-invalid' : '' }}" name="target_customers" rows="8" data-max="500">{{ $target_customers }}</textarea>
                                @if ($errors->has('target_customers'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('target_customers') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="value_proposition">{{ __('Value Proposition (Less than 300 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="value_proposition" class="countable-text form-control{{ $errors->has('value_proposition') ? ' is-invalid' : '' }}" name="value_proposition" rows="8" data-max="300">{{ $value_proposition }}</textarea>
                                @if ($errors->has('value_proposition'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('value_proposition') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="competitors">{{ __('Competitors (Less than 300 Letters)') }}</label>
                                <textarea id="competitors" class="countable-text form-control{{ $errors->has('competitors') ? ' is-invalid' : '' }}" name="competitors" rows="8" data-max="300">{{ $competitors }}</textarea>
                                @if ($errors->has('competitors'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('competitors') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="revenue_cost">{{ __('Current Monthly Revenue and Costs (Less than 100 Letters)') }}</label>
                                <textarea id="revenue_cost" class="countable-text form-control{{ $errors->has('revenue_cost') ? ' is-invalid' : '' }}" name="revenue_cost" rows="8" data-max="100">{{ $revenue_cost }}</textarea>
                                @if ($errors->has('revenue_cost'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('revenue_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h3 class="mt-3"><strong>{{ __('Funding Situation') }}</strong></h3>
                        <div class="row">
                            <div class="form-group col-12">
                                <p>{{ __('Funding Situation at current phase') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_fundraising" value="{{ intval(TRUE) }}" {{ $is_fundraising? "checked":"" }}>
                                    <label class="form-check-label">Engaging in Fundraising</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_fundraising" value="{{ intval(FALSE) }}" {{ !$is_fundraising? "checked":"" }}>
                                    <label class="form-check-label">Not Engaging in Fundraising</label>
                                </div>
                                <input class="form-control{{ $errors->has('is_fundraising') ? ' is-invalid' : '' }}" type="hidden">
                                @if ($errors->has('is_fundraising'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('is_fundraising') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="investment_round">{{ __('Investment Round') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span><span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <select id="investment_round" class="form-control{{ $errors->has('investment_round') ? ' is-invalid' : '' }}" name="investment_round" required>
                                    @foreach (App\User::INVESTMENT_ROUNDS as $key => $round)
                                        <option value="{{ $key }}" {{ $investment_round == $key? "selected":"" }}>{{ $round }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('investment_round'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('investment_round') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-sm-6 align-self-end">
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#investment-round-modal"><h5><u>{{ __('Reference') }}</u></h5></button>
                            </div>
                        </div>
                        @if ($entrepreneur->exists)
                        <div class="row">
                            <div class="form-group col-12">
                                <p>{{ __('Have you received investment?') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_investor" value="{{ intval(TRUE) }}" {{ $has_investor? "checked":"" }}>
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_investor" value="{{ intval(FALSE) }}" {{ !$has_investor? "checked":"" }}>
                                    <label class="form-check-label">No</label>
                                </div>
                                <input class="form-control{{ $errors->has('has_investor') ? ' is-invalid' : '' }}" type="hidden">
                                @if ($errors->has('has_investor'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('has_investor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="investors">{{ __('Investors Name and Invested Amount (If you have, Less than 100 Letters)') }}</label>
                                <textarea id="investors" class="countable-text form-control{{ $errors->has('investors') ? ' is-invalid' : '' }}" name="investors" rows="8" data-max="100">{{ $investors }}</textarea>
                                @if ($errors->has('investors'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('investors') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="funding_amount">{{ __('Desired Funding Amount') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span></label>
                                <select id="funding_amount" class="form-control{{ $errors->has('funding_amount') ? ' is-invalid' : '' }}" name="funding_amount" required>
                                    @foreach (App\User::INVESTMENT_SCALE as $key => $amount)
                                        <option value="{{ $key }}" {{ $funding_amount == $key? "selected":"" }}>{{ $amount }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('funding_amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('funding_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="desired_help">{{ __('Desired Help from Investors (Less than 300 Letters)') }}</label>
                                <textarea id="desired_help" class="countable-text form-control{{ $errors->has('desired_help') ? ' is-invalid' : '' }}" name="desired_help" rows="8" data-max="300">{{ $desired_help }}</textarea>
                                @if ($errors->has('desired_help'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('desired_help') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="messages">{{ __('Message for Investors (Less than 300 Letters)') }}<span class="text-warning ml-2"><i class="fas fa-star"></i></span></label>
                                <textarea id="messages" class="countable-text form-control{{ $errors->has('messages') ? ' is-invalid' : '' }}" name="messages" rows="8" data-max="300">{{ $messages }}</textarea>
                                @if ($errors->has('messages'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('messages') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <button type="submit" name="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        @if ($entrepreneur->exists)
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
</section>
@endsection

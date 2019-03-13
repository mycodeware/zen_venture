@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center text-center">
        <div class="alert alert-warning" role="alert">
            <h5>{{ __('Beta version - You can use for free from Dec., 2018 to the end of Feb., 2019 !') }}</h5>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="pb-3">
                        @if ($entrepreneur->user_all->status == App\User::STATUS_ACTIVE)
                            <span class="h4 mx-2 align-bottom">{{ __('Current Status : ') }}{{ __('Active') }}</span>
                            <a href="{{ route('dashboard.deactivate') }}" class="btn btn-outline-secondary btn-sm" role="button">{{ __('Deactivate') }}</a>
                        @else
                            <span class="h4 mx-2 align-bottom">{{ __('Current Status : ') }}{{ __('Inactive') }}</span>
                            <a href="{{ route('dashboard.activate') }}" class="btn btn-outline-success btn-sm" role="button">{{ __('Activate') }}</a>
                        @endif
                    </div>
                    <div class="row  mt-3 mb-5">
                        <div class="col-md-3 offset-md-1 offset-xl-2"><h5>{{ __('I AM / WE ARE') }}</h5></div>
                        <div class="col-md-8 col-xl-6 text-center">
                            <div class="border-bottom border-dark pr-2">
                                <h5><strong>{{ App\User::TYPES[$entrepreneur->user_all->type]['display'] }}</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11 offset-md-1 mb-3"><h5>{{ __('LOOKING FOR OPPORTUNITIES FOR') }}</h5></div>
                        <div class="col-md-8 offset-md-4">
                            <ol>
                            @foreach ($entrepreneur->purposes as $purpose)
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
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-md-center"><h4 class="mb-0">{{ __('YOUR PROFILE') }}</h4></div>
                        @if (isset($completion))
                        <div class="col-12 text-right"><span class="border border-3 px-2 py-2">{{ __('PROFILE COMPLETION : ') }}{{ $completion }}&#x25;</span></div>
                        @endif
                    </div>
                    <hr>
                    <form action="{{ url('dashboard/upload') }}" method="post" enctype="multipart/form-data" onChange="if(typeof jQuery != 'undefined') $('#form-image').submit();" id="form-image">
                        @csrf
                        @method('POST')
                        @php
                            $filename = ($entrepreneur->image_filename)? 'storage/profile/'.$entrepreneur->image_filename: 'img/no_image.png';
                        @endphp
                        <h3>{{ __('Company Logo') }}</h3>
                        <div class="media">
                            <img src="{{ asset($filename) }}" alt="logo" class="align-self-center mr-3 w-25 img-thumbnail"/>
                            <div class="media-body align-self-center">
                                <input type="file" name="image" class="form-control-file{{ $errors->any() ? ' is-invalid' : '' }}">
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
                        @if ($entrepreneur->image_filename)
                            <a class="btn btn-danger btn-sm" href="{{ url('dashboard/deleteImage') }}" role="button">{{ __('Remove Picture') }}</a>
                        @endif
                    </form>
                    <hr>
                    <dl class="row">
                        <dt class="col-md-4">{{ __('First Name') }}</dt>
                        <dd class="col-md-8">{{ $entrepreneur->first_name }}</dd>
                        <dt class="col-md-4">{{ __('Family Name') }}</dt>
                        <dd class="col-md-8">{{ $entrepreneur->family_name }}</dd>
                        <dt class="col-md-4">{{ __('Country') }}</dt>
                        <dd class="col-md-8">{{ $entrepreneur->country_name }}</dd>
                        <dt class="col-md-4">{{ __('Company Name') }}</dt>
                        <dd class="col-md-8">{{ $entrepreneur->company_name }}</dd>
                        <dt class="col-md-4">{{ __('Company Website') }}</dt>
                        <dd class="col-md-8">{{ $entrepreneur->company_website }}</dd>
                        <dt class="col-md-4">{{ __('Company Address') }}</dt>
                        <dd class="col-md-8">{{ $entrepreneur->company_address }}</dd>
                        <dt class="col-md-4">{{ __('Founded Date') }}</dt>
                        <dd class="col-md-8">{{ $entrepreneur->founded_date }}</dd>
                        <dt class="col-md-4">{{ __('Number of Members') }}</dt>
                        <dd class="col-md-8">{{ $entrepreneur->number_of_members }}</dd>
                        <dt class="col-md-4">{{ __('Company Vision') }}</dt>
                        <dd class="col-md-8">{!! nl2br(e($entrepreneur->company_vision)) !!}</dd>
                        <dt class="col-md-4">{{ __('Field of Business') }}</dt>
                        <dd class="col-md-8">
                        @if ($entrepreneur->categories_all->isNotEmpty())
                            {{ $entrepreneur->categories_all->first()->category->field->field_name }}
                        @endif
                        </dd>
                        @foreach ($entrepreneur->categories_all as $category)
                            <dt class="col-md-4"></dt>
                            <dd class="col-md-8">
                                {{ $category->category->category_name }} @if (!is_null($category->remark) && $category->remark != '') ( {{ $category->remark }} ) @endif
                            </dd>
                        @endforeach
                        <dt class="col-md-4">{{ __('Name and Career of Board Members') }}</dt>
                        <dd class="col-md-8">{!! nl2br(e($entrepreneur->board_members)) !!}</dd>
                        <dt class="col-md-4">{{ __('Description of Your Service') }}</dt>
                        <dd class="col-md-8">{!! nl2br(e($entrepreneur->briefing)) !!}</dd>
                        <dt class="col-md-4">{{ __('Issue of Your Target Customers / Clients') }}</dt>
                        <dd class="col-md-8">{!! nl2br(e($entrepreneur->target_customers)) !!}</dd>
                        <dt class="col-md-4">{{ __('Value Proposition') }}</dt>
                        <dd class="col-md-8">{!! nl2br(e($entrepreneur->value_proposition)) !!}</dd>
                        <dt class="col-md-4">{{ __('Competitors') }}</dt>
                        <dd class="col-md-8">{!! nl2br(e($entrepreneur->competitors)) !!}</dd>
                        <dt class="col-md-4">{{ __('Current Monthly Revenue and Costs') }}</dt>
                        <dd class="col-md-8">{!! nl2br(e($entrepreneur->revenue_cost)) !!}</dd>
                        <dt class="col-md-4">{{ __('Funding Situation at current phase') }}</dt>
                        <dd class="col-md-8">
                        @if (!is_null($entrepreneur->is_fundraising))
                            {{ $entrepreneur->is_fundraising? __('Engaging in Fundraising'): __('Not Engaging in Fundraising') }}
                        @endif
                        </dd>
                        <dt class="col-md-4">{{ __('Investment Round') }}</dt>
                        <dd class="col-md-8">{{ $entrepreneur->investment_round_name }}</dd>
                        <dt class="col-md-4">{{ __('Have you received investment') }}</dt>
                        <dd class="col-md-8">
                        @if (!is_null($entrepreneur->has_investor))
                            {{ $entrepreneur->has_investor? __('Yes'): __('No') }}
                        @endif
                        </dd>
                        <dt class="col-md-4">{{ __('Investors Name and Invested Amount') }}</dt>
                        <dd class="col-md-8">{!! nl2br(e($entrepreneur->investors)) !!}</dd>
                        <dt class="col-md-4">{{ __('Desired Funding Amount') }}</dt>
                        <dd class="col-md-8">
                        @if (!is_null($entrepreneur->funding_amount))
                            {{ App\User::INVESTMENT_SCALE[$entrepreneur->funding_amount] }}
                        @endif
                        </dd>
                        <dt class="col-md-4">{{ __('Desired Help from Investors') }}</dt>
                        <dd class="col-md-8">{!! nl2br(e($entrepreneur->desired_help)) !!}</dd>
                        <dt class="col-md-4">{{ __('Message for Investors') }}</dt>
                        <dd class="col-md-8">{!! nl2br(e($entrepreneur->messages)) !!}</dd>
                    </dl>
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
                    <div>
                        @if ($entrepreneur->identified == App\User::IDENTIFY_IDENTIFIED)
                            <div><img src="{{ asset('/img/identified.png') }}" alt="identified" class="icon mr-2"/><span class="h4 align-bottom">{{ __('You are identified!') }}</span></div>
                            <a href="{{ route('dashboard.identify') }}">{{ __('See identity proof document.') }}</a>
                        @elseif ($entrepreneur->identified == App\User::IDENTIFY_REJECTED)
                            <h4>{{ __('You identity proof document is rejected by admin...') }}</h4>
                            <a href="{{ route('dashboard.identify') }}">{{ __('Submit another identity proof document.') }}</a>
                        @elseif ($entrepreneur->identified == App\User::IDENTIFY_PENDING)
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
@endsection

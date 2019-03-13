@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="{{ route('match.index') }}">{{ __('Match Making') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('match.index', ['type' => App\User::TYPES[App\User::TYPE_ENTREPRENEUR]['abbr']]) }}">{{ App\User::TYPE_LIST[App\User::TYPE_ENTREPRENEUR] }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Details') }}</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">{{ __('DETAILS OF THE STARTUP YOU SELECTED') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('COMPANY') }}</th>
                                    <th scope="col">{{ __('COUNTRY') }}</th>
                                    <th scope="col">{{ __('ROUND') }}</th>
                                    <th scope="col">{{ __('PURPOSE HERE') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $entrepreneur->company_name }}</td>
                                    <td>{{ $entrepreneur->country_name }}</td>
                                    <td>
                                        @if (!is_null($entrepreneur->investment_round))
                                            {{ App\User::INVESTMENT_ROUNDS[$entrepreneur->investment_round] }}
                                        @endif
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($purposes as $purpose)
                                                <li>{{ App\User::PURPOSES[$purpose->purpose_id] }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td rowspan="2">{{ __('President') }}</td>
                                    <td>{{ __('Identified') }}</td>
                                    <td>
                                        @if ($entrepreneur->identified == App\User::IDENTIFY_IDENTIFIED)
                                            <div><img src="{{ asset('/img/identified.png') }}" alt="identified" class="icon mr-2"/><span class="align-bottom">{{ __('Identified') }}</span></div>
                                        @else
                                            <span class="text-muted">{{ __('Unidentified') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Name') }}</td>
                                    <td>{{ $entrepreneur->first_name }} {{ $entrepreneur->family_name }}</td>
                                </tr>
                                <tr>
                                    <td rowspan="10">{{ __('Company Overview') }}</td>
                                    <td>{{ __('Country (Registered)') }}</td>
                                    <td>{{ $entrepreneur->country_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Company Name (Before registration : PIC Name)') }}</td>
                                    <td>{{ $entrepreneur->company_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Company Website') }}</td>
                                    <td><a href="{{ $entrepreneur->company_website }}" target="_blank">{{ $entrepreneur->company_website }}</a></td>
                                </tr>
                                <tr>
                                    <td>{{ __('Company Address') }}</td>
                                    <td>{{ $entrepreneur->company_address }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Founded Date') }}</td>
                                    <td>{{ $entrepreneur->founded_date }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Number of Members') }}</td>
                                    <td>{{ $entrepreneur->number_of_members }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Company Vision') }}</td>
                                    <td>{!! nl2br(e($entrepreneur->company_vision)) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Field of Business') }}</td>
                                    <td>
                                        <ol class="list-unstyled">
                                            @if (!$categories->isEmpty())
                                                <li>{{ $categories->first()->category->field->field_name }}</li>
                                            @endif
                                            @foreach ($categories as $category)
                                                <li>{{ $category->category->category_name }} @if (!is_null($category->remark) && $category->remark != '') ( {{ $category->remark }} ) @endif</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Name & Career of Board Members') }}</td>
                                    <td>{!! nl2br(e($entrepreneur->board_members)) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Company Logo') }}</td>
                                    <td>
                                      @php
                                          $filename = ($entrepreneur->image_filename)? 'storage/profile/'.$entrepreneur->image_filename: 'img/no_image.png';
                                      @endphp
                                      <img src="{{ asset($filename) }}" alt="logo" class="profile-image img-thumbnail img-fluid"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="3">{{ __('Business Description') }}</td>
                                    <td>{{ __('Briefing of the Service') }}</td>
                                    <td>{!! nl2br(e($entrepreneur->briefing)) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Issue of Target Customers / Clients') }}</td>
                                    <td>{!! nl2br(e($entrepreneur->target_customers)) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Value Proposition') }}</td>
                                    <td>{!! nl2br(e($entrepreneur->value_proposition)) !!}</td>
                                </tr>
                                <tr>
                                    <td rowspan="3">{{ __('Funding Situation') }}</td>
                                    <td>{{ __('Funding Situation at current phase') }}</td>
                                    <td>
                                        @if (!is_null($entrepreneur->is_fundraising))
                                            {{ $entrepreneur->is_fundraising? __('Engaging in Fundraising'): __('Not Engaging in Fundraising') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Investment Round') }}</td>
                                    <td>
                                        @if (!is_null($entrepreneur->investment_round))
                                            {{ App\User::INVESTMENT_ROUNDS[$entrepreneur->investment_round] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Message for Investors') }}</td>
                                    <td>{!! nl2br(e($entrepreneur->messages)) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @component('match.request', [
                        'has_requested' => $has_requested,
                        'errors' => $errors,
                        'target_user_name' => $entrepreneur->user->name,
                        'is_contact' => !is_null(old('name'))? old('is_contact'): TRUE,
                        'is_further_information' => !is_null(old('name'))? old('is_further_information'): TRUE
                    ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

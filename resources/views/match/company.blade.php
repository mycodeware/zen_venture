@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="{{ route('match.index') }}">{{ __('Match Making') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('match.index', ['type' => App\User::TYPES[App\User::TYPE_COMPANY]['abbr']]) }}">{{ App\User::TYPE_LIST[App\User::TYPE_COMPANY] }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Details') }}</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">{{ __('DETAILS OF THE COMPANY YOU SELECTED') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('COMPANY') }}</th>
                                    <th scope="col">{{ __('COUNTRY') }}</th>
                                    <th scope="col">{{ __('PURPOSE HERE') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $company->company_name }}</td>
                                    <td>{{ $company->country_name }}</td>
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
                                    <td rowspan="3">
                                        @php
                                            $filename = ($company->image_filename)? 'storage/profile/'.$company->image_filename: 'img/no_image.png';
                                        @endphp
                                        <img src="{{ asset($filename) }}" alt="logo" class="profile-image img-thumbnail img-fluid"/>
                                    </td>
                                    <td>{{ __('Identified') }}</td>
                                    <td>
                                        @if ($company->identified == App\User::IDENTIFY_IDENTIFIED)
                                            <div><img src="{{ asset('/img/identified.png') }}" alt="identified" class="icon mr-2"/><span class="align-bottom">{{ __('Identified') }}</span></div>
                                        @else
                                            <span class="text-muted">{{ __('Unidentified') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Name') }}</td>
                                    <td>{{ $company->first_name }} {{ $company->family_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Position') }}</td>
                                    <td>{{ $company->position }}</td>
                                </tr>
                                <tr>
                                    <td rowspan="9">{{ __('Company Overview') }}</td>
                                    <td>{{ __('Company Name') }}</td>
                                    <td>{{ $company->company_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Website') }}</td>
                                    <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                                </tr>
                                <tr>
                                    <td>{{ __('Country') }}</td>
                                    <td>{{ $company->country_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Address') }}</td>
                                    <td>{{ $company->address }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Founded Date') }}</td>
                                    <td>{{ $company->founded_date }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Revenue Scale') }}</td>
                                    <td>
                                        @if (!is_null($company->revenue_scale))
                                            {{ App\User::REVENUE_SCALE[$company->revenue_scale] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Capital Scale') }}</td>
                                    <td>
                                        @if (!is_null($company->capital_scale))
                                            {{ App\User::CAPITAL_SCALE[$company->capital_scale] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Employee Number') }}</td>
                                    <td>
                                        @if (!is_null($company->employee_number))
                                            {{ App\User::EMPLOYEE_NUMBER[$company->employee_number] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Company Logo') }}</td>
                                    <td>
                                      @php
                                          $filename = ($company->image_filename)? 'storage/profile/'.$company->image_filename: 'img/no_image.png';
                                      @endphp
                                      <img src="{{ asset($filename) }}" alt="logo" class="profile-image img-thumbnail img-fluid"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2">{{ __('Business Description') }}</td>
                                    <td>{{ __('Briefing of the Business') }}</td>
                                    <td>{!! nl2br(e($company->briefing_business)) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Briefing of the Service / Product') }}</td>
                                    <td>{!! nl2br(e($company->briefing_service)) !!}</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">{{ __('Purpose Here') }}</td>
                                    <td>{{ __('What are you looking for concretely here ?') }}</td>
                                    <td>{!! nl2br(e($company->purpose_message)) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Appeal Message') }}</td>
                                    <td>{!! nl2br(e($company->appeal_message)) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @component('match.request', [
                        'has_requested' => $has_requested,
                        'errors' => $errors,
                        'target_user_name' => $company->user->name,
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

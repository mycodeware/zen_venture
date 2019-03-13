@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="{{ route('match.index') }}">{{ __('Match Making') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('match.index', ['type' => App\User::TYPES[App\User::TYPE_INVESTOR]['abbr']]) }}">{{ App\User::TYPE_LIST[App\User::TYPE_INVESTOR] }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Details') }}</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">{{ __('DETAILS OF THE INVESTOR YOU SELECTED') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('COMPANY') }}</th>
                                    <th scope="col">{{ __('COUNTRY') }}</th>
                                    <th scope="col">{{ __('TARGET ROUND') }}</th>
                                    <th scope="col">{{ __('INVESTMENT SCALE') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $investor->company_name }}</td>
                                    <td>{{ $investor->country_name }}</td>
                                    <td>{{ $investor->round_start_name }} {{ __(' - ') }} {{ $investor->round_end_name }}</td>
                                    <td>{{ $investor->scale_start_name }} {{ __(' - ') }} {{ $investor->scale_end_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td rowspan="5">
                                        @php
                                            $filename = ($investor->image_filename)? 'storage/profile/'.$investor->image_filename: 'img/no_image.png';
                                        @endphp
                                        <img src="{{ asset($filename) }}" alt="logo" class="profile-image img-thumbnail img-fluid"/>
                                    </td>
                                    <td>{{ __('Identified') }}</td>
                                    <td>
                                        @if ($investor->identified == App\User::IDENTIFY_IDENTIFIED)
                                            <div><img src="{{ asset('/img/identified.png') }}" alt="identified" class="icon mr-2"/><span class="align-bottom">{{ __('Identified') }}</span></div>
                                        @else
                                            <span class="text-muted">{{ __('Unidentified') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Name') }}</td>
                                    <td>{{ $investor->first_name }} {{ $investor->family_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Country') }}</td>
                                    <td>{{ $investor->country_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Company / Association, etc') }}</td>
                                    <td>{{ $investor->company_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Website') }}</td>
                                    <td><a href="{{ $investor->website }}" target="_blank">{{ $investor->website }}</a></td>
                                </tr>
                                <tr>
                                    <td rowspan="5">{{ __('About Investment') }}</td>
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
                                    <td>{{ __('Have you invested in through ZenVentures ?') }}</td>
                                    <td>
                                        @if (!is_null($investor->has_invested))
                                            {{ $investor->has_invested? __('Yes'): __('No') }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @component('match.request', [
                        'has_requested' => $has_requested,
                        'errors' => $errors,
                        'target_user_name' => $investor->user->name,
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

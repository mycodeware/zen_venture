@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="{{ route('match.index') }}">{{ __('Match Making') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('match.index', ['type' => App\User::TYPES[App\User::TYPE_FREELANCER]['abbr']]) }}">{{ App\User::TYPE_LIST[App\User::TYPE_FREELANCER] }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Details') }}</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">{{ __('DETAILS OF THE PROFESSIONAL YOU SELECTED') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('PROFESSION') }}</th>
                                    <th scope="col">{{ __('QUALIFICATION/SKILLS') }}</th>
                                    <th scope="col">{{ __('PURPOSE HERE') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @if (isset($freelancer->profession_name))
                                            {{ $freelancer->profession_name }}
                                        @endif
                                    </td>
                                    <td>{!! nl2br(e($freelancer->qualification)) !!}</td>
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
                                    <td class="border-bottom-0">{{ __('General Information') }}</td>
                                    <td>{{ __('Identified') }}</td>
                                    <td>
                                        @if ($freelancer->identified == App\User::IDENTIFY_IDENTIFIED)
                                            <div><img src="{{ asset('/img/identified.png') }}" alt="identified" class="icon mr-2"/><span class="align-bottom">{{ __('Identified') }}</span></div>
                                        @else
                                            <span class="text-muted">{{ __('Unidentified') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="4" class="border-top-0">
                                        @php
                                            $filename = ($freelancer->image_filename)? 'storage/profile/'.$freelancer->image_filename: 'img/no_image.png';
                                        @endphp
                                        <img src="{{ asset($filename) }}" alt="logo" class="w-100 profile-image img-thumbnail img-fluid"/>
                                    </td>
                                    <td>{{ __('Name') }}</td>
                                    <td>{{ $freelancer->first_name }} {{ $freelancer->family_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Country') }}</td>
                                    <td>{{ $freelancer->country_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Age') }}</td>
                                    <td>
                                        @if (!is_null($freelancer->age))
                                            {{ App\User::AGE_RANGE[$freelancer->age] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Website') }}</td>
                                    <td><a href="{{ $freelancer->website }}" target="_blank">{{ $freelancer->website }}</a></td>
                                </tr>
                                <tr>
                                    <td rowspan="4">{{ __('Professionality') }}</td>
                                    <td>{{ __('Career') }}</td>
                                    <td>{!! nl2br(e($freelancer->career)) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Profession') }}</td>
                                    <td>
                                        @if (isset($freelancer->profession_name))
                                            {{ $freelancer->profession_name }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Qualification/Skills') }}</td>
                                    <td>{!! nl2br(e($freelancer->qualification)) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Strength / Uniqueness') }}</td>
                                    <td>{!! nl2br(e($freelancer->strength)) !!}</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">{{ __('Purpose Here') }}</td>
                                    <td>{{ __('What are you looking for concretely here ?') }}</td>
                                    <td>{!! nl2br(e($freelancer->purpose_message)) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Appeal Message') }}</td>
                                    <td>{!! nl2br(e($freelancer->appeal_message)) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @component('match.request', [
                        'has_requested' => $has_requested,
                        'errors' => $errors,
                        'target_user_name' => $freelancer->user->name,
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

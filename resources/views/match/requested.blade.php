@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="{{ route('match.index') }}">{{ __('Match Making') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('match.index', ['type' => App\User::TYPES[$requested_user->type]['abbr']]) }}">{{ App\User::TYPE_LIST[$requested_user->type] }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('match.show', ['name' => $requested_user->name]) }}">{{ __('Details') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Requested') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center pb-4">
        <div class="col-md-10 text-center">
            <h2 class="my-4">{{ __('THANK YOU FOR YOUR REQUEST !') }}</h2>
            <h3>{{ __('We will confirm it and reply back to you soon !') }}</h3>
        </div>
    </div>
    <div class="row justify-content-center py-4 bg-white">
        <div class="col-md-12 px-0">
            @php $file = '/img/requested.png' @endphp
            <img src="{{ asset($file) }}?{{ File::lastModified(public_path($file)) }}" alt="Requested" class="w-100">
        </div>
    </div>
</div>
@endsection

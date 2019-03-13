@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mx-5 mt-4">
        <h1 class="display-1">{{ $status_code }}</h1>
    </div>
    <div class="row mx-5">
        <h1 class="display-4">{{ $error_message }}</h1>
    </div>
</div>
@endsection

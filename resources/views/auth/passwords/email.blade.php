@extends('layouts.app')

@section('content')
<div class="clearfix"></div>



    <!-- Start Home -->

  <section class="sub-header text-center" style="background-image:url({{ url('img/terms.jpg') }})">
    
    <div class="container">
        
                    <span>WELCOME TO OUR WORLD</span>
                    <h3 class="text-capitalize">{{ __('Reset Password') }}</h3>
    </div>

  </section>
<section class="login-page-content">
<div class="container">
    <div class="login-page-outer">
            <h2>{{ __('Reset Password') }}</h2>
            <div class="contact-form">
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputName">{{ __('E-Mail Address') }}<span class="requred">*</span></label>                                
                                
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         
                        
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button></div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</div>
</section>
@endsection

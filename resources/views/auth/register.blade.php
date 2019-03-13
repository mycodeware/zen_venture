@extends('layouts.app')

@section('content')
<div class="clearfix"></div>



    <!-- Start Home -->

  <section class="sub-header text-center" style="background-image:url({{ url('img/terms.jpg') }})">
    
    <div class="container">
        
                    <span>WELCOME TO OUR WORLD</span>
                    <h3 class="text-capitalize">{{ __('Sign Up') }}</h3>
    </div>

  </section>
<section class="login-page-content">
    <div class="container">
        <div class="login-page-outer">
            <h2>Sign Up On Your Account</h2>
            <div class="contact-form">
                <div class="row">
                     <form method="POST" action="{{ route('register') }}" id="form-register">
                        @csrf
                        @php
                            $type_id = !is_null(old('type'))? old('type'): 1;
                            $user_purposes = !is_null(old('purposes'))? old('purposes'): [];
                        @endphp
                         <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputName">{{ __('SO I AM / WE ARE .....') }}<span class="requred">*</span></label>
                                <!--<select id="type" name="type" class="form-control"><option value="1">Angel Investor / VC / CVC / PE</option><option value="2">Large scale company / SME</option><option value="3">Startup / Entrepreneur</option><option value="4">Professional / Freelancer</option></select>-->
                                <register-type-component :types="{{ json_encode(App\User::TYPES) }}" :selected="{{ $type_id }}" class="{{ $errors->has('type') ? ' is-invalid' : '' }}"></register-type-component>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>                                                                
                        </div>
                         <div class="col-md-12">
                            <div class="form-group">
                            <label for="InputName">{{ __('I AM / WE ARE LOOKING FOR OPPORTUNITIES FOR .....') }} <span class="requred">*</span></label>
                            @php
                                $show_flags = [];
                                foreach (App\User::TYPES as $key_type => $type) {
                                    $show_purpose = [];
                                    foreach (App\User::PURPOSES as $key_purpose => $purpose) {
                                        $show_purpose[$key_purpose] = in_array($key_purpose, App\User::TYPES_PURPOSES[$key_type])? true: false;
                                    }
                                    $show_flags[$key_type] = $show_purpose;
                                }
                            @endphp    
                              <div class="row">
                              <div class="form-groupcheckbox">
                                <div class="form-chec">
                                <register-purpose-component :show-flags="{{ json_encode($show_flags) }}" :purposes="{{ json_encode(App\User::PURPOSES) }}" :selected="selectedType" :checked="checkedPurposes" :ini-checked="{{ json_encode($user_purposes) }}"></register-purpose-component>
                                <input class="form-check-input{{ $errors->has('purposes') ? ' is-invalid' : '' }}" type="hidden" id="investment">
                                @if ($errors->has('purposes'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('purposes') }}</strong>
                                    </span>
                                @endif
                                </div>
                              </div>      
                                <!--<div class="col-md-6"> <div class="form-groupcheckbox">
                                  <div class="form-chec">
                                      <input class="form-check-input" type="checkbox" id="investment">
                                      <label class="form-check-label" for="investment">
                                          Investment
                                      </label>
                                  </div>
                              </div></div>
                             <div class="col-md-6">
                               <div class="form-groupcheckbox">
                                  <div class="form-chec">
                                      <input class="form-check-input" type="checkbox" id="ma">
                                      <label class="form-check-label" for="ma">
                                         M&A
                                      </label>
                                  </div>
                              </div>
                             </div>-->
                             
                            <!-- <div class="col-md-12">
                                <div class="form-groupcheckbox">
                                    <div class="form-chec">
                                        <input class="form-check-input" type="checkbox" id="it">
                                        <label class="form-check-label" for="it">
                                           Information Collection
                                        </label>
                                    </div>
                                </div>
                             </div>-->
                            
                            
                            </div>
                        </div>
                                                        
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputName">{{ __('E-Mail Address') }}<span class="requred">*</span></label>
                                <!--<input type="email" class="form-control" id="Inputemail" placeholder="Enter Your E-Mail Address" required>-->
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputName">{{ __('Password') }}<span class="requred">*</span></label>                                
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputName">{{ __('Confirm Password') }}<span class="requred">*</span></label>                                
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputName">{{ __('Terms and Conditions / Disclaimer / Privacy Policy') }}<span class="requred">*</span></label>
                                <div class="terms_box">
                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-groupcheckbox">
                                <div class="form-chec">
                                    <input id="acceptance" type="checkbox" class="form-check-input {{ $errors->has('acceptance') ? ' is-invalid' : '' }}" name="acceptance" required>
                                    <label for="acceptance" class="form-check-label">&nbsp;{{ __('I agree with the Terms and Conditions / Disclaimer / Privacy Policy above.') }}</label>                                    
                                    @if ($errors->has('acceptance'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('acceptance') }}</strong>
                                        </span>
                                    @endif        
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6"><button type="submit" class="login-button btn-primary">{{ __('Sign Up') }}</button></div>
                                <div class="col-md-6"><a href="{{ route('login') }}" class="forgetting-password">{{ __('Log In') }}</a></div>
                            </div>                                
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>    
 
@endsection

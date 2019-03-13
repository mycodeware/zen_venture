@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>



    <!-- Start Home -->

  <section class="sub-header text-center" style="background-image:url({{ url('img/sh-contact.jpg') }})">
    
    <div class="container">
        
                    <span>CONNECT WITH US</span>
                    <h3 class="text-capitalize">Get in touch</h3>
    </div>

  </section>
<section class="map_view">
    
    <div class="container">
        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.38036691277!2d139.5572591148534!3d35.69225638019167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018efc889e6bea5%3A0x5fc25e880235fdb8!2s6+Chome-11-13+Kamirenjaku%2C+Mitaka-shi%2C+T%C5%8Dky%C5%8D-to+181-0012%2C+Japan!5e0!3m2!1sen!2sin!4v1548065787155" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>

  </section>
  
    
    
    
    
  <div class="contact_info">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                    <div class="title_bar"><h2 class="text-uppercase">Get <span>in touch</span></h2></div>
              
                <ul>
                    <li data-aos="fade-right" class="aos-init aos-animate"><i class="fa fa-map-marker"></i>{{ __('Headquarters :  6-11-13 Kamirenjaku, Mitaka-City, Tokyo, Japan 181-0012') }} </li>
                    <li data-aos="fade-right" class="aos-init aos-animate"><i class="fa fa-map-marker"></i>{{ __('South Africa Branch :  625 Mias Str. Garsfontein, Pretoria, South Africa') }} </li>
                    <li data-aos="fade-right" class="aos-init"><i class="fa fa-phone"></i> {{ __('Phone (Japan) :  ') }}<a href="tel:+81-36868-4986">+81-36868-4986</a></li>
                       <li data-aos="fade-right" class="aos-init"><i class="fa fa-phone"></i> {{ __('Phone (South Africa) : ') }}<a href="tel:+27-83-384-6879">+27-83-384-6879</li>
                    <li data-aos="fade-right" class="aos-init"><i class="fa fa-envelope"></i> {{ __('E-mail : ') }}<a href="mailto:zenventures&#64;andafrica.co.jp">zenventures&#64;andafrica.co.jp</li>
                </ul>
            </div>
            <div class="col-md-7">
                    <div class="title_bar"><h2 class="text-uppercase">send <span>message</span></h2></div>
                    @if (session('inquiry_success'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Your inquiry has been sent successfully. Thank you for your inquiry. We  will get back to you shortly.') }}
                        </div>
                    @endif
                    @if (session('inquiry_error'))
                        <div class="alert alert-danger" role="alert">
                            {{ __('Sorry... Failed to send... Please try again later.') }}
                        </div>
                    @endif
                    @if (session('grecaptcha_error'))
                        <div class="alert alert-danger" role="alert">
                            {{ __('Sorry... Google reCaptcha is invalid... Please try again later.') }}
                        </div>
                    @endif    
                    <form action="{{ route('inquiry.store', app()->getLocale()) }}" method="post" id="form-inquiry">
                        @csrf
                        @method('POST')
                        @php
                            $company_name = !is_null(old('company_name'))? old('company_name'): '';
                            $department_section = !is_null(old('department_section'))? old('department_section'): '';
                            $job_title = !is_null(old('job_title'))? old('job_title'): '';
                            $first_name = !is_null(old('first_name'))? old('first_name'): '';
                            $family_name = !is_null(old('family_name'))? old('family_name'): '';
                            $email = !is_null(old('email'))? old('email'): '';
                            $phone_number = !is_null(old('phone_number'))? old('phone_number'): '';
                            $inquiry = !is_null(old('inquiry'))? old('inquiry'): '';
                        @endphp
                    <div class="row">
                    
                        <div class=" col-md-6">
                            <div class="form-group">                                                                
                                <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ $company_name }}" placeholder="{{ __('Company Name') }}" required>
                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">                                                            
                                <input id="department_section" type="text" class="form-control{{ $errors->has('department_section') ? ' is-invalid' : '' }}" name="department_section" placeholder="{{ __('Department / Section') }}" value="{{ $department_section }}" required>
                                @if ($errors->has('department_section'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department_section') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">                                                                
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $first_name }}" placeholder="{{ __('First Name') }}" required>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">                                
                                <input id="family_name" type="text" class="form-control{{ $errors->has('family_name') ? ' is-invalid' : '' }}" name="family_name" value="{{ $family_name }}" placeholder="{{ __('Family Name') }}" required>
                                @if ($errors->has('family_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class=" col-md-12">
                            <div class="form-group">                                
                                <input id="job_title" type="text" class="form-control{{ $errors->has('job_title') ? ' is-invalid' : '' }}" name="job_title" value="{{ $job_title }}" placeholder="{{ __('Job Title') }}" required>
                                @if ($errors->has('job_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">                                                        
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email }}" placeholder="{{ __('E-mail') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                       </div>
                       <div class=" col-md-6">
                            <div class="form-group">                                                                
                                <input id="email" type="tel" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ $phone_number }}" placeholder="{{ __('Phone Number') }}">
                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                       </div>
                       <div class=" col-md-12">
                            <div class="form-group">                                
                                <textarea id="inquiry" class="countable-text form-control{{ $errors->has('inquiry') ? ' is-invalid' : '' }}" name="inquiry" rows="8" data-max="300" placeholder="{{ __('Inquiry (Less than 300 Letters)') }}" required>{{ $inquiry }}</textarea>
                                @if ($errors->has('inquiry'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('inquiry') }}</strong>
                                    </span>
                                @endif    
                            </div>
                       </div>
                       <!--  reCAPTCHA   -->
                        <script>
                            grecaptcha.ready(function() {
                                grecaptcha.execute('{{ env("GRECAPTCHA_SITE_KEY") }}', {action: 'homepage'})
                                .then(function(token) {
                                    // Verify the token on the server.
                                    $('#form-inquiry-submit').append($('<input>').attr({'type': 'hidden', 'name': 'grecaptcha'}).val(token));
                                    $('#form-inquiry-submit').prop('disabled', false);
                                });
                            });
                        </script> 
                       <div class=" col-md-6">
                            <div class="form-group">                                
                                <button id="form-inquiry-submit" type="submit" name="submit" class="btn btn-primary" disabled>{{ __('Send') }}</button>
                            </div>
                       </div>
                       
                       
                    </div>
                    
                    </form>
            </div>
        </div>
    </div>
</div>
  
<!--<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Contact Us</div>

                <div class="card-body">
                    @if (session('inquiry_success'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Your inquiry has been sent successfully. Thank you for your inquiry. We  will get back to you shortly.') }}
                        </div>
                    @endif
                    @if (session('inquiry_error'))
                        <div class="alert alert-danger" role="alert">
                            {{ __('Sorry... Failed to send... Please try again later.') }}
                        </div>
                    @endif
                    @if (session('grecaptcha_error'))
                        <div class="alert alert-danger" role="alert">
                            {{ __('Sorry... Google reCaptcha is invalid... Please try again later.') }}
                        </div>
                    @endif
                    <form action="{{ route('inquiry.store', app()->getLocale()) }}" method="post" id="form-inquiry">
                        @csrf
                        @method('POST')
                        @php
                            $company_name = !is_null(old('company_name'))? old('company_name'): '';
                            $department_section = !is_null(old('department_section'))? old('department_section'): '';
                            $job_title = !is_null(old('job_title'))? old('job_title'): '';
                            $first_name = !is_null(old('first_name'))? old('first_name'): '';
                            $family_name = !is_null(old('family_name'))? old('family_name'): '';
                            $email = !is_null(old('email'))? old('email'): '';
                            $phone_number = !is_null(old('phone_number'))? old('phone_number'): '';
                            $inquiry = !is_null(old('inquiry'))? old('inquiry'): '';
                        @endphp
                        <div class="row">
                            <div class="mx-3 my-3 px-2 py-2 bg-light">
                                <span class="text-success ml-2"><i class="fas fa-asterisk"></i></span>{{ __(' : REQUIRED') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="company_name">{{ __('Company Name') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span></label>
                                <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ $company_name }}" required>
                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="department_section">{{ __('Department / Section') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span></label>
                                <input id="department_section" type="text" class="form-control{{ $errors->has('department_section') ? ' is-invalid' : '' }}" name="department_section" value="{{ $department_section }}" required>
                                @if ($errors->has('department_section'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department_section') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="job_title">{{ __('Job Title') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span></label>
                                <input id="job_title" type="text" class="form-control{{ $errors->has('job_title') ? ' is-invalid' : '' }}" name="job_title" value="{{ $job_title }}" required>
                                @if ($errors->has('job_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first_name">{{ __('First Name') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span></label>
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $first_name }}" required>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="family_name">{{ __('Family Name') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span></label>
                                <input id="family_name" type="text" class="form-control{{ $errors->has('family_name') ? ' is-invalid' : '' }}" name="family_name" value="{{ $family_name }}" required>
                                @if ($errors->has('family_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="email">{{ __('E-mail') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span></label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="phone_number">{{ __('Phone Number') }}</label>
                                <input id="email" type="tel" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ $phone_number }}">
                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="inquiry">{{ __('Inquiry (Less than 300 Letters)') }}<span class="text-success ml-2"><i class="fas fa-asterisk"></i></span></label>
                                <textarea id="inquiry" class="countable-text form-control{{ $errors->has('inquiry') ? ' is-invalid' : '' }}" name="inquiry" rows="8" data-max="300" required>{{ $inquiry }}</textarea>
                                @if ($errors->has('inquiry'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('inquiry') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--  reCAPTCHA   --
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ env("GRECAPTCHA_SITE_KEY") }}', {action: 'homepage'})
        .then(function(token) {
            // Verify the token on the server.
            $('#form-inquiry-submit').append($('<input>').attr({'type': 'hidden', 'name': 'grecaptcha'}).val(token));
            $('#form-inquiry-submit').prop('disabled', false);
        });
    });
</script>
                        <button id="form-inquiry-submit" type="submit" name="submit" class="btn btn-primary" disabled>{{ __('Send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection

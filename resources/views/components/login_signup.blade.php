<!-- Modal -->
<div class="modal fade" id="login-signup-modal" tabindex="-1" role="dialog" aria-labelledby="login-signup-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="login-signup-title">{{ __('Log In / Sing Up') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center my-3">
                            <h4>{{ __('To continue, log in or create account') }}</h4>
                        </div>
                        <div class="col-12 text-center">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">{{ __('Log In') }}</a>
                        </div>
                        <div class="col-12 text-center">
                            <h5 class="my-2">or</h5>
                        </div>
                        <div class="col-12 text-center">
                            <a href="{{ route('register') }}" class="btn btn-success btn-lg">{{ __('Sign Up (FREE)') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

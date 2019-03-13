@if (is_null($has_requested))
@elseif ($has_requested)
    <div class="row justify-content-center">
        <div class="col-xs-12">
            <button class="btn btn-success" disabled>{{ __('REQUESTED') }}</button>
        </div>
    </div>
@else
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h3>WANT TO CONTACT ? / NEED FURTHER INFORMATION ?</h3>
        </div>
    </div>
    @if ($errors->has('name'))
        <div class="alert alert-danger alert-dismissible fade show fixed-top mt-5 mx-5" role="alert">
            {{ __('Unknown Error happened.') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($errors->has('is_further_information') || $errors->has('is_contact'))
        <div class="alert alert-danger alert-dismissible fade show fixed-top mt-5 mx-5" role="alert">
            {{ __('Please check "NEED FURTHER DETAILS OF HIM/HER/THEM" or "NEED CONTACT INFORMATION".') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{ url('matches/request') }}" method="post" id="form-request">
        @csrf
        @method('POST')
        <input type=hidden name="name" value="{{ $target_user_name }}">
        <div class="row justify-content-center">
            <div class="col-xs-12 h5 px-3 py-2">
                <div class="form-check form-check-inline py-2">
                    <input class="form-check-input" type="checkbox" name="is_further_information" value="{{ intval(TRUE) }}" {{ $is_further_information? "checked":"" }}>
                    <label class="form-check-label">NEED FURTHER DETAILS OF HIM/HER/THEM</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="is_contact" value="{{ intval(TRUE) }}" {{ $is_contact? "checked":"" }}>
                    <label class="form-check-label">NEED CONTACT INFORMATION</label>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12">
                <button class="btn btn-success">{{ __('REQUEST') }}</button>
            </div>
        </div>
    </form>
@endif

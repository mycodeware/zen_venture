<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Investor;
use App\Company;
use App\Entrepreneur;
use App\Freelancer;
use Illuminate\Support\Facades\Storage;

class IdentityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $filename)
    {
        $user = \Auth::user();
        switch ($user->type) {
            case User::TYPE_INVESTOR:
                $user_details = Investor::where('user_id', $user->id)->first();
                break;

            case User::TYPE_COMPANY:
                $user_details = Company::where('user_id', $user->id)->first();
                break;

            case User::TYPE_ENTREPRENEUR:
                $user_details = Entrepreneur::where('user_id', $user->id)->first();
                break;

            case User::TYPE_FREELANCER:
                $user_details = Freelancer::where('user_id', $user->id)->first();
                break;

            default:
                abort(403);
                break;
        }
        if (is_null($user_details) || !isset($user_details->identity_filename) || is_null($user_details->identity_filename)) {
            abort(403);
        }
        if ($user_details->identity_filename != $filename) {
            abort(403);
        }
        return Storage::disk('local')->response('identity/'.$user_details->identity_filename);
    }

}

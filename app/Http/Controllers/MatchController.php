<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\UserPurpose;
use App\UserCategory;
use App\Investor;
use App\Company;
use App\Entrepreneur;
use App\Freelancer;
use App\MatchRequest;

class MatchController extends Controller
{
    const TYPE_THEADS = [
        User::TYPES[User::TYPE_INVESTOR]['abbr'] => ['COMPANY', 'COUNTRY', 'TARGET ROUND', 'INVESTMENT SCALE'],
        User::TYPES[User::TYPE_COMPANY]['abbr'] => ['COMPANY', 'COUNTRY', 'PURPOSE HERE'],
        User::TYPES[User::TYPE_ENTREPRENEUR]['abbr'] => ['COMPANY', 'COUNTRY', 'ROUND', 'PURPOSE HERE'],
        User::TYPES[User::TYPE_FREELANCER]['abbr'] => ['COUNTRY', 'PROFESSION', 'QUALIFICATION/SKILLS', 'PURPOSE HERE']
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $title = config('app.name').' - Match Making';
        $user = \Auth::user();
        $purposes = UserPurpose::where('user_id', $user->id)->get();
        $selectable_types = [];
        foreach (User::MATCH_TYPES_PURPOSES as $type_list => $types_purposes) {
            foreach ($types_purposes as $type => $type_purposes) {
                if ($type == $user->type) {
                    foreach ($type_purposes as $purpose) {
                        if ($purposes->contains('purpose_id', $purpose)) $selectable_types[User::TYPES[$type_list]['abbr']] = User::TYPE_LIST[$type_list];
                    }
                }
            }
        }
        $ini_params = [];
        $ini_params['type'] = isset($request->type)? $request->type: '';
        $ini_params['page'] = isset($request->page)? $request->page: '';
        $ini_params['country'] = isset($request->country)? $request->country: '';
        $ini_params['round'] = isset($request->round)? $request->round: '';
        $ini_params['profession'] = isset($request->profession)? $request->profession: '';
        $ini_params['purpose'] = isset($request->purpose)? $request->purpose: '';
        $countries = countries();
        $countries = array_column($countries, 'name', 'iso_3166_1_alpha2');
        natcasesort($countries);
        $types_purposes = [];
        foreach (User::TYPES_PURPOSES as $type => $type_purposes) {
            $abbr = User::TYPES[$type]['abbr'];
            $types_purposes[$abbr] = [];
            foreach ($type_purposes as $purpose_id) {
                $types_purposes[$abbr][$purpose_id] = User::PURPOSES[$purpose_id];
            }
        }
        return view('match.index', [
            'purposes' => $purposes,
            'type' => $user->type,
            'selectable_types' => $selectable_types,
            'type_theads' => self::TYPE_THEADS,
            'ini_params' => $ini_params,
            'title' => $title,
            'countries' => $countries,
            'types_purposes' => $types_purposes,
        ]);
    }

    public function show($name)
    {
        $title = config('app.name').' - Match Making Details';
        $user = \Auth::user();
        $target_user = User::where('name', $name)->first();
        if ($target_user->status != User::STATUS_ACTIVE) return abort(403);

        switch ($target_user->type) {
            case User::TYPE_INVESTOR:
                $target_user_type = Investor::where('user_id', $target_user->id)->first();
                break;
            case User::TYPE_COMPANY:
                $target_user_type = Company::where('user_id', $target_user->id)->first();
                break;
            case User::TYPE_ENTREPRENEUR:
                $target_user_type = Entrepreneur::where('user_id', $target_user->id)->first();
                break;
            case User::TYPE_FREELANCER:
                $target_user_type = Freelancer::where('user_id', $target_user->id)->first();
                break;
            default:
                abort(403);
                break;
        }
        if (is_null($target_user_type)) return abort(403);

        // Valid access?
        $is_valid = false;
        if ($user->id == $target_user->user_id) {
        } else {
            $user_purposes = UserPurpose::where('user_id', $user->id)->get();
            foreach (User::MATCH_TYPES_PURPOSES as $type => $types_purposes) {
                foreach ($types_purposes as $type_who => $type_purposes) {
                    if ($type_who != $user->type) continue;
                    foreach ($type_purposes as $purpose) {
                        if ($user_purposes->contains('purpose_id', $purpose) && $type == $target_user->type) {
                            $is_valid = true;
                            break;
                        }
                    }
                }
            }
        }
        if (is_null($target_user_type->starred)) {
            if (!$is_valid) abort(403);
        } else {
        }
        $has_requested = $is_valid? MatchRequest::where(['from_user_id' => $user->id, 'to_user_id' => $target_user->id])->exists(): null;

        $purposes = UserPurpose::where('user_id', $target_user->id)->get();
        switch ($target_user->type) {
            case User::TYPE_INVESTOR:
                // Angel Investor/VC/CVC/PE
                $country = country($target_user_type->country_code);
                return view('match.investor', [
                    'investor' => $target_user_type,
                    'purposes' => $purposes,
                    'type' => $target_user->type,
                    'country' => $country->getName(),
                    'has_requested' => $has_requested,
                    'title' => $title,
                ]);
                break;
            case User::TYPE_COMPANY:
                // Large scale company/SME
                $country = country($target_user_type->country_code);
                $categories = UserCategory::where('user_id', $target_user->id)->get();
                return view('match.company', [
                    'company' => $target_user_type,
                    'purposes' => $purposes,
                    'type' => $target_user->type,
                    'country' => $country->getName(),
                    'categories' => $categories,
                    'has_requested' => $has_requested,
                    'title' => $title,
                ]);
                break;
            case User::TYPE_ENTREPRENEUR:
                // Startup/Entrepreneur
                $country = country($target_user_type->country_code);
                $categories = UserCategory::where('user_id', $target_user->id)->get();
                return view('match.entrepreneur', [
                    'entrepreneur' => $target_user_type,
                    'purposes' => $purposes,
                    'type' => $target_user->type,
                    'country' => $country->getName(),
                    'categories' => $categories,
                    'has_requested' => $has_requested,
                    'title' => $title,
                ]);
                break;

            case User::TYPE_FREELANCER:
                // Professional/Freelancer
                $country = country($target_user_type->country_code);
                return view('match.freelancer', [
                    'freelancer' => $target_user_type,
                    'purposes' => $purposes,
                    'type' => $target_user->type,
                    'country' => $country->getName(),
                    'has_requested' => $has_requested,
                    'title' => $title,
                ]);
                break;

            default:
                break;
        }
        abort(403);
    }

    public function request(Request $request)
    {
        $title = config('app.name').' - Thank you for your request';
        $user = \Auth::user();
        $validation = [
            'name' => 'required|string|exists:users',
            'is_contact' => 'required_without_all:is_further_information|boolean',
            'is_further_information' => 'required_without_all:is_contact|boolean',
        ];
        Validator::make($request->all(), $validation)->validate();

        $target_user = User::where('name', $request->name)->first();
        // Valid access?
        if ($target_user->status != User::STATUS_ACTIVE) abort(403);
        if ($user->id == $target_user->user_id) abort(403);
        $is_valid = false;
        $user_purposes = UserPurpose::where('user_id', $user->id)->get();
        foreach (User::MATCH_TYPES_PURPOSES as $type => $types_purposes) {
            foreach ($types_purposes as $type_who => $type_purposes) {
                if ($type_who != $user->type) continue;
                foreach ($type_purposes as $purpose) {
                    if ($user_purposes->contains('purpose_id', $purpose) && $type == $target_user->type) {
                        $is_valid = true;
                        break;
                    }
                }
            }
        }
        if (!$is_valid) abort(403);
        // Already exist?
        if (MatchRequest::where(['from_user_id' => $user->id, 'to_user_id' => $target_user->id])->exists()) {
            abort(403);
        }
        $match_request = new MatchRequest;
        $match_request->from_user_id = $user->id;
        $match_request->to_user_id = $target_user->id;
        $match_request->is_contact = $request->is_contact;
        $match_request->is_further_information = $request->is_further_information;
        $match_request->save();

        return view('match.requested', [
            'requested_user' => $target_user,
            'title' => $title,
        ]);
    }
}

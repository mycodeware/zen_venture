<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserPurpose;
use App\Investor;
use App\Company;
use App\Entrepreneur;
use App\Freelancer;

class MatchedListController extends Controller
{

    const RECORD_COUNT_PAGE = 20;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getList(Request $request, $type)
    {
        $user = \Auth::user();
        $data = [];
        $type_id = null;
        foreach (User::TYPES as $key => $type_data) {
            if ($type_data['abbr'] == $type) {
                $type_id = $key;
                break;
            }
        }
        if (is_null($type_id)) abort(403);
        $purposes = UserPurpose::where('user_id', $user->id)->get();
        if (is_null($purposes) || !isset(User::MATCH_TYPES_PURPOSES[$type_id]) || !isset(User::MATCH_TYPES_PURPOSES[$type_id][$user->type])) abort(403);
        $is_valid = false;
        foreach (User::MATCH_TYPES_PURPOSES[$type_id][$user->type] as $value) {
            if ($purposes->contains('purpose_id', $value)) {
                $is_valid = true;
                break;
            }
        }
        if (!$is_valid) abort(403);
        $filters = [];
        switch ($type_id) {
            case User::TYPE_INVESTOR:
                if (isset($request->country) && $request->country != '') array_push($filters, ['country_code', $request->country]);
                if (isset($request->round) && $request->round != '') {
                    array_push($filters, ['round_start', '<=', $request->round]);
                    array_push($filters, ['round_end', '>=', $request->round]);
                }
                $query = Investor::select(
                    'user_id', 'identified', 'company_name', 'country_code',
                    'round_start',
                    'round_end',
                    'scale_start',
                    'scale_end'
                )->whereNotIn('user_id', [$user->id])->where($filters)->with('user')->has('user')->orderByRaw('case identified when '.User::IDENTIFY_IDENTIFIED.' then 1 else 2 end')->orderBy('pv_monthly', 'DESC')->orderBy('updated_at', 'DESC');
                $data = $query->paginate(self::RECORD_COUNT_PAGE);
                break;

            case User::TYPE_COMPANY:
                if (isset($request->country) && $request->country != '') array_push($filters, ['country_code', $request->country]);
                $query = Company::select(
                    'user_id', 'identified', 'company_name', 'country_code'
                )->whereNotIn('user_id', [$user->id])->where($filters)->with(['user', 'purposes'])->has('user')->orderByRaw('case identified when '.User::IDENTIFY_IDENTIFIED.' then 1 else 2 end')->orderBy('pv_monthly', 'DESC')->orderBy('updated_at', 'DESC');
                if (isset($request->purpose) && $request->purpose != '') {
                    $query->whereHas('purposes', function ($related_query) use ($request) {
                        $related_query->where('purpose_id', '=', $request->purpose);
                    });
                }
                $data = $query->paginate(self::RECORD_COUNT_PAGE);
                break;

            case User::TYPE_ENTREPRENEUR:
                if (isset($request->country) && $request->country != '') array_push($filters, ['country_code', $request->country]);
                if (isset($request->round) && $request->round != '') array_push($filters, ['investment_round', $request->round]);
                $query = Entrepreneur::select(
                    'user_id', 'identified', 'company_name', 'country_code',
                    'investment_round'
                )->whereNotIn('user_id', [$user->id])->where($filters)->with(['user', 'purposes'])->has('user')->orderByRaw('case identified when '.User::IDENTIFY_IDENTIFIED.' then 1 else 2 end')->orderBy('pv_monthly', 'DESC')->orderBy('updated_at', 'DESC');
                if (isset($request->purpose) && $request->purpose != '') {
                    $query->whereHas('purposes', function ($related_query) use ($request) {
                        $related_query->where('purpose_id', '=', $request->purpose);
                    });
                }
                $data = $query->paginate(self::RECORD_COUNT_PAGE);
                break;

            case User::TYPE_FREELANCER:
                if (isset($request->country) && $request->country != '') array_push($filters, ['country_code', $request->country]);
                if (isset($request->profession) && $request->profession != '') array_push($filters, ['profession', $request->profession]);
                $query = Freelancer::select(
                    'user_id', 'identified', 'country_code',
                    'profession', 'qualification'
                )->whereNotIn('user_id', [$user->id])->where($filters)->with(['user', 'purposes'])->has('user')->orderByRaw('case identified when '.User::IDENTIFY_IDENTIFIED.' then 1 else 2 end')->orderBy('pv_monthly', 'DESC')->orderBy('updated_at', 'DESC');
                if (isset($request->purpose) && $request->purpose != '') {
                    $query->whereHas('purposes', function ($related_query) use ($request) {
                        $related_query->where('purpose_id', '=', $request->purpose);
                    });
                }
                $data = $query->paginate(self::RECORD_COUNT_PAGE);
                break;

            default:
                abort(403);
                break;
        }
        return $data;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Investor;
use App\Company;
use App\Entrepreneur;
use App\Freelancer;
use App\Field;
use App\Category;
use App\UserPurpose;
use App\UserCategory;
use App\UserProfession;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = config('app.name').' - My Page';
        $user = \Auth::user();
        switch ($user->type) {
            case User::TYPE_INVESTOR:
                // Angel Investor/VC/CVC/PE
                $investor = Investor::where('user_id', $user->id)->with('user_all', 'purposes')->first();
                if (is_null($investor)) return redirect()->action('DashboardController@edit');
                $entity = new Investor();
                $entity->flushEventListeners();
                $completion = self::calcCompletion($entity->where('user_id', $user->id)->first());
                return view('dashboard.investor.index', [
                    'investor' => $investor,
                    'completion' => $completion,
                    'title' => $title,
                ]);
                break;
            case User::TYPE_COMPANY:
                // Large scale company/SME
                $company = Company::where('user_id', $user->id)->with('user_all', 'purposes', 'categories_all.category.field')->first();
                if (is_null($company)) return redirect()->action('DashboardController@edit');
                $entity = new Company();
                $entity->flushEventListeners();
                $completion = self::calcCompletion($entity->where('user_id', $user->id)->with('categories_all')->first());
                return view('dashboard.company.index', [
                    'company' => $company,
                    'completion' => $completion,
                    'title' => $title,
                ]);
                break;
            case User::TYPE_ENTREPRENEUR:
                // Startup/Entrepreneur
                $entrepreneur = Entrepreneur::where('user_id', $user->id)->with('user_all', 'purposes', 'categories_all.category.field')->first();
                if (is_null($entrepreneur)) return redirect()->action('DashboardController@edit');
                $entity = new Entrepreneur();
                $entity->flushEventListeners();
                $completion = self::calcCompletion($entity->where('user_id', $user->id)->with('categories_all')->first());
                return view('dashboard.entrepreneur.index', [
                    'entrepreneur' => $entrepreneur,
                    'completion' => $completion,
                    'title' => $title,
                ]);
                break;

            case User::TYPE_FREELANCER:
                // Professional/Freelancer
                $freelancer = Freelancer::where('user_id', $user->id)->with('user_all', 'purposes')->first();
                if (is_null($freelancer)) return redirect()->action('DashboardController@edit');
                $entity = new Freelancer();
                $entity->flushEventListeners();
                $completion = self::calcCompletion($entity->where('user_id', $user->id)->first());
                return view('dashboard.freelancer.index', [
                    'freelancer' => $freelancer,
                    'completion' => $completion,
                    'title' => $title,
                ]);
                break;

            default:
                break;
        }
        abort(403);
    }

    protected function calcCompletion($entity)
    {
        $except_column = [
            'user_id', 'starred', 'trusted', 'created_at', 'updated_at',
        ];
        $completion = null;
        $entity_array = $entity->toArray();
        $entity_array = array_except($entity_array, $except_column);
        $entity_filled_array = array_where($entity_array, function ($value, $key) {
            return !is_null($value) && $value !== '' && (!is_array($value) || (is_array($value) && count($value) > 0));
        });
        if (count($entity_array) != 0) $completion = floor( count($entity_filled_array) / count($entity_array) * 100 );

        return $completion;
    }

    public function edit()
    {
        $title = config('app.name').' - Edit';
        $user = \Auth::user();
        $purposes = UserPurpose::where('user_id', $user->id)->get()->pluck('purpose_id')->all();
        $countries = countries();
        $countries = array_column($countries, 'name', 'iso_3166_1_alpha2');
        natcasesort($countries);
        switch ($user->type) {
            case User::TYPE_INVESTOR:
                // Angel Investor/VC/CVC/PE
                $investor = Investor::firstOrNew(['user_id' => $user->id]);
                return view('dashboard.investor.edit', [
                    'investor' => $investor,
                    'purposes' => $purposes,
                    'type' => $user->type,
                    'countries' => $countries,
                    'title' => $title,
                ]);
                break;

            case User::TYPE_COMPANY:
                // Large scale company/SME
                $company = Company::firstOrNew(['user_id' => $user->id]);
                $user_categories = UserCategory::where('user_id', $user->id)->get();
                return view('dashboard.company.edit', [
                    'company' => $company,
                    'purposes' => $purposes,
                    'type' => $user->type,
                    'countries' => $countries,
                    'fields' => Field::all(),
                    'categories' => Category::all(),
                    'user_categories' => $user_categories,
                    'title' => $title,
                ]);
                break;

            case User::TYPE_ENTREPRENEUR:
                // Startup/Entrepreneur
                $entrepreneur = Entrepreneur::firstOrNew(['user_id' => $user->id]);
                $user_categories = UserCategory::where('user_id', $user->id)->get();
                return view('dashboard.entrepreneur.edit', [
                    'entrepreneur' => $entrepreneur,
                    'purposes' => $purposes,
                    'type' => $user->type,
                    'countries' => $countries,
                    'fields' => Field::all(),
                    'categories' => Category::all(),
                    'user_categories' => $user_categories,
                    'title' => $title,
                ]);
                break;

            case User::TYPE_FREELANCER:
                // Professional/Freelancer
                $freelancer = Freelancer::with(['professions_all'])->firstOrNew(['user_id' => $user->id]);
                return view('dashboard.freelancer.edit', [
                    'freelancer' => $freelancer,
                    'purposes' => $purposes,
                    'type' => $user->type,
                    'countries' => $countries,
                    'title' => $title,
                ]);
                break;

            default:
                break;
        }
        return abort(403);
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        switch ($user->type) {
            case User::TYPE_INVESTOR:
                // Angel Investor/VC/CVC/PE
                $investor = Investor::find($user->id);
                $validation =
                !is_null($investor)? [
                    'purposes' => 'required_with:purpose|array|max:3',
                    'purposes.*' => 'numeric|in:'.implode(array_keys(User::PURPOSES), ','),
                    'first_name' => 'required|string|max:255',
                    'family_name' => 'required|string|max:255',
                    'country_code' => 'required|string|max:2',
                    'address' => 'nullable|string|max:255',
                    'company_name' => 'required|string|max:255',
                    'website' => 'nullable|url|max:255',
                    'investment_policy' => 'nullable|string|max:300',
                    'business_area' => 'nullable|string|max:100',
                    'round_start' => 'required|in:'.implode(array_keys(User::INVESTMENT_ROUNDS), ','),
                    'round_end' => 'required|in:'.implode(array_keys(User::INVESTMENT_ROUNDS), ','),
                    'scale_start' => 'required|in:'.implode(array_keys(User::INVESTMENT_RANGE), ','),
                    'scale_end' => 'required|in:'.implode(array_keys(User::INVESTMENT_RANGE), ','),
                    'track_record' => 'nullable|string|max:300',
                    'has_invested' => 'required|boolean',
                ]
                : [
                    'first_name' => 'required|string|max:255',
                    'family_name' => 'required|string|max:255',
                    'country_code' => 'required|string|max:2',
                    'company_name' => 'required|string|max:255',
                    'round_start' => 'required|in:'.implode(array_keys(User::INVESTMENT_ROUNDS), ','),
                    'round_end' => 'required|in:'.implode(array_keys(User::INVESTMENT_ROUNDS), ','),
                    'scale_start' => 'required|in:'.implode(array_keys(User::INVESTMENT_RANGE), ','),
                    'scale_end' => 'required|in:'.implode(array_keys(User::INVESTMENT_RANGE), ','),
                ];
                Validator::make($request->all(), $validation)->validate();
                if (isset($request->purpose)) {
                    UserPurpose::where('user_id', $user->id)->delete();
                    if (isset($request->purposes) && is_array($request->purposes) && count($request->purposes) > 0) {
                        foreach ($request->purposes as $purpose_id) {
                            $purpose = new UserPurpose;
                            $purpose->user_id = $user->id;
                            $purpose->purpose_id = $purpose_id;
                            $purpose->save();
                        }
                    }
                }
                if (is_null($investor)) {
                    $investor = new Investor;
                    $investor->user_id = $user->id;
                }
                // Deny updating First name and Family name
                if ($investor->identified == User::IDENTIFY_IDENTIFIED) {
                    $request->first_name = $investor->first_name;
                    $request->family_name = $investor->family_name;
                }
                $investor->first_name = $request->first_name;
                $investor->family_name = $request->family_name;
                $investor->country_code = $request->country_code;
                $investor->address = $request->address;
                $investor->company_name = $request->company_name;
                $investor->website = $request->website;
                $investor->investment_policy = $request->investment_policy;
                $investor->business_area = $request->business_area;
                $investor->round_start = $request->round_start;
                $investor->round_end = $request->round_end;
                $investor->scale_start = $request->scale_start;
                $investor->scale_end = $request->scale_end;
                $investor->track_record = $request->track_record;
                $investor->has_invested = $request->has_invested;
                $investor->save();
                break;

            case User::TYPE_COMPANY:
                // Large scale company/SME
                $company = Company::find($user->id);
                $validation =
                !is_null($company)? [
                    'purposes' => 'required_with:purpose|array|max:3',
                    'purposes.*' => 'numeric|in:'.implode(array_keys(User::PURPOSES), ','),
                    'first_name' => 'required|string|max:255',
                    'family_name' => 'required|string|max:255',
                    'position' => 'nullable|string|max:255',
                    'department' => 'nullable|string|max:255',
                    'company_name' => 'required|string|max:255',
                    'website' => 'nullable|url|max:255',
                    'country_code' => 'required|string|max:2',
                    'address' => 'nullable|string|max:255',
                    'founded_date' => 'nullable|date',
                    'field' => 'required|numeric',
                    'categories' => 'required|array|max:3',
                    'categories.*' => 'numeric',
                    'remarks' => 'nullable|array',
                    'remarks.*' => 'nullable|string|max:255',
                    'revenue_scale' => 'required|in:'.implode(array_keys(User::REVENUE_SCALE), ','),
                    'capital_scale' => 'required|in:'.implode(array_keys(User::CAPITAL_SCALE), ','),
                    'employee_number' => 'required|in:'.implode(array_keys(User::EMPLOYEE_NUMBER), ','),
                    'briefing_business' => 'nullable|string|max:100',
                    'briefing_service' => 'nullable|string|max:300',
                    'purpose_message' => 'nullable|string|max:300',
                    'appeal_message' => 'nullable|string|max:300',
                ]
                : [
                    'first_name' => 'required|string|max:255',
                    'family_name' => 'required|string|max:255',
                    'country_code' => 'required|string|max:2',
                    'company_name' => 'required|string|max:255',
                ];
                Validator::make($request->all(), $validation)->validate();
                if (isset($request->purpose)) {
                    UserPurpose::where('user_id', $user->id)->delete();
                    if (isset($request->purposes) && is_array($request->purposes) && count($request->purposes) > 0) {
                        foreach ($request->purposes as $purpose_id) {
                            $purpose = new UserPurpose;
                            $purpose->user_id = $user->id;
                            $purpose->purpose_id = $purpose_id;
                            $purpose->save();
                        }
                    }
                }
                if (is_null($company)) {
                    $company = new Company;
                    $company->user_id = $user->id;
                }
                // Deny updating First name and Family name
                if ($company->identified == User::IDENTIFY_IDENTIFIED) {
                    $request->first_name = $company->first_name;
                    $request->family_name = $company->family_name;
                }
                $company->first_name = $request->first_name;
                $company->family_name = $request->family_name;
                $company->position = $request->position;
                $company->department = $request->department;
                $company->company_name = $request->company_name;
                $company->website = $request->website;
                $company->country_code = $request->country_code;
                $company->address = $request->address;
                $company->founded_date = (!is_null($request->founded_date))? date('Y-m-d', strtotime($request->founded_date)): $request->founded_date;
                $company->revenue_scale = $request->revenue_scale;
                $company->capital_scale = $request->capital_scale;
                $company->employee_number = $request->employee_number;
                $company->briefing_business = $request->briefing_business;
                $company->briefing_service = $request->briefing_service;
                $company->purpose_message = $request->purpose_message;
                $company->appeal_message = $request->appeal_message;
                $company->save();

                UserCategory::where('user_id', $user->id)->delete();
                if (isset($request->categories) && is_array($request->categories) && count($request->categories) > 0) {
                    foreach ($request->categories as $category_id) {
                        $category = new UserCategory;
                        $category->user_id = $user->id;
                        $category->category_id = $category_id;
                        if (isset($request->remarks[$category_id]) && !is_null($request->remarks[$category_id])) $category->remark = $request->remarks[$category_id];
                        $category->save();
                    }
                }
                break;

            case User::TYPE_ENTREPRENEUR:
                // Startup/Entrepreneur
                $entrepreneur = Entrepreneur::find($user->id);
                $validation =
                !is_null($entrepreneur)? [
                    'purposes' => 'required_with:purpose|array|max:3',
                    'purposes.*' => 'numeric|in:'.implode(array_keys(User::PURPOSES), ','),
                    'first_name' => 'required|string|max:255',
                    'family_name' => 'required|string|max:255',
                    'country_code' => 'required|string|max:2',
                    'company_name' => 'required|string|max:255',
                    'company_website' => 'nullable|url|max:255',
                    'company_address' => 'nullable|string|max:255',
                    'founded_date' => 'nullable|date',
                    'number_of_members' => 'nullable|numeric',
                    'company_vision' => 'nullable|string|max:300',
                    'field' => 'required|numeric',
                    'categories' => 'required|array|max:3',
                    'categories.*' => 'numeric',
                    'remarks' => 'nullable|array',
                    'remarks.*' => 'nullable|string|max:255',
                    'board_members' => 'nullable|string|max:500',
                    'briefing' => 'nullable|string|max:500',
                    'target_customers' => 'nullable|string|max:500',
                    'value_proposition' => 'nullable|string|max:300',
                    'competitors' => 'nullable|string|max:300',
                    'revenue_cost' => 'nullable|string|max:100',
                    'is_fundraising' => 'required|boolean',
                    'investment_round' => 'required|in:'.implode(array_keys(User::INVESTMENT_ROUNDS), ','),
                    'has_investor' => 'required|boolean',
                    'investors' => 'nullable|string|max:100',
                    'funding_amount' => 'required|in:'.implode(array_keys(User::INVESTMENT_SCALE), ','),
                    'desired_help' => 'nullable|string|max:300',
                    'messages' => 'nullable|string|max:300',
                ]
                : [
                    'first_name' => 'required|string|max:255',
                    'family_name' => 'required|string|max:255',
                    'country_code' => 'required|string|max:2',
                    'company_name' => 'required|string|max:255',
                    'investment_round' => 'required|in:'.implode(array_keys(User::INVESTMENT_ROUNDS), ','),
                ];
                Validator::make($request->all(), $validation)->validate();
                if (isset($request->purpose)) {
                    UserPurpose::where('user_id', $user->id)->delete();
                    if (isset($request->purposes) && is_array($request->purposes) && count($request->purposes) > 0) {
                        foreach ($request->purposes as $purpose_id) {
                            $purpose = new UserPurpose;
                            $purpose->user_id = $user->id;
                            $purpose->purpose_id = $purpose_id;
                            $purpose->save();
                        }
                    }
                }
                if (is_null($entrepreneur)) {
                    $entrepreneur = new Entrepreneur;
                    $entrepreneur->user_id = $user->id;
                }
                // Deny updating First name and Family name
                if ($entrepreneur->identified == User::IDENTIFY_IDENTIFIED) {
                    $request->first_name = $entrepreneur->first_name;
                    $request->family_name = $entrepreneur->family_name;
                }
                $entrepreneur->first_name = $request->first_name;
                $entrepreneur->family_name = $request->family_name;
                $entrepreneur->country_code = $request->country_code;
                $entrepreneur->company_name = $request->company_name;
                $entrepreneur->company_website = $request->company_website;
                $entrepreneur->company_address = $request->company_address;
                $entrepreneur->founded_date = (!is_null($request->founded_date))? date('Y-m-d', strtotime($request->founded_date)): $request->founded_date;
                $entrepreneur->number_of_members = $request->number_of_members;
                $entrepreneur->company_vision = $request->company_vision;
                $entrepreneur->board_members = $request->board_members;
                $entrepreneur->briefing = $request->briefing;
                $entrepreneur->target_customers = $request->target_customers;
                $entrepreneur->value_proposition = $request->value_proposition;
                $entrepreneur->competitors = $request->competitors;
                $entrepreneur->revenue_cost = $request->revenue_cost;
                $entrepreneur->is_fundraising = $request->is_fundraising;
                $entrepreneur->investment_round = $request->investment_round;
                $entrepreneur->has_investor = $request->has_investor;
                $entrepreneur->investors = $request->investors;
                $entrepreneur->funding_amount = $request->funding_amount;
                $entrepreneur->desired_help = $request->desired_help;
                $entrepreneur->messages = $request->messages;
                $entrepreneur->save();

                UserCategory::where('user_id', $user->id)->delete();
                if (isset($request->categories) && is_array($request->categories) && count($request->categories) > 0) {
                    foreach ($request->categories as $category_id) {
                        $category = new UserCategory;
                        $category->user_id = $user->id;
                        if (isset($request->remarks[$category_id]) && !is_null($request->remarks[$category_id])) $category->remark = $request->remarks[$category_id];
                        $category->category_id = $category_id;
                        $category->save();
                    }
                }
                break;

            case User::TYPE_FREELANCER:
                // Professional/Freelancer
                $freelancer = Freelancer::find($user->id);
                $validation =
                !is_null($freelancer)? [
                    'purposes' => 'required_with:purpose|array|max:3',
                    'purposes.*' => 'numeric|in:'.implode(array_keys(User::PURPOSES), ','),
                    'first_name' => 'required|string|max:255',
                    'family_name' => 'required|string|max:255',
                    'country_code' => 'required|string|max:2',
                    'address' => 'nullable|string|max:255',
                    'age' => 'required|in:'.implode(array_keys(User::AGE_RANGE), ','),
                    'website' => 'nullable|url|max:255',
                    'career' => 'nullable|string|max:500',
                    'profession' => 'required|in:'.implode(array_keys(User::PROFESSIONS), ','),
                    'profession_remark' => 'nullable|string|max:255',
                    'qualification' => 'required|string|max:100',
                    'strength' => 'nullable|string|max:300',
                    'purpose_message' => 'nullable|string|max:300',
                    'appeal_message' => 'nullable|string|max:300',
                ]
                : [
                    'first_name' => 'required|string|max:255',
                    'family_name' => 'required|string|max:255',
                    'country_code' => 'required|string|max:2',
                    'profession' => 'required|in:'.implode(array_keys(User::PROFESSIONS), ','),
                    'profession_remark' => 'nullable|string|max:255',
                    'qualification' => 'required|string|max:100',
                ];
                Validator::make($request->all(), $validation)->validate();
                if (isset($request->purpose)) {
                    UserPurpose::where('user_id', $user->id)->delete();
                    if (isset($request->purposes) && is_array($request->purposes) && count($request->purposes) > 0) {
                        foreach ($request->purposes as $purpose_id) {
                            $purpose = new UserPurpose;
                            $purpose->user_id = $user->id;
                            $purpose->purpose_id = $purpose_id;
                            $purpose->save();
                        }
                    }
                }
                if (is_null($freelancer)) {
                    $freelancer = new Freelancer;
                    $freelancer->user_id = $user->id;
                }
                // Deny updating First name and Family name
                if ($freelancer->identified == User::IDENTIFY_IDENTIFIED) {
                    $request->first_name = $freelancer->first_name;
                    $request->family_name = $freelancer->family_name;
                }
                $freelancer->first_name = $request->first_name;
                $freelancer->family_name = $request->family_name;
                $freelancer->country_code = $request->country_code;
                $freelancer->address = $request->address;
                $freelancer->age = $request->age;
                $freelancer->website = $request->website;
                $freelancer->career = $request->career;
                $freelancer->profession = $request->profession;
                $freelancer->qualification = $request->qualification;
                $freelancer->strength = $request->strength;
                $freelancer->purpose_message = $request->purpose_message;
                $freelancer->appeal_message = $request->appeal_message;
                $freelancer->save();

                UserProfession::where('user_id', $user->id)->delete();
                if (isset($request->profession_remark) && !is_null($request->profession_remark) && User::PROFESSIONS[$request->profession]['enterable'] === true) {
                    $profession = new UserProfession;
                    $profession->user_id = $user->id;
                    $profession->profession_id = $request->profession;
                    $profession->remark = $request->profession_remark;
                    $profession->save();
                }
                break;

            default:
                break;
        }
        return redirect('dashboard');
    }

    public function upload(Request $request)
    {
        $user = \Auth::user();
        Validator::make($request->all(), [
            'image' => 'required|file|image|mimes:jpeg,png|max:5000',
        ])->validate();
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
        if (is_null($user_details)) return redirect()->action('DashboardController@edit');
        if (!is_null($user_details->image_filename) && Storage::exists('public/profile/'.$user_details->image_filename)) {
            Storage::delete('public/profile/'.$user_details->image_filename);
        }
        $filename = $request->image->store('public/profile');
        // Resize
        $max = 300;
        $profile = \Image::make(storage_path('app/').$filename);
        if ($profile->width() >= $profile->height() && $profile->width() > $max) {
            $profile->widen($max)->save();
        } else if ($profile->width() <= $profile->height() && $profile->height() > $max) {
            $profile->heighten($max)->save();
        }
        if (!is_null($filename)) {
            $user_details->image_filename = basename($filename);
            $user_details->save();
        }

        return redirect('dashboard');
    }

    public function deleteImage()
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
        if (is_null($user_details)) return redirect()->action('DashboardController@edit');
        if (!is_null($user_details->image_filename) && Storage::exists('public/profile/'.$user_details->image_filename)) {
            Storage::delete('public/profile/'.$user_details->image_filename);
            $user_details->image_filename = null;
            $user_details->save();
        }

        return redirect('dashboard');
    }

    public function activate()
    {
        $user = \Auth::user();
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        return redirect('dashboard');
    }

    public function deactivate()
    {
        $user = \Auth::user();
        $user->status = User::STATUS_INACTIVE;
        $user->save();

        return redirect('dashboard');
    }

    public function identify(Request $request)
    {
        $title = config('app.name').' - Identify';
        $user = \Auth::user();
        switch ($user->type) {
            case User::TYPE_INVESTOR:
                // Angel Investor/VC/CVC/PE
                $entity = Investor::where('user_id', $user->id)->with('user_all', 'purposes')->first();
                break;
            case User::TYPE_COMPANY:
                // Large scale company/SME
                $entity = Company::where('user_id', $user->id)->with('user_all', 'purposes', 'categories_all.category.field')->first();
                break;
            case User::TYPE_ENTREPRENEUR:
                // Startup/Entrepreneur
                $entity = Entrepreneur::where('user_id', $user->id)->with('user_all', 'purposes', 'categories_all.category.field')->first();
                break;

            case User::TYPE_FREELANCER:
                // Professional/Freelancer
                $entity = Freelancer::where('user_id', $user->id)->with('user_all', 'purposes')->first();
                break;

            default:
                abort(403);
                break;
        }
        if (is_null($entity)) return redirect()->action('DashboardController@edit');
        return view('dashboard.identify', [
            'entity' => $entity,
            'title' => $title,
        ]);
    }

    public function uploadIdentity(Request $request)
    {
        $user = \Auth::user();
        Validator::make($request->all(), [
            'identity' => 'required|file|mimetypes:image/jpeg,image/png,application/pdf|mimes:jpeg,png,pdf|max:5000',
        ])->validate();
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
        if (is_null($user_details)) return redirect()->action('DashboardController@edit');
        // Deny deleting after approval OR pending
        if ($user_details->identified == User::IDENTIFY_IDENTIFIED || $user_details->identified == User::IDENTIFY_PENDING) abort(403);
        if (!is_null($user_details->identity_filename) && Storage::disk('local')->exists('identity/'.$user_details->identity_filename)) {
            Storage::disk('local')->delete('identity/'.$user_details->identity_filename);
        }
        $filename = $request->identity->store('identity', 'local');
        if (!is_null($filename)) {
            $user_details->identified = null;
            $user_details->identity_filename = basename($filename);
            $user_details->save();
        }

        return redirect('dashboard/identify');
    }

    public function deleteIdentity()
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
        if (is_null($user_details)) return redirect()->action('DashboardController@edit');
        // Deny deleting after approval OR pending
        if ($user_details->identified == User::IDENTIFY_IDENTIFIED || $user_details->identified == User::IDENTIFY_PENDING) abort(403);
        if (!is_null($user_details->identity_filename) && Storage::disk('local')->exists('identity/'.$user_details->identity_filename)) {
            Storage::disk('local')->delete('identity/'.$user_details->identity_filename);
            $user_details->identified = null;
            $user_details->identity_filename = null;
            $user_details->save();
        }

        return redirect('dashboard/identify');
    }


}

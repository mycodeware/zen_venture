<?php

namespace App\Admin\Controllers;

use App\User;
use App\Entrepreneur;
use App\UserCategory;
use App\Notifications\IdentifyIdentified;
use App\Notifications\IdentifyRejected;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Admin\Extensions\Starred;
use App\Admin\Extensions\CsvExporter;
use App\Admin\Extensions\Tools\Identify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class EntrepreneurController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Entrepreneur);

        $grid->user_id('User id');
        $grid->user_all()->name('Unique ID');
        $grid->user_all()->status('Status')->display(function($value){
            return $value==User::STATUS_ACTIVE? 'Active': 'Inactive';
        });
        $grid->identified('Identified')->display(function ($value) {
            if ($value == User::IDENTIFY_IDENTIFIED) {
                return "<img src='".asset('img/identified.png')."' style='width:30px'>";
            } else if ($value == User::IDENTIFY_PENDING) {
                return 'Pending';
            } else if ($value == User::IDENTIFY_REJECTED) {
                return 'Rejected';
            } else {
                return '';
            }
        });
        $grid->identity_filename('Identity');
        $grid->starred('Starred')->display(function ($value) {
            return $value? "<span class='h4'><i class='fa fa-star text-yellow'></i></span>": "";
        });
        $grid->pv_monthly('PV Month');
        $grid->pv_total('PV Year');
        $grid->user_all()->email('Email');
        $grid->purposes_all('Purposes')->display(function ($purposes) {
            $purposes_text = '';
            foreach ($purposes as $purpose) {
                $purposes_text .= User::PURPOSES[$purpose['purpose_id']].'<br>';
            }
            return $purposes_text;
        });
        $grid->first_name('First name');
        $grid->family_name('Family name');
        $grid->country_code('Country')->display(function($value){
            return country($value)->getName();
        });
        $grid->company_name('Company name');
        $grid->company_website('Company website');
        $grid->company_address('Company address');
        $grid->founded_date('Founded date');
        $grid->number_of_members('Number of members');
        $grid->company_vision('Company vision')->display(function($value){
            return nl2br(e($value));
        });
        $grid->column('Field of business')->display(function(){
            $categories_text = '';
            $first = UserCategory::where('user_id', $this->user_id)->first();
            if (!is_null($first)) $categories_text .= $first->category->field->field_name.'<br>';
            $categories = UserCategory::where('user_id', $this->user_id)->get();
            foreach ($categories as $category) {
                $categories_text .= $category->category->category_name;
                if (isset($category->remark) && !is_null($category->remark) && $category->remark != '') $categories_text .= ' ('.e($category->remark).')';
                $categories_text .= '<br>';
            }
            return $categories_text;
        });
        $grid->board_members('Board members')->display(function($value){
            return nl2br(e($value));
        });
        $grid->image_filename('Image')->image('/storage/profile');
        $grid->briefing('Briefing')->display(function($value){
            return nl2br(e($value));
        });
        $grid->target_customers('Target customers')->display(function($value){
            return nl2br(e($value));
        });
        $grid->value_proposition('Value proposition')->display(function($value){
            return nl2br(e($value));
        });
        $grid->competitors('Competitors')->display(function($value){
            return nl2br(e($value));
        });
        $grid->revenue_cost('Revenue cost')->display(function($value){
            return nl2br(e($value));
        });
        $grid->is_fundraising('Is fundraising')->display(function($value){
            return $value? 'Engaging in Fundraising': 'Not Engaging in Fundraising';
        });
        $grid->investment_round('Investment round')->display(function($value){
            return !is_null($value)? User::INVESTMENT_ROUNDS[$value]: '';
        });
        $grid->has_investor('Has investor')->display(function($value){
            return $value? 'Yes': 'No';
        });
        $grid->investors('Investors')->display(function($value){
            return nl2br(e($value));
        });
        $grid->funding_amount('Funding amount')->display(function($value){
            return !is_null($value)? User::INVESTMENT_SCALE[$value]: '';
        });
        $grid->desired_help('Desired help')->display(function($value){
            return nl2br(e($value));
        });
        $grid->messages('Messages')->display(function($value){
            return nl2br(e($value));
        });
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            if (!\Admin::user()->isAdministrator()) {
                $actions->disableDelete();
                $actions->disableEdit();
            }
            $actions->append(new Starred($actions));
        });
        if (!\Admin::user()->isAdministrator()) {
            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });
        }
        $grid->filter(function($filter){
            $filter->where(function ($query) {
                switch ($this->input) {
                    case 'active':
                        $query->with('user')->has('user');
                        break;
                    case 'inactive':
                        $query->with('user')->doesntHave('user');
                        break;
                }
            }, 'Status')->radio([
                '' => 'All',
                'active' => 'Active',
                'inactive' => 'Inactive',
            ]);
            $filter->where(function ($query) {
                switch ($this->input) {
                    case 'identified':
                        $query->where('identified', '=', User::IDENTIFY_IDENTIFIED);
                        break;
                    case 'pending':
                        $query->where('identified', '=', User::IDENTIFY_PENDING);
                        break;
                    case 'rejected':
                        $query->where('identified', '=', User::IDENTIFY_REJECTED);
                        break;
                }
            }, 'Identified')->radio([
                '' => 'All',
                'identified' => 'Identified',
                'pending' => 'Pending',
                'rejected' => 'Rejected',
            ]);
            $filter->where(function ($query) {
                switch ($this->input) {
                    case 'yes':
                        // custom complex query if the 'yes' option is selected
                        $query->where('starred', '=', 1);
                        break;
                    case 'no':
                        $query->whereNull('starred');
                        break;
                }
            }, 'Starred')->radio([
                '' => 'All',
                'yes' => 'Starred',
                'no' => 'Non-Starred',
            ]);
        });

        $grid_export = new Grid(new Entrepreneur);
        $grid_export->user_id('User id');
        $grid_export->user_all()->name('Unique ID');
        $grid_export->user_all()->status('Status');
        $grid_export->identified('Identified');
        $grid_export->identity_filename('Identity Filename');
        $grid_export->starred('Starred');
        $grid_export->pv_monthly('PV Month');
        $grid_export->pv_total('PV Year');
        $grid_export->user_all()->email('Email');
        $grid_export->purposes_all('Purposes')->display(function ($purposes) {
            $purposes_text = '';
            foreach ($purposes as $purpose) {
                $purposes_text .= User::PURPOSES[$purpose['purpose_id']]."\n";
            }
            return $purposes_text;
        });
        $grid_export->first_name('First name');
        $grid_export->family_name('Family name');
        $grid_export->country_code('Country')->display(function($value){
            return country($value)->getName();
        });
        $grid_export->company_name('Company name');
        $grid_export->company_website('Company website');
        $grid_export->company_address('Company address');
        $grid_export->founded_date('Founded date');
        $grid_export->number_of_members('Number of members');
        $grid_export->company_vision('Company vision');
        $grid_export->column('Field of business')->display(function(){
            $categories_text = '';
            $first = UserCategory::where('user_id', $this->user_id)->first();
            if (!is_null($first)) $categories_text .= $first->category->field->field_name."\n";
            $categories = UserCategory::where('user_id', $this->user_id)->get();
            foreach ($categories as $category) {
                $categories_text .= $category->category->category_name;
                if (isset($category->remark) && !is_null($category->remark) && $category->remark != '') $categories_text .= ' ('.$category->remark.')';
                $categories_text .= "\n";
            }
            return $categories_text;
        });
        $grid_export->board_members('Board members');
        $grid_export->image_filename('Image');
        $grid_export->briefing('Briefing');
        $grid_export->target_customers('Target customers');
        $grid_export->value_proposition('Value proposition');
        $grid_export->competitors('Competitors');
        $grid_export->revenue_cost('Revenue cost');
        $grid_export->is_fundraising('Is fundraising')->display(function($value){
            return $value? 'Engaging in Fundraising': 'Not Engaging in Fundraising';
        });
        $grid_export->investment_round('Investment round')->display(function($value){
            return !is_null($value)? User::INVESTMENT_ROUNDS[$value]: '';
        });
        $grid_export->has_investor('Has investor')->display(function($value){
            return $value? 'Yes': 'No';
        });
        $grid_export->investors('Investors');
        $grid_export->funding_amount('Funding amount')->display(function($value){
            return !is_null($value)? User::INVESTMENT_SCALE[$value]: '';
        });
        $grid_export->desired_help('Desired help');
        $grid_export->messages('Messages');
        $grid_export->created_at('Created at');
        $grid_export->updated_at('Updated at');
        $grid->exporter(new CsvExporter($grid_export));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Entrepreneur::findOrFail($id));

        $show->user_id('User id');
        $show->user_all()->name('Unique ID');
        $show->user_all()->status('Status')->as(function($value){
            return $value==User::STATUS_ACTIVE? 'Active': 'Inactive';
        });
        $show->identified('Identified')->unescape()->as(function ($value) {
            if ($value == User::IDENTIFY_IDENTIFIED) {
                return "<img src='".asset('img/identified.png')."' style='width:30px'>";
            } else if ($value == User::IDENTIFY_PENDING) {
                return 'Pending';
            } else if ($value == User::IDENTIFY_REJECTED) {
                return 'Rejected';
            } else {
                return '';
            }
        });
        $show->identity_filename('Identity')->unescape()->as(function ($value) {
            return $value? "<a href='identity/".$value."' target='_blank'>".$value."</a>": "";
        });
        $show->starred('Starred')->unescape()->as(function ($value) {
            return $value? "<span class='h4'><i class='fa fa-star text-yellow'></i></span>": "";
        });
        $show->pv_monthly('PV Month');
        $show->pv_total('PV Year');
        $show->user_all()->email('Email');
        $show->purposes_all('Purposes')->unescape()->as(function ($purposes) {
            $purposes_text = '';
            foreach ($purposes as $purpose) {
                $purposes_text .= e(User::PURPOSES[$purpose['purpose_id']]).'<br>';
            }
            return $purposes_text;
        });
        $show->first_name('First name');
        $show->family_name('Family name');
        $show->country_code('Country')->as(function ($value) {
            return country($value)->getName();
        });
        $show->company_name('Company name');
        $show->company_website('Company website');
        $show->company_address('Company address');
        $show->founded_date('Founded date');
        $show->number_of_members('Number of members');
        $show->company_vision('Company vision')->unescape()->as(function ($value) {
            return nl2br(e($value));
        });
        $show->categories('Field of business')->unescape()->as(function(){
            $categories_text = '';
            $first = UserCategory::where('user_id', $this->user_id)->first();
            if ($first) $categories_text .= e($first->category->field->field_name).'<br>';
            $categories = UserCategory::where('user_id', $this->user_id)->get();
            foreach ($categories as $category) {
                $categories_text .= e($category->category->category_name);
                if (isset($category->remark) && !is_null($category->remark) && $category->remark != '') $categories_text .= ' ('.e($category->remark).')';
                $categories_text .= '<br>';
            }
            return $categories_text;
        });
        $show->board_members('Board members')->unescape()->as(function ($value) {
            return nl2br(e($value));
        });
        $show->image_filename('Image')->image('/storage/profile/');
        $show->briefing('Briefing')->unescape()->as(function ($value) {
            return nl2br(e($value));
        });
        $show->target_customers('Target customers')->unescape()->as(function ($value) {
            return nl2br(e($value));
        });
        $show->value_proposition('Value proposition')->unescape()->as(function ($value) {
            return nl2br(e($value));
        });
        $show->competitors('Competitors')->unescape()->as(function ($value) {
            return nl2br(e($value));
        });
        $show->revenue_cost('Revenue cost')->unescape()->as(function ($value) {
            return nl2br(e($value));
        });
        $show->is_fundraising('Is fundraising')->as(function ($value) {
            return $value? 'Engaging in Fundraising': 'Not Engaging in Fundraising';
        });
        $show->investment_round('Investment round')->as(function ($value) {
            return !is_null($value)? User::INVESTMENT_ROUNDS[$value]: '';
        });
        $show->has_investor('Has investor')->as(function ($value) {
            return $value? 'Yes': 'No';
        });
        $show->investors('Investors')->unescape()->as(function ($value) {
            return nl2br(e($value));
        });
        $show->funding_amount('Funding amount')->as(function ($value) {
            return !is_null($value)? User::INVESTMENT_SCALE[$value]: '';
        });
        $show->desired_help('Desired help')->unescape()->as(function ($value) {
            return nl2br(e($value));
        });
        $show->messages('Messages')->unescape()->as(function ($value) {
            return nl2br(e($value));
        });
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        if (!\Admin::user()->isAdministrator()) {
            $show->panel()->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });
        }
        $show->panel()->tools(function ($tools) use ($show) {
            $tools->append(new Identify($show->getModel()));
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Entrepreneur);

        $form->text('first_name', 'First name');
        $form->text('family_name', 'Family name');
        $form->text('country_code', 'Country code');
        $form->text('company_name', 'Company name');
        $form->text('company_website', 'Company website');
        $form->text('company_address', 'Company address');
        $form->date('founded_date', 'Founded date')->default(date('Y-m-d'));
        $form->switch('number_of_members', 'Number of members');
        $form->text('company_vision', 'Company vision');
        $form->text('board_members', 'Board members');
        $form->text('image_filename', 'Image filename');
        $form->text('briefing', 'Briefing');
        $form->text('target_customers', 'Target customers');
        $form->text('value_proposition', 'Value proposition');
        $form->text('competitors', 'Competitors');
        $form->text('revenue_cost', 'Revenue cost');
        $form->switch('is_fundraising', 'Is fundraising');
        $form->switch('investment_round', 'Investment round');
        $form->switch('has_investor', 'Has investor');
        $form->text('investors', 'Investors');
        $form->switch('funding_amount', 'Funding amount');
        $form->text('desired_help', 'Desired help');
        $form->text('messages', 'Messages');

        return $form;
    }

    public function identity(Request $request, $filename)
    {
        return Storage::disk('local')->response('identity/'.$filename);
    }

    public function setIdentified(Request $request, $id)
    {
        $validation = ['identified' => 'nullable|in:'.User::IDENTIFY_IDENTIFIED.','.User::IDENTIFY_REJECTED];
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $entity = Entrepreneur::with('user_all')->findOrFail($id);
            $entity->identified = $request->identified;
            $result = $entity->save();
            if ($result) {
                if ($request->identified == User::IDENTIFY_IDENTIFIED) {
                    $entity->notify(new IdentifyIdentified());
                } else if ($request->identified == User::IDENTIFY_REJECTED) {
                    $entity->notify(new IdentifyRejected($request->reason));
                }
            }
            return response()->json($result);
        }
    }

    public function changeStarred(Request $request, $id)
    {
        $validation = ['starred' => 'nullable|boolean'];
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $entrepreneur = Entrepreneur::findOrFail($id);
            $entrepreneur->starred = $request->starred;
            $result = $entrepreneur->save();
            return response()->json($result);
        }
    }
}

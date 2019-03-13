<?php

namespace App\Admin\Controllers;

use App\User;
use App\Company;
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
use App\Admin\Extensions\Trusted;
use App\Admin\Extensions\CsvExporter;
use App\Admin\Extensions\Tools\Identify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
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
        $grid = new Grid(new Company);

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
        $grid->trusted('Trusted')->display(function ($value) {
            return $value? "<span class='h4'><i class='fa fa-bookmark text-success'></i></span>": "";
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
        $grid->position('Position');
        $grid->department('Department');
        $grid->company_name('Company name');
        $grid->website('Website');
        $grid->country_code('Country')->display(function($value){
            return country($value)->getName();
        });
        $grid->address('Address');
        $grid->founded_date('Founded date');
        $grid->column('Industry')->display(function(){
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
        $grid->revenue_scale('Revenue scale')->display(function($value){
            return !is_null($value)? User::REVENUE_SCALE[$value]: '';
        });
        $grid->capital_scale('Capital scale')->display(function($value){
            return !is_null($value)? User::CAPITAL_SCALE[$value]: '';
        });
        $grid->employee_number('Employee number')->display(function($value){
            return !is_null($value)? User::EMPLOYEE_NUMBER[$value]: '';
        });
        $grid->image_filename('Image')->image('/storage/profile');
        $grid->briefing_business('Briefing business')->display(function($value){
            return nl2br(e($value));
        });
        $grid->briefing_service('Briefing service')->display(function($value){
            return nl2br(e($value));
        });
        $grid->purpose_message('Purpose message')->display(function($value){
            return nl2br(e($value));
        });
        $grid->appeal_message('Appeal message')->display(function($value){
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
            $actions->append(new Trusted($actions));
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
            $filter->where(function ($query) {
                switch ($this->input) {
                    case 'yes':
                        // custom complex query if the 'yes' option is selected
                        $query->where('trusted', '=', 1);
                        break;
                    case 'no':
                        $query->whereNull('trusted');
                        break;
                }
            }, 'Trusted')->radio([
                '' => 'All',
                'yes' => 'Trusted',
                'no' => 'General',
            ]);
        });

        $grid_export = new Grid(new Company);
        $grid_export->user_id('User id');
        $grid_export->user_all()->name('Unique ID');
        $grid_export->user_all()->status('Status');
        $grid_export->identified('Identified');
        $grid_export->identity_filename('Identity Filename');
        $grid_export->starred('Starred');
        $grid_export->trusted('Trusted');
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
        $grid_export->position('Position');
        $grid_export->department('Department');
        $grid_export->company_name('Company name');
        $grid_export->website('Website');
        $grid_export->country_code('Country')->display(function($value){
            return country($value)->getName();
        });
        $grid_export->address('Address');
        $grid_export->founded_date('Founded date');
        $grid_export->column('Industry')->display(function(){
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
        $grid_export->revenue_scale('Revenue scale')->display(function($value){
            return !is_null($value)? User::REVENUE_SCALE[$value]: '';
        });
        $grid_export->capital_scale('Capital scale')->display(function($value){
            return !is_null($value)? User::CAPITAL_SCALE[$value]: '';
        });
        $grid_export->employee_number('Employee number')->display(function($value){
            return !is_null($value)? User::EMPLOYEE_NUMBER[$value]: '';
        });
        $grid_export->image_filename('Image');
        $grid_export->briefing_business('Briefing business');
        $grid_export->briefing_service('Briefing service');
        $grid_export->purpose_message('Purpose message');
        $grid_export->appeal_message('Appeal message');
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
        $show = new Show(Company::findOrFail($id));

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
        $show->trusted('Trusted')->unescape()->as(function ($value) {
            return $value? "<span class='h4'><i class='fa fa-bookmark text-success'></i></span>": "";
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
        $show->position('Position');
        $show->department('Department');
        $show->company_name('Company name');
        $show->website('Website');
        $show->country_code('Country')->as(function($value){
            return country($value)->getName();
        });
        $show->address('Address');
        $show->founded_date('Founded date');
        $show->categories('Industry')->unescape()->as(function(){
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
        $show->revenue_scale('Revenue scale')->as(function($value){
            return !is_null($value)? User::REVENUE_SCALE[$value]: '';
        });
        $show->capital_scale('Capital scale')->as(function($value){
            return !is_null($value)? User::CAPITAL_SCALE[$value]: '';
        });
        $show->employee_number('Employee number')->as(function($value){
            return !is_null($value)? User::EMPLOYEE_NUMBER[$value]: '';
        });
        $show->image_filename('Image')->image('/storage/profile/');
        $show->briefing_business('Briefing business')->unescape()->as(function($value){
            return nl2br(e($value));
        });
        $show->briefing_service('Briefing service')->unescape()->as(function($value){
            return nl2br(e($value));
        });
        $show->purpose_message('Purpose message')->unescape()->as(function($value){
            return nl2br(e($value));
        });
        $show->appeal_message('Appeal message')->unescape()->as(function($value){
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
        $form = new Form(new Company);

        $form->text('first_name', 'First name');
        $form->text('family_name', 'Family name');
        $form->text('position', 'Position');
        $form->text('department', 'Department');
        $form->text('company_name', 'Company name');
        $form->text('website', 'Website');
        $form->text('country_code', 'Country code');
        $form->text('address', 'Address');
        $form->date('founded_date', 'Founded date')->default(date('Y-m-d'));
        $form->switch('revenue_scale', 'Revenue scale');
        $form->switch('capital_scale', 'Capital scale');
        $form->switch('employee_number', 'Employee number');
        $form->text('image_filename', 'Image filename');
        $form->text('briefing_business', 'Briefing business');
        $form->text('briefing_service', 'Briefing service');
        $form->text('purpose_message', 'Purpose message');
        $form->text('appeal_message', 'Appeal message');

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
            $entity = Company::with('user_all')->findOrFail($id);
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
            $company = Company::findOrFail($id);
            $company->starred = $request->starred;
            $result = $company->save();
            return response()->json($result);
        }
    }

    public function changeTrusted(Request $request, $id)
    {
        $validation = ['trusted' => 'nullable|boolean'];
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $company = Company::findOrFail($id);
            $company->trusted = $request->trusted;
            $result = $company->save();
            return response()->json($result);
        }
    }
}

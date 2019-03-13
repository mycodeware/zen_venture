<?php

namespace App\Admin\Controllers;

use App\User;
use App\Freelancer;
use App\UserProfession;
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

class FreelancerController extends Controller
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
        $grid = new Grid(new Freelancer);

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
        $grid->address('Address');
        $grid->age('Age')->display(function($value){
            return !is_null($value)? User::AGE_RANGE[$value]: '';
        });
        $grid->website('Website');
        $grid->image_filename('Image')->image('/storage/profile');
        $grid->career('Career')->display(function($value){
            return nl2br(e($value));
        });
        $grid->profession('Profession')->display(function($value){
            $remark = '';
            $first = UserProfession::where('user_id', $this->user_id)->first();
            if (!is_null($first)) $remark = ' ('.$first->remark.')';
            return !is_null($value)? User::PROFESSIONS[$value]['name'].$remark: '';
        });
        $grid->qualification('Qualification')->display(function($value){
            return nl2br(e($value));
        });
        $grid->strength('Strength')->display(function($value){
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

        $grid_export = new Grid(new Freelancer);
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
        $grid_export->address('Address');
        $grid_export->age('Age')->display(function($value){
            return !is_null($value)? User::AGE_RANGE[$value]: '';
        });
        $grid_export->website('Website');
        $grid_export->image_filename('Image');
        $grid_export->career('Career');
        $grid_export->profession('Profession')->display(function($value){
            $remark = '';
            $first = UserProfession::where('user_id', $this->user_id)->first();
            if (!is_null($first)) $remark = ' ('.$first->remark.')';
            return !is_null($value)? User::PROFESSIONS[$value]['name'].$remark: '';
        });
        $grid_export->qualification('Qualification');
        $grid_export->strength('Strength');
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
        $show = new Show(Freelancer::findOrFail($id));

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
        $show->country_code('Country')->as(function($value){
            return country($value)->getName();
        });
        $show->address('Address');
        $show->age('Age')->as(function($value){
            return !is_null($value)? User::AGE_RANGE[$value]: '';
        });
        $show->website('Website');
        $show->image_filename('Image')->image('/storage/profile/');
        $show->career('Career')->unescape()->as(function($value){
            return nl2br(e($value));
        });
        $show->profession('Profession')->as(function($value){
            $remark = '';
            $first = UserProfession::where('user_id', $this->user_id)->first();
            if (!is_null($first)) $remark = ' ('.$first->remark.')';
            return !is_null($value)? User::PROFESSIONS[$value]['name'].$remark: '';
        });
        $show->qualification('Qualification')->unescape()->as(function($value){
            return nl2br(e($value));
        });
        $show->strength('Strength')->unescape()->as(function($value){
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
        $form = new Form(new Freelancer);

        $form->text('first_name', 'First name');
        $form->text('family_name', 'Family name');
        $form->text('country_code', 'Country code');
        $form->text('address', 'Address');
        $form->switch('age', 'Age');
        $form->text('website', 'Website');
        $form->text('image_filename', 'Image filename');
        $form->text('career', 'Career');
        $form->switch('profession', 'Profession');
        $form->text('qualification', 'Qualification');
        $form->text('strength', 'Strength');
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
            $entity = Freelancer::with('user_all')->findOrFail($id);
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
            $freelancer = Freelancer::findOrFail($id);
            $freelancer->starred = $request->starred;
            $result = $freelancer->save();
            return response()->json($result);
        }
    }
}

<?php

namespace App\Admin\Controllers;

use App\User;
use App\Investor;
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

class InvestorController extends Controller
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
        $grid = new Grid(new Investor);

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
        $grid->country_code('Country')->display(function($value){
            return country($value)->getName();
        });
        $grid->address('Address');
        $grid->company_name('Company name');
        $grid->website('Website');
        $grid->image_filename('Image')->image('/storage/profile');
        $grid->investment_policy('Investment policy')->display(function($value){
            return nl2br(e($value));
        });
        $grid->business_area('Business area')->display(function($value){
            return nl2br(e($value));
        });
        $grid->column('Target Round')->display(function(){
            $round_start = !is_null($this->round_start)? User::INVESTMENT_ROUNDS[$this->round_start]: '';
            $round_end = !is_null($this->round_end)? User::INVESTMENT_ROUNDS[$this->round_end]: '';
            return $round_start.' ~ '.$round_end;
        });
        $grid->column('Investment Scale')->display(function(){
            $scale_start = !is_null($this->scale_start)? User::INVESTMENT_RANGE[$this->scale_start]: '';
            $scale_end = !is_null($this->scale_end)? User::INVESTMENT_RANGE[$this->scale_end]: '';
            return $scale_start.' ~ '.$scale_end;
        });
        $grid->track_record('Track record')->display(function($value){
            return nl2br(e($value));
        });
        $grid->has_invested('Have you invested')->display(function($value){
            return $value? 'Yes': 'No';
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

        $grid_export = new Grid(new Investor);
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
        $grid_export->country_code('Country')->display(function($value){
            return country($value)->getName();
        });
        $grid_export->address('Address');
        $grid_export->company_name('Company name');
        $grid_export->website('Website');
        $grid_export->image_filename('Image');
        $grid_export->investment_policy('Investment policy');
        $grid_export->business_area('Business area');
        $grid_export->column('Target Round')->display(function(){
            $round_start = !is_null($this->round_start)? User::INVESTMENT_ROUNDS[$this->round_start]: '';
            $round_end = !is_null($this->round_end)? User::INVESTMENT_ROUNDS[$this->round_end]: '';
            return $round_start.' ~ '.$round_end;
        });
        $grid_export->column('Investment Scale')->display(function(){
            $scale_start = !is_null($this->scale_start)? User::INVESTMENT_RANGE[$this->scale_start]: '';
            $scale_end = !is_null($this->scale_end)? User::INVESTMENT_RANGE[$this->scale_end]: '';
            return $scale_start.' ~ '.$scale_end;
        });
        $grid_export->track_record('Track record');
        $grid_export->has_invested('Have you invested')->display(function($value){
            return $value? 'Yes': 'No';
        });
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
        $show = new Show(Investor::findOrFail($id));

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
        $show->country_code('Country')->as(function($value){
            return country($value)->getName();
        });
        $show->address('Address');
        $show->company_name('Company name');
        $show->website('Website');
        $show->image_filename('Image')->image('/storage/profile/');
        $show->investment_policy('Investment policy')->unescape()->as(function($value){
            return nl2br(e($value));
        });
        $show->business_area('Business area')->unescape()->as(function($value){
            return nl2br(e($value));
        });
        $show->round('Target Round')->as(function(){
            $round_start = !is_null($this->round_start)? User::INVESTMENT_ROUNDS[$this->round_start]: '';
            $round_end = !is_null($this->round_end)? User::INVESTMENT_ROUNDS[$this->round_end]: '';
            return $round_start.' ~ '.$round_end;
        });
        $show->scale('Investment Scale')->as(function(){
            $scale_start = !is_null($this->scale_start)? User::INVESTMENT_RANGE[$this->scale_start]: '';
            $scale_end = !is_null($this->scale_end)? User::INVESTMENT_RANGE[$this->scale_end]: '';
            return $scale_start.' ~ '.$scale_end;
        });
        $show->track_record('Track record')->unescape()->as(function($value){
            return nl2br(e($value));
        });
        $show->has_invested('Has invested')->as(function($value){
            return $value? 'Yes': 'No';
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
        $form = new Form(new Investor);

        $form->text('first_name', 'First name');
        $form->text('family_name', 'Family name');
        $form->text('country_code', 'Country code');
        $form->text('address', 'Address');
        $form->text('company_name', 'Company name');
        $form->text('website', 'Website');
        $form->text('image_filename', 'Image filename');
        $form->text('investment_policy', 'Investment policy');
        $form->text('business_area', 'Business area');
        $form->switch('round_start', 'Round start');
        $form->switch('round_end', 'Round end');
        $form->switch('scale_start', 'Scale start');
        $form->switch('scale_end', 'Scale end');
        $form->text('track_record', 'Track record');
        $form->switch('has_invested', 'Has invested');

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
            $entity = Investor::with('user_all')->findOrFail($id);
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
            $investor = Investor::findOrFail($id);
            $investor->starred = $request->starred;
            $result = $investor->save();
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
            $investor = Investor::findOrFail($id);
            $investor->trusted = $request->trusted;
            $result = $investor->save();
            return response()->json($result);
        }
    }
}

<?php

namespace App\Admin\Extensions\Tools;

use App\User;
use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;

class Identify extends AbstractTool
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    protected function script()
    {
        $identified = User::IDENTIFY_IDENTIFIED;
        $rejected = User::IDENTIFY_REJECTED;
        return <<<SCRIPT

$('input:radio.tools-identify').change(function () {

    var id = $(this).data('id');
    var identified = $(this).val();
    var reason = '';
    if (identified == {$identified}) {
        var result = confirm('Are you sure you want to identify?');
        if (!result) return $.pjax.reload('#pjax-container');
    }
    if (identified == {$rejected}) {
        var result = prompt('Are you sure you want to reject?', 'Type the reason here');
        if (result == null) return $.pjax.reload('#pjax-container');
        reason = result;
    }
    $.ajax({
        method: 'post',
        url: 'setIdentified/' + id,
        data: {
            _method:'patch',
            _token:LA.token,
            identified: identified,
            reason: reason,
        },
        success: function (data) {
            $.pjax.reload('#pjax-container');
        }
    });

});

SCRIPT;
    }

    public function render()
    {
        Admin::script($this->script());

        $identified = User::IDENTIFY_IDENTIFIED;
        $rejected = User::IDENTIFY_REJECTED;
        $id = $this->model->user_id;
        $identified_status = $this->model->identified == User::IDENTIFY_IDENTIFIED? 'active':'';
        $rejected_status = $this->model->identified == User::IDENTIFY_REJECTED? 'active':'';

        return <<<HTML
<div class="btn-group pull-right" data-toggle="buttons" style="margin-right: 5px">
    <label class="btn btn-default btn-sm {$identified_status}">
        <input type="radio" class="tools-identify" value="{$identified}" data-id="{$id}">Identify
    </label>
    <label class="btn btn-default btn-sm {$rejected_status}">
        <input type="radio" class="tools-identify" value="{$rejected}" data-id="{$id}">Reject
    </label>
</div>
HTML;

    }

}

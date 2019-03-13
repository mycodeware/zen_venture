<?php

namespace App\Admin\Extensions;

use Encore\Admin\Admin;

class Starred
{
    protected $id;
    protected $actions;
    protected $starred_to;

    public function __construct($actions)
    {
        $this->actions = $actions;
        $this->id = $this->actions->getKey();
        $this->starred_to = $this->actions->row->starred? FALSE: TRUE;
    }

    protected function script()
    {
        return <<<SCRIPT

$('.grid-row-starred').unbind('click').click(function () {

    var id = $(this).data('id');
    var starred_to = $(this).data('starred-to');
    $.ajax({
        method: 'post',
        url: '{$this->actions->getResource()}/changeStarred/' + id,
        data: {
            _method:'patch',
            _token:LA.token,
            starred: starred_to,
        },
        success: function (data) {
            $.pjax.reload('#pjax-container');
        }
    });

});

SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());
        $fa = $this->actions->row->starred? 'fa-star': 'fa-star-o';

        return "<div class='grid-row-starred h4' data-id='{$this->id}' data-starred-to='{$this->starred_to}' role='button'><i class='fa {$fa} text-yellow'></i></div>";
    }

    public function __toString()
    {
        return $this->render();
    }
}

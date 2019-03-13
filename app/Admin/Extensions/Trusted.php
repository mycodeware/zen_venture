<?php

namespace App\Admin\Extensions;

use Encore\Admin\Admin;

class Trusted
{
    protected $id;
    protected $actions;
    protected $trusted_to;

    public function __construct($actions)
    {
        $this->actions = $actions;
        $this->id = $this->actions->getKey();
        $this->trusted_to = $this->actions->row->trusted? FALSE: TRUE;
    }

    protected function script()
    {
        return <<<SCRIPT

$('.grid-row-trusted').unbind('click').click(function () {

    var id = $(this).data('id');
    var trusted_to = $(this).data('trusted-to');
    $.ajax({
        method: 'post',
        url: '{$this->actions->getResource()}/changeTrusted/' + id,
        data: {
            _method:'patch',
            _token:LA.token,
            trusted: trusted_to,
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
        $fa = $this->actions->row->trusted? 'fa-bookmark': 'fa-bookmark-o';

        return "<div class='grid-row-trusted h4' data-id='{$this->id}' data-trusted-to='{$this->trusted_to}' role='button'><i class='fa {$fa} text-success'></i></div>";
    }

    public function __toString()
    {
        return $this->render();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    protected $guarded = ['user_id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}

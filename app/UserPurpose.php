<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPurpose extends Model
{
    protected $guarded = ['user_id'];
}

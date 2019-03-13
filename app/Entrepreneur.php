<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Entrepreneur extends Model
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $guarded = ['user_id'];

    public function routeNotificationForMail($notification)
    {
        return $this->user_all->email;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id')->where('status', '=', User::STATUS_ACTIVE)->select('id', 'name');
    }

    public function user_all()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function purposes()
    {
        return $this->hasMany('App\UserPurpose', 'user_id')->select('user_id', 'purpose_id');
    }

    public function purposes_all()
    {
        return $this->hasMany('App\UserPurpose', 'user_id');
    }

    public function categories_all()
    {
        return $this->hasMany('App\UserCategory', 'user_id');
    }
}

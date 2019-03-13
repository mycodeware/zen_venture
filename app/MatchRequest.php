<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchRequest extends Model
{
    const STATUS_SENT = 1;

    public function from_user_all()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }

    public function from_investor_all()
    {
        return $this->belongsTo('App\Investor', 'from_user_id');
    }

    public function from_company_all()
    {
        return $this->belongsTo('App\Company', 'from_user_id');
    }
    public function from_entrepreneur_all()
    {
        return $this->belongsTo('App\Entrepreneur', 'from_user_id');
    }
    public function from_freelancer_all()
    {
        return $this->belongsTo('App\Freelancer', 'from_user_id');
    }

    public function to_user_all()
    {
        return $this->belongsTo('App\User', 'to_user_id');
    }
    public function to_investor_all()
    {
        return $this->belongsTo('App\Investor', 'to_user_id');
    }

    public function to_company_all()
    {
        return $this->belongsTo('App\Company', 'to_user_id');
    }
    public function to_entrepreneur_all()
    {
        return $this->belongsTo('App\Entrepreneur', 'to_user_id');
    }
    public function to_freelancer_all()
    {
        return $this->belongsTo('App\Freelancer', 'to_user_id');
    }
}

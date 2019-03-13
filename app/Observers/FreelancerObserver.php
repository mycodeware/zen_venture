<?php

namespace App\Observers;

use App\Freelancer;
use App\User;

class FreelancerObserver
{
    /**
     * Handle the freelancer "created" event.
     *
     * @param  \App\Freelancer  $freelancer
     * @return void
     */
    public function created(Freelancer $freelancer)
    {
        //
    }

    /**
     * Handle the freelancer "updated" event.
     *
     * @param  \App\Freelancer  $freelancer
     * @return void
     */
    public function updated(Freelancer $freelancer)
    {
        //
    }

    /**
     * Handle the freelancer "deleted" event.
     *
     * @param  \App\Freelancer  $freelancer
     * @return void
     */
    public function deleted(Freelancer $freelancer)
    {
        //
    }

    /**
     * Handle the freelancer "restored" event.
     *
     * @param  \App\Freelancer  $freelancer
     * @return void
     */
    public function restored(Freelancer $freelancer)
    {
        //
    }

    /**
     * Handle the freelancer "force deleted" event.
     *
     * @param  \App\Freelancer  $freelancer
     * @return void
     */
    public function forceDeleted(Freelancer $freelancer)
    {
        //
    }

    public function retrieved(Freelancer $freelancer)
    {
        $freelancer->country_name = country($freelancer->country_code)->getName();
        $profession_remark = '';
        if (isset($freelancer->professions_all) && !is_null($freelancer->professions_all->first())) {
            $profession_remark = ' ('.$freelancer->professions_all->first()->remark.')';
        }
        $freelancer->profession_name = User::PROFESSIONS[$freelancer->profession]['name'].$profession_remark;
    }

    public function saving(Freelancer $freelancer)
    {
        if (isset($freelancer->country_name)) unset($freelancer->country_name);
        if (isset($freelancer->profession_name)) unset($freelancer->profession_name);
    }
}

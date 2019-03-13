<?php

namespace App\Observers;

use App\Entrepreneur;
use App\User;

class EntrepreneurObserver
{
    /**
     * Handle the entrepreneur "created" event.
     *
     * @param  \App\Entrepreneur  $entrepreneur
     * @return void
     */
    public function created(Entrepreneur $entrepreneur)
    {
        //
    }

    /**
     * Handle the entrepreneur "updated" event.
     *
     * @param  \App\Entrepreneur  $entrepreneur
     * @return void
     */
    public function updated(Entrepreneur $entrepreneur)
    {
        //
    }

    /**
     * Handle the entrepreneur "deleted" event.
     *
     * @param  \App\Entrepreneur  $entrepreneur
     * @return void
     */
    public function deleted(Entrepreneur $entrepreneur)
    {
        //
    }

    /**
     * Handle the entrepreneur "restored" event.
     *
     * @param  \App\Entrepreneur  $entrepreneur
     * @return void
     */
    public function restored(Entrepreneur $entrepreneur)
    {
        //
    }

    /**
     * Handle the entrepreneur "force deleted" event.
     *
     * @param  \App\Entrepreneur  $entrepreneur
     * @return void
     */
    public function forceDeleted(Entrepreneur $entrepreneur)
    {
        //
    }

    public function retrieved(Entrepreneur $entrepreneur)
    {
        $entrepreneur->country_name = country($entrepreneur->country_code)->getName();
        $entrepreneur->investment_round_name = User::INVESTMENT_ROUNDS[$entrepreneur->investment_round];
    }

    public function saving(Entrepreneur $entrepreneur)
    {
        if (isset($entrepreneur->country_name)) unset($entrepreneur->country_name);
        if (isset($entrepreneur->investment_round_name)) unset($entrepreneur->investment_round_name);
    }
}

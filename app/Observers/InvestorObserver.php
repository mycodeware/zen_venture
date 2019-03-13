<?php

namespace App\Observers;

use App\Investor;
use App\User;

class InvestorObserver
{
    /**
     * Handle the investor "created" event.
     *
     * @param  \App\Investor  $investor
     * @return void
     */
    public function created(Investor $investor)
    {
        //
    }

    /**
     * Handle the investor "updated" event.
     *
     * @param  \App\Investor  $investor
     * @return void
     */
    public function updated(Investor $investor)
    {
        //
    }

    /**
     * Handle the investor "deleted" event.
     *
     * @param  \App\Investor  $investor
     * @return void
     */
    public function deleted(Investor $investor)
    {
        //
    }

    /**
     * Handle the investor "restored" event.
     *
     * @param  \App\Investor  $investor
     * @return void
     */
    public function restored(Investor $investor)
    {
        //
    }

    /**
     * Handle the investor "force deleted" event.
     *
     * @param  \App\Investor  $investor
     * @return void
     */
    public function forceDeleted(Investor $investor)
    {
        //
    }

    public function retrieved(Investor $investor)
    {
        $investor->country_name = country($investor->country_code)->getName();
        $investor->round_start_name = User::INVESTMENT_ROUNDS[$investor->round_start];
        $investor->round_end_name = User::INVESTMENT_ROUNDS[$investor->round_end];
        $investor->scale_start_name = User::INVESTMENT_RANGE[$investor->scale_start];
        $investor->scale_end_name = User::INVESTMENT_RANGE[$investor->scale_end];
    }

    public function saving(Investor $investor)
    {
        if (isset($investor->country_name)) unset($investor->country_name);
        if (isset($investor->round_start_name)) unset($investor->round_start_name);
        if (isset($investor->round_end_name)) unset($investor->round_end_name);
        if (isset($investor->scale_start_name)) unset($investor->scale_start_name);
        if (isset($investor->scale_end_name)) unset($investor->scale_end_name);
    }
}

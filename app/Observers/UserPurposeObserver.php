<?php

namespace App\Observers;

use App\UserPurpose;
use App\User;

class UserPurposeObserver
{
    /**
     * Handle the user purpose "created" event.
     *
     * @param  \App\UserPurpose  $userPurpose
     * @return void
     */
    public function created(UserPurpose $userPurpose)
    {
        //
    }

    /**
     * Handle the user purpose "updated" event.
     *
     * @param  \App\UserPurpose  $userPurpose
     * @return void
     */
    public function updated(UserPurpose $userPurpose)
    {
        //
    }

    /**
     * Handle the user purpose "deleted" event.
     *
     * @param  \App\UserPurpose  $userPurpose
     * @return void
     */
    public function deleted(UserPurpose $userPurpose)
    {
        //
    }

    /**
     * Handle the user purpose "restored" event.
     *
     * @param  \App\UserPurpose  $userPurpose
     * @return void
     */
    public function restored(UserPurpose $userPurpose)
    {
        //
    }

    /**
     * Handle the user purpose "force deleted" event.
     *
     * @param  \App\UserPurpose  $userPurpose
     * @return void
     */
    public function forceDeleted(UserPurpose $userPurpose)
    {
        //
    }

    public function retrieved(UserPurpose $userPurpose)
    {
        $userPurpose->purpose_name = User::PURPOSES[$userPurpose->purpose_id];
    }

    public function saving(UserPurpose $userPurpose)
    {
        if (isset($userPurpose->purpose_name)) unset($userPurpose->purpose_name);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\InvestorObserver;
use App\Observers\CompanyObserver;
use App\Observers\EntrepreneurObserver;
use App\Observers\FreelancerObserver;
use App\Observers\UserPurposeObserver;
use App\Investor;
use App\Company;
use App\Entrepreneur;
use App\Freelancer;
use App\UserPurpose;
use Illuminate\Support\Facades\Schema; //NEW: Import Schema


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Investor::observe(InvestorObserver::class);
        Company::observe(CompanyObserver::class);
        Entrepreneur::observe(EntrepreneurObserver::class);
        Freelancer::observe(FreelancerObserver::class);
        UserPurpose::observe(UserPurposeObserver::class);
        if (config('app.env') === 'production' || config('app.env') === 'staging') {
            \URL::forceScheme('https');
        }

        Schema::defaultStringLength(191); //NEW: Increase StringLength

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Investor;
use App\Company;
use App\Entrepreneur;
use App\Freelancer;
use Analytics;
use Spatie\Analytics\Period;

class UpdatePV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:pv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update PV from GA';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Investor::select('pv_total', 'pv_monthly')->update(['pv_total' => 0, 'pv_monthly' => 0]);
        Company::select('pv_total', 'pv_monthly')->update(['pv_total' => 0, 'pv_monthly' => 0]);
        Entrepreneur::select('pv_total', 'pv_monthly')->update(['pv_total' => 0, 'pv_monthly' => 0]);
        Freelancer::select('pv_total', 'pv_monthly')->update(['pv_total' => 0, 'pv_monthly' => 0]);
        // PV Year
        $period = Period::years(1);
        $analytics = Analytics::performQuery(
            $period,
            'ga:pageviews',
            $others = array(
                'filters' => 'ga:pagePath=~^/matches/',
                'dimensions' => 'ga:pagePath'
            )
        );
        foreach ($analytics as $data) {
            $url = $data[0];
            $name = str_after($url, '/matches/');
            $pv = $data[1];
            $user = User::with([
                'investor',
                'company',
                'entrepreneur',
                'freelancer',
            ])->where('name', $name)->first();
            if ($user) {
                switch ($user->type) {
                    case User::TYPE_INVESTOR:
                        if (isset($user->investor)) {
                            $user->investor->pv_total = $pv;
                            $user->push();
                        }
                        break;
                    case User::TYPE_COMPANY:
                        if (isset($user->company)) {
                            $user->company->pv_total = $pv;
                            $user->push();
                        }
                        break;
                    case User::TYPE_ENTREPRENEUR:
                        if (isset($user->entrepreneur)) {
                            $user->entrepreneur->pv_total = $pv;
                            $user->push();
                        }
                        break;
                    case User::TYPE_FREELANCER:
                        if (isset($user->freelancer)) {
                            $user->freelancer->pv_total = $pv;
                            $user->push();
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        // PV Month
        $period = Period::months(1);
        $analytics = Analytics::performQuery(
            $period,
            'ga:pageviews',
            $others = array(
                'filters' => 'ga:pagePath=~^/matches/',
                'dimensions' => 'ga:pagePath'
            )
        );
        foreach ($analytics as $data) {
            $url = $data[0];
            $name = str_after($url, '/matches/');
            $pv = $data[1];
            $user = User::with([
                'investor',
                'company',
                'entrepreneur',
                'freelancer',
            ])->where('name', $name)->first();
            if ($user) {
                switch ($user->type) {
                    case User::TYPE_INVESTOR:
                        if (isset($user->investor)) {
                            $user->investor->pv_monthly = $pv;
                            $user->push();
                        }
                        break;
                    case User::TYPE_COMPANY:
                        if (isset($user->company)) {
                            $user->company->pv_monthly = $pv;
                            $user->push();
                        }
                        break;
                    case User::TYPE_ENTREPRENEUR:
                        if (isset($user->entrepreneur)) {
                            $user->entrepreneur->pv_monthly = $pv;
                            $user->push();
                        }
                        break;
                    case User::TYPE_FREELANCER:
                        if (isset($user->freelancer)) {
                            $user->freelancer->pv_monthly = $pv;
                            $user->push();
                        }
                        break;
                    default:
                        break;
                }
            }
        }
    }
}

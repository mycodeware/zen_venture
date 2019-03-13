<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Investor;
use App\Company;
use App\Entrepreneur;
use App\Freelancer;

class Welcome extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // OGP
        $ogp = [
            ['property' => 'og:title', 'content' => config('app.name')],
            ['property' => 'og:type', 'content' => 'website'],
            ['property' => 'og:url', 'content' => url()->current()],
            ['property' => 'og:image', 'content' => asset('/img/ecosystem_630.png')],
            ['property' => 'og:image:secure_url', 'content' => asset('/img/ecosystem_630.png')],
            ['property' => 'og:site_name', 'content' => config('app.name')],
            ['property' => 'og:description', 'content' => __(config('app.description'))],
            ['property' => 'fb:app_id', 'content' => config('app.fb_app_id')],
            ['name' => 'twitter:card', 'content' => 'summary'],
            ['name' => 'twitter:image', 'content' => asset('/img/ecosystem_1024x1024.png')],
        ];

        $investors = Investor::whereNotNull('starred')->with('user')->has('user')->inRandomOrder()->take(3)->get();
        $companies = Company::whereNotNull('starred')->with(['user', 'purposes'])->has('user')->inRandomOrder()->take(3)->get();
        $entrepreneurs = Entrepreneur::whereNotNull('starred')->with(['user', 'purposes'])->has('user')->inRandomOrder()->take(3)->get();
        $freelancers = Freelancer::whereNotNull('starred')->with(['user', 'purposes'])->has('user')->inRandomOrder()->take(3)->get();
        $trusted_max = 9;
        $trusted_investors_count = Investor::whereNotNull('trusted')->whereNotNull('image_filename')->count();
        $trusted_companies_count = Company::whereNotNull('trusted')->whereNotNull('image_filename')->count();
        if ($trusted_investors_count + $trusted_companies_count > $trusted_max) {
            if ($trusted_investors_count >= 5 && $trusted_companies_count >= 5) {
                $rand_investor = rand(0, 1);
                $rand_company = $rand_investor == 0? 1: 0;
                $trusted_investors_count = 4 + $rand_investor;
                $trusted_companies_count = 4 + $rand_company;
            } else {
                if ($trusted_investors_count > $trusted_companies_count) {
                    $trusted_investors_count = $trusted_max - $trusted_companies_count;
                } else {
                    $trusted_companies_count = $trusted_max - $trusted_investors_count;
                }
            }
        }
        $trusted_investors = Investor::whereNotNull('trusted')->whereNotNull('image_filename')->with('user')->has('user')->inRandomOrder()->take($trusted_investors_count)->get()->pluck('image_filename')->all();
        $trusted_companies = Company::whereNotNull('trusted')->whereNotNull('image_filename')->with('user')->has('user')->inRandomOrder()->take($trusted_companies_count)->get()->pluck('image_filename')->all();
        $trusted = array_merge($trusted_investors, $trusted_companies);
        shuffle($trusted);
        return view('welcome', [
            'investors' => $investors,
            'companies' => $companies,
            'entrepreneurs' => $entrepreneurs,
            'freelancers' => $freelancers,
            'trusted' => $trusted,
            'ogp' => $ogp,
        ]);
    }
}

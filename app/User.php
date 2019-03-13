<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    const STATUS_ACTIVE = 0;
    const STATUS_INACTIVE = 1;

    const IDENTIFY_IDENTIFIED = 1;
    const IDENTIFY_REJECTED = 2;
    const IDENTIFY_PENDING = 3;

    const TYPES = [
      1 => ['display' => 'Angel Investor / VC / CVC / PE', 'abbr' => 'investor'],
      2 => ['display' => 'Large scale company / SME', 'abbr' => 'company'],
      3 => ['display' => 'Startup / Entrepreneur', 'abbr' => 'startup'],
      4 => ['display' => 'Professional / Freelancer', 'abbr' => 'professional'],
    ];

    const TYPE_INVESTOR = 1;
    const TYPE_COMPANY = 2;
    const TYPE_ENTREPRENEUR = 3;
    const TYPE_FREELANCER = 4;

    const PURPOSES = [
      1 => 'Fundraising',
      2 => 'Investment',
      3 => 'M&A',
      4 => 'Client Acquisition',
      5 => 'Human Resource Acquisition',
      6 => 'Job Hunting',
      7 => 'Business Alliance',
      8 => 'Sales Channel Development',
      9 => 'Information Collection',
    ];

    const TYPES_PURPOSES = [
      1 => [2, 3, 9],
      2 => [1, 2, 3, 4, 5, 7, 8, 9],
      3 => [1, 3, 4, 5, 7, 8, 9],
      4 => [4, 6],
    ];

    const INVESTMENT_ROUNDS = [
      1 => 'Angel Round',
      2 => 'Seed Round',
      3 => 'Series A',
      4 => 'Series B',
      5 => 'Series C',
    ];

    const INVESTMENT_RANGE = [
      1 => 'Less than 10,000 USD',
      2 => '100,000 USD',
      3 => '1,000,000 USD',
      4 => '10,000,000 USD',
      5 => '100,000,000 USD',
      6 => 'More than 100,000,000 USD',
    ];

    const INVESTMENT_SCALE = [
      1 => 'Less than 10,000 USD',
      2 => '10,000 USD to 100,000 USD',
      3 => '100,000 USD to  1,000,000 USD',
      4 => '1,000,000 USD to 10,000,000 USD',
      5 => '10,000,000 USD to 100,000,000 USD',
      6 => 'More than 100,000,000 USD',
    ];

    const REVENUE_SCALE = [
      1 => 'Less than 10,000 USD',
      2 => '10,000 USD to 100,000 USD',
      3 => '100,000 USD to  1,000,000 USD',
      4 => '1,000,000 USD to 10,000,000 USD',
      5 => '10,000,000 USD to 100,000,000 USD',
      6 => '100,000,000 USD to 1,000,000,000 USD',
      7 => '1,000,000,000 USD to 10,000,000,000 USD',
      8 => 'More than 10,000,000,000 USD',
    ];

    const CAPITAL_SCALE = [
      1 => 'Less than 10,000 USD',
      2 => '10,000 USD to 100,000 USD',
      3 => '100,000 USD to  1,000,000 USD',
      4 => '1,000,000 USD to 10,000,000 USD',
      5 => '10,000,000 USD to 100,000,000 USD',
      6 => 'More than 100,000,000 USD',
    ];

    const EMPLOYEE_NUMBER = [
      1 => 'Less than 10 People',
      2 => '10 to 100 People',
      3 => '101 to 1,000 People',
      4 => '1,001 to  10,000 People',
      5 => '10,001 to 100,000 People',
      6 => 'More than 100,001 People',
    ];

    const AGE_RANGE = [
      1 => 'Under 20',
      2 => '20 - 29',
      3 => '30 – 39',
      4 => '40 – 49',
      5 => '50 – 59',
      6 => 'Over 60',
      7 => 'Rather not mention',
    ];

    const PROFESSIONS = [
      1 => ['name' => 'Accountant (Inc. Tax Accountant)', 'enterable'=> false],
      2 => ['name' => 'Consultant (Strategy / Management)', 'enterable'=> false],
      3 => ['name' => 'Consultant (M&A)', 'enterable'=> false],
      4 => ['name' => 'Consultant (Marketing)', 'enterable'=> false],
      5 => ['name' => 'Consultant (Human Capital)', 'enterable'=> false],
      6 => ['name' => 'Consultant (Other Area)', 'enterable'=> false],
      7 => ['name' => 'Sales Representative', 'enterable'=> false],
      8 => ['name' => 'Lawyer', 'enterable'=> false],
      9 => ['name' => 'Administrative Scrivener', 'enterable'=> false],
      10 => ['name' => 'Engineer (ICT)', 'enterable'=> false],
      11 => ['name' => 'Engineer (Other)', 'enterable'=> false],
      12 => ['name' => 'Web Designer', 'enterable'=> false],
      13 => ['name' => 'Graphic Designer', 'enterable'=> false],
      14 => ['name' => 'Illustlator', 'enterable'=> false],
      15 => ['name' => 'Translator', 'enterable'=> false],
      16 => ['name' => 'Architect', 'enterable'=> false],
      17 => ['name' => 'Scientist', 'enterable'=> false],
      18 => ['name' => 'Other', 'enterable'=> true],
    ];

    const TYPE_LIST = [
        1 => 'INVESTOR LIST',
        2 => 'COMPANY LIST',
        3 => 'STARTUP LIST',
        4 => 'PROFESSIONAL LIST',
    ];

    const MATCH_TYPES_PURPOSES = [
        1 => [
            2 => [1],
            3 => [1],
        ],
        2 => [
            1 => [3],
            2 => [3, 4, 7, 8],
            3 => [3, 4, 7, 8],
            4 => [4, 6],
        ],
        3 => [
            1 => [2, 3, 9],
            2 => [3, 4, 7, 9],
            4 => [4, 6],
        ],
        4 => [
            2 => [5],
            3 => [5],
        ]
    ];

    use HasApiTokens;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function investor()
    {
        return $this->hasOne('App\Investor', 'user_id');
    }
    public function company()
    {
        return $this->hasOne('App\Company', 'user_id');
    }
    public function entrepreneur()
    {
        return $this->hasOne('App\Entrepreneur', 'user_id');
    }
    public function freelancer()
    {
        return $this->hasOne('App\Freelancer', 'user_id');
    }
}

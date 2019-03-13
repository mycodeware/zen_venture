<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Mail\NotificationIdentifyRequestMail;
use Illuminate\Support\Facades\Mail;

class NotificationIdentifyRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:identify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification Email for Identify Request to Admin';

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
        $users = User::with([
            'investor',
            'company',
            'entrepreneur',
            'freelancer',
        ])->whereHas('investor', function ($query) {
            $query->whereNull('identified')->whereNotNull('identity_filename');
        })->orWhereHas('company', function ($query) {
            $query->whereNull('identified')->whereNotNull('identity_filename');
        })->orWhereHas('entrepreneur', function ($query) {
            $query->whereNull('identified')->whereNotNull('identity_filename');
        })->orWhereHas('freelancer', function ($query) {
            $query->whereNull('identified')->whereNotNull('identity_filename');
        })->get();
        if (!$users->isEmpty()) {
            Mail::to(json_decode(env('ADMIN_EMAILS'), true))->send(new NotificationIdentifyRequestMail($users));
            if (Mail::failures()) {
            } else {
                // Success
                foreach ($users as $user) {
                    switch ($user->type) {
                        case User::TYPE_INVESTOR:
                            $user->investor->identified = User::IDENTIFY_PENDING;
                            $user->push();
                            break;
                        case User::TYPE_COMPANY:
                            $user->company->identified = User::IDENTIFY_PENDING;
                            $user->push();
                            break;
                        case User::TYPE_ENTREPRENEUR:
                            $user->entrepreneur->identified = User::IDENTIFY_PENDING;
                            $user->push();
                            break;
                        case User::TYPE_FREELANCER:
                            $user->freelancer->identified = User::IDENTIFY_PENDING;
                            $user->push();
                            break;
                        default:
                            break;
                    }
                }
            }
        }
    }


}

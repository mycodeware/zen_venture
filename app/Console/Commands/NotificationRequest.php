<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\MatchRequest;
use App\Mail\NotificationRequestMail;
use Illuminate\Support\Facades\Mail;

class NotificationRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification Email for Match Request to Admin';

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
        $requests = MatchRequest::whereNull('status')->with([
            'from_user_all',
            'from_investor_all',
            'from_company_all',
            'from_entrepreneur_all',
            'from_freelancer_all',
            'to_user_all',
            'to_investor_all',
            'to_company_all',
            'to_entrepreneur_all',
            'to_freelancer_all',
        ])->get();
        if (!$requests->isEmpty()) {
            // delete invalid request
            foreach ($requests as $request) {
                switch ($request->from_user_all->type) {
                    case User::TYPE_INVESTOR:
                        if (is_null($request->from_investor_all)) $request->delete();
                        break;
                    case User::TYPE_COMPANY:
                        if (is_null($request->from_company_all)) $request->delete();
                        break;
                    case User::TYPE_ENTREPRENEUR:
                        if (is_null($request->from_entrepreneur_all)) $request->delete();
                        break;
                    case User::TYPE_FREELANCER:
                        if (is_null($request->from_freelancer_all)) $request->delete();
                        break;
                    default:
                        break;
                }
            }
            Mail::to(json_decode(env('ADMIN_EMAILS'), true))->send(new NotificationRequestMail($requests));
            if (Mail::failures()) {
            } else {
                // Success
                foreach ($requests as $request) {
                    $request->status = MatchRequest::STATUS_SENT;
                    $request->save();
                }
            }
        }
    }


}

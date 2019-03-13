<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Investor;
use App\Company;
use App\Entrepreneur;
use App\Freelancer;

class Profiled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $entity = null;
        $user = \Auth::user();
        switch ($user->type) {
            case User::TYPE_INVESTOR:
                $entity = Investor::where('user_id', $user->id)->first();
                break;
            case User::TYPE_COMPANY:
                $entity = Company::where('user_id', $user->id)->first();
                break;
            case User::TYPE_ENTREPRENEUR:
                $entity = Entrepreneur::where('user_id', $user->id)->first();
                break;
            case User::TYPE_FREELANCER:
                $entity = Freelancer::where('user_id', $user->id)->first();
                break;
            default:
                abort(403);
                break;
        }
        if (is_null($entity)) {
            session()->flash('message_error', 'Sorry, you need to enter initial profile information.');
            return redirect()->route('dashboard.edit');
        }
        return $next($request);
    }
}

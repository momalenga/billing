<?php

namespace Shengamo\Billing\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TeamIsSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->currentTeam->subscribed()) {
            if(!auth()->user()->currentTeam->onTrial()) {
                return redirect(route('payment'));
            }
        }
        return $next($request);
    }
}

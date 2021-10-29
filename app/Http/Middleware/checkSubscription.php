<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class checkSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->subscribe == ""){
            return redirect()->route('subscription');
        }elseif(Auth::user()->subscribe->status != 1){
            return redirect()->route('subscription');
        }
        return $next($request);
    }
}

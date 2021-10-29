<?php

namespace App\Http\Middleware;

use Closure,Auth,Session;
use Illuminate\Http\Request;

class checkStatus
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
        if(Auth::user()->status != 1){
            Auth::logout();
            Session::flash('error','Your account is inactive by admin.');
            return redirect('/login');
        }elseif(Auth::user()->is_delete != 0){
            Auth::logout();
            Session::flash('error','Your account is deleted by admin.');
            return redirect('/login');
        }else{
            return $next($request);
        }
    }
}

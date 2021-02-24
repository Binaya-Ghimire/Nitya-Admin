<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckBlockedUser
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
       if(!empty(auth()->user()->banned_at)){
            auth()->logout();
            $message = "Your account has been suspended, Please contact the Admin";
            return redirect()->route('login')->with('error', $message);
       }
        return $next($request);
    }
}

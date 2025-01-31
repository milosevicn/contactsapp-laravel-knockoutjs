<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin {
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        
        $user = Auth::user();
        if(!empty($user) && $user->role == 'admin') {
            return $next($request);
        }
        return $request->method() == "GET" ? abort(401) : response(['Unautorized'], 401);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserCustomerPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->profile_id == 1 || $request->input('user_id') == auth()->user()->id) {

            return $next($request);
        } else {
            return response('Unauthorized', 401);
        }
    }
}

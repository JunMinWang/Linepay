<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Member
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
        if (! Auth::user()) {
            return route('login');
        } elseif (Auth::user()->user_type === 'member') {
            return $next($request);
        }
        return back()->with('failed', '僅限一般會員身份');
    }
}

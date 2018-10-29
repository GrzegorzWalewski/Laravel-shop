<?php

namespace Shop\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
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
        if  (!Auth::check())
        {
            return redirect('login');
        }
        $user = Auth::user();
        if($user->isAdmin())
        {
            return $next($request);
        }
        else
        {
            abort(403, 'Unauthorized action.');
        }
    }
}

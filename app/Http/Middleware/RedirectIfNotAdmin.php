<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Gate;

use Closure;

class RedirectIfNotAdmin
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
        if (!Gate::check('isAdmin')) {
            return redirect('/home');
        }
        return $next($request);
    }
}

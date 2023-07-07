<?php

namespace App\Http\Middleware;

use App\Traits\RoleException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Guest
{
	use RoleException;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

		if (Auth::check()) {

            return back()->with('noRights', 'This operation can be performed by the guest');
		}

        return $next($request);
    }
}

<?php


namespace App\Http\Middleware;


use Illuminate\Contracts\Auth\Factory as Auth;
use Closure;
use Inertia\Inertia;


class Authenticate {

	public function __construct(Auth $auth)
	{
		$this->auth = $auth;
	}


	// ------ Get the path the user should be redirected to when they are not authenticated. ------

	protected function redirectTo($request) {

		if (! $request->expectsJson()) {

			$request->session()->flash('message419', 'Сессия истекла');


			if ($request->inertia()) {
				return Inertia::location(route('login.create'));
			}
			else {
				return redirect()->route('login.create');
			}
		}
	}


	public function handle($request, Closure $next, ...$guards)
	{

		$guards = empty($guards) ? [null] : $guards;

		foreach ($guards as $guard) {

			if ($this->auth->guard($guard)->check()) {
				$this->auth->shouldUse($guard);

				return $next($request);
			}
		}


		return $this->redirectTo($request);
	}
}

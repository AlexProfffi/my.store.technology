<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        return 5;
//        $user = $request->user();
//
//		if($user->hasRole('admin'))
//			return Inertia::location(route(RouteServiceProvider::ADMIN_HOME));
//		else
//            return redirect()->route(RouteServiceProvider::SHOP_HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
		$user = $request->user();
        $isAdmin = $user->hasRole('admin');

        Auth::logout();
        $request->session()->regenerate(true);

		if($isAdmin)
			return Inertia::location(route(RouteServiceProvider::SHOP_HOME));

		else
			return redirect()->route(RouteServiceProvider::SHOP_HOME);
    }
}

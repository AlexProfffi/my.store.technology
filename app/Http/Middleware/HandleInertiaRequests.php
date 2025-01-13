<?php

namespace App\Http\Middleware;


use Illuminate\Http\Request;
use Inertia\Middleware;
use Cart;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {

        return parent::version($request);
    }



    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $authGuard = auth()->guard();

    	$user = $authGuard->user();

        return array_merge(parent::share($request), [

            'auth' => [
                'user' => $user,
            ],

			'guest' => $user == null,


			'flash' => $request->session()->only(['noRights', 'success', 'message419', 'updateProduct', 'deleteProduct']),

			'cart' => Cart::getContent(),

			'currentRouteName' => \Route::currentRouteName(),

			'permissions' => $user ? $user->getAllPermissions() : [],

			'translations' =>
				translations(
					resource_path('lang/'. app()->getLocale() .'.json')
				),
        ]);
    }
}

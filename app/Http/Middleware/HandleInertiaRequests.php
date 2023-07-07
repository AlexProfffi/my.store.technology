<?php

namespace App\Http\Middleware;


use App\Http\Controllers\Shop\CartController;
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
    	$user = $request->user();

        return array_merge(parent::share($request), [

            'auth' => fn() => [
                'user' => $user,
            ],

			'guest' => fn() => $user == null,

			'flash' => fn() => $request->session()->only(['noRights', 'success', 'message419', 'updateProduct', 'deleteProduct']),

			'cart' => fn() => CartController::getCart(),

			'currentRouteName' => fn() => \Route::currentRouteName(),

			'permissions' => fn() => $user ? $user->getAllPermissions() : [],

			'translations' => fn() =>
				translations(
					resource_path('lang/'. app()->getLocale() .'.json')
				),
        ]);
    }
}

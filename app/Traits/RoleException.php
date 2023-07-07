<?php


namespace App\Traits;


use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

trait RoleException {

	public function redirectRoles(Request $request) {

		$user = $request->user();

		if($user->hasRole('user')) {

			return redirect()->route(RouteServiceProvider::SHOP_HOME);
		}
		elseif($user->hasRole('admin')) {

			return redirect()->route(RouteServiceProvider::ADMIN_HOME);
		}
	}

}

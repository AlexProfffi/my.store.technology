<?php

namespace App\Providers;

use App\Services\Cart\CartDbStorage;
use App\Services\Cart\CartStorage;
use Darryldecode\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cart', function ($app) {

            if(auth()->check())
                $storage = CartStorage::getAuthUserStorage();
            else
                $storage = $app['session'];

            $events = $app['events'];

            $instanceName = 'cart';

            // default session or cart identifier. This will be overridden when calling Cart::session($sessionKey)->add() etc..
            // like when adding a cart for a specific user name. Session Key can be string or maybe a unique identifier to bind a cart
            // to a specific user, this can also be a user ID
            $session_key = '4yTlTDKu3oJOfzD';

            return new Cart(
                $storage,
                $events,
                $instanceName,
                $session_key,
                config('shopping_cart')
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

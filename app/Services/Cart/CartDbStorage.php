<?php

namespace App\Services\Cart;

use App\Models\User;
use Cart;
use Darryldecode\Cart\CartCollection;

class CartDbStorage extends CartStorage
{
    private static User $user;
    private static string $sessionKeyCartItems;

    public function __construct(User $user){
        self::$user = $user;
    }

    public function get(string $sessionKeyCartItems): CartCollection|array {

        self::$sessionKeyCartItems = $sessionKeyCartItems;

        if(self::$user->cart)
            return self::$user->cart->data;
        else
            return [];
    }

    public function put(string $sessionKeyCartItems, CartCollection|array $cart): void {

        if(self::$user->cart) {

            self::$user->cart->update([
                'data' => $cart
            ]);
        }
        else {
            self::$user->cart()->create([
                'data' => $cart
            ]);
        }
    }

    /**
     * Event Login
     *
     * Merging the database with the session.
     *
     */
    public static function mergeSessionWithDb(): void {

        parent::clearContainer('cart'); // now this is the database storage

        $dbCart = Cart::getContent();

        $sessionCart = session(self::$sessionKeyCartItems);
        $sessionCartIsNotEmpty = isset($sessionCart);
        session()->forget(self::$sessionKeyCartItems);

        if($dbCart->isEmpty() && $sessionCartIsNotEmpty) {

            self::$user->cart()->create([
                'data' => $sessionCart
            ]);

            return;
        }

        if($dbCart->isNotEmpty() && $sessionCartIsNotEmpty) {

            $sessionCartAll = $sessionCart->all();
            $dbCartAll = $dbCart->all();

            self::$user->cart->update([
                'data' => new CartCollection($sessionCartAll + $dbCartAll)
            ]);
        }
    }

    /**
     * Event Logout
     *
     * Transferring the database cart to the session.
     *
     */
    public static function TransferDbToSession(User $user): void {

        parent::clearContainer('cart'); // now this is the session storage

        if($user->cart)
        {
            $dbCart = $user->cart->data
                ->toArray();
        }
        else return;

        /**
         * Session cart
         */
        $dbCart !== []
            ? Cart::add($dbCart)
            : Cart::clear();
    }
}

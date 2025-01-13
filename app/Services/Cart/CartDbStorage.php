<?php

namespace App\Services\Cart;

use Cart;
use Darryldecode\Cart\CartCollection;
use Darryldecode\Cart\ItemCollection;

class CartDbStorage extends CartStorage
{
    public function __construct() {

        parent::__construct();
    }

    /**
     * @param string $sessionKeyCartItems
     * @return CartCollection<int, ItemCollection>|array
     */
    public function get(string $sessionKeyCartItems): CartCollection|array {

        if(static::$user->cart) {

            return static::$user->cart->data;
        }
        else
            return [];
    }

    /**
     * @param string $sessionKeyCartItems
     * @param CartCollection<int, ItemCollection>|array $cart
     * @return void
     */
    public function put(string $sessionKeyCartItems, CartCollection|array $cart): void {

        if(static::$user->cart) {

            static::$user->cart->update([
                'data' => $cart
            ]);
        }
        else {
            $newCart = static::$user->cart()->create([
                'data' => $cart
            ]);

            static::$user->setRelation('cart', $newCart);
        }
    }

    /**
     * Event Login
     *
     * Merging the database with the session.
     *
     */
    public static function mergeSessionWithDb(): void {

        $sessionCart = Cart::getContent();

        if($sessionCart->isNotEmpty()) {

            static::clearContainer('cart'); // toggle cart to the db storage

            $dbCart = Cart::getContent();

            Cart::clear(); // clear the db cart

            Cart::add($sessionCart->toArray() + $dbCart->toArray()); // add to the db storage
        }
    }

    /**
     * Event Login
     *
     * Transferring the session cart to the database.
     *
     */
    public static function transferSessionToDb(): void
    {
        $sessionCart = Cart::getContent();

        static::transferNullToStorage(); // toggle cart to the db storage and it is cleaned

        if($sessionCart->isNotEmpty()) {

            Cart::add($sessionCart->toArray()); // add to db storage
        }
    }

    /**
     * Event Logout
     *
     * Transferring the database cart to the session.
     *
     */
    public static function transferDbToSession(): void {

        $dbCart = Cart::getContent();

        static::transferNullToStorage(); // toggle cart to the session storage and it is cleaned

        if($dbCart->isNotEmpty()) {

            Cart::add($dbCart->toArray()); // add to session storage
        }
    }

    /**
     * Event Logout
     *
     * Transferring null to the storage.
     *
     */
    public static function transferNullToStorage(): void
    {
        static::clearContainer('cart');

        Cart::clear();
    }
}

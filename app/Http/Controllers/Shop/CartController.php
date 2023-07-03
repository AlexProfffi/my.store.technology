<?php

namespace App\Http\Controllers\Shop;


use App\Http\Requests\Shop\CartRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Cart;
use App\Http\Controllers\Controller;


class CartController extends Controller
{

    public function addToCart(CartRequest $cartRequest, Category $category, Product $product) {

        $cartItem = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $cartRequest->quantity,
            'attributes' => [
                'image' => $product->image,
                'category' => [
                    'slug' => $category->slug
                ]
            ]
        ];

        // ------ Cart for the database -------

        if(auth()->check()) {

            $user = auth()->user();

            $cart = $user->cart->data;
            $cart[$product->id] = $cartItem;

            $user->cart->update(['data' => $cart]);
        }


        // ------ Cart for the session -------

        else
            Cart::session(1)->add($cartItem);


        return redirect()->back();
    }


    public function updateToCart(CartRequest $cartRequest, Product $product) {

        $requestItems = $cartRequest->validated();


        // ------ Cart for the database -------

        if(auth()->check()) {

            $user = auth()->user();

            if(isset($user->cart->data[$product->id])) {

                $cart = $user->cart->data;
                $cart[$product->id]['quantity'] = $requestItems['quantity'];

                $user->cart->update(['data' => $cart]);
            }
        }


        // ------ Cart for the session -------

        else
            Cart::session(1)->update($product->id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $requestItems['quantity']
                ],
            ]);


        return redirect()->back();
    }


    public static function getCart() {


        // ------ Cart for the database -------

        if(auth()->check()) {

            $user = auth()->user();

            $cart = $user->cart->data;
        }


        // ------ Cart for the session -------

        else
            $cart = Cart::session(1)->getContent();


        return $cart;
    }


    /**
     * Merging the database with the session.
     *
     * @param User $user
     * @return void
     */
    public static function mergeDbWithSession(User $user) {

        $sessionCart = Cart::session(1)->getContent()->toArray();


        if($user->cart) {

            $dbCart = $user->cart->data;

            $user->cart->update(['data' => $dbCart + $sessionCart]);
        }
        else {

            $user->setRelation('cart', $user->cart()->create());

            $user->cart->update(['data' => $sessionCart]);
        }
    }


    /**
     * Transferring the database cart to the session.
     *
     * @param User $user
     * @return void
     */
    public static function TransferDbToSession(User $user) {

        $cart = $user->cart->data;

        Cart::session(1)->add($cart);
    }

}

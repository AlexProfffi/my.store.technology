<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\Shop\CartRequest;
use App\Models\Category;
use App\Models\Product;
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

        Cart::add($cartItem);

        return redirect()->back();
    }


    public function updateToCart(CartRequest $cartRequest, Product $product) {

        $requestItems = $cartRequest->validated();

        Cart::update($product->id, [
            'quantity' => [
                'relative' => false,
                'value' => $requestItems['quantity']
            ],
        ]);

        return redirect()->back();
    }

}

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

        $requestItems = $cartRequest->validated();

        $cartItem = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $requestItems['quantity'],
            'attributes' => [
                'image' => $product->image,
                'category' => [
                    'slug' => $category->slug
                ]
            ]
        ];

        Cart::add($cartItem);
    }


    public function updateToCart(CartRequest $cartRequest, Product $product) {

        $requestItems = $cartRequest->validated();

        Cart::update($product->id, [
            'quantity' => [
                'relative' => false,
                'value' => $requestItems['quantity']
            ],
        ]);
    }

}

<?php

namespace App\Http\Controllers\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
use App\Http\Controllers\Controller;


class CartController extends Controller
{

	public function __construct(

        public Product $product
    ){}


	public function addToCart(Request $request, string $categorySlug, int $productId) {


		$product = $this->product
				->findProductWithCategories($categorySlug, $productId);


		if(empty($product && $product->categories->count())) abort(404);


        $product->makeVisible('pivot');


		Cart::add($product, $request);


		return redirect()->back();
	}
}

<?php


namespace App\Services\Cart;
use App\Models\Cart;
use App\Models\Product;
use EloquentCollection;
use Illuminate\Http\Request;


class CartCollection
{

	public function get()
	{

		// ------ Get user cart -------

        if(auth()->check()) {

			$user = auth()->user();


			if($user->cart) {

				// ------ Get cart -------

				$user->cart->load(['products' => function($query) {
					$query
						->select(['id', 'name', 'price', 'image'])

						->with(['categories' => function($query) {
							$query->select(['id', 'name', 'slug']);
						}]);
				}]);

				$cartCollection = $user->cart->products;


				// ------ Get cart categories -------

				$slugPluck = $cartCollection->pluck('pivot.slug');

				foreach($cartCollection as $index => $product)
					$product->setRelation('categories', $product->categories->where('slug', $slugPluck[$index]));
			}
			else
				$cartCollection = new EloquentCollection();

		}


		// ------ Get guest cart -------

		else {
			$cartCollection = session()->get('cartCollection');

			if(empty($cartCollection)) $cartCollection = new EloquentCollection();
		}


		return $cartCollection;
	}


	public function add(Product $product, Request $request)
	{

		// ------ Cart for the user(database) -------

		if(auth()->check()) {

			$user = auth()->user();


			// ------ Add cart -------

			if(!$user->cart)
				$user->setRelation('cart', Cart::create(['user_id' => $user->id]));


			// ------ Add product to cart -------

			$user->cart->products()->sync([$product->id =>
				[
					'quantity' => $request->quantity,
					'slug' => $product->categories[0]->slug
				]
			], false);
		}


		// ------ Cart for the guest(session) -------

		else {

			$cartCollection = session()->get('cartCollection');


			if(empty($cartCollection)) $cartCollection = new EloquentCollection();


			// ------ Add product to cart -------

			if(empty($cartCollection[$product->id])) {

				$cartCollection[$product->id] = $product;

				$cartCollection[$product->id]->pivot = new \stdClass();

				$cartCollection[$product->id]->pivot->slug = $cartCollection[$product->id]->categories[0]->slug;
				$cartCollection[$product->id]->pivot->quantity = $request->quantity;
			}


			// ------ Update the quantity of the product in the cart -------

			else {

				$cartCollection[$product->id]->pivot->quantity = $request->quantity;
			}


			session()->put('cartCollection', $cartCollection);
		}

	}


	public function mergeCarts() {

		// ------ Merge carts (db and session) -------

		if(session()->has('cartCollection')) {

			$user = auth()->user();

			if(!$user->cart)
				$user->setRelation('cart', Cart::create(['user_id' => $user->id]));

			$cartCollection = session()->get('cartCollection');


			$syncData = [];

			foreach ($cartCollection as $product)
				$syncData[$product->id] = [
					'quantity' => $product->pivot->quantity,
					'slug' => $product->pivot->slug
				];

			$user->cart->products()->sync($syncData, false);


			session()->forget('cartCollection');
		}

	}


	//	public function remove($productCode, $request)
	//	{
	//		$cartCollection = session()->get('cartCollection');
	//
	//
	//		if($request->boolean('delete')) {
	//
	//			unset($cartCollection[$productCode]);
	//		}
	//
	//
	//		session()->put('cartCollection', $cartCollection);
	//	}


//	public function remove($productCode, $request)
//	{
//		$cartCollection = session()->get('cartCollection');
//
//
//		$cartCollection[$productCode]->quantity -= $request->quantity;
//
//
//		if($cartCollection[$productCode]->quantity <= 0 || $request->boolean('delete')) {
//
//			unset($cartCollection[$productCode]);
//		}
//
//
//		session()->put('cartCollection', $cartCollection);
//	}

}

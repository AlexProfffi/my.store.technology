<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Cart;


class ProductController extends Controller
{
    public function __construct(

        public Category $category
    ) {}

    public function index() {

//        session()->flush();
        $categories =
            $this->category->getCategoriesWithRelations();

        return Inertia::render('Shop/Products/Index', [
            'categories' => $categories,
        ]);
    }

	public function show(Category $category, Product $product) {

		return Inertia::render('Shop/Products/Show', [
            'category' => $category,
			'product' => $product
		]);
	}
}

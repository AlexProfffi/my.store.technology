<?php

namespace App\Http\Controllers\Shop;


use App\Http\Requests\Shop\ProductRequest;
use App\Models\Category;
use App\Models\Label;
use App\Models\Product;
use App\Services\Filterer\ProductFilterer;
use Inertia\Inertia;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{

	public function __construct(

        public Category $category,
        public Label $label
    ){}


	public function index() {

        $categories = $this->category
            ->select(['id', 'name', 'slug', 'description'])->get();


		return Inertia::render('Shop/Categories', [
			'categories' => $categories,
		]);
	}



    public function show(ProductRequest $productRequest, Category $category)
    {
        $requestItems = $productRequest->validated();


		$labels = $this->label
            ->select(['id', 'name'])->get();


        $productFilterer = new ProductFilterer($requestItems);


		$category->paginateProductsWithRelations($productFilterer);


		return Inertia::render('Shop/Category', [
			'category' => $category,
			'labels' => $labels,
		]);
	}
}

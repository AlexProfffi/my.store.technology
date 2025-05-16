<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\Shop\ProductRequest;
use App\Models\Category;
use App\Models\Label;
use App\Services\Filter\ProductFilter;
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

		return Inertia::render('Shop/Categories/Index', [
			'categories' => $categories,
		]);
	}

    public function show(ProductRequest $productRequest, Category $category)
    {
        $validatedData = $productRequest->validated();

        $productFilter = new ProductFilter($validatedData);
        $queryProductFilter = $category->products()->filters($productFilter);

        $category->paginateProductsWithRelations($queryProductFilter);
//        $validatedData['price_from'] ??= $queryProductFilter->min('price');
//        $validatedData['price_to'] ??= $queryProductFilter->max('price');

        $labels = $this->label
            ->select(['id', 'name'])->get();

		return Inertia::render('Shop/Categories/Show', [
            'backendFilter' => [
                'fields' => $validatedData[$productRequest->prefix] ?? $validatedData,
                'prefix' => $productRequest->prefix
            ],
			'category' => $category,
			'labels' => $labels
		]);
	}
}

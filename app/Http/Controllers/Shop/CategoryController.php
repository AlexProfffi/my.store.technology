<?php

namespace App\Http\Controllers\Shop;


use App\Http\Requests\Shop\ProductRequest;
use App\Models\Category;
use App\Models\Label;
use App\Services\Filter\ProductFilter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


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
        $requestItems = $productRequest->validated();


//        $requestItems =
//            $category->initialValuesProductFilterer($requestItems);

        // Product Filter
        $productFilter = new ProductFilter($requestItems);
        $queryProductFilter = $category->products()->filters($productFilter);

        // Using a Product Filter
        $minPrice = $queryProductFilter->min('price');
        $maxPrice = $queryProductFilter->max('price');

		$category->paginateProductsWithRelations($queryProductFilter);
        // ----------------------

        $labels = $this->label
            ->select(['id', 'name'])->get();

		return Inertia::render('Shop/Categories/Show', [
			'category' => $category,
			'labels' => $labels,
            'validationInitialValues' => [
                'label_ids' => $requestItems['label_ids'] ?? [],
                'price_from' => $requestItems['price_from'] ?? $minPrice,
                'price_to' => $requestItems['price_to'] ?? $maxPrice,
            ]
		]);
	}
}

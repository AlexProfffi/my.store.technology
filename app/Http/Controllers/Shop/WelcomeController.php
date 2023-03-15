<?php


namespace App\Http\Controllers\Shop;


use App\Http\Requests\Shop\ProductRequest;
use App\Models\Label;
use App\Models\Product;
use App\Services\Filterer\ProductFilterer;
use Inertia\Inertia;
use App\Http\Controllers\Controller;


class WelcomeController extends Controller
{

    public function __construct(

        public Product $product,
        public Label $label
    ) {}



    public function index(ProductRequest $productRequest)
    {
        $requestItems = $productRequest->validated();


        $labels = $this->label
            ->select(['id', 'name'])->get();


        $productFilterer = new ProductFilterer($requestItems);


        $products = $this->product
            ->paginateProductsWithRelations($productFilterer);


        return Inertia::render('Shop/Welcome', [
            'products' => $products,
            'labels' => $labels,
        ]);
    }

}

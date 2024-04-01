<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Uploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Label;
use App\Models\Product;
use App\Models\Category;
use App\Services\Uploader\ImageUploader;
use App\Services\Uploader\VideoUploader;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


class ProductController extends Controller
{

    public $product,
		   $label,
		   $category;


    public function __construct() {

    	$this->product = new Product();
    	$this->label = new Label();
		$this->category = new Category();
	}


	// ---------- /dashboard/products -----------

    public function index() {


		// ------ Paginate products->categories -------

		$products = $this->product
			->paginateProductsCategoriesDP();


		return Inertia::render('Admin/Products/Index', [
			'products' => $products,
		]);
	}


	public function create() {


		// ------ Get categories -------

    	$categories = $this->category
			->getCategoriesDPC();


		// ------ Get labels -------

		$labels = $this->label
			->getLabelsDPC();


		return Inertia::render('Admin/Products/Create', [
			'categories' => $categories,
			'labels' => $labels
		]);
	}



    public function store(ProductRequest $productRequest, ImageUploader $imageUploader) {

		$form = collect($productRequest->validated());


		$form['image'] =
			$imageUploader->upload($form['image']);


    	$product = $this->product
			->create($form->except(['category_ids', 'label_ids'])->toArray());

		$product->categories()->attach($form['category_ids']);
		$product->labels()->attach($form['label_ids'] ?? null);



    	return back()->with('success', __("Product added"));
	}


	public function edit($product) {


		// ------ Get categories -------

		$categories = $this->category
			->getCategoriesDPCE();


		// ------ First product -------

		$product = $this->product
			->firstProductDPCE($product);


			// ------ product->category_ids(pluck, map) -------

			$product->category_ids = $product->categories()
				->pluck('id')
				->map(fn($item) => strval($item));


			// ------ product->label_ids(pluck) -------

			$product->label_ids = $product->labels()
					->pluck('id');


		// ------ Get labels -------

		$labels = $this->label
			->getLabelsDPCE();


		return Inertia::render('Admin/Products/Edit', [
			'categories' => $categories,
			'labels' => $labels,
			'product' => $product
		]);
	}


	public function update(ProductRequest $productRequest, Product $product) {

		$form = collect($productRequest->validated());


		// ------ Image Upload -------

		if(isset($form['image'])) {

			$imageUploader = new ImageUploader();
			$form['image'] = $imageUploader->upload($form['image']);
		}
		else unset($form['image']);


		// ------ Update updated_at -------

		$form['updated_at'] = date("Y-m-d H:i:s");


		// ------ Update product -------

		$product->update($form->except(['category_ids', 'label_ids'])->toArray());

		$product->categories()->sync($form['category_ids']);
		$product->labels()->sync($form['label_ids']);


		return redirect()->route('dashboard.products')->with('updateProduct', 'product updated');
	}


	public function destroy(Product $product) {

    	$product->delete();

    	return redirect()->route('dashboard.products')->with(['deleteProduct' => 'product deleted']);
	}
}

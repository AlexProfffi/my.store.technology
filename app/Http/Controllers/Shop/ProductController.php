<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Inertia\Inertia;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    public function __construct(
        public Category $category
    ) {

    }

    public function index() {

        $user = User::find(1);

        $user->addRent([
            ['name' => 'Гарри поттер', 'days' => 4],
            ['name' => 'Гарри поттер', 'days' => 4],
            ['name' => 'Копи Царя Соломона', 'days' => 2],
            ['name' => 'Гарри поттер', 'days' => 3],
        ]);

        dump($user->showRentStatement());





//        $user->rent('Гарри поттер', 4);
//        $user->rent('Копи Царя Соломона', 2);

//        $ll = $user->rents()->select('days', DB::raw('count(*) as count'))->groupBy('movie_id', 'days')->get()->map(function ($item) {
//            return [
//                'count' => $item->count,
//                'days' => $item->days,
//                'oo' => 3
//            ];
//        });


//
//        $user->load('rents');
//        dump($user);




//        $user->rent('Гарри поттер', 4);
//        $user->rent('Копи Царя Соломона', 2);
//        dump($user->showRentStatement());

        //$user->rentals()->create(['movie_id' => 1, 'days' => 2, 'rented_at' => now()]);



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

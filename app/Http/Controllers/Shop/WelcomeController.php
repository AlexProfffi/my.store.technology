<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use Inertia\Inertia;
use Cart;
use App\Http\Controllers\Controller;


class WelcomeController extends Controller
{

    public function __construct(

        public Category $category
    ) {}


    public function index() {
//        session()->flush();
//        Cart::session(1)->clear();

        $categories = $this->category
            ->getCategoriesWithRelations();


        return Inertia::render('Shop/Welcome', [
            'categories' => $categories,
        ]);
    }

}

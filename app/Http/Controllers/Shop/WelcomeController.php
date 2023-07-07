<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use App\Models\Product;
use App\Services\Lion;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Cart;


//class a{
//
//    public static $test="class a";
//    public function static_test(){
//
//       $test = new static();
//       dump($test);
//
//    }
//
//}
//
//class b extends a{
//
//    public static $test="class b";
//
//
//}


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

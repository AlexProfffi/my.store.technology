<?php

namespace App\Http\Controllers\Shop;

use App\Contracts\Uploader;
use App\Events\TestEvent;
use App\Jobs\ProcessPodcast;
use App\Models\Category;
use App\Models\Product;
use App\Services\Chirik;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Facade;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Cart;


class WelcomeController extends Controller
{
    public function __construct(

        public Category $category
    ) {}

    public function index() {

//        session()->flush();
//        Cart::session(1)->clear();

        //ProcessPodcast::dispatch();
        $categories = $this->category
            ->getCategoriesWithRelations();


        return Inertia::render('Shop/Welcome', [
            'categories' => $categories,
        ]);
    }

}

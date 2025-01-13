<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ProductController as DashboardProductController;


// -------- Products ----------

Route::get('/', [ProductController::class, 'index'])
	->name('products.index');

Route::get('products/{category:slug}/{product:id}', [ProductController::class, 'show'])
    ->name('products.show');


// -------- Categories ----------

Route::get('/categories', [CategoryController::class, 'index'])
	->name('categories.index');

Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])
	->name('categories.show');


// --------Cart ----------

Route::get('/cart', [CartController::class, 'cart'])
    ->name('cart.index');

Route::post('/cart/{category:slug}/{product:id}', [CartController::class, 'addToCart'])
	->name('cart.store');

Route::patch('/cart/{product:id}', [CartController::class, 'updateToCart'])
    ->name('cart.update');


Route::middleware(['auth'])->group(function () {

	// -------- /logout ----------

	Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
		->name('logout.store');

});


Route::middleware(['role:admin'])->group(function () {


	// -------- /dashboard ----------

	Route::get('/dashboard', [DashboardController::class, 'index'])
		->name('dashboard');


	// -------- /dashboard/products ----------

	Route::get('/dashboard/products', [DashboardProductController::class, 'index'])
		->name('dashboard.products');

	Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])
			->name('dashboard.products.create');

	Route::get('/dashboard/products/{product}/edit', [DashboardProductController::class, 'edit'])
		->name('dashboard.products.product.edit');

	Route::patch('/dashboard/products/{product}', [DashboardProductController::class, 'update'])
		->name('dashboard.products.product.update');

	Route::post('/dashboard/products', [DashboardProductController::class, 'store'])
		->name('dashboard.products.store');

	Route::delete('/dashboard/products/{product}', [DashboardProductController::class, 'destroy'])
		->name('dashboard.products.product.destroy');
});


//Route::middleware(['guest'])->group(function () {

// -------- /register ----------

Route::get('/register/create', [RegisteredUserController::class, 'create'])
    ->name('register.create');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register.store');


// -------- /login ----------

Route::get('/login/create', [AuthenticatedSessionController::class, 'create'])
    ->name('login.create');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store');

//});





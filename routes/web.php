<?php


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ProductController as DashboardProductController;
use Illuminate\Validation\Rules;


// -------- Products ----------

Route::get('/gost', function () {
    //Cookie::queue('doma', 'homa', 5);



    return 2;
})->middleware('test');

Route::get('/csrf-cookie', function () {
   return ['message' => 'csrf-cookie set successfully'];
});

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


Route::middleware(['auth:sanctum'])->group(function () {

	// -------- /logout ----------

	Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
		->name('logout.store');


    Route::get('/yes', function (Request $request) {

        return $request->user()->can('log');
    });
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

Route::post('/register/token', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->assignRole('user');

    event(new Registered($user));

    return ['token' => $user->createToken('token')->plainTextToken];
});


// -------- /login ----------

Route::get('/login/create', [AuthenticatedSessionController::class, 'create'])
    ->name('login.create');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store');


Route::post('/login/token', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if(! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

//    return ['token' => $user->createToken('token', ['alex:update'])->plainTextToken];
    return ['token' => $user->createToken('token', ['alex:update'])->plainTextToken];
});





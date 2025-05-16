<?php

use App\Http\Requests\Shop\ProductRequest;
use App\Models\Category;
use App\Services\Filter\ProductFilter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function (ProductRequest $productRequest) {

    $validatedData = $productRequest->validated();
    $category = Category::find(1);

    $category = Cache::remember('productFilter', 3600, function() use($validatedData, $category) {

        $productFilter = new ProductFilter($validatedData);
        $queryProductFilter = $category->products()->filters($productFilter);
        $category->paginateProductsWithRelations($queryProductFilter);

        return $category;
    });

    //Cache::put('productFilter', 14, 3600);
    return $category;
});

Route::get('/token', function (Request $request) {

    $token = $request->user()->createToken('MyFirstToken');

    return ['token' => $token->plainTextToken];
});


//Route::middleware(['auth:sanctum'])->group(function () {
//
//    Route::get('/yes', function (Request $request) {
//
//        return $request->user()->can('logout');
//    });
//
//});


//Route::post('/login/token', function (Request $request) {
//
//    $request->validate([
//        'email' => 'required|email',
//        'password' => 'required',
//    ]);
//
//    $user = User::where('email', $request->email)->first();
//
//    if(! $user || ! Hash::check($request->password, $user->password)) {
//        throw ValidationException::withMessages([
//            'email' => ['The provided credentials are incorrect.'],
//        ]);
//    }
//
////    return ['token' => $user->createToken('token', ['alex:update'])->plainTextToken];
//    return ['token' => $user->createToken('token', ['alex:update'])->plainTextToken];
//});









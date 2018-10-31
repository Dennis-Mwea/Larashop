<?php

use Illuminate\Http\Request;
use Larashop\Models\Category;
use Larashop\Models\Product;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('register', 'Api\Auth\RegisterController@register');
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('refresh', 'Api\Auth\LoginController@refresh');
Route::post('social_auth', 'Api\Auth\SocialAuthController@socialAuth');


Route::get('brands', 'Api\HotelApi\BrandsController@index');
Route::get('brands2', 'Api\HotelApi\BrandsController@index2');
Route::get('category', 'Api\HotelApi\CategoryController@index');
Route::get('categories', function(Request $request) {
    // $posts = Category::where('brand_id', request('id'))->get();

    $posts = Category::get();

    $response['categories'] = $posts;
    $response['success'] = 1;

    return response()->json(Category::get());
});
Route::get('products', 'Api\HotelApi\ProductController@index');


Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'Api\Auth\LoginController@logout');

    Route::get('posts', 'Api\PostController@index');

    Route::get('user', 'Api\Auth\LoginController@user');

    Route::put('update_user', 'Api\HotelApi\UserDetailController@updateUserDetails');
});

Route::get('product_list', function() {
    $products = Product::get();

    return response()->json(['data' => $products], 200, [], JSON_NUMERIC_CHECK);
});
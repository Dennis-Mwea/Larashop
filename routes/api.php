<?php

use Illuminate\Http\Request;

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
Route::get('categories', 'Api\HotelApi\CategoryController@index');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'Api\Auth\LoginController@logout');

    Route::get('posts', 'Api\PostController@index');

    Route::get('user', 'Api\PostController@user');

    // Route::resource('brands', 'Admin\BrandsController');
});
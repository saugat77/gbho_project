<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::name('api.')->group(function () {
    Route::get('image-sliders', 'API\ImageSliderController@index')->name('image-sliders.index');
});


Route::name('api.')->group(function () {
    Route::get('product/{product}/product-images', 'ProductImageController@index')->name('product-images.index');
    Route::post('product-images', 'ProductImageController@store')->name('product-images.store');
    Route::delete('product-images/{productImage}', 'ProductImageController@destroy')->name('product-images.destroy');
});

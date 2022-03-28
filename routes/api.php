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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('categories','Api\CategoryController@index');
// Route::get('categories/{category}','Api\CategoryController@show');
// Route::post('categories','Api\CategoryController@store');
// Route::put('categories/{category}','Api\CategoryController@update');
// Route::delete('categories/{category}','Api\CategoryController@destroy');

Route::apiResource('categories','Api\CategoryController');
//
Route::get('/test', function () {
    return response()->json(['testing'=>True]);
});

/*

methods from an Resource:
index, create, store, show, edit, update, destroy
methods from an apiResource:
index, store, show, update, destroy
*/

Route::get('products','Api\ProductController@index');

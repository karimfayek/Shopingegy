<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/homebanners', 'API\ProductController@homeBanners');
Route::get('/brands', 'API\ProductController@brands');
Route::get('/homecats', 'API\ProductController@HomeCats');
Route::get('/catproducts/{slug}', 'Site\CategoryController@show');
Route::get('/product/{id}', 'API\ProductController@Product');
Route::get('/cats/{slug}', 'API\ProductController@Cats');
Route::get('/cats', 'API\ProductController@AllCats');
Route::get('/brand/{slug}', 'API\ProductController@Brand');
Route::post('/filter-products',  'API\ProductController@filterProducts');
Route::post('/filter-products/brand',  'API\ProductController@filterProductsBrand');
Route::get('/rprs', 'API\ProductController@Rprs');
Route::get('/sprs', 'API\ProductController@Sprs');
Route::get('/bsprs', 'API\ProductController@Bsprs');
Route::post('/login',  'API\LoginController@login');
Route::middleware('auth:sanctum')->post('/logout',  'API\LoginController@logout');
Route::middleware('auth:sanctum')->post('/initiate-payment',  'API\CheckoutController@InitiatePayment');

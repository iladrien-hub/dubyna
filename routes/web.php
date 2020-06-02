<?php

use Illuminate\Support\Facades\Route;
use App\Product;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'PageController@home']);
Route::get('home', ['as' => 'home', 'uses' => 'PageController@home']);

Route::get('catalog',['as' => 'catalog', 'uses' => 'PageController@catalog']);

Route::get('sale',['as' => 'sale', 'uses' => 'PageController@sale']);

Route::get('gallery',['as' => 'gallery', 'uses' => 'PageController@gallery']);

Route::get('cart',['as' => 'cart', 'uses' => 'PageController@cart']);

Route::post('cart_add_product',['as' => "cart_add_product", 'uses' => 'AjaxController@addProduct']);
Route::post('cart_remove_product',['as' => "cart_remove_product", 'uses' => 'AjaxController@removeProduct']);
Route::post('special_cart_remove_product',['as' => "special_cart_remove_product", 'uses' => 'AjaxController@removeSpecialProduct']);

Route::post('validate_coupon',['as' => "validate_coupon", 'uses' => 'AjaxController@validateCoupon']);

Route::post('cart_commit',['as' => "cart_commit", 'uses' => 'CartController@commit']);

Route::get('custom',['as' => "custom_request_form", 'uses' => 'CustomRequestController@getForm']);
Route::post('custom',['as' => "custom_request_commit", 'uses' => 'CustomRequestController@upload']);
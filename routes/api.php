<?php

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

// Payments
Route::middleware('web')->post('/checkout-validation', 'License\ApiLicenseController@generateAuthorizationWS')->name('checkout-validation');
// Lists
Route::middleware('web')->get('/sales', 'Sale\ApiSaleController@getList')->name('api-sales-list');
Route::middleware('web')->get('/sales-ecommerce', 'Sale\ApiSaleController@getListEcommerce')->name('api-sales-ecommerce-list');
Route::middleware('web')->get('/warehouses', 'Warehouse\ApiWarehouseController@getList')->name('api-warehouses-list');
Route::middleware('web')->get('/products', 'Product\ApiProductController@getList')->name('api-products-list');
Route::middleware('web')->get('/clients', 'Client\ApiClientController@getList')->name('api-clients-list');
Route::middleware('web')->get('/orders', 'Order\ApiOrderController@getList')->name('api-orders-list');
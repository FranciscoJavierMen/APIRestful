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
/*
* Ruta para Buyer
*/
Route::resource('buyers', 'Buyer\BuyerController', ['only' => ['index', 'show']]);
/*
* Ruta para Categories
*/
Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit']]);
/*
* Ruta para Product
*/
Route::resource('products', 'Product\ProductController', ['only' => ['index', 'show']]);
/*
* Ruta para Tranzactions
*/
Route::resource('transactions', 'Transaction\TransactionController', ['only' => ['index', 'show']]);
Route::resource('transactions.categories', 'Transaction\TransactionCategoryController', ['only' => ['index']]);
/*
* Ruta para Seller
*/
Route::resource('sellers', 'Seller\SellerController', ['only' => ['index', 'show']]);
/*
* Ruta para Users
*/
Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);


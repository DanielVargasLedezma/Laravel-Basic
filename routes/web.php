<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('products/{id}', [PagesController::class, 'showProduct'])->where('id','[0-9]+');

// Route::get('productsName/{name}', [PagesController::class, 'showName'])->where('name','[a-zA-Z]+');

Route::get('/', [PagesController::class, 'index']);
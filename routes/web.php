<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;

use App\Http\Controllers\ArticlesController;

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

// Route::get('/', [PagesController::class, 'index']);

Route::get('/articles/{last?}', [ArticlesController::class, 'getArticles']);

Route::get('/article/{id}', [ArticlesController::class, 'getArticle'])->where('id', '[0-9]+');

Route::post('/create-article', [ArticlesController::class, 'createArticle']);

Route::delete('/article/{id}', [ArticlesController::class, 'deleteArticle'])->where('id', '[0-9]+');
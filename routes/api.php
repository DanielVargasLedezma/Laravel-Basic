<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UsersController;

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

Route::middleware('auth:api')->prefix('v1')->group(function() {
    
    Route::get('/user', function(Request $request) {
        return $request->user();
    });

    Route::apiResource('/articles', ArticlesController::class);
    
    Route::apiResource('/users', UsersController::class);
    
    Route::get('/articles-all/{last?}', [ArticlesController::class, 'showArticles']);
    
    Route::post('/articles/upload-image/{article}', [ArticlesController::class, 'storeImage']);

    Route::get('/articles/get-image/{article}', [ArticlesController::class, 'getImage']);
    
    Route::get('/articles/search/{search}', [ArticlesController::class, 'search']);
    
    Route::get('/articles/user/{user_id}', [ArticlesController::class, 'articlesPerUser']);
    

    // Route::get('/articles/{last?}', [ArticlesController::class, 'index']);

    // Route::get('/article/{id}', [ArticlesController::class, 'show']);  
    
    // Route::post('/create-article', [ArticlesController::class, 'createArticle']);
    
    // Route::delete('/article/{id}', [ArticlesController::class, 'deleteArticle']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

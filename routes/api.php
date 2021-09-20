<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;

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

    Route::get('/article/{id}', [ArticlesController::class, 'show']);

    Route::get('/articles/{last?}', [ArticlesController::class, 'showMultiple']);
    
    Route::post('/create-article', [ArticlesController::class, 'createArticle']);
    
    Route::delete('/article/{id}', [ArticlesController::class, 'deleteArticle']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CodeController;
use Illuminate\Support\Facades\Route;
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

Route::prefix('v1')->group(function() {
    
    Route::get('/articles-all/{last?}', [ArticlesController::class, 'index']);

    Route::get('/articles/{article}', [ArticlesController::class, 'show']);

    Route::get('/articles/get-image/{article}', [ArticlesController::class, 'getImage']);
    
    Route::get('/articles/search/{search}', [ArticlesController::class, 'search']);
    
    Route::get('/articles/user/{user_id}', [ArticlesController::class, 'articlesPerUser']);
    
    Route::post('/users', [UsersController::class, 'store']);

    Route::post('/login', [UsersController::class, 'login']);

    Route::post('/reset-password/{email}', [CodeController::class, 'resetPasswordCode']);

    Route::post('/check-code/{user}', [CodeController::class, 'checkCode']);

    Route::post('/reset-password/users/{id}', [UsersController::class, 'resetPassword']);
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function() {
    
    Route::get('/user', function(Request $request) {
        return $request->user();
    });

    // Route::apiResource('/articles', ArticlesController::class);
    
    // Route::apiResource('/users', UsersController::class);
    
    Route::post('/articles', [ArticlesController::class, 'store']);
    
    Route::put('/articles/{article}', [ArticlesController::class, 'update']);
    
    Route::post('/articles/upload-image/{article}', [ArticlesController::class, 'storeImage']);
    
    Route::delete('/articles/{article}', [ArticlesController::class, 'destroy']);
  
    Route::get('/users', [UsersController::class, 'index']);

    Route::get('/users/{user}', [UsersController::class, 'show']);

    Route::put('/users/{user}', [UsersController::class, 'update']);

    Route::delete('/users/{user}', [UsersController::class, 'destroy']);

    Route::post('/logout/{user}', [UsersController::class, 'logout']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

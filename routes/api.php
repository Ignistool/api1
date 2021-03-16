<?php

use App\Http\Controllers\v1\Manager\AuthController;
use App\Http\Controllers\v1\Manager\ContaController;
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

Route::group(['prefix' => 'v1'], function () {

    // Tenant
    Route::group(['prefix' => 'customer'], function () {

    });

    // Gerenciador
    Route::group(['prefix' => 'manager'], function () {
        Route::apiResource('contas', ContaController::class);

        Route::group(['prefix' => 'auth'], function(){
            Route::post('login', [AuthController::class, 'login']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::post('me', [AuthController::class, 'me']);
        });
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

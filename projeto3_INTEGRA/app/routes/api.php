<?php

use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ApplicationController as UserApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


Route::group(['prefix' => 'v1', 'name' => 'api.v1'], function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', [AuthController::class, 'logout']);

        Route::group(['prefix' => 'apps'], function() {
            Route::get('', [UserApplicationController::class, 'index']);
            Route::get('{app_id}', [AdminApplicationController::class, 'show']);
        });

        // Rotas para administradores da plataforma
        Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function() {
            Route::group(['prefix' => 'apps'], function() {
                Route::get('', [AdminApplicationController::class, 'index']);
                Route::post('', [AdminApplicationController::class, 'store']);

                Route::group(['prefix' => '{app_id}'], function() {
                    Route::get('', [AdminApplicationController::class, 'show']);
                    Route::put('', [AdminApplicationController::class, 'update']);
                    Route::delete('', [AdminApplicationController::class, 'delete']);

                    Route::group(['prefix' => 'modules'], function(){
                        Route::get('', [AdminModuleController::class, 'index']);
                        Route::post('', [AdminModuleController::class, 'store']);

                        Route::group(['prefix' => '{module_id}'], function() {
                            Route::get('', [AdminModuleController::class, 'show']);
                            Route::put('', [AdminModuleController::class, 'update']);
                        });
                    });
                });
            });
        });
    });
});
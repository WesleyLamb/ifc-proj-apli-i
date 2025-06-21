<?php

use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ApplicationController as UserApplicationController;
use App\Http\Controllers\User\EstablishmentController as UserEstablishmentController;
use App\Http\Controllers\User\EstablishmentLicenseController as UserEstablishmentLicenseController;
use App\Http\Controllers\User\UserController as UserUserController;
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
    Route::group(['prefix' => 'auth'], function() {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('refresh', [AuthController::class, 'refresh']);

        Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    });

    Route::group(['middleware' => 'auth:api'], function() {


        Route::get('users/me', [UserUserController::class, 'showMe']);

        Route::group(['prefix' => 'apps'], function() {
            Route::get('', [UserApplicationController::class, 'index']);
            Route::get('{application_id}', [UserApplicationController::class, 'show']);
        });

        Route::group(['prefix' => 'establishments'], function() {
            Route::get('', [UserEstablishmentController::class, 'index']);
            Route::post('', [UserEstablishmentController::class, 'store']);
            Route::group(['prefix' => '{establishment_id}'], function() {
                Route::get('', [UserEstablishmentController::class, 'show']);
                Route::put('', [UserEstablishmentController::class, 'update'])->middleware('can.on.establishment:establishment.update');

                Route::group(['prefix' => 'licenses'], function () {
                    Route::get('', [UserEstablishmentLicenseController::class, 'index']);

                    Route::group(['prefix' => '{license_id}'], function () {
                        Route::get('', [UserEstablishmentLicenseController::class, 'show']);

                        Route::group(['prefix' => 'application'], function () {
                            Route::post('', [UserEstablishmentLicenseController::class, 'addApplication'])->middleware('can.on.establishment:establishment.license');
                        });
                    });
                });
            });
        });

        // Rotas para administradores da plataforma
        Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function() {
            Route::group(['prefix' => 'apps'], function() {
                Route::get('', [AdminApplicationController::class, 'index']);
                Route::post('', [AdminApplicationController::class, 'store']);

                Route::group(['prefix' => '{application_id}'], function() {
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
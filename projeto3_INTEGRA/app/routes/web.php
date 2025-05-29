<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/kc/redirect', function () {

    return Socialite::driver('keycloak')->redirect();

});



Route::get('/auth/kc/callback', function () {

    $user = Socialite::driver('keycloak')->user();
    dd($user);


    // $user->token

});

Route::get('/mac', function (Request $request) {
    dd($request);
});
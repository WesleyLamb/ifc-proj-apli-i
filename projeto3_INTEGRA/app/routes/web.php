<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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

Route::get('storage/{file}', function (Request $request) {
    // dd($request->route('file'));
    // dd(asset('storage/'.$request->route('file')));
    if (! file_exists(public_path('storage/'.$request->route('file')))) {
        abort(404);
    }
    return response()->file(public_path('storage/'.$request->route('file')));
});
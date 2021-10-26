<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/test', function () {
    return response()->json([
        'students' => ['Cristina', 'Alessandro', 'Damiano', 'Rocco'],
        'teacher' => 'Marco',
        'total' => 32
    ]);
});



Route::namespace('Api')->group(function () {
    // Route::resource('posts', 'PostController');
    Route::get('/posts', 'PostController@index');
});

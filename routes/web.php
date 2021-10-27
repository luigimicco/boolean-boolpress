<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/contatti', 'MailController@contact')->name('contatti');
Route::post('/contatti', 'MailController@handleContactForm')->name('contatti.invio');
Route::get('/tks', 'MailController@thank')->name('contatti.thank');

Auth::routes(['register' => true]);


//# ROTTE PER CUI SI NECESSITA L'AUTENTICAZIONE
Route::middleware('auth')->name('admin.')->prefix('admin')->namespace('Admin')->group(function () {
    // tutte le rotte protette
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::get('/{any}', function () {
        abort(404);
    });
});


// # gestiamo tutte le rotte che non sono di auth (login, register ecc) e neanche di /admin
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');

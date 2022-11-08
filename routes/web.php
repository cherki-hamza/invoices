<?php

/*
*   Author  : cherki hamza
*   Website : hamzacherki.com
*   this is the routes of app
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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






Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function(){

    //Auth::routes(['register'=> false]);

    Auth::routes();

    Route::get('/', function () {
        return view('ex.welcome');
    })->name('home');

    //Route::get('/{page}', 'backend\AdminController@pages');



});

Route::get('/', function () {
    return view('ex.welcome');
})->name('file');












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

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

        /** Formulário de Login*/
        Route::get('/', 'AuthController@showLoginForm')->name('login');
        Route::post('/', 'AuthController@login')->name('login.do');

        /** Rotas Protegidas */
        Route::group(['middleware' => ['auth']],function (){
            //** Dashboard Home */
            Route::get('home', 'AuthController@home')->name('home');

            Route::get('users/team', 'UserController@team')->name('users.team');
            Route::resource('users','UserController');

        });


        /** Logout */
        Route::get('logout', 'AuthController@logout')->name('logout');

    });

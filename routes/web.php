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

            //** usuários */
            Route::get('users/team', 'UserController@team')->name('users.team');
            Route::resource('users','UserController');

            /** Empresas */
            Route::resource('companies','CompanyController');

            /** imóveis */
            Route::post('properties/image-get-cover','PropertyController@imageSetCover')->name('properties.imageSetCover');
            Route::delete('properties/image-remove','PropertyController@imageRemove')->name('properties.imageRemove');
            Route::resource('properties','PropertyController');

            /** Contratos */
            Route::post('contracts/get-data-owner','ContractController@getDataOwner')->name('contracts.getDataOwner');
            Route::post('contracts/get-data-acquirer','ContractController@getDataAcquirer')->name('contracts.getDataAcquirer');
            Route::resource('contracts','ContractController');

        });


        /** Logout */
        Route::get('logout', 'AuthController@logout')->name('logout');

    });

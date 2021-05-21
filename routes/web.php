<?php

use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\RoleController;

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

    Route::group([
        'namespace' => 'Web', 'as' => 'web.'
    ],function (){
        // Home Page
        Route::get('/', 'WebController@home')->name('home');
        Route::get('/destaque', 'WebController@spotlight')->name('spotlight');
        Route::get('/quero-alugar', 'WebController@rent')->name('rent');
        Route::get('/quero-alugar/{slug}', 'WebController@rentProperty')->name('rentProperty');
        Route::get('/quero-comprar', 'WebController@sale')->name('sale');
        Route::get('/quero-comprar/{slug}', 'WebController@saleProperty')->name('saleProperty');
        Route::match(['post','get'],'/filtro', 'WebController@filter')->name('filter');
        Route::get('/contato', 'WebController@contact')->name('contact');
        Route::post('/contato/sendEmail', 'WebController@sendEmail')->name('sendEmail');
        Route::get('/contato/sucesso', 'WebController@sendEmailSuccess')->name('sendEmailSuccess');
        Route::get('/experiencias', 'WebController@experiences')->name('experiences');
        Route::get('/experiencias/{slug}', 'WebController@experiencesCategory')->name('experiencesCategory');
    });

    Route::group(['prefix' => 'component','namespace' => 'Web', 'as' => 'component.'],function (){

        Route::post('main-filter/search','FilterController@search')->name('main-filter.search');
        Route::post('main-filter/category','FilterController@category')->name('main-filter.category');
        Route::post('main-filter/type','FilterController@type')->name('main-filter.type');
        Route::post('main-filter/neighborhood','FilterController@neighborhood')->name('main-filter.neighborhood');
        Route::post('main-filter/bedrooms','FilterController@bedrooms')->name('main-filter.bedrooms');
        Route::post('main-filter/suites','FilterController@suites')->name('main-filter.suites');
        Route::post('main-filter/bathrooms','FilterController@bathrooms')->name('main-filter.bathrooms');
        Route::post('main-filter/garage','FilterController@garage')->name('main-filter.garage');
        Route::post('main-filter/price-base','FilterController@priceBase')->name('main-filter.priceBase');
        Route::post('main-filter/price-limit','FilterController@priceLimit')->name('main-filter.priceLimit');

    });

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

            /** Permissões*/

            Route::resource('permission', 'ACL\\PermissionController');

            /** Perfis */
            Route::get('role/{role}/permissions', 'ACL\RoleController@permissions')->name('role.permissions');
            Route::put('role/{role}/permissions/sync', 'ACL\RoleController@permissionsSync')->name('role.permissionsSync');
            Route::resource('role', 'ACL\RoleController');

            /** Empresas */
            Route::resource('companies','CompanyController');

            /** imóveis */
            Route::post('properties/image-get-cover','PropertyController@imageSetCover')->name('properties.imageSetCover');
            Route::delete('properties/image-remove','PropertyController@imageRemove')->name('properties.imageRemove');
            Route::resource('properties','PropertyController');

            /** Contratos */
            Route::post('contracts/get-data-owner','ContractController@getDataOwner')->name('contracts.getDataOwner');
            Route::post('contracts/get-data-acquirer','ContractController@getDataAcquirer')->name('contracts.getDataAcquirer');
            Route::post('contracts/get-data-property','ContractController@getDataProperty')->name('contracts.getDataProperty');
            Route::resource('contracts','ContractController');

        });


        /** Logout */
        Route::get('logout', 'AuthController@logout')->name('logout');

    });


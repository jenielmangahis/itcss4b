<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/admin-lte', function () {
    return view('admin_template');
});
Route::get('/admin-lte-login', function () {
    return view('admin_login');
});
Route::get('/lte_fixed', 'BenchmarkController@lte_fixed')->name('lte_fixed');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Dashboard Module
Route::get('dashboard', ['as'=>'dashboard','uses'=>'DashboardController@index'])->middleware('auth');
Route::get('/', ['as'=>'/','uses'=>'DashboardController@index'])->middleware('auth');

//User Module
Route::get('/users', ['as'=>'users','uses'=>'UserController@index'])->middleware('auth');
Route::get('user/create', ['as'=>'user/create','uses'=>'UserController@create'])->middleware('auth');
Route::post('user/store', ['as'=>'user/store','uses'=>'UserController@store'])->middleware('auth');
Route::get('user/edit/{user_id}', ['as'=>'user/edit','uses'=>'UserController@edit'])->middleware('auth');
Route::post('user/update', ['as'=>'user/update','uses'=>'UserController@update'])->middleware('auth');
Route::post('user/destroy', ['as'=>'user/destroy','uses'=>'UserController@destroy'])->middleware('auth');

//Company Users Module
Route::get('/company_users', ['as'=>'company_users','uses'=>'CompanyUserController@index'])->middleware('auth');
Route::get('company_users/create', ['as'=>'company_users/create','uses'=>'CompanyUserController@create'])->middleware('auth');
Route::post('company_users/store', ['as'=>'company_users/store','uses'=>'CompanyUserController@store'])->middleware('auth');
Route::get('company_users/edit/{user_id}', ['as'=>'company_users/edit','uses'=>'CompanyUserController@edit'])->middleware('auth');
Route::post('company_users/update', ['as'=>'company_users/update','uses'=>'CompanyUserController@update'])->middleware('auth');
Route::post('company_users/destroy', ['as'=>'company_users/destroy','uses'=>'CompanyUserController@destroy'])->middleware('auth');


//Group Module
Route::get('/groups', ['as'=>'groups','uses'=>'GroupController@index'])->middleware('auth');

//Componies Module
Route::get('/companies', ['as'=>'companies','uses'=>'CompaniesController@index'])->middleware('auth');
Route::get('companies/create', ['as'=>'companies/create','uses'=>'CompaniesController@create'])->middleware('auth');
Route::post('companies/store', ['as'=>'companies/store','uses'=>'CompaniesController@store'])->middleware('auth');
Route::post('companies/destroy', ['as'=>'companies/destroy','uses'=>'CompaniesController@destroy'])->middleware('auth');
Route::get('companies/edit/{user_id}', ['as'=>'companies/edit','uses'=>'CompaniesController@edit'])->middleware('auth');
Route::post('companies/update', ['as'=>'companies/update','uses'=>'CompaniesController@update'])->middleware('auth');

//Benchmark
Route::get('benchmark/test_model', ['as'=>'benchmark/test_model','uses'=>'BenchmarkController@testModel'])->middleware('auth');

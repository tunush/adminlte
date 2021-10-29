<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::get('/', 'App\Http\Controllers\HomeController@index');
// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/', 'App\Http\Controllers\PlaceHolderController@index');
Route::get('/home', 'App\Http\Controllers\PlaceHolderController@index')->name('home');

Route::get('/conversations', 'App\Http\Controllers\PlaceHolderController@index')->name('conversations');
Route::get('/task_manager', 'App\Http\Controllers\PlaceHolderController@index')->name('task_manager');
Route::get('/calendar', 'App\Http\Controllers\PlaceHolderController@index')->name('calendar');
Route::get('/white_board', 'App\Http\Controllers\PlaceHolderController@index')->name('white_board');
Route::get('/dashboard', 'App\Http\Controllers\PlaceHolderController@index')->name('dashboard');
Route::get('/pipeline', 'App\Http\Controllers\PlaceHolderController@index')->name('pipeline');
Route::get('/seller', 'App\Http\Controllers\PlaceHolderController@index')->name('seller');
Route::get('/buyer', 'App\Http\Controllers\PlaceHolderController@index')->name('buyer');
Route::get('/estimator', 'App\Http\Controllers\PlaceHolderController@index')->name('estimator');
Route::get('/properties', 'App\Http\Controllers\PlaceHolderController@index')->name('properties');
Route::get('/buyers', 'App\Http\Controllers\PlaceHolderController@index')->name('buyers');
Route::get('/contacts', 'App\Http\Controllers\PlaceHolderController@index')->name('contacts');
Route::get('/reporting', 'App\Http\Controllers\PlaceHolderController@index')->name('reporting');
Route::get('/call_scripts', 'App\Http\Controllers\PlaceHolderController@index')->name('call_scripts');

Route::get('/custom_fields', 'App\Http\Controllers\PlaceHolderController@index')->name('custom_fields');
Route::get('/default_fields', 'App\Http\Controllers\PlaceHolderController@index')->name('default_fields');
Route::get('/smtp', 'App\Http\Controllers\PlaceHolderController@index')->name('smtp');
Route::get('/phone', 'App\Http\Controllers\PlaceHolderController@index')->name('phone');
Route::get('/workflow', 'App\Http\Controllers\PlaceHolderController@index')->name('workflow');
Route::get('/calendars', 'App\Http\Controllers\PlaceHolderController@index')->name('calendars');

Route::get('/config', 'App\Http\Controllers\ConfigController@index')->name('config');
Route::put('/config/update/{id}', 'App\Http\Controllers\ConfigController@update')->name('config.update');

Route::group(['namespace' => 'App\Http\Controllers\Profile'], function (){ 
	Route::get('/profile', 'ProfileController@index')->name('profile');
	Route::put('/profile/update/profile/{id}', 'ProfileController@updateProfile')->name('profile.update.profile');
	Route::put('/profile/update/password/{id}', 'ProfileController@updatePassword')->name('profile.update.password');
	Route::put('/profile/update/avatar/{id}', 'ProfileController@updateAvatar')->name('profile.update.avatar');
});

Route::group(['namespace' => 'App\Http\Controllers\Error'], function (){ 
	Route::get('/unauthorized', 'ErrorController@unauthorized')->name('unauthorized');
});

Route::group(['namespace' => 'App\Http\Controllers\User'], function (){ 
	//Users
	Route::get('/user', 'UserController@index')->name('user');
	Route::get('/user/create', 'UserController@create')->name('user.create');
	Route::post('/user/store', 'UserController@store')->name('user.store');
	Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
	Route::put('/user/update/{id}', 'UserController@update')->name('user.update');
	Route::get('/user/edit/password/{id}', 'UserController@editPassword')->name('user.edit.password');
	Route::put('/user/update/password/{id}', 'UserController@updatePassword')->name('user.update.password');
	Route::get('/user/show/{id}', 'UserController@show')->name('user.show');
	Route::get('/user/destroy/{id}', 'UserController@destroy')->name('user.destroy');
	// Roles
	Route::get('/role', 'RoleController@index')->name('role');
	Route::get('/role/create', 'RoleController@create')->name('role.create');
	Route::post('/role/store', 'RoleController@store')->name('role.store');
	Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
	Route::put('/role/update/{id}', 'RoleController@update')->name('role.update');
	Route::get('/role/show/{id}', 'RoleController@show')->name('role.show');
	Route::get('/role/destroy/{id}', 'RoleController@destroy')->name('role.destroy');
});
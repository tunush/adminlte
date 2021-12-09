<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('login/{id?}', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::get('logout','App\Http\Controllers\Auth\LoginController@logout');

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
// Route::get('/seller', 'App\Http\Controllers\PlaceHolderController@index')->name('seller');
// Route::get('/buyer', 'App\Http\Controllers\PlaceHolderController@index')->name('buyer');
Route::get('/estimator', 'App\Http\Controllers\PlaceHolderController@index')->name('estimator');
// Route::get('/properties', 'App\Http\Controllers\PlaceHolderController@index')->name('properties');
// Route::get('/buyers', 'App\Http\Controllers\PlaceHolderController@index')->name('buyers');
// Route::get('/contacts', 'App\Http\Controllers\PlaceHolderController@index')->name('contacts');
Route::get('/reporting', 'App\Http\Controllers\PlaceHolderController@index')->name('reporting');
Route::get('/call_scripts', 'App\Http\Controllers\PlaceHolderController@index')->name('call_scripts');

Route::get('/default_fields', 'App\Http\Controllers\PlaceHolderController@index')->name('default_fields');
Route::get('/smtp', 'App\Http\Controllers\PlaceHolderController@index')->name('smtp');
Route::get('/workflow', 'App\Http\Controllers\PlaceHolderController@index')->name('workflow');
Route::get('/calendars', 'App\Http\Controllers\PlaceHolderController@index')->name('calendars');

Route::get('/config', 'App\Http\Controllers\ConfigController@index')->name('config');
Route::put('/config/update/{id}', 'App\Http\Controllers\ConfigController@update')->name('config.update');

Route::group(['namespace' => 'App\Http\Controllers\Phone'], function (){ 
	Route::get('/phone', 'PhoneController@index')->name('phone');
	Route::post('/phone/update/settings/{id}', 'PhoneController@updateSettings')->name('phone.update.settings');
	Route::post('/phone/update/{id}', 'PhoneController@update')->name('phone.update');
	Route::get('/phone/destroy/{id}', 'PhoneController@destroy')->name('phone.destroy');
});

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
	Route::get('/user/sendInvintation/{id}', 'UserController@sendInvintation')->name('user.sendInvintation');
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

Route::group(['namespace' => 'App\Http\Controllers\CustomFields'], function (){
	Route::get('/custom_fields', 'TemplateCustomFieldsController@index')->name('custom_fields');

	Route::get('/template_custom_fields/{id}', 'TemplateCustomFieldsController@show')->name('template_custom_fields');
	Route::post('/template_custom_fields/update-order','TemplateCustomFieldsController@updateOrder');
	Route::post('/template_custom_section/update/{id}/{template_id}', 'TemplateCustomFieldsController@updateSection')->name('template_custom_section.update');
	Route::post('/add_template_custom_section/{template_id}', 'TemplateCustomFieldsController@addSection')->name('template_custom_section.add');
	Route::get('/template_custom_section/destroy/{id}/{template_id}', 'TemplateCustomFieldsController@destroySection')->name('template_custom_section.destroy');

	Route::post('/store_template_custom_fields/{template_id}', 'TemplateCustomFieldsController@store')->name('store_template_custom_fields');
	Route::get('/template_custom_fields/destroy/{id}/{template_id}', 'TemplateCustomFieldsController@destroy')->name('template_custom_fields.destroy');
	Route::post('/template_custom_fields/update/{id}/{template_id}', 'TemplateCustomFieldsController@update')->name('template_custom_fields.update');
	Route::post('/template_custom_fields/updateValue/{id}/{template_id}', 'TemplateCustomFieldsController@updateValue')->name('template_custom_fields.updateValue');
	Route::post('/template_custom_fields/updateDefaultOptions/{id}/{template_id}', 'TemplateCustomFieldsController@updateDefaultOptions')->name('template_custom_fields.updateDefaultOptions');
	Route::post('/template_custom_fields/updateCustomOptions/{id}/{template_id}', 'TemplateCustomFieldsController@updateCustomOptions')->name('template_custom_fields.updateCustomOptions');
});

Route::group(['namespace' => 'App\Http\Controllers\DefaultFields'], function (){ 
	Route::get('/default_fields', 'TemplateDefaultFieldsController@index')->name('default_fields');

	Route::get('/template_default_fields/{id}', 'TemplateDefaultFieldsController@show')->name('template_default_fields');
	Route::post('/store_template_default_fields/{template_id}', 'TemplateDefaultFieldsController@store')->name('store_template_default_fields');
	Route::get('/template_default_fields/destroy/{id}/{template_id}', 'TemplateDefaultFieldsController@destroy')->name('template_default_fields.destroy');
	Route::post('/template_default_fields/update/{id}/{template_id}', 'TemplateDefaultFieldsController@update')->name('template_default_fields.update');
	Route::post('/template_default_fields/updateValue/{id}/{template_id}', 'TemplateDefaultFieldsController@updateValue')->name('template_default_fields.updateValue');
	Route::post('/template_default_fields/updateDefaultOptions/{id}/{template_id}', 'TemplateDefaultFieldsController@updateDefaultOptions')->name('template_default_fields.updateDefaultOptions');
});

Route::group(['namespace' => 'App\Http\Controllers\Templates'], function (){ 
	Route::get('/manage_templates', 'TemplatesController@index')->name('manage_templates');
	Route::post('/template/store', 'TemplatesController@store')->name('template.store');
	Route::get('/template/destroy/{id}', 'TemplatesController@destroy')->name('template.destroy');
	Route::post('/template/update/{id}', 'TemplatesController@update')->name('template.update');
});
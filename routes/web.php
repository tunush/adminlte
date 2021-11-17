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
	Route::get('/custom_fields', 'SellerLeadsCustomFieldsController@index')->name('custom_fields');

	Route::get('/seller_leads_custom_fields', 'SellerLeadsCustomFieldsController@show')->name('seller_leads_custom_fields');
	Route::post('/seller_leads_custom_fields/update-order','SellerLeadsCustomFieldsController@updateOrder');
	Route::post('/seller_leads_custom_section/update/{id}', 'SellerLeadsCustomFieldsController@updateSection')->name('seller_leads_custom_section.update');
	Route::post('/add_seller_leads_custom_section', 'SellerLeadsCustomFieldsController@addSection')->name('seller_leads_custom_section.add');
	Route::get('/seller_leads_custom_section/destroy/{id}', 'SellerLeadsCustomFieldsController@destroySection')->name('seller_leads_custom_section.destroy');

	Route::post('/store_seller_leads_custom_fields/{id}', 'SellerLeadsCustomFieldsController@store')->name('store_seller_leads_custom_fields');
	Route::get('/seller_leads_custom_fields/destroy/{id}', 'SellerLeadsCustomFieldsController@destroy')->name('seller_leads_custom_fields.destroy');
	Route::post('/seller_leads_custom_fields/update/{id}', 'SellerLeadsCustomFieldsController@update')->name('seller_leads_custom_fields.update');
	Route::post('/seller_leads_custom_fields/updateValue/{id}', 'SellerLeadsCustomFieldsController@updateValue')->name('seller_leads_custom_fields.updateValue');
	Route::post('/seller_leads_custom_fields/updateDefaultOptions/{id}', 'SellerLeadsCustomFieldsController@updateDefaultOptions')->name('seller_leads_custom_fields.updateDefaultOptions');
	Route::post('/seller_leads_custom_fields/updateCustomOptions/{id}', 'SellerLeadsCustomFieldsController@updateCustomOptions')->name('seller_leads_custom_fields.updateCustomOptions');


	Route::get('/buyer_leads_custom_fields', 'BuyerLeadsCustomFieldsController@show')->name('buyer_leads_custom_fields');
	Route::post('/buyer_leads_custom_fields/update-order','BuyerLeadsCustomFieldsController@updateOrder');
	Route::post('/buyer_leads_custom_section/update/{id}', 'BuyerLeadsCustomFieldsController@updateSection')->name('buyer_leads_custom_section.update');
	Route::post('/add_buyer_leads_custom_section', 'BuyerLeadsCustomFieldsController@addSection')->name('buyer_leads_custom_section.add');
	Route::get('/buyer_leads_custom_section/destroy/{id}', 'BuyerLeadsCustomFieldsController@destroySection')->name('buyer_leads_custom_section.destroy');

	Route::post('/store_buyer_leads_custom_fields/{id}', 'BuyerLeadsCustomFieldsController@store')->name('store_buyer_leads_custom_fields');
	Route::get('/buyer_leads_custom_fields/destroy/{id}', 'BuyerLeadsCustomFieldsController@destroy')->name('buyer_leads_custom_fields.destroy');
	Route::post('/buyer_leads_custom_fields/update/{id}', 'BuyerLeadsCustomFieldsController@update')->name('buyer_leads_custom_fields.update');
	Route::post('/buyer_leads_custom_fields/updateValue/{id}', 'BuyerLeadsCustomFieldsController@updateValue')->name('buyer_leads_custom_fields.updateValue');
	Route::post('/buyer_leads_custom_fields/updateDefaultOptions/{id}', 'BuyerLeadsCustomFieldsController@updateDefaultOptions')->name('buyer_leads_custom_fields.updateDefaultOptions');
	Route::post('/buyer_leads_custom_fields/updateCustomOptions/{id}', 'BuyerLeadsCustomFieldsController@updateCustomOptions')->name('buyer_leads_custom_fields.updateCustomOptions');


	Route::get('/contact_custom_fields', 'ContactCustomFieldsController@show')->name('contact_custom_fields');
	Route::post('/contact_custom_fields/update-order','ContactCustomFieldsController@updateOrder');
	Route::post('/contact_custom_section/update/{id}', 'ContactCustomFieldsController@updateSection')->name('contact_custom_section.update');
	Route::post('/contact_custom_section', 'ContactCustomFieldsController@addSection')->name('contact_custom_section.add');
	Route::get('/contact_custom_section/destroy/{id}', 'ContactCustomFieldsController@destroySection')->name('contact_custom_section.destroy');

	Route::post('/store_contact_custom_fields{id}', 'ContactCustomFieldsController@store')->name('store_contact_custom_fields');
	Route::get('/contact_custom_fields/destroy/{id}', 'ContactCustomFieldsController@destroy')->name('contact_custom_fields.destroy');
	Route::post('/contact_custom_fields/update/{id}', 'ContactCustomFieldsController@update')->name('contact_custom_fields.update');
	Route::post('/contact_custom_fields/updateValue/{id}', 'ContactCustomFieldsController@updateValue')->name('contact_custom_fields.updateValue');
	Route::post('/contact_custom_fields/updateDefaultOptions/{id}', 'ContactCustomFieldsController@updateDefaultOptions')->name('contact_custom_fields.updateDefaultOptions');
	Route::post('/contact_custom_fields/updateCustomOptions/{id}', 'ContactCustomFieldsController@updateCustomOptions')->name('contact_custom_fields.updateCustomOptions');
});

Route::group(['namespace' => 'App\Http\Controllers\DefaultFields'], function (){ 
	Route::get('/default_fields', 'SellerLeadsDefaultFieldsController@index')->name('default_fields');

	Route::get('/seller_leads_default_fields', 'SellerLeadsDefaultFieldsController@show')->name('seller_leads_default_fields');
	Route::post('/store_seller_leads_default_fields', 'SellerLeadsDefaultFieldsController@store')->name('store_seller_leads_default_fields');
	Route::get('/seller_leads_default_fields/destroy/{id}', 'SellerLeadsDefaultFieldsController@destroy')->name('seller_leads_default_fields.destroy');
	Route::post('/seller_leads_default_fields/update/{id}', 'SellerLeadsDefaultFieldsController@update')->name('seller_leads_default_fields.update');
	Route::post('/seller_leads_default_fields/updateValue/{id}', 'SellerLeadsDefaultFieldsController@updateValue')->name('seller_leads_default_fields.updateValue');
	Route::post('/seller_leads_default_fields/updateDefaultOptions/{id}', 'SellerLeadsDefaultFieldsController@updateDefaultOptions')->name('seller_leads_default_fields.updateDefaultOptions');

	Route::get('/buyer_leads_default_fields', 'BuyerLeadsDefaultFieldsController@show')->name('buyer_leads_default_fields');
	Route::post('/store_buyer_leads_default_fields', 'BuyerLeadsDefaultFieldsController@store')->name('store_buyer_leads_default_fields');
	Route::get('/buyer_leads_default_fields/destroy/{id}', 'BuyerLeadsDefaultFieldsController@destroy')->name('buyer_leads_default_fields.destroy');
	Route::post('/buyer_leads_default_fields/update/{id}', 'BuyerLeadsDefaultFieldsController@update')->name('buyer_leads_default_fields.update');
	Route::post('/buyer_leads_default_fields/updateValue/{id}', 'BuyerLeadsDefaultFieldsController@updateValue')->name('buyer_leads_default_fields.updateValue');
	Route::post('/buyer_leads_default_fields/updateDefaultOptions/{id}', 'BuyerLeadsDefaultFieldsController@updateDefaultOptions')->name('buyer_leads_default_fields.updateDefaultOptions');

	Route::get('/contact_default_fields', 'ContactDefaultFieldsController@show')->name('contact_default_fields');
	Route::post('/store_contact_default_fields', 'ContactDefaultFieldsController@store')->name('store_contact_default_fields');
	Route::get('/contact_default_fields/destroy/{id}', 'ContactDefaultFieldsController@destroy')->name('contact_default_fields.destroy');
	Route::post('/contact_default_fields/update/{id}', 'ContactDefaultFieldsController@update')->name('contact_default_fields.update');
	Route::post('/contact_default_fields/updateValue/{id}', 'ContactDefaultFieldsController@updateValue')->name('contact_default_fields.updateValue');
	Route::post('/contact_default_fields/updateDefaultOptions/{id}', 'ContactDefaultFieldsController@updateDefaultOptions')->name('contact_default_fields.updateDefaultOptions');
});
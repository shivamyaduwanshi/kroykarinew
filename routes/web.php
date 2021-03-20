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

/************************* Admin Route's *************************************/

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name('facebook.login');
Route::get('facebook/callback', 'Auth\LoginController@handleProviderCallback');

// Authentication Routes...
Route::get('/45214500k', 'Backend\Auth\LoginController@showLoginForm')->name('45214500k');
Route::post('admin/login', 'Backend\Auth\LoginController@login')->name('admin.login');
Route::post('admin/logout', 'Backend\Auth\LoginController@logout')->name('admin.logout');

// Password Reset Routes...
Route::get('admin/password/request', 'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin/password/email', 'Backend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset/{token}', 'Backend\Auth\ResetPasswordController@showResetForm');
Route::post('admin/password/reset', 'Backend\Auth\ResetPasswordController@reset')->name('admin.password.reset');

Route::get('admin', 'Backend\HomeController@home')->name('admin');
Route::get('admin/home', 'Backend\HomeController@home')->name('admin.home');
Route::get('admin/profile', 'Backend\HomeController@profile')->name('admin.profile');
Route::put('admin/profile/update', 'Backend\HomeController@updateProfile')->name('admin.profile.update');
Route::put('admin/change/password', 'Backend\HomeController@changePassword')->name('admin.change.password');
Route::get('admin/users', 'Backend\HomeController@users')->name('admin.users');
Route::get('admin/user/details/{id}', 'Backend\HomeController@userDetails')->name('admin.user.details');
Route::put('admin/user/change/status/{id?}', 'Backend\HomeController@userChangeStatus')->name('admin.user.change.status');
Route::delete('admin/user/delete', 'Backend\HomeController@userDelete')->name('admin.user.delete');
Route::put('admin/user/reset/password', 'Backend\HomeController@userResetPassword')->name('admin.user.reset.password');

Route::get('admin/ads', 'Backend\HomeController@ads')->name('admin.ads');
Route::get('admin/ad/details', 'Backend\HomeController@adDetails')->name('admin.ad.details');
Route::get('admin/generate/report', 'Backend\HomeController@generateReport')->name('admin.generate.report');

Route::get('admin/categories','Backend\HomeController@categories')->name('admin.categories');
Route::get('admin/category/details/{id}','Backend\HomeController@categoryDetail')->name('admin.category.details');
Route::put('admin/category/update/{id}','Backend\HomeController@categoryUpdate')->name('admin.category.update');
Route::get('admin/category/add','Backend\HomeController@addCategory')->name('admin.add.category');
Route::post('admin/category/store','Backend\HomeController@storeCategory')->name('admin.store.category');


Route::delete('admin/category/remove/parent/{id}','Backend\HomeController@removeParentCategory')->name('admin.category.remove.parent');
Route::delete('admin/category/remove','Backend\HomeController@removeCategory')->name('admin.category.remove');

Route::post('admin/subcategory/add','Backend\HomeController@addSubcategory')->name('admin.subcategory.add');
Route::put('admin/subcategory/update','Backend\HomeController@updateSubcategory')->name('admin.subcategory.update');
Route::delete('admin/subcategory/remove/{id}','Backend\HomeController@removeSubcategory')->name('admin.subcategory.remove');
Route::get('admin/ajax/subcategory/list/{id}','Backend\HomeController@addSubcategoryAjax')->name('admin.subcategory.list');

Route::get('admin/approved/ad/{id}','Backend\HomeController@approvedAd')->name('admin.approved.ad');
Route::put('admin/reject/ad/{id}','Backend\HomeController@rejectAd')->name('admin.reject.ad');
Route::delete('admin/delete/ad/{id}','Backend\HomeController@deleteAd')->name('admin.delete.ad');

Route::name('admin/role/')->group(function(){
    Route::get('admin/user/groups' , 'Backend\RoleController@index')->name('index');
    Route::get('admin/user/group/create' , 'Backend\RoleController@create')->name('create');
    Route::post('admin/user/group/store' , 'Backend\RoleController@store')->name('store');
    Route::get('admin/user/group/details/{id}' , 'Backend\RoleController@show')->name('show');
    Route::get('admin/user/group/edit/{id}' , 'Backend\RoleController@edit')->name('edit');
    Route::put('admin/user/group/update/{id}' , 'Backend\RoleController@update')->name('update');
    Route::delete('admin/user/group/delete' , 'Backend\RoleController@destroy')->name('destroy');
});

/**
 * Field's
 */
Route::prefix('admin/field')->group(function () {
    Route::name('admin.field.')->group(function(){
        Route::get('fields', 'Backend\FieldController@index')->name('index');
        Route::get('create', 'Backend\FieldController@create')->name('create');
        Route::post('store', 'Backend\FieldController@store')->name('store');
        Route::get('edit/{id}', 'Backend\FieldController@edit')->name('edit');
        Route::put('update/{id}', 'Backend\FieldController@update')->name('update');
        Route::delete('delete/{id?}', 'Backend\FieldController@destroy')->name('destroy');
    });
});

/**
* Language
*/
Route::prefix('admin/language/')->group(function () {
    Route::name('admin.language.')->group(function(){
        Route::get('index', 'LanguageController@index')->name('index');
        Route::put('bangla/update', 'LanguageController@updateBangla')->name('update.bangla');
    });
});


/**
* City area's
*/
Route::post('admin/area/add','Backend\HomeController@addArea')->name('admin.area.add');
Route::put('admin/area/update','Backend\HomeController@updateArea')->name('admin.area.update');
Route::delete('admin/area/remove/{id}','Backend\HomeController@removeArea')->name('admin.area.remove');
Route::get('admin/ajax/area/list/{id}','Backend\HomeController@ajaxAreaAjax')->name('admin.area.list');

Route::get('admin/config','Backend\HomeController@config')->name('admin.config');
Route::get('admin/get/config/{id}','Backend\HomeController@getConfig')->name('admin.get.config');
Route::put('admin/update/config/{id}','Backend\HomeController@updateConfig')->name('admin.update.config');

Route::get('admin/cities','Backend\HomeController@cities')->name('admin.cities');
Route::get('admin/city/add','Backend\HomeController@addCity')->name('admin.city.add');
Route::post('admin/city/store','Backend\HomeController@storeCity')->name('admin.city.store');
Route::get('admin/city/edit/{id}','Backend\HomeController@editCity')->name('admin.city.edit');
Route::put('admin/city/update/{id}','Backend\HomeController@updateCity')->name('admin.city.update');
Route::delete('admin/city/remove/{id}','Backend\HomeController@removeCity')->name('admin.city.remove');

Route::post('admin/city/localarea/add','Backend\HomeController@adCityLocalarea')->name('admin.city.localarea.add');
Route::put('admin/city/localarea/update/{id}','Backend\HomeController@updateCityLocalarea')->name('admin.city.localarea.update');
Route::delete('admin/city/localarea/remove/{id}','Backend\HomeController@removeCityLocalarea')->name('admin.city.localarea.remove');

/************************* End Admin Route's **********************************/

Auth::routes();

/**
* Frontend ajax Route's
**/

Route::get('ajax/category', 'AjaxController@category')->name('ajax.category');
Route::get('ajax/sub/category/{id?}', 'AjaxController@subCategory')->name('ajax.sub.category');
Route::get('ajax/city', 'AjaxController@city')->name('ajax.city');
Route::get('ajax/city/area/{id?}', 'AjaxController@cityArea')->name('ajax.city.area');
Route::post('ajax-login', 'AjaxController@login')->name('ajax.login');

Route::get('/unread/message/count', 'AjaxController@unreadMessageCount')->name('unreadMessageCount');


/**
* Frontend Route's
**/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/add/ad', 'HomeController@addAd')->name('add.ad');
Route::get('/create/ad', 'HomeController@adCreate')->name('ad.create');
Route::post('/store/ad', 'HomeController@adStore')->name('ad.store');
Route::get('/edit/ad/{id}', 'HomeController@editAd')->name('editAd');
Route::put('/update/ad/{id}', 'HomeController@adUpdate')->name('adUpdate');
Route::get('/delete/ad/{id}', 'HomeController@adDelete')->name('adDelete');
Route::get('/ad/{id}/{title}', 'HomeController@adShow')->name('adShow');

Route::get('/my/ads', 'HomeController@myAds')->name('myAds');
Route::get('/my/profile', 'HomeController@myProfile')->name('myProfile');
Route::get('/favourite/ads', 'HomeController@favourite')->name('favourite');
Route::get('/contact-us', 'HomeController@contactUs')->name('contactUs');
Route::get('/setting', 'HomeController@setting')->name('setting');
Route::get('/chat', 'HomeController@chat')->name('chat');
Route::get('/ads', 'HomeController@ads')->name('ads');

Route::get('/help', 'HomeController@help')->name('help');

Route::post('/like', 'HomeController@like')->name('like');

Route::put('/update/profile', 'HomeController@updateProfile')->name('update.profile');
Route::put('/change/password', 'HomeController@changePassword')->name('change.password');

Route::put('/change/password', 'HomeController@changePassword')->name('change.password');

Route::get('/{page}', 'HomeController@page')->name('page');

Route::post('/contact/mail', 'HomeController@contactMail')->name('contact.mail');


Route::get('/change/language', 'HomeController@changeLanguage')->name('changeLanguage');

Route::get('/email/varification/{id}', 'HomeController@emailVarification')->name('email.varification');
Route::get('/registration/success', 'HomeController@registrationSuccess')->name('registration.success');

Route::get('/ad/delete/{id?}', 'HomeController@adDelete')->name('ad.delete');

Route::get('/test/notification', 'HomeController@TestNotification')->name('text.notification');

Route::get('ajax/form/fields', 'HomeController@ajaxFormField')->name('ajax.form.field');

Route::post('report/ad', 'HomeController@reportAd')->name('report.ad');

Route::get('/error', 'HomeController@error')->name('error');
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    // return what you want
});





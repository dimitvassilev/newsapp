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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/home', 'HomeController@index')->name('home');

//Registers the routes commented out below via
//the auth() method of \Illuminate\Routing\Router::class
Auth::routes(['verify' => true]);

//// Authentication Routes...
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//
//// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');
//
//// Email Verification Routes...
//Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
//Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
//Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
//
//// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');


//Additional Email Verification Route (emulating opening the sent verification mail)...
Route::get('email/stub', 'Auth\VerificationController@showStub')->name('verification.stub');

// Account Activation Routes...
Route::get('activate', 'Auth\ActivationController@show')->name('password.prompt');
Route::post('activate', 'Auth\ActivationController@activate')->name('password.set');


//Articles Routes...
Route::get('/', 'ArticlesController@latest')->name('base');
Route::get('articles/{id}', 'ArticlesController@show')->name('articles.show');
Route::get('articles/{id}/download', 'ArticlesController@download')->name('articles.download');
Route::get('articles/new', 'ArticlesController@showArticleForm')->name('articles.new');
Route::delete('articles/{id}', 'ArticlesController@delete')->name('articles.delete');
Route::get('users/{id}/articles', 'ArticlesController@userArticles')->name('articles.user');
Route::post('users/{id}/articles', 'ArticlesController@create')->name('articles.create');

//Photos Routes...
Route::get('articles/{id}/photo', 'PhotoController@showForm')->name('photo.uploader');
Route::post('articles/{id}/photo', 'PhotoController@upload')->name('photo.upload');




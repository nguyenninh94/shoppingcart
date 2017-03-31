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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('shop', 'ShopController');

Route::resource('cart', 'CartController');

Route::get('/emptycart', 'CartController@emptyCart');

Route::get('payment', 'CartController@getPayment');

Route::get('/get-district-list/{provinceID}', 'CartController@getDistrict');

Route::get('/get-ward-list/{districtID}', 'CartController@getWard');

Route::get('payment/stripe', 'CartController@getStripe');

Route::post('payment/stripe', [ 
   'uses' => 'CartController@postStripe',
   'as' => 'payment.stripe' 
]);

Route::resource('payment/paypal', 'PaypalController');

Route::post('/language-chooser', 'LanguageController@changeLanguage');

Route::post('/language',[
   'before' => 'csrf',
   'as' => 'language-chooser',
   'uses' => 'LanguageController@changeLanguage'
]);

Route::get('/facebook/redirect', 'Auth\SocialController@redirectToProviderFacebook');
Route::get('/facebook/callback', 'Auth\SocialController@handleProviderCallbackFacebook');

Route::get('/google/redirect', 'Auth\SocialController@redirectToProviderGoogle');
Route::get('/google/callback', 'Auth\SocialController@handleProviderCallbackGoogle');

Route::get('/twitter/redirect', 'Auth\SocialController@redirectToProviderTwitter');
Route::get('/twitter/callback', 'Auth\SocialController@handleProviderCallbackTwitter');

Auth::routes();

Route::get('/home', 'HomeController@index');

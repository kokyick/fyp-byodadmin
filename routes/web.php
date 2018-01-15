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
    return view('app/index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/viewindex', 'HomeController@viewindex')->name('viewindex');
Route::get('/viewindex1', 'HomeController@viewindex1')->name('viewindex1');
Route::get('/viewpayment', 'HomeController@viewpayment')->name('viewpayment');
Route::get('/viewfeedback', 'HomeController@viewfeedback')->name('viewfeedback');
Route::get('/viewterms', 'HomeController@viewterms')->name('viewterms');
Route::get('/registration', 'HomeController@viewregistration')->name('registration');
Route::get('/login', 'HomeController@viewlogin')->name('login');


Route::get('/menus', 'RestaurantController@viewmenu')->name('viewmenus');
Route::get('/menus/{id}', 'RestaurantController@viewmenus')->name('menus');
Route::get('/singlemenus/{id}','RestaurantController@viewfooditem')->name('singlemenus');
Route::get('/viewsinglerestaurant/{id}', 'RestaurantController@viewsinglerestaurant')->name('viewsinglerestaurant');

Route::get('/getrestaurant', 'RestaurantController@getrestaurant')->name('getrestaurant');
Route::post('/dooutletedit/', 'RestaurantController@outletedit')->name('dooutletedit');
Route::post('/dodeleteoutdish/', 'RestaurantController@outletdishdel')->name('dodeleteoutdish');
Route::post('/outofstockdish/', 'RestaurantController@outofstockdish')->name('outofstockdish');


Route::post('/addcart/', 'CartController@AddCart')->name('addcart');
Route::get('/vieworderhist/', 'CartController@vieworderhist')->name('vieworderhist');
Route::get('/singleorder/{id}','CartController@singleorder')->name('singleorder');

Route::post('/orderPaid/','CartController@orderPaid')->name('orderPaid');
Route::post('/cancelOrder/','CartController@cancelOrder')->name('cancelOrder');
Route::post('/addfoodorder/','CartController@addfoodorder')->name('addfoodorder');
Route::get('/removefood/{id}','CartController@removefood')->name('removefood');


Route::post('/domenuedit/', 'RestaurantController@editmenu')->name('domenuedit');
Route::post('/domenuadd/', 'RestaurantController@addmenu')->name('domenuadd');
Route::post('/dodishadd/', 'RestaurantController@adddish')->name('dodishadd');
Route::post('/dodeletedish/', 'RestaurantController@deletedish')->name('dodeletedish');

Route::post('/doalldishadd/', 'RestaurantController@doalldishadd')->name('doalldishadd');


Route::post('/docheckuser/', 'AccountController@docheckuser')->name('docheckuser');
Route::post('/dologin/', 'AccountController@login')->name('dologin');
Route::post('/doregister/', 'AccountController@register')->name('doregister');
Route::get('/dologout/', 'AccountController@logout')->name('dologout');

Route::get('/htmltopdfview/', 'ReportController@htmltopdfview')->name('htmltopdfview');
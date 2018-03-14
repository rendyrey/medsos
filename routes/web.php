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

// Route::get('/', function () {
//     return view('index');
// });

//login
Route::get('/','LoginController@index')->name('index');
Route::post('proses_login','LoginController@proses_login')->name('proses_login');
Route::get('proses_logout','LoginController@proses_logout')->name('proses_logout');

//dashboard
Route::get('dashboard','DashboardController@index')->name('dashboard');

//twitter
Route::get('twitter_scrape','DashboardController@twitter_scrape')->name('twitter_scrape');
Route::post('twitter_post','TwitterController@store')->name('twitter_post');
Route::any('twitter_data/{offset}/','DashboardController@twitter_data')->name('twitter_data');
Route::get('get_sentiment/{string}','TwitterController@get_sentiment')->name('get_sentiment');

//instagram
Route::get('instagram_scrape','DashboardController@instagram_scrape')->name('instagram_scrape');

//graphic
Route::get('graphic','GraphicController@index')->name('graphic');
Route::post('graphic_detail','GraphicController@detail')->name('graphic_detail');

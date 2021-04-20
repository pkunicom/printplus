<?php

use Illuminate\Support\Facades\Route;

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

//Routes for payfort payment gateway integration
Route::group(["prefix" => "/payfort"], function() {
  
  	Route::view('/', 'payfort');
  	Route::get('/requestSignature',['uses'=>'PayfortController@requestSignature','as'=>'payfort.requestSignature']);
  	Route::get('/request',['uses'=>'PayfortController@request','as'=>'payfort.request']);
  	Route::post('/callback',['uses'=>'PayfortController@callback','as'=>'payfort.callback']);
});




Route::get('cache_clear', function () {
	\Artisan::call('cache:clear');
		//  Clears route cache
	\Artisan::call('route:clear');
	\Cache::flush();
//	\Artisan::call('optimize');
	exec('composer dump-autoload');
	Cache::flush();
  \Artisan::call('config:cache');
	dd("Cache cleared!");
});



include_once(base_path().'/routes/admin.php');

include_once(base_path().'/routes/agent.php');
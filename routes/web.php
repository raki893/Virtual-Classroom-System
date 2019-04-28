<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



//Default Controller
Route::get('/', 'HomeController@index');
Route::post('/home/proccess/{any?}', 'HomeController@postProccess');
Route::get('insertform', 'HomeController@getData');



Route::get('dashboard/import', 'DashboardController@getImport');
/* Auth & Profile */
Route::get('user/profile','UserController@getProfile');
Route::get('user/login','UserController@getLogin');
Route::get('user/register','UserController@getRegister');
Route::get('user/logout','UserController@getLogout');
Route::get('user/reminder','UserController@getReminder');
Route::get('user/reset/{any?}','UserController@getReset');
Route::get('user/reminder','UserController@getReminder');
Route::get('user/activation','UserController@getActivation');
// Social Login
Route::get('user/socialize/{any?}','UserController@getSocialize');
Route::get('user/socialize/{any?}','UserController@getAutosocial');
//
Route::post('user/signin','UserController@postSignin');
Route::post('user/create','UserController@postCreate');
Route::post('user/saveprofile','UserController@postSaveprofile');
Route::post('user/savepassword','UserController@postSavepassword');
Route::post('user/doreset/{any?}','UserController@postDoreset');
Route::post('user/request','UserController@postRequest');

/* Posts & Blogs */
Route::get('post','PostController@getIndex');
Route::get('post/view/{id?}/{alias}','PostController@getView');
Route::get('post/label/{id?}','PostController@getLabel');
Route::get('post/remove/{id?}/{id2?}/{id3?}','PostController@getRemove');
Route::post('post/comment','PostController@postComment');

// Start Routes for Notification 
Route::get('notification/load','NotificationController@getLoad');
Route::get('notification','NotificationController@getIndex');
Route::get('notification/show/{any?}','NotificationController@getShow');
Route::get('notification/update/{any?}','NotificationController@getUpdate');
Route::get('notification/comboselect','NotificationController@getComboselect');
Route::get('notification/download','NotificationController@getDownload');
Route::get('notification/search','NotificationController@getSearch');
Route::get('notification/export/{any?}','NotificationController@getExport');
// -- Post Method --
Route::post('notification/save','NotificationController@postSave');
Route::post('notification/filter','NotificationController@postFilter');
Route::post('notification/delete/{any?}','NotificationController@postDelete');
// End Routes for faq 

Route::get('home/lang/{any}','HomeController@getLang');

include('pages.php');


Route::resource('vcrapi','vcrapiController');

// Routes for  all generated Module
include('module.php');
// Custom routes  
$path = base_path().'/routes/custom/';
$lang = scandir($path);
foreach($lang as $value) {
	if($value === '.' || $value === '..') {continue;} 
	include( 'custom/'. $value );	
	
}
// End custom routes
Route::group(['middleware' => 'auth'], function () {
	Route::resource('dashboard','DashboardController');
});

Route::group(['namespace' => 'vcr','middleware' => 'auth'], function () {
	include('vcr.php');
});

Route::group(['namespace' => 'Core','middleware' => 'auth'], function () {

	include('core.php');

});


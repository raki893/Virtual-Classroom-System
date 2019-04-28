<?php



//-------------------------------------------------------------------------
/* Start Users Routes */
// -- Get Method --
Route::get('core/users','UsersController@getIndex');
Route::get('core/users/show/{any}','UsersController@getShow');
Route::get('core/users/update/{any?}','UsersController@getUpdate');
Route::get('core/users/comboselect','UsersController@getComboselect');
Route::get('core/users/download','UsersController@getDownload');
Route::get('core/users/search','UsersController@getSearch');
Route::get('core/users/blast','UsersController@getBlast');
// -- Post Method --
Route::post('core/users/save','UsersController@postSave');
Route::post('core/users/filter','UsersController@postFilter');
Route::post('core/users/delete','UsersController@postDelete');
Route::post('core/users/doblast','UsersController@postDoblast');
/* End Users Routes */

//-------------------------------------------------------------------------
/* Start Groups Routes */
// -- Get Method --
Route::get('core/groups','GroupsController@getIndex');
Route::get('core/groups/show/{any}','GroupsController@getShow');
Route::get('core/groups/update/{any?}','GroupsController@getUpdate');
Route::get('core/groups/comboselect','GroupsController@getComboselect');
Route::get('core/groups/download','GroupsController@getDownload');
Route::get('core/groups/search','GroupsController@getSearch');
// -- Post Method --
Route::post('core/groups/save','GroupsController@postSave');
Route::post('core/groups/filter','GroupsController@postFilter');
Route::post('core/groups/delete','GroupsController@postDelete');
/* End Groups Routes */

//-------------------------------------------------------------------------
/* Start Pages Routes */
// -- Get Method --
Route::get('core/pages','PagesController@getIndex');
Route::get('core/pages/show/{any}','PagesController@getShow');
Route::get('core/pages/update/{any?}','PagesController@getUpdate');
Route::get('core/pages/comboselect','PagesController@getComboselect');
Route::get('core/pages/download','PagesController@getDownload');
Route::get('core/pages/search','PagesController@getSearch');
// -- Post Method --
Route::post('core/pages/save','PagesController@postSave');
Route::post('core/pages/filter','PagesController@postFilter');
Route::post('core/pages/delete','PagesController@postDelete');
/* End Pages Routes */

//-------------------------------------------------------------------------
/* Start Posts Routes */
// -- Get Method --
Route::get('core/posts','PostsController@getIndex');
Route::get('core/posts/show/{any}','PostsController@getShow');
Route::get('core/posts/update/{any?}','PostsController@getUpdate');
Route::get('core/posts/comboselect','PostsController@getComboselect');
Route::get('core/posts/download','PostsController@getDownload');
Route::get('core/posts/search','PostsController@getSearch');
// -- Post Method --
Route::post('core/posts/save','PostsController@postSave');
Route::post('core/posts/filter','PostsController@postFilter');
Route::post('core/posts/delete','PostsController@postDelete');
Route::post('core/posts/config','PostsController@postConfig');
/* End Posts Routes */

//-------------------------------------------------------------------------
/* Start Logs Routes */
// -- Get Method --
Route::get('core/logs','LogsController@getIndex');
Route::get('core/logs/show/{any}','LogsController@getShow');
Route::get('core/logs/update/{any?}','LogsController@getUpdate');
Route::get('core/logs/comboselect','LogsController@getComboselect');
Route::get('core/logs/download','LogsController@getDownload');
Route::get('core/logs/search','LogsController@getSearch');
// -- Post Method --
Route::post('core/logs/save','LogsController@postSave');
Route::post('core/logs/filter','LogsController@postFilter');
Route::post('core/logs/delete','LogsController@postDelete');
/* End Logs Routes */


//-------------------------------------------------------------------------
/* Start Logs Routes */
// -- Get Method --
Route::get('core/forms','FormsController@getIndex');
Route::get('core/forms/show/{any}','FormsController@getShow');
Route::get('core/forms/update/{any?}','FormsController@getUpdate');
Route::get('core/forms/comboselect','FormsController@getComboselect');
Route::get('core/forms/download','FormsController@getDownload');
Route::get('core/forms/search','FormsController@getSearch');
Route::get('core/forms/configuration/{any?}','FormsController@getConfiguration');
Route::get('core/forms/input/{any?}','FormsController@getInput');
Route::get('core/forms/field/{any?}','FormsController@getField');
Route::get('core/forms/removefield/{id?}/{id2?}','FormsController@getRemovefield');
Route::get('core/forms/rebuild/{id?}','FormsController@getRebuild');
Route::get('core/forms/docs','FormsController@getDocs');

// -- Post Method --
Route::post('core/forms/save','FormsController@postSave');
Route::post('core/forms/filter','FormsController@postFilter');
Route::post('core/forms/delete','FormsController@postDelete');
Route::post('core/forms/field/{any?}','FormsController@postField');
Route::post('core/forms/reorder/{any?}','FormsController@postReorder');
/* End  Tables Routes */



//-------------------------------------------------------------------------
/* Start Elfinder Routes */
// -- Get Method --
Route::get('core/elfinder','ElfinderController@getIndex');
/* End  Elfinder Routes */


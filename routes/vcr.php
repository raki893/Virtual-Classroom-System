<?php
//-------------------------------------------------------------------------
/* Start Module Routes */
Route::get('vcr/module','ModuleController@index');
Route::get('vcr/module/create','ModuleController@getCreate');
Route::get('vcr/module/rebuild/{any}','ModuleController@getRebuild');
Route::get('vcr/module/build/{any}','ModuleController@getBuild');
Route::get('vcr/module/config/{any}','ModuleController@getConfig');
Route::get('vcr/module/sql/{any}','ModuleController@getSql');
Route::get('vcr/module/table/{any}','ModuleController@getTable');
Route::get('vcr/module/form/{any}','ModuleController@getForm');
Route::get('vcr/module/formdesign/{any}','ModuleController@getFormdesign');
Route::get('vcr/module/subform/{any}','ModuleController@getSubform');
Route::get('vcr/module/subformremove/{any}','ModuleController@getSubformremove');
Route::get('vcr/module/sub/{any}','ModuleController@getSub');
Route::get('vcr/module/removesub','ModuleController@getRemovesub');
Route::get('vcr/module/permission/{any}','ModuleController@getPermission');
Route::get('vcr/module/source/{any}','ModuleController@getSource');
Route::get('vcr/module/combotable','ModuleController@getCombotable');
Route::get('vcr/module/combotablefield','ModuleController@getCombotablefield');
Route::get('vcr/module/editform/{any?}','ModuleController@getEditform');
Route::get('vcr/module/destroy/{any?}','ModuleController@getDestroy');
Route::get('vcr/module/conn/{any?}','ModuleController@getConn');
Route::get('vcr/module/code/{any?}','ModuleController@getCode');
Route::get('vcr/module/duplicate/{any?}','ModuleController@getDuplicate');

/* POST METHODE */
Route::post('vcr/module/create','ModuleController@postCreate');
Route::post('vcr/module/saveconfig/{any}','ModuleController@postSaveconfig');
Route::post('vcr/module/savesetting/{any}','ModuleController@postSavesetting');
Route::post('vcr/module/savesql/{any}','ModuleController@postSavesql');
Route::post('vcr/module/savetable/{any}','ModuleController@postSavetable');
Route::post('vcr/module/saveform/{any}','ModuleController@postSaveForm');
Route::post('vcr/module/savesubform/{any}','ModuleController@postSavesubform');
Route::post('vcr/module/formdesign/{any}','ModuleController@postFormdesign');
Route::post('vcr/module/savepermission/{any}','ModuleController@postSavePermission');
Route::post('vcr/module/savesub/{any}','ModuleController@postSaveSub');
Route::post('vcr/module/dobuild/{any}','ModuleController@postDobuild');
Route::post('vcr/module/source/{any}','ModuleController@postSource');
Route::post('vcr/module/install','ModuleController@postInstall');
Route::post('vcr/module/package','ModuleController@postPackage');
Route::post('vcr/module/dopackage','ModuleController@postDopackage');
Route::post('vcr/module/saveformfield/{any?}','ModuleController@postSaveformfield');
Route::post('vcr/module/conn/{any?}','ModuleController@postConn');
Route::post('vcr/module/code/{any?}','ModuleController@postCode');
Route::post('vcr/module/duplicate/{any?}','ModuleController@postDuplicate');



/* End  Module Routes */
//-------------------------------------------------------------------------

/* Start  Code Routes */
Route::get('vcr/code','CodeController@index');
Route::get('vcr/code/edit','CodeController@getEdit');
Route::post('vcr/code/source/{any?}','CodeController@PostSource');
Route::post('vcr/code/save','CodeController@PostSave');

Route::get('vcr/config/email','ConfigController@getEmail');
Route::get('vcr/config/security','ConfigController@getSecurity');
Route::post('vcr/code/source/:any','ConfigController@postSource');
/* End  Code Routes */

//-------------------------------------------------------------------------
/* Start  Config Routes */
Route::get('vcr/config','ConfigController@getIndex');
Route::get('vcr/config/email','ConfigController@getEmail');
Route::get('vcr/config/security','ConfigController@getSecurity');
Route::get('vcr/config/translation','ConfigController@getTranslation');
Route::get('vcr/config/log','ConfigController@getLog');
Route::get('vcr/config/clearlog','ConfigController@getClearlog');
Route::get('vcr/config/addtranslation','ConfigController@getAddtranslation');
Route::get('vcr/config/removetranslation/{any}','ConfigController@getRemovetranslation');
// POST METHOD
Route::post('vcr/config/save','ConfigController@postSave');
Route::post('vcr/config/email','ConfigController@postEmail');
Route::post('vcr/config/login','ConfigController@postLogin');
Route::post('vcr/config/email','ConfigController@postEmail');
Route::post('vcr/config/addtranslation','ConfigController@postAddtranslation');
Route::post('vcr/config/savetranslation','ConfigController@postSavetranslation');
/* End  Config Routes */

//-------------------------------------------------------------------------
/* Start  Menu Routes */
Route::get('vcr/menu/','MenuController@getIndex');
Route::get('vcr/menu/index/{any?}','MenuController@getIndex');
Route::get('vcr/menu/destroy/{any?}','MenuController@getDestroy');

Route::post('vcr/menu/save','MenuController@postSave');
Route::post('vcr/menu/saveorder','MenuController@postSaveorder');
/* End  Config Routes */

//-------------------------------------------------------------------------
/* Start  Tables Routes */
Route::get('vcr/tables','TablesController@index');
Route::get('vcr/tables/tableconfig/{any}','TablesController@getTableconfig');
Route::get('vcr/tables/mysqleditor','TablesController@getMysqleditor');
Route::get('vcr/tables/tableconfig','TablesController@getTableconfig');
Route::get('vcr/tables/tablefieldedit/{any}','TablesController@getTablefieldedit');
Route::get('vcr/tables/tablefieldremove/{id?}/{id2?}','TablesController@getTablefieldremove');
// POST METHOD
Route::post('vcr/tables/tableremove','TablesController@postTableremove');
Route::post('vcr/tables/tableinfo/{any}','TablesController@postTableinfo');
Route::post('vcr/tables/mysqleditor','TablesController@postMysqleditor');
Route::post('vcr/tables/tablefieldsave/{any?}','TablesController@postTablefieldsave');
Route::post('vcr/tables/tables','TablesController@postTables');
/* End  Tables Routes */


//-------------------------------------------------------------------------
/* Start Logs Routes */
// -- Get Method --
Route::get('vcr/rac','RacController@getIndex');
Route::get('vcr/rac/show/{any}','RacController@getShow');
Route::get('vcr/rac/update/{any?}','RacController@getUpdate');
Route::get('vcr/rac/comboselect','RacController@getComboselect');
Route::get('vcr/rac/download','RacController@getDownload');
Route::get('vcr/rac/search','RacController@getSearch');

// -- Post Method --
Route::post('vcr/rac/save','RacController@postSave');
Route::post('vcr/rac/filter','RacController@postFilter');
Route::post('vcr/rac/delete/{any?}','RacController@postDelete');
/* End  Tables Routes */


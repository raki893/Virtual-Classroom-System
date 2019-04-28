<?php
        
// Start Routes for attendace 
Route::get('attendace','AttendaceController@getIndex');
Route::get('attendace/show/{any?}','AttendaceController@getShow');
Route::get('attendace/update/{any?}','AttendaceController@getUpdate');
Route::get('attendace/comboselect','AttendaceController@getComboselect');
Route::get('attendace/download','AttendaceController@getDownload');
Route::get('attendace/search','AttendaceController@getSearch');
Route::get('attendace/export/{any?}','AttendaceController@getExport');
Route::get('attendace/lookup/{id?}/{id2?}','AttendaceController@getLookup');
Route::get('attendace/import','AttendaceController@getImport');
// -- Post Method --
Route::post('attendace/save','AttendaceController@postSave');
Route::post('attendace/filter','AttendaceController@postFilter');
Route::post('attendace/delete/{any?}','AttendaceController@postDelete');
Route::post('attendace/savepublic','AttendaceController@postSavepublic');
Route::post('attendace/import','AttendaceController@postImport');
// End Routes for attendace 

                    
// Start Routes for studentteacher 
Route::get('studentteacher','StudentteacherController@getIndex');
Route::get('studentteacher/show/{any?}','StudentteacherController@getShow');
Route::get('studentteacher/update/{any?}','StudentteacherController@getUpdate');
Route::get('studentteacher/comboselect','StudentteacherController@getComboselect');
Route::get('studentteacher/download','StudentteacherController@getDownload');
Route::get('studentteacher/search','StudentteacherController@getSearch');
Route::get('studentteacher/export/{any?}','StudentteacherController@getExport');
Route::get('studentteacher/lookup/{id?}/{id2?}','StudentteacherController@getLookup');
Route::get('studentteacher/import','StudentteacherController@getImport');
// -- Post Method --
Route::post('studentteacher/save','StudentteacherController@postSave');
Route::post('studentteacher/filter','StudentteacherController@postFilter');
Route::post('studentteacher/delete/{any?}','StudentteacherController@postDelete');
Route::post('studentteacher/savepublic','StudentteacherController@postSavepublic');
Route::post('studentteacher/import','StudentteacherController@postImport');
// End Routes for studentteacher 

                    ?>
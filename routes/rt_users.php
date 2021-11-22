<?php



Route::group(['prefix' => 'Acronime'], function(){
    Route::get('inicio', 'AcronimeController@index');    
    Route::get('searchingAcronime/{key}', 'AcronimeController@searchingAcronime');
});

Route::group(['prefix' => 'searching'], function(){
    Route::get('inicio', 'SearchController@index');
    Route::get('service/{name}/{per}', 'SearchController@service');
});
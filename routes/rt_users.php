<?php



Route::group(['prefix' => 'Acronime'], function(){
    Route::get('inicio', 'AcronimeController@index');     
    Route::get('searchingAcronime/{key}', 'AcronimeController@searchingAcronime');
});

<?php

Route::get('accounts', 'BankAccountController@index');
Route::get('getbanks', 'BankAccountController@getbanks');
Route::group(['prefix' => 'account'], function () {
    Route::post('add', 'BankAccountController@add');
    Route::get('edit/{id}', 'BankAccountController@edit');
    Route::post('update/{id}', 'BankAccountController@update');
    Route::delete('delete/{id}', 'BankAccountController@delete');
});

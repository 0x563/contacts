<?php

Route::get('/', 'ContactController@index');

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('contacts', 'ContactController@apiSearch');
});

<?php

Route::group(['middleware' => ['api']], function(){

    Route::post('usersProfile/register','AuthController@register' );
    Route::post('users/login','AuthController@login' );



    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::get('users/logout','AuthController@logout' );



    });




});

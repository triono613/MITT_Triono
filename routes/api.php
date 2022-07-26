<?php

Route::group(['middleware' => ['api']], function(){

    Route::post('usersProfile/register','AuthController@register' );
    Route::post('users/login','AuthController@signin' );



    Route::group(['middleware' => ['jwt.auth']], function () {




    });




});

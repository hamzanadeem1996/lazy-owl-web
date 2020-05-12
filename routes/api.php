<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', 'API\UserController@login');
Route::post('auth/register', 'API\UserController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('auth/logout', 'API\UserController@logout');
    
    Route::group(['prefix' => '/project'], function (){
        Route::get('/active', 'API\ProjectController@getActiveProjects');
        Route::get('/search', 'API\ProjectController@searchProjects');
        Route::get('/{id}', 'API\ProjectController@getProjectById');
        Route::post('/bid', 'API\ProjectController@bidOnProject');
        Route::post('/add', 'API\ProjectController@addProject');
    });
});

Route::group(['middleware' => 'api', 'prefix' => 'password'], function () {    
    Route::post('create', 'API\PasswordResetController@create');
    Route::get('find/{token}', 'API\PasswordResetController@find');
    Route::post('reset', 'API\PasswordResetController@reset');
});


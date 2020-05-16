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
        Route::get('/bid/accept/{id}', 'API\ProjectController@acceptBid');
        Route::post('/edit', 'API\ProjectController@editUserProject');
        Route::get('/discard/{id}', 'API\ProjectController@discardUserProject');
        Route::get('/mark-completed/{id}', 'API\ProjectController@markCompletedUserTask');
        Route::post('/query/add', 'API\ProjectController@addUserTaskQuery');
    });

    Route::group(['prefix' => '/user'], function (){
        Route::get('/{id}', 'API\UserController@getUserById');
        Route::post('/update', 'API\UserController@updateUserProfile');
        Route::post('/update/profile-image', 'API\UserController@updateUserProfileImage');
        Route::post('/update/education', 'API\UserController@updateUserEducation');
        Route::post('/update/portfolio', 'API\UserController@updateUserPortfolio');
        Route::get('/tasks/{id}', 'API\ProjectController@getUserTasks');
        Route::post('/change-password', 'API\UserController@changeUserPassword');
    });

    Route::group(['prefix' => '/payment'], function (){
        Route::post('/card-details/add', 'API\UserController@addCardDetails');
        Route::get('/credit-card/details/{id}', 'API\UserController@getCardDetails');
        Route::get('/payment-methods/all', 'API\UserController@getPaymentMethods');
        Route::get('/transactions-history/{id}', 'API\UserController@getUserTransactions');
    });

    Route::get('/education-degrees/all', 'API\UserController@getAllActiveDegrees');
    Route::get('/services/all', 'API\UserController@getAllServices');
});

Route::group(['middleware' => 'api', 'prefix' => 'password'], function () {    
    Route::post('create', 'API\PasswordResetController@create');
    Route::get('find/{token}', 'API\PasswordResetController@find');
    Route::post('reset', 'API\PasswordResetController@reset');
});


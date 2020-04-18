<?php

Auth::routes();
Route::get('/home', 'HomeController@checkUserRole');
//Route::get('/', 'HomeController@checkUserRole');
Route::get('/', 'FrontendController@index');

Route::get('/active/tasks', 'HomeController@getActiveTasks');
Route::get('/active/tasks/{id}', 'HomeController@getTaskByid');
Route::post('/active/task/bid', 'BidController@addBidToTask');
Route::get('/active/task/poster/{id}', 'HomeController@getUserProfileById');
Route::get('/active/task/bids/{id}', 'BidController@getTaskBidsById');
Route::get('/active/task/bidder/{id}', 'HomeController@getUserProfileById');
Route::get('/active/task/accept-bit/{id}', 'BidController@acceptBid');

Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function (){
   Route::get('/', 'AdminController@index')->name('home');
   Route::get('profile', 'AdminController@getAdminProfile');
   Route::post('update_password', 'AdminController@passwordUpdate');
   Route::get('/logout', 'AdminController@logOut');
   Route::get('sub-categories/{id}', 'AdminController@getSubCategoriesByCategoryId');

   Route::group(['prefix' => '/user'], function (){
       Route::get('/add', 'AdminController@addUserForm');
       Route::post('/add', 'AdminController@addUserPost');
       Route::get('/active', 'AdminController@getActiveUsers');
       Route::get('/disabled', 'AdminController@getDisabledUsers');
       Route::post('/disable', 'AdminController@markUserDisable');
       Route::get('/edit/{id}', 'AdminController@editUserForm');
       Route::post('edit', 'AdminController@editUserPost');
       Route::post('/edit/qualification', 'AdminController@editUserQualification');
       Route::post('/edit/portfolio', 'AdminController@editUserPortfolio');
       Route::post('/comment/delete', 'AdminController@deleteComment');
       Route::get('/programme/{id}', 'AdminController@getProgrammesByDegreeId');
   });
   Route::group(['prefix' => '/service-provider'], function (){
       Route::get('/active', 'AdminController@getActiveServiceProvider');
       Route::get('/disabled', 'AdminController@getDisabledServiceProvider');
       Route::get('/edit/{id}', 'AdminController@editServiceProviderForm');
       Route::post('edit', 'AdminController@editServiceProviderPost');
       Route::post('/services/edit', 'AdminController@editServiceProviderServicesPost');
       Route::post('/service/delete', 'AdminController@deleteServiceProviderService');
   });
    Route::group(['prefix' => '/consultant'], function (){
        Route::get('/active', 'AdminController@getActiveConsultant');
        Route::get('/disabled', 'AdminController@getDisabledConsultant');
        Route::get('/edit/{id}', 'AdminController@editConsultantForm');
        Route::post('edit', 'AdminController@editConsultantPost');
        Route::post('/experience/edit', 'AdminController@editConsultantExperiencePost');
        Route::post('/experience/delete', 'AdminController@deleteConsultantExperience');
    });
    Route::group(['prefix' => '/category'], function (){
        Route::get('/add', 'AdminController@addCategoryForm');
        Route::post('/add', 'AdminController@addCategoryPost');
        Route::get('/active', 'AdminController@getActiveCategory');
        Route::get('/disabled', 'AdminController@getDisabledCategory');
        Route::post('/disable', 'AdminController@markCategoryDisable');
        Route::get('/edit/{id}', 'AdminController@editCategoryForm');
        Route::post('edit', 'AdminController@editCategoryPost');
        Route::get('/sub-categories/{id}', 'AdminController@showSubCategories');
    });
    Route::group(['prefix' => '/sub-category'], function (){
        Route::get('/add', 'AdminController@addSubCategoryForm');
        Route::post('/add', 'AdminController@addSubCategoryPost');
        Route::get('/active', 'AdminController@getActiveSubCategory');
        Route::get('/disabled', 'AdminController@getDisabledSubCategory');
        Route::post('/disable', 'AdminController@markSubCategoryDisable');
        Route::get('/edit/{id}', 'AdminController@editSubCategoryForm');
        Route::post('/edit', 'AdminController@editSubCategoryPost');
    });
    Route::group(['prefix' => '/project'], function (){
        Route::get('/add', 'AdminController@addProjectForm');
        Route::post('/add', 'AdminController@addProjectPost');
        Route::get('/active', 'AdminController@getActiveProject');
        Route::get('/discarded', 'AdminController@getDiscardedProjects');
        Route::get('/edit/{id}', 'AdminController@editProjectForm');
        Route::post('/edit', 'AdminController@editProjectPost');
        Route::get('/completed', 'AdminController@completedProjectsList');
        Route::post('/actions', 'AdminController@projectActions');
    });

    Route::group(['prefix' => '/degree'], function (){
        Route::get('/add', 'AdminController@addDegreeForm');
        Route::post('/add', 'AdminController@addDegreePost');
        Route::get('/active', 'AdminController@getActiveDegrees');
        Route::get('/edit/{id}', 'AdminController@editDegrees');
        Route::post('/edit', 'AdminController@editDegreesPost');
        Route::post('/delete', 'AdminController@deleteDegree');
        Route::post('/disable', 'AdminController@markDegreeDisable');
        Route::get('/disabled', 'AdminController@getDisabledDegrees');
        Route::get('/programme/{id}', 'AdminController@getProgramme');
    });

    Route::group(['prefix' => '/programme'], function (){
        Route::get('/add', 'AdminController@addprogrammeForm');
        Route::post('/add', 'AdminController@addprogrammePost');
        Route::get('/edit/{id}', 'AdminController@editProgramme');
        Route::post('/edit', 'AdminController@editProgrammePost');
        Route::get('/active', 'AdminController@getActiveProgrammes');
        Route::post('/disable', 'AdminController@markProgramDisable');
        Route::get('/disabled', 'AdminController@getDisabledProgrammes');
    });

    Route::group(['prefix' => '/payment-methods'], function(){
        Route::get('/', 'PaymentMethodsController@allPaymentMethodsList');
        Route::post('/edit', 'PaymentMethodsController@editPaymentMethod');
    });
});

//Service Seeker Routes

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function (){
   Route::get('/', 'UserController@index');
   Route::get('/profile/{id}', 'UserController@userProfileView');
   Route::get('/qualification', 'UserController@getQualification');
   Route::get('/account/{id}', 'UserController@getUserAccount');
   Route::post('/account/image', 'UserController@updateUserProfileImage');
   Route::post('/edit', 'UserController@editUserProfile');
   Route::post('/qualification', 'UserController@updateUserQualification');
   Route::post('/portfolio', 'UserController@updateUserPortfolio');
   Route::post('/services', 'UserController@updateUserServices');
   Route::post('/project/add', 'ProjectController@addProjectPost');
   Route::post('/project/edit', 'ProjectController@editProjectPost');
   Route::get('/tasks', 'ProjectController@getUserTasks');
   Route::get('/project/{id}', 'ProjectController@getTaskById');
   Route::get('/sub-categories', 'SubCategoryController@getAllSubCategories');
   Route::post('/project/delete', 'ProjectController@deleteProject');
   Route::post('/project/complete', 'ProjectController@completeProject');
   Route::get('/payment-methods', 'PaymentMethodsController@allPaymentMethodsList');
   Route::post('/payment', 'PaymentsController@addPayment');
});


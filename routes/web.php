<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ForgotPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

// Main Page Route

Route::group(['middleware' => 'web'], function () {
  Route::get('/', 'FrontendController@index')->name('frontend');
  Route::get('frontend', 'FrontendController@index')->name('frontend');
});

Route::group(
  ['middleware' => 'prevent-back-history'],
  function () {
    Route::get('backend', 'AuthenticationController@login')->name('backend')->middleware('alreadyLoggedIn');
    Route::post('user/login', 'AuthenticationController@user_login')->name('user-login');
    Route::get('user/logout', 'AuthenticationController@logout')->name('user-logout');
  }
);

/* Route Authentication Pages */
// Route::group(['middleware' => 'auth', 'prefix' => 'auth'], function () {
Route::post('send-password-reset-link', 'AuthController@send_password_reset_link')->name('send-password-reset-link');
Route::get('reset-password', 'AuthController@reset_password')->name('reset-password');
Route::get('lock-screen', 'AuthController@lock_screen')->name('auth-lock_screen');
// });



Route::get('forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forgot.password.get');
Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forgot.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


/* Route Dashboards */
Route::group(['prefix' => 'dashboard', 'middleware' => 'prevent-back-history'], function () {
  Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard')->middleware('isLoggedIn');
});


/* Employee */
Route::group(['prefix' => 'application-info', 'middleware' => 'prevent-back-history'], function () {
  Route::get('application', 'ApplicationController@applications')->name('application')->middleware('isLoggedIn');
  Route::get('completed-application', 'ApplicationController@Completeapplications')->name('completed-application')->middleware('isLoggedIn');
  Route::get('application-completed/{id}', 'ApplicationController@ApplicationCompleted')->name('application-completed')->middleware('isLoggedIn');
});


Route::group(['prefix' => 'application-info'], function () {
  Route::get('downloadphoto/{id}', 'ApplicationController@downloadphoto')->name('downloadphoto');
  Route::get('downloadCv/{id}', 'ApplicationController@downloadCv')->name('downloadCv');
});


/* Company */
Route::group(['prefix' => 'company-info', 'middleware' => 'prevent-back-history'], function () {
  Route::get('companies-info', 'CompanyController@companies')->name('companies-info')->middleware('isLoggedIn');
});

/* Users */
Route::group(['prefix' => 'user-info', 'middleware' => 'prevent-back-history'], function () {
  Route::get('users-info', 'UsersController@users')->name('users-info')->middleware('isLoggedIn');
  Route::get('add-user', 'UsersController@addUsers')->name('add-user')->middleware('isLoggedIn');
  Route::post('create-user', 'UsersController@createUsers')->name('create-user')->middleware('isLoggedIn');
  Route::get('edit-user/{id}', 'UsersController@editUsers')->name('edit-user')->middleware('isLoggedIn');
  Route::post('update-user', 'UsersController@updateUsers')->name('update-user')->middleware('isLoggedIn');
  Route::get('delete-user/{id}', 'UsersController@deleteUsers')->name('delete-user')->middleware('isLoggedIn');
});

/* Masters - Category */
Route::group(['prefix' => 'masters', 'middleware' => 'prevent-back-history'], function () {
  Route::get('category', 'CategoryController@index')->name('category')->middleware('isLoggedIn');
  Route::get('add-category', 'CategoryController@addCategory')->name('add-category')->middleware('isLoggedIn');
  Route::post('create-category', 'CategoryController@createCategory')->name('create-category')->middleware('isLoggedIn');
  Route::get('edit-category/{id}', 'CategoryController@editCategory')->name('edit-category')->middleware('isLoggedIn');
  Route::post('update-category', 'CategoryController@updateCategory')->name('update-category')->middleware('isLoggedIn');
  Route::get('inactivate-category/{id}', 'CategoryController@inactivateCategory')->name('inactivate-category')->middleware('isLoggedIn');
  Route::get('activate-category/{id}', 'CategoryController@activateCategory')->name('activate-category')->middleware('isLoggedIn');
});

/* Masters - Job Fields */
Route::group(['prefix' => 'masters', 'middleware' => 'prevent-back-history'], function () {
  Route::get('job-fields', 'JobFieldsController@index')->name('job-fields')->middleware('isLoggedIn');
  Route::get('add-job-fields', 'JobFieldsController@addJob_Fields')->name('add-job-fields')->middleware('isLoggedIn');
  Route::post('create-job-fields', 'JobFieldsController@createJob_Fields')->name('create-job-fields')->middleware('isLoggedIn');
  Route::get('edit-job-fields/{id}', 'JobFieldsController@editJob_Fields')->name('edit-job-fields')->middleware('isLoggedIn');
  Route::post('update-job-fields', 'JobFieldsController@updatejob_fields')->name('update-job-fields')->middleware('isLoggedIn');
  Route::get('inactivate-job-fields/{id}', 'JobFieldsController@inactivatejob_fields')->name('inactivate-job-fields')->middleware('isLoggedIn');
  Route::get('activate-job-fields/{id}', 'JobFieldsController@activatejob_fields')->name('activate-job-fields')->middleware('isLoggedIn');
});

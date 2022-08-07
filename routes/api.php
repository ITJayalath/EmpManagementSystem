<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
  'prefix' => 'auth'
], function () {
  Route::post('login', 'AuthController@login');
  Route::post('register', 'AuthController@register');

  Route::group([
    'middleware' => 'auth:api'
  ], function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');
  });
});



Route::post('register',[App\Http\Controllers\API\CompanyController::class,'expectemp']);

Route::get('companies', [App\Http\Controllers\API\CompanyController::class, 'getCompanies']);

Route::delete('delete/{id}', [App\Http\Controllers\API\CompanyController::class, 'delete']);

Route::post('register',[App\Http\Controllers\API\EmployeeController::class,'employeeRegister']);

Route::get('employee', [App\Http\Controllers\API\EmployeeController::class, 'getEmployee']);

Route::delete('delete/{id}', [App\Http\Controllers\API\EmployeeController::class, 'delete']);

Route::post('leave',[App\Http\Controllers\API\EmployeeController::class,'employeeLeave']);

// Route::delete('/task/delete/{id}',[TaskController::class, 'delete']);


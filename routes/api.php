<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/employees', 'EmployeeController@index');
// Route::post('/employees', 'EmployeeController@store');
// Route::get('/employees/{id}', 'EmployeeController@show');
// Route::put('/employees/{id}', 'EmployeeController@update');
// Route::delete('/employees/{id}', 'EmployeeController@destroy');


Route::apiResource('employees', EmployeeController::class);

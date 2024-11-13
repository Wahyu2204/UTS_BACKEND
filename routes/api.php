<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/employees', [EmployeesController::class, 'index']);
Route::post('/employee', [EmployeesController::class, 'store']);
Route::put('/employee/{id}', [EmployeesController::class, 'update']);
Route::delete('/employee/{id}', [EmployeesController::class, 'destroy']);
Route::get('/employee/{id}', [EmployeesController::class, 'show']);
Route::get('employees/search', [EmployeesController::class, 'search']);
Route::get('employees/active', [EmployeesController::class, 'getActive']);
Route::get('employees/inactive', [EmployeesController::class, 'getInactive']);
Route::get('employees/terminated', [EmployeesController::class, 'getTerminated']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
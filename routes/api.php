<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/employees', [EmployeesController::class, 'index']);
Route::post('/employee', [EmployeesController::class, 'store']);
Route::put('/employee/{id}', [EmployeesController::class, 'update']);
Route::delete('/employee/{id}', [EmployeesController::class, 'destroy']);
Route::get('/employee/{id}', [EmployeesController::class, 'show']);
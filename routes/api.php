<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExportPdfController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Autenticación
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->post('/logout', [AuthController::class, 'logout']);

// Customer CRUD

// Reservado solo a admins
Route::middleware(['auth:sanctum','abilities:all_privileges'])->group(function () {
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/export', [ExportPdfController::class, 'exportCustomers']);
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);
});

// Solo Admins o el propio user
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->middleware(['ability:all_privileges,customer-show']);
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->middleware(['ability:all_privileges,customer-show']);
});



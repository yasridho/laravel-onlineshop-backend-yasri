<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Register
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

// Logout
Route::middleware('auth:sanctum')->post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

// Login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// Category
Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);

// Product
Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);


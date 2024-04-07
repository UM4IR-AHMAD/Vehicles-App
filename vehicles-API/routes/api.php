<?php

use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\CategoryController;
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


Route::middleware('auth:sanctum')->group(function () {
    // category routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories', 'index');
        Route::get('categories/all', 'all');
        Route::post('category/add', 'store');
        Route::get('category/{category}/edit', 'edit');
        Route::put('category/update', 'update');
        Route::delete('category/{category}', 'delete');
    });


    // car routes
    Route::controller(CarController::class)->group(function () {
        Route::get('cars', 'index');
        Route::post('car/add', 'store');
        Route::get('car/{car}/edit', 'edit');
        Route::put('car/update', 'update');
        Route::delete('car/{car}', 'delete');
    });


    // dashboard routes
    Route::get('dashboard', [DashboardController::class, 'index']);
});


// authentication routes
Route::controller(AuthenticationController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->middleware('auth:sanctum');
});

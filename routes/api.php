<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ImportOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RamController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
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

//User API
// Route::get('/user/{id}', [UserController::class, 'show']);
// Route::get('/user', [UserController::class, 'index']);

Route::prefix('admin')->middleware('api')->group(function (): void {

    //Login API
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/change-pass', [AuthController::class, 'changePassWord']);

    //Category API
    Route::resource('category', CategoryController::class);

    //Product API
    Route::resource('product', ProductController::class);
    // Route::delete('/product/{product}/image/{public_id}', [ProductController::class, 'removeImage']);

    //Color API
    Route::resource('color', ColorController::class);

    //Ram API
    Route::resource('ram', RamController::class);

    //Storage API
    Route::resource('storage', StorageController::class);

    //WareHouse API
    Route::resource('warehouse', WarehouseController::class);

    //ImportOrder API
    Route::resource('importOrder', ImportOrderController::class);

});

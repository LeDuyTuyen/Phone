<?php

declare(strict_types=1);

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RamController;
use App\Http\Controllers\StorageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::prefix('admin')->group(function () {
//     Route::prefix('/brand')->group(function () {

//         Route::get('/', [BrandController::class, 'get'])->name('listBrand');

//         Route::post('/add', [BrandController::class, 'add'])->name('addBrand');

//         Route::put('/update', [BrandController::class, 'update'])->name('updateBrand');

//         Route::delete('/delete', [BrandController::class, 'delete'])->name('deleteBrand');
//     });
//     Route::prefix('category')->group(function () {
//         Route::get('/', [CategoryController::class, 'get'])->name('listCategory');

//         Route::post('/add', [CategoryController::class, 'add'])->name('addCategory');

//         Route::put('/update', [CategoryController::class, 'update'])->name('updateCategory');

//         Route::get('/delete', [CategoryController::class, 'delete'])->name('deleteCategory');
//     });
//     Route::prefix('prodcut')->group(function () {
//         Route::get('/', [ProductController::class, 'get'])->name('listProduct');

//         Route::post('/add', [ProductController::class, 'add'])->name('addProduct');

//         Route::put('/update', [ProductController::class, 'update'])->name('updateProduct');

//         Route::get('/delete', [ProductController::class, 'delete'])->name('deleteProduct');
//     });
//     Route::prefix('color')->group(function () {
//         Route::get('/', [ColorController::class, 'get'])->name('listColor');

//         Route::get('/add', [ColorController::class, 'add'])->name('addColor');

//         Route::post('/save', [ColorController::class, 'save'])->name('saveColor');

//         Route::get('/edit/{color_id}', [ColorController::class, 'edit'])->name('editColor');

//         Route::put('/update/{color_id}', [ColorController::class, 'update'])->name('updateColor');

//         Route::delete('/delete/{color_id}', [ColorController::class, 'delete'])->name('deleteColor');
//     });

//     Route::prefix('ram')->group(function () {
//         Route::get('/', [RamController::class, 'get'])->name('listRam');

//         Route::get('/add', [RamController::class, 'add'])->name('addRam');

//         Route::post('/save', [RamController::class, 'save'])->name('saveRam');

//         Route::get('/edit/{ram_id}', [RamController::class, 'edit'])->name('editRam');

//         Route::put('/update/{ram_id}', [RamController::class, 'update'])->name('updateRam');

//         Route::delete('/delete/{ram_id}', [RamController::class, 'delete'])->name('deleteRam');
//     });
//     Route::prefix('storage')->group(function () {
//         Route::get('/', [StorageController::class, 'get'])->name('listStorage');

//         Route::get('/add', [StorageController::class, 'add'])->name('addStorage');

//         Route::post('/save', [StorageController::class, 'save'])->name('saveStorage');

//         Route::get('/edit/{storage_id}', [StorageController::class, 'edit'])->name('editStorage');

//         Route::put('/update/{storage_id}', [StorageController::class, 'update'])->name('updateStorage');

//         Route::delete('/delete/{storage_id}', [StorageController::class, 'delete'])->name('deleteStorage');
//     });
// });
// FrontEnd

// Route::get('/login', [LoginController::class, 'login'])->name('login');

// Route::get('/', function () {
//     return view('Client.home');
// });
// Route::get('/home', function () {
//     return view('Client.Product.home');
// });
// Route::post('/add', [BrandController::class, 'add'])->name('addBrand');

// Route::put('/update', [BrandController::class, 'update'])->name('updateBrand');

// Route::get('/delete', [BrandController::class, 'delete'])->name('deleteBrand');

Route::view('/{any}', 'app')->where('any', '.*');

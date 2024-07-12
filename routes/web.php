<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\TagCategoryController;
use Illuminate\Support\Facades\Route;


// Route::group(

// );
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/searchByScan', [HomeController::class, 'searchByScan'])->name('searchByScan');
Route::get('/show/{id}', [HomeController::class, 'show'])->name('show');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(BrandController::class)->group(function () {
        Route::get('/admin/brand', 'brand')->name('dashboard');
        Route::get('/tag-category', 'categories');
        Route::get('/brands/{id}/categories', 'getCategoriesByBrand');
    });

    Route::controller(ExcelController::class)->group(function () {
        Route::post('/admin/import', 'import')->name('brands.import');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/category', 'category')->name('category');
        Route::get('/tag-brand', 'brands');
        Route::get('/categories/{id}/brands', 'getBrandsByCategory');
    });

    Route::resources([
        'brand' => BrandController::class,
        'category' => CategoryController::class,
    ]);

    Route::get('/register')->name('register');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

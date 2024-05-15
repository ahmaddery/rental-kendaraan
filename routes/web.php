<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\artikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\CategoryController;
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
route::get('/home',[HomeController::class,'index']);
Route::get('/admin/index', [HomeController::class, 'index'])->name('admin.index');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Route::middleware(['admin'])->group(function () {

//});


// route untuk type dihalaman admin
Route::middleware(['admin'])->group(function () {
Route::get('admin/types', [TypeController::class, 'index'])->name('admin.types.index');
Route::get('admin/types/create', [TypeController::class, 'create'])->name('admin.types.create');
Route::post('admin/types', [TypeController::class, 'store'])->name('admin.types.store');
Route::get('admin/types/{type}', [TypeController::class, 'show'])->name('admin.types.show');
Route::get('admin/types/{type}/edit', [TypeController::class, 'edit'])->name('admin.types.edit');
Route::put('admin/types/{type}', [TypeController::class, 'update'])->name('admin.types.update');
Route::delete('admin/types/{type}', [TypeController::class, 'destroy'])->name('admin.types.destroy');
});

//route untuk category dihalaman admin
Route::middleware(['admin'])->group(function () {
Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('admin/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\artikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TypeController;
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

Route::middleware(['admin'])->group(function () {
Route::get('admin/types', [TypeController::class, 'index'])->name('admin.types.index');
Route::get('admin/types/create', [TypeController::class, 'create'])->name('admin.types.create');

// Route for storing a new type
Route::post('admin/types', [TypeController::class, 'store'])->name('admin.types.store');

// Route for displaying a specific type
Route::get('admin/types/{type}', [TypeController::class, 'show'])->name('admin.types.show');

// Route for displaying the form to edit a type
Route::get('admin/types/{type}/edit', [TypeController::class, 'edit'])->name('admin.types.edit');

// Route for updating a type
Route::put('admin/types/{type}', [TypeController::class, 'update'])->name('admin.types.update');

// Route for deleting a type
Route::delete('admin/types/{type}', [TypeController::class, 'destroy'])->name('admin.types.destroy');
});
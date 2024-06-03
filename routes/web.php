<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\artikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PengambilanPengembalianController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Admin\UserController;
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
Route::middleware(['admin'])->group(function () {
Route::get('/admin/index', [HomeController::class, 'index'])->name('admin.index');
});

//menampilkan halaman utama 
// Route untuk menampilkan halaman utama dengan daftar kendaraan
Route::get('/', [UtamaController::class, 'index'])->name('index');
Route::get('/kendaraan/{id}', [UtamaController::class, 'show'])->name('kendaraan.detail');
Route::get('/tambah-keranjang/{id}', [UtamaController::class, 'tambahKeranjang'])->name('tambah.keranjang');
//Route::get('/keranjang', [UtamaController::class, 'showKeranjang'])->name('keranjang');
Route::post('/checkout', [UtamaController::class, 'checkout'])->name('checkout');
//Route::post('/checkout', 'UtamaController@checkout')->name('checkout');
Route::post('/midtrans/webhook', [UtamaController::class, 'handleMidtransNotification'])->name('midtrans.webhook');
Route::post('/payment-redirect', [UtamaController::class, 'handlePaymentRedirect'])->name('payment.redirect');
Route::post('/pengambilan/store', [PengambilanPengembalianController::class, 'store'])->name('pengambilan.store');
//Route::get('/payment-redirect', [UtamaController::class, 'handlePaymentRedirect'])->name('payment.redirect');

//route untuk pengambilan
Route::get('/pengambilan-pengembalian', [PengambilanPengembalianController::class, 'index'])->name('pengambilan_pengembalian.index');

//route untuk riwayat transaksi 
Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'index'])->name('riwayat.transaksi');
//route untuk rating 
Route::group(['middleware' => ['auth']], function () {
  Route::get('/kendaraan/{id}/rating/create', [RatingController::class, 'create'])->name('rating.create');
  Route::post('/kendaraan/{id}/rating', [RatingController::class, 'store'])->name('rating.store');
  Route::get('rating/{id}/edit', [RatingController::class, 'edit'])->name('rating.edit');
Route::post('rating/{id}', [RatingController::class, 'update'])->name('rating.update');
});

//route product
Route::get('/product', [ProductController::class, 'index'])->name('product');

//route about
Route::get('/about', [AboutController::class, 'index'])->name('about');




// aktifkan untuk mengubah ke view default laravel
//Route::get('/', function () {
  //  return view('welcome');
//});

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

//route untuk brand dihalaman admin
Route::middleware(['admin'])->group(function () {
Route::get('admin/brands', [BrandController::class, 'index'])->name('admin.brands.index');
Route::get('admin/brands/create', [BrandController::class, 'create'])->name('admin.brands.create');
Route::post('admin/brands', [BrandController::class, 'store'])->name('admin.brands.store');
Route::get('admin/brands/{brand}', [BrandController::class, 'show'])->name('admin.brands.show');
Route::get('admin/brands/{brand}/edit', [BrandController::class, 'edit'])->name('admin.brands.edit');
Route::put('admin/brands/{brand}', [BrandController::class, 'update'])->name('admin.brands.update');
Route::delete('admin/brands/{brand}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');
});


// route untuk kendaraan dihalaman admin
Route::middleware(['admin'])->group(function () {
Route::get('/admin/kendaraan', [KendaraanController::class, 'index'])->name('admin.kendaraan.index');
Route::get('/admin/kendaraan/create', [KendaraanController::class, 'create'])->name('admin.kendaraan.create');
Route::post('/admin/kendaraan', [KendaraanController::class, 'store'])->name('admin.kendaraan.store');
Route::get('/admin/kendaraan/{id}', [KendaraanController::class, 'show'])->name('admin.kendaraan.show');
Route::get('/admin/kendaraan/{id}/edit', [KendaraanController::class, 'edit'])->name('admin.kendaraan.edit');
Route::put('/admin/kendaraan/{id}', [KendaraanController::class, 'update'])->name('admin.kendaraan.update');
Route::delete('/admin/kendaraan/{id}', [KendaraanController::class, 'destroy'])->name('admin.kendaraan.destroy');
});

// route untuk feedback admin
Route::middleware(['admin'])->group(function () {
  Route::get('admin/feedbacks', [FeedbackController::class, 'index'])->name('admin.feedbacks.index');
  Route::get('admin/feedbacks/{feedback}', [FeedbackController::class, 'show'])->name('admin.feedbacks.show');
  Route::delete('admin/feedbacks/{feedback}', [FeedbackController::class, 'destroy'])->name('admin.feedbacks.destroy');
});

// route untuk pengembalian admin
Route::prefix('admin')->group(function () {
  Route::get('pengambilan-pengembalian', [PengembalianController::class, 'index'])->name('admin.pengambilan_pengembalian.index');
  Route::get('/notifications/{id}', [PengembalianController::class, 'read'])->name('notifications.read');
});



// untuk halaman dashboard 
Route::prefix('admin')->group(function () {
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


Route::middleware(['admin'])->group(function () {
  Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
  Route::get('admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
  Route::delete('admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
  Route::post('admin/users/{id}/restore', [UserController::class, 'restore'])->name('admin.users.restore');
});


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\Kendaraan\KendaraanController;
use App\Http\Controllers\Api\Kendaraan\CartController;
use App\Http\Controllers\Api\Kendaraan\PaymentController;
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



//request login  dan register
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [RegisterController::class, 'register']);
Route::post('/password/reset-link', [PasswordResetLinkController::class, 'sendResetLink']);



Route::middleware(['check.token'])->group(function () {
Route::get('/kendaraan', [KendaraanController::class, 'index']);  // Route untuk mengambil semua data kendaraan
Route::get('/kendaraan/{id}', [KendaraanController::class, 'show']);   // Route untuk mengambil data kendaraan berdasarkan ID
});

Route::middleware(['check.token'])->group(function () {
Route::get('cart/{user_id}', [cartController::class, 'index']);
Route::post('cart', [cartController::class, 'store']);
Route::put('cart/{id}', [cartController::class, 'update']);
Route::delete('cart/{id}', [cartController::class, 'destroy']);
});



Route::middleware(['check.token'])->group(function () {
// Route untuk membuat invoice pembayaran melalui Xendit
Route::post('/payment/create', [PaymentController::class, 'createXenditPayment']);
});

Route::get('payments/{user_id}', [PaymentController::class, 'getTransactionHistory']);
Route::get('payments/{user_id}/{external_id}', [PaymentController::class, 'getTransactionByExternalId']);
// Route untuk menangani callback webhook dari Xendit
Route::post('/payment/callback', [PaymentController::class, 'handleCallback']);
Route::get('payment/status/{user_id}', [PaymentController::class, 'getPaymentStatus']);

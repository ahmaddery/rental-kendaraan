<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Keranjang;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;
use App\Models\Feedback;
use Illuminate\Support\Facades\Cache;


class UtamaController extends Controller
{
    public function index()
    {
        $kendaraans = Cache::remember('random_kendaraans', now()->addMinutes(1), function () {
            return Kendaraan::inRandomOrder()->limit(6)->get();
        });
    
        $feedbacks = Feedback::with('user', 'kendaraan')->get()->map(function ($feedback) {
            $feedback->formatted_date = $feedback->created_at->format('d F Y'); // Format the date
            return $feedback;
        });
    
        if (Auth::check()) {
            $user_id = Auth::id();
            $keranjang = Keranjang::where('user_id', $user_id)->get();
        } else {
            $keranjang = null; // Jika pengguna tidak terautentikasi, keranjang akan null
        }
    
        return view('index', [
            'kendaraans' => $kendaraans,
            'feedbacks' => $feedbacks, // Pass feedbacks with formatted date to the view
            'keranjang' => $keranjang, // Pass keranjang data to the view
        ]);
    }
    
    

    public function show($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
    
        // Ambil pembayaran pengguna yang sesuai dengan kendaraan ini dan sudah settlement
        $payment = Payment::where('user_id', Auth::id())
            ->where('kendaraan_id', $id)
            ->where('transaction_status', 'settlement')
            ->first();
    
        // Ambil semua rating yang sesuai dengan kendaraan ini
        $ratings = Feedback::where('kendaraan_id', $id)->with('user')->get();
    
        // Periksa apakah pengguna sudah memberikan rating
        $userHasRated = Feedback::where('user_id', Auth::id())
            ->where('kendaraan_id', $id)
            ->exists();
    
        return view('detail', [
            'kendaraan' => $kendaraan,
            'payment' => $payment,
            'ratings' => $ratings,
            'userHasRated' => $userHasRated
        ]);
    }
    
    
    

    public function tambahKeranjang($id)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $keranjang = Keranjang::where('user_id', $user_id)->where('kendaraan_id', $id)->first();
    
            if (!$keranjang) {
                // Periksa apakah keranjang sudah memiliki kendaraan_id lainnya
                $keranjangLain = Keranjang::where('user_id', $user_id)->first();
                if ($keranjangLain) {
                    return redirect()->route('index')->with('error', 'Silakan selesaikan pesanan Anda atau hapus keranjang untuk memilih kendaraan lainnya.');
                } else {
                    Keranjang::create([
                        'user_id' => $user_id,
                        'kendaraan_id' => $id,
                        'quantity' => 1,
                    ]);
                    return redirect()->route('index')->with('success', 'Kendaraan berhasil ditambahkan ke keranjang.');
                }
            } else {
                $keranjang->quantity += 1;
                $keranjang->save();
                return redirect()->route('index')->with('success', 'Kuantitas kendaraan di keranjang berhasil ditingkatkan.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk menambahkan kendaraan ke keranjang.');
        }
    }
    

   // public function showKeranjang()
    //{
     //   if (Auth::check()) {
       //     $user_id = Auth::id();
      //      $keranjang = Keranjang::where('user_id', $user_id)->get();
     //       return view('keranjang', ['keranjang' => $keranjang]);
      //  } else {
       //     return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melihat keranjang.');
      //  }
   // }

    public function checkout()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $keranjang = Keranjang::where('user_id', $user_id)->get();
            
            // Inisialisasi konfigurasi Midtrans
            Config::$serverKey = 'SB-Mid-server-Sz3uHCan9L0Lv7TkT6S4gku2'; // Ganti dengan server key Anda
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;
    
            // Hitung total harga dari semua barang di keranjang
            $total_amount = 0;
            foreach ($keranjang as $item) {
                $total_amount += $item->quantity * $item->kendaraan->harga;
            }
    
            // Buat array item untuk transaksi
            $items = [];
            foreach ($keranjang as $item) {
                $items[] = [
                    'id' => $item->kendaraan->id,
                    'price' => $item->kendaraan->harga,
                    'quantity' => $item->quantity,
                    'name' => $item->kendaraan->nama,
                ];
            }
    
            // Ambil kendaraan_id dari entri di tabel keranjang
            $kendaraan_ids = $keranjang->pluck('kendaraan_id')->toArray();
    
            // Buat transaksi menggunakan Midtrans
            $transaction_params = [
                'transaction_details' => [
                    'order_id' => uniqid(),
                    'gross_amount' => $total_amount, // Total harga dari semua barang di keranjang
                ],
                'item_details' => $items,
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'callbacks' => [
                    'finish' => route('payment.redirect'),
                ],
            ];
    
            // Buat transaksi baru di Midtrans
            $snapToken = Snap::getSnapToken($transaction_params);
    
            // Buat entri pembayaran dalam tabel Payment
            $payment = Payment::create([
                'user_id' => $user_id,
                'kendaraan_id' => implode(',', $kendaraan_ids),
                'order_id' => $transaction_params['transaction_details']['order_id'],
                'purchase_date' => now(),
                'transaction_time' => null, // Akan diupdate setelah notifikasi diterima dari Midtrans
                'transaction_status' => 'pending', // Default status
                'transaction_id' => null, // Akan diupdate setelah notifikasi diterima dari Midtrans
                'status_message' => null, // Akan diupdate setelah notifikasi diterima dari Midtrans
                'status_code' => null, // Akan diupdate setelah notifikasi diterima dari Midtrans
                'signature_key' => null, // Akan diupdate setelah notifikasi diterima dari Midtrans
                'settlement_time' => null, // Akan diupdate setelah notifikasi diterima dari Midtrans
                'payment_type' => 'gopay', // Default payment type
                'gross_amount' => $total_amount,
                'fraud_status' => 'accept', // Default fraud status
                'currency' => 'IDR', // Default currency
                'merchant_id' => null, // Akan diupdate setelah notifikasi diterima dari Midtrans
            ]);
    
            // Redirect ke halaman pembayaran Midtrans dengan snapToken
            return view('checkout', ['snapToken' => $snapToken, 'payment' => $payment]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk checkout.');
        }
    }
    
    

    public function handleMidtransNotification(Request $request)    ///  untuk mengatur  transaksi apakah berhasil atau tidak
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = 'SB-Mid-server-Sz3uHCan9L0Lv7TkT6S4gku2'; // Ganti dengan server key Anda
        Config::$isProduction = false;
        Config::$is3ds = true;
    
        // Dapatkan notifikasi dari body permintaan
        $notification = new Notification();
    
        // Verifikasi tanda tangan notifikasi
        if ($this->isValidSignature($request)) {
            $transactionStatus = $notification->transaction_status;
            $orderId = $notification->order_id;
    
            // Log status dan order ID
            Log::info("Transaction status: $transactionStatus, Order ID: $orderId");
    
            // Cek apakah pembayaran sudah ada berdasarkan order_id
            $payment = Payment::where('order_id', $orderId)->first();
    
            if ($payment) {
                // Pembayaran sudah ada, update status dan detail lainnya
                $payment->update([
                    'transaction_time' => $notification->transaction_time,
                    'transaction_status' => $notification->transaction_status,
                    'transaction_id' => $notification->transaction_id,
                    'status_message' => $notification->status_message,
                    'status_code' => $notification->status_code,
                    'signature_key' => $notification->signature_key,
                    'settlement_time' => $notification->settlement_time,
                    'payment_type' => $notification->payment_type,
                    'gross_amount' => $notification->gross_amount,
                    'fraud_status' => $notification->fraud_status,
                    'currency' => $notification->currency,
                    'merchant_id' => $notification->merchant_id,
                ]);
    
                // Handle notifikasi berdasarkan status transaksi
                if ($transactionStatus == 'settlement') {
                    // Transaksi berhasil, hapus item dari keranjang
                    Log::info("Transaction is successful. Deleting cart items for user ID: " . $payment->user_id);
                    Keranjang::where('user_id', $payment->user_id)->delete();
                } elseif ($transactionStatus == 'capture') {
                    // Jika menggunakan 3DS dan transaksi berhasil
                    Log::info("Transaction is captured. Checking for 3DS.");
                    if ($notification->fraud_status == 'accept') {
                        Log::info("3DS is accepted. Deleting cart items for user ID: " . $payment->user_id);
                        Keranjang::where('user_id', $payment->user_id)->delete();
                    }
                } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                    // Transaksi dibatalkan, ditolak, atau kedaluwarsa
                    // Lakukan tindakan sesuai kebutuhan
                } elseif ($transactionStatus == 'pending') {
                    // Pembayaran tertunda
                    // Lakukan tindakan sesuai kebutuhan
                } elseif ($transactionStatus == 'refund') {
                    // Pembayaran dikembalikan
                    // Lakukan tindakan sesuai kebutuhan
                } else {
                    // Handle kasus lain
                }
            } else {
                // Pembayaran belum ada, buat entri baru
                $payment = Payment::create([
                    'user_id' => Auth::id(), // Assuming you can identify the user
                    'kendaraan_id' => null, // Set to appropriate kendaraan_id if available
                    'order_id' => $notification->order_id,
                    'purchase_date' => now(),
                    'transaction_time' => $notification->transaction_time,
                    'transaction_status' => $notification->transaction_status,
                    'transaction_id' => $notification->transaction_id,
                    'status_message' => $notification->status_message,
                    'status_code' => $notification->status_code,
                    'signature_key' => $notification->signature_key,
                    'settlement_time' => $notification->settlement_time,
                    'payment_type' => $notification->payment_type,
                    'gross_amount' => $notification->gross_amount,
                    'fraud_status' => $notification->fraud_status,
                    'currency' => $notification->currency,
                    'merchant_id' => $notification->merchant_id,
                ]);
    
                // Handle notifikasi berdasarkan status transaksi
                // Jika transaksi pending, Anda mungkin ingin memberi tahu pengguna atau melakukan tindakan lain.
            }
    
            // Beri respons dengan status OK ke Midtrans
            return response('OK', 200);
        } else {
            // Beri respons dengan status tidak terotorisasi jika tanda tangan tidak valid
            return response('Unauthenticated', 401);
        }
    }


public function handlePaymentRedirect(Request $request)
{
    $orderId = $request->input('order_id');
    $statusCode = $request->input('status_code');

    // Retrieve payment based on order_id
    $payment = Payment::where('order_id', $orderId)->first();

    if ($payment) {
        // Update the payment status if necessary
        if ($statusCode == '200' && $payment->transaction_status != 'settlement') {
            $payment->transaction_status = 'settlement';
            $payment->save();

            // Log successful payment
            Log::info("Payment successful for Order ID: $orderId");
        } else {
            // Handle other status codes if necessary
            Log::info("Payment redirect received with status code: $statusCode for Order ID: $orderId");
        }

        // Calculate duration
        $duration = 0;
        $kendaraanIds = explode(',', $payment->kendaraan_id);
        $kendaraans = \App\Models\Kendaraan::whereIn('id', $kendaraanIds)->get();
        foreach ($kendaraans as $kendaraan) {
            $duration += floor($payment->gross_amount / $kendaraan->harga);
        }

        // Check if vehicle has been taken
        $isVehicleTaken = // Implement logic to check if vehicle has been taken

        // Retrieve related transactions
        $user_id = $payment->user_id;
        $riwayatTransaksi = Payment::where('user_id', $user_id)->orderBy('purchase_date', 'desc')->get();

        // Pass payment, history, duration, and isVehicleTaken to the view
        return view('payment_success', [
            'payment' => $payment,
            'riwayatTransaksi' => $riwayatTransaksi,
            'duration' => $duration,
            'isVehicleTaken' => $isVehicleTaken
        ]);
    } else {
        // Handle case where payment is not found
        Log::error("Payment not found for Order ID: $orderId");
        return redirect()->route('index')->with('error', 'Pembayaran tidak ditemukan.');
    }
}

    
        private function isValidSignature(Request $request)
    {
        $serverKey = 'SB-Mid-server-Sz3uHCan9L0Lv7TkT6S4gku2'; // Ganti dengan server key Anda
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $grossAmount = $request->input('gross_amount');
        $inputSignature = $request->input('signature_key');
        $generatedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
    
        return $generatedSignature === $inputSignature;
    }

}

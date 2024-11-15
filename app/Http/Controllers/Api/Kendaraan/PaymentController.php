<?php

namespace App\Http\Controllers\Api\Kendaraan;

use App\Http\Controllers\Controller;
use App\Models\XenditPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\Keranjang;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    /**
     * Membuat invoice pembayaran melalui API Xendit.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createXenditPayment(Request $request)
    {
        // Validasi data request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'external_id' => 'required|string',
            'amount' => 'required|numeric',
            'payer_email' => 'required|email',
            'description' => 'required|string',
            'expiry_date' => 'required|date', // Tambahkan validasi untuk expiry_date
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        $secretKey = env('XENDIT_SECRET_KEY');
    
        try {
            // Ambil dan konversi expiry date
            $expiryDate = date('Y-m-d H:i:s', strtotime($request->input('expiry_date')));
    
            // Retrieve the quantity from the keranjang table based on user_id and kendaraan_id
            $keranjangItem = Keranjang::where('user_id', $request->user_id)
                ->where('kendaraan_id', $request->kendaraan_id)
                ->first();
    
            // If there's no item in the cart, return an error response
            if (!$keranjangItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'No cart item found for this user and vehicle.'
                ], 404);
            }
    
            // Get the quantity from keranjang
            $quantity = $keranjangItem->quantity;
    
            // Kirim permintaan ke API Xendit
            $response = Http::withBasicAuth($secretKey, '')
                ->post('https://api.xendit.co/v2/invoices', [
                    'external_id' => $request->external_id,
                    'amount' => $request->amount,
                    'payer_email' => $request->payer_email,
                    'description' => $request->description,
                    'expiry_date' => $expiryDate, // Sertakan expiry_date dalam permintaan
                ]);
    
            // Jika berhasil, simpan data ke database
            if ($response->successful()) {
                $xenditResponse = $response->json();
    
                // Buat record baru di tabel xendit_payments
                $xenditPayment = XenditPayment::create([
                    'user_id' => $request->user_id,
                    'kendaraan_id' => $request->kendaraan_id,
                    'external_id' => $xenditResponse['external_id'],
                    'merchant_name' => $xenditResponse['merchant_name'] ?? null,
                    'merchant_profile_picture_url' => $xenditResponse['merchant_profile_picture_url'] ?? null,
                    'amount' => $xenditResponse['amount'],
                    'payer_email' => $xenditResponse['payer_email'],
                    'description' => $xenditResponse['description'],
                    'expiry_date' => $expiryDate, // Simpan expiry_date
                    'invoice_url' => $xenditResponse['invoice_url'],
                    'status' => $xenditResponse['status'],
                    'currency' => $xenditResponse['currency'],
                    'quantity' => $quantity, // Simpan quantity
                ]);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Payment invoice created successfully',
                    'data' => $xenditPayment,
                    'invoice_url' => $xenditResponse['invoice_url']
                ], 201);
            }
    
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Xendit payment',
                'details' => $response->json()
            ], $response->status());
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    

    /**
     * Handle Xendit webhook callback
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleCallback(Request $request)
    {
        try {
            $callbackData = $request->all();
            
            // Verify the callback is from Xendit (you should implement proper verification)
            $payment = XenditPayment::where('external_id', $callbackData['external_id'])->first();
            
            if ($payment) {
                // Update payment status in database
                $payment->update([
                    'status' => $callbackData['status'],
                    'paid_amount' => $callbackData['paid_amount'] ?? null, // Gunakan null jika tidak ada
                    'bank_code' => $callbackData['bank_code'] ?? null,
                    'paid_at' => $callbackData['paid_at'] ? Carbon::parse($callbackData['paid_at']) : null, // Pastikan format waktu
                    'payment_channel' => $callbackData['payment_channel'] ?? null,
                    'payment_destination' => $callbackData['payment_destination'] ?? null,
                    'payment_id' => $callbackData['payment_id'] ?? null,
                    'is_high' => $callbackData['is_high'] ?? false // Atur default jika tidak ada
                ]);
    
                // If payment status is PAID, delete the user's cart items
                if ($callbackData['status'] === 'PAID') {
                    // Delete cart items for the user associated with this payment
                    \App\Models\Keranjang::where('user_id', $payment->user_id)->delete(); // Ensure user_id is available in your XenditPayment model
                }
    
                return response()->json([
                    'success' => true,
                    'message' => 'Payment status updated successfully'
                ]);
            }
    
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing callback',
                'error' => $e->getMessage()
            ], 500);
        }
    }
                /**
             * Menampilkan riwayat transaksi berdasarkan user_id
             *
             * @param int $user_id
             * @return \Illuminate\Http\JsonResponse
             */
            public function getTransactionHistory($user_id)
            {
                try {
                    // Ambil semua pembayaran yang terkait dengan user_id
                    $transactions = XenditPayment::where('user_id', $user_id)->get();

                    if ($transactions->isEmpty()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'No transactions found for this user.'
                        ], 404);
                    }

                    return response()->json([
                        'success' => true,
                        'data' => $transactions
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error retrieving transaction history',
                        'error' => $e->getMessage()
                    ], 500);
                }
            }
            /**
 * Menampilkan detail transaksi berdasarkan user_id dan external_id
 *
 * @param int $user_id
 * @param string $external_id
 * @return \Illuminate\Http\JsonResponse
 */
public function getTransactionByExternalId($user_id, $external_id)
{
    try {
        // Ambil transaksi yang sesuai dengan user_id dan external_id
        $transaction = XenditPayment::with('kendaraan')->where('user_id', $user_id)
            ->where('external_id', $external_id)
            ->first();

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        // Mengganti kendaraan_id dengan nama kendaraan
        $transactionData = $transaction->toArray();
        $transactionData['kendaraan'] = $transaction->kendaraan->nama ?? null; // Ganti kendaraan_id dengan nama

        // Hapus kendaraan_id dari respons
        unset($transactionData['kendaraan_id']);

        return response()->json([
            'success' => true,
            'data' => $transactionData
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error retrieving transaction detail',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function getPaymentStatus($user_id)
{
    try {
        // Find the latest payment status for the user
        $payment = XenditPayment::where('user_id', $user_id)->latest()->first();

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'No payment found for this user.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'status' => $payment->status, // Check if PAID or pending
            'amount' => $payment->amount,
            'externalid' => $payment->external_id,
            'userid' => $payment->user_id,
            'kendaraanid' => $payment->kendaraan_id,
            'bankcode' => $payment->bank_code,
            'quantity' => $payment->quantity // Include the quantity field
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error retrieving payment status',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
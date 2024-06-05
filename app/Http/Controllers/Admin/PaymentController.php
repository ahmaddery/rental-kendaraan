<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Method untuk menampilkan daftar pembayaran
    public function index(Request $request)
    {
        // Menentukan jumlah item yang ditampilkan per halaman, default adalah 10
        $perPage = $request->input('perPage', 10);
    
        // Mengambil data pembayaran dengan relasi user dan kendaraan dari model Payment
        $payments = Payment::with('user', 'kendaraan')->paginate($perPage);
        
        // Mengirim data pembayaran ke view
        return view('admin.payments.index', compact('payments'));
    }

    // Method untuk menampilkan detail pembayaran
    public function show($id)
    {
        // Mengambil data pembayaran dengan relasi user dan kendaraan berdasarkan id
        $payment = Payment::with('user', 'kendaraan')->findOrFail($id);
        
        // Mengirim data pembayaran ke view
        return view('admin.payments.show', compact('payment'));
    }
}

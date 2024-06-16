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
        $perPage = $request->input('perPage', 10);
        $query = Payment::with('user', 'kendaraan');
    
        // Proses pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('kendaraan', function($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                })->orWhere('order_id', 'like', '%' . $search . '%');
            });
        }
    
        $payments = $query->paginate($perPage);
    
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

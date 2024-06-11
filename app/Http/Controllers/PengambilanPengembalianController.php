<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengambilanPengembalian;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use App\Mail\PickUpReceipt;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Payment;

class PengambilanPengembalianController extends Controller
{   
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mendapatkan data pengambilan pengembalian berdasarkan ID pengguna yang sedang login
        $pengambilanPengembalian = PengambilanPengembalian::where('user_id', $userId)->get();

        // Mengirim data ke view
        return view('pengambilan_pengembalian.index', ['pengambilanPengembalian' => $pengambilanPengembalian]);
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|integer',
            'kendaraan_id' => 'required|integer',
            'tanggal_pengambilan' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'order_id' => 'required|unique:pengambilan_pengembalian,order_id',
        ]);
    
        // Retrieve payment details
        $payment = Payment::where('order_id', $request->order_id)->first();
    
        if (!$payment) {
            return back()->with('error', 'Payment details not found for the provided Order ID.');
        }
    
        // Buat entri baru dalam tabel pengambilan_pengembalian
        $pengambilanPengembalian = PengambilanPengembalian::create([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'order_id' => $request->order_id,
            'tanggal_pengambilan' => $request->tanggal_pengambilan,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'transaction_status' => $payment->transaction_status,
            'gross_amount' => $payment->gross_amount,
        ]);
    
        // Kirim email dengan lampiran PDF
        $user = User::find($request->user_id);
        Mail::to($user->email)->send(new PickUpReceipt(
            $user, 
            $pengambilanPengembalian, 
            $request->tanggal_pengambilan, 
            $request->tanggal_pengembalian
        ));
    
        return redirect()->route('index')->with('success', 'Data pengambilan pengembalian berhasil disimpan.');
    }
    public function checkOrderID($orderId)
    {
        // Periksa apakah order_id sudah ada dalam tabel pengambilan_pengembalian
        return PengambilanPengembalian::where('order_id', $orderId)->exists();
    }
}

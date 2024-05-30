<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengambilanPengembalian;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

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
            'order_id' => 'required|unique:pengambilan_pengembalian,order_id', // validasi agar order_id unik dalam tabel pengambilan_pengembalian
        ]);

        // Cek apakah order_id sudah ada dalam database
        if ($this->checkOrderID($request->order_id)) {
            // Jika sudah ada, kembalikan ke halaman sebelumnya dengan pesan error
            return back()->with('error', 'Order ID already exists in the database.');
        }

        // Buat entri baru dalam tabel pengambilan_pengembalian
        PengambilanPengembalian::create([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'order_id' => $request->order_id, // simpan order_id dari request
            'tanggal_pengambilan' => $request->tanggal_pengambilan,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        // Redirect ke halaman yang sesuai (misalnya, halaman sukses)
        return redirect()->route('index')->with('success', 'Data pengambilan pengembalian berhasil disimpan.');
    }

    public function checkOrderID($orderId)
    {
        // Periksa apakah order_id sudah ada dalam tabel pengambilan_pengembalian
        return PengambilanPengembalian::where('order_id', $orderId)->exists();
    }
}

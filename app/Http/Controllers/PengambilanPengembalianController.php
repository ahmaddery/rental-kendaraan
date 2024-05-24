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
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|integer',
            'kendaraan_id' => 'required|integer',
            'tanggal_pengambilan' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
        ]);

        // Buat entri baru dalam tabel pengambilan_pengembalian
        PengambilanPengembalian::create([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'tanggal_pengambilan' => $request->tanggal_pengambilan,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        // Redirect ke halaman yang sesuai (misalnya, halaman sukses)
        return redirect()->route('index')->with('success', 'Data pengambilan pengembalian berhasil disimpan.');
    }
}

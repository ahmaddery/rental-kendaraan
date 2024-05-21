<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class RiwayatTransaksiController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $riwayatTransaksi = Payment::where('user_id', $user_id)->orderBy('purchase_date', 'desc')->get();

            return view('riwayat_transaksi', ['riwayatTransaksi' => $riwayatTransaksi]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melihat riwayat transaksi.');
        }
    }
}

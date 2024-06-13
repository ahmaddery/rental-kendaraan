<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class RiwayatTransaksiController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $search = $request->input('search');
            $perPage = $request->input('per_page', 5); // Default to 5 if not set

            if ($search) {
                $riwayatTransaksi = Payment::where('user_id', $user_id)
                    ->where('order_id', 'LIKE', "%{$search}%")
                    ->orderBy('purchase_date', 'desc')
                    ->paginate($perPage);
            } else {
                $riwayatTransaksi = Payment::where('user_id', $user_id)
                    ->orderBy('purchase_date', 'desc')
                    ->paginate($perPage);
            }

            return view('riwayat_transaksi', ['riwayatTransaksi' => $riwayatTransaksi]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melihat riwayat transaksi.');
        }
    }
}

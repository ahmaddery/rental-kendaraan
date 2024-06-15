<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Feedback;

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

            // Prepare an array to hold feedback statuses
            $feedbackStatuses = [];

            foreach ($riwayatTransaksi as $transaksi) {
                $kendaraanIds = explode(',', $transaksi->kendaraan_id);
                foreach ($kendaraanIds as $kendaraanId) {
                    $feedback = Feedback::where('user_id', $user_id)->where('kendaraan_id', $kendaraanId)->first();
                    $feedbackStatuses[$transaksi->id][$kendaraanId] = $feedback ? 'exists' : 'not_exists';
                }
            }

            return view('riwayat_transaksi', [
                'riwayatTransaksi' => $riwayatTransaksi,
                'feedbackStatuses' => $feedbackStatuses,
            ]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melihat riwayat transaksi.');
        }
    }
}

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

        // Mendapatkan data payment dengan status settlement yang order_id belum ada di table pengambilan_pengembalian
        $unprocessedPayments = Payment::where('transaction_status', 'settlement')
            ->whereNotIn('order_id', $pengambilanPengembalian->pluck('order_id'))
            ->get();

        // Mengirim data ke view
        return view('pengambilan_pengembalian.index', [
            'pengambilanPengembalian' => $pengambilanPengembalian,
            'unprocessedPayments' => $unprocessedPayments,
        ]);
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






public function createComplete($orderId)
{
    // Retrieve the payment details
    $payment = Payment::where('order_id', $orderId)->first();

    // Retrieve the corresponding vehicle details
    $kendaraan = Kendaraan::find($payment->kendaraan_id);

    // Calculate the number of days based on Gross Amount divided by the price
    $days = floor($payment->gross_amount / $kendaraan->harga);

    // Add the calculated days to the current date to get the "tanggal_pengembalian"
    $tanggalPengembalian = Carbon::now()->addDays($days)->toDateString();

    // Pass the payment, vehicle, and calculated "tanggal_pengembalian" to the view
    return view('pengambilan_pengembalian.complete', [
        'payment' => $payment,
        'kendaraan' => $kendaraan,
        'days' => $days, // Pass the calculated days to the view
        'tanggalPengembalian' => $tanggalPengembalian,
    ]);
}
    

    public function storeComplete(Request $request)
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

        return redirect()->route('pengambilan_pengembalian.index')->with('success', 'Data pengambilan pengembalian berhasil disimpan.');
    }
}

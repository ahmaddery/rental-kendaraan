<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtamaController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::all();
        return view('index', ['kendaraans' => $kendaraans]);
    }

    public function show($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('detail', ['kendaraan' => $kendaraan]);
    }

    public function tambahKeranjang($id)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $keranjang = Keranjang::where('user_id', $user_id)->where('kendaraan_id', $id)->first();

            if (!$keranjang) {
                Keranjang::create([
                    'user_id' => $user_id,
                    'kendaraan_id' => $id,
                    'quantity' => 1,
                ]);
                return redirect()->route('index')->with('success', 'Kendaraan berhasil ditambahkan ke keranjang.');
            } else {
                return redirect()->route('index')->with('error', 'Kendaraan sudah ada di keranjang Anda.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk menambahkan kendaraan ke keranjang.');
        }
    }

    public function showKeranjang()
        {
            if (Auth::check()) {
                $user_id = Auth::id();
                $keranjang = Keranjang::where('user_id', $user_id)->get();
                return view('keranjang', ['keranjang' => $keranjang]);
            } else {
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melihat keranjang.');
            }
        }

}

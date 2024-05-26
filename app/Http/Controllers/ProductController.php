<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $keranjang = Keranjang::where('user_id', $user_id)->get();
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melihat keranjang.');
        }

        $kendaraans = Cache::remember('kendaraans', 60, function () {
            return Kendaraan::all();
        });

        return view('product', [
            'kendaraans' => $kendaraans,
            'keranjang' => $keranjang,
        ]);
    }
}

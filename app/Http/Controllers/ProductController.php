<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $kendaraans = Cache::remember('kendaraans', 60, function () {
            return Kendaraan::all();
        });
        return view('product', ['kendaraans' => $kendaraans]);
    }
}

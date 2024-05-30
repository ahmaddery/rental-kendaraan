<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengambilanPengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = PengambilanPengembalian::with(['user', 'kendaraan'])->get();
        return view('admin.pengambilan_pengembalian.index', compact('data'));
    }
}

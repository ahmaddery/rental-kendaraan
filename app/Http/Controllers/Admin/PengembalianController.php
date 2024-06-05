<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengambilanPengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            $notifications = PengambilanPengembalian::with(['user', 'kendaraan'])
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            return response()->json($notifications);
        }

        // Regular page load
        $data = PengambilanPengembalian::with(['user', 'kendaraan'])->get();
        return view('admin.pengambilan_pengembalian.index', compact('data'));
    }
}

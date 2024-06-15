<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengambilanPengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        // Default value for items per page
        $perPage = $request->input('per_page', 10);

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            $notifications = PengambilanPengembalian::with(['user', 'kendaraan'])
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            return response()->json($notifications);
        }

        // Regular page load with pagination
        $data = PengambilanPengembalian::with(['user', 'kendaraan'])
            ->paginate($perPage);

        return view('admin.pengambilan_pengembalian.index', compact('data'))
            ->with('perPage', $perPage);
    }
}

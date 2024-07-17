<?php
namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\PengambilanPengembalian;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $keranjang = Keranjang::where('user_id', $user_id)->get();
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melihat keranjang.');
        }
    
        $perPage = $request->input('per_page', 3); // Default items per page
        $search = $request->input('search');
    
        // Retrieve unavailable kendaraan ids
        $unavailableKendaraanIds = PengambilanPengembalian::whereDate('tanggal_pengambilan', '>=', now())
            ->pluck('kendaraan_id')
            ->toArray();
    
        $kendaraans = Cache::remember('kendaraans_' . $perPage . '_' . $request->page . '_' . $search, 60, function () use ($perPage, $search) {
            $query = Kendaraan::query();
    
            if ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhereHas('category', function($q) use ($search) {
                          $q->where('kendaraan', 'like', '%' . $search . '%');
                      });
            }
    
            return $query->paginate($perPage);
        });
    
        return view('product', [
            'kendaraans' => $kendaraans,
            'keranjang' => $keranjang,
            'unavailableKendaraanIds' => $unavailableKendaraanIds, // Pass unavailable kendaraan ids to view
        ]);
    }
}

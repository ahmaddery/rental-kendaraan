<?php

namespace App\Http\Controllers\Api\Kendaraan;

use App\Http\Controllers\Controller;
use App\Models\PengambilanPengembalian;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Menampilkan riwayat pengambilan dan pengembalian kendaraan berdasarkan user_id.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        // Memastikan user_id valid
        if (!is_numeric($user_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid user ID',
            ], 400);
        }

        // Mengambil data berdasarkan user_id
        $history = PengambilanPengembalian::where('user_id', $user_id)
            ->with(['kendaraan']) // Eager load kendaraan untuk mengurangi query
            ->get();

        // Mengembalikan response JSON
        if ($history->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No history found for this user.',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $history,
        ]);
    }
}
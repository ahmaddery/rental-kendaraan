<?php

namespace App\Http\Controllers\Api\Kendaraan;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Menampilkan semua data kendaraan
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Mengambil semua data kendaraan tanpa caching
        $kendaraan = Kendaraan::with(['brand', 'type', 'category'])->get();

        // Mengembalikan response JSON dengan data kendaraan
        return response()->json([
            'success' => true,
            'message' => 'Data kendaraan berhasil diambil',
            'data' => $kendaraan
        ], 200);
    }

    /**
     * Menampilkan data kendaraan berdasarkan ID
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Mengambil data kendaraan berdasarkan ID tanpa caching
        $kendaraan = Kendaraan::with(['brand', 'type', 'category'])->find($id);

        // Memeriksa apakah data kendaraan ditemukan
        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Data kendaraan tidak ditemukan'
            ], 404);
        }

        // Mengembalikan response JSON dengan data kendaraan
        return response()->json([
            'success' => true,
            'message' => 'Data kendaraan berhasil diambil',
            'data' => $kendaraan
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api\Kendaraan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengambilanPengembalian;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Validator;

class PengambilanPengembalianController extends Controller
{
    /**
     * Store a new pengambilan_pengembalian record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'order_id' => 'required|unique:pengambilan_pengembalian,order_id',
            'tanggal_pengambilan' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_pengambilan',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the pengambilan_pengembalian record
        $pengambilanPengembalian = PengambilanPengembalian::create([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'order_id' => $request->order_id,
            'tanggal_pengambilan' => $request->tanggal_pengambilan,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        // Return a response
        return response()->json([
            'message' => 'Data PengambilanPengembalian successfully created.',
            'data' => $pengambilanPengembalian,
        ], 201);
    }
}

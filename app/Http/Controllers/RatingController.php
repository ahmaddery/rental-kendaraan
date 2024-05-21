<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function create($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('rating.create', ['kendaraan' => $kendaraan]);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:255',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'kendaraan_id' => $id,
            'rating' => $request->input('rating'),
            'komentar' => $request->input('komentar'),
        ]);

        return redirect()->route('kendaraan.detail', ['id' => $id])->with('success', 'Rating dan komentar berhasil ditambahkan.');
    }
}

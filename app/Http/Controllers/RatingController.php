<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

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

    public function edit($id)
    {
        $feedback = Feedback::where('user_id', Auth::id())->where('kendaraan_id', $id)->firstOrFail();
        $kendaraan = Kendaraan::findOrFail($id);
        
        return view('rating.edit', ['kendaraan' => $kendaraan, 'feedback' => $feedback]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:255',
        ]);
    
        $feedback = Feedback::where('user_id', Auth::id())->where('kendaraan_id', $id)->firstOrFail();
    
        // Increment the total edited count in the session
        $editedCount = Session::get('edited_count_' . $id, 0);
        $editedCount++;
        Session::put('edited_count_' . $id, $editedCount);
    
        // Cache the total edited count
        Cache::forever('total_edited_count_' . $id, $editedCount);
    
        $feedback->update([
            'rating' => $request->input('rating'),
            'komentar' => $request->input('komentar'),
        ]);
    
        return redirect()->route('kendaraan.detail', ['id' => $id])->with('success', 'Rating dan komentar berhasil diperbarui. Edited: ' . $editedCount);
    }
}

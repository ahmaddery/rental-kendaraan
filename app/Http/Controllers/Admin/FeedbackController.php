<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::with(['user', 'kendaraan'])->get();
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show(Feedback $feedback)
    {
        return view('admin.feedbacks.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback deleted successfully.');
    }
}

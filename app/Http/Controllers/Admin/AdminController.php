<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Payment;
use App\Models\PengambilanPengembalian;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch the number of users
        $userCount = User::count();

        // Fetch the number of vehicles
        $vehicleCount = Kendaraan::count();

        // Fetch the number of payments
        $paymentCount = Payment::count();
        
        // Fetch the counts of payments with different statuses
        $settlementCount = Payment::where('transaction_status', 'settlement')->count();
        $cancelCount = Payment::where('transaction_status', 'cancel')->count();
        $pendingCount = Payment::where('transaction_status', 'pending')->count();

        // Fetch the count of PengambilanPengembalian
        $pengambilanCount = PengambilanPengembalian::count();

        // Fetch the two most recent PengambilanPengembalian records
        $recentPengambilanPengembalian = PengambilanPengembalian::orderBy('tanggal_pengambilan', 'desc')->take(2)->get();

        // Fetch the count of feedback for each rating
        $feedbackCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $feedbackCounts[$i] = Feedback::byRating($i)->count();
        }

        // Pass all counts and recent records to the view
        return view('admin.dashboard', compact('userCount', 'vehicleCount', 'paymentCount', 'settlementCount', 'cancelCount', 'pendingCount', 'pengambilanCount', 'recentPengambilanPengembalian', 'feedbackCounts'));
    }
}

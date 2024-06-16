<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() 
    { 
        if (Auth::check()) {
            $usertype = Auth::user()->userType;
            
            if ($usertype == 'user') {
                return redirect()->route('index'); // Redirect user to the index route
            } else if ($usertype == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back();
            }
        }
        
        return redirect()->route('login'); // Redirect to login if not authenticated
    }
}

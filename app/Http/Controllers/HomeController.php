<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    { 
      if(Auth::id())
      { 
        $usertype=Auth()->user()->userType;
    
        if($usertype=='user')
        {
           return view('dashboard');
        }
        else if($usertype=='admin')
        {
           return view('admin.index');
        }
        else
        {
          return redirect()->back();
        }
      }
    }
}

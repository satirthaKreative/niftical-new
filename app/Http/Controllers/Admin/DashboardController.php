<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Session;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('backend.layouts.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush(); 
        return redirect()->route('admin.new-login');
    }
}

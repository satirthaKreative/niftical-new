<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('frontend.layouts.index');
    }

    public function welcome(Request $request)
    {
        return view('welcome');
    }
}
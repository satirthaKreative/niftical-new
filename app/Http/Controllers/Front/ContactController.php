<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('frontend.pages.contact');
    }
}

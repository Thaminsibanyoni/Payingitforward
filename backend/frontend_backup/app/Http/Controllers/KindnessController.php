<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KindnessController extends Controller
{
    public function index()
    {
        return view('kindness');
    }
}

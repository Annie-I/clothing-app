<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
        return view('dashboard', [
            'user' => Auth::user()
        ]);
    }
}
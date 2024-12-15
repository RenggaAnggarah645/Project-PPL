<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;

class operatorcontroller extends Controller
{
    public function index()
    {
        return view('dashboard-operator');
    }
}

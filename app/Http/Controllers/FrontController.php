<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Console;

class FrontController extends Controller
{
    public function index()
    {
        $consoles = Console::all();

        return view('front', compact('consoles'));
    }
}

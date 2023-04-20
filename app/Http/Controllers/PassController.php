<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassController extends Controller
{
    public function cambiar()
    {
        return view('cambiar-password');
    }
}

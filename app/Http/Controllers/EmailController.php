<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function cambiar()
    {
        return view('cambiar-email');
    }
}

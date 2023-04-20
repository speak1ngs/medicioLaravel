<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmTempController extends Controller
{
    public function dashboard()
    {
        return view('adm-lte');
    }
}

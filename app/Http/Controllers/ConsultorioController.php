<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultorioController extends Controller
{

    public function agenda()
    {
        return view('reservas-consultorio-agenda');
    }
}

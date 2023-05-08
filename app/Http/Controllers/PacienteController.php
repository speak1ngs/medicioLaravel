<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function reservar()
    {
        return view('reservar');
    }

    public function registro()
    {
        return view('registro-inc');
    }

    public function reservados()
    {
        return view('turnos-reservados');
    }

}

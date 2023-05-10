<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmFuncController extends Controller
{
    
    // public function registro()
    // {
    //     // return view('registro-doctor');
    // }


    public function alta()
    {
        return view('alta-doctor');
    }

    public function calendario()
    {
        return view('calendario-doctor');
    }

    public function importe()
    {
        return view('importe-consulta');
    }

    public function edit()
    {
        return view('editar-importe');
    }

    public function historial()
    {
        return view('historial-citas');
    }

    public function reserva()
    {
        return view('reservar-admin');
    }

    public function altaReser()
    {
        return view('alta-reserva');
    }
}

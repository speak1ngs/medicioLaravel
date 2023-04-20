<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    
    public function agenda()
    {
        return view('reserva-doctor-agenda');
    }


}


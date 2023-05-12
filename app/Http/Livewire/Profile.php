<?php

namespace App\Http\Livewire;

use App\Models\barrios;
use App\Models\ciudades;
use App\Models\paciente;
use App\Models\paises;
use App\Models\persona;
use Livewire\Component;

class Profile extends Component
{   
    public $inputNombre,  $inputApellido , $inputCedula, $inputEdad, $inputNac , $inputTelf, $inputPhoto, $inputBarrio, $inputCiudad ,$inputPais;
    public $value = 'false';
    public $iden, $paciente;
    public $pais,$barrio, $ciudad;


    public function mount()
    {
        // ver que al hacer login ponga todos los datos en algun variable global el id para hacer el query disponer todos los datos de alguna manera
        $iden = persona::where('cedula','=', 12312)->get();
        $this->inputNombre = $iden[0]->nombre;
        $this->inputApellido = $iden[0]->apellido;
        $this->inputCedula = $iden[0]->cedula;
        $this->inputEdad = $iden[0]->edad;
        $this->inputNac = $iden[0]->fecha_nacimiento;
        $this->inputTelf = $iden[0]->telefono_particular;
        $this->inputPhoto = 'test.jpg';
        $this->inputBarrio = barrios::where('id', '=', $iden[0]->barrio_id)->get();
        $this->inputCiudad = ciudades::where('id', '=', $iden[0]->ciudad_id)->get();
        $this->inputPais = paises::where('id', '=', $iden[0]->pais_id)->get();

        $this->barrio  = barrios::all();
        $this->ciudad = ciudades::all();
        $this->pais = paises::all();

        $paciente = paciente::select('id')->where('persona_id', '=', $iden[0]->id)->get();
    }

    public function edit()
    {
        $this->reset(['value']);
    }

    public function render()
    {
        return view('livewire.profile');
    }
}

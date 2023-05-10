<?php

namespace App\Http\Livewire;

use App\Models\doctor;
use App\Models\especialidades;
use App\Models\persona;
use App\Models\User;
use Livewire\Component;

class RegistroDoctor extends Component
{
    public $inputNombre, $inputApellido , $inputCedula, $inputRegistro, $inputBarrio, $inputCiudad,
    $inputPais ,$inputFechNac, $inputFechaExpReg, $inputTelfLab, $inputEmail, $inputPass, $inputPhoto, $inputDescrip,$inputConsultorio;
    public $iden ,$paciente;
    public $especialidades;
    public $inputEspecial = [];
    public $manyStuff;
    public $tip_user = 2;  // 1 = doctor

    protected $rules = [
        'inputNombre' => 'required|string',
        'inputApellido' => 'required|string',
        'inputCedula' => 'required',
        'inputEmail' => 'required|email',
        'inputRegistro' => 'required',
        'inputPass' => 'required',
        'inputTelfLab' => 'required',
        ];
    
    public function mount(Especialidades $especialidades)
    {
        
        $this->especialidades = $especialidades::all();



    }

    public function guardar()
    {
        $this->validate();
        @dd($this->inputEspecial);
       
    }

    public function render()
    {
   
        return view('livewire.registro-doctor');
    }
}

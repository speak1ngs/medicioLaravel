<?php

namespace App\Http\Livewire;

use App\Models\barrios;
use App\Models\ciudades;
use App\Models\paciente;
use App\Models\paises;
use App\Models\persona;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Profile extends Component
{   
    public $inputNombre,  $inputApellido , $inputCedula, $inputEdad, $inputNac , $inputTelf, $inputPhoto, $inputBarrio, $inputCiudad ,$inputPais;
    public $value = 'false';
    public $iden, $paciente;
    public $ciudId, $ciudDescrip ;
    public $pais,$barrio, $ciudad;

    protected $rules = [
        'inputNombre' => 'required|string',
        'inputApellido' => 'required|string',
        'inputCedula' => 'required',
        'inputCiudad' => 'required',
        'inputTelf' => 'required',
     

    ];

    public function mount()
    {
        // ver que al hacer login ponga todos los datos en algun variable global el id para hacer el query disponer todos los datos de alguna manera
        $this->barrio  = barrios::all();
        $this->ciudad = ciudades::all();
        $this->pais = paises::all();



        $iden = persona::where('cedula','=', 12312)->get();
        $this->inputNombre = $iden[0]->nombre;
        $this->inputApellido = $iden[0]->apellido;
        $this->inputCedula = $iden[0]->cedula;
        $this->inputEdad = $iden[0]->edad;
        $this->inputNac = $iden[0]->fecha_nacimiento;
        $this->inputTelf = $iden[0]->telefono_particular;
        $this->inputPhoto = 'test.jpg';
        $this->inputBarrio =  $iden[0]->barrio_id;
        $this->inputCiudad =  $iden[0]->ciudad_id; 
        $this->inputPais =$iden[0]->pais_id;
        $this->id =$iden[0]->id;

    
       
    }

    public function edit()
    {
     
        $this->validate();
        $iden = persona::where('cedula','=', 12312)->get();
        
        DB::table('personas')
        ->where('id', $iden[0]->id)
        ->update(['nombre' => $this->inputNombre,
        'apellido' => $this->inputApellido,
        'cedula' => $this->inputCedula , 
        'fecha_nacimiento' => $this->inputNac ,
        'telefono_particular' => $this->inputTelf , 
        'edad' => $this->inputEdad,
        'ciudad_id' => $this->inputCiudad ,
        'pais_id' => $this->inputPais ,
        'barrio_id' => $this->inputBarrio]);
        if($this->inputPhoto){
            
            DB::table('pacientes')
            ->where('persona_id', $iden[0]->id)
            ->update(['foto_url', $this->inputPhoto]);
        }
    
    }

    public function render()
    {
        return view('livewire.profile');
    }
}

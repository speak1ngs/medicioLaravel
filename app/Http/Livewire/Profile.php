<?php

namespace App\Http\Livewire;

use App\Models\barrios;
use App\Models\ciudades;
use App\Models\paciente;
use App\Models\paises;
use App\Models\persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

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

    use WithFileUploads;

    public function mount()
    {
        // ver que al hacer login ponga todos los datos en algun variable global el id para hacer el query disponer todos los datos de alguna manera
        $this->barrio  = barrios::all();
        $this->ciudad = ciudades::all();
        $this->pais = paises::all();
       

      
        $iden = persona::where('id','=',Auth::user()->persona_id )->with('pacientes')->get();
        $this->inputNombre = $iden[0]->nombre;
        $this->inputApellido = $iden[0]->apellido;
        $this->inputCedula = $iden[0]->cedula;
        $this->inputEdad = $iden[0]->edad;
        $this->inputNac = $iden[0]->fecha_nacimiento;
        $this->inputTelf = $iden[0]->telefono_particular;
        $this->inputPhoto = $iden[0]['pacientes']['foto_url'];
        $this->inputBarrio =  $iden[0]->barrio_id;
        $this->inputCiudad =  $iden[0]->ciudad_id; 
        $this->inputPais =$iden[0]->pais_id;
        $this->id =$iden[0]->id;

    
       
    }
    public function upload() 
    {   
            $this->validate(
            ['inputPhoto' => 'image',]);
            
            return $this->inputPhoto->store('pacimg', 'public');
    }


    public function edit()
    {
     
    
        
        DB::table('personas')
        ->where('id',Auth::user()->persona_id)
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
            $image = $this->upload();

            DB::table('pacientes')
            ->where('persona_id',Auth::user()->persona_id)
            ->update(['foto_url', $image]);
        }
    
    }

    public function render()
    {   
        return view('livewire.profile');
    }
}

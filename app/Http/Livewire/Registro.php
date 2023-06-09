<?php

namespace App\Http\Livewire;

use App\Models\barrios;
use App\Models\ciudades;
use App\Models\paciente;
use App\Models\paises;
use App\Models\persona;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

use Livewire\Component;

class Registro extends Component
{
    public $inputNombre, $inputApellido , $inputCedula, $inputEmail, $inputPassword , $inputTelf, $inputEdad,$inputCiudad ,$inputBarrio, $inputPais, $inputNac ,$inputPhoto;
    public $iden ,$pacient;
    public $tip_user;  // 1 = paciente
    public $barrio ;
    public $ciudad ;
    public $pais;


    protected $rules = [
        'inputNombre' => 'required|string',
        'inputApellido' => 'required|string',
        'inputCedula' => 'required',
        'inputEmail' => 'required|email',
        'inputTelf' => 'required',
     

    ];
    // 'inputPassword' => 'required|min:8|max:256|regex:/^(?=.[a-z])(?=.[A-Z])(?=.*\d).+$/',

    // 'inputPhoto' => 'image|max:2048|mimes:jpeg,jpg'
    // 'inputPhoto' => 'required|image|max:2048|mime:jpg'
    
    public function mount()
    {
        $this->barrio  = barrios::all();
        $this->ciudad = ciudades::all();
        $this->pais = paises::all();

    }


    public function guardar()
    {
   
        $this->validate();

        persona::create(
            [
                'nombre' => $this->inputNombre, 
                'apellido' =>$this->inputApellido, 
                'cedula' => $this->inputCedula,
                'fecha_nacimiento' => $this->inputNac, 
                'telefono_particular' => $this->inputTelf, 
                'edad' => $this->inputEdad,
                'ciudad_id' => $this->inputCiudad,
                'pais_id' => $this->inputPais, 
                'barrio_id' => $this->inputBarrio
            ]
        );

      
        $iden = persona::select('id')->where('cedula','=', $this->inputCedula)->get();

       
        if($iden){
           
            paciente::create(
                [
                    'foto_url' => 'test',
                    'calificacion' =>  0,
                    'cantidad_consultas_reservadas' => 0,
                    'cantidad_consultas_canceladas' => 0,
                    'persona_id' => $iden[0]->id,
                    'stat_id' => 1
                ]
                );

        }
           $paciente = paciente::select('id')->where('persona_id', '=', $iden[0]->id)->get();
            $tip_user = 1;
           if( $paciente){

                User::create(
                    [
                        'email' => $this->inputEmail,
                        'password' => Hash::make($this->inputPassword),
                        'paciente_id' => $paciente[0]->id,
                        'doctor_id' => null,
                        'tipo_usaurio_id' => $tip_user  
                    ]
                    );

           }



        $this->reset(['inputNombre', 'inputApellido', 'inputCedula','inputEmail','inputPassword', 'inputTelf', 'inputEdad', 'inputAddress', 'inputAddress2', 'inputAdress3', 'inputCiudad','inputBarrio', 'inputPais','inputNac', 'inputPhoto']);
       
    }

    public function render()
    {
       

        return view('livewire.registro');
    }
}

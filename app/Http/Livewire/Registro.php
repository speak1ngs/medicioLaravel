<?php

namespace App\Http\Livewire;

use App\Models\paciente;
use App\Models\persona;
use App\Models\tipo_usuario;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Livewire\WithFileUploads;

use Livewire\Component;

class Registro extends Component
{
    public $inputNombre, $inputApellido , $inputCedula, $inputEmail, $inputPassword , $inputTelf, $inputEdad, $inputAddress, 
    $inputAddress2, $inputAddress3 ,$inputCiudad ,$inputBarrio, $inputPais, $inputNac ,$inputPhoto;
    public $iden ,$paciente;
    public $tip_user;  // 1 = paciente

    protected $rules = [
        'inputNombre' => 'required|text',
        'inputApellido' => 'required|text',
        'inputCedula' => 'required',
        'inputEmail' => 'required|email',
        'inputPassword' => 'required|min:8|mixedCase',
        'inputAddress' => 'required',
        'inputTelf' => 'required',
        'inputPhoto' => 'required|image|max:2048|mime:jpg'

    ];

    public function guardar()
    {
   
        // $this->validate();

        persona::create(
            [
                'nombre' => $this->inputNombre, 
                'apellido' =>$this->inputApellido, 
                'cedula' => $this->inputCedula,
                'fecha_nacimiento' => $this->inputNac, 
                'telefono_particular' => $this->inputTelf, 
                'edad' => $this->inputTelf,
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
                    'persona_id' => $iden,
                    'stat_id' => '0'
                ]
                );

        }
           $paciente = paciente::select('id')->where('persona_id', '=', $iden)->get();
            $tip_user = '1';
           if( $paciente){

                User::create(
                    [
                        'email' => $this->inputEmail,
                        'password' => $this->inputPassword,
                        'paciente_id' => $paciente,
                        'doctor_id' => '0',
                        'tipo_usaurio_id' => $tip_user  
                    ]
                    );

           }



        $this->reset(['inputNombre', 'inputApellido', 'inputCedula','inputEmail','inputPassword', 'inputTelf', 'inputEdad', 'inputAddress', 'inputAdress2', 'inputAdress3', 'inputCiudad','inputBarrio', 'inputPais','inputNac', 'inputPhoto']);
       
    }

    public function render()
    {
       

        return view('livewire.registro');
    }
}

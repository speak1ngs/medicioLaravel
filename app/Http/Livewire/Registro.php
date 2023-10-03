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
    public $iden ,$pacient, $idpho;
    public $tip_user;  // 1 = paciente
    public $barrio ;
    public $ciudad ;
    public $pais;
    public $statAlert ,$title, $text;


    use WithFileUploads;
    
    protected $rules = [
        'inputNombre' => 'required|string',
        'inputApellido' => 'required|string', 
        'inputCedula' => 'required',
        'inputEmail' => 'required|email',
        'inputTelf' => 'required',
        'inputPhoto' => 'required|image|max:2048|mime:jpg',
        'inputPassword' => 'required|min:8',
    ];

    
    public function alert()
    {

        $this->dispatchBrowserEvent('swal:modal', [

                'icon' => $this->statAlert,  
                'title' => $this->title,
                'text' => $this->text,
            ]);

    }


    public function upload() 
    {   
            $this->validate(
            ['inputPhoto' => 'image',]);
            
            return $this->inputPhoto->store('pacimg', 'public');
    }


    // 'inputPassword' => 'required|min:8|max:256|regex:/^(?=.[a-z])(?=.[A-Z])(?=.*\d).+$/',

    // 'inputPhoto' => 'image|max:2048|mimes:jpeg,jpg'
    // 'inputPhoto' => 'required|image|max:2048|mime:jpg'
    
    public function mount()
    {
        $this->idpho = rand();
        $this->barrio  = barrios::all();
        $this->ciudad = ciudades::all();
        $this->pais = paises::all();

    }


    public function guardar()
    {
   
        $this->validate();
        try {
            $val = persona::select('id')->where('cedula','=', $this->inputCedula)->get();
            dump($val);
            if(empty($val)){
                dump($val);
                    if( !isset($this->inputNombre) && !isset($this->inputApellido) && !isset($this->inputApellido) && !isset($this->inputCedula) &&
                    !isset($this->inputEmail) &&     !isset($this->inputTelf) && !isset($this->inputPhoto) && !isset($this->inputPassword) 
                    ){
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
                        $iden = persona::select('id')->where('cedula','=', $this->inputCedula)->where('nombre','=', $this->inputNombre)->get();
                
                        if($iden){
                            $image=$this->upload();
                            paciente::create(
                                [
                                    'foto_url' => $image,
                                    'calificacion' =>  0,
                                    'cantidad_consultas_reservadas' => 0,
                                    'cantidad_consultas_canceladas' => 0,
                                    'persona_id' => $iden[0]->id,
                                    'stat_id' => 1
                                ]
                                );
                
                        }
                            $paciente = paciente::select('id')->where('persona_id', '=', $iden[0]->id)->get();

                            if( $paciente){
                            $tip_user = 1;
                                User::create(
                                    [
                                        'email' => $this->inputEmail,
                                        'password' => Hash::make($this->inputPassword),
                                        'paciente_id' => $paciente[0]->id,
                                        'doctor_id' => null,
                                        'tipo_usuario_id' => $tip_user,
                                        'persona_id' => $iden[0]->id
                                    ]
                                    )->syncRoles(3);
                
                                    $this->idpho = rand();
                
                                    $this->reset(['inputNombre', 'inputApellido', 'inputCedula','inputEmail','inputPassword', 'inputTelf', 'inputEdad', 'inputAddress', 'inputAddress2', 'inputAdress3', 'inputCiudad','inputBarrio', 'inputPais','inputNac', 'inputPhoto']);
                            }
                            $this->statAlert = 'success';
                            $this->title = 'Registrado';
                            $this->text = 'Se registro exitosamente';
                    }
                    else{
                        $this->statAlert = 'error';
                        $this->title = 'Error';
                        $this->text = 'Debe completar el formulario';
                    }
            }
            else{
                $this->statAlert = 'error';
                $this->title = 'Error';
                $this->text = 'Ya se registro anteriormente';
            }
            } catch (\Throwable $th) {
                $this->statAlert = 'error';
                $this->title = 'Error';
                $this->text = 'No se pudo acceder a la base de datos';
            }
            
            $this->alert();
            redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.registro');
    }
}

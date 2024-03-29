<?php

namespace App\Http\Livewire;

use App\Models\barrios;
use App\Models\ciudades;
use App\Models\consultorio;
use App\Models\doctores;
use App\Models\especialidades;
use App\Models\paises;
use App\Models\persona;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpParser\Node\Stmt\ElseIf_;

class RegistroDoctor extends Component
{
    public $inputNombre, $inputApellido , $inputCedula, $inputRegistro, $inputBarrio, $inputCiudad, $inputEdad,
    $inputPais ,$inputFechNac, $inputFechaExpReg, $inputTelfLab, $inputEmail, $inputPass, $inputPhoto, $inputDescrip,$inputConsultorio;
    public $iden ,$paciente, $idpho;
    public $statAlert ,$title, $text;
    public $especialidades;
    public $barrio ;
    public $ciudad ;
    public $doctor;
    public $consul ;
    public $pais;
    public $inputEspecial = [];
    public $manyStuff;
    public $tip_user ;  // 1 = doctor


    use WithFileUploads;

    protected $rules = [
        'inputNombre' => 'required|string',
        'inputApellido' => 'required|string',
        'inputCedula' => 'required',
        'inputEmail' => 'required|email',
        'inputRegistro' => 'required',
        'inputPass' => 'required',
        'inputTelfLab' => 'required',
        'inputPhoto' => 'required|image|max:2048|mimes:jpeg,jpg,png'
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
            
            return $this->inputPhoto->store('doctimg', 'public');
    }

    public function mount(Especialidades $especialidades)
    {
        $this->idpho= rand();
        $this->barrio  = barrios::all();
        $this->ciudad = ciudades::all();
        $this->consul = consultorio::all();
        $this->pais = paises::all();
        $this->especialidades = $especialidades::all();
    }

    public function guardar()
    {
        $this->validate();
        try {

            $val = persona::select('id')->where('cedula','=', $this->inputCedula)->get();
           
            if(sizeof($val)<=0){
                    persona::create(
                        [
                            'nombre' => $this->inputNombre, 
                            'apellido' =>$this->inputApellido, 
                            'cedula' => $this->inputCedula,
                            'fecha_nacimiento' => $this->inputFechNac, 
                            'telefono_particular' => $this->inputTelfLab, 
                            'edad' => $this->inputEdad,
                            'ciudad_id' => $this->inputCiudad,
                            'pais_id' => $this->inputPais, 
                            'barrio_id' => $this->inputBarrio
                        ]
                    );
            
                    $iden = persona::select('id')->where('cedula','=', $this->inputCedula)->get();
            
                    if($iden){
            
            
                        $image=$this->upload();
                        
                        doctores::create(
                            [
                                'registro' => $this->inputRegistro,
                                'foto_url' => $image,
                                'telefono_laboral' => $this->inputTelfLab,
                                'registro_expericacion_fecha' => $this->inputFechaExpReg,
                                'descripcion' => $this->inputDescrip,
                                'calificacion' => 0,
                                'especialidades' => implode(",",$this->inputEspecial ),
                                'persona_id'=> $iden[0]->id,
                                'stat_id'=> 1
                            ]
                            );
            
                    }
            
                        $doctor = doctores::select('id')->where('persona_id', '=', $iden[0]->id)->get();
                    
                        if( $doctor){
                            $tip_user = 2;
                            User::create(
                                [
                                    'email' => $this->inputEmail,
                                    'password' => Hash::make($this->inputPass),
                                    'paciente_id' => null,
                                    'doctor_id' =>  $doctor[0]->id,
                                    'tipo_usuario_id' => $tip_user,
                                    'persona_id' =>  $iden[0]->id 
                                ]
                                )->syncRoles(2);
                        }
                        $this->statAlert = 'success';
                        $this->title = 'Exitoso';
                        $this->text = 'Se registro al profesional';
                    }
                    else{
                        $test =doctores::select('id')->where('persona_id', '=', $val[0]->id)->get();
                      
                        if(sizeof($test)>=1){
                            $this->statAlert = 'error';
                            $this->title = 'Error';
                            $this->text = 'El profesional ya esta registrado';
                        }
                        else{
                          
                            $iden = persona::select('id')->where('cedula','=', $this->inputCedula)->get();
                    
                            if($iden){
                    
                    
                                $image=$this->upload();
                                
                                doctores::create(
                                    [
                                        'registro' => $this->inputRegistro,
                                        'foto_url' => $image,
                                        'telefono_laboral' => $this->inputTelfLab,
                                        'registro_expericacion_fecha' => $this->inputFechaExpReg,
                                        'descripcion' => $this->inputDescrip,
                                        'calificacion' => 0,
                                        'especialidades' => implode(",",$this->inputEspecial ),
                                        'persona_id'=> $iden[0]->id,
                                        'stat_id'=> 1
                                    ]
                                    );
                    
                            }
                    
                                $doctor = doctores::select('id')->where('persona_id', '=', $iden[0]->id)->get();
                            
                                if( $doctor){
                                    $tip_user = 2;
                                    User::create(
                                        [
                                            'email' => $this->inputEmail,
                                            'password' => Hash::make($this->inputPass),
                                            'paciente_id' => null,
                                            'doctor_id' =>  $doctor[0]->id,
                                            'tipo_usuario_id' => $tip_user,
                                            'persona_id' =>  $iden[0]->id 
                                        ]
                                        )->syncRoles(2);
                                }
                                $this->statAlert = 'success';
                                $this->title = 'Exitoso';
                                $this->text = 'Se registro al profesional';
                        }
                    }
        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
        }
       

        $this->reset([
           'inputNombre','inputApellido' , 'inputCedula', 'inputRegistro', 'inputBarrio', 'inputCiudad', 'inputEdad',
            'inputPais' ,'inputFechNac', 'inputFechaExpReg', 'inputTelfLab', 'inputEmail', 'inputPass', 'inputPhoto', 'inputDescrip','inputConsultorio', 'inputEspecial'
        ]);
        $this->alert();
        $this->idpho = rand();

    }

    public function render()
    {
        return view('livewire.registro-doctor');
    }
}

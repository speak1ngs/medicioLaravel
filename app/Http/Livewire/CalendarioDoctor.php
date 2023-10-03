<?php

namespace App\Http\Livewire;


use App\Models\calendarios_doctores;
use App\Models\consultorio;
use App\Models\especialidades;
use App\Models\paciente;
use App\Models\persona;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CalendarioDoctor extends Component
{
    use WithPagination;
    public $especialidades, $consultorios;
    public $statAlert ,$title, $text;
    public $open_asign = false;
    public $dat ;
    public $inputEspecialidades, $inputCedula ;
    public $can;
    public $inputDias = [];
    public $inputMes = [];
    public $arryDay = [];
    public $arryMonth = [];
    public $nom, $docid;
    public $inputYear;
    public $control;
    public $diasFijos;
    public $mesesFijos;
    public $inputConsultorios, $inputTimeStart, $inputEspecialidad,    $inputTimeEnd, $inputImporte;
    
    public function esBisiesto($anio=null) {
        return date('L',($anio==null) ? time(): strtotime($anio.'-01-01'));
    }

    public function alert()
    {

        $this->dispatchBrowserEvent('swal:modal', [

                'icon' => $this->statAlert,  
                'title' => $this->title,
                'text' => $this->text,
            ]);

    }

    public function mount()
    {   
        $this->inputYear = date("Y");
        $this->arryDay= [ [ "id"=> 1 , "day" => 'Lunes'],[  "id"=> 2, "day" => 'Martes'] ,  ["id"=> 3, "day" => 'Miercoles'],[ "id"=> 4, "day" => 'Jueves'] ,["id"=> 5, "day" => 'Viernes'], ["id"=> 6, "day" => 'Sabado'],["id"=> 7, "day" => 'Domingo' ]];
        $this->arryMonth= [ 
            ["id"=> 1 , "month" => 'Enero', "limit" => '31' ],
            ["id"=> 2, "month" => 'Febrero',"limit" =>  (bool)$this->esBisiesto($this->inputYear) ? '29' : '28 '],
            ["id"=> 3, "month" => 'Marzo', "limit" =>  '31'],
            ["id"=> 4, "month" => 'Abril', "limit" =>'30' ],
            ["id"=> 5, "month" => 'Mayo', "limit" =>'31'], 
            ["id"=> 6, "month" => 'Junio', "limit" =>'30'],
            ["id"=> 7, "month" => 'Julio', "limit" => '31' ],
            ["id"=> 8, "month" => 'Agosto', "limit" => '31'],
            ["id"=> 9, "month" => 'Setiembre',"limit" => '30'] ,
            ["id"=> 10, "month" => 'Octubre',"limit" => '31'], 
            ["id"=> 11, "month" => 'Noviembre',"limit" => '30'],
            ["id"=> 12, "month" => 'Diciembre',"limit" => '31']
            ];
        
        
        $this->can = 10;
        $this->consultorios = consultorio::all();
        $this->especialidades = especialidades::all();
        $this->control ='#asigTime';
    }

    public function asig($data)
    {   
        $dat = db::table('personas')->join('doctores', 'personas.id','=', 'doctores.persona_id')->select('doctores.id as id', 'personas.nombre as nomb', 'personas.apellido as apell')->where('personas.cedula', '=', $data)->get();
        $this->nom =$dat[0]->nomb . ' ' . $dat[0]->apell;
        $this->docid = $dat[0]->id;
        $this->open_asign = true;
        // $this->valTest = db::table('calendarios_doctores')->where('calendarios_doctores.doctores_id','=',  $this->docid)->get()->toArray();

    }

    public function closeModalAsign()
    {
        $this->reset([     
            'inputTimeStart',
            'inputTimeEnd',
            'inputImporte',
            'inputDias',
            'inputMes',
            'nom',
            'docid',
            'inputConsultorios', 
            'inputEspecialidad',
            'open_asign'
        ]);
    }

    public function asignCalendar()
    {
        $val = db::table('calendarios_doctores')->where('calendarios_doctores.doctores_id','=',  $this->docid)->get()->toArray();
        
    try {
        if(!empty($this->inputMes) && !empty($this->inputDias) && !empty($this->inputTimeStart) && !empty($this->inputTimeEnd) ){


            foreach($this->inputMes as $key1 => $mesval){
                foreach($this->inputDias as $key2 => $diaval){
                    $val = db::table('calendarios_doctores')
                            ->where('calendarios_doctores.doctores_id','=',  $this->docid)
                            ->where( 'calendarios_doctores.meses' ,'LIKE', '%' . $mesval . '%')
                            ->where( 'calendarios_doctores.dias' ,'LIKE', '%' . $diaval . '%')
                            ->where('calendarios_doctores.horario_inicio','=',  $this->inputTimeStart)
                            ->where('calendarios_doctores.horario_fin','=',  $this->inputTimeEnd)
                            ->get()->toArray();
                            if(!empty($val)){
                                unset($this->inputMes[$key1]);
                            }
                }
            }


            if(!empty($this->inputMes) && !empty($this->inputDias)){
                
                calendarios_doctores::create(
                    [
                        'horario_inicio' => $this->inputTimeStart,
                        'horario_fin' => $this->inputTimeEnd,
                        'costo_consulta' => $this->inputImporte,
                        'dias' => implode(",",$this->inputDias),
                        'meses' => implode(",",$this->inputMes),
                        'doctores_id' => $this->docid,
                        'consultorios_id' => $this->inputConsultorios,
                        'especialidades_id' => $this->inputEspecialidad
                    ]
                );
                $this->statAlert = 'success';
                $this->title = 'Exitoso';
                $this->text = 'Se asigno el calendario al Doctor';

            }
            else{
                $this->statAlert = 'error';
                $this->title = 'El Doctor ya tiene esos horarios ocupados';
                $this->text = 'Verificar horarios disponibles';

            }
   
            }
            else{
                $this->statAlert = 'error';
                $this->title = 'Error';
                $this->text = 'Debe introducir todos los campos';

            }



    } catch (\Throwable $th) {
        $this->statAlert = 'error';
        $this->title = 'Error';
        $this->text = 'No se pudo acceder a la base de datos';
    }

    $this->alert();
        $this->reset([     
        'inputTimeStart',
        'inputTimeEnd',
        'inputImporte',
        'inputDias',
        'inputMes',
        'dat',
        'inputConsultorios',
        'inputEspecialidad'
    ]);
    }


    public function render()
    {

        $do = DB::table('personas')
        ->join('doctores', 'personas.id','=', 'doctores.persona_id')
        ->where('doctores.stat_id','=',2)
        ->where('personas.cedula',  'like', '%' . $this->inputCedula . '%')
        ->where('doctores.especialidades', 'like', '%'. $this->inputEspecialidades . '%')
        ->paginate($this->can);

        return view('livewire.calendario-doctor', compact('do'));
    }
}

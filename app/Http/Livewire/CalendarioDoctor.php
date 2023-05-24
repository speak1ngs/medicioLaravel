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
    public $open_asign = false;
    public $dat ;
    public $inputEspecialidades, $inputCedula ;
    public $can;
    public $inputDias = [];
    public $arryDay = [];
    public $nom, $docid;
    public $control;
    public $inputConsultorios, $inputTimeStart, $inputEspecialidad,    $inputTimeEnd, $inputImporte;
    

    public function mount()
    {   
        $this->arryDay= [ [ "id"=> 1 , "day" => 'Lunes'],[  "id"=> 2, "day" => 'Martes'] ,  ["id"=> 3, "day" => 'Miercoles'],[ "id"=> 4, "day" => 'Jueves'] ,["id"=> 5, "day" => 'Viernes'], ["id"=> 6, "day" => 'Sabado'],["id"=> 7, "day" => 'Domingo' ]];
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
    }

    public function closeModalAsign()
    {
        $this->reset([     
            'inputTimeStart',
            'inputTimeEnd',
            'inputImporte',
            'inputDias',
            'nom',
            'docid',
            'inputConsultorios', 
            'inputEspecialidad',
            'open_asign'
        ]);
    }

    public function asignCalendar()
    {
     
      try {
        calendarios_doctores::create(
            [
                'horario_inicio' => $this->inputTimeStart,
                'horario_fin' => $this->inputTimeEnd,
                'costo_consulta' => $this->inputImporte,
                'dias' => implode(",",$this->inputDias),
                'doctores_id' => $this->docid,
                'consultorios_id' => $this->inputConsultorios,
                'especialidades_id' => $this->inputEspecialidad
            ]
        );

      } catch (\Throwable $th) {
        $this->control ='#asigTimeFail';
      }

        $this->reset([     
        'inputTimeStart',
        'inputTimeEnd',
        'inputImporte',
        'inputDias',
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

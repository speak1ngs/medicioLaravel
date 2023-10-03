<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DoctorAgenda extends Component
{
    public $inputRating , $inputComent;
    public $nom, $ide, $control, $val, $buttonState ,$statPaciente, $idpacen;
    public $cant = 10;
    public $stat = 1;
    public $arryDay = [];
    use WithPagination;

    public function getLimit( $mes )
    {
        // calculamos el rango de un mes
        //retorna el limite segun nombre del mes que le pasemos
        return  intval($this->arryDay[array_search( $mes, array_column($this->arryDay, 'id'))]['limit']);
    }

    public function esBisiesto($anio=null) {
        return date('L',($anio==null) ? time(): strtotime($anio.'-01-01'));
    }

    public function mount() 
    {
        $this->arryDay= [ 
            ["id"=> 1 , "month" => 'Enero', "limit" => '31' ],
            ["id"=> 2, "month" => 'Febrero',"limit" =>  (bool)$this->esBisiesto(date("Y")) ? '29' : '28 '],
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
        $this->control = "successComent";
        $this->statPaciente= "presente";
        $this->cant= 10;
        $this->stat = 1 ;
    }

    public function instanData($iden, $nomb, $idpac) 
    {   
        $this->reset(['ide','nom','idpacen']);
        $this->ide = $iden;
        $this->nom = $nomb;
        $this->idpacen = $idpac;
        $this->val = db::table('citas')->where('id','=',$this->ide)->get('calificacion_status_id');
        if($this->val[0]->calificacion_status_id !=2 ){
            $this->control = "failComment";
        }

    }

    public function ausente($iden, $nomb) 
    {   
        $this->reset(['ide','nom']);
        $this->ide = $iden;
        $this->nom = $nomb;
        $this->stat = 1 ;
        $this->statPaciente= "ausente";
    }

    public function presente($iden, $nomb) 
    {
        $this->reset(['ide','nom']);
        $this->ide = $iden;
        $this->nom = $nomb;
        $this->stat = 2 ;
        $this->statPaciente= "presente";
    }

    public function setStatDate() 
    {
        try {
            db::table('citas')->where('id','=',$this->ide)->update([
                'paciente_status_id' => $this->stat
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function calificar()
    {   
        
        try {
            if($this->control === "successComent" ){
            
                db::table('citas')->where('id','=',$this->ide)->update([
                'descripcion_doctor' => $this->inputComent,
                'cal_doc_id' => $this->inputRating,
                'calificacion_status_id' => 1
            ]);
                $this->control = "successComent";
                session()->flash('message', 'Se califico al paciente.');    
            }
            else{
            $this->reset(['inputRating','inputComent']);
                session()->flash('message', 'Ya se califico al paciente.');    
            }

        } catch (\Throwable $th) {
            //throw $th;
            $this->control = "failComment";
            session()->flash('message', 'Fallo la conexion a la db.');
        }
    
 
    }

    public function render()
    {
        // agregar id del doctor a nivel global
     
       
        $limit = $this->getLimit(date("m"));
        $date = date_create(strval(date('Y') . '-' . date('n')  . '-' .  $limit));
        $dateFilter = date_format($date, 'Y-m-d');
        $db= DB::table('citas')
        ->join('calendarios_detalles', 'citas.calendarios_deta_id','=','calendarios_detalles.id')
        ->join('calendarios_doctores','calendarios_detalles.calendarios_doctores_id','=','calendarios_doctores.id')
        ->join('doctores','calendarios_doctores.doctores_id','=','doctores.id')
        ->join('consultorios','calendarios_doctores.consultorios_id','=','consultorios.id')
        ->join('pacientes','citas.paciente_id','=','pacientes.id')
        ->join('personas','pacientes.persona_id','=', 'personas.id')
        ->join('citas_status','citas.status_id','=','citas_status.id')
        ->select('citas.id',DB::raw('(SELECT CONCAT(personas.nombre," ", personas.apellido) FROM personas where personas.id = pacientes.persona_id ) as nombres'),'calendarios_detalles.dias_laborales', 'calendarios_detalles.horarios', 'citas_status.descripcion', 
                'consultorios.nombre as consul_nomb', 'doctores.id as iddoc', 'citas.paciente_id as idpac'
                )
        ->where('citas_status.id','=',1)
        ->where('calendarios_detalles.dias_laborales', '<', $dateFilter)
        ->where('citas.paciente_status_id','=',3)
        ->where('doctores.id','=', 1)
        ->paginate($this->cant);

        return view('livewire.doctor-agenda', compact('db'));
    }
}

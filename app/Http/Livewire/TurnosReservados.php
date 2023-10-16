<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\View\Components\Form\Select;
use Livewire\Component;
use Livewire\WithPagination;

class TurnosReservados extends Component
{
    public $inputRating , $inputComent;
    public $nom, $ide, $control, $val, $buttonState ,$statPaciente, $idpacen;
    public $cant = 10;
    public $stat = 1;
    public $statAlert ,$title, $text;
    public $datTemp = [];
    public $arryDay = [];
    public $dateFilter, $dateStart, $today,$hour;

    use WithPagination;

    protected $listeners = ['render'];
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
        date_default_timezone_set('America/Asuncion');
        $this->hour= date("h:i:s");

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
            $limit = $this->getLimit(date("m"));
            $date = date_create(strval(date('Y') . '-' . date('n')  . '-' .  $limit));
            $this->dateFilter = date_format($date, 'Y-m-d');
            $this->dateStart = date_format(date_create(strval(date('Y') . '-' . date('n')  . '-' .'01')), 'Y-m-d');
            $this->today =date_format(date_create(strval(date('Y') . '-' . date('n')  . '-' . date('d'))), 'Y-m-d');
        $this->control = "successComent";
        $this->statPaciente= "presente";
        $this->cant= 10;
        $this->stat = 1 ;
    }
    
    public function alert()
    {

        $this->dispatchBrowserEvent('swal:modal', [

                'icon' => $this->statAlert,  
                'title' => $this->title,
                'text' => $this->text,
            ]);

    }

    public function instanData($iden, $nomb, $idpac) 
    {   
        $this->reset(['ide','nom','idpacen']);
        $this->ide = $iden;
        $this->nom = $nomb;
        $this->idpacen = $idpac;
        $this->val = db::table('citas')->where('id','=',$this->ide)->get('cal_pac_id');
        if( !empty($this->val[0]->cal_pac_id) ){
            $this->control = "failComment";
        }

    }
    public function changeStateEnd($idf){
        try {
            db::table('citas')->where('id','=', $idf)->update([
                'status_id' => 5
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        $this->emitSelf('render');
    }

    public function calificar()
    {   
        
        try {
            if($this->control === "successComent" ){
                if(!empty($this->inputComent) && !empty($this->inputRating)){
                    db::table('citas')->where('id','=',$this->ide)->update([
                        'descripcion_paciente' => $this->inputComent,
                        'cal_pac_id' => $this->inputRating
                        
                    ]);
                
                     
                        $this->statAlert = 'success';
                        $this->title = 'Exitoso';
                        $this->text = 'Se califico al doctor.';  
                        $this->reset(['inputRating','inputComent','control']);
                }
                else{
                    $this->reset(['inputRating','inputComent','control']);
                    $this->statAlert = 'error';
                    $this->title = 'Error';
                    $this->text = 'Debe dejar un comentario y una puntuación';
                }
          
            }
            else{
                $this->reset(['inputRating','inputComent','control']);
                $this->statAlert = 'error';
                $this->title = 'Error';
                $this->text = 'Ya se califico al doctor';
            }

        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
            $this->reset(['inputRating','inputComent','control']);
        }
        $this->alert();
 
    }

    public function closeModalAsign()
    {

        $this->emitSelf('turnos-reservados');
        $this->reset(['datTemp']);
        
    }


    public function sendData( $data ) 
    {
        // $this->reset(['datTemp']);
        array_push($this->datTemp, json_decode( $data,true));
    }

    public function render()
    {

        $limit = $this->getLimit(date("m"));
        $date = date_create(strval(date('Y') . '-' . date('n')  . '-' .  $limit));
        $dateFilter = date_format($date, 'Y-m-d');
               // agregar id del paciente a nivel global
            // $db= DB::table('citas')
            // ->join('calendarios_detalles', 'citas.calendarios_deta_id','=','calendarios_detalles.id')
            // ->join('calendarios_doctores','calendarios_detalles.calendarios_doctores_id','=','calendarios_doctores.id')
            // ->join('doctores','calendarios_doctores.doctores_id','=','doctores.id')
            // ->join('consultorios','calendarios_doctores.consultorios_id','=','consultorios.id')
            // ->join('pacientes','citas.paciente_id','=','pacientes.id')
            // ->join('personas','pacientes.persona_id','=', 'personas.id')
            // ->join('citas_status','citas.status_id','=','citas_status.id')
            // ->select('citas.id',DB::raw('(SELECT CONCAT(personas.nombre," ", personas.apellido) FROM personas where personas.id = doctores.persona_id )  as nombres, (select especialidades.descripcion from especialidades where especialidades.id = calendarios_doctores.especialidades_id) as especialidad' ),
            //         'calendarios_detalles.dias_laborales', 'calendarios_detalles.horarios', 'citas_status.descripcion', 
            //         'doctores.id as iddoc', 'citas.paciente_id as idpac',  db::raw('(SELECT concat(personas.nombre," ", personas.apellido ) from personas where personas.id = doctores.persona_id) as doctor'),
            //         'consultorios.nombre as consul_nomb',
            //         'consultorios.telefono as consult_telf', db::raw('(SELECT ciudades.descripcion from ciudades WHERE ciudades.id = consultorios.ciudad_id) as ciudad'),
            //         'consultorios.map as ubi'
            //         )
            // ->where('citas_status.id','=',1)
            // ->where('calendarios_detalles.dias_laborales', '<', $dateFilter)
            // ->where('citas.paciente_status_id','=',3)
            // ->where('citas.paciente_id','=', Auth::user()->paciente_id)
            // ->paginate($this->cant);


            $db= DB::table('citas')
            ->join('calendarios_detalles', 'citas.calendarios_deta_id','=','calendarios_detalles.id')
            ->join('calendarios_doctores','calendarios_detalles.calendarios_doctores_id','=','calendarios_doctores.id')
            ->join('doctores','calendarios_doctores.doctores_id','=','doctores.id')
            ->join('consultorios','calendarios_doctores.consultorios_id','=','consultorios.id')
            ->join('pacientes','citas.paciente_id','=','pacientes.id')
            ->join('personas','pacientes.persona_id','=', 'personas.id')
            ->join('citas_status','citas.status_id','=','citas_status.id')
            ->select('citas.id',DB::raw('(SELECT CONCAT(personas.nombre," ", personas.apellido) FROM personas where personas.id = doctores.persona_id )  as nombres, (select especialidades.descripcion from especialidades where especialidades.id = calendarios_doctores.especialidades_id) as especialidad' ),
                    'calendarios_detalles.dias_laborales', 'calendarios_detalles.horarios', 'citas_status.descripcion','citas_status.id as idcit','citas.cal_pac_id as calId',
                    'doctores.id as iddoc', 'citas.paciente_id as idpac',  db::raw('(SELECT concat(personas.nombre," ", personas.apellido ) from personas where personas.id = doctores.persona_id) as doctor'),
                    'consultorios.nombre as consul_nomb',
                    'consultorios.telefono as consult_telf', db::raw('(SELECT ciudades.descripcion from ciudades WHERE ciudades.id = consultorios.ciudad_id) as ciudad'),
                    'consultorios.map as ubi'
                    )
            // ->where('citas_status.id','=',1)
            ->where('citas.paciente_id','=', Auth::user()->paciente_id)
            ->paginate($this->cant);


        return view('livewire.turnos-reservados',compact('db'));
    }
}

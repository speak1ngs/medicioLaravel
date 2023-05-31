<?php

namespace App\Http\Livewire;

use App\Models\calendarios_doctores;
use App\Models\consultorio;
use App\Models\especialidades;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithPagination;

class Reservar extends Component
{
    use WithPagination;
    public $especialidades, $inputEspecialidades, $inputNombre, $inputFech, $inputYear, $inputMes, $inputDias;
    public $can, $nom , $calenShow, $horasToInt , $horasToIntFin, $intervalo, $apell , $descrip;
    public $open_calendar;
    public $timeDoc = [];
    public $arryDay;
    public $anho = [];
    public $tst;
    public $ced, $dias ,$day;
    public $datTrans;
    public $monCod ;
    public $yeaCod;
    public $open_day;
    public $open_hour;
    public $diasDisp = [];
    public $inputDayse;

    public $test ;

     public function esBisiesto($anio=null) {
        return date('L',($anio==null) ? time(): strtotime($anio.'-01-01'));
    }

    public function mount()
    {
        $this->can = 10;
        $this->open_calendar = false;
        $this->especialidades = especialidades::all();

        $this->open_day = false;
        $this->open_hour = false;
        $this->inputMes =date('n');
        $this->inputYear = date("Y");
        $anioLimit = 2119;
        for( $i = $this->inputYear; $i <= $anioLimit ; $i++ ){    
            array_push($this->anho, $i);

        }      
        
        $this->arryDay= [ 
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
        $this->day= array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $this->calenShow = [];
       
    }

    
    public function asig($data)
    {   
        $this->ced = $data;
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
      
        $espId = db::table('especialidades')->select('id')->where('especialidades.descripcion', '=', $this->inputEspecialidades)->get();  
        $dat = db::table(db::raw('personas'))
        ->join('doctores', 'personas.id','=', 'doctores.persona_id')
        ->select('personas.id as idp','doctores.id as id', 'personas.nombre as nomb', 'personas.apellido as apell', 'doctores.descripcion as descripcion')
        ->where('personas.cedula', '=', $data)->get();
        // $this->nom =$dat[0]->nomb . ' ' . $dat[0]->apell;
        if(empty($this->inputEspecialidades)){
        $calen = DB::table(db::raw('personas'))
                ->join('doctores', 'personas.id', '=','doctores.persona_id')
                ->join('calendarios_doctores', 'doctores.id', '=','calendarios_doctores.doctores_id')
                ->select('calendarios_doctores.id as  calenId','personas.nombre',  'personas.apellido', 'calendarios_doctores.horario_inicio' , 'calendarios_doctores.horario_fin', 'calendarios_doctores.dias', db::raw('(SELECT consultorios.nombre
                FROM consultorios 
                WHERE consultorios.id = calendarios_doctores.consultorios_id) as consultorio'), db::raw( '(SELECT especialidades.descripcion from especialidades WHERE especialidades.id = calendarios_doctores.especialidades_id) as especialidades')) 
                ->where('personas.id', '=', $dat[0]->idp)
                ->where('doctores.stat_id', '=', 2)
                // ->where('calendarios_doctores.dias', 'like', '%' . $dias[date('w')] . '%')
                ->get()->toArray();

                // se va mostrar todos los dias y que labura el profesional
                // esta funcion se va usar cuando se llama al modal 
                // se va agregar un boton para filtrar por dias del profesional y especialidad 
                // para que el usuario pueda seleccionar a gusto
        }
        else{
            $calen = DB::table(db::raw('personas'))
            ->join('doctores', 'personas.id', '=','doctores.persona_id')
            ->join('calendarios_doctores', 'doctores.id', '=','calendarios_doctores.doctores_id')
            ->select('calendarios_doctores.id as  calenId','personas.nombre',  'personas.apellido', 'calendarios_doctores.horario_inicio' , 'calendarios_doctores.horario_fin', 'calendarios_doctores.dias', db::raw('(SELECT consultorios.nombre
            FROM consultorios 
            WHERE consultorios.id = calendarios_doctores.consultorios_id) as consultorio'), db::raw( '(SELECT especialidades.descripcion from especialidades WHERE especialidades.id = calendarios_doctores.especialidades_id) as especialidades')) 
            ->where('personas.id', '=', $dat[0]->idp)
            ->where('doctores.stat_id', '=', 2)
            // ->where('calendarios_doctores.dias', 'like', '%' . $dias[date('w')] . '%')
            ->where('calendarios_doctores.especialidades_id', '=', $espId[0]->id )
            ->get()->toArray();

            
                // se va mostrar todos los dias y que labura el profesional
                // esta funcion se va usar cuando se llama al modal 
                // se va agregar un boton para filtrar por dias del profesional y especialidad 
                // para que el usuario pueda seleccionar a gusto

    

        }


        $this->nom = $dat[0]->nomb;
        $this->apell = $dat[0]->apell;
        $this->descrip = $dat[0]->descripcion;
   
     //   $this->calenShow = $calen;
        $this->open_calendar = true;
      
        for($i= 0; $i < sizeof($calen); $i++){
            array_push($this->calenShow, json_decode(json_encode($calen[$i]), true));
        }
     
    }
    
    public function arrReceive( $inicio  )
    {
        $this->datTrans = calendarios_doctores::where('id', '=', $inicio)->get();
        $this->dias = explode(',',$this->datTrans[0]->dias);
    }

    public function calcHoras()
    {
        $horaInicial =date('H:i',strtotime( $this->datTrans[0]->horario_inicio));
        $horaFinal =  intval(str_replace(' ', '',strtr(date('H:i',strtotime( $this->datTrans[0]->horario_fin)), ':', ' ')));
   
        $this->test = consultorio::select('intervalo_consulta')->where('id', '=', $this->datTrans[0]->consultorios_id)->get();

        $time =   intval(str_replace(' ', '',strtr(date('H:i',strtotime( $this->datTrans[0]->horario_inicio)), ':', ' ')));
        array_push($this->timeDoc, $horaInicial);
        while( $time < $horaFinal ){
            
            
            $minutoAnadir=$this->test[0]->intervalo_consulta;
    
    
    
            $segundos_horaInicial=strtotime($horaInicial);
    
            $segundos_minutoAnadir=$minutoAnadir*60;
    
            $nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
            $horaInicial =  $nuevaHora;
            $time =intval(str_replace(' ', '',strtr(date('H:i',strtotime($horaInicial)), ':', ' ')));
            
            array_push($this->timeDoc, $nuevaHora);
        }


        if(sizeof($this->timeDoc)>0){
            $this->open_hour = true;
        }
        else{
            session()->flash('message', 'No existen horarios disponibles ' );
        }
    

    }

    public function calcDias()
    {
        $val = $this->monCod  . '' . $this->yeaCod;
        $monthActual = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre");
        // $this->inputMes =date('n')-1;

        foreach( $this->arryDay as $arr){
            if($arr['id'] == $this->inputMes){
                $limit = $arr['limit'];
            }
        }


        if($val == 31 || $val == 13 || $val == 23 || $val == 33 ){
            session()->flash('message', 'No se puede generar fecha');
        }

      
        if($val ==11 ){
       
            $start = date("d")-1;
            //futuro mostrar todos los apartir de la fecha actual los dias disponibles del mes segun dia seleccionado
            // session()->flash('message', 'Limite: ' . $limit . ' Inicio: ' . $start);
            for($start; $start < $limit; $start++ ){

                $date = date_create(strval(date('Y') . '-' . date('n')  . '-' . $start));
                $dateFormat = date_format($date, 'Y-m-d');
                if(!empty($this->inputDias)){
                    if($this->day[date('w',strtotime($dateFormat))] === $this->inputDias){
        
                        array_push($this->diasDisp,  $dateFormat);
                    
                        $this->open_day= true;
                    }
                }
            }

            if(empty($this->diasDisp) && !empty($this->inputDias)){
                session()->flash('message', 'No existen dias disponibles');
            }

            if($val == 12 || $val == 21 || $val == 22 || $val == 32 ){
                //futuro mostrar todos los dias disponibles del mes segun dia seleccionado
                $start = 1;
                session()->flash('message', 'Limite: ' . $limit . ' Inicio: ' . $start);

            }
        
        }
    }         

    public function valMonth()
    {
        $monthActual = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre");
        // $this->inputMes =date('n')-1;

        // comparar meses 
        if(date('n') == $this->inputMes ){
            $this->monCod = 1;
        }
        elseif(date('n') >   $this->inputMes ){
            $this->monCod = 3;

        }
        else{
            $this->monCod = 2;

        }
    }

    public function valYear()
    {
        if( date("Y") == $this->inputYear ){
            $this->yeaCod = 1;
        }
        elseif( date("Y") >   $this->inputYear ){
            $this->yeaCod = 3;
        }
        else{
           $this->yeaCod = 2;

        }
    }

    public function resetModalEntries()
    {
        $this->reset(['inputMes']);
    }

    public function resetShowEntries()
    {
        $this->reset(['nom', 'calenShow']);
        $this->open_calendar = false;
    }

    public function render()
    {
        // preguntar a guille como aplicar busqueda por nombre y apellido 
        $do = DB::table('personas')
        ->join('doctores', 'personas.id','=', 'doctores.persona_id')
        ->where('doctores.stat_id','=',2)
        ->where('doctores.especialidades', 'like', '%'. $this->inputEspecialidades . '%')
        ->where('personas.nombre', 'like', '%' . $this->inputNombre . '%')
        ->paginate($this->can);
        return view('livewire.reservar', compact('do'));
    }
}

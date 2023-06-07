<?php

namespace App\Http\Livewire;

use App\Models\calendarios_doctores;
use App\Models\consultorio;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Crearhoras extends Component
{
    use WithPagination;
    public $inputCan, $inputYear;
    public $datTrans= [];
    public $inputDias = [];
    public $inputMes= [];
    public $arryDay = [];
    public $nomb; 
    public $dias = [];
    public $meses = [];
    public $val;
    public $day = [];
    public $test;
    public $diasDisp = [];
    public $open_day = false;

    public function esBisiesto($anio=null) {
        return date('L',($anio==null) ? time(): strtotime($anio.'-01-01'));
    }

  
    public function getLimit( $mes )
    {
        // calculamos el rango de un mes
        //retorna el limite segun nombre del mes que le pasemos
        return  intval($this->arryDay[array_search( $mes, array_column($this->arryDay, 'month'))]['limit']);


    }

    public function getIdMonth($mes)
    {
                  // obtiene  el  id segun mes
        return intval($this->arryDay[array_search( $mes, array_column($this->arryDay, 'month'))]['id']);
    }

    public function mount()
    {
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
        $this->inputYear = date("Y");
        $this->val =$this->getLimit("Setiembre");
        $this->test =  $this->valMonth($this->getIdMonth("Junio"));
        
    }
    
    public function closeModalAsign()
    {
        $this->reset([     
            'datTrans',
            'dias',
            'meses',
            'inputDias',
            'inputMes',
            'diasDisp'
        ]);
    }

    public function setHours()
    {
        
    }

    public function genHour($day)
    {
        $horaInicial =date('H:i',strtotime( $this->datTrans[0]["horario_inicio"]));
        $horaFinal =  intval(str_replace(' ', '',strtr(date('H:i',strtotime( $this->datTrans[0]["horario_fin"])), ':', ' ')));
   
    
        $time =   intval(str_replace(' ', '',strtr(date('H:i',strtotime( $this->datTrans[0]["horario_inicio"])), ':', ' ')));
        array_push($this->diasDisp, ["dias_laborales" => $day, "horarios" => $horaInicial, "calendarios_doctores_id" => $this->datTrans[0]["id"], "stat_id" => 1]);
        while( $time < $horaFinal ){
            
            
            $minutoAnadir=$this->datTrans[0]["intervalo_consulta"];
    
    
    
            $segundos_horaInicial=strtotime($horaInicial);
    
            $segundos_minutoAnadir=$minutoAnadir*60;
    
            $nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
            $horaInicial =  $nuevaHora;
            $time =intval(str_replace(' ', '',strtr(date('H:i',strtotime($horaInicial)), ':', ' ')));
            
            array_push($this->diasDisp, ["dias_laborales" => $day, "horarios" => $nuevaHora, "calendarios_doctores_id" => $this->datTrans[0]["id"], "stat_id" => 1]);
            // array_push($this->timeDoc, ["id"=> $time, "hora" =>$nuevaHora ]);

        }
    
    }

    public function genDay()
    {
        foreach( $this->inputMes as $arr){
            $val = $this->valMonth($this->getIdMonth( $arr ))  . '' . $this->valYear();
            $limit = $this->getLimit($arr);
            $id = $this->getIdMonth($arr);
            $this->calcDias($val, $limit, $id);
        }
        $this->open_day = true ;

        $this->reset([     
            'datTrans',
            'dias',
            'meses',
            'inputDias',
            'inputMes',
        ]);
    }

    public function calcDias( $val, $limit, $id)
    {
       if($val == 31 || $val == 13 || $val == 23 || $val == 33 ){
            // session()->flash('message', 'No se puede generar fecha');
        }

      
        if($val ==11 ){
          
            $start = date("d");
            //futuro mostrar todos los apartir de la fecha actual los dias disponibles del mes segun dia seleccionado
            // session()->flash('message', 'Limite: ' . $limit . ' Inicio: ' . $start);
            //$this->datTrans[0]["horario_fin"]
            if($start <= $limit){
                if( intval(str_replace(' ', '',strtr(date('H:i'), ':', ' '))) <=  intval(str_replace(' ', '',strtr(date('H:i',strtotime( "22:00:00")), ':', ' ')))){
                    for($start; $start < $limit; $start++ ){

                        $date = date_create(strval(date('Y') . '-' . date('n')  . '-' . $start));
                        $dateFormat = date_format($date, 'Y-m-d');
                        if(!empty($this->inputDias)){
                            if(in_array($this->day[date('w',strtotime($dateFormat))],$this->inputDias)){
                
                                $this->genHour( $dateFormat);
                            
                            
                            }
                        }
                    }
                }
           
            }
        }


            if($val == 12 || $val == 21 || $val == 22 || $val == 32 ){
                //futuro mostrar todos los dias disponibles del mes segun dia seleccionado
                $start = 1;
                        for($start; $start <= $limit; $start++ ){
    
                            $date = date_create(strval($this->inputYear . '-' . $id . '-' . $start));
                            $dateFormat = date_format($date, 'Y-m-d');
                            if(!empty($this->inputDias)){
                                if(in_array($this->day[date('w',strtotime($dateFormat))],$this->inputDias)){
                    
                                    $this->genHour( $dateFormat);
                                
                                }
 

                            }
                        }
            }
        

    }         




    public function valMonth( $id)
    {
    
        // comparar meses 
        if(date('n') == $id ){
            $monCod = 1;
        }
        elseif(date('n') >   $id ){
            $monCod = 3;

        }
        else{
            $monCod = 2;

        }

        return $monCod;
    }


    public function valYear()
    {
        if( date("Y") == $this->inputYear ){
            $yeaCod = 1;
        }
        elseif( date("Y") >   $this->inputYear ){
            $yeaCod = 3;
        }
        else{
           $yeaCod = 2;

        }
        return $yeaCod;
    }



    public function arrReceive(  $detail )
    {
        array_push($this->datTrans, json_decode( $detail,true));
        
        $this->dias = explode(',',$this->datTrans[0]["dias"]);
        $this->meses = explode(',',$this->datTrans[0]["meses"]);
    }

    
    public function render()
    {
        $do = DB::table(db::raw('calendarios_doctores'))
                        ->join('doctores', 'calendarios_doctores.doctores_id', '=','doctores.id')
                        ->join('consultorios', 'calendarios_doctores.consultorios_id', '=','consultorios.id')
                        ->join('especialidades', 'calendarios_doctores.especialidades_id', '=','especialidades.id')
                        ->join('personas', 'doctores.persona_id', '=','personas.id')
                        ->select(
                            'calendarios_doctores.id','calendarios_doctores.horario_inicio', 'calendarios_doctores.horario_fin', 'calendarios_doctores.dias', 'calendarios_doctores.meses',
       'personas.nombre','personas.apellido', 'consultorios.nombre as consultorio', 'consultorios.intervalo_consulta', 'especialidades.descripcion'
                        )
                        ->where('calendarios_doctores.doctores_id','=',1)
                        ->paginate(10);
        return view('livewire.crearhoras', compact('do'));
    }
}

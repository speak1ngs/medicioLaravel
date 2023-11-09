<?php

namespace App\Http\Livewire;

use App\Models\calendarios_doctores;
use App\Models\cita;
use App\Models\ciudades;
use App\Models\doctores;
use App\Models\especialidades;
use App\Models\paciente;
use App\Models\persona;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class ReservarAdmin extends Component
{
   
    public $especialidades, $inputEspecialidades, $inputNombre, $inputFech, $inputYear, $inputMes, $inputDias, $inputHourse, $inputHorarioIni, $inputHorarioFin, 
    $inputCiudades, $inputDayWeek, $inputDia, $inputHour,$inputCedula, $inputName, $inputLastName, $inputCi, $inputEmail, $inputTelf;
    public $can, $nom ,  $horasToInt , $horasToIntFin, $intervalo, $apell , $descrip;
    public $statAlert ,$title, $text, $horIn, $horFin;
    public $open_calendar,$fot;
    public $timeDoc = [];
    public $arrDay = [];
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
    public $calenShow = [];
    public $arryHour = [];
    public $arryDay = [];
    public $test ;
    public $hourStart, $hourEnd, $ciudades;
    public $userState;
    public $open_modal= false;
    public $alert, $idenDetail, $showUserType, $idenpac, $nomuser;
    public $filters = [
        'status' => 2,
        'especialidades' => '',
        'nombre' => '',
        'horaInicio' => '00:00:00',
        'horaFin' => '23:59:59',
        'ciudad' => 1,
        'dia' => ''
    ];
    protected $rules = [
        'inputDias' => 'required',
        'inputMes' => 'required',
        'inputHour' => 'required',
        ];


    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function updatingSearch()

    {

        $this->resetPage();

    }
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

 

    public function check(){
        if($this->inputMes && $this->inputHour){
            $this->open_modal= true;
        }
        else{
            $this->open_modal= false;
        }
    }
    public function mount()
    {
        $this->can = 10;
        $this->open_calendar = false;
        $this->alert = '#paymentCheck';
        $this->especialidades = especialidades::all();
        $this->hourStart= calendarios_doctores::all()->unique('horario_inicio');
        $this->hourEnd= calendarios_doctores::all()->unique('horario_fin');
        $this->ciudades = ciudades::all();
        $this->arrDay= [];
        $this->open_day = false;
        $this->open_hour = false;
        $this->showUserType=0;
        // $this->inputMes =date('n');
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
        
        $this->day= [
            ["id"=> 1 , "dayWeek" => 'Domingo'],
            ["id"=> 2, "dayWeek" => 'Lunes'],
            ["id"=> 3, "dayWeek" => 'Martes'],
            ["id"=> 4, "dayWeek" => 'Miercoles' ],
            ["id"=> 5, "dayWeek" => 'Jueves'], 
            ["id"=> 6, "dayWeek" => 'Viernes'],
            ["id"=> 7, "dayWeek" => 'Sabado'],
        ];
        $this->calenShow = [];
       
    }

    public function openUser() 
    {
        $this->reset(['inputCedula','idenpac','nomuser']);
        switch ($this->userState) {
            case '1':
                $this->showUserType = 1;
                break;
            case '2':
                $this->showUserType = 2;
                break;
            default:
                $this->showUserType = 0;
                break;
        }
    }

    public function searchUser() 
    {
        $user = DB::table('personas')->join('pacientes','personas.id','=','pacientes.persona_id')->select('pacientes.id as idpac', db::raw('concat(personas.nombre," ",personas.apellido) as nombre'))->where('personas.cedula','=', $this->inputCedula)->get();
        $this->idenpac= $user[0]->idpac;
        $this->nomuser = $user[0]->nombre;
    }


    public function asig($data)
    {   
        $this->reset(['nom','apell','descrip','fot']);
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");

        $dat = db::table(db::raw('personas'))
        ->join('doctores', 'personas.id','=', 'doctores.persona_id')
        ->select('personas.id as idp','doctores.id as id', 'personas.nombre as nomb', 'personas.apellido as apell', 'doctores.descripcion as descripcion', 'doctores.foto_url as fotdoc')
        ->where('personas.id', '=', $data)->get();
        // $this->nom =$dat[0]->nomb . ' ' . $dat[0]->apell;
        if(empty($this->inputEspecialidades)){
        $calen = DB::table(db::raw('personas'))
                ->join('doctores', 'personas.id', '=','doctores.persona_id')
                ->join('calendarios_doctores', 'doctores.id', '=','calendarios_doctores.doctores_id')
                ->select('calendarios_doctores.id as  calenId','personas.nombre',  'personas.apellido', 'calendarios_doctores.horario_inicio' , 'calendarios_doctores.horario_fin', 'calendarios_doctores.dias', db::raw('(SELECT consultorios.nombre
                FROM consultorios 
                WHERE consultorios.id = calendarios_doctores.consultorios_id) as consultorio'), db::raw( '(SELECT especialidades.descripcion from especialidades WHERE especialidades.id = calendarios_doctores.especialidades_id) as especialidades')) 
                ->where('personas.id', '=', $data)
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
            ->where('calendarios_doctores.especialidades_id', '=', $this->inputEspecialidades )
            ->get();

            
                // se va mostrar todos los dias y que labura el profesional
                // esta funcion se va usar cuando se llama al modal 
                // se va agregar un boton para filtrar por dias del profesional y especialidad 
                // para que el usuario pueda seleccionar a gusto

    

        }

        $this->reset(['calenShow']);


        foreach($dat as $val => $value){
            if($value->idp === $data){
                $this->nom = $value->nomb;
                $this->apell = $value->apell;
                $this->descrip = $value->descripcion;
                $this->fot = $value->fotdoc;
                $this->ced = $value->idp;
            }
        }
  
   
        //  $this->calenShow = $calen;
        $this->open_calendar = true;
     if(count($calen)>=1){
            for($i= 0; $i < sizeof($calen); $i++){
                array_push($this->calenShow, json_decode(json_encode($calen[$i]), true));
            }
        }
 
    }
    
    public function arrReceive( $inicio  )
    {
        $this->datTrans = calendarios_doctores::where('id', '=', $inicio)->get();
        $this->idenDetail = $this->datTrans[0]->id;
        $this->horIn = $this->datTrans[0]->horario_inicio;
        $this->horFin = $this->datTrans[0]->horario_fin;
        $this->dias = explode(',',$this->datTrans[0]->dias);
    }
    public function getLimit( $mes )
    {
        // calculamos el rango de un mes
        //retorna el limite segun nombre del mes que le pasemos
        return  intval($this->arryDay[array_search( $mes, array_column($this->arryDay, 'id'))]['limit']);


    }
    public function showDatesOfWeek() 
    {
        $this->reset(['arrDay','arryHour','open_day','inputMes']);
    
        $mes =intval(date("n"));    
        //$mes =intval("7");    
        $cal =$this->getLimit($mes) - date("j");
        
        $date = date_create(strval(date('Y') . '-' . (date('n')+ 1)  . '-' . $this->getLimit($mes)));
        $dateFormat = date_format($date, 'Y-m-d');
        date_default_timezone_set('America/Asuncion');

        $this->test= date('H:i:s');
        if($cal <= 6){
            $val = DB::table('calendarios_detalles')
            ->where('calendarios_doctores_id', '=', $this->idenDetail)
            ->whereRaw( 'DAYOFWEEK(calendarios_detalles.dias_laborales) = '.  intval($this->day[array_search( $this->inputDias, array_column($this->day, 'dayWeek'))]['id']))
            ->where('calendarios_detalles.dias_laborales', '>=', date('Y-m-d'))
            ->where('calendarios_detalles.dias_laborales', '<=', $dateFormat)
            ->distinct()
            ->get('dias_laborales')->toArray();
        }
        else{
            $val = DB::table('calendarios_detalles')
            ->where('calendarios_doctores_id', '=', $this->idenDetail)
            ->whereRaw( 'DAYOFWEEK(calendarios_detalles.dias_laborales) = '.  intval($this->day[array_search( $this->inputDias, array_column($this->day, 'dayWeek'))]['id']))
            ->whereMonth('calendarios_detalles.dias_laborales', '=' ,$mes)
            ->where('calendarios_detalles.dias_laborales', '>=', date('Y-m-d'))
            ->groupBy('dias_laborales')
            ->get()->toArray();
        }
        if(count($val)>=1){
            for($i= 0; $i < sizeof($val); $i++){
                array_push($this->arrDay,json_decode(json_encode($val[$i]), true));
                }
                $this->open_day= true;
        }else{
            if(!empty($this->inputDias))
                session()->flash('message', 'El profesional no tiene turnos disponible en ese día.');
        }   

    }

    public function showHoursOfWeek() 
    {
        $this->reset(['arryHour','inputHour']);
        $val = DB::table('calendarios_detalles')->where('calendarios_detalles.calendarios_doctores_id', '=', $this->idenDetail)->where('calendarios_detalles.stat_id', '=', 1)->where('calendarios_detalles.dias_laborales', '=', $this->inputMes)->get()->toArray();

        if(count($val)>=1){
            for($i= 0; $i < sizeof($val); $i++){
                array_push($this->arryHour,json_decode(json_encode($val[$i]), true));
            }
        }
    }
 
    public function resetFilters(){
        $this->reset([ 'inputEspecialidades', 'inputNombre',  'inputHorarioIni', 'inputHorarioFin', 'inputCiudades', 'inputDayWeek', 'can']);
        $this->resetShowEntries();
    }

    public function resetModalEntries()
    {
        $this->reset(['inputMes','diasDisp', 'inputDias', 'inputYear','timeDoc','open_hour','dias', 'inputHour','arrDay','arryHour','open_day','inputMes','idenDetail']);
    }

    public function resetShowEntries()
    {
        $this->reset(['nom', 'calenShow']);
        $this->open_calendar = false;
    }

    public function reserTime() 
    {
        try {
            // db::table('calendarios_detalles')->where('id','=',$this->inputHour)->update(['stat_id' => 2]);
            switch ($this->userState) {
                case '1':
                    cita::create(
                        [
                        'nro_operacion_pago' => 0,
                        'importe'  =>$this->datTrans[0]->costo_consulta,
                        'descripcion_doctor' => null,
                        'descripcion_paciente' => null,
                        'cal_doc_id' => null,
                        'cal_pac_id' => null,
                        'status_id' => 2,
                        'paciente_id' => $this->idenpac, 
                        'calendarios_deta_id' => $this->inputHour,
                        'pago_id' => 1,
                        'medio_id' => 4,
                        'calificacion_status_id' => 2,
                        'paciente_status_id' => 3
                        ]
                    );
                    db::table('calendarios_detalles')->where('id','=',$this->inputHour)->update(['stat_id' => 2]);

                    $this->statAlert = 'success';
                    $this->title = 'Exitoso';
                    $this->text = 'Se creo la prereserva.';

                    break;
                case '2':
                        $check = DB::table('personas')->join('pacientes','personas.id','pacientes.persona_id')->where('personas.cedula','=', $this->inputCi)->get();
                        if(count($check)=== 0){
                        persona::create(
                            [
                                'nombre' => $this->inputName, 
                                'apellido' =>$this->inputLastName, 
                                'cedula' => $this->inputCi,
                                'fecha_nacimiento' => null, 
                                'telefono_particular' => $this->inputTelf, 
                                'edad' => null,
                                'ciudad_id' => null,
                                'pais_id' =>null, 
                                'barrio_id' =>null
                            ]
                        );
                        $iden = persona::select('id')->where('cedula','=', $this->inputCi)->get();

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
                                        'password' => Hash::make("12345678"),
                                        'paciente_id' => $paciente[0]->id,
                                        'doctor_id' => null,
                                        'tipo_usuario_id' => null,
                                        'persona_id' => $iden[0]->id
                                    ]
                                    );
                
                            }
                            db::table('calendarios_detalles')->where('id','=',$this->inputHour)->update(['stat_id' => 2]);
                            cita::create(
                                [
                                'nro_operacion_pago' => 0,
                                'importe'  =>$this->datTrans[0]->costo_consulta,
                                'descripcion_doctor' => null,
                                'descripcion_paciente' => null,
                                'cal_doc_id' => null,
                                'cal_pac_id' => null,
                                'status_id' => 2,
                                'paciente_id' => $paciente[0]->id, 
                                'calendarios_deta_id' => $this->inputHour,
                                'pago_id' => 1,
                                'medio_id' => 4,
                                'calificacion_status_id' => 2,
                                'paciente_status_id' => 3
                                ]
                            );

                            db::table('calendarios_detalles')->where('id','=',$this->inputHour)->update(['stat_id' => 3]);
                            $this->statAlert = 'success';
                            $this->title = 'Exitoso';
                            $this->text = 'Se creo la prereserva.';
                        }
                        else{
                            $this->statAlert = 'error';
                            $this->title = 'Error';
                            $this->text = 'El usuario ya existe.' ;
                        }

                        break;
                default:
                    # code...
                    break;
            }
       } catch (\Throwable $th) {
        $this->statAlert = 'error';
        $this->title = 'Error';
        $this->text = 'No se pudo acceder a la base de datos';
        }
        $this->resetModalEntries();
        $this->alert();
    }




    public function render()
    {
        $mes =intval(date("n"));

        // $do = DB::table('personas')
        // ->join('doctores','personas.id','=','doctores.persona_id')
        // ->join('calendarios_doctores','doctores.id','=','calendarios_doctores.doctores_id')
        // ->join('consultorios','calendarios_doctores.consultorios_id','=','consultorios.id')
        // ->join('calendarios_detalles','calendarios_doctores.id','=', 'calendarios_detalles.calendarios_doctores_id')
        // ->whereRaw( '"'.(empty($this->inputHorarioIni) ? '09:30:00': $this->inputHorarioIni) .'" BETWEEN calendarios_doctores.horario_inicio and calendarios_doctores.horario_fin')
        // ->orWhereRaw( '"'. (empty($this->inputHorarioFin) ? '10:00:00': $this->inputHorarioFin)  .'" BETWEEN calendarios_doctores.horario_inicio and calendarios_doctores.horario_fin')
        // ->whereRaw( 'DAYOFWEEK(calendarios_detalles.dias_laborales) like '. "'%".$this->inputDayWeek. "%'")
        // ->whereMonth('calendarios_detalles.dias_laborales',$mes)
        // ->where('calendarios_doctores.especialidades_id','like', (empty(intval($this->inputEspecialidades)) ? '%4%': "'%".$this->inputEspecialidades . "%'" ))
        // ->where('consultorios.ciudad_id','like', (empty(intval($this->inputCiudades)) ? '%1%' : "'%". intval($this->inputCiudades) ."%'") )
        // ->whereRaw('concat(personas.nombre," ",personas.apellido) LIKE '. "'%".$this->inputNombre . "%'")
        // ->where('doctores.stat_id','like', "'%" . 2 ."%'")
        // ->groupBy( 'personas.id')
        // ->paginate($this->can);


        $es = doctores::with(['personas','calendarios_doctores'=> fn($q) => $q->with(['especialidad' , 'consultorios','calendarios_detalles'])]);
        $es->whereHas('calendarios_doctores.doctores',fn($query) => $query->whereRaw('calendarios_doctores.especialidades_id LIKE' . (empty($this->inputEspecialidades) ? "'%". $this->filters['especialidades'] . "%'" : "'%" . intval($this->inputEspecialidades) . "%'") ));
        $es->whereHas('calendarios_doctores',fn($query) => $query->where('calendarios_doctores.horario_inicio','>=', empty($this->inputHorarioIni) ? $this->filters['horaInicio'] : $this->inputHorarioIni ));
        $es->whereHas('calendarios_doctores',fn($query) => $query->where('calendarios_doctores.horario_fin','<=',  empty($this->inputHorarioFin) ? $this->filters['horaFin'] : $this->inputHorarioFin  ));
        $es->whereHas('personas.doctores',fn($query) => $query->whereRaw('concat(personas.nombre," ",personas.apellido) LIKE '. "'%". ( empty($this->inputNombre) ? $this->filters['nombre'] : $this->inputNombre  ) . "%'"));
        // $es->whereHas('calendarios_doctores.calendarios_detalles',fn($query) => $query->whereMonth('calendarios_detalles.dias_laborales', $mes));
        $es->whereHas('calendarios_doctores.calendarios_detalles',fn($query) => $query->whereRaw( 'DAYOFWEEK(calendarios_detalles.dias_laborales) like '.  ( empty($this->inputDayWeek) ? "'%". $this->filters['dia'] . "%'" : "'%". $this->inputDayWeek . "%'") ));
        // $es->whereHas('calendarios_doctores.calendarios_detalles',fn($query) => $query->where('calendarios_doctores.especialidades_id',  empty($this->inputEspecialidades) ? $this->filters['especialidades'] : $this->inputEspecialidades    ));
        $es->whereHas('calendarios_doctores.consultorios',fn($query) => $query->where('consultorios.ciudad_id',  empty($this->inputCiudades) ? $this->filters['ciudad'] : $this->inputCiudades  ));
        $do = $es->when($this->filters['status'], fn($query, $status) => $query->where('doctores.stat_id', $status))
            ->paginate($this->can);

        return view('livewire.reservar-admin', compact('do'));
    }
}

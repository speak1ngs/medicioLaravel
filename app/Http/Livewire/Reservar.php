<?php

namespace App\Http\Livewire;

use App\Models\especialidades;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Reservar extends Component
{
    use WithPagination;
    public $especialidades, $inputEspecialidades, $inputNombre;
    public $can, $nom , $calenShow, $horasToInt , $horasToIntFin, $intervalo;
    public $open_calendar;
    public $timeDoc = [];

    public function mount()
    {
        $this->can = 10;
        $this->open_calendar = false;
        $this->especialidades = especialidades::all();
    }

    public function asig($data)
    {   
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
                ->select('personas.nombre',  'personas.apellido', 'calendarios_doctores.horario_inicio' , 'calendarios_doctores.horario_fin', 'calendarios_doctores.dias', db::raw('(SELECT consultorios.nombre
                FROM consultorios 
                WHERE consultorios.id = calendarios_doctores.consultorios_id) as consultorio'), db::raw( '(SELECT especialidades.descripcion from especialidades WHERE especialidades.id = calendarios_doctores.especialidades_id) as especialidades')) 
                ->where('personas.id', '=', $dat[0]->idp)
                ->where('doctores.stat_id', '=', 2)
                ->where('calendarios_doctores.dias', 'like', '%' . $dias[date('w')] . '%')
                ->get();

                 $this->horasToInt =  strtr(date('H:i',strtotime($calen[0]->horario_inicio)), ':', ' ');
                 $this->horasToIntFin =  strtr(date('H:i',strtotime($calen[0]->horario_fin)), ':', ' ');
                // intval(str_replace(' ', '', $horasToInt)) , intval(str_replace(' ', '', $horasToIntFin))
                $this->intervalo = 30;

                $horaInicial=date('H:i',strtotime($calen[0]->horario_inicio));
                $time =  intval(str_replace(' ', '',strtr(date('H:i',strtotime($horaInicial)), ':', ' ')));
                $end =  intval(str_replace(' ', '',strtr(date('H:i',strtotime($calen[0]->horario_fin)), ':', ' ')));
                array_push($this->timeDoc, $horaInicial);
                while( $time < $end ){
                    
            
                    $minutoAnadir= $this->intervalo;
            
            
            
                    $segundos_horaInicial=strtotime($horaInicial);
            
                    $segundos_minutoAnadir=$minutoAnadir*60;
            
                    $nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                    $horaInicial =  $nuevaHora;
                    $time =intval(str_replace(' ', '',strtr(date('H:i',strtotime($horaInicial)), ':', ' ')));
                   
                   array_push($this->timeDoc, $nuevaHora);
                
                }

        }
        else{
            $calen = DB::table(db::raw('personas'))
            ->join('doctores', 'personas.id', '=','doctores.persona_id')
            ->join('calendarios_doctores', 'doctores.id', '=','calendarios_doctores.doctores_id')
            ->select('personas.nombre',  'personas.apellido', 'calendarios_doctores.horario_inicio' , 'calendarios_doctores.horario_fin', 'calendarios_doctores.dias', db::raw('(SELECT consultorios.nombre
            FROM consultorios 
            WHERE consultorios.id = calendarios_doctores.consultorios_id) as consultorio'), db::raw( '(SELECT especialidades.descripcion from especialidades WHERE especialidades.id = calendarios_doctores.especialidades_id) as especialidades')) 
            ->where('personas.id', '=', $dat[0]->idp)
            ->where('doctores.stat_id', '=', 2)
            ->where('calendarios_doctores.dias', 'like', '%' . $dias[date('w')] . '%')
            ->where('calendarios_doctores.especialidades_id', '=', $espId[0]->id )
            ->get();

       
             $this->horasToInt = strtr(date('H:i',strtotime($calen[0]->horario_inicio)), ':', ' ');
             $this->horasToIntFin =  strtr(date('H:i',strtotime($calen[0]->horario_fin)), ':', ' ');
             $this->intervalo = 30;
            
             $horaInicial=date('H:i',strtotime($calen[0]->horario_inicio));
             $time =  intval(str_replace(' ', '',strtr(date('H:i',strtotime($horaInicial)), ':', ' ')));
             $end =  intval(str_replace(' ', '',strtr(date('H:i',strtotime($calen[0]->horario_fin)), ':', ' ')));

             while( $time < $end ){
                 
         
                 $minutoAnadir= $this->intervalo;
         
         
         
                 $segundos_horaInicial=strtotime($horaInicial);
         
                 $segundos_minutoAnadir=$minutoAnadir*60;
         
                 $nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                 $horaInicial =  $nuevaHora;
                 $time =intval(str_replace(' ', '',strtr(date('H:i',strtotime($horaInicial)), ':', ' ')));
                
                array_push($this->timeDoc, $nuevaHora);
             
             }


        }
        $this->nom = $dat;
        $this->calenShow = $calen;
        $this->open_calendar = true;
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

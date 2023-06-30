<?php

namespace App\Http\Livewire;

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
    use WithPagination;
    
    public function mount() 
    {
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
        $this->val = db::table('citas')->where('id','=',$this->ide)->get('cal_pac_id');
        if( !empty($this->val[0]->cal_pac_id) ){
            $this->control = "failComment";
        }

    }


    public function calificar()
    {   
        
        try {
            if($this->control === "successComent" ){
            
                db::table('citas')->where('id','=',$this->ide)->update([
                'descripcion_paciente' => $this->inputComent,
                'cal_pac_id' => $this->inputRating
            ]);
                $this->control = "successComent";
                session()->flash('message', 'Se califico al doctor.');    
                $this->reset(['inputRating','inputComent']);
            }
            else{
            $this->reset(['inputRating','inputComent']);
                session()->flash('message', 'Ya se califico al doctor.');    
            }

        } catch (\Throwable $th) {
            //throw $th;
            $this->control = "failComment";
            session()->flash('message', 'Fallo la conexion a la db.');
            $this->reset(['inputRating','inputComent']);
        }
    
 
    }

    public function render()
    {
               // agregar id del paciente a nivel global
               $db= DB::table('citas')
               ->join('calendarios_detalles', 'citas.calendarios_deta_id','=','calendarios_detalles.id')
               ->join('calendarios_doctores','calendarios_detalles.calendarios_doctores_id','=','calendarios_doctores.id')
               ->join('doctores','calendarios_doctores.doctores_id','=','doctores.id')
               ->join('consultorios','calendarios_doctores.consultorios_id','=','consultorios.id')
               ->join('pacientes','citas.paciente_id','=','pacientes.id')
               ->join('personas','pacientes.persona_id','=', 'personas.id')
               ->join('citas_status','citas.status_id','=','citas_status.id')
               ->select('citas.id',DB::raw('(SELECT CONCAT(personas.nombre," ", personas.apellido) FROM personas where personas.id = doctores.persona_id )  as nombres, (select especialidades.descripcion from especialidades where especialidades.id = calendarios_doctores.especialidades_id) as especialidad' ),'calendarios_detalles.dias_laborales', 'calendarios_detalles.horarios', 'citas_status.descripcion', 
                       'doctores.id as iddoc', 'citas.paciente_id as idpac'
                       )
               ->where('citas_status.id','=',1)
               ->where('calendarios_detalles.dias_laborales', '<', '2023-08-08')
               ->where('citas.paciente_status_id','=',3)
               ->where('citas.paciente_id','=', 1)
               ->paginate($this->cant);


        return view('livewire.turnos-reservados',compact('db'));
    }
}

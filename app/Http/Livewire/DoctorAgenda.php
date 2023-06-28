<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DoctorAgenda extends Component
{
    public $inputRating , $inputComent;
    public $nom, $ide;
    use WithPagination;

    public function mount() 
    {
       
    }

    public function instanData($iden, $nomb) 
    {   
        $this->reset(['ide','nom']);
        $this->ide = $iden;
        $this->nom = $nomb;
    }

    public function calificar()
    {   
        $val = db::table('citas')->where('id','=',$this->ide)->get('calificacion_status_id');
        if($val['calificacion_status_id'] ===2 ){
        db::table('citas')->where('id','=',$this->ide)->update([
            'descripcion_doctor' => $this->inputComent,
            'cal_doc_id' => $this->inputRating,
            'calificacion_status_id' => 1
        ]);
    }
 
    }

    public function render()
    {
        $db= DB::table('citas')
        ->join('calendarios_detalles', 'citas.calendarios_deta_id','=','calendarios_detalles.id')
        ->join('calendarios_doctores','calendarios_detalles.calendarios_doctores_id','=','calendarios_doctores.id')
        ->join('doctores','calendarios_doctores.doctores_id','=','doctores.id')
        ->join('consultorios','calendarios_doctores.consultorios_id','=','consultorios.id')
        ->join('pacientes','citas.paciente_id','=','pacientes.id')
        ->join('personas','pacientes.persona_id','=', 'personas.id')
        ->join('citas_status','citas.status_id','=','citas_status.id')
        ->select('citas.id',DB::raw('CONCAT(personas.nombre," ", personas.apellido) as nombres'),'calendarios_detalles.dias_laborales', 'calendarios_detalles.horarios', 'citas_status.descripcion', 
                'consultorios.nombre as consul_nomb'
                )
        ->where('citas_status.id','=',1)
        ->where('calendarios_detalles.dias_laborales', '<', '2023-08-08')
        ->where('citas.paciente_status_id','=',3)
        ->paginate(10);

        return view('livewire.doctor-agenda', compact('db'));
    }
}

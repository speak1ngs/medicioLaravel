<?php

namespace App\Http\Livewire;

use App\Models\calendarios_doctores;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Crearhoras extends Component
{
    use WithPagination;
    public $inputCan;
    public $datTrans= [];
    public $nomb; 
    public $dias = [];
    public $meses = [];


    public function arrReceive(  $detail )
    {

        array_push($this->datTrans, json_decode($detail));
        $this->dias = explode(',',$this->datTrans[0]->dias);
        $this->meses = explode(',',$this->datTrans[0]->meses);

        // $id, $nom, $apellido
        // $this->datTrans = calendarios_doctores::where('id', '=', $id)->get();
        // $this->nomb = $nom . ' ' . $apellido ;
        // $this->dias = explode(',',$this->datTrans[0]->dias);
        // $this->meses = explode(',',$this->datTrans[0]->meses);

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

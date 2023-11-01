<?php

namespace App\Http\Livewire;

use App\Models\calendarios_doctores;
use App\Models\doctores;
use App\Models\especialidades;
use App\Models\persona;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowDoctors extends Component
{
    public $especialidades, $doctores;


    public function mount() {
        $this->especialidades = especialidades::all();
        // $especial = doctores::with(['personas','calendarios_doctores'=> fn($q) => $q->with('especialidad')]);
        // // $especial->whereHas('calendarios_doctores.doctores');
        // $especial->where('doctores.calificacion', '>=', 4);
        // $especial->where('doctores.stat_id',2);
        // $especial->whereHas('calendarios_doctores', fn($q) => $q->groupBy('calendarios_doctores.especialidades_id'));
        // $this->doctores = $especial->distinct('calificacion')->groupBy('calificacion')->get();

        $this->doctores = db::table('doctores')
            ->join('personas','doctores.persona_id', '=','personas.id')
            ->join('calendarios_doctores','doctores.id', '=','calendarios_doctores.doctores_id')
            ->join('especialidades','calendarios_doctores.especialidades_id', '=','especialidades.id')
            ->select('doctores.id', 'doctores.foto_url','personas.nombre', 'personas.apellido',DB::raw( 'MAX(doctores.calificacion) AS VAL'), 'especialidades.descripcion')
            ->where('doctores.stat_id',2)
            ->groupBy('calendarios_doctores.especialidades_id')->get();



    }


    public function render()
    {
        return view('livewire.show-doctors');
    }
}

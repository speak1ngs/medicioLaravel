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
        $especial = doctores::with(['personas','calendarios_doctores'=> fn($q) => $q->with('especialidad')]);
        $especial->whereHas('calendarios_doctores.doctores');
        $especial->where('doctores.calificacion', '>=', 4);
        $especial->whereHas('calendarios_doctores.especialidad', fn($query) => $query->distinct('especialidad.descripcion'));
        $this->especialidades = especialidades::all();
        $this->doctores = $especial->get();
    }


    public function render()
    {
        return view('livewire.show-doctors');
    }
}

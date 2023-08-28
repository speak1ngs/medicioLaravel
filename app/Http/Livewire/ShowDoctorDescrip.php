<?php

namespace App\Http\Livewire;

use App\Models\doctores;
use Livewire\Component;

class ShowDoctorDescrip extends Component
{
    public $dat;

    public function mount($data){
        $especial = doctores::with(['persona','calendarios_doctores'=> fn($q) => $q->with('especialidad')]);
        $especial->whereHas('calendarios_doctores.doctores');
        $this->dat = $especial->where('id','=',$data)->get();


    }


    public function render()
    {
        return view('livewire.show-doctor-descrip');
    }
}

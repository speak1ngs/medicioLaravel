<?php

namespace App\Http\Livewire;

use App\Models\consultorio;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditarImporte extends Component
{
    public $consu;
    public $consultorio;

    public function mount()
    {
        $this->consu= consultorio::all();
    }


    public function upMount()
    {
      
    }


    public function render()
    {
        return view('livewire.editar-importe');
    }
}

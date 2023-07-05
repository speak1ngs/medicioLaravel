<?php

namespace App\Http\Livewire;

use App\Models\consultorio;
use App\Models\status;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Altaconsultorio extends Component
{
    public $cant, $control, $stat, $state, $search;
    public $inputState;
    use WithPagination;

    public function mount()
    {
        $this->state = status::all();
        $this->cant = 10;
        $this->control ='#doctorActive';
    }

    public function upState( $consu,$stat)
    {   
       
        try {
            
            db::table('consultorios')
            ->where('consultorios.id', '=', $consu)
            ->update(['consultorios.stat_id' => $stat]);
        } catch (\Throwable $th) {
            $this->control ='#failAlt';
        }
    
            if($stat == 2){
                $this->stat= 'activado';
            }
            else
            {
                $this->stat = 'inactivado';
            }
    }


    public function render()
    {
        $datos = DB::table('consultorios')
        ->select('id','nombre',db::raw('(SELECT descripcion from status where status.id = consultorios.stat_id) as estado'))
        ->where('stat_id','=', $this->inputState)
        ->where('nombre','like', '%' . $this->search . '%')
        ->paginate($this->cant);


        return view('livewire.altaconsultorio', compact('datos'));
    }
}

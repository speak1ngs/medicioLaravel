<?php

namespace App\Http\Livewire;

use App\Models\doctores;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AltaDoctor extends Component
{
    use WithPagination;
    public $doc;
    public $search;
    public $cant;
    public $test= 1;
    public $stat ;
    protected $listeners = ['render'];
    protected $paginationTheme = 'bootstrap';
    
    public function mount()
    {
      
        $this->cant = 10;
       
    }

    public function upState( $pers,$stat)
    {
    
            db::table('doctores')
            ->where('doctores.persona_id', '=', $pers)
            ->update(['doctores.stat_id' => $stat]);
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
        // $datos = DB::table(db::raw('personas'))
        // ->join('doctores', 'personas.id','=', 'doctores.persona_id' )
        // ->select(db::raw('personas.id, personas.nombre, personas.apellido, personas.cedula, 
        // doctores.especialidades , (SELECT status.descripcion from status where status.id = doctores.stat_id) AS estado') )
        // ->groupBy('personas.id', 'doctores.persona_id')
        // ->paginate($this->cant);
         
        $datos =doctores::with([
            'personas',
            'status'
        ])->paginate( $this->cant);

        return view('livewire.alta-doctor', compact('datos'));
    }
}

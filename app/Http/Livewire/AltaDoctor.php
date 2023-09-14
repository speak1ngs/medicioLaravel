<?php

namespace App\Http\Livewire;

use App\Models\consultorio;
use App\Models\doctores;
use App\Models\persona;
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
    public $control;
    public $consu;
    public $stat ;
    public $statAlert ,$title, $text;
    protected $listeners = ['render'];
    protected $paginationTheme = 'bootstrap';
    
    public function mount()
    {
      
        $this->cant = 10;
        $this->consu = consultorio::all();
        $this->control ='#doctorActive';
    }

    public function upState( $pers,$stat)
    {   
       
        try {
            
            db::table('doctores')
            ->where('doctores.persona_id', '=', $pers)
            ->update(['doctores.stat_id' => $stat]);
            $this->statAlert = 'success';
            $this->title = 'Exitoso';
           
        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
        }
    
            if($stat === 2){
                $this->text = 'Profesional Activado';
            }
            else
            {
                $this->text = 'Profesional Inactivado';
            }

            $this->alert();
    }

    public function alert()
    {

        $this->dispatchBrowserEvent('swal:modal', [

                'icon' => $this->statAlert,  
                'title' => $this->title,
                'text' => $this->text,
            ]);

        
       
    }
    

    public function render()
    {
        $datos = DB::table(db::raw('personas'))
        ->join('doctores', 'personas.id','=', 'doctores.persona_id' )
        ->select(db::raw('personas.id, personas.nombre, personas.apellido, personas.cedula, 
        doctores.especialidades , (SELECT status.descripcion from status where status.id = doctores.stat_id) AS estado') )
        ->where('personas.cedula', 'like', '%' . $this->search . '%')
        ->groupBy('personas.id', 'doctores.persona_id')
        ->paginate($this->cant);

    //  futura mejora 
        // $dat = doctores::with([
        //      'persona', 
        //      'statu',
        //      'consultorios'
        // ])->get();
        
        // $datos = $dat;

        return view('livewire.alta-doctor', compact('datos'));
    }
}

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
    public $statAlert ,$title, $text;
    public $inputState;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function updatingSearch()

    {

        $this->resetPage();

    }
    public function alert()
    {

        $this->dispatchBrowserEvent('swal:modal', [

                'icon' => $this->statAlert,  
                'title' => $this->title,
                'text' => $this->text,
            ]);

    }

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
            $this->statAlert = 'success';
            $this->title = 'Exitoso';
          
        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
        }
    
            if($stat == 2){
             
                $this->text = 'Consultorio Activado';
            }
            else
            {
                $this->text = 'Consultorio Inactivado';
            }
            $this->alert();
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

<?php

namespace App\Http\Livewire;

use App\Models\calendarios_doctores;
use App\Models\doctores;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class Editimportdoc extends Component
{
   
    public $idUp, $nameDoc, $espDoc, $inputImport;
    public $search;
    public $cant;
    public $control;
    public $stat ;
    public $statAlert ,$title, $text;
    protected $listeners = ['render'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function updatingSearch()

    {

        $this->resetPage();

    }

    public function mount()
    {
      
        $this->cant = 10;
     
        $this->control ='#doctorActive';
    }

    public function closeModalAsign(){
        $this->reset(['inputImport','idUp','nameDoc','espDoc']);
    }
    public function sendData($iden, $name, $esp){
        $this->idUp = $iden;
        $this->nameDoc = $name;
        $this->espDoc = $esp;

    }


    public function upImport(){
        try {
            db::table('calendarios_doctores')
            ->where('calendarios_doctores.id', '=', $this->idUp)
            ->update(['calendarios_doctores.costo_consulta' => $this->inputImport]);
            $this->statAlert = 'success';
            $this->title = 'Exitoso';
            $this->text = 'Se modifico el importe';
            
        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
        }
        $this->reset(['inputImport','idUp','nameDoc','espDoc']);
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

        $datos =db::table('personas')
        ->join('doctores','personas.id','doctores.persona_id')
        ->join('calendarios_doctores', 'doctores.id','calendarios_doctores.doctores_id')
        ->join('especialidades','calendarios_doctores.especialidades_id','especialidades.id')
        ->join('consultorios','calendarios_doctores.consultorios_id','consultorios.id')
        ->select('personas.nombre as persnom', 'personas.apellido as persapell','personas.cedula','especialidades.descripcion','consultorios.nombre','calendarios_doctores.costo_consulta', 'calendarios_doctores.id as idcalen')
        ->where('personas.cedula','like','%'. $this->search . '%')
        ->paginate($this->cant);


        // $val = calendarios_doctores::with(['doctores'=> fn($q) => $q->with(['personas']),'especialidad']);
        // $val->whereHas('doctores.calendarios_doctores');
        // $datos = $val->whereHas('doctores.personas', fn ($q) => $q->where('cedula','like', '%' . $this->search . '%'))->paginate($this->cant);


        return view('livewire.editimportdoc',compact('datos'));
    }
}

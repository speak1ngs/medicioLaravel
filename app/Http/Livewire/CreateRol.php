<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateRol extends Component
{
    public $rol;    
    public $statAlert ,$title, $text;

    public function resetWords() {
        $this->reset(['rol']);
    }
    public function alert()
    {

        $this->dispatchBrowserEvent('swal:modal', [

                'icon' => $this->statAlert,  
                'title' => $this->title,
                'text' => $this->text,
            ]);

    }


    public function createRol() {

        try {
            Role::create(['name' => $this->rol,'guard_name' => 'web']);
            
            $this->statAlert = 'success';
            $this->title = 'Exitoso';
            $this->text = 'Se creo el Rol';
        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
        }
        $this->resetWords();
        $this->alert();
    }


 
    public function render()
    {
        return view('livewire.create-rol');
    }
}

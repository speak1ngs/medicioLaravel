<?php

namespace App\Http\Livewire;

use App\Models\post;
use Livewire\Component;

class CrearPosts extends Component
{
    public $inputContent, $inputTittle, $inputPhoto, $control;

    public function mount() 
    {
        $this->control = "successComent";
    }

    public function setPost() 
    {
        // agregar id del usuario adm a nivel global para insertar
        try {
            post::create([
                'titulo'=> $this->inputTittle,
                'body' => $this->inputContent,
                'foto_url'=> "test",
                'user_id' => 1,
                'status_id' => 3
            ]);
         
            $this->reset(['inputContent', 'inputTittle', 'inputPhoto']);
            session()->flash('message', 'Se creo el post exitosamente.');    

        } catch (\Throwable $th) {
            //throw $th;
            $this->control = "failComment";
            session()->flash('message', 'Fallo la conexion a la db.');

        }

    }

    public function render()
    {
        return view('livewire.crear-posts');
    }
}

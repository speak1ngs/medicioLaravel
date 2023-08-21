<?php

namespace App\Http\Livewire;

use App\Models\post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearPosts extends Component
{
    public $inputContent, $inputTittle, $inputPhoto, $control, $iden;

    use WithFileUploads;

    public function mount() 
    {
        $this->iden = rand();
        $this->control = "successComent";
    }
    public function upload() 
    {   
            $this->validate(
            ['inputPhoto' => 'image',]);
            
            return $this->inputPhoto->store('postimage', 'public');
    }

    public function setPost() 
    {
        // agregar id del usuario adm a nivel global para insertar
        try {
            if(!empty($this->inputPhoto)){
            
                $image=$this->upload();

                    post::create([
                        'titulo'=> $this->inputTittle,
                        'body' => $this->inputContent,
                        'foto_url'=> $image ,
                        'user_id' => 1,
                        'status_id' => 3
                    ]);
                
            $this->reset(['inputContent', 'inputTittle', 'inputPhoto']);
            $this->iden = rand();
            session()->flash('message', 'Se creo el post exitosamente.');    
            $this->emitSelf('crear-posts');
        }
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

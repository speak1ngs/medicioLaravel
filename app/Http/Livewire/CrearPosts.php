<?php

namespace App\Http\Livewire;

use App\Models\post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearPosts extends Component
{
    public $inputContent, $inputTittle, $inputPhoto, $control, $iden;
    public $statAlert ,$title, $text;
    use WithFileUploads;

    public function mount() 
    {
        $this->iden = rand();

    }
    public function upload() 
    {   
            $this->validate(
            ['inputPhoto' => 'image',]);
            
            return $this->inputPhoto->store('postimage', 'public');
    }

    
    public function alert()
    {

        $this->dispatchBrowserEvent('swal:modal', [

                'icon' => $this->statAlert,  
                'title' => $this->title,
                'text' => $this->text,
            ]);

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
                $this->statAlert = 'success';
                $this->title = 'Exitoso';
                $this->text = 'Se creo el post exitosamente.';
              
            }
        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
        }
        $this->alert(); 
        $this->emitSelf('crear-posts');
    }

    public function render()
    {
        return view('livewire.crear-posts');
    }
}

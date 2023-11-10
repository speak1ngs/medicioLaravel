<?php

namespace App\Http\Livewire;

use App\Models\post;
use Livewire\Component;
use Livewire\WithPagination;
class Showposts extends Component
{    
    public $iden,$titulo, $bod, $photo, $post;
    public $readyToLoad = false;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function setData($id) 
    {
        

        $valt = post::all()->where('id',intval($id));
   
        foreach($valt as $value){
            
            $this->iden =$value->id;
            $this->titulo = $value->titulo;
            $this->bod = $value->body;
            $this->photo = $value->foto_url;
           
        }


        if($this->iden)
            $this->openModal();

    }

    public function openModal()
    {
    $this->dispatchBrowserEvent('openblogRead');
    }
    public function closeModal()
    {
    $this->dispatchBrowserEvent('closeblogRead');
    }

    public function unsetData() 
    {
        $this->reset(['iden','titulo','bod','photo','readyToLoad']);
        $this->closeModal();
    }




    public function render()
    {   

        $db = post::where('status_id','=',1)->paginate(4);


        return view('livewire.showposts', compact('db'));
    }
}

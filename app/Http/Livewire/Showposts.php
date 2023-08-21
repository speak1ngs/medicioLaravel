<?php

namespace App\Http\Livewire;

use App\Models\post;
use Livewire\Component;

class Showposts extends Component
{    
    public $iden,$titulo, $bod, $photo, $post;

    public function setData($id, $title,$body, $pic) 
    {
    
        $this->iden = $id;
        $this->titulo = $title;
        $this->bod =$body;
        $this->photo = $pic;
    }

    public function unsetData() 
    {
        $this->reset(['iden','titulo','bod','photo']);
    }



    public function render()
    {   

        $db = post::where('status_id','=',1)->get();


        return view('livewire.showposts', compact('db'));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\post;
use Livewire\Component;
use Livewire\WithPagination;
class Showposts extends Component
{    
    public $iden,$titulo, $bod, $photo, $post;
    use WithPagination;
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

        $db = post::where('status_id','=',1)->paginate(4);


        return view('livewire.showposts', compact('db'));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\post;
use Livewire\Component;

class Showposts extends Component
{
    public function render()
    {   

        $db = post::where('status_id','=',1)->get();


        return view('livewire.showposts', compact('db'));
    }
}
